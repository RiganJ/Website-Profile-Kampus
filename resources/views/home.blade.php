
@extends('layouts.main')

@section('title', 'Universitas Fort De Kock')

@push('head')
<link rel="stylesheet" href="{{ asset('build/assets/inspired-campus-ySr5PeYe.css') }}">

{{-- CSS khusus halaman home: ikut terbawa saat file ini disalin ke hosting. --}}
@push('head')
<style>
/* Hero full-width */
.hero-slider{width:100%;height:clamp(620px,100vh,860px);margin:0 0 56px;border-radius:0;background:#102a43}.hero-slider--medium{height:clamp(580px,92vh,780px)}.hero-slider--large{height:clamp(680px,100vh,900px)}.hero-section{align-items:center;border-radius:0;box-shadow:none}.hero-media,.hero-media-video{z-index:0}.hero-layer{z-index:1;background:linear-gradient(180deg,rgba(7,25,53,.18),rgba(7,25,53,.04) 36%,rgba(7,25,53,.78))}.hero-inner{position:absolute;left:50%;bottom:clamp(82px,13vh,142px);width:min(880px,calc(100% - 40px));max-width:none;padding:0;transform:translateX(-50%);text-align:center;color:#fff;z-index:2;text-shadow:0 3px 18px rgba(0,0,0,.5)}.hero-kicker{display:inline-block;margin-bottom:16px;color:#ffb36e;font-size:.76rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase}.hero-title{max-width:800px;margin:0 auto 16px;font-size:clamp(2.4rem,5vw,5rem);line-height:1.02;letter-spacing:-.065em}.hero-desc{max-width:680px;margin:0 auto;color:#f7f8fb;font-size:clamp(.95rem,1.35vw,1.13rem);line-height:1.65}.hero-action{display:flex;justify-content:center;align-items:center;flex-wrap:wrap;gap:14px;margin-top:28px}.hero-cta{display:inline-flex;align-items:center;gap:11px;padding:14px 21px;border-radius:999px;font-size:.9rem;font-weight:800}.hero-cta--primary{background:#f47511;color:#fff}.hero-cta--secondary{border:1px solid rgba(255,255,255,.62);background:rgba(15,23,42,.16);color:#fff}.hero-dots{bottom:clamp(26px,4vw,48px);z-index:3}
/* Statistik */
.statistics-section.campus-metrics-section{padding:62px 0!important;background:#fff!important;overflow:hidden}.metrics-feature-panel{width:100vw;margin-left:calc(50% - 50vw);padding:28px clamp(24px,7vw,120px);background:#f47511;color:#fff}.metrics-feature-panel>h2{margin:0 0 27px;text-align:center;color:#fff;font-size:clamp(1.45rem,2.5vw,2.05rem);font-weight:800}.metrics-feature-panel .metrics-highlights{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:0;margin:0}.metrics-feature-panel .metrics-highlight{padding:0 20px;background:transparent;box-shadow:none;color:#fff;display:flex;flex-direction:column;align-items:center;gap:12px;text-align:center}.metrics-feature-panel .metrics-highlight+.metrics-highlight{border-left:1px solid rgba(255,255,255,.22)}.metric-icon-line{display:flex;align-items:center;justify-content:center;gap:12px;width:100%}.metric-icon-line:before,.metric-icon-line:after{content:"";display:block;flex:1;max-width:70px;height:1px;background:rgba(255,255,255,.42)}.metrics-feature-panel .metric-icon-line i{width:42px;height:42px;display:grid;place-items:center;border-radius:50%;background:#fff;color:#f47511;font-size:16px}.metrics-feature-panel .metric-icon-line .fa-medal:before{content:"\f5a2"}.metrics-feature-panel .metric-icon-line .fa-handshake:before{content:"\f2b5"}.metrics-feature-panel .metric-icon-line .fa-briefcase:before{content:"\f0b1"}.metrics-feature-panel .metric-icon-line .fa-graduation-cap:before{content:"\f19d"}.metrics-feature-panel .metrics-highlight strong{font-size:clamp(1.65rem,3vw,2.5rem);font-weight:500;line-height:1;color:#fff}.metrics-feature-panel .metrics-highlight strong>.counter{display:inline;margin:0;font-size:inherit}.metrics-feature-panel .metrics-highlight span{display:block;margin-top:5px;color:rgba(255,255,255,.92);font-size:.76rem;font-weight:600}.metrics-facts{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));max-width:1240px;margin:52px auto 0;padding:0;gap:54px 68px}.metrics-facts article{display:flex;align-items:center;gap:18px;min-height:86px}.metrics-facts i{width:48px;height:48px;flex:0 0 48px;display:grid;place-items:center;color:#f47511;font-size:30px}.metrics-facts strong{font-size:clamp(2rem,2.8vw,2.7rem);line-height:1;color:#102a43}.metrics-facts article span{display:block;margin-top:7px;color:#68788b;font-size:.98rem}
/* Mitra kerja sama */
.legacy-partnership{display:none!important}.partnership-network-section{padding:92px 0;background:#fff}.partnership-network-head{display:flex;align-items:end;justify-content:space-between;gap:34px;padding-bottom:30px;border-bottom:1px solid #e5eaf0}.partnership-eyebrow{color:#f47511;font-size:.72rem;font-weight:800;letter-spacing:.18em}.partnership-network-head h2{margin:11px 0 0;color:#102a43;font-size:clamp(2.25rem,4vw,4rem);line-height:1}.partnership-network-head h2 em{color:#f47511;font-family:Merriweather,serif;font-weight:400}.partnership-summary{display:flex;align-items:center;gap:17px;max-width:370px}.partnership-summary strong{font-size:clamp(3rem,5vw,5rem);color:#102a43;line-height:.8}.partnership-summary sup{color:#f47511;font-size:.45em}.partnership-summary span{color:#617286;font-size:.88rem;line-height:1.6}.partnership-filters{display:flex;flex-wrap:wrap;gap:9px;margin:27px 0}.partnership-filters button{padding:9px 15px;border:1px solid #dce4ec;border-radius:999px;background:#fff;color:#617286;font-size:.78rem;font-weight:700}.partnership-filters button.active{border-color:#f47511;background:#f47511;color:#fff}.partnership-viewport{position:relative;overflow:hidden;padding:6px 0}.partnership-track{display:flex;gap:16px;width:max-content;animation:partnershipGlide 62s linear infinite}.partnership-viewport:hover .partnership-track{animation-play-state:paused}.partnership-card{width:278px;min-height:126px;padding:18px 20px;flex:0 0 278px;border:1px solid #e5eaf0;border-radius:18px;background:#fff;display:flex;align-items:center;gap:15px}.partnership-card.is-hidden{display:none}.partnership-logo{width:56px;height:56px;flex:0 0 56px;border-radius:14px;background:#f6f8fb;display:grid;place-items:center;overflow:hidden}.partnership-logo img{width:78%;height:78%;object-fit:contain}.partnership-logo span{font-size:1.25rem;font-weight:800;color:#f47511}.partnership-card h3{margin:0;color:#102a43;font-size:.94rem}.partnership-card p{margin:5px 0 0;color:#718196;font-size:.75rem}@keyframes partnershipGlide{from{transform:translateX(0)}to{transform:translateX(calc(-50% - 8px))}}
@media(max-width:680px){.hero-slider{height:clamp(540px,82vh,660px);margin-bottom:38px}.hero-inner{bottom:76px;width:calc(100% - 34px)}.hero-title{font-size:clamp(2.2rem,11vw,3.3rem)}.metrics-feature-panel{padding:24px 16px}.metrics-feature-panel .metrics-highlights,.metrics-facts{grid-template-columns:repeat(2,minmax(0,1fr))}.metrics-feature-panel .metrics-highlight{padding:0 10px}.metrics-feature-panel .metrics-highlight:nth-child(3){border-left:0}.metrics-feature-panel .metrics-highlight:nth-child(-n+2){padding-bottom:26px;border-bottom:1px solid rgba(255,255,255,.22)}.metrics-facts{margin-top:36px;gap:38px 22px}.metrics-facts article{min-height:66px;gap:11px}.metrics-facts i{width:35px;height:35px;flex-basis:35px;font-size:23px}.metrics-facts strong{font-size:1.65rem}.metrics-facts article span{font-size:.8rem}.partnership-network-section{padding:60px 0}.partnership-network-head{align-items:flex-start;flex-direction:column}.partnership-track{gap:11px;animation-duration:48s}.partnership-card{width:235px;min-height:108px;padding:15px;flex-basis:235px}}
</style>

@endpush

@section('content')

{{-- ================= HERO BANNER ================= --}}
@php
    $heroDimension = $slides->first()->banner_dimension ?? 'compact';
@endphp

<section class="hero-slider hero-slider--{{ $heroDimension }}">

@foreach($slides->take(4) as $slide)
<div class="hero-section hero-slide">

    @php
        $mediaFit = $slide->media_fit ?? 'cover';
        $mediaPosition = $slide->media_position ?? 'center center';
        $mediaBackgroundSize = $mediaFit == 'fill' ? 'cover' : $mediaFit;
        $mediaObjectFit = $mediaFit == 'fill' ? 'cover' : $mediaFit;
        $mediaUrl = $slide->media_url;
    @endphp

    {{-- MEDIA --}}
    @if($slide->media_type == 'image')
        <div class="hero-media"
             style="background-image:url('{{ $mediaUrl }}'); background-position:{{ $mediaPosition }}; background-size:{{ $mediaBackgroundSize }}; background-repeat:no-repeat;">
        </div>
    @else
        @php
            $videoMime = str_ends_with(strtolower($slide->media_path), '.webm') ? 'video/webm' : 'video/mp4';
        @endphp
        <video class="hero-media-video"
               style="object-fit:{{ $mediaObjectFit }}; object-position:{{ $mediaPosition }};"
               autoplay muted loop playsinline>
            <source src="{{ $mediaUrl }}" type="{{ $videoMime }}">
        </video>
    @endif

    <div class="hero-layer {{ $mediaFit == 'contain' ? 'hero-layer--soft' : '' }}"></div>

<div class="hero-inner">
    <span class="hero-kicker">Universitas Fort De Kock</span>
    @if($slide->title)
        <h1 class="hero-title hero-pop">{{ $slide->title }}</h1>
    @endif
    @if($slide->description)
        <p class="hero-desc hero-pop">{{ $slide->description }}</p>
    @endif
    <div class="hero-action hero-pop">
        <a href="https://pmb.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="hero-cta hero-cta--primary">Daftar Sekarang <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        <a href="/prodi" class="hero-cta hero-cta--secondary">Lihat Program Studi <i class="fa-solid fa-arrow-right"></i></a>
    </div>
</div>
</div>
@endforeach

<div class="hero-dots"></div>

</section>
<section class="py-20 bg-gray-50 relative overflow-hidden">

  <!-- BACKGROUND PATTERN -->
  <div class="absolute inset-0 bg-repeat bg-[size:300px] opacity-10" style="background-image: url('{{ asset('images/pattern2.jpg') }}')"></div>

  <div class="container mx-auto px-6 relative z-10">

    <!-- INFORMASI + FOTO -->
    <div class="grid md:grid-cols-2 gap-14 items-center mb-20">

      <div class="relative group overflow-hidden rounded-2xl shadow-xl reveal-left">
        <img src="{{ asset('images/gedungrektorat.png') }}"
             class="w-full h-full object-cover">

    <div class="shine-effect"></div>
</div>

      <!-- INFORMASI LEBIH MENARIK -->
      <div class="reveal-right">
<h2 class="text-3xl md:text-4xl font-bold mb-6 leading-snug">
  <span class="text-[#FF7F11]">Transformasi</span> Pendidikan untuk Masa Depan Gemilang
</h2>

        <p class="text-gray-600 leading-relaxed mb-6">
          Dengan kurikulum berbasis industri dan dukungan dosen profesional,
          kami menghadirkan sistem pendidikan modern yang berorientasi pada
          praktik dan pengembangan karakter mahasiswa.
        </p>

               </div>
      </div>

    </div>
<section class="statistics-section campus-metrics-section">
    <div class="container">
        <div class="metrics-feature-panel">
            <h2>Fakta Universitas Fort De Kock</h2>
        <div class="metrics-highlights">
            <article class="metrics-highlight"><span class="metric-icon-line"><i class="fa-solid fa-medal"></i></span><div><strong>Baik Sekali</strong><span>Akreditasi Institusi</span></div></article>
            <article class="metrics-highlight"><span class="metric-icon-line"><i class="fa-solid fa-handshake"></i></span><div><strong><span class="counter">{{ $statistics['mitra_kerjasama'] }}</span></strong><span>Mitra Kerja Sama</span></div></article>
            <article class="metrics-highlight"><span class="metric-icon-line"><i class="fa-solid fa-briefcase"></i></span><div><strong><span class="counter">92</span>%</strong><span>Alumni Berkarier</span></div></article>
            <article class="metrics-highlight"><span class="metric-icon-line"><i class="fa-solid fa-graduation-cap"></i></span><div><strong><span class="counter">100</span>%</strong><span>Lulusan Bersertifikasi</span></div></article>
        </div>
        </div>

        <div class="metrics-facts">
            <article><i class="fa-solid fa-book-open"></i><div><strong><span class="counter">{{ $statistics['prodi'] }}</span></strong><span>Program Studi</span></div></article>
            <article><i class="fa-solid fa-person-chalkboard"></i><div><strong><span class="counter">{{ $statistics['dosen'] }}</span></strong><span>Dosen</span></div></article>
            <article><i class="fa-solid fa-award"></i><div><strong><span class="counter">400</span>+</strong><span>Penerima Beasiswa</span></div></article>
            <article><i class="fa-solid fa-users"></i><div><strong><span class="counter">3500</span>+</strong><span>Mahasiswa Aktif</span></div></article>
            <article><i class="fa-solid fa-user-graduate"></i><div><strong><span class="counter">{{ $statistics['guru_besar'] }}</span></strong><span>Guru Besar</span></div></article>
            <article><i class="fa-solid fa-shield-heart"></i><div><strong><span class="counter">100</span>%</strong><span>Mahasiswa Diasuransikan</span></div></article>
            <article><i class="fa-solid fa-people-group"></i><div><strong><span class="counter">5000</span>+</strong><span>Alumni</span></div></article>
            <article><i class="fa-solid fa-flask"></i><div><strong><span class="counter">8</span>+</strong><span>Laboratorium</span></div></article>
        </div>
    </div>
</section>
<section class="faculty-section relative overflow-hidden bg-[#FF7F0E]">

    <!-- PATTERN BACKGROUND -->
    <div
        class="absolute inset-0 z-0 pointer-events-none
               bg-[url('/images/patternbaru.png')]
               bg-repeat
               bg-[length:500px_500px]
               bg-center
               opacity-25">
    </div>

    <!-- CONTENT -->
    <div class="container relative z-10">

        <!-- FAKULTAS KESEHATAN -->
        <div class="faculty-item reveal-left">

            <div class="faculty-text">

                <span class="faculty-label">
                    Fakultas
                </span>

                <h2 class="faculty-heading">
                    Ilmu Kesehatan
                    <span class="faculty-abbr">(FIK)</span>
                </h2>

                <div class="faculty-divider"></div>

                <p>
                    Fakultas Ilmu Kesehatan berkomitmen mencetak tenaga profesional
                    di bidang kesehatan yang kompeten, berintegritas, dan siap
                    bersaing di tingkat nasional maupun internasional.
                </p>

                <!-- BUTTON -->
                <div class="hero-action">

                    <a href="https://ufdk.ac.id/fakultas/kesehatan"
                       class="group relative w-52 h-12
                              bg-white/20 backdrop-blur-md
                              rounded-full overflow-hidden
                              flex items-center justify-between
                              px-6 text-slate-800">

                        <!-- Hover Background -->
                        <span
                            class="absolute inset-0
                                   bg-[#0F172A]
                                   scale-x-0 origin-left
                                   transition-transform duration-500
                                   ease-out
                                   group-hover:scale-x-100">
                        </span>

                        <!-- Text -->
                        <span
                            class="relative z-10
                                   text-sm font-medium
                                   transition-colors duration-300
                                   group-hover:text-white">
                            Lihat Program Studi
                        </span>

                        <!-- Icon -->
                        <i
                            data-lucide="arrow-up-right"
                            class="relative z-10 w-5 h-5
                                   transition-all duration-300
                                   group-hover:rotate-45
                                   group-hover:translate-x-1
                                   group-hover:text-white">
                        </i>

                    </a>

                </div>

            </div>

            <div class="faculty-image">
                <img
                    src="images/fik.png"
                    alt="Fakultas Kesehatan"
                >
            </div>

        </div>


        <!-- FAKULTAS HUMANIORA -->
        <div class="faculty-item reverse reveal-right">

            <div class="faculty-text">

                <span class="faculty-label">
                    Fakultas
                </span>

                <div class="faculty-title flex items-start gap-3">

                    <i
                        class="fa-solid fa-book-open
                               text-2xl flex-shrink-0 mt-1">
                    </i>

                    <h2 class="faculty-heading">
                        Sosial Ekonomi dan Humaniora
                        <span class="faculty-abbr">(FSEH)</span>
                    </h2>

                </div>

                <div class="faculty-divider"></div>

                <p>
                    Fakultas Humaniora menghadirkan pendidikan berbasis
                    nilai kemanusiaan, budaya, dan komunikasi untuk
                    menghasilkan lulusan yang adaptif dan inovatif.
                </p>

                <!-- BUTTON -->
                <div class="hero-action">

                    <a href="https://ufdk.ac.id/fakultas/sosial-ekonomi-humaniora"
                       class="group relative w-52 h-12
                              bg-white/20 backdrop-blur-md
                              rounded-full overflow-hidden
                              flex items-center justify-between
                              px-6 text-slate-800">

                        <!-- Hover Background -->
                        <span
                            class="absolute inset-0
                                   bg-[#0F172A]
                                   scale-x-0 origin-left
                                   transition-transform duration-500
                                   ease-out
                                   group-hover:scale-x-100">
                        </span>

                        <!-- Text -->
                        <span
                            class="relative z-10
                                   text-sm font-medium
                                   transition-colors duration-300
                                   group-hover:text-white">
                            Lihat Program Studi
                        </span>

                        <!-- Icon -->
                        <i
                            data-lucide="arrow-up-right"
                            class="relative z-10 w-5 h-5
                                   transition-all duration-300
                                   group-hover:rotate-45
                                   group-hover:translate-x-1
                                   group-hover:text-white">
                        </i>

                    </a>

                </div>

            </div>

            <div class="faculty-image">
                <img
                    src="images/fseh2.jpg"
                    alt="Fakultas Sosial Ekonomi dan Humaniora"
                >
            </div>

        </div>

    </div>

</section>
<section class="relative py-24 bg-white overflow-hidden">

<!-- Background Pattern -->
<div class="absolute inset-0 bg-[url('/images/pattern.png')] bg-repeat opacity-30"></div>

<div class="container mx-auto px-6 relative z-10">

<div class="grid md:grid-cols-2 items-center gap-14">

<!-- TEXT -->
<div class="reveal-up">
<h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6 leading-tight">
Mulai Perjalanan <span class="text-[#FF7F11]">Pendidikanmu</span> Bersama Kami
</h2>

<p class="text-gray-600 max-w-xl mb-10 text-lg">
Bergabunglah dengan ribuan mahasiswa yang telah mempercayakan
masa depan pendidikan mereka bersama kampus kami.
Raih pengalaman belajar terbaik dan siapkan dirimu
untuk dunia profesional.
</p>

<!-- Buttons -->
<div class="flex flex-col sm:flex-row gap-6">

<!-- Button Daftar -->
           <a href="https://pmb.ufdk.ac.id/"
   class="group relative w-50 h-14 bg-white/20 border border-slate-300 backdrop-blur-md rounded-full overflow-hidden
          flex items-center justify-between px-6 text-slate-800 gap-3">

    <!-- Background Hover Layer -->
    <span class="absolute inset-0 bg-[#f47511] 
                 scale-x-0 origin-left
                 transition-transform duration-500 ease-out
                 group-hover:scale-x-100">
    </span>

    <!-- Text -->
    <span class="relative z-10 text-sm font-medium transition-colors duration-300 group-hover:text-white">
        Daftar Sekarang
    </span>

    <!-- Icon -->
    <i data-lucide="arrow-up-right"
       class="relative z-10 w-5 h-5 transition-all duration-300 
              group-hover:rotate-45 group-hover:translate-x-1 
              group-hover:text-white">
    </i>

</a>

<!-- Button Info -->
<a href="#"
class="group relative w-50 h-14 border border-slate-300 rounded-full overflow-hidden
flex items-center justify-between px-6 text-slate-800 gap-4">

    <!-- Background Hover -->
    <span class="absolute inset-0 bg-slate-900
                 scale-x-0 origin-left
                 transition-transform duration-500 ease-out
                 group-hover:scale-x-100">
    </span>

    <!-- Text -->
    <span class="relative z-10 text-sm font-medium transition-colors duration-300 group-hover:text-white">
        Lihat Informasi
    </span>

    <!-- Icon -->
    <i class="fa-solid fa-circle-info relative z-10 transition-colors duration-300 group-hover:text-white"></i>

</a>

</div>

</div>


<!-- FOTO MODEL -->
<!-- FOTO MODEL -->
<div class="relative flex justify-center reveal-up">
<img src="/images/pmb.png"
class="relative z-4 w-[260px] md:w-[420px] object-contain">

<!-- Glow Shape -->
<div class="absolute -bottom-10 -right-10 w-90 h-90 bg-[#FF7F11]/10 rounded-full blur-3xl"></div>

</div>


</div>

</div>

</section>
</section>

<section class="relative py-16 bg-[#e96f0c] overflow-hidden">

<div class="container mx-auto px-6">

<!-- TOP AREA -->
<div class="grid md:grid-cols-2 gap-16 items-start mb-16">

<!-- LEFT : HEADER -->
<div class="max-w-xl text-white reveal-up">
<span class="uppercase tracking-[3px] text-xs font-semibold text-white/70">
 Informasi Terbaru Kampus
</span>

<h2 class="text-4xl md:text-5xl font-bold mt-4 mb-5 leading-tight">
Update <span class="text-[#0F172A]">Kampus</span>
</h2>

<div class="w-20 h-[3px] bg-white/60 mb-6 rounded"></div>

<p class="text-white/90 text-lg leading-relaxed">
Dapatkan berbagai informasi terbaru seputar kegiatan kampus,
prestasi mahasiswa, serta perkembangan penelitian dari civitas
akademika yang terus berkontribusi bagi masyarakat dan dunia pendidikan.
</p>

</div>


<!-- RIGHT : FEATURED NEWS -->
<div class="bg-white rounded-2xl overflow-hidden shadow-lg reveal-up">
<div class="relative overflow-hidden">

@php
    $featuredNewsImage = $featuredNews?->thumbnail
        ? $featuredNews->thumbnail_url
        : asset('images/news1.jpg');
    $beritaItem = $latestBerita;
    $beritaImage = $beritaItem?->thumbnail
        ? $beritaItem->thumbnail_url
        : asset('images/news1.jpg');
    $prestasiItem = $latestPrestasi;
    $prestasiImage = $prestasiItem?->thumbnail
        ? $prestasiItem->thumbnail_url
        : asset('images/news2.jpg');
    $risetItem = $latestRiset;
    $risetImage = $risetItem?->thumbnail
        ? $risetItem->thumbnail_url
        : asset('images/news3.jpg');
@endphp
<img src="{{ $featuredNewsImage }}"
alt="{{ $featuredNews?->judul ?? 'Berita unggulan' }}"
class="w-full h-64 object-cover">

<div class="shine"></div>

</div>

<div class="p-6">

<span class="text-xs font-semibold text-[#e96f0c] uppercase">
{{ $featuredNews ? ucfirst($featuredNews->kategori) . ' Unggulan' : 'Berita Unggulan' }}
</span>

<h3 class="text-xl font-bold text-slate-900 mt-2 mb-3">
{{ $featuredNews?->judul ?? 'Berita unggulan akan tampil di sini.' }}
</h3>

<p class="text-gray-600 text-sm mb-4">
{{ $featuredNews?->konten ? \Illuminate\Support\Str::limit(strip_tags($featuredNews->konten), 120) : 'Konten berita terbaru akan otomatis tampil setelah data berita tersedia di database.' }}
</p>

<a href="{{ $featuredNews ? route('artikel.show', $featuredNews->slug) : route('berita.index') }}" class="text-[#e96f0c] font-semibold text-sm">
Baca Selengkapnya →
</a>

</div>

</div>

</div>



<!-- NEWS GRID -->
<div class="grid md:grid-cols-3 gap-14 items-start">

<!-- BERITA -->
<div class="space-y-6 reveal-left">

<div class="flex items-center gap-3 text-white">
<div class="w-10 h-[2px] bg-white"></div>
<span class="uppercase text-sm tracking-widest">Berita Terbaru</span>
</div>

<div class="news-card">

<div class="news-image">
<img src="{{ $beritaImage }}" alt="{{ $beritaItem?->judul ?? 'Berita terbaru' }}">
<div class="shine"></div>
</div>

<div class="news-body">

<p class="news-date">{{ $beritaItem?->tanggal ? \Carbon\Carbon::parse($beritaItem->tanggal)->translatedFormat('d F Y') : '-' }}</p>

<h3 class="news-title">
{{ $beritaItem?->judul ?? 'Belum ada berita terbaru' }}
</h3>

<p class="news-desc">
{{ $beritaItem?->konten ? \Illuminate\Support\Str::limit(strip_tags($beritaItem->konten), 95) : 'Data berita kategori berita akan tampil otomatis di bagian ini.' }}
</p>

<a href="{{ $beritaItem ? route('artikel.show', $beritaItem->slug) : route('berita.terbaru') }}" class="news-link">
Baca Selengkapnya →
</a>

</div>

</div>

</div>



<!-- PRESTASI -->
<div class="space-y-6 md:mt-16 reveal-up">

<div class="flex items-center gap-3 text-white">
<div class="w-10 h-[2px] bg-white"></div>
<span class="uppercase text-sm tracking-widest">Prestasi Terbaru</span>
</div>

<div class="news-card">

<div class="news-image">
<img src="{{ $prestasiImage }}" alt="{{ $prestasiItem?->judul ?? 'Prestasi terbaru' }}">
<div class="shine"></div>
</div>

<div class="news-body">

<p class="news-date">{{ $prestasiItem?->tanggal ? \Carbon\Carbon::parse($prestasiItem->tanggal)->translatedFormat('d F Y') : '-' }}</p>

<h3 class="news-title">
{{ $prestasiItem?->judul ?? 'Belum ada prestasi terbaru' }}
</h3>

<p class="news-desc">
{{ $prestasiItem?->konten ? \Illuminate\Support\Str::limit(strip_tags($prestasiItem->konten), 95) : 'Data berita kategori prestasi akan tampil otomatis di bagian ini.' }}
</p>

<a href="{{ $prestasiItem ? route('artikel.show', $prestasiItem->slug) : route('berita.prestasi') }}" class="news-link">
Baca Selengkapnya →
</a>

</div>

</div>

</div>



<!-- PENELITIAN -->
<div class="space-y-6 md:mt-32 reveal-right">

<div class="flex items-center gap-3 text-white">
<div class="w-10 h-[2px] bg-white"></div>
<span class="uppercase text-sm tracking-widest">Penelitian Terbaru</span>
</div>

<div class="news-card">

<div class="news-image">
<img src="{{ $risetImage }}" alt="{{ $risetItem?->judul ?? 'Penelitian terbaru' }}">
<div class="shine"></div>
</div>

<div class="news-body">

<p class="news-date">{{ $risetItem?->tanggal ? \Carbon\Carbon::parse($risetItem->tanggal)->translatedFormat('d F Y') : '-' }}</p>

<h3 class="news-title">
{{ $risetItem?->judul ?? 'Belum ada penelitian terbaru' }}
</h3>

<p class="news-desc">
{{ $risetItem?->konten ? \Illuminate\Support\Str::limit(strip_tags($risetItem->konten), 95) : 'Data berita kategori riset akan tampil otomatis di bagian ini.' }}
</p>

<a href="{{ $risetItem ? route('artikel.show', $risetItem->slug) : route('berita.riset') }}" class="news-link">
Baca Selengkapnya →
</a>

</div>

</div>

</div>

</div>

</div>

</section>
@php
    $partnerCategories = $partnerItems->pluck('category')->filter()->unique()->take(5)->values();
@endphp

<section class="pt-8 pb-16 bg-white overflow-hidden partner-collaboration-section">
    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-16 items-center mb-14">
            <div class="reveal-left">
                <span class="uppercase tracking-[4px] text-xs text-slate-500 font-semibold">
                    Mitra Kerja Sama
                </span>

                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-3">
                    Institusi & <span class="text-[#e96f0c]">Partner</span>
                </h2>

                <p class="text-gray-600 mt-5 max-w-xl leading-relaxed">
                    Universitas Fort De Kock menjalin kemitraan strategis dengan berbagai
                    institusi untuk memperluas akses pendidikan, memperkuat kolaborasi riset,
                    serta meningkatkan kualitas lulusan yang siap berkontribusi bagi masyarakat.
                </p>

                <div class="mt-8 border-l-4 border-[#e96f0c] pl-5 max-w-xl">
                    <p class="text-slate-800 font-medium">
                        “Kolaborasi yang kuat menjadi fondasi pendidikan yang inovatif
                        dan berkelanjutan.”
                    </p>
                </div>
            </div>

            <div id="chartdiv"></div>
        </div>
    </div>

    <div class="partner-rail-container">
        <div class="container mx-auto px-6">
            <div class="partnership-filters" role="group" aria-label="Filter kategori mitra">
                <button type="button" class="active" data-partner-filter="all">Semua Mitra</button>

                @foreach($partnerCategories as $category)
                    <button type="button" data-partner-filter="{{ \Illuminate\Support\Str::slug($category) }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="partnership-viewport">
            @if($partnerItems->isNotEmpty())
                <div class="partnership-track">
                    @for($copy = 0; $copy < 2; $copy++)
                        @foreach($partnerItems as $partner)
                            <article
                                class="partnership-card"
                                data-partner-category="{{ \Illuminate\Support\Str::slug($partner['category']) }}"
                                @if($copy === 1) aria-hidden="true" @endif
                            >
                                <div class="partnership-logo">
                                    @if(!empty($partner['logo']))
                                        <img src="{{ $partner['logo'] }}" alt="Logo {{ $partner['name'] }}">
                                    @else
                                        <span>
                                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($partner['name'], 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <h3>{{ $partner['name'] }}</h3>
                                    <p>{{ $partner['category'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    @endfor
                </div>
            @else
                <div class="partnership-empty">
                    <i class="fa-solid fa-handshake"></i>
                    Data mitra kerja sama belum tersedia.
                </div>
            @endif
        </div>
    </div>
</section>

<style>
.partner-rail-container{
    margin-top:36px;
    border-top:1px solid #e5eaf0;
}

.partnership-filters{
    display:flex;
    flex-wrap:wrap;
    gap:9px;
    padding:26px 0 34px;
}

.partnership-filters button{
    padding:9px 15px;
    border:1px solid #dce4ec;
    border-radius:999px;
    background:#fff !important;
    color:#617286 !important;
    font-size:.78rem;
    font-weight:700;
}

.partnership-filters button.active{
    border-color:#f47511 !important;
    background:#f47511 !important;
    color:#fff !important;
}

.partnership-viewport{
    position:relative;
    overflow:hidden;
    padding:6px 0 16px;
}

.partnership-viewport::before,
.partnership-viewport::after{
    content:"";
    position:absolute;
    z-index:2;
    top:0;
    width:70px;
    height:100%;
    pointer-events:none;
}

.partnership-viewport::before{
    left:0;
    background:linear-gradient(to right,#fff,transparent);
}

.partnership-viewport::after{
    right:0;
    background:linear-gradient(to left,#fff,transparent);
}

.partnership-track{
    display:flex;
    gap:14px;
    width:max-content;
    animation:partnershipGlide 62s linear infinite;
    will-change:transform;
}

.partnership-viewport:hover .partnership-track{
    animation-play-state:paused;
}

.partnership-card{
    width:278px;
    min-height:112px;
    padding:14px 18px;
    flex:0 0 278px;
    display:flex;
    align-items:center;
    gap:14px;
    border:1px solid #e2e8f0;
    border-radius:17px;
    background:#fff;
    box-shadow:0 8px 20px rgba(15,23,42,.04);
}

.partnership-card.is-hidden{
    display:none;
}

.partnership-logo{
    width:56px;
    height:56px;
    flex:0 0 56px;
    display:grid;
    place-items:center;
    overflow:hidden;
    border-radius:14px;
    background:#f6f8fb;
}

.partnership-logo img{
    width:78%;
    height:78%;
    object-fit:contain;
}

.partnership-logo span{
    color:#f47511;
    font-size:1.2rem;
    font-weight:800;
}

.partnership-card h3{
    margin:0;
    color:#102a43;
    font-size:.96rem;
    font-weight:800;
    line-height:1.35;
}

.partnership-card p{
    margin:4px 0 0;
    color:#718196;
    font-size:.78rem;
}

.partnership-empty{
    padding:25px;
    color:#617286;
    text-align:center;
}

@keyframes partnershipGlide{
    from { transform:translateX(0); }
    to { transform:translateX(calc(-50% - 7px)); }
}

@media(max-width:768px){
    .partnership-card{
        width:235px;
        min-height:100px;
        padding:12px 15px;
        flex-basis:235px;
    }

    .partnership-logo{
        width:48px;
        height:48px;
        flex-basis:48px;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll("[data-partner-filter]");
    const partnerCards = document.querySelectorAll(".partnership-card");

    filterButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const filter = button.dataset.partnerFilter;

            filterButtons.forEach(function (item) {
                item.classList.toggle("active", item === button);
            });

            partnerCards.forEach(function (card) {
                card.classList.toggle(
                    "is-hidden",
                    filter !== "all" && card.dataset.partnerCategory !== filter
                );
            });
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function(){

let slides = document.querySelectorAll(".hero-slide");
let dotsContainer = document.querySelector(".hero-dots");
let current = 0;
let interval = 7000;
let sliderInterval;

function createDots(){
    slides.forEach((_,i)=>{
        let dot = document.createElement("span");
        dot.addEventListener("click",()=>{
            showSlide(i);
            resetSlider();
        });
        dotsContainer.appendChild(dot);
    });
}

function updateDots(){
    let dots = document.querySelectorAll(".hero-dots span");
    dots.forEach(dot=>dot.classList.remove("active"));
    dots[current].classList.add("active");
}

function showSlide(index){
    slides[current].classList.remove("active");
    current = index;
    slides[current].classList.add("active");
    updateDots();
}

function nextSlide(){
    let next = (current + 1) % slides.length;
    showSlide(next);
}

function startSlider(){
    sliderInterval = setInterval(nextSlide, interval);
}

function resetSlider(){
    clearInterval(sliderInterval);
    startSlider();
}

createDots();
slides[0].classList.add("active");
updateDots();
startSlider();

});
</script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script>

am5.ready(function () {

var root = am5.Root.new("chartdiv");

root.setThemes([
am5themes_Animated.new(root)
]);

// =======================
// DATA MITRA
// =======================

var data = @json($partnerChartData);

// =======================
// WARNA OTOMATIS
// =======================

var palette = [
am5.color(0xe96f0c),
am5.color(0x2563eb),
am5.color(0x0f766e),
am5.color(0x7c3aed),
am5.color(0x047857),
am5.color(0xb45309)
];

data.forEach(function(d, index){

var color = palette[index % palette.length];

d.columnSettings = {
fill: color,
stroke: am5.color(0xffffff),
strokeWidth: 1.5,
fillOpacity: 0.95
};

d.labelSettings = {
fill: am5.color(0x0f172a)
};

});

// =======================
// CHART
// =======================

var chart = root.container.children.push(
am5radar.RadarChart.new(root,{
panX:false,
panY:false,
wheelX:"none",
wheelY:"none",
innerRadius:am5.percent(20),
startAngle:-90,
endAngle:180
})
);

// =======================
// CURSOR POINTER (EFEK SPEEDOMETER)
// =======================

var cursor = chart.set("cursor",
am5radar.RadarCursor.new(root,{
behavior:"none"
})
);

cursor.lineY.set("visible",false);


// =======================
// AXIS
// =======================

var xRenderer = am5radar.AxisRendererCircular.new(root,{});

xRenderer.labels.template.setAll({
radius:10,
fill:am5.color(0x475569),
fontSize:12
});

xRenderer.grid.template.setAll({
forceHidden:true
});

// compute max full value from data so axis scales dynamically
var maxFull = 1;
if (Array.isArray(data) && data.length) {
maxFull = Math.max.apply(null, data.map(function(d){ return d.full || 0; }));
if (!maxFull || maxFull < 1) maxFull = 1;
}

var xAxis = chart.xAxes.push(
am5xy.ValueAxis.new(root,{
renderer:xRenderer,
min:0,
max:maxFull,
strictMinMax:true,
numberFormat:"#",
tooltip:am5.Tooltip.new(root,{})
})
);



var yRenderer = am5radar.AxisRendererRadial.new(root,{
minGridDistance:20
});

yRenderer.labels.template.setAll({
centerX:am5.p100,
fontWeight:"500",
fontSize:16,
templateField:"labelSettings"
});

yRenderer.grid.template.setAll({
forceHidden:true
});

var yAxis = chart.yAxes.push(
am5xy.CategoryAxis.new(root,{
categoryField:"category",
renderer:yRenderer
})
);

yAxis.data.setAll(data);


// =======================
// BACKGROUND SERIES
// =======================

var series1 = chart.series.push(
am5radar.RadarColumnSeries.new(root,{
xAxis:xAxis,
yAxis:yAxis,
clustered:false,
valueXField:"full",
categoryYField:"category",
fill:root.interfaceColors.get("alternativeBackground")
})
);

series1.columns.template.setAll({
width:am5.p100,
fillOpacity:0.12,
fill:am5.color(0x94a3b8),
strokeOpacity:0,
cornerRadius:22
});

series1.data.setAll(data);


// =======================
// FOREGROUND SERIES
// =======================

var series2 = chart.series.push(
am5radar.RadarColumnSeries.new(root,{
xAxis:xAxis,
yAxis:yAxis,
clustered:false,
valueXField:"value",
categoryYField:"category"
})
);

series2.columns.template.setAll({
width:am5.p100,
strokeOpacity:1,
tooltipText:"{category}: {valueX} Mitra",
cornerRadius:22,
templateField:"columnSettings"
});

series2.data.setAll(data);


// =======================
// SCROLL TRIGGER ANIMATION
// =======================

let chartStarted = false;

function startChart(){

if(chartStarted) return;

chartStarted = true;

series1.appear(1200);
series2.appear(1200);
chart.appear(1200,100);

}

window.addEventListener("scroll",function(){

var chartDiv = document.getElementById("chartdiv");

var position = chartDiv.getBoundingClientRect().top;
var screenPosition = window.innerHeight;

if(position < screenPosition - 120){

startChart();

}

});

});

</script>
<script>

window.addEventListener("load",function(){

document.querySelectorAll('.reveal-left, .reveal-right')
.forEach(el=>{
setTimeout(()=>{
el.classList.add("reveal-show")
},200);
});

});

</script>
<script>

function animateCounter(){

const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {

let target = +counter.innerText;
let count = 0;
let speed = target / 80;

function update(){

count += speed;

if(count < target){
counter.innerText = Math.floor(count);
requestAnimationFrame(update);
}else{
counter.innerText = target;
}

}

update();

});

}

window.addEventListener("load",animateCounter);

</script>
<script>

document.addEventListener("DOMContentLoaded",function(){

const revealElements = document.querySelectorAll(".reveal-left, .reveal-right");
const counters = document.querySelectorAll(".counter");

let counterStarted = false;

function revealOnScroll(){

    const windowHeight = window.innerHeight;

    revealElements.forEach(el=>{
        const elementTop = el.getBoundingClientRect().top;

        if(elementTop < windowHeight - 100){
            el.classList.add("reveal-active");
        }
    });

    /* COUNTER START */
    if(!counterStarted){

        const counterSection = document.querySelector(".statistics-section");

        if(counterSection){
            const sectionTop = counterSection.getBoundingClientRect().top;

            if(sectionTop < windowHeight - 100){

                counters.forEach(counter=>{

                    const target = +counter.innerText;
                    let count = 0;
                    const speed = target / 100;

                    const updateCounter = ()=>{

                        count += speed;

                        if(count < target){
                            counter.innerText = Math.floor(count);
                            requestAnimationFrame(updateCounter);
                        }else{
                            counter.innerText = target;
                        }

                    };

                    updateCounter();

                });

                counterStarted = true;

            }
        }

    }

}

window.addEventListener("scroll",revealOnScroll);

});
</script>
<script>

document.addEventListener("DOMContentLoaded",function(){

const reveals = document.querySelectorAll(".reveal-up");

function revealOnScroll(){

    const windowHeight = window.innerHeight;

    reveals.forEach(el=>{

        const elementTop = el.getBoundingClientRect().top;

        if(elementTop < windowHeight - 120){
            el.classList.add("active");
        }

    });

}

window.addEventListener("scroll", revealOnScroll);

});

</script>
@endsection
