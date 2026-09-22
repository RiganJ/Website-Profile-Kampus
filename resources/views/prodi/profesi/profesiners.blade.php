@extends('layouts.ners')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'Profesi Ners',
  'label' => 'Profesi Ners',
  'subtitle' => 'Program Profesi Keperawatan yang menghasilkan perawat profesional, berkarakter Islami, dan berdaya saing global.',
  'accent' => '#701F2B',
  'accentSoft' => '#9A4A56',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">

    {{-- GARIS PEMISAH --}}
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 
      bg-gradient-to-b from-[#701F2B] via-[#9A4A56]/40 to-[#701F2B] rounded-full">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

      {{-- DAFTAR ISI --}}
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#701F2B] mb-4">Daftar Isi</h4>
          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'pimpinan','label'=>'Pimpinan Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Peminatan'],
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
            <li>
              <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                <span class="text-gray-700 font-medium group-hover:text-[#701F2B] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#701F2B]"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14"/>
                    <path d="M13 5l7 7-7 7"/>
                  </svg>
                </span>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </aside>

      {{-- KONTEN --}}
      <div class="lg:col-span-8 space-y-16">

        {{-- LATAR BELAKANG --}}
        <div id="latar-belakang"
          class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">

          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#701F2B] rounded-full blur-3xl opacity-30"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#9A4A56]/15 text-[#701F2B] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#701F2B]">
                Latar Belakang & Sejarah
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi Keperawatan Universitas Fort de Kock diselenggarakan sebagai
              bentuk komitmen institusi dalam mendukung pembangunan sumber daya manusia
              di bidang kesehatan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Selain penguasaan kompetensi keilmuan, Program Studi Keperawatan
              Universitas Fort de Kock menekankan pembentukan karakter lulusan yang
              religius dan berlandaskan nilai-nilai Islami.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Penyelenggaraan pendidikan keperawatan berlandaskan pada pengembangan
              ilmu pengetahuan dan keterampilan keperawatan sesuai standar nasional
              dan global.
            </p>
          </div>
        </div>

        {{-- TUJUAN --}}
<div
  id="tujuan"
  class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up"
>
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">

    {{-- HEADER --}}
    <div class="flex items-center gap-4 lg:col-span-12 mb-2">
      <div class="w-11 h-11 rounded-xl bg-[#9A4A56]/15 text-[#701F2B] flex items-center justify-center shadow-sm">
        <i class="bi bi-bullseye text-xl"></i>
      </div>
      <h3 class="text-2xl md:text-3xl font-semibold text-[#701F2B]">
        Tujuan Program Studi
      </h3>
    </div>

    {{-- CONTENT --}}
    <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">

      {{-- FOTO --}}
      <div class="relative group -mt-2">
        <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
          <img
            src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelperawat3.png') ?? asset('images/model_ners_2.jpg') }}"
            alt="Mahasiswi Profesi Ners"
            class="w-full max-w-xl scale-110 drop-shadow-2xl"
          />

          {{-- SHINE --}}
          <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent
            -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700">
          </span>
        </div>
      </div>

      {{-- LIST --}}
      <div class="space-y-4 mt-1">
        <ul class="tujuan-list">
          @foreach([
            'Menghasilkan lulusan perawat profesional dan berkarakter.',
            'Mengembangkan ilmu dan keterampilan keperawatan sesuai perkembangan ilmu kesehatan.',
            'Menerapkan konsep keperawatan holistik di berbagai tatanan pelayanan.',
            'Membangun sikap profesional, komunikasi efektif, dan kerja sama tim.',
            'Berkontribusi dalam penelitian dan pengabdian kepada masyarakat.'
          ] as $item)
          <li class="tujuan-card">
            <span class="tujuan-card__icon" aria-hidden="true">
              <i class="bi bi-check-circle-fill"></i>
            </span>
            <span class="tujuan-card__text">
              {{ $item }}
            </span>
          </li>
          @endforeach
        </ul>
      </div>

    </div>
  </div>
</div>
      {{-- PIMPINAN --}}
@include('layouts.partials.prodi-kaprodi-card', [
  'prodiProfile' => $prodiProfile ?? null,
  'programName' => 'Profesi Ners',
  'roleLabel' => 'Pimpinan Program Studi',
  'accentColor' => '#701F2B',
  'accentSoftClass' => 'bg-orange-100',
  'borderClass' => 'border-[#cda8b0]/40',
  'cardBgClass' => 'from-white via-[#fff7f8] to-[#f7eaed]',
  'imageBgClass' => 'bg-[#efd8dd]',
  'chipRingClass' => 'ring-[#e8cfd5]/60',
  'badgeClass' => 'bg-[#701F2B]/10 text-[#701F2B]',
  'badgeIcon' => 'bi bi-heart-pulse-fill',
  'badgeLabel' => 'Program Profesi Ners',
  'description' => 'Memimpin pengembangan pendidikan profesi Ners untuk menghadirkan lulusan perawat profesional, berkarakter, terampil, dan siap memberikan pelayanan keperawatan yang bermutu.',
  'highlightOne' => 'Akademik Unggul',
  'highlightOneIcon' => 'bi bi-stars',
  'highlightTwo' => 'Profesionalisme Ners',
  'highlightTwoIcon' => 'bi bi-heart-pulse-fill',
])
<div id="history-timeline" class="history-timeline scroll-mt-32">
<div class="history-item reveal">
  <h4 class="text-xl font-semibold text-[#701F2B] mb-4">Timeline Akreditasi Prodi S1 Kesehatan Masyarakat</h4>
</div>
<!-- 2004 -->
<div class="history-item reveal">
  <div class="history-card">
    <h4>2004</h4>
    <p>
      Program studi Keperawatan Universitas Fort de Kock awalnya didirikan sebagai bagian dari
      <strong>STIKes (Sekolah Tinggi Ilmu Kesehatan) Fort de Kock Bukittinggi</strong>.
    </p>
    <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
      Pendirian Prodi
    </span>
  </div>
</div>

<!-- 2015-2020 -->
<div class="history-item reveal">
  <div class="history-card">
    <h4>28 Februari 2015 – 28 Februari 2020</h4>
    <p>
      Program studi Keperawatan Universitas Fort de Kock memperoleh
      <strong>peringkat B</strong> pada periode ini.
    </p>
    <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
      Akreditasi B
    </span>
  </div>
</div>

<!-- 2019-2024 -->
<div class="history-item reveal">
  <div class="history-card">
    <h4>26 Oktober 2019 – 25 Oktober 2024</h4>
    <p>
      Program studi Keperawatan kembali meraih
      <strong>peringkat B</strong> pada periode ini.
    </p>
    <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
      Akreditasi B
    </span>
  </div>
</div>

<!-- 2024-2029 -->
<div class="history-item reveal">
  <div class="history-card">
    <h4>13 September 2024 – 12 September 2029</h4>
    <p>
      Program studi Keperawatan berhasil meraih
      <strong>predikat Unggul</strong> setelah reakreditasi.
    </p>
    <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
      Akreditasi Unggul
    </span>
    @if($accreditation)
      <div class="mt-4 rounded-xl bg-[#9A4A56]/10 p-4 text-sm text-gray-700">
        <p><strong>Peringkat:</strong> {{ $accreditation->predicate }}</p>
        <p><strong>Nomor SK:</strong> {{ $accreditation->nomor_sk }}</p>
        <p><strong>Lembaga:</strong> {{ $accreditation->lembaga }}</p>
        @if(!empty($accreditation->file))
          <a href="{{ $accreditation->file_url }}"
             target="_blank"
             class="inline-flex items-center gap-2 mt-3 px-4 py-2 rounded-full bg-[#701F2B] text-white font-medium hover:bg-[#581821] transition">
            <i class="bi bi-file-earmark-pdf"></i>
            Lihat Akreditasi
          </a>
        @endif
      </div>
    @endif
  </div>
</div>

</div>

      {{-- VISI & MISI --}}
<div
  id="visi-misi"
  class="glass-card p-8 md:p-10 scroll-mt-32 reveal"
>
  <div class="flex items-center gap-3 mb-6">
      <div class="w-11 h-11 rounded-xl bg-[#9A4A56]/15 text-[#701F2B] flex items-center justify-center shadow-sm">
      <i class="bi bi-compass-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold text-[#701F2B]">
      Visi & Misi
    </h2>
  </div>
{{-- VISI & FOTO (KIRI) --}}
<div id="visi-misi" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
  
  <!-- VISI -->
  <div class="visi-box reveal mb-10">
    <span class="badge-visi">VISI</span>
    <p>
      “Menjadi Program Studi yang Menghasilkan Lulusan yang Unggul dan berdaya saing Global dalam Bidang Keperawatan Komplementer pada tahun 2025”
    </p>
  </div>

  <!-- MISI & FOTO (KIRI) -->
  <div class="flex flex-col lg:flex-row items-start gap-10">
    <!-- MISI -->    <!-- FOTO (KANAN) -->
    <div class="lg:col-span-5 relative hidden lg:block group">
      <div class="relative overflow-hidden rounded-2xl min-h-[560px] pt-20 pb-24 translate-y-6">
        <img
          src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modelperawat4.png') ?? asset('images/model_ners_1.jpg') }}"
          alt="Mahasiswi Profesi Ners"
          class="w-full max-w-xl scale-125 drop-shadow-2xl"
        />
        <!-- SHINE EFFECT -->
        <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
      </div>
    </div>
    <div class="lg:col-span-7 space-y-10">
      <div class="mt-10">
        <span class="badge-misi">MISI</span>
        <ul class="misi-list mt-6">
          @foreach([
            'Pendidikan akademik berbasis riset',
            'Pengembangan ilmu dan teknologi kesehatan masyarakat',
            'Pengabdian kepada masyarakat berbasis riset',
            'Peningkatan tata kelola program studi',
            'Penguatan jejaring nasional dan global'
          ] as $item)
            <li class="misi-card misi-reveal reveal">
              <span class="misi-card__icon" aria-hidden="true">
                <i class="bi bi-arrow-right-circle-fill"></i>
              </span>
              <span class="misi-card__text">{{ $item }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
</div>

  </div>
</div>
      {{-- PROFIL LULUSAN --}}
<div
  id="profil-lulusan"
  class="glass-card p-8 md:p-10 scroll-mt-32 reveal"
>
  <div class="flex items-center gap-3 mb-8">
      <div class="w-11 h-11 rounded-xl bg-[#9A4A56]/15 text-[#701F2B] flex items-center justify-center shadow-sm">
      <i class="bi bi-mortarboard-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold text-[#701F2B]">
      Profil Lulusan
    </h2>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach([
      ['title'=>'Decision Maker','desc'=>'Pengambil keputusan strategis di bidang kesehatan','icon'=>'bi-diagram-3-fill'],
      ['title'=>'Educator','desc'=>'Pengembang dan pendidik kesehatan masyarakat','icon'=>'bi-easel-fill'],
      ['title'=>'Researcher','desc'=>'Peneliti inovatif berbasis evidence','icon'=>'bi-search-heart-fill'],
      ['title'=>'Communicator','desc'=>'Penghubung kebijakan dan masyarakat','icon'=>'bi-megaphone-fill'],
      ['title'=>'Advocator','desc'=>'Perumus kebijakan kesehatan','icon'=>'bi-shield-check'],
      ['title'=>'Manager','desc'=>'Pengelola sistem dan layanan kesehatan','icon'=>'bi-gear-fill'],
    ] as $item)
      <div class="lulusan-card reveal">
        <div class="icon-box">
          <i class="bi {{ $item['icon'] }}"></i>
        </div>
        <div>
          <h4>{{ $item['title'] }}</h4>
          <p>{{ $item['desc'] }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>

    </div>

      </div>
    </div>
  </div>
</section>
{{-- DOSEN --}}
@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'Profesi Ners', 'accentColor' => '#701F2B', 'accentSoftClass' => 'bg-[#9A4A56]/15'])

<script>
document.addEventListener("DOMContentLoaded", () => {
  const reveals = document.querySelectorAll(".reveal");
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  reveals.forEach(el => observer.observe(el));
});
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll(".timeline-link");
  const sections = [...links].map(l => document.getElementById(l.dataset.target));

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        links.forEach(l => {
          l.classList.remove("text-[#F38020]");
          l.querySelector(".arrow").classList.remove("border-[#F38020]");
        });

        const active = document.querySelector(
          `.timeline-link[data-target="${entry.target.id}"]`
        );
        active.classList.add("text-[#F38020]");
        active.querySelector(".arrow").classList.add("border-[#F38020]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(sec => observer.observe(sec));
});
</script>

@endsection
