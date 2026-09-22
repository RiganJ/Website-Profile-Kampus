<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leadership_profiles') || ! Schema::hasTable('dosens')) {
            return;
        }

        $this->seedProfile('warek-i', 'Wakil Rektor I', ['%Warek I%', '%Wakil Rektor I%'], 90);
        $this->seedProfile('warek-ii', 'Wakil Rektor II', ['%Warek II%', '%Wakil Rektor II%'], 80);
        $this->seedProfile('warek-iii', 'Wakil Rektor III', ['%Warek III%', '%Wakil Rektor III%'], 70);
    }

    public function down(): void
    {
        if (! Schema::hasTable('leadership_profiles')) {
            return;
        }

        DB::table('leadership_profiles')
            ->whereIn('slug', ['warek-i', 'warek-ii', 'warek-iii'])
            ->delete();
    }

    private function seedProfile(
        string $slug,
        string $position,
        array $patterns,
        int $sortOrder
    ): void {
        if (DB::table('leadership_profiles')->where('slug', $slug)->exists()) {
            return;
        }

        $dosenQuery = DB::table('dosens');

        $dosenQuery->where(function ($query) use ($patterns) {
            foreach ($patterns as $pattern) {
                $query->orWhere('jabatan', 'like', $pattern);
            }
        });

        $dosen = $dosenQuery->orderBy('nama')->first();

        DB::table('leadership_profiles')->insert([
            'name' => $dosen->nama ?? $position,
            'slug' => $slug,
            'position' => $position,
            'photo_path' => ! empty($dosen?->foto) ? 'images/' . basename($dosen->foto) : null,
            'email' => null,
            'phone' => null,
            'summary' => $this->summary($slug),
            'content_html' => null,
            'academic_links' => null,
            'sort_order' => $sortOrder,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function summary(string $slug): string
    {
        return match ($slug) {
            'warek-i' => 'Wakil Rektor Bidang Akademik bertanggung jawab dalam pengembangan kurikulum, mutu pembelajaran, penelitian, dan program akademik.',
            'warek-ii' => 'Wakil Rektor Bidang Umum, SDM, dan Keuangan mengelola sumber daya manusia, tata kelola keuangan, sarana dan prasarana kampus.',
            'warek-iii' => 'Wakil Rektor Bidang Kemahasiswaan, Inovasi, dan Kerjasama membina organisasi mahasiswa, prestasi, kewirausahaan, serta kolaborasi eksternal.',
            default => 'Informasi profil pimpinan akan segera dilengkapi.',
        };
    }
};
