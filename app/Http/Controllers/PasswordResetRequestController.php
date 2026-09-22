<?php

namespace App\Http\Controllers;

use App\Models\LoginActivity;
use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordResetRequestController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $payload['email'])->first();

        if (! $user) {
            LoginActivity::create([
                'email' => $payload['email'],
                'event' => 'password_reset_request',
                'status' => 'failed',
                'description' => 'Permintaan lupa password gagal karena email tidak ditemukan.',
                'ip_address' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
                'attempted_at' => now(),
            ]);

            return back()->withErrors([
                'email' => 'Email tidak ditemukan dalam sistem kami.',
            ])->withInput();
        }

        $existingRequest = PasswordResetRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest('requested_at')
            ->first();

        if (! $existingRequest) {
            PasswordResetRequest::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'status' => 'pending',
                'requested_at' => now(),
            ]);
        }

        LoginActivity::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'department' => $user->department,
            'event' => 'password_reset_request',
            'status' => 'success',
            'description' => 'Permintaan lupa password berhasil dikirim ke super admin.',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'attempted_at' => now(),
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Permintaan reset password berhasil dikirim. Mohon tunggu konfirmasi dari super admin.');
    }
}
