@php
  $heroProfile = $prodiProfile ?? null;
  $heroTitle = filled($heroProfile?->hero_title) ? $heroProfile->hero_title : $title;
  $heroSubtitle = filled($heroProfile?->hero_subtitle) ? $heroProfile->hero_subtitle : $subtitle;
  $heroImage = $heroProfile?->hero_image_url ?? ($image ?? asset('images/banner1.jpg'));
  $heroImagePosition = filled($heroProfile?->hero_image_position) ? $heroProfile->hero_image_position : ($imagePosition ?? 'center center');
@endphp

<section class="hero-modern relative flex items-center h-[520px] overflow-hidden" style="--hero-accent: {{ $accent }}; --hero-accent-soft: {{ $accentSoft ?? $accent }};">
  <div class="absolute inset-0">
    <img src="{{ $heroImage }}" alt="{{ $label ?? $heroTitle }}" class="w-full h-full object-cover" style="object-position: {{ $heroImagePosition }};">
    <div class="absolute inset-0 bg-gradient-to-b from-[rgba(3,10,30,.65)] to-[rgba(3,10,30,.75)]"></div>
    <div class="absolute inset-0 bg-[url('/images/pattern2.gif')] bg-repeat bg-[size:300px] opacity-10 pointer-events-none"></div>
  </div>

  <div class="relative z-10 w-full">
    <div class="max-w-7xl mx-auto px-6 text-center" data-aos="fade-up">
      <nav class="hero-breadcrumb mb-6 text-sm text-gray-300 flex justify-center gap-2">
        <a href="{{ route('home', [], false) }}" class="transition hover:[color:var(--hero-accent-soft)]">Beranda</a>
        <span>/</span>
        <a href="/prodi" class="transition hover:[color:var(--hero-accent-soft)]">Program Studi</a>
        <span>/</span>
        <span class="active font-semibold" style="color: {{ $accentSoft ?? $accent }}">{{ $label ?? $heroTitle }}</span>
      </nav>

      <h1 class="hero-title text-4xl md:text-5xl font-extrabold text-white tracking-tight">
        {{ $heroTitle }}<br>
        <span class="bg-clip-text text-transparent" style="background-image: linear-gradient(to right, {{ $accentSoft ?? $accent }}, {{ $accent }});">
          Universitas Fort De Kock
        </span>
      </h1>

      <p class="hero-subtitle mt-4 text-gray-200 max-w-2xl mx-auto leading-relaxed">
        {{ $heroSubtitle }}
      </p>

      <div class="hero-line mt-8 mx-auto rounded-full h-1 w-20" style="background-color: {{ $accent }}"></div>
    </div>
  </div>

  <div class="scroll-indicator absolute bottom-6 left-1/2 -translate-x-1/2">
    <span class="block w-6 h-10 border-2 border-white rounded-full relative">
      <span class="absolute top-2 left-1/2 w-1 h-2 bg-white rounded-full -translate-x-1/2 animate-bounce"></span>
    </span>
  </div>
</section>
