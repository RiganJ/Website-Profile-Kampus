<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leadership_profiles')) {
            return;
        }

        $this->upsertProfile('dekan-fakultas-kesehatan', $this->healthFacultyDean());
        $this->upsertProfile('dekan-fakultas-sosial-ekonomi-dan-humaniora', $this->socialHumanitiesDean());
    }

    public function down(): void
    {
        if (! Schema::hasTable('leadership_profiles')) {
            return;
        }

        DB::table('leadership_profiles')
            ->whereIn('slug', ['dekan-fakultas-kesehatan', 'dekan-fakultas-sosial-ekonomi-dan-humaniora'])
            ->update([
                'email' => null,
                'phone' => null,
                'summary' => null,
                'content_html' => null,
                'content_data' => null,
                'academic_links' => null,
                'updated_at' => now(),
            ]);
    }

    private function upsertProfile(string $slug, array $profile): void
    {
        $values = [
            'name' => $profile['name'],
            'position' => $profile['position'],
            'photo_path' => $profile['photo_path'],
            'email' => $profile['email'] ?? null,
            'phone' => $profile['phone'] ?? null,
            'summary' => $profile['summary'],
            'content_html' => $this->renderContentHtml($profile['content_data']),
            'content_data' => json_encode($profile['content_data'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'academic_links' => json_encode($profile['academic_links'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'sort_order' => $profile['sort_order'],
            'is_active' => true,
            'updated_at' => now(),
        ];

        if (DB::table('leadership_profiles')->where('slug', $slug)->exists()) {
            DB::table('leadership_profiles')->where('slug', $slug)->update($values);

            return;
        }

        DB::table('leadership_profiles')->insert($values + [
            'slug' => $slug,
            'created_at' => now(),
        ]);
    }

    private function healthFacultyDean(): array
    {
        return [
            'name' => 'Ns. Wenny Lazdia, S.Kep, MAN, Ph.D',
            'position' => 'Dekan Fakultas Kesehatan',
            'photo_path' => 'images/dosen-176b2dfe-4c5b-457f-9787-e1b070f45a72.png',
            'email' => 'wenny.lazdia@fdk.ac.id',
            'phone' => '+62 821-7184-7111',
            'summary' => 'Dekan Fakultas Kesehatan Universitas Fort de Kock dengan kepakaran keperawatan dan perawatan luka.',
            'sort_order' => 60,
            'academic_links' => [],
            'content_data' => [
                'about' => '',
                'jobs_title' => 'Riwayat Jabatan',
                'publications_title' => 'Publikasi Penelitian (Pilihan)',
                'hki_title' => '',
                'identity' => [
                    ['label' => 'Nama Lengkap', 'value' => 'Ns. Wenny Lazdia, S.Kep, MAN, Ph.D'],
                    ['label' => 'Tempat / Tgl Lahir', 'value' => 'Padang, 9 Februari 1984'],
                    ['label' => 'Jenis Kelamin', 'value' => 'Perempuan'],
                    ['label' => 'Agama', 'value' => 'Islam'],
                    ['label' => 'Jabatan Struktural', 'value' => 'Dekan Fakultas Kesehatan (2026)'],
                    ['label' => 'Institusi', 'value' => 'Universitas Fort de Kock Bukittinggi'],
                    ['label' => 'Email', 'value' => 'wenny.lazdia@fdk.ac.id'],
                    ['label' => 'No. HP', 'value' => '+62 821-7184-7111'],
                ],
                'education' => [
                    ['year' => '2020 - 2025', 'program' => 'Program Doktor (Ph.D)', 'institution' => 'Lincoln University College, Selangor, Malaysia'],
                    ['year' => '2010 - 2012', 'program' => 'Master of Arts in Nursing (MAN)', 'institution' => "Philippines Women's University Manila, Philippines"],
                    ['year' => '2007 - 2008', 'program' => 'Profesi Ners', 'institution' => 'STIKes Fort de Kock'],
                    ['year' => '2005 - 2007', 'program' => 'Sarjana Keperawatan (S1)', 'institution' => 'STIKes Fort de Kock'],
                    ['year' => '2002 - 2005', 'program' => 'Diploma Keperawatan (D-III)', 'institution' => 'Akper Pemda / DIII Kep - UNP'],
                ],
                'jobs' => [
                    ['period' => '2026 - Sekarang', 'position' => 'Dekan Fakultas Kesehatan - Universitas Fort de Kock'],
                    ['period' => '2013 - 2019', 'position' => 'Ketua Program Studi Profesi Ners - STIKes Fort de Kock'],
                    ['period' => '2022 - Sekarang', 'position' => 'Owner Klinik Perawatan Luka - Alba Wound Care Center Bukittinggi'],
                    ['period' => '2019 - 2023', 'position' => 'Dekan Fakultas Ekonomi dan Bisnis (FEB) - Universitas Fort de Kock'],
                ],
                'research' => [],
                'achievements' => [
                    ['year' => '2025', 'description' => 'Gelar Doktor (Ph.D) Keperawatan - Program Internasional - Lincoln University College, Malaysia'],
                    ['year' => '2024', 'description' => 'Presenter International Conference on Nursing & Health Sciences - Kuala Lumpur, Malaysia'],
                    ['year' => '2019', 'description' => 'Asesor Kompetensi Bersertifikat BNSP - Bidang Keperawatan - Badan Nasional Sertifikasi Profesi (BNSP)'],
                    ['year' => '2024', 'description' => 'Dosen Berprestasi Bidang Wound Care - LPPM Universitas Fort de Kock'],
                ],
                'publications' => [
                    ['year' => '2025', 'title' => 'Effectiveness Combination of Infra Red Therapy, Ozone Therapy, and Olive Oil on Diabetes Foot Ulcer in Agam Health Center', 'note' => 'Malaysia'],
                    ['year' => '2024', 'title' => 'Efektivitas Lavender Essential Oil Terhadap Penyembuhan Luka Perineum Pada Ibu Nifas', 'note' => 'Sumatra Barat'],
                    ['year' => '2024', 'title' => 'Pengaruh Madu Akasia Terhadap Penyembuhan Luka Post Sectio Caesarea Pada Ibu Postpartum', 'note' => 'Sumatra Barat'],
                    ['year' => '2024', 'title' => 'The Effect Of Ozone Therapy On The Healing Process Of Diabetic Mellitus', 'note' => 'Malaysia'],
                    ['year' => '2024', 'title' => 'Pengaruh Pemberian Ekstrak Ikan Gabus (Oktabumin) Terhadap Pasien Luka Post Operasi Sectio Saecaria', 'note' => 'Sumatra Barat'],
                ],
                'hki' => [],
                'community' => [
                    ['year' => '2025', 'title' => 'Perawatan Luka Bagi Masyarakat Awam dan Tenaga Kesehatan', 'role' => 'Ketua - Bukittinggi'],
                    ['year' => '2024', 'title' => 'Perawatan Luka Diabetik - Penyuluhan untuk Tenaga Kesehatan', 'role' => 'Ketua - Puskesmas Kabupaten Agam'],
                    ['year' => '2024', 'title' => 'Pengaruh Madu Terhadap Penyembuhan Luka Sectio Caesarea pada Ibu Postpartum', 'role' => 'Anggota - Bukittinggi'],
                    ['year' => '2023', 'title' => 'Edukasi Pemanfaatan Lavender Essential Oil pada Luka Perineum Ibu Nifas', 'role' => 'Ketua - Bukittinggi'],
                    ['year' => '2022', 'title' => 'Pelatihan Perawatan Luka Modern (Moist Wound Healing) bagi Perawat Klinik', 'role' => 'Ketua - RS Yarsi Bukittinggi'],
                    ['year' => '2021', 'title' => 'Sosialisasi Penggunaan Ozone Therapy dalam Pengelolaan Luka Kronik', 'role' => 'Anggota - UFDK Bukittinggi'],
                ],
                'additional_sections' => [],
            ],
        ];
    }

    private function socialHumanitiesDean(): array
    {
        return [
            'name' => 'Rahmi Sari Kasoema, S.Psi, M.Kes',
            'position' => 'Dekan Fakultas Sosial, Ekonomi & Humaniora',
            'photo_path' => 'images/dosen-a13a1a6a-0aa1-4b0c-a399-f9a690028572.png',
            'email' => 'sarikasoema@fdk.ac.id',
            'phone' => null,
            'summary' => 'Dekan Fakultas Sosial, Ekonomi & Humaniora Universitas Fort de Kock dengan bidang psikologi dan kesehatan masyarakat.',
            'sort_order' => 50,
            'academic_links' => [
                'sinta' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6128252',
            ],
            'content_data' => [
                'about' => '',
                'jobs_title' => 'Riwayat Jabatan',
                'publications_title' => 'Publikasi Penelitian (Pilihan)',
                'hki_title' => 'Buku & Bahan Ajar',
                'identity' => [
                    ['label' => 'Nama Lengkap', 'value' => 'Rahmi Sari Kasoema, S.Psi, M.Kes'],
                    ['label' => 'NIDN', 'value' => '1008028502'],
                    ['label' => 'ID Sinta', 'value' => '6128252'],
                    ['label' => 'Tempat / Tgl Lahir', 'value' => 'Padang, 8 Februari 1985'],
                    ['label' => 'Jenis Kelamin', 'value' => 'Perempuan'],
                    ['label' => 'Agama', 'value' => 'Islam'],
                    ['label' => 'Golongan / Pangkat', 'value' => 'III/B'],
                    ['label' => 'Jabatan Akademik', 'value' => 'Lektor'],
                    ['label' => 'Jabatan Struktural', 'value' => 'Dekan Fakultas Sosial, Ekonomi & Humaniora'],
                    ['label' => 'Institusi', 'value' => 'Universitas Fort de Kock Bukittinggi'],
                    ['label' => 'Email', 'value' => 'sarikasoema@fdk.ac.id'],
                ],
                'education' => [
                    ['year' => 'Ongoing', 'program' => 'Doctoral Program of Psychology', 'institution' => 'Lincoln University College'],
                    ['year' => '2017', 'program' => 'Magister Ilmu Kesehatan Masyarakat (S2)', 'institution' => 'STIKes Fort de Kock - Jurusan Kesehatan Reproduksi'],
                    ['year' => '2008', 'program' => 'Sarjana Psikologi (S1)', 'institution' => 'UPI-YPTK'],
                ],
                'jobs' => [
                    ['period' => '2026 - 2030', 'position' => 'Dekan Fakultas Sosial, Ekonomi & Humaniora - Universitas Fort de Kock'],
                    ['period' => '2024 - 2026', 'position' => 'Ketua Program Studi Psikologi - Universitas Fort de Kock'],
                    ['period' => '2018 - 2023', 'position' => 'Ketua Lembaga Pusat Karir - Universitas Fort de Kock'],
                    ['period' => '2016 - 2018', 'position' => 'Bendahara Lembaga Pusat Karir - Universitas Fort de Kock'],
                    ['period' => '2012 - 2025', 'position' => 'Pengurus UPT-BK - Universitas Fort de Kock'],
                ],
                'research' => [],
                'achievements' => [
                    ['year' => '2024', 'description' => 'Penulis Buku Terbaik UFDK - Psikologi Kesehatan - Universitas Fort de Kock Bukittinggi'],
                    ['year' => '2024', 'description' => 'Presenter - IC-HSSM (International Conference of Health Science, Sustainability and Management) - STIKes Fort De Kock'],
                    ['year' => '2022', 'description' => 'Dosen Berprestasi Bidang Pengabdian Masyarakat - LPPM Universitas Fort de Kock'],
                ],
                'publications' => [],
                'hki' => [
                    ['year' => 'Oktober 2024', 'title' => 'Pengantar Psikologi Dan Pengembangan Kepribadian', 'type' => 'PT Global Eksekutif Teknologi', 'number' => ''],
                    ['year' => 'Desember 2024', 'title' => 'Psikologi Kesehatan', 'type' => 'PT Global Eksekutif Teknologi', 'number' => ''],
                    ['year' => 'Juni 2022', 'title' => 'Psikologi Perkembangan', 'type' => 'PT Global Eksekutif Teknologi', 'number' => ''],
                    ['year' => 'Maret 2021', 'title' => 'Asuhan Kebidanan Kehamilan Komprehensif', 'type' => 'Yayasan Kita Menulis', 'number' => ''],
                    ['year' => 'Februari 2021', 'title' => 'Psikologi Komunikasi', 'type' => 'Yayasan Kita Menulis', 'number' => ''],
                ],
                'community' => [
                    ['year' => '2025', 'title' => 'Pelatihan Manajemen Stres dan Kesehatan Mental bagi Tenaga Pendidik UFDK', 'role' => 'Ketua - Bukittinggi'],
                    ['year' => '2024', 'title' => 'Penyuluhan Kesehatan Mental Remaja dan Pencegahan Bullying di Sekolah Menengah', 'role' => 'Ketua - Bukittinggi'],
                    ['year' => '2023', 'title' => 'Edukasi Psikologi Positif dan Resiliensi bagi Mahasiswa Baru UFDK', 'role' => 'Anggota - UFDK Bukittinggi'],
                    ['year' => '2022', 'title' => 'Konseling Kelompok untuk Kader Posyandu dalam Menghadapi Masyarakat Rentan Stres', 'role' => 'Ketua - Kabupaten Agam'],
                ],
                'additional_sections' => [
                    [
                        'title' => 'Pelatihan & Konferensi Pilihan',
                        'body' => "2024 - Pelatihan TOT BNSP - LSP UFDK\n2024 - Pelatihan Clinical Instructor Kebidanan UFDK (Narasumber)\n2023 - Pelatihan TOT Pusat Karir - ECC UGM\n2017 - International Conference of Health Science, Sustainability and Management (IC-HSSM) - STIKes Fort De Kock",
                    ],
                ],
            ],
        ];
    }

    private function renderContentHtml(array $contentData): string
    {
        $html = [];

        if (filled($contentData['about'] ?? null)) {
            $about = nl2br(e($contentData['about']));
            $html[] = <<<HTML
<section class="profile-block">
    <h2>Tentang</h2>
    <p>{$about}</p>
</section>
HTML;
        }

        if (! empty($contentData['identity'])) {
            $items = collect($contentData['identity'])
                ->map(fn (array $row) => '<div><span>'.e($row['label']).'</span><strong>'.e($row['value']).'</strong></div>')
                ->implode("\n        ");

            $html[] = <<<HTML
<section class="profile-block">
    <h2>Identitas Diri</h2>
    <div class="identity-grid">
        {$items}
    </div>
</section>
HTML;
        }

        $this->appendTable($html, 'Riwayat Pendidikan', ['Tahun', 'Jenjang / Program Studi', 'Institusi'], $contentData['education'] ?? [], ['year', 'program', 'institution']);
        $this->appendTable($html, $contentData['jobs_title'] ?: 'Riwayat Pekerjaan & Jabatan', ['Periode', 'Jabatan'], $contentData['jobs'] ?? [], ['period', 'position']);
        $this->appendList($html, 'Prestasi & Pencapaian', $contentData['achievements'] ?? [], 'description', 'year');
        $this->appendPublicationList($html, $contentData['publications_title'] ?: 'Publikasi Ilmiah Terkini', $contentData['publications'] ?? []);
        $this->appendTable($html, $contentData['hki_title'] ?: 'Perolehan HKI', ['Waktu', 'Judul', 'Penerbit', 'Keterangan'], $contentData['hki'] ?? [], ['year', 'title', 'type', 'number']);
        $this->appendTable($html, 'Pengabdian Masyarakat', ['Tahun', 'Judul Kegiatan', 'Peran'], $contentData['community'] ?? [], ['year', 'title', 'role']);

        foreach ($contentData['additional_sections'] ?? [] as $section) {
            if (! filled($section['title'] ?? null) && ! filled($section['body'] ?? null)) {
                continue;
            }

            $title = e($section['title'] ?: 'Informasi Tambahan');
            $body = nl2br(e($section['body']));

            $html[] = <<<HTML
<section class="profile-block">
    <h2>{$title}</h2>
    <p>{$body}</p>
</section>
HTML;
        }

        return implode("\n\n", $html);
    }

    private function appendTable(array &$html, string $title, array $headers, array $rows, array $keys): void
    {
        if (! $rows) {
            return;
        }

        $headerHtml = collect($headers)
            ->map(fn (string $header) => '<th>'.e($header).'</th>')
            ->implode('');

        $rowHtml = collect($rows)
            ->map(function (array $row) use ($keys) {
                $cells = collect($keys)
                    ->map(fn (string $key) => '<td>'.e($row[$key] ?? '').'</td>')
                    ->implode('');

                return '<tr>'.$cells.'</tr>';
            })
            ->implode("\n            ");

        $title = e($title);

        $html[] = <<<HTML
<section class="profile-block">
    <h2>{$title}</h2>
    <table>
        <thead><tr>{$headerHtml}</tr></thead>
        <tbody>
            {$rowHtml}
        </tbody>
    </table>
</section>
HTML;
    }

    private function appendList(array &$html, string $title, array $rows, string $mainKey, ?string $prefixKey = null): void
    {
        if (! $rows) {
            return;
        }

        $items = collect($rows)
            ->map(function (array $row) use ($mainKey, $prefixKey) {
                $prefix = $prefixKey && filled($row[$prefixKey] ?? null)
                    ? '<strong>'.e($row[$prefixKey]).'</strong> - '
                    : '';

                return '<li>'.$prefix.e($row[$mainKey] ?? '').'</li>';
            })
            ->implode("\n        ");

        $title = e($title);

        $html[] = <<<HTML
<section class="profile-block">
    <h2>{$title}</h2>
    <ul>
        {$items}
    </ul>
</section>
HTML;
    }

    private function appendPublicationList(array &$html, string $title, array $rows): void
    {
        if (! $rows) {
            return;
        }

        $items = collect($rows)
            ->map(function (array $row) {
                $year = filled($row['year'] ?? null)
                    ? '<span class="publication-meta">'.e($row['year']).'</span>'
                    : '';
                $note = filled($row['note'] ?? null)
                    ? '<span class="publication-note">'.e($row['note']).'</span>'
                    : '';

                return '<li><div class="publication-title"><strong><em>'.e($row['title'] ?? '').'</em></strong></div><div class="publication-badges">'.$year.$note.'</div></li>';
            })
            ->implode("\n        ");

        $title = e($title);

        $html[] = <<<HTML
<section class="profile-block publication-block">
    <h2>{$title}</h2>
    <ul class="publication-list">
        {$items}
    </ul>
</section>
HTML;
    }
};
