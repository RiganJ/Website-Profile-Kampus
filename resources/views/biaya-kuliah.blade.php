@extends('layouts.main')

@section('title', 'Rincian Biaya Studi Mahasiswa Baru T.A. 2026/2027')

@push('head')
    <style>{!! file_get_contents(resource_path('css/style.css')) !!}</style>
    <style>
        .biaya-page { padding-top: 6.5rem; }
        @media print {
            .biaya-page { padding-top: 0; }
            #navbar, #liveChatWidget, .site-footer { display: none !important; }
        }
    </style>
@endpush

@section('content')
    <div class="biaya-page">
        <div class="print-header-kop">
            <div class="print-kop-container">
                <img src="{{ asset('images/logoufdk.png') }}" alt="Logo Universitas Fort De Kock" class="print-kop-logo">
                <div class="print-kop-text">
                    <h2 class="print-kop-univ">UNIVERSITAS FORT DE KOCK BUKITTINGGI</h2>
                    <p class="print-kop-sub">PENERIMAAN MAHASISWA BARU (PMB) TAHUN AKADEMIK 2026/2027</p>
                    <p class="print-kop-meta">Akreditasi Institusi: <strong>UNGGUL &amp; BAIK SEKALI</strong></p>
                    <p class="print-kop-address">Jl. Soekarno Hatta No. 11 Manggis Ganting, Bukittinggi | https://fdk.ac.id</p>
                </div>
            </div>
            <div class="print-kop-divider"><div class="divider-thick"></div><div class="divider-thin"></div></div>
        </div>

        <div class="page-container">
            <header class="doc-header-card">
                <div class="doc-header-inner">
                    <div class="doc-logo-column"><img src="{{ asset('images/logoufdk.png') }}" alt="Logo UFDK Bukittinggi" class="brand-logo-img"></div>
                    <div class="doc-content-column">
                        <div class="doc-top-bar">
                            <div class="doc-badges-group">
                                <span class="badge badge-akreditasi">Institusi Terakreditasi UNGGUL &amp; BAIK SEKALI</span>
                                <span class="badge badge-jenjang-s1">Tahun Akademik 2026/2027</span>
                                <span class="badge badge-program-reguler">Universitas Fort De Kock Bukittinggi</span>
                            </div>
                            <button type="button" class="btn-theme-switcher" id="theme-toggle-btn" title="Ganti Tema"><span>Mode Gelap</span></button>
                        </div>
                        <h1 class="doc-main-title">Rincian Biaya Studi Mahasiswa Baru <span class="accent">T.A. 2026/2027</span></h1>
                        <p class="doc-lead-paragraph">Pada Tahun Akademik 2026/2027, <strong>Universitas Fort De Kock (UFDK) Bukittinggi</strong> memberlakukan sistem pembiayaan pendidikan yang transparan, terpadu, dan berorientasi pada kemudahan calon mahasiswa baru.</p>
                        <p class="doc-lead-paragraph">Biaya pendidikan dapat diangsur secara fleksibel sebanyak <strong>6 tahap per semester</strong>. Rincian berikut mencakup Program Reguler maupun Program Non Reguler (RPL).</p>
                        <div class="doc-actions-row">
                            <button type="button" class="btn-download-pdf" onclick="window.print()" id="btn-cetak-pdf">Download / Cetak Dokumen PDF Resmi</button>
                            <a href="https://pmb.ufdk.ac.id/registrasi" target="_blank" rel="noopener" class="btn-pmb-link" id="btn-pmb-register">Daftar PMB Online UFDK</a>
                        </div>
                    </div>
                </div>
            </header>

            <section class="control-filter-card">
                <div class="filter-row-top">
                    <div class="jalur-pills-wrap">
                        <button type="button" class="jalur-tab-btn active" data-jalur="all">Semua Program &amp; Jalur</button>
                        <button type="button" class="jalur-tab-btn" data-jalur="reguler">Program Reguler</button>
                        <button type="button" class="jalur-tab-btn" data-jalur="rpl">Program Non Reguler (RPL)</button>
                    </div>
                    <div class="search-field-box">
                        <input type="text" id="search-input" placeholder="Cari prodi / kualifikasi..." autocomplete="off">
                        <button type="button" class="search-clear" id="search-clear-btn" style="display:none" title="Hapus pencarian">×</button>
                    </div>
                </div>
                <div class="filter-row-bottom">
                    <div class="dropdown-filters-group">
                        <select id="select-jenjang" class="custom-select" aria-label="Filter Jenjang"><option value="all">Semua Jenjang</option><option value="S2">S2 Magister</option><option value="S1">S1 Sarjana</option><option value="D3">D3 Diploma</option><option value="Profesi">Pendidikan Profesi</option></select>
                        <select id="select-bank" class="custom-select" aria-label="Filter Bank"><option value="all">Semua Bank Mitra</option><option value="BRI">Bank BRI</option><option value="NAGARI">Bank Nagari BPD</option></select>
                        <select id="select-sort" class="custom-select" aria-label="Urutkan"><option value="default">Urutan Standar Dokumen</option><option value="sem-asc">Biaya / Semester: Rendah ke Tinggi</option><option value="sem-desc">Biaya / Semester: Tinggi ke Rendah</option><option value="tahap-asc">Angsuran / Tahap: Terendah</option><option value="nama-asc">Nama Program Studi (A-Z)</option></select>
                    </div>
                    <button type="button" class="btn-reset-tool" id="btn-reset">Reset Filter</button>
                </div>
            </section>

            <div class="results-meta-bar"><div>Menampilkan <strong id="count-shown">0</strong> dari <strong id="count-total">0</strong> program studi &amp; jalur akademik</div><div class="text-xs text-muted">Gunakan tombol Salin pada rekening resmi prodi</div></div>
            <div class="table-card-wrapper" id="table-container-box">
                <table class="official-fee-table"><thead><tr><th rowspan="2">No</th><th rowspan="2">Program Studi</th><th rowspan="2">Pendidikan</th><th rowspan="2">Sistem Kuliah</th><th rowspan="2">Jumlah Semester</th><th rowspan="2">Jumlah Biaya Tiap Semester</th><th colspan="6" class="th-tahap-super">Perencanaan Pembayaran 6 Tahap (Per Semester)</th><th rowspan="2">Nomor Rekening Resmi &amp; Bank</th></tr><tr><th>Tahap I</th><th>Tahap II</th><th>Tahap III</th><th>Tahap IV</th><th>Tahap V</th><th>Tahap VI</th></tr></thead><tbody id="official-table-body"></tbody></table>
            </div>
            <div class="mobile-view-cards" id="mobile-cards-container"></div>
            <div id="empty-state" style="display:none;text-align:center;padding:3.5rem 1.5rem;background:var(--bg-surface);border:1px dashed var(--border-medium);border-radius:var(--radius-lg);margin-bottom:2rem"><h3 class="font-bold text-navy">Program Studi Tidak Ditemukan</h3><p class="text-muted text-xs">Tidak ada program yang sesuai dengan pencarian atau filter.</p><button type="button" class="btn-download-pdf" onclick="document.getElementById('btn-reset').click()">Reset Pencarian</button></div>

            <section class="doc-footer-info-card">
                <h2 class="doc-footer-heading">Ketentuan &amp; Tata Cara Pembayaran Biaya Pendidikan UFDK</h2>
                <ol class="doc-terms-list"><li><strong>Bank Pembayaran Resmi:</strong> pembayaran dilakukan melalui transfer ke rekening resmi Bank Nagari BPD atau BRI sesuai program studi.</li><li><strong>Fleksibilitas Angsuran:</strong> calon mahasiswa dapat membayar lunas atau melalui 6 tahap setiap semester.</li><li><strong>Kebijakan Finansial:</strong> pembayaran yang telah disetorkan tidak dapat ditarik kembali.</li><li><strong>Biaya Residensi, Tesis &amp; Wisuda:</strong> belum termasuk dalam biaya yang tercantum.</li></ol>
                <div class="doc-contact-box"><div><strong>Butuh Informasi Tambahan atau Konsultasi Anggaran?</strong><br><span class="text-xs text-muted">Panitia PMB UFDK siap membantu simulasi dan proses pendaftaran Anda.</span></div><a href="https://wa.me/628116607100" target="_blank" rel="noopener" class="btn-contact-wa">Konsultasi Admisi PMB (+62 811-6607-100)</a></div>
            </section>
        </div>
        <div class="toast-popup" id="toast-popup" role="status" aria-live="polite"><span id="toast-text">Nomor rekening berhasil disalin!</span></div>
    </div>
@endsection

@push('scripts')
    <script>{!! file_get_contents(resource_path('js/data-biaya.js')) !!}</script>
    <script>{!! file_get_contents(resource_path('js/app-biaya.js')) !!}</script>
@endpush
