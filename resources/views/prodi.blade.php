@extends('layouts.main')

@section('content')

<!-- HERO MODERN UNTUK PRODI -->
<section class="hero-modern relative flex items-center h-[520px] overflow-hidden">

  <!-- Background + overlay + pattern -->
  <div class="absolute inset-0">
    <img src="/images/banner1.jpg" alt="Program Studi" class="w-full h-full object-cover">
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
        <span class="active font-semibold text-orange-400">Program Studi</span>
      </nav>

      <!-- Title -->
      <h1 class="hero-title text-4xl md:text-5xl font-extrabold text-white tracking-tight">
        Program Studi & Fakultas<br>
        <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
          Universitas Fort De Kock
        </span>
      </h1>

      <!-- Subtitle -->
      <p class="hero-subtitle mt-4 text-gray-200 max-w-2xl mx-auto leading-relaxed">
        Pilih fakultas di bawah ini untuk melihat program studi yang tersedia lengkap dengan informasi dan detailnya.
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

<!-- DAFTAR FAKULTAS & PRODI -->
<div class="container mx-auto px-6 py-16 space-y-20">

    <!-- Fakultas Kesehatan -->
    <section data-aos="fade-up">
        <h2 class="text-3xl font-semibold text-[#0f172a] mb-8">
            Fakultas Kesehatan (<span class="text-[#EA580C]">FIK</span>)
        </h2>

        @php
            $prodiFkes = [
                ['nama'=>'S2 KESMAS','slug'=>'s2-kesmas','foto'=>'banners2.png','deskripsi_singkat'=>'Program Magister Kesehatan Masyarakat','jenjang'=>'S2','route'=>'prodi.pasca-sarjana.s2.kesmas'],
                ['nama'=>'S1 KESMAS','slug'=>'s1-kesmas','foto'=>'banners1kesmas.jpg','deskripsi_singkat'=>'Program Sarjana Kesehatan Masyarakat','jenjang'=>'S1','route'=>'prodi.sarjana.s1.kesmas'],
                ['nama'=>'Profesi NERS','slug'=>'profesi-ners','foto'=>'bannerprofesiners.jpg','deskripsi_singkat'=>'Program Profesi NERS','jenjang'=>'Profesi','route'=>'prodi.proefsiners'],
                ['nama'=>'Profesi BIDAN','slug'=>'profesi-bidan','foto'=>'bannerprofesibidan.png','deskripsi_singkat'=>'Program Profesi BIDAN','jenjang'=>'Profesi','route'=>'prodi.profesibidan'],
                ['nama'=>'S1 FARMASI','slug'=>'s1-farmasi','foto'=>'bannerfarmasi.jpg','deskripsi_singkat'=>'Program Sarjana Farmasi','jenjang'=>'S1','route'=>'prodi.sarjana.s1.farmasi'],
                ['nama'=>'S1 BIDAN','slug'=>'s1-bidan','foto'=>'bannerbidan.png','deskripsi_singkat'=>'Program Sarjana BIDAN','jenjang'=>'S1','route'=>'prodi.sarjana.s1.bidan'],
                ['nama'=>'S1 KEPERAWATAN','slug'=>'s1-keperawatan','foto'=>'bannerkeperawatan.jpg','deskripsi_singkat'=>'Program Sarjana Keperawatan','jenjang'=>'S1','route'=>'prodi.sarjana.s1.keperawatan'],
                ['nama'=>'S1 FISIOTERAPI','slug'=>'s1-fisioterapi','foto'=>'bannerfisio.jpg','deskripsi_singkat'=>'Program Sarjana Fisioterapi','jenjang'=>'S1','route'=>'prodi.sarjana.s1.fisiotrapi'],
                ['nama'=>'D3 FISIOTERAPI','slug'=>'d3-fisioterapi','foto'=>'bannerd3.jpg','deskripsi_singkat'=>'Program Diploma Fisioterapi','jenjang'=>'D3','route'=>'prodi.diploma.d3.fisiotrapi'],
            ];
            $kategori = ['S1','Profesi','S2','D3'];
        @endphp

        @foreach($kategori as $cat)
            @php
                $prodiCat = array_filter($prodiFkes, fn($p) => $p['jenjang']==$cat);
            @endphp

            @if(count($prodiCat) > 0)
                <div class="mb-10">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">// {{ $cat }}</h3>
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($prodiCat as $p)
                        <a href="{{ route($p['route']) }}" class="group block overflow-hidden rounded-2xl shadow-md bg-white transition duration-300">

                            <!-- FOTO -->
                            <div class="h-48 w-full rounded-t-2xl overflow-hidden relative">
                                <img src="{{ asset('images/' . $p['foto']) }}" alt="{{ $p['nama'] }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-[url('/images/pattern2.gif')] bg-repeat bg-[size:300px] opacity-10 pointer-events-none"></div>
                            </div>

                            <!-- INFO -->
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-orange-500 transition-colors">
                                    {{ $p['nama'] }}
                                </h4>
                                <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                                    {{ $p['deskripsi_singkat'] ?? 'Informasi belum tersedia.' }}
                                </p>
                                <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-white bg-orange-500 rounded-full">
                                    {{ $p['jenjang'] }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </section>

    <!-- Fakultas Humaniora -->
    <section data-aos="fade-up">
        <h2 class="text-3xl font-semibold text-[#0f172a] mb-8">
            Fakultas Humaniora (<span class="text-[#EA580C]">FSEH</span>)
        </h2>

        @php
            $prodiFseh = [
                ['nama'=>'S1 PSIKOLOGI','slug'=>'s1-psikologi','foto'=>'bannerpsikologi.png','deskripsi_singkat'=>'Program Sarjana Psikologi','jenjang'=>'S1','route'=>'prodi.sarjana.s1.psikologi'],
                ['nama'=>'S1 BISNIS DIGITAL','slug'=>'s1-bisnis-digital','foto'=>'bannerbd.jpg','deskripsi_singkat'=>'Program Sarjana Bisnis Digital','jenjang'=>'S1','route'=>'prodi.sarjana.s1.bisnisdigital'],
                ['nama'=>'S1 DKV','slug'=>'s1-dkv','foto'=>'bannerdkv.png','deskripsi_singkat'=>'Program Sarjana Desain Komunikasi Visual','jenjang'=>'S1','route'=>'prodi.sarjana.s1.dkv'],
                ['nama'=>'S1 PARIWISATA','slug'=>'s1-pariwisata','foto'=>'bannerpariwisata.jpg','deskripsi_singkat'=>'Program Sarjana Pariwisata','jenjang'=>'S1','route'=>'prodi.sarjana.s1.pariwisata'],
                ['nama'=>'S1 HUKUM','slug'=>'s1-hukum','foto'=>'bannerhukum.png','deskripsi_singkat'=>'Program Sarjana Hukum','jenjang'=>'S1','route'=>'prodi.sarjana.s1.hukum'],
                ['nama'=>'S1 KEWIRAUSAHAAN','slug'=>'s1-kewirausahaan','foto'=>'bannerkwu.png','deskripsi_singkat'=>'Program Sarjana Kewirausahaan','jenjang'=>'S1','route'=>'prodi.sarjana.s1.kewirausahaan'],
            ];
            $kategoriFseh = ['S1'];
        @endphp

        @foreach($kategoriFseh as $cat)
            @php
                $prodiCat = array_filter($prodiFseh, fn($p) => $p['jenjang']==$cat);
            @endphp

            @if(count($prodiCat) > 0)
                <div class="mb-10">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">// {{ $cat }}</h3>
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($prodiCat as $p)
                        <a href="{{ route($p['route']) }}" class="group block overflow-hidden rounded-2xl shadow-md bg-white transition duration-300">

                            <!-- FOTO -->
                            <div class="h-48 w-full rounded-t-2xl overflow-hidden relative">
                                <img src="{{ asset('images/' . $p['foto']) }}" alt="{{ $p['nama'] }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-[url('/images/pattern2.gif')] bg-repeat bg-[size:300px] opacity-10 pointer-events-none"></div>
                            </div>

                            <!-- INFO -->
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-orange-500 transition-colors">
                                    {{ $p['nama'] }}
                                </h4>
                                <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                                    {{ $p['deskripsi_singkat'] ?? 'Informasi belum tersedia.' }}
                                </p>
                                <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-white bg-orange-500 rounded-full">
                                    {{ $p['jenjang'] }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </section>

</div>
@endsection
