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

        DB::table('leadership_profiles')
            ->updateOrInsert(
                ['slug' => 'warek-ii'],
                [
                    'name' => 'Dr. Zuraida, S.ST, M.Biomed',
                    'position' => 'Wakil Rektor II',
                    'email' => 'zuraida@fdk.ac.id',
                    'phone' => '+62 811-6607-200',
                    'summary' => 'Wakil Rektor II Bidang Umum, SDM & Keuangan Universitas Fort De Kock, PPID Utama UFDK, dengan bidang kepakaran Kesehatan Reproduksi.',
                    'content_html' => $this->profileContent(),
                    'academic_links' => json_encode([
                        'sinta' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6665952',
                        'google_scholar' => 'https://scholar.google.com/citations?user=xZVm9c0AAAAJ&hl=en&authuser=2',
                        'orcid' => 'https://orcid.org/0000-0002-1953-7559',
                    ]),
                    'sort_order' => 80,
                    'is_active' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
    }

    public function down(): void
    {
        if (! Schema::hasTable('leadership_profiles')) {
            return;
        }

        DB::table('leadership_profiles')
            ->where('slug', 'warek-ii')
            ->update([
                'email' => null,
                'phone' => null,
                'content_html' => null,
                'academic_links' => null,
                'updated_at' => now(),
            ]);
    }

    private function profileContent(): string
    {
        return <<<'HTML'
<section class="profile-block">
    <h2>Identitas Diri</h2>
    <div class="identity-grid">
        <div><span>Nama Lengkap</span><strong>Dr. Zuraida, S.ST, M.Biomed</strong></div>
        <div><span>NIDN</span><strong>1006088001</strong></div>
        <div><span>Bidang Kepakaran</span><strong>Kesehatan Reproduksi</strong></div>
        <div><span>Tempat / Tgl Lahir</span><strong>Duri, 08 Juni 1980</strong></div>
        <div><span>Jenis Kelamin</span><strong>Perempuan</strong></div>
        <div><span>Status</span><strong>Menikah</strong></div>
        <div><span>Kewarganegaraan</span><strong>Indonesia</strong></div>
        <div><span>Jabatan Fungsional</span><strong>Lektor Kepala (Associate Professor)</strong></div>
        <div><span>Pangkat / Golongan</span><strong>Penata Tk I, III/d</strong></div>
        <div><span>Jabatan Struktural</span><strong>Wakil Rektor II Bidang Umum, SDM & Keuangan</strong></div>
        <div><span>PPID</span><strong>PPID Utama Universitas Fort De Kock</strong></div>
        <div><span>Program Studi</span><strong>S1 Kebidanan, Universitas Fort De Kock</strong></div>
        <div><span>Email</span><strong>zuraida@fdk.ac.id</strong></div>
        <div><span>No. Telepon</span><strong>+62 811-6607-200</strong></div>
        <div><span>Alamat</span><strong>Jl. Soekarno Hatta No. 11, Kel. Manggis Ganting, Kec. Mandiangin Koto Selayan, Bukittinggi</strong></div>
    </div>
</section>

<section class="profile-block">
    <h2>Riwayat Pendidikan</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Jenjang / Program Studi</th><th>Institusi</th></tr></thead>
        <tbody>
            <tr><td>2024</td><td>Doktor (S3) - Ilmu Biomedik</td><td>Universitas Indonesia (UI)</td></tr>
            <tr><td>2015</td><td>Magister (S2) - Ilmu Biomedik</td><td>Universitas Andalas (UNAND)</td></tr>
            <tr><td>2005</td><td>D IV - Bidan Pendidik</td><td>Fakultas Kedokteran, Universitas Padjadjaran (UNPAD)</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Riwayat Pekerjaan & Jabatan</h2>
    <table>
        <thead><tr><th>Periode</th><th>Jabatan</th></tr></thead>
        <tbody>
            <tr><td>2024 - Sekarang</td><td><strong>Wakil Rektor II Bidang Umum, SDM & Keuangan, Universitas Fort De Kock</strong> dan PPID Utama UFDK</td></tr>
            <tr><td>2020 - 2024</td><td>Tugas Belajar (S3 Ilmu Biomedik, Universitas Indonesia)</td></tr>
            <tr><td>2019 - 2020</td><td>Kepala Bidang Akademik, Universitas Fort De Kock</td></tr>
            <tr><td>2018 - 2019</td><td>Direktur LSP P1 Fort De Kock, Bukittinggi</td></tr>
            <tr><td>2017 - 2018</td><td>Ketua Program Studi D IV Kebidanan, UFDK</td></tr>
            <tr><td>2015 - Sekarang</td><td>Asesor Kompetensi BNSP (Badan Nasional Sertifikasi Profesi)</td></tr>
            <tr><td>2012 - 2017</td><td>Ketua Program Studi D III Kebidanan</td></tr>
            <tr><td>2006 - 2009</td><td>Pembantu Direktur I Akademi Kebidanan</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Penelitian (5 Tahun Terakhir)</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Judul Penelitian</th><th>Pendanaan</th></tr></thead>
        <tbody>
            <tr><td>2025</td><td>Impact of Glutathione Supplementation in Cryopreservation Media on Spermatozoa Quality and Caspase-3 Expression: Relevance to Embryo Development</td><td>Mandiri</td></tr>
            <tr><td>2025</td><td>Comparison of DNA Extraction Feasibility from Menstrual Blood and Endometrial Tissue in Reproductive-Aged Women</td><td>DIPA UFDK</td></tr>
            <tr><td>2024</td><td>Effect of Glutathione in Cryoprotectant Modification on Tyrosine Phosphorylation, Acrosin Expression and Acrosome Reaction of Post-Thawing Spermatozoa</td><td>Mandiri</td></tr>
            <tr><td>2022</td><td>The Use of Antioxidant in Cryopreservation to Improve Spermatozoa Quality After Freezing-Thawing: A Review</td><td>Mandiri</td></tr>
            <tr><td>2020</td><td>Analysis of LGBT Factors in Religion, Law, Health, Psychology and Community Perspectives in Bukittinggi</td><td>DIPA UFDK</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Prestasi & Pencapaian</h2>
    <ul>
        <li><strong>2025</strong> - Hibah Publikasi Jurnal Internasional Bereputasi</li>
        <li><strong>2024</strong> - Menyelesaikan Pendidikan Doktor (S3) Ilmu Biomedik, Universitas Indonesia</li>
        <li><strong>2015 - Sekarang</strong> - Asesor Kompetensi Nasional (BNSP)</li>
    </ul>
</section>

<section class="profile-block">
    <h2>Publikasi Ilmiah Terkini</h2>
    <ul>
        <li><strong>2025</strong> - <em>Impact of Glutathione Supplementation in Cryopreservation Media on Spermatozoa Quality and Caspase-3 Expression: Relevance to Embryo Development</em> (SCOPUS Q3 - Under Review).</li>
        <li><strong>2025</strong> - <em>Comparison of DNA Extraction Feasibility from Menstrual Blood and Endometrial Tissue in Reproductive-Aged Women</em> (SINTA 2).</li>
        <li><strong>2024</strong> - <em>Effect of Glutathione Supplementation in Cryoprotectant Modification on Tyrosine Phosphorylation, Acrosin Expression and Acrosome Reaction of Post-Thawing Spermatozoa Quality</em> (SCOPUS Q3).</li>
        <li><strong>2022</strong> - <em>The Use of Antioxidant in Cryopreservation to Improve the Spermatozoa Quality After Freezing-Thawing: A Review</em> (International Journal).</li>
        <li><strong>2020</strong> - <em>Analysis of LGBT Factors in Religion, Law, Health, Psychology and Community Perspectives in Bukittinggi</em> (International Journal).</li>
        <li><strong>2020</strong> - <em>Pengaruh Kombinasi Yoga dan Aroma Terapi Lavender terhadap Tingkat Nyeri Dismenore pada Remaja Putri di Pondok Pesantren Sumatera Thawalib Parabek</em> (SINTA 5).</li>
    </ul>
</section>

<section class="profile-block">
    <h2>Perolehan HKI</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Judul</th><th>Jenis</th></tr></thead>
        <tbody>
            <tr><td>2025</td><td>Modul Praktikum Biologi Reproduksi dan Embriologi</td><td>Buku Ajar</td></tr>
            <tr><td>2024</td><td>Panduan Skrining Kesehatan Reproduksi Berbasis Komunitas</td><td>Buku Saku</td></tr>
            <tr><td>2023</td><td>Edukasi Kesehatan Reproduksi Remaja Berbasis Digital</td><td>Modul</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Pengabdian Masyarakat (5 Tahun Terakhir)</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Judul Kegiatan</th><th>Peran</th></tr></thead>
        <tbody>
            <tr><td>2025</td><td>Edukasi Kesehatan Reproduksi dan KB Berbasis Komunitas di Kelurahan Manggis Ganting Bukittinggi</td><td>Ketua</td></tr>
            <tr><td>2024</td><td>Penyuluhan Deteksi Dini Gangguan Kesuburan bagi Pasangan Usia Subur di Puskesmas Mandiangin</td><td>Ketua</td></tr>
            <tr><td>2023</td><td>Pelatihan Kader Posyandu dalam Pemantauan Kesehatan Reproduksi Ibu dan Remaja</td><td>Anggota</td></tr>
            <tr><td>2022</td><td>Sosialisasi Pencegahan Pernikahan Dini dan Dampak Kesehatan Reproduksi di SMA Kota Bukittinggi</td><td>Ketua</td></tr>
            <tr><td>2021</td><td>Edukasi COVID-19 dan Dampaknya terhadap Kesehatan Reproduksi Perempuan</td><td>Anggota</td></tr>
        </tbody>
    </table>
</section>

HTML;
    }
};
