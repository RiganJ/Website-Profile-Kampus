<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RepairWebsiteIntegrity extends Command
{
    protected $signature = 'website:repair-integrity';

    protected $description = 'Memulihkan file infrastruktur Laravel yang rusak dari baseline aman.';

    public function handle(): int
    {
        $baselineDirectory = storage_path('app/integrity-baseline');
        $incidentDirectory = storage_path('app/quarantine/integrity-repairs/'.now()->format('Ymd-His'));
        $repairs = [];
        $alerts = [];

        foreach ($this->protectedFiles() as $relativePath => $validator) {
            $livePath = base_path($relativePath);
            $baselinePath = $baselineDirectory.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

            if (! file_exists($baselinePath) && file_exists($livePath) && $validator($livePath)) {
                $this->copyFile($livePath, $baselinePath);
                $this->line("Baseline dibuat: $relativePath");
            }

            if ($validator($livePath)) {
                continue;
            }

            if (! file_exists($baselinePath) || ! $validator($baselinePath)) {
                $alerts[] = "$relativePath rusak, tetapi baseline aman belum tersedia.";
                continue;
            }

            if (file_exists($livePath)) {
                $this->copyFile($livePath, $incidentDirectory.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath));
            }

            $this->copyFile($baselinePath, $livePath);
            $repairs[] = "$relativePath dipulihkan dari baseline.";
        }

        $this->sendReport($repairs, $alerts);

        foreach (array_merge($repairs, $alerts) as $message) {
            $this->line($message);
        }

        if ($repairs === [] && $alerts === []) {
            $this->info('Pemeriksaan pemulihan selesai: infrastruktur website sehat.');
        }

        return $alerts === [] ? self::SUCCESS : self::FAILURE;
    }

    /** @return array<string, callable(string): bool> */
    private function protectedFiles(): array
    {
        return [
            '.htaccess' => fn (string $path): bool => $this->isValidHtaccess($path),
            'public/.htaccess' => fn (string $path): bool => $this->isValidHtaccess($path),
            'public/index.php' => fn (string $path): bool => $this->isValidPublicIndex($path),
            '.env' => fn (string $path): bool => $this->isValidEnvironment($path),
        ];
    }

    private function isValidHtaccess(string $path): bool
    {
        if (! file_exists($path)) {
            return false;
        }

        $contents = (string) file_get_contents($path);

        return str_contains($contents, 'Options -Indexes')
            && str_contains($contents, 'RewriteEngine On')
            && str_contains($contents, 'RewriteRule ^ index.php [L]')
            && ! preg_match('/LsRecaptcha|verifycaptcha/i', $contents);
    }

    private function isValidPublicIndex(string $path): bool
    {
        if (! file_exists($path)) {
            return false;
        }

        $contents = (string) file_get_contents($path);

        return str_contains($contents, "__DIR__.'/../vendor/autoload.php'")
            && str_contains($contents, "__DIR__.'/../bootstrap/app.php'")
            && str_contains($contents, 'handleRequest(Request::capture())');
    }

    private function isValidEnvironment(string $path): bool
    {
        if (! file_exists($path)) {
            return false;
        }

        $contents = (string) file_get_contents($path);
        foreach (['APP_KEY', 'APP_ENV', 'APP_URL', 'DB_CONNECTION'] as $key) {
            if (! preg_match('/^'.preg_quote($key, '/').'=(.+)$/m', $contents, $match) || trim($match[1]) === '') {
                return false;
            }
        }

        return true;
    }

    private function copyFile(string $source, string $destination): void
    {
        if (! is_dir(dirname($destination))) {
            mkdir(dirname($destination), 0750, true);
        }

        copy($source, $destination);
        chmod($destination, 0640);
    }

    /** @param list<string> $repairs @param list<string> $alerts */
    private function sendReport(array $repairs, array $alerts): void
    {
        if ($repairs === [] && $alerts === []) {
            return;
        }

        $subject = $alerts === []
            ? '[UFDK] Pemulihan integritas website'
            : '[UFDK] Perlu tindakan: integritas website';
        $body = "Waktu: ".now()->toDateTimeString()."\n\n".
            "Pemulihan:\n".($repairs === [] ? '- Tidak ada' : '- '.implode("\n- ", $repairs))."\n\n".
            "Peringatan:\n".($alerts === [] ? '- Tidak ada' : '- '.implode("\n- ", $alerts));

        try {
            Mail::raw($body, fn ($mail) => $mail->to(config('integrity.report_to'))->subject($subject));
        } catch (\Throwable $exception) {
            Log::error('Integrity report email failed.', ['exception' => $exception->getMessage()]);
            $this->warn('Laporan email gagal dikirim; periksa konfigurasi MAIL_* di .env.');
        }
    }
}
