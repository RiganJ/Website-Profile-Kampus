<?php

namespace App\Http\Middleware;

use App\Models\AdminActivity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAdminActivityMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $request->user()) {
            return $response;
        }

        if (! $this->shouldLog($request, $response)) {
            return $response;
        }

        $module = $this->resolveModule($request);
        $action = $this->resolveAction($request);
        $user = $request->user();

        AdminActivity::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'module' => $module,
            'action' => $action,
            'description' => $this->buildDescription($module, $action),
            'method' => $request->method(),
            'path' => $request->path(),
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'performed_at' => now(),
        ]);

        return $response;
    }

    private function shouldLog(Request $request, Response $response): bool
    {
        if (! in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return false;
        }

        if (! str_starts_with($request->path(), 'admin')) {
            return false;
        }

        if ($response->getStatusCode() >= 400) {
            return false;
        }

        if ($request->session()->has('errors')) {
            return false;
        }

        return true;
    }

    private function resolveModule(Request $request): string
    {
        $segments = $request->segments();

        return match ($segments[1] ?? '') {
            'users' => 'User Management',
            'mahasiswa' => 'Mahasiswa',
            'dosen' => 'Dosen',
            'berita' => 'Berita',
            'banner', 'hero' => 'Banner',
            'chat' => 'Pesan & Live Chat',
            'akreditasi' => 'Akreditasi',
            'panduan-akademik' => 'Panduan Akademik',
            'kerjasama' => 'Kerja Sama',
            'civitas' => 'Civitas',
            'prodi' => 'Prodi',
            'fakultas' => 'Fakultas',
            'beasiswa' => 'Beasiswa',
            'guru-besar' => 'Guru Besar',
            'profile' => 'Pengaturan Profil',
            default => 'Admin',
        };
    }

    private function resolveAction(Request $request): string
    {
        $method = $request->method();
        $path = $request->path();

        if (str_contains($path, '/toggle')) {
            return 'toggle';
        }

        if (str_contains($path, '/reply')) {
            return 'reply';
        }

        if (str_contains($path, '/end')) {
            return 'end';
        }

        if (str_contains($path, '/status')) {
            return 'status_update';
        }

        if (str_contains($path, '/reset')) {
            return 'reset_password';
        }

        if (str_contains($path, '/close')) {
            return 'close_request';
        }

        return match ($method) {
            'POST' => 'create',
            'PUT', 'PATCH' => 'update',
            'DELETE' => 'delete',
            default => strtolower($method),
        };
    }

    private function buildDescription(string $module, string $action): string
    {
        return match ($action) {
            'create' => "Menambahkan data pada modul {$module}.",
            'update' => "Memperbarui data pada modul {$module}.",
            'delete' => "Menghapus data pada modul {$module}.",
            'toggle' => "Mengubah status data pada modul {$module}.",
            'reply' => "Membalas percakapan pada modul {$module}.",
            'end' => "Mengakhiri percakapan pada modul {$module}.",
            'status_update' => "Memperbarui status pada modul {$module}.",
            'reset_password' => "Mereset password pengguna.",
            'close_request' => "Menutup permintaan reset password.",
            default => "Melakukan aksi {$action} pada modul {$module}.",
        };
    }
}
