
{{-- resources/views/sejarah_full.blade.php --}}
@extends('layouts.main')

@section('title', 'Sejarah dan Perkembangan - Universitas Fort De Kock')


@push('head')
<style>
  :root{
    --fdk-orange:#F38020;
    --fdk-orange-dark:#d96c16;
    --metal-white: linear-gradient(180deg,#ffffff 0%, #f7f8fa 100%);
    --metal-border: rgba(0,0,0,0.06);
    --glass: rgba(255,255,255,0.64);
    --muted:#6b7280;
  }

  /* Buttons */
  .btn-fdk{
    background: var(--fdk-orange);
    color: #fff;
  }
  .btn-fdk:hover{ background: var(--fdk-orange-dark); }

  /* Metal/Glass cards */
  .card-metal{
    background: var(--metal-white);
    border: 1px solid var(--metal-border);
    box-shadow: 0 6px 20px rgba(14, 42, 64, 0.06);
    border-radius: 16px;
  }

  .glass-card{
    background: var(--glass);
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,0.4);
  }

  /* Timeline */
  .timeline {
    position: relative;
    padding-left: 2.25rem;
  }
  .timeline::before {
    content: '';
    position: absolute;
    left: 0.625rem;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg,#c8a14a,#F38020);
    border-radius: 9999px;
    box-shadow: 0 8px 30px rgba(243,128,32,0.08);
  }
  .timeline-item {
    position: relative;
    padding: 1rem 0 1rem 1.5rem;
  }
  .timeline-dot {
    position: absolute;
    left: -0.375rem;
    top: 1.1rem;
    width: 18px;
    height: 18px;
    border-radius: 9999px;
    background: linear-gradient(45deg,#F38020,#ff9a56);
    box-shadow: 0 6px 18px rgba(243,128,32,0.18);
    display:flex;align-items:center;justify-content:center;
  }

  /* Reveal on scroll */
  .reveal { opacity: 0; transform: translateY(24px) scale(.995); transition: all .7s cubic-bezier(.2,.9,.2,1); }
  .reveal-visible { opacity: 1; transform: translateY(0) scale(1); }

  /* Hero overlay/blur */
  .hero-bg { will-change: transform; transform-origin: center; }

  .prodi-showcase {
    position: relative;
    background:
      radial-gradient(circle at 12% 10%, rgba(243,128,32,.16), transparent 28%),
      radial-gradient(circle at 88% 18%, rgba(15,23,42,.10), transparent 28%),
      linear-gradient(180deg,#f8fafc 0%,#fff 100%);
    overflow: hidden;
  }

  .prodi-showcase::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(15,23,42,.045) 1px, transparent 1px),
      linear-gradient(90deg, rgba(15,23,42,.045) 1px, transparent 1px);
    background-size: 44px 44px;
    mask-image: linear-gradient(to bottom, transparent, black 18%, black 78%, transparent);
    pointer-events: none;
  }

  .prodi-modern-card {
    position: relative;
    min-height: 250px;
    border-radius: 24px;
    padding: 24px;
    background: rgba(255,255,255,.82);
    border: 1px solid rgba(226,232,240,.9);
    box-shadow: 0 18px 45px rgba(15,23,42,.08);
    backdrop-filter: blur(14px);
    overflow: hidden;
    transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
  }

  .prodi-modern-card::after {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    right: -70px;
    top: -70px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(243,128,32,.18), transparent 68%);
    transition: transform .35s ease, opacity .35s ease;
  }

  .prodi-modern-card:hover {
    transform: translateY(-7px);
    border-color: rgba(243,128,32,.35);
    box-shadow: 0 26px 60px rgba(15,23,42,.13);
  }

  .prodi-modern-card:hover::after {
    transform: scale(1.2);
    opacity: .9;
  }

  .prodi-icon-wrap {
    width: 54px;
    height: 54px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: linear-gradient(135deg,#0f172a,#334155);
    box-shadow: 0 14px 30px rgba(15,23,42,.18);
  }

  .akred-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    border-radius: 999px;
    padding: 7px 11px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .04em;
    text-transform: uppercase;
  }

  /* Modal long text */
  .modal-scroll { max-height: 75vh; overflow-y: auto; padding-right: 0.5rem; }

  /* responsive tweaks */
  @media (min-width: 1024px){
    .hero-title{ font-size: 3.25rem; }
  }
  /* ANIMASI SHINE EFFECT SUDAH ADA DI HTML */

/* SMOOTH SCROLL REVEAL (tanpa library tambahan) */
.sejarah-img,
#sejarah-section [data-aos] {
    transition: all 1s ease;
}

.sejarah-img.aos-animate {
    opacity: 1 !important;
    transform: translateX(0) !important;
}
/*section sejarah*/
    .metal-box {
        background: #ffffff;
        background: linear-gradient(145deg, #ffffff, #f2f2f2);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 
            0 4px 10px rgba(0,0,0,0.07),
            inset 0 0 8px rgba(255,255,255,0.6);
        border: 1px solid rgba(255,255,255,0.4);
        backdrop-filter: blur(4px);
    }

    /* Brushed metal effect */
    .metal-box {
        background-image: 
            linear-gradient(145deg, rgba(255,255,255,0.4), rgba(240,240,240,0.3)),
            repeating-linear-gradient(
                90deg,
                rgba(255,255,255,0.15) 0px,
                rgba(255,255,255,0.15) 1px,
                rgba(230,230,230,0.15) 3px
            );
    }
.hero-sambutan {
  position: relative;
  background:
    linear-gradient(180deg, rgba(3,10,30,.65), rgba(3,10,30,.75)),
    url('/images/banner-sambutan.jpg') center/cover no-repeat;
  height: 480px;
  overflow: hidden;
}

.hero-sambutan::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 30% 30%, rgba(255,255,255,.12), transparent 40%),
    radial-gradient(circle at 70% 60%, rgba(243,128,32,.18), transparent 45%);
}

.hero-sambutan::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 90px;
  background: linear-gradient(to bottom right, transparent 49%, #f9fafb 50%);
}

</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero-modern relative flex items-center h-[520px] overflow-hidden">

  <div class="absolute inset-0">
    <img src="/images/banner-sambutan.jpg" alt="Sejarah Universitas" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-b from-[rgba(3,10,30,.65)] to-[rgba(3,10,30,.75)]"></div>
    <div class="absolute inset-0 bg-[url('/images/pattern2.gif')] bg-repeat bg-[size:300px] opacity-10 pointer-events-none"></div>
  </div>

  <!-- Content -->
  <div class="relative z-10 w-full">
    <div class="max-w-7xl mx-auto px-6 text-center">

      <!-- Breadcrumb -->
      <nav class="hero-breadcrumb mb-6 text-sm text-gray-300 flex justify-center gap-2">
        <a href="{{ url('/') }}" class="transition hover:text-orange-400">Beranda</a>
        <span>/</span>
        <a href="{{ url('/sejarah') }}" class="active font-semibold text-orange-400">Sejarah</a>
      </nav>

      <!-- Title -->
      <h1 class="hero-title text-4xl md:text-5xl font-extrabold text-white tracking-tight">
        Sejarah dan Perkembangan<br>
        <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
          Universitas Fort De Kock
        </span>
      </h1>

      <!-- Subtitle -->
      <p class="hero-subtitle mt-4 text-gray-200 max-w-2xl mx-auto leading-relaxed">
        Jejak perjalanan Universitas Fort De Kock sebagai bagian dari
        tradisi pendidikan Kota Bukittinggi, dari gagasan awal hingga
        berkembang menjadi universitas multidisiplin.
      </p>

      <!-- Accent Line -->
      <div class="hero-line mt-8 mx-auto rounded-full bg-orange-500 h-1 w-20"></div>

    </div>
  </div>

  <!-- Scroll Indicator -->
  <div class="scroll-indicator absolute bottom-6 left-1/2 -translate-x-1/2">
    <span class="block w-6 h-10 border-2 border-white rounded-full relative">
      <span class="absolute top-2 left-1/2 w-1 h-2 bg-white rounded-full -translate-x-1/2 animate-bounce"></span>
    </span>
  </div>

</section>

<!-- SEJARAH (Modern Metal White + Scroll Reveal Image) -->
<section id="sejarah-section" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-14 items-center">

        <!-- FOTO DENGAN ANIMASI MASUK & SHINE EFFECT -->
        <div 
            class="relative opacity-0 sejarah-img translate-x-[-60px]"
            data-aos="fade-right"
        >
            <div class="group overflow-hidden rounded-2xl shadow-lg relative">
                <img 
                    src="/images/fortdekock.jpg" 
                    class="w-full object-cover rounded-2xl transition-transform duration-700 group-hover:scale-110"
                />

                <!-- SHINE EFFECT (GLINT) -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent 
                            transform -translate-x-full group-hover:translate-x-full duration-700">
                </div>
            </div>
        </div>

        <!-- TEKS SEJARAH (RINGKASAN) -->
        <div id="item" class="timeline-item bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-semibold text-blue-900 mb-5 font-merri">
                Sejarah Singkat Bukittinggi dan Asal Usul Nama "Fort De Kock"
            </h2>

            <div 
                class="text-gray-700 leading-relaxed space-y-4"
                style="font-family: var(--default-font); font-size: 16px; font-weight: 400; line-height: 1.6em;"
            >
                <p>
                    Bukittinggi adalah kota yang sangat penting dalam sejarah Indonesia mulai dari masa kolonial Belanda, pendudukan Jepang, hingga menjadi pusat pemerintahan darurat Republik Indonesia (PDRI) pada 1948-1949.
                </p>

                <p>
                    Pada tahun 1825, Belanda membangun sebuah benteng pertahanan yang diberi nama <b>Fort De Kock</b>. Benteng ini menjadi ikon sejarah kota dan simbol penting peran Bukittinggi sebagai pusat pemerintahan, pertahanan, dan pendidikan.
                </p>

                <p>
                    Julukan <b>Kota Pendidikan</b> juga melekat karena sejak zaman kolonial, daerah ini menjadi pusat lahirnya sekolah-sekolah penting seperti Sekolah Raja, Mosvia, Kweek School, dan bahkan cikal bakal Fakultas Kedokteran pertama.
                </p>

                <p>
                    Universitas Fort De Kock mengambil nama ini sebagai bentuk penghormatan terhadap perjalanan sejarah kota, sekaligus menjadi simbol keberlanjutan tradisi pendidikan yang telah berlangsung ratusan tahun di Bukittinggi.Dan Universitas Fort De Kock adalah wujud dari "Benteng Pendidikan"
                </p>
            </div>
        </div>
    </div>
</section>


<!-- TIMELINE MODERN DENGAN SHINE FOTO & GARIS ORANGE -->
<section id="founding" class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-10 relative">

    <!-- GARIS LIRIS ORANGE ANTARA TIMELINE DAN DAFTAR ISI -->
    <div class="hidden md:block absolute top-0 bottom-0 left-[66.66%] w-1 bg-gradient-to-b from-[#F38020] via-orange-300 to-[#F38020] rounded-full"></div>

    <!-- TIMELINE KIRI -->
    <div class="md:col-span-8 space-y-12">

      <!-- ITEM 2004 -->
      <div id="item-2004" class="space-y-4" data-aos="fade-up" data-aos-delay="100">
        <div>
          <div class="text-sm font-semibold text-[#F38020]">2004</div>
          <h4 class="text-lg font-semibold mt-1">Gagasan Awal & Rekomendasi</h4>
          <p class="text-gray-700 mt-2">
            Dalam rangka melestarikan marwah Bukittinggi sebagai Kota Pendidikan, gagasan diprakarsai oleh Drs. Zainal Abidin dan dr. Abdul Rival, M.Kes beserta kawan-kawan yang merupakan praktisi bidang kesehatan di Sumatera Barat. 
            Serta adanya dukungan dari Pemerintah Kota Bukittinggi (Walikota Drs. H. Djufri) yang merespon positif dan merekomendasikan nama Fort De Kock yang merupakan benteng peninggalan Belanda di kota Bukittinggi dengan harapan STIKes Fort De Kock dapat menjadi benteng pendidikan di Indonesia.
          </p>
        </div>
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl">
          <img 
            src="/images/awal.jpg" 
            alt="2004" 
            class="w-full h-[500px] md:h-[600px] object-cover transition-transform duration-700 group-hover:scale-110"
          >
          <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent transform -translate-x-full group-hover:translate-x-full duration-700"></div>
        </div>
      </div>

      <!-- ITEM 2006-2008 -->
      <div id="item-2006" class="space-y-4" data-aos="fade-up" data-aos-delay="200">
        <div>
          <div class="text-sm font-semibold text-[#F38020]">2004-2018</div>
          <h4 class="text-lg font-semibold mt-1">Pendirian & Pengembangan Prodi</h4>
          <p class="text-gray-700 mt-2">
            Pada awal pendirian, STIKes Fort De Kock memiliki dua program studi, yaitu Sarjana Ilmu Kesehatan Masyarakat dan Sarjana Ilmu Keperawatan. Pada tahun 2008, STIKes menambah Program Studi D3 Kebidanan, kemudian dilanjutkan dengan D3 Fisioterapi pada tahun 2010 melalui program alih kelola.
            Hingga tahun 2018, STIKes Fort De Kock telah memiliki sembilan program studi: Magister Kesehatan Masyarakat, Sarjana Kesehatan Masyarakat, Sarjana Keperawatan, Profesi Ners, Sarjana Kebidanan, Profesi Bidan, Sarjana Farmasi, Diploma III Fisioterapi, dan Diploma III Kebidanan.

          </p>
        </div>
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl">
          <img 
            src="/images/prodi.jpg" 
            alt="2006" 
            class="w-full h-[500px] md:h-[600px] object-cover transition-transform duration-700 group-hover:scale-110"
          >
          <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent transform -translate-x-full group-hover:translate-x-full duration-700"></div>
        </div>
      </div>

      <!-- ITEM 2011-2013 -->
      <div id="item-2011" class="space-y-4" data-aos="fade-up" data-aos-delay="300">
        <div>
          <div class="text-sm font-semibold text-[#F38020]">2005-2013</div>
          <h4 class="text-lg font-semibold mt-1">Pembelian Tanah & Pembangunan Kampus</h4>
          <p class="text-gray-700 mt-2">
            Yayasan Fort De Kock membeli sebidang tanah di Kecamatan Mandiangin Koto Selayan, Kota Bukittinggi, tepatnya di Kelurahan Manggis Ganting (Bukit Batarah) pada tahun 2005. Proses pembangunan dilaksanakan pada tahun 2011 hingga 2013, sehingga berdirilah sebuah kampus yang megah dan representatif sebagai sarana pendidikan yang berlokasi di pusat Kota Bukittinggi. Kampus milik sendiri ini dilengkapi dengan fasilitas pembelajaran yang modern, nyaman, 
            lengkap, dan memadai, serta menjadi salah satu ikon Kota Bukittinggi sebagai kota pendidikan.
          </p>
        </div>
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl">
          <img 
            src="/images/bangunan.jpeg" 
            alt="2011" 
            class="w-full h-[500px] md:h-[600px] object-cover transition-transform duration-700 group-hover:scale-110"
          >
          <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent transform -translate-x-full group-hover:translate-x-full duration-700"></div>
        </div>
      </div>

      <!-- ITEM 2019 -->
      <div id="item-2019" class="space-y-4" data-aos="fade-up" data-aos-delay="400">
        <div>
          <div class="text-sm font-semibold text-[#F38020]">2019</div>
          <h4 class="text-lg font-semibold mt-1">Perubahan Bentuk Menjadi Universitas</h4>
          <p class="text-gray-700 mt-2">
            Pada bulan April 2019, STIKes Fort De Kock mengusulkan perubahan bentuk menjadi 
            universitas kepada Kementerian Riset, Teknologi, dan Pendidikan Tinggi dengan penambahan program studi baru nonkesehatan, yaitu Program Studi S1 Bisnis Digital dan Program Studi S1 Kewirausahaan. Pada bulan Agustus 2019, terbit izin perubahan bentuk STIKes Fort De Kock menjadi universitas berdasarkan Surat Keputusan 786/KPT/I/2019.
          </p>
        </div>
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl">
          <img 
            src="/images/sejarah1.jpg" 
            alt="2019" 
            class="w-full h-[500px] md:h-[600px] object-cover transition-transform duration-700 group-hover:scale-110"
          >
          <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent transform -translate-x-full group-hover:translate-x-full duration-700"></div>
        </div>
      </div>

    </div>

   <!-- DAFTAR ISI KANAN -->
<div class="md:col-span-4 sticky top-32 self-start">
  <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
    <h4 class="text-xl font-semibold text-blue-900 mb-4">Daftar Isi Timeline</h4>

    <ul id="timeline-menu" class="space-y-4">

      <!-- Item -->
      <li>
        <a href="#item-2004" 
           data-target="item-2004"
           class="timeline-link flex items-center gap-3 group">
          
          <span class="arrow block w-3 h-3 border-r-2 border-b-2 border-gray-500 rotate-45 
                       transition-all duration-300 group-hover:border-[#F38020]"></span>

          <span class="text-gray-700 font-medium group-hover:text-[#F38020] transition-colors">
            2004: Gagasan Awal & Rekomendasi
          </span>
        </a>
      </li>

      <li>
        <a href="#item-2006" 
           data-target="item-2006"
           class="timeline-link flex items-center gap-3 group">

          <span class="arrow block w-3 h-3 border-r-2 border-b-2 border-gray-500 rotate-45 
                       transition-all duration-300 group-hover:border-[#F38020]"></span>

          <span class="text-gray-700 font-medium group-hover:text-[#F38020] transition-colors">
            2006-2008: Pendirian & Penambahan Prodi
          </span>
        </a>
      </li>

      <li>
        <a href="#item-2011" 
           data-target="item-2011"
           class="timeline-link flex items-center gap-3 group">

          <span class="arrow block w-3 h-3 border-r-2 border-b-2 border-gray-500 rotate-45
                       transition-all duration-300 group-hover:border-[#F38020]"></span>

          <span class="text-gray-700 font-medium group-hover:text-[#F38020] transition-colors">
            2011-2013: Pembelian Tanah & Pembangunan Kampus
          </span>
        </a>
      </li>

      <li>
        <a href="#item-2019" 
           data-target="item-2019"
           class="timeline-link flex items-center gap-3 group">

          <span class="arrow block w-3 h-3 border-r-2 border-b-2 border-gray-500 rotate-45 
                       transition-all duration-300 group-hover:border-[#F38020]"></span>

          <span class="text-gray-700 font-medium group-hover:text-[#F38020] transition-colors">
            2019: Transformasi Menjadi Universitas
          </span>
        </a>
      </li>

    </ul>
  </div>
</div>
  </div>
</section>


<!-- SECTION DIVIDER / PEMBATAS ANTAR SECTION -->
<div class="w-full h-6 bg-gradient-to-b from-gray-100 to-transparent"></div>

<!-- UNIVERSITAS SAAT INI -->
<section id="current" class="py-16 relative">

  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

      <!-- LEFT CARD -->
      <div class="lg:col-span-2 reveal card-metal p-10 rounded-3xl bg-white/80 
                  shadow-md backdrop-blur-md transition-all duration-300 hover:-translate-y-1"
           data-aos="fade-up">

        <h3 class="text-3xl font-semibold text-blue-900 font-merri">
          Universitas Fort De Kock
        </h3>

        <p class="mt-4 text-gray-700 leading-relaxed">
         Universitas Fort De Kock terus mengembangkan diri dengan berbagai bidang ilmu lainnya. Pada tahun 2024 kembali
          Universitas Fort De Kock menambah 3 program studi baru melalui program akselerasi dari kemenristekdikti yaitu Program Studi Psikologi, Program Studi Hukum 
          dan Program Studi Desain Komunikasi Visual. Kehadiran Universitas Fort De Kock di Kota Bukittinggi menjawab tantangan pendidikan sekaligus menguatkan kembali marwah Bukittinggi sebagai Kota Pendidikan. Hal ini sejalan dengan pengembangan pendidikan, kesehatan, dan peningkatan ekonomi daerah.
          Saat ini Universitas Fort De Kock telah menjalin kerja sama dengan berbagai pihak di tingkat nasional maupun internasional. Kerja sama yang dilaksanakan mencakup kegiatan Tri Dharma Perguruan Tinggi. 
          Hingga saat ini Universitas Fort De Kock memiliki {{ $prodiCards->count() }} program studi aktif.
   
        </p>

        <div class="mt-6">
          
        </div>
      </div>



    </div>
  </div>

</section>

<!-- SECTION DIVIDER / PEMBATAS BAWAH -->
<div class="w-full h-6 bg-gradient-to-t from-gray-100 to-transparent mt-10"></div>


<section id="prodi" class="prodi-showcase py-24">
  <div class="relative z-10 max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-[0.85fr_1.15fr] gap-10 items-end mb-12">
      <div>
        <span class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-4 py-2 text-xs font-bold uppercase tracking-[.2em] text-orange-700">
          <span class="h-2 w-2 rounded-full bg-orange-500"></span>
          Akademik Saat Ini
        </span>
        <h3 class="mt-5 text-4xl md:text-5xl font-extrabold text-slate-950 leading-tight">
          Program Studi
          <span class="block text-[#F38020]">Universitas Fort De Kock</span>
        </h3>
      </div>

    </div>

    <div class="space-y-12">
      @forelse($prodiGroups as $fakultasName => $programs)
        <div data-aos="fade-up">
          <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
              <p class="text-sm font-bold uppercase tracking-[.18em] text-[#F38020]">
                Fakultas
              </p>
              <h4 class="mt-1 text-2xl md:text-3xl font-extrabold text-slate-900">
                {{ $fakultasName }}
              </h4>
            </div>

            <span class="inline-flex w-max items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm ring-1 ring-slate-200">
              <i data-lucide="layers" class="h-4 w-4 text-[#F38020]"></i>
              {{ $programs->count() }} Program Studi
            </span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($programs as $p)
              @php
                $ak = $p['akred'];
                $akClass = match ($ak) {
                  'UNGGUL' => 'bg-amber-100 text-amber-800 ring-amber-200',
                  'BAIK SEKALI' => 'bg-sky-100 text-sky-800 ring-sky-200',
                  'BAIK' => 'bg-emerald-100 text-emerald-800 ring-emerald-200',
                  default => 'bg-slate-100 text-slate-600 ring-slate-200',
                };
              @endphp

              <article class="prodi-modern-card group">
                <div class="relative z-10 flex h-full flex-col">
                  <div class="flex items-start justify-between gap-4">
                    <div class="prodi-icon-wrap">
                      <i data-lucide="{{ $p['icon'] }}" class="h-7 w-7"></i>
                    </div>

                    <span class="akred-badge ring-1 {{ $akClass }}">
                      <i data-lucide="award" class="h-3.5 w-3.5"></i>
                      {{ $p['akred'] }}
                    </span>
                  </div>

                  <div class="mt-7">
                    <p class="text-sm font-semibold uppercase tracking-[.18em] text-slate-400">
                      {{ $p['jenjang'] }}
                    </p>
                    <a href="{{ $p['url'] }}" class="mt-2 block text-2xl font-bold text-slate-900 leading-snug transition hover:text-[#F38020]">
                      {{ $p['nama'] }}
                    </a>
                  </div>

                  <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                      <p class="text-slate-400">Status</p>
                      <p class="font-semibold text-slate-800">{{ $p['status'] }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                      <p class="text-slate-400">Tahun</p>
                      <p class="font-semibold text-slate-800">{{ $p['tahun'] ?? '-' }}</p>
                    </div>
                  </div>

                  @if(!empty($p['lembaga']))
                    <p class="mt-4 text-sm text-slate-500">
                      Lembaga akreditasi: <span class="font-semibold text-slate-700">{{ $p['lembaga'] }}</span>
                    </p>
                  @endif

                  <div class="mt-auto pt-7 flex flex-wrap items-center gap-3">
                    <a href="{{ $p['url'] }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#F38020]" aria-label="Lihat profil prodi {{ $p['nama'] }}">
                      Lihat Profil Prodi
                      <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                    </a>

                    @if(!empty($p['file_url']))
                      <a href="{{ $p['file_url'] }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#F38020] hover:text-[#F38020]">
                        File Akreditasi
                        <i data-lucide="file-text" class="h-4 w-4"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      @empty
        <div class="col-span-full rounded-3xl border border-slate-200 bg-white px-6 py-12 text-center text-slate-500 shadow-sm">
          Data program studi belum tersedia.
        </div>
      @endforelse
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script>
  // IntersectionObserver for reveal + lazy image
  document.addEventListener('DOMContentLoaded', function(){
    const revealEls = document.querySelectorAll('.reveal');
    const lazyImgs = document.querySelectorAll('.lazy-img');

    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if(entry.isIntersecting){
          entry.target.classList.add('reveal-visible');
          // lazy load images
          if(entry.target.tagName === 'IMG' && entry.target.dataset.src){
            entry.target.src = entry.target.dataset.src;
            entry.target.removeAttribute('data-src');
          }
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.18 });

    revealEls.forEach(el => io.observe(el));
    lazyImgs.forEach(img => io.observe(img));

    // init AOS (layout already loaded AOS script)
    if(window.AOS) AOS.init({ duration: 700, once: true, offset: 100 });

    // GSAP parallax for hero (if available)
    if(window.gsap && window.ScrollTrigger){
      gsap.registerPlugin(ScrollTrigger);
      gsap.to(".hero-bg", {
        yPercent: 12,
        ease: "none",
        scrollTrigger: {
          trigger: ".hero-bg",
          start: "top top",
          end: "bottom top",
          scrub: true
        }
      });
    }
  });

  // Modal functions
  function openSejarahModal(){
    document.getElementById('sejarahModal').classList.remove('hidden');
  }
  function closeSejarahModal(){
    document.getElementById('sejarahModal').classList.add('hidden');
  }

  // close modal Esc
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape'){
      closeSejarahModal();
    }
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const menuLinks = document.querySelectorAll(".timeline-link");

  const sections = [...menuLinks].map(link => {
    return document.getElementById(link.dataset.target);
  });

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const id = entry.target.id;

      const activeLink = document.querySelector(
        `.timeline-link[data-target="${id}"]`
      );

      if (entry.isIntersecting) {
        // remove highlight from all
        menuLinks.forEach(l => l.classList.remove("text-[#F38020]"));
        menuLinks.forEach(l => l.querySelector("span.arrow")
          .classList.remove("border-[#F38020]"));

        // add highlight
        activeLink.classList.add("text-[#F38020]");
        activeLink.querySelector("span.arrow")
          .classList.add("border-[#F38020]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(sec => observer.observe(sec));
});
</script>

@endpush

