<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use App\Models\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetApprovalController extends Controller
{
    public function reset(Request $request, int $id)
    {
        $resetRequest = PasswordResetRequest::with('user')->findOrFail($id);

        if ($resetRequest->status !== 'pending' || ! $resetRequest->user) {
            return back()->withErrors([
                'reset' => 'Permintaan reset password ini sudah diproses atau akun tidak ditemukan.',
            ]);
        }

        $newPassword = $this->generatePassword();
        $user = $resetRequest->user;

        $user->update([
            'password' => $newPassword,
        ]);

        $resetRequest->update([
            'status' => 'completed',
            'resolved_at' => now(),
            'resolved_by' => $request->user()->id,
            'admin_note' => 'Password berhasil direset dan dikirim ke email pengguna.',
        ]);

        LoginActivity::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'department' => $user->department,
            'event' => 'password_reset',
            'status' => 'success',
            'description' => 'Password direset oleh super admin dan dikirim ke email pengguna.',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'attempted_at' => now(),
        ]);

        Mail::raw(
            "Halo {$user->name},\n\nPassword akun admin Anda telah direset oleh super admin.\n\nPassword baru: {$newPassword}\n\nSilakan login dan segera ganti password Anda melalui menu pengaturan profil.\n",
            function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Reset Password Admin UFDK');
            }
        );

        return back()->with('success', 'Password berhasil direset dan email sudah dikirim ke pengguna.');
    }

    public function close(Request $request, int $id)
    {
        $resetRequest = PasswordResetRequest::findOrFail($id);

        $resetRequest->update([
            'status' => 'closed',
            'resolved_at' => now(),
            'resolved_by' => $request->user()->id,
            'admin_note' => 'Permintaan reset password ditutup oleh super admin.',
        ]);

        return back()->with('success', 'Permintaan reset password ditutup.');
    }

    private function generatePassword(): string
    {
        return 'Ufdk@' . strtoupper(Str::random(3)) . random_int(100, 999) . '!';
    }
}
