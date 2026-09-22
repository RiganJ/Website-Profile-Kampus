<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leadership_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('position');
            $table->string('photo_path')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content_html')->nullable();
            $table->json('academic_links')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('leadership_profiles')->insert([
            'name' => 'Prof. Dr. Evi Hasnita, S.Pd, Ns, M.Kes',
            'slug' => 'rektor',
            'position' => 'Rektor',
            'photo_path' => 'images/rektor.jpg',
            'email' => 'evihasnita@fdk.ac.id',
            'phone' => '+62 813-6304-6204',
            'summary' => 'Rektor Universitas Fort De Kock periode 2023-2027, Guru Besar dengan bidang kepakaran Kesehatan Ibu & Anak.',
            'content_html' => $this->rectorContent(),
            'academic_links' => json_encode([
                'scopus' => 'https://www.scopus.com/authid/detail.uri?authorId=57204966245',
                'sinta' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6649937',
                'google_scholar' => 'https://scholar.google.com/citations?hl=en&user=b-6ir9QAAAAJ',
                'orcid' => 'https://orcid.org/0009-0004-7698-0153',
            ]),
            'sort_order' => 100,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('leadership_profiles');
    }

    private function rectorContent(): string
    {
        return <<<'HTML'
<section class="profile-block">
    <h2>Identitas Diri</h2>
    <div class="identity-grid">
        <div><span>Nama Lengkap</span><strong>Prof. Dr. Evi Hasnita, S.Pd, Ns, M.Kes</strong></div>
        <div><span>NIP / NIDN</span><strong>196212251982102001 / 0025126010</strong></div>
        <div><span>Jabatan Fungsional</span><strong>Guru Besar (Profesor)</strong></div>
        <div><span>Pangkat / Golongan</span><strong>Pembina Tk I, IV/b</strong></div>
        <div><span>Jabatan Struktural</span><strong>Rektor Universitas Fort De Kock (2023-2027)</strong></div>
        <div><span>Atasan PPID</span><strong>Atasan PPID Universitas Fort De Kock</strong></div>
        <div><span>Bidang Kepakaran</span><strong>Kesehatan Ibu & Anak</strong></div>
        <div><span>Program Studi</span><strong>Magister Kesehatan Masyarakat</strong></div>
        <div><span>Instansi</span><strong>Universitas Fort De Kock, Bukittinggi</strong></div>
        <div><span>Email</span><strong>evihasnita@fdk.ac.id</strong></div>
        <div><span>No. Telepon</span><strong>+62 813-6304-6204</strong></div>
        <div><span>Alamat</span><strong>Jl. Hercules No. 13, Dadok Tunggul Hitam, Padang, Indonesia</strong></div>
    </div>
</section>

<section class="profile-block">
    <h2>Riwayat Pendidikan</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Jenjang / Program Studi</th><th>Institusi</th></tr></thead>
        <tbody>
            <tr><td>2014</td><td>Doktor (S3) - Public Health</td><td>Universitas Gadjah Mada (UGM), Yogyakarta</td></tr>
            <tr><td>2008</td><td>Magister (S2) - Public Health</td><td>Universitas Gadjah Mada (UGM), Yogyakarta</td></tr>
            <tr><td>2006</td><td>Sarjana Keperawatan & Profesi Ners</td><td>Universitas Andalas (UNAND), Padang</td></tr>
            <tr><td>2001</td><td>Sarjana Manajemen Pendidikan</td><td>Universitas Andalas (UNAND), Padang</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Riwayat Pekerjaan & Jabatan</h2>
    <table>
        <thead><tr><th>Periode</th><th>Jabatan</th></tr></thead>
        <tbody>
            <tr><td>2023 - Sekarang</td><td><strong>Rektor Universitas Fort De Kock, Bukittinggi</strong> dan Atasan PPID UFDK</td></tr>
            <tr><td>2023 - Sekarang</td><td>Wakil Ketua I Bidang Pendidikan, Ikatan Bidan Indonesia (IBI) Bukittinggi</td></tr>
            <tr><td>2023 - Sekarang</td><td>Deputy Chairperson for Professional Certification</td></tr>
            <tr><td>2021 - Sekarang</td><td>Advisory Board, Indonesian Association of Professional Assessors (IASPRO) Region Sumatera Barat</td></tr>
            <tr><td>2019 - Sekarang</td><td>Master / Assessor Trainer, Badan Nasional Sertifikasi Profesi (BNSP)</td></tr>
            <tr><td>2019 - 2023</td><td>Rektor Universitas Fort De Kock (periode awal)</td></tr>
            <tr><td>2017 - 2019</td><td>Kepala Unit Pengawasan STIKes Fort De Kock, Bukittinggi</td></tr>
            <tr><td>2008 - 2016</td><td>Ketua STIKes Fort De Kock, Bukittinggi</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Penelitian (5 Tahun Terakhir)</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Judul Penelitian</th><th>Pendanaan</th></tr></thead>
        <tbody>
            <tr><td>2026</td><td>Model Pengembangan Aplikasi Smart Interactive untuk Peningkatan Kualitas Hidup Anak dengan Penyakit Kanker (lanjutan)</td><td>BIMA</td></tr>
            <tr><td>2025</td><td>Model Pengembangan Aplikasi Smart Interactive untuk Peningkatan Kualitas Hidup Anak dengan Penyakit Kanker</td><td>BIMA</td></tr>
            <tr><td>2013</td><td>Efektivitas Aromaterapi Lavender dan Terapi Musik terhadap Kualitas Tidur Lansia di PSTW Kasih Sayang Ibu Batusangkar</td><td>SIMLITABMAS</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Publikasi Ilmiah Terkini</h2>
    <ul>
        <li><strong>Comparison of DNA Extraction Feasibility from Menstrual Blood and Endometrial Tissue in Reproductive-Aged Women</strong> - <em>Jurnal Kesehatan</em>, Vol 16 Issue 2, 2025.</li>
        <li><strong>Implementation of Technology-Based Cooperative Information Systems: Reflections on the International PKM Visit</strong> - <em>Journal of Community Service and Application of Science</em>, Vol 4 Issue 1, 2025.</li>
        <li><strong>A Phenomenological Study of Domestic Violence and Its Impact on Women's Psychological and Reproductive Health in Solok City, Indonesia</strong> - <em>Bulletin of Inspiring Developments and Achievements in Midwifery</em>, Vol 2 Issue 2, 2025.</li>
        <li><strong>Exploring the Causes of PLWHA Non-Adherence with Antiretroviral Therapy: Implications for Practice in the Post-Covid-19 Era, a Phenomenological Study</strong> - <em>The Qualitative Report</em>, Vol 30 Issue 3, 2025.</li>
        <li><strong>Factors Influencing Non-Adherence to Antiretroviral Therapy Among HIV/AIDS Patients in Western Sumatra</strong> - <em>International Journal of Design & Nature and Ecodynamics</em>, Vol 19 No 1, 2024.</li>
        <li><strong>Faktor-faktor yang Mempengaruhi Kejadian Wasting pada Balita Usia 36-59 Bulan di Wilayah Kerja Puskesmas Rao Kabupaten Pasaman</strong> - <em>JIK Jurnal Ilmu Kesehatan</em>, Vol 7 Issue 1, 2023.</li>
        <li><strong>Inovasi Olahan PMT-P dari Kurma, Habbatussauda, dan Minyak Zaitun untuk Balita Gizi Kurang</strong> - <em>Maternal Child Health Care Journal</em>, Vol 3 Issue 1, 2023.</li>
        <li><strong>Analyzing Factors Affecting Stunting, Wasting, and Underweight in Toddlers in Padang Pariaman Regency</strong> - <em>Journal of Hunan University Natural Sciences</em>, Vol 49 Issue 12, 2022.</li>
    </ul>
</section>

<section class="profile-block">
    <h2>Perolehan HKI (5 Tahun Terakhir)</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Judul</th><th>Jenis</th><th>No. Pendaftaran</th></tr></thead>
        <tbody>
            <tr><td>2026</td><td>Smart Teen, Healthy Life</td><td>Buku</td><td>EC002026022602</td></tr>
            <tr><td>2025</td><td>Kesehatan Ibu dan Anak</td><td>Buku</td><td>EC002025096324</td></tr>
            <tr><td>2025</td><td>Strategi Parenting dalam Pencegahan dan Penanganan Stunting</td><td>Buku</td><td>EC002025168569</td></tr>
            <tr><td>2025</td><td>Panduan Fisioterapi untuk Lansia Aktif</td><td>Booklet</td><td>EC002025098374</td></tr>
            <tr><td>2024</td><td>Test of the Effectiveness of the Ethyl Acetate Fraction of Dayak Onion Bulbs (Eleutherine bulbosa) as an Antihypertensive</td><td>Jurnal</td><td>EC002025170263</td></tr>
            <tr><td>2024</td><td>Konsumsi Tablet Tambah Darah untuk Remaja Putri</td><td>Buku Saku</td><td>EC00202430562</td></tr>
        </tbody>
    </table>
</section>

<section class="profile-block">
    <h2>Pengabdian Masyarakat (5 Tahun Terakhir)</h2>
    <table>
        <thead><tr><th>Tahun</th><th>Judul Kegiatan</th><th>Peran</th></tr></thead>
        <tbody>
            <tr><td>2025</td><td>Penguatan Posyandu Prima melalui Edukasi Gizi dan Kesehatan Reproduksi Remaja di Wilayah Kota Bukittinggi</td><td>Ketua</td></tr>
            <tr><td>2025</td><td>Pendampingan Ibu Hamil Risiko Tinggi Berbasis Komunitas di Puskesmas Guguk Panjang</td><td>Anggota</td></tr>
            <tr><td>2024</td><td>Edukasi Deteksi Dini Kanker Serviks dan Kanker Payudara bagi Kader PKK Kota Bukittinggi</td><td>Ketua</td></tr>
            <tr><td>2023</td><td>Pelatihan Kader Posyandu dalam Pemantauan Tumbuh Kembang Balita di Kabupaten Agam</td><td>Ketua</td></tr>
            <tr><td>2023</td><td>Penyuluhan Pencegahan Stunting melalui Optimasi Pemberian Makanan Tambahan (PMT) bagi Ibu Hamil</td><td>Anggota</td></tr>
            <tr><td>2022</td><td>Sosialisasi Protokol Kesehatan Pasca Pandemi COVID-19 di Lingkungan Perguruan Tinggi dan Masyarakat</td><td>Ketua</td></tr>
        </tbody>
    </table>
</section>
HTML;
    }
};
