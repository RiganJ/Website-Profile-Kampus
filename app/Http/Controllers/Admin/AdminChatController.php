<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChatController extends Controller
{
    public function index()
    {
        $activeSession = ChatSession::with('latestMessage')->active()->latest('last_message_at')->first();
        $waitingSessions = ChatSession::with('latestMessage')->waiting()->orderBy('created_at')->get();
        $recentSessions = AdminTable::paginate(ChatSession::with('latestMessage')
            ->where('status', 'ended')
            ->latest('ended_at'), ['visitor_name', 'visitor_email', 'subject', 'status'], 'recentSessions', 10);
        $contactMessages = ContactMessage::whereIn('status', ['new', 'read'])
            ->latest()
            ->take(20)
            ->get();
        $contactHistory = AdminTable::paginate(ContactMessage::whereIn('status', ['responded', 'closed'])
            ->latest('responded_at')
            ->latest('updated_at'), ['name', 'email', 'subject', 'message', 'status'], 'contactHistory', 10);

        return view('admin.chat.index', compact(
            'activeSession',
            'waitingSessions',
            'recentSessions',
            'contactMessages',
            'contactHistory'
        ));
    }

    public function show(int $id)
    {
        $session = ChatSession::with('messages')->findOrFail($id);

        if ($session->status === 'active' && $session->unread_admin_count > 0) {
            $session->forceFill([
                'unread_admin_count' => 0,
            ])->save();

            $session->messages()
                ->where('sender', 'visitor')
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);
        }

        $waitingCount = ChatSession::waiting()->count();

        return view('admin.chat.show', compact('session', 'waitingCount'));
    }

    public function showContact(int $id)
    {
        $contactMessage = ContactMessage::findOrFail($id);

        if (! $contactMessage->is_read) {
            $contactMessage->forceFill([
                'is_read' => true,
                'status' => $contactMessage->status === 'new' ? 'read' : $contactMessage->status,
                'read_at' => now(),
            ])->save();
        }

        return view('admin.chat.contact', compact('contactMessage'));
    }

    public function updateContactStatus(Request $request, int $id)
    {
        $payload = $request->validate([
            'status' => ['required', 'in:new,read,responded,closed'],
        ]);

        $contactMessage = ContactMessage::findOrFail($id);
        $contactMessage->status = $payload['status'];

        if (! $contactMessage->is_read) {
            $contactMessage->is_read = true;
            $contactMessage->read_at = now();
        }

        if ($payload['status'] === 'responded' && ! $contactMessage->responded_at) {
            $contactMessage->responded_at = now();
        }

        $contactMessage->save();

        return redirect()
            ->route('admin.chat.contact.show', $contactMessage->id)
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    public function reply(Request $request, int $id)
    {
        $payload = $request->validate([
            'message' => ['required', 'string'],
        ]);

        $session = ChatSession::findOrFail($id);

        if ($session->status === 'waiting' && ! ChatSession::active()->whereKeyNot($session->id)->exists()) {
            $session->forceFill([
                'status' => 'active',
                'queue_position' => null,
                'started_at' => now(),
            ])->save();
        }

        ChatMessage::create([
            'session_id' => $session->id,
            'sender' => 'admin',
            'message' => $payload['message'],
            'is_read' => false,
        ]);

        $session->forceFill([
            'status' => $session->status === 'ended' ? 'active' : $session->status,
            'admin_user_id' => auth()->id(),
            'last_message_at' => now(),
            'unread_visitor_count' => $session->unread_visitor_count + 1,
            'unread_admin_count' => 0,
        ])->save();

        return redirect()
            ->route('admin.chat.show', $session->id)
            ->with('success', 'Balasan berhasil dikirim.');
    }

    public function end(int $id)
    {
        $session = ChatSession::findOrFail($id);

        DB::transaction(function () use ($session) {
            $session->forceFill([
                'status' => 'ended',
                'ended_at' => now(),
                'queue_position' => null,
                'unread_admin_count' => 0,
            ])->save();

            ChatMessage::create([
                'session_id' => $session->id,
                'sender' => 'system',
                'message' => 'Chat telah diakhiri oleh admin.',
                'is_read' => false,
            ]);

            $nextSession = ChatSession::waiting()->orderBy('created_at')->first();

            if ($nextSession) {
                $nextSession->forceFill([
                    'status' => 'active',
                    'queue_position' => null,
                    'started_at' => now(),
                    'admin_user_id' => auth()->id(),
                ])->save();

                ChatMessage::create([
                    'session_id' => $nextSession->id,
                    'sender' => 'system',
                    'message' => 'Antrian Anda telah dipanggil. Admin sekarang melayani chat Anda.',
                    'is_read' => false,
                ]);

                $this->reorderQueue();
            }
        });

        return redirect()
            ->route('admin.chat.index')
            ->with('success', 'Chat berhasil diakhiri dan antrian berikutnya diproses.');
    }

    public function poll(int $id): JsonResponse
    {
        $session = ChatSession::with('messages')->findOrFail($id);

        if ($session->status === 'active' && $session->unread_admin_count > 0) {
            $session->forceFill([
                'unread_admin_count' => 0,
            ])->save();

            $session->messages()
                ->where('sender', 'visitor')
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);
        }

        return response()->json([
            'session' => [
                'id' => $session->id,
                'status' => $session->status,
                'visitor_name' => $session->visitor_name,
                'unread_admin_count' => $session->unread_admin_count,
                'unread_visitor_count' => $session->unread_visitor_count,
                'last_message_at' => optional($session->last_message_at)->format('Y-m-d H:i:s'),
            ],
            'messages' => $session->messages->sortBy('created_at')->values(),
        ]);
    }

    public function notifications(): JsonResponse
    {
        $contacts = ContactMessage::where(function ($query) {
                $query->where('is_read', false)->orWhere('status', 'new');
            })
            ->latest()
            ->take(5)
            ->get()
            ->map(function (ContactMessage $message) {
                return [
                    'type' => 'contact',
                    'id' => $message->id,
                    'title' => $message->subject,
                    'description' => $message->name . ' mengirim pesan baru',
                    'time' => optional($message->created_at)->diffForHumans(),
                    'sort_at' => optional($message->created_at)?->timestamp ?? 0,
                    'url' => route('admin.chat.contact.show', $message->id),
                ];
            });

        $sessions = ChatSession::with('latestMessage')
            ->where(function ($query) {
                $query->where('unread_admin_count', '>', 0)
                    ->orWhere('status', 'waiting')
                    ->orWhere('status', 'active');
            })
            ->latest('last_message_at')
            ->take(5)
            ->get()
            ->map(function (ChatSession $session) {
                return [
                    'type' => 'chat',
                    'id' => $session->id,
                    'title' => $session->visitor_name,
                    'description' => $session->status === 'waiting'
                        ? 'Menunggu antrian live chat'
                        : ($session->latestMessage->message ?? 'Live chat aktif'),
                    'time' => optional($session->last_message_at ?? $session->created_at)->diffForHumans(),
                    'sort_at' => optional($session->last_message_at ?? $session->created_at)?->timestamp ?? 0,
                    'url' => route('admin.chat.show', $session->id),
                ];
            });

        $items = $contacts
            ->concat($sessions)
            ->sortByDesc('sort_at')
            ->take(8)
            ->values();

        return response()->json([
            'count' => ContactMessage::where('is_read', false)->count()
                + ChatSession::sum('unread_admin_count')
                + ChatSession::waiting()->count(),
            'items' => $items,
        ]);
    }

    private function reorderQueue(): void
    {
        ChatSession::waiting()
            ->orderBy('created_at')
            ->get()
            ->values()
            ->each(function (ChatSession $session, int $index) {
                $session->forceFill([
                    'queue_position' => $index + 1,
                ])->save();
            });
    }
}
