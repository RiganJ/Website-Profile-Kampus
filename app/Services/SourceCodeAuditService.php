<?php

namespace App\Services;

use App\Models\AdminActivity;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class SourceCodeAuditService
{
    private const SNAPSHOT_FILE = 'source-code-audit.json';

    private array $scanRoots = [
        'app',
        'config',
        'database',
        'resources',
        'routes',
    ];

    private array $rootFiles = [
        'artisan',
        'composer.json',
        'composer.lock',
        'package.json',
        'package-lock.json',
        'vite.config.js',
    ];

    private array $extensions = [
        'php',
        'blade.php',
        'css',
        'js',
        'json',
        'env.example',
    ];

    public function check(): void
    {
        $snapshot = $this->loadSnapshot();
        $current = $this->buildSnapshot();

        if ($snapshot === []) {
            $this->saveSnapshot($current);
            return;
        }

        $changes = $this->detectChanges($snapshot, $current);

        if ($changes === []) {
            return;
        }

        $this->logChanges($changes);
        $this->saveSnapshot($current);
    }

    private function loadSnapshot(): array
    {
        $path = $this->snapshotPath();

        if (! File::exists($path)) {
            return [];
        }

        $data = json_decode((string) File::get($path), true);

        return is_array($data) ? $data : [];
    }

    private function saveSnapshot(array $snapshot): void
    {
        File::ensureDirectoryExists(dirname($this->snapshotPath()));
        File::put($this->snapshotPath(), json_encode($snapshot, JSON_PRETTY_PRINT));
    }

    private function buildSnapshot(): array
    {
        $snapshot = [];

        foreach ($this->scanRoots as $root) {
            $absoluteRoot = base_path($root);

            if (! is_dir($absoluteRoot)) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($absoluteRoot, RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if (! $file instanceof SplFileInfo || ! $file->isFile()) {
                    continue;
                }

                $relativePath = $this->relativePath($file->getPathname());

                if (! $this->shouldTrack($relativePath)) {
                    continue;
                }

                $snapshot[$relativePath] = [
                    'hash' => hash_file('sha256', $file->getPathname()),
                    'size' => $file->getSize(),
                ];
            }
        }

        foreach ($this->rootFiles as $file) {
            $absolutePath = base_path($file);

            if (is_file($absolutePath)) {
                $snapshot[$file] = [
                    'hash' => hash_file('sha256', $absolutePath),
                    'size' => filesize($absolutePath),
                ];
            }
        }

        ksort($snapshot);

        return $snapshot;
    }

    private function detectChanges(array $old, array $current): array
    {
        $changes = [];

        foreach ($current as $path => $meta) {
            if (! array_key_exists($path, $old)) {
                $changes['added'][] = $path;
                continue;
            }

            if (($old[$path]['hash'] ?? null) !== ($meta['hash'] ?? null)) {
                $changes['modified'][] = $path;
            }
        }

        foreach ($old as $path => $meta) {
            if (! array_key_exists($path, $current)) {
                $changes['deleted'][] = $path;
            }
        }

        return array_filter($changes);
    }

    private function logChanges(array $changes): void
    {
        $parts = [];

        foreach (['added' => 'ditambahkan', 'modified' => 'diubah', 'deleted' => 'dihapus'] as $key => $label) {
            if (! isset($changes[$key])) {
                continue;
            }

            $files = array_slice($changes[$key], 0, 8);
            $extra = count($changes[$key]) > 8 ? ' +' . (count($changes[$key]) - 8) . ' file lain' : '';
            $parts[] = 'File ' . $label . ': ' . implode(', ', $files) . $extra;
        }

        AdminActivity::create([
            'user_id' => null,
            'name' => 'System Audit',
            'email' => null,
            'role' => 'system',
            'module' => 'Source Code',
            'action' => 'source_changed',
            'description' => implode(' | ', $parts),
            'method' => 'SYSTEM',
            'path' => null,
            'ip_address' => request()?->ip(),
            'user_agent' => 'SourceCodeAuditService',
            'performed_at' => now(),
        ]);
    }

    private function shouldTrack(string $relativePath): bool
    {
        $normalized = str_replace('\\', '/', $relativePath);

        foreach ($this->extensions as $extension) {
            if (str_ends_with($normalized, '.' . $extension) || str_ends_with($normalized, $extension)) {
                return true;
            }
        }

        return false;
    }

    private function relativePath(string $absolutePath): string
    {
        return str_replace('\\', '/', ltrim(str_replace(base_path(), '', $absolutePath), DIRECTORY_SEPARATOR));
    }

    private function snapshotPath(): string
    {
        return storage_path('app/' . self::SNAPSHOT_FILE);
    }
}
