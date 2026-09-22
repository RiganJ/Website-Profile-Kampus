<?php

namespace App\Providers;

use App\Models\ChatSession;
use App\Models\ContactMessage;
use App\Models\PasswordResetRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('web-traffic', fn (Request $request) => Limit::perMinute(240)
            ->by($request->ip()));
        RateLimiter::for('login', fn (Request $request) => [
            Limit::perMinute(10)->by('login-ip|'.$request->ip()),
            Limit::perMinute(5)->by('login-account|'.strtolower((string) $request->input('email'))),
        ]);
        RateLimiter::for('password-reset', fn (Request $request) => Limit::perMinute(3)
            ->by(strtolower((string) $request->input('email')).'|'.$request->ip()));
        RateLimiter::for('contact', fn (Request $request) => Limit::perMinute(5)->by($request->ip()));
        RateLimiter::for('chat-start', fn (Request $request) => Limit::perMinute(3)->by($request->ip()));
        RateLimiter::for('chat-send', fn (Request $request) => Limit::perMinute(20)
            ->by((string) $request->session()->get('chat_session', $request->ip())));
        RateLimiter::for('chat-fetch', fn (Request $request) => Limit::perMinute(30)
            ->by((string) $request->session()->get('chat_session', $request->ip())));
        RateLimiter::for('captcha-refresh', fn (Request $request) => Limit::perMinute(10)
            ->by($request->ip()));

        View::composer('admin.layouts.navbar', function ($view) {
            $contactNotifications = ContactMessage::where(function ($query) {
                    $query->where('is_read', false)->orWhere('status', 'new');
                })
                ->latest()
                ->take(4)
                ->get();

            $chatNotifications = ChatSession::with('latestMessage')
                ->where(function ($query) {
                    $query->where('unread_admin_count', '>', 0)
                        ->orWhere('status', 'waiting')
                        ->orWhere('status', 'active');
                })
                ->latest('last_message_at')
                ->take(4)
                ->get();

            $unreadMessageCount = ContactMessage::where('is_read', false)->count()
                + ChatSession::sum('unread_admin_count')
                + ChatSession::waiting()->count();

            $passwordResetRequests = collect();

            if (auth()->check() && auth()->user()->role === 'super_admin') {
                $passwordResetRequests = PasswordResetRequest::with('user')
                    ->where('status', 'pending')
                    ->latest('requested_at')
                    ->take(4)
                    ->get();

                $unreadMessageCount += $passwordResetRequests->count();
            }

            $view->with([
                'contactNotifications' => $contactNotifications,
                'chatNotifications' => $chatNotifications,
                'passwordResetRequests' => $passwordResetRequests,
                'unreadMessageCount' => $unreadMessageCount,
            ]);
        });
    }
}
