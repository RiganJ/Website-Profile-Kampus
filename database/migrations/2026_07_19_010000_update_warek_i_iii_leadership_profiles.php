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

        $this->upsertProfile('warek-i', $this->warekIProfile());
        $this->upsertProfile('warek-iii', $this->warekIIIProfile());
    }

    public function down(): void
    {
        if (! Schema::hasTable('leadership_profiles')) {
            return;
        }

        DB::table('leadership_profiles')
            ->whereIn('slug', ['warek-i', 'warek-iii'])
            ->update([
                'email' => null,
                'phone' => null,
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
            'photo_path' => null,
            'created_at' => now(),
        ]);
    }

    private function warekIProfile(): array
    {
        return [
            'name' => 'Assoc. Prof. Dr. Nurhayati, S.ST, MKM, M.Biomed',
            'position' => 'Wakil Rektor I',
            'email' => 'nurhayati@fdk.ac.id',
            'summary' => 'Wakil Rektor I Bidang Akademik Universitas Fort de Kock, akademisi ilmu kesehatan dengan keahlian Kebidanan, Biomedis, Kesehatan Reproduksi, dan Kesehatan Masyarakat.',
            'sort_order' => 90,
            'academic_links' => [
                'sinta' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6649928',
                'google_scholar' => 'https://scholar.google.com/citations?user=p9bFMKIAAAAJ&hl=id',
                'orcid' => 'https://orcid.org/0009-0001-6515-9229',
            ],
            'content_data' => [
                'about' => 'Assoc. Prof. Dr. Nurhayati, S.ST., MKM, M.Biomed adalah akademisi di bidang ilmu kesehatan dengan keahlian pada Kebidanan, Biomedis, Kesehatan Reproduksi, dan Kesehatan Masyarakat. Aktif mengembangkan penelitian berbasis bukti (evidence-based) di bidang kesehatan ibu dan anak serta kesehatan reproduksi.',
                'jobs_title' => 'Capaian & Riwayat Jabatan',
                'publications_title' => 'Publikasi Penelitian (Scopus)',
                'identity' => [
                    ['label' => 'Nama Lengkap', 'value' => 'Assoc. Prof. Dr. Nurhayati, S.ST, MKM, M.Biomed'],
                    ['label' => 'NIDN', 'value' => '1022058101'],
                    ['label' => 'ID Sinta', 'value' => '6649928'],
                    ['label' => 'ORCID', 'value' => '0009-0001-6515-9229'],
                    ['label' => 'Google Scholar', 'value' => 'Lihat Profil Scholar'],
                    ['label' => 'Email', 'value' => 'nurhayati@fdk.ac.id'],
                    ['label' => 'Jabatan Fungsional', 'value' => 'Lektor Kepala / Associate Professor'],
                    ['label' => 'Jabatan Struktural', 'value' => 'Wakil Rektor I Bidang Akademik'],
                    ['label' => 'Institusi', 'value' => 'Universitas Fort de Kock Bukittinggi, Indonesia'],
                    ['label' => 'Bidang Keahlian', 'value' => 'Kebidanan, Biomedis, Kesehatan Reproduksi, Kesehatan Masyarakat'],
                ],
                'education' => [
                    ['year' => '2022', 'program' => 'Program Doktoral Kesehatan Masyarakat', 'institution' => 'Universitas Andalas, Padang'],
                    ['year' => '2011', 'program' => 'Magister Ilmu Biomedik (S2)', 'institution' => 'Universitas Andalas, Padang'],
                    ['year' => '2005', 'program' => 'Sarjana Bidan Pendidik (S1)', 'institution' => 'Universitas Padjajaran, Bandung'],
                ],
                'jobs' => [
                    ['period' => '2024 - Sekarang', 'position' => 'Sekretaris Jenderal Aliansi Perguruan Tinggi Kesehatan Indonesia'],
                    ['period' => '2019 - Sekarang', 'position' => 'Wakil Rektor I Bidang Akademik - Universitas Fort de Kock'],
                    ['period' => '2019 - Sekarang', 'position' => 'Ketua Senat Universitas Fort de Kock Bukittinggi'],
                    ['period' => '2017 - 2019', 'position' => 'Ketua STIKes Fort De Kock Health College, Bukittinggi'],
                    ['period' => '2010 - Sekarang', 'position' => 'BNSP Competency Assessor, Indonesia'],
                ],
                'research' => [],
                'achievements' => [],
                'publications' => [
                    ['year' => '2025', 'title' => 'Exploring the Causes of PLWHA Non-Adherence with Antiretroviral Therapy: A Phenomenological Study Post-Covid-19 Era', 'note' => 'Scopus Q1'],
                    ['year' => '2021', 'title' => 'The Description of Man Sex Man (MSM) Behavior in Bukittinggi City', 'note' => 'Scopus Q1'],
                    ['year' => '2022', 'title' => 'An Exploration of Male Sexual Behavior with MSM Sexual Orientation', 'note' => 'Scopus Q2'],
                    ['year' => '2018', 'title' => 'The Relationship between Sexual Behavior and the Prevalence of HIV/AIDS among Homosexual Men in Bukittinggi City', 'note' => 'Scopus Q3'],
                    ['year' => '2020', 'title' => 'Analysis of LGBT Factors in Religion, Law, Health, Psychology and Community Perspectives in Bukittinggi', 'note' => 'Scopus Q3'],
                ],
                'hki' => [],
                'community' => [
                    ['year' => '2024', 'title' => 'Pelatihan Deteksi Dini Penyakit Tidak Menular (PTM) bagi Kader Posyandu', 'role' => 'Ketua - Bukittinggi'],
                    ['year' => '2023', 'title' => 'Edukasi Kesehatan Reproduksi Remaja di Panti Asuhan Wilayah Agam', 'role' => 'Ketua - Kabupaten Agam'],
                    ['year' => '2022', 'title' => 'Penyuluhan Bahaya HIV/AIDS dan Napza bagi Komunitas Mahasiswa UFDK', 'role' => 'Ketua - UFDK Bukittinggi'],
                    ['year' => '2021', 'title' => 'Pemberdayaan Ibu Hamil dalam Deteksi Risiko Kehamilan Tinggi di Puskesmas Mandiangin', 'role' => 'Anggota - Bukittinggi'],
                ],
                'additional_sections' => [],
            ],
        ];
    }

    private function warekIIIProfile(): array
    {
        return [
            'name' => 'Ns. Ratna Dewi, S.Kep, M.Kep',
            'position' => 'Wakil Rektor III',
            'email' => 'ratna.dewi@fdk.ac.id',
            'summary' => 'Wakil Rektor III Bidang Kemahasiswaan, Inovasi & Kerja Sama Universitas Fort de Kock dengan kepakaran Manajemen Keperawatan.',
            'sort_order' => 70,
            'academic_links' => [],
            'content_data' => [
                'about' => null,
                'jobs_title' => 'Riwayat Jabatan',
                'publications_title' => 'Publikasi Penelitian (Pilihan)',
                'identity' => [
                    ['label' => 'Nama Lengkap', 'value' => 'Ns. Ratna Dewi, S.Kep, M.Kep'],
                    ['label' => 'NIDN', 'value' => '1025118302'],
                    ['label' => 'Bidang Kepakaran', 'value' => 'Manajemen Keperawatan'],
                    ['label' => 'Tempat / Tgl Lahir', 'value' => 'Bukittinggi, 25 November 1983'],
                    ['label' => 'Jenis Kelamin', 'value' => 'Perempuan'],
                    ['label' => 'Agama', 'value' => 'Islam'],
                    ['label' => 'Golongan / Pangkat', 'value' => 'III C / Penata'],
                    ['label' => 'Jabatan Fungsional', 'value' => 'Lektor'],
                    ['label' => 'Jabatan Struktural', 'value' => 'Wakil Rektor III Bidang Kemahasiswaan, Inovasi & Kerja Sama'],
                    ['label' => 'Institusi', 'value' => 'Universitas Fort de Kock Bukittinggi'],
                    ['label' => 'Email', 'value' => 'ratna.dewi@fdk.ac.id'],
                    ['label' => 'Alamat Kantor', 'value' => 'Jln. Soekarno Hatta, Kelurahan Manggis Ganting, Kecamatan Mandiangin Koto Selayan, Bukittinggi'],
                ],
                'education' => [
                    ['year' => '2024 - Sekarang', 'program' => 'Program Doktor (PhD) Keperawatan', 'institution' => 'Lincoln University'],
                    ['year' => '2014', 'program' => 'Magister Manajemen Keperawatan (S2)', 'institution' => 'Universitas Andalas'],
                    ['year' => '2008', 'program' => 'Profesi Ners', 'institution' => 'Sekolah Tinggi Ilmu Kesehatan Fort de Kock'],
                    ['year' => '2007', 'program' => 'Sarjana Keperawatan (S1)', 'institution' => 'Sekolah Tinggi Ilmu Kesehatan Fort de Kock'],
                    ['year' => '2005', 'program' => 'Diploma Keperawatan (D-III)', 'institution' => 'Akper Perintis Bukittinggi'],
                ],
                'jobs' => [
                    ['period' => '2024 - Sekarang', 'position' => 'Wakil Rektor III Bidang Kemahasiswaan, Inovasi & Kerja Sama - Universitas Fort de Kock'],
                    ['period' => '2020 - 2024', 'position' => 'Kaprodi Keperawatan - Universitas Fort de Kock'],
                    ['period' => '2018 - 2020', 'position' => 'Kadep DKKD Keperawatan - STIKes Fort de Kock'],
                    ['period' => '2013 - 2017', 'position' => 'Koordinator Profesi Keperawatan - STIKes Fort de Kock'],
                    ['period' => '2009 - 2013', 'position' => 'Koordinator Litbang Keperawatan - STIKes Fort de Kock'],
                ],
                'research' => [],
                'achievements' => [],
                'publications' => [
                    ['year' => '2025', 'title' => 'Self Management Education Model Based on Family Support on Quality of Life in Patients with Diabetes Mellitus', 'note' => 'Ketua'],
                    ['year' => '2024', 'title' => 'Benson Relaxation Techniques on Reducing Pain Scale and Sleep Quality in Post Appendectomy Patients', 'note' => 'Anggota'],
                    ['year' => '2022', 'title' => 'The Correlation Between Self-Efficacy and Self-Management for Elderly with Hypertension in Bukittinggi City', 'note' => 'Anggota'],
                    ['year' => '2020', 'title' => 'IMPLEMENTASI EVIDENCE BASED NURSING PADA PASIEN HIPERTENSI DAN REUMATOID ATRITIS: STUDI KASUS', 'note' => 'Ketua'],
                    ['year' => '2021', 'title' => 'Studi Fenomenologi Persepsi Masyarakat Dalam Penerapan Protokol Covid-19', 'note' => 'Ketua'],
                ],
                'hki' => [],
                'community' => [
                    ['year' => '2025', 'title' => 'PENGABMAS X DONOR DARAH "SETETES AKSI, SEJUTA ARTI"', 'role' => 'Lapang Wirabraja Bukittinggi'],
                    ['year' => '2024', 'title' => 'Penyuluhan Pencegahan Merokok', 'role' => 'SDN 08 Talao'],
                    ['year' => '2023', 'title' => 'Pendidikan Kesehatan Sehat bersama Diabetes Melitus', 'role' => 'RSUD M Natsir Solok'],
                    ['year' => '2022', 'title' => 'Istirahat dan Tidur Pada Remaja', 'role' => 'Pondok Pesantren Muallimin Bukittinggi'],
                    ['year' => '2021', 'title' => 'Sosialisasi Vaksinasi Dalam Penanganan Covid-19', 'role' => 'Universitas Fort De Kock'],
                    ['year' => '2020', 'title' => 'Edukasi Pencegahan Infeksi Virus Corona', 'role' => 'SMA N 5 Kota Bukittinggi'],
                    ['year' => '2019', 'title' => 'Pendidikan Kesehatan tentang Ansietas Pada Lansia', 'role' => 'Kelurahan Pakan Kurai Bukittinggi'],
                ],
                'additional_sections' => [],
            ],
        ];
    }

    private function renderContentHtml(array $contentData): string
    {
        $html = [];

        if (! empty($contentData['about'])) {
            $about = e($contentData['about']);
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
        $this->appendTable($html, $contentData['jobs_title'] ?? 'Riwayat Jabatan', ['Periode', 'Jabatan'], $contentData['jobs'] ?? [], ['period', 'position']);
        $this->appendList($html, $contentData['publications_title'] ?? 'Publikasi Penelitian', $contentData['publications'] ?? [], 'title', 'year', 'note');
        $this->appendTable($html, 'Pengabdian Masyarakat', ['Tahun', 'Judul Kegiatan', 'Keterangan'], $contentData['community'] ?? [], ['year', 'title', 'role']);

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

    private function appendList(array &$html, string $title, array $rows, string $mainKey, ?string $prefixKey = null, ?string $suffixKey = null): void
    {
        if (! $rows) {
            return;
        }

        $items = collect($rows)
            ->map(function (array $row) use ($mainKey, $prefixKey, $suffixKey) {
                $year = $prefixKey && filled($row[$prefixKey] ?? null)
                    ? '<span class="publication-meta">'.e($row[$prefixKey]).'</span>'
                    : '';
                $note = $suffixKey && filled($row[$suffixKey] ?? null)
                    ? '<span class="publication-note">'.e($row[$suffixKey]).'</span>'
                    : '';

                return '<li><div class="publication-title"><strong><em>'.e($row[$mainKey] ?? '').'</em></strong></div><div class="publication-badges">'.$year.$note.'</div></li>';
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
