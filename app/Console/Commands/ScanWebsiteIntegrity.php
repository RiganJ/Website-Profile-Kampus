<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class ScanWebsiteIntegrity extends Command
{
    protected $signature = 'website:integrity-scan {--quarantine : Pindahkan temuan ke storage/app/quarantine}';

    protected $description = 'Memindai folder unggahan untuk file judol, skrip, dan file dengan MIME palsu.';

    private const EXECUTABLE_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar', 'cgi', 'pl', 'py', 'sh', 'asp', 'aspx',
    ];

    private const IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];

    private const ALLOWED_TYPES = [
        // Berkas lama pada situs ini memakai ekstensi gambar yang kadang
        // berbeda dari MIME aslinya. Selama MIME tetap gambar, jangan ganggu.
        'jpg' => self::IMAGE_TYPES,
        'jpeg' => self::IMAGE_TYPES,
        'png' => self::IMAGE_TYPES,
        'gif' => self::IMAGE_TYPES,
        'webp' => self::IMAGE_TYPES,
        'avif' => self::IMAGE_TYPES,
        'pdf' => ['application/pdf'],
        'mp4' => ['video/mp4', 'application/octet-stream'],
    ];

    private const GAMBLING_PATTERN = '/(?:raja\s*togel|togel|judol|judi(?:online)?|casino|slot(?:online|gacor|terfavorit)|pragmatic\s*play|situs\s*slot)/i';

    public function handle(): int
    {
        $findings = [];

        foreach ($this->scanRoots() as $root) {
            if (! is_dir($root)) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS)
            );

            /** @var SplFileInfo $file */
            foreach ($iterator as $file) {
                if (! $file->isFile() || $this->isQuarantinePath($file->getPathname())) {
                    continue;
                }

                if ($reason = $this->suspicionReason($file)) {
                    $findings[] = ['path' => $file->getPathname(), 'reason' => $reason];
                }
            }
        }

        if ($findings === []) {
            $this->info('Pemeriksaan integritas selesai: tidak ada file mencurigakan.');
            return self::SUCCESS;
        }

        foreach ($findings as $finding) {
            $this->warn("[{$finding['reason']}] {$finding['path']}");
        }

        if (! $this->option('quarantine')) {
            $this->warn('Mode laporan: tidak ada file dipindahkan. Jalankan dengan --quarantine untuk mengarantina.');
            return self::FAILURE;
        }

        $quarantine = storage_path('app/quarantine/integrity/'.now()->format('Ymd-His'));
        foreach ($findings as $finding) {
            $relativePath = ltrim(str_replace(base_path(), '', $finding['path']), DIRECTORY_SEPARATOR);
            $destination = $quarantine.DIRECTORY_SEPARATOR.$relativePath;

            if (! is_dir(dirname($destination))) {
                mkdir(dirname($destination), 0750, true);
            }

            if (rename($finding['path'], $destination)) {
                Log::warning('Website integrity scanner quarantined a file.', [
                    'source' => $relativePath,
                    'quarantine_path' => str_replace(base_path().DIRECTORY_SEPARATOR, '', $destination),
                    'reason' => $finding['reason'],
                ]);
            } else {
                $this->error("Gagal mengarantina: {$finding['path']}");
            }
        }

        $this->error(count($findings).' file mencurigakan telah dikarantina.');
        return self::FAILURE;
    }

    /** @return list<string> */
    private function scanRoots(): array
    {
        return array_unique([
            base_path('images'),
            base_path('files'),
            public_path('images'),
            public_path('files'),
            storage_path('app/public'),
        ]);
    }

    private function suspicionReason(SplFileInfo $file): ?string
    {
        $name = $file->getFilename();
        $extension = strtolower($file->getExtension());

        if (preg_match(self::GAMBLING_PATTERN, $name)) {
            return 'nama mengandung indikator judol';
        }

        if (str_starts_with($name, '._')) {
            return 'metadata AppleDouble yang tidak diperlukan web';
        }

        if (in_array($extension, self::EXECUTABLE_EXTENSIONS, true)) {
            return 'ekstensi skrip yang dapat dieksekusi';
        }

        if (in_array(strtolower($name), ['.user.ini', '.htpasswd'], true)) {
            return 'konfigurasi eksekusi tersembunyi di folder unggahan';
        }

        if (strtolower($name) === '.htaccess') {
            return $this->isSafeUploadProtectionFile($file)
                ? null
                : 'aturan .htaccess yang tidak aman di folder unggahan';
        }

        if (strtolower($name) === '.gitignore') {
            return null;
        }

        if (! array_key_exists($extension, self::ALLOWED_TYPES)) {
            return 'ekstensi tidak diizinkan di folder unggahan';
        }

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($file->getPathname());
        if (! in_array($mime, self::ALLOWED_TYPES[$extension], true)) {
            return "MIME tidak sesuai (.$extension, terdeteksi $mime)";
        }

        return null;
    }

    private function isQuarantinePath(string $path): bool
    {
        return str_starts_with(str_replace('\\', '/', $path), str_replace('\\', '/', storage_path('app/quarantine')).'/');
    }

    private function isSafeUploadProtectionFile(SplFileInfo $file): bool
    {
        $contents = (string) file_get_contents($file->getPathname());

        return str_contains($contents, 'Options -Indexes')
            && str_contains($contents, 'Require all denied')
            && str_contains($contents, 'php_flag engine off');
    }
}
