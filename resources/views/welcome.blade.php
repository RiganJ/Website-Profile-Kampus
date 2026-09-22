@extends('layouts.main')

@section('title', 'Visi & Misi - Universitas Fort De Kock')

@push('head')
<!-- AOS CSS + Bootstrap Icons (optional) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endpush

@section('content')

<!-- VISI HERO -->
<section class="relative overflow-hidden py-24">
  <!-- soft abstract shapes -->
  <div class="absolute inset-0 pointer-events-none">
    <div class="w-[560px] h-[560px] bg-[#F38020] rounded-full blur-3xl opacity-10 absolute -top-40 -left-20"></div>
    <div class="w-[360px] h-[360px] bg-[#F38020] rounded-full blur-3xl opacity-8 absolute bottom-0 right-12"></div>
  </div>

  <div class="relative max-w-5xl mx-auto px-6 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#11224E]">VISI</h1>

    <p class="mt-6 text-lg md:text-xl font-light leading-relaxed text-[#11224E]">
      {{ $visi }}
    </p>
  </div>
</section>

<!-- MISI GRID -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">

    <div class="mb-8" data-aos="fade-right">
      <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#11224E]">MISI</h2>
      <p class="mt-2 text-sm text-gray-600">Kami menjalankan misi berikut sebagai arah operasional dan strategis.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($misi as $item)
        <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition" data-aos="zoom-in">
          <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-full
                      border-2 border-[#F38020] text-[#F38020] text-2xl transition-all duration-300
                      group-hover:bg-[#F38020] group-hover:text-white">
            <i class="{{ $item['icon'] }}"></i>
          </div>

          <h3 class="mt-6 text-lg font-semibold text-[#11224E] text-center">{{ $item['title'] }}</h3>
        </div>
      @endforeach
    </div>

  </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (typeof AOS !== 'undefined') {
      AOS.init({ duration: 700, once: true, offset: 100 });
    }
  });
</script>
@endpush
