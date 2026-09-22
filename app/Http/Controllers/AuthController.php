<?php

namespace App\Http\Controllers;

use App\Models\LoginActivity;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(Request $request): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        $captchaQuestion = $this->ensureCaptcha($request);

        return view('auth.login', compact('captchaQuestion'));
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)->mixedCase()->symbols()],
            'captcha' => ['required', 'string'],
        ], [
            'password.mixed' => 'Password harus mengandung huruf besar dan huruf kecil.',
            'password.symbols' => 'Password harus mengandung simbol unik.',
        ]);

        $captchaInput = strtoupper(str_replace(' ', '', (string) $request->captcha));
        $captchaAnswer = strtoupper(str_replace(' ', '', (string) $request->session()->get('captcha.answer')));

        if ($captchaInput !== $captchaAnswer) {
            $this->storeLoginActivity($request, null, 'login', 'failed', 'Percobaan login gagal karena captcha tidak sesuai.');
            $this->generateCaptcha($request);

            return back()
                ->withErrors(['captcha' => 'Captcha tidak sesuai.'])
                ->withInput($request->only('email'));
        }

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $this->storeLoginActivity(
                $request,
                User::where('email', $request->email)->first(),
                'login',
                'failed',
                'Percobaan login gagal karena email atau password salah.'
            );
            $this->generateCaptcha($request);

            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $this->storeLoginActivity($request, $request->user(), 'login', 'success', 'Login berhasil.');

        return redirect('/admin');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->storeLoginActivity($request, $request->user(), 'logout', 'success', 'Logout berhasil.');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function refreshCaptcha(Request $request): JsonResponse
    {
        $captchaQuestion = $this->generateCaptcha($request);

        return response()->json([
            'question' => $captchaQuestion,
        ]);
    }

    private function ensureCaptcha(Request $request): string
    {
        return $request->session()->has('captcha.question')
            ? (string) $request->session()->get('captcha.question')
            : $this->generateCaptcha($request);
    }

    private function generateCaptcha(Request $request): string
    {
        $characters = str_split('ABCDEFGHJKLMNPQRSTUVWXYZ23456789');
        shuffle($characters);

        $answer = implode('', array_slice($characters, 0, 6));
        $question = collect(str_split($answer))->join(' ');

        Session::put('captcha', [
            'question' => $question,
            'answer' => $answer,
        ]);

        return $question;
    }

    private function storeLoginActivity(
        Request $request,
        ?User $user,
        string $event,
        string $status,
        string $description
    ): void {
        LoginActivity::create([
            'user_id' => $user?->id,
            'name' => $user?->name,
            'email' => $user?->email ?? $request->input('email'),
            'role' => $user?->role,
            'department' => $user?->department,
            'event' => $event,
            'status' => $status,
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'attempted_at' => now(),
        ]);
    }
}
