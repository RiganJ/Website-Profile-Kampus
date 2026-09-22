<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function startSession(Request $request)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30', 'regex:/^[0-9+()\-\s]*$/'],
            'subject' => ['nullable', 'string', 'max:150'],
        ]);

        $existingSessionId = session('chat_session');

        if ($existingSessionId) {
            $existingSession = ChatSession::open()->find($existingSessionId);

            if ($existingSession) {
                return response()->json([
                    'session' => $this->transformSession($existingSession->load('latestMessage')),
                ]);
            }
        }

        $hasActiveSession = ChatSession::active()->exists();
        $status = $hasActiveSession ? 'waiting' : 'active';

        $session = ChatSession::create([
            'visitor_name' => $payload['name'],
            'visitor_email' => $payload['email'] ?? null,
            'visitor_phone' => $payload['phone'] ?? null,
            'subject' => $payload['subject'] ?? 'Live Chat',
            'source' => 'live_chat',
            'status' => $status,
            'queue_position' => $hasActiveSession ? $this->nextQueuePosition() : null,
            'started_at' => $hasActiveSession ? null : now(),
            'last_message_at' => now(),
            'unread_admin_count' => 0,
            'unread_visitor_count' => 0,
        ]);

        ChatMessage::create([
            'session_id' => $session->id,
            'sender' => 'system',
            'message' => $hasActiveSession
                ? 'Chat Anda masuk ke antrian. Mohon tunggu sampai admin tersedia.'
                : 'Admin tersedia. Anda bisa mulai chat sekarang.',
            'is_read' => true,
            'read_at' => now(),
        ]);

        session(['chat_session' => $session->id]);

        return response()->json([
            'session' => $this->transformSession($session->load('latestMessage')),
        ]);
    }

    public function sendMessage(Request $request)
    {
        $payload = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $session = $this->resolveSession(openOnly: true);

        if (! $session) {
            return response()->json([
                'message' => 'Sesi chat tidak ditemukan. Silakan mulai chat baru.',
            ], 404);
        }

        $message = ChatMessage::create([
            'session_id' => $session->id,
            'sender' => 'visitor',
            'message' => $payload['message'],
            'is_read' => false,
        ]);

        $session->forceFill([
            'last_message_at' => now(),
            'unread_admin_count' => $session->unread_admin_count + 1,
        ])->save();

        return response()->json([
            'message' => $message,
            'session' => $this->transformSession($session->fresh('latestMessage')),
        ]);
    }

    public function fetchMessages()
    {
        $session = $this->resolveSession();

        if (! $session) {
            return response()->json([
                'messages' => [],
                'session' => null,
            ]);
        }

        $session->messages()
            ->where('sender', 'admin')
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        if ($session->unread_visitor_count > 0) {
            $session->forceFill([
                'unread_visitor_count' => 0,
            ])->save();
        }

        return response()->json([
            'messages' => $session->messages()->orderBy('created_at')->get(),
            'session' => $this->transformSession($session->fresh('latestMessage')),
        ]);
    }

    private function resolveSession(bool $openOnly = false): ?ChatSession
    {
        $sessionId = session('chat_session');

        if (! $sessionId) {
            return null;
        }

        $query = ChatSession::with('messages', 'latestMessage');

        if ($openOnly) {
            $query->open();
        }

        return $query->find($sessionId);
    }

    private function nextQueuePosition(): int
    {
        return (int) ChatSession::waiting()->max('queue_position') + 1;
    }

    private function transformSession(ChatSession $session): array
    {
        $queueAheadCount = 0;

        if ($session->status === 'waiting') {
            $queueAheadCount = ChatSession::waiting()
                ->where('created_at', '<', $session->created_at)
                ->count();
        }

        return [
            'id' => $session->id,
            'visitor_name' => $session->visitor_name,
            'visitor_email' => $session->visitor_email,
            'status' => $session->status,
            'subject' => $session->subject,
            'queue_ahead_count' => $queueAheadCount,
            'queue_label' => $queueAheadCount > 0
                ? 'Ada ' . $queueAheadCount . ' antrian di depan Anda.'
                : 'Giliran Anda berikutnya.',
            'started_at' => optional($session->started_at)->format('Y-m-d H:i:s'),
            'ended_at' => optional($session->ended_at)->format('Y-m-d H:i:s'),
            'last_message_at' => optional($session->last_message_at)->format('Y-m-d H:i:s'),
        ];
    }
}
