@extends('layouts.prodi')
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

@section('content')

@include('layouts.partials.prodi-hero', [
  'title' => 'Magister Kesehatan Masyarakat',
  'label' => 'S2 Kesehatan Masyarakat',
  'subtitle' => 'Program Pascasarjana unggulan yang berfokus pada penguatan riset, kebijakan kesehatan, dan pengembangan sistem kesehatan berkelanjutan.',
  'accent' => '#743B72',
  'accentSoft' => '#c7a3c5',
])

{{-- ================= CONTENT ================= --}}
<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">

    {{-- GARIS PEMISAH (DI TENGAH KIRI) --}}
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1
      bg-gradient-to-b from-[#743B72] via-[#C7A3C5] to-[#743B72] rounded-full">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

      {{-- ================= DAFTAR ISI (KIRI) ================= --}}
<aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
  <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
    <h4 class="text-xl font-semibold text-[#743B72] mb-4">
      Daftar Isi
    </h4>

    <ul id="timeline-menu" class="space-y-4">
      @foreach([
        ['id'=>'latar-belakang','label'=>'Latar Belakang'],
        ['id'=>'pimpinan','label'=>'Pimpinan Prodi'],
        ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
        ['id'=>'peminatan','label'=>'Peminatan'],
        ['id'=>'visi-misi','label'=>'Visi & Misi'],
        ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
        ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
        ['id'=>'dosen','label'=>'Tenaga Pengajar'],
      ] as $item)
        <li>
          <a href="#{{ $item['id'] }}"
             data-target="{{ $item['id'] }}"
             class="timeline-link flex items-center justify-between group">

            <!-- TEXT -->
            <span class="text-gray-700 font-medium
                         group-hover:text-[#743B72]
                         transition-colors">
              {{ $item['label'] }}
            </span>

            <!-- PANAH -->
            <span
              class="arrow-icon w-5 h-5
                     transition-all duration-300
                     -rotate-45 group-hover:rotate-0">

              <svg xmlns="http://www.w3.org/2000/svg"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round"
                   class="w-full h-full text-gray-400
                          group-hover:text-[#743B72]">
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


      {{-- ================= KONTEN UTAMA (KANAN) ================= --}}
      <div class="lg:col-span-8 space-y-16">
     {{-- LATAR BELAKANG --}}
     <div
  id="latar-belakang"
  class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden"
>

  <!-- Accent background -->
  <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#743B72] rounded-full blur-3xl opacity-40"></div>

  <div class="relative z-10">
    <div class="flex items-center gap-3 mb-5">
      <div class="w-11 h-11 rounded-xl bg-orange-100 text-[#743B72] flex items-center justify-center shadow">
        <i class="bi bi-book-half text-xl"></i>
      </div>
      <h2 class="text-2xl font-semibold text-[#743B72]">
        Latar Belakang & Sejarah
      </h2>
    </div>

    <p class="text-gray-700 leading-relaxed">
      Program Studi Magister Kesehatan Masyarakat dibentuk sebagai tanggapan
      atas semakin kompleksnya kebutuhan masyarakat di bidang kesehatan.
      Beragam tantangan, persoalan kesehatan, serta urgensi penguatan sistem
      layanan kesehatan menuntut kehadiran tenaga profesional yang memiliki
      kemampuan manajerial, analitis, dan strategis pada level lanjutan.
    </p>

    <p class="mt-4 text-gray-700 leading-relaxed">
      Program studi ini resmi berdiri pada tahun 2014 berdasarkan
      <strong>SK Nomor 344/E/O/2014</strong> tertanggal 20 Agustus 2014.
      Sejak berdiri, program studi telah melalui dua kali proses akreditasi,
      hingga akhirnya meraih
      <span class="inline-block px-3 py-1 bg-orange-100 text-[#743B72] rounded-full text-sm font-medium">
        Akreditasi Unggul
      </span>
      yang berlaku selama 4 tahun.
    </p>
  </div>
</div>

      {{-- PIMPINAN --}}
@include('layouts.partials.prodi-kaprodi-card', [
  'prodiProfile' => $prodiProfile ?? null,
  'programName' => 'S2 Kesehatan Masyarakat',
  'roleLabel' => 'Pimpinan Program Studi',
  'accentColor' => '#743B72',
  'accentSoftClass' => 'bg-orange-100',
  'borderClass' => 'border-[#d8c0d6]/40',
  'cardBgClass' => 'from-white via-[#fff8ff] to-[#f6eef7]',
  'imageBgClass' => 'bg-[#ebddec]',
  'chipRingClass' => 'ring-[#ead8e8]/60',
  'badgeClass' => 'bg-[#743B72]/10 text-[#743B72]',
  'badgeIcon' => 'bi bi-mortarboard-fill',
  'badgeLabel' => 'Magister Kesehatan Masyarakat',
  'description' => 'Memimpin pengembangan akademik Program Studi Magister Kesehatan Masyarakat untuk menguatkan riset, kebijakan kesehatan, dan tata kelola kesehatan masyarakat yang unggul serta berdaya saing.',
  'highlightOne' => 'Riset Kesehatan',
  'highlightOneIcon' => 'bi bi-stars',
  'highlightTwo' => 'Kebijakan Publik',
  'highlightTwoIcon' => 'bi bi-megaphone-fill',
])
<div id="history-timeline" class="history-timeline scroll-mt-32">
<div class="history-item reveal">
  <h4 class="text-xl font-semibold text-[#743B72] mb-4">Timeline Akreditasi Prodi S1 Kesehatan Masyarakat</h4>
</div>
  <!-- 2014 -->
  <div class="history-item reveal">
    <div class="history-card">
      <h4>2014</h4>
      <p>
        Program Studi Magister Kesehatan Masyarakat resmi berdiri pada
        tahun 2014 berdasarkan
        <strong>SK Nomor 344/E/O/2014</strong>
        tertanggal 20 Agustus 2014 sebagai respon atas kebutuhan tenaga
        profesional kesehatan tingkat lanjut.
      </p>
            <span class="inline-block px-3 py-1 bg-orange-100 text-[#743B72] rounded-full text-sm font-medium">
SK Pendirian</span>
    </div>
  </div>

  <!-- 2016 -->
  <div class="history-item reveal">
    <div class="history-card">
      <h4>2016</h4>
      <p>
        Program studi menjalani proses akreditasi pertama dan memperoleh
        <strong>peringkat B</strong> berdasarkan
        <strong>7 standar akreditasi</strong>.
      </p>
            <span class="inline-block px-3 py-1 bg-orange-100 text-[#743B72] rounded-full text-sm font-medium">
Akreditasi B</span>
    </div>
  </div>

  <!-- 2021 -->
  <div class="history-item reveal">
    <div class="history-card">
      <h4>2021</h4>
      <p>
        Pada tahun 2021, program studi kembali menjalani proses
        reakreditasi dan berhasil meraih
        <strong>predikat Baik Sekali</strong>.
      </p>
            <span class="inline-block px-3 py-1 bg-orange-100 text-[#743B72] rounded-full text-sm font-medium">
Baik Sekali</span>
    </div>
  </div>

  <!-- SEKARANG -->
  <div class="history-item reveal">

    <div class="history-card">
      <h4>Akreditasi Unggul</h4>
      <p>
        Saat ini, Program Studi Magister Kesehatan Masyarakat telah berhasil
        meraih
        <strong>Akreditasi Unggul</strong>
        yang berlaku selama <strong>4 tahun</strong>.
      </p>
            <span class="inline-block px-3 py-1 bg-orange-100 text-[#743B72] rounded-full text-sm font-medium">
Unggul</span>
      @if($accreditation)
        <div class="mt-4 rounded-xl bg-orange-50 p-4 text-sm text-gray-700">
          <p><strong>Peringkat:</strong> {{ $accreditation->predicate }}</p>
          <p><strong>Nomor SK:</strong> {{ $accreditation->nomor_sk }}</p>
          <p><strong>Lembaga:</strong> {{ $accreditation->lembaga }}</p>
          @if(!empty($accreditation->file))
            <a href="{{ $accreditation->file_url }}"
               target="_blank"
               class="inline-flex items-center gap-2 mt-3 px-4 py-2 rounded-full bg-[#743B72] text-white font-medium hover:bg-[#5f2f5d] transition">
              <i class="bi bi-file-earmark-pdf"></i>
              Lihat Akreditasi
            </a>
          @endif
        </div>
      @endif
    </div>
  </div>

</div>

      {{-- PEMINATAN --}}
<div
  id="peminatan"
  class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
  <div class="flex items-center gap-3 mb-8">
    <div class="w-11 h-11 rounded-xl bg-orange-100 text-[#743B72] flex items-center justify-center shadow">
      <i class="bi bi-diagram-3-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold text-blue-900">
      Peminatan
    </h2>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach([
      'Administrasi & Kebijakan Kesehatan',
      'Promosi Kesehatan',
      'Kesehatan Reproduksi',
      'Manajemen Administrasi Rumah Sakit'
    ] as $item)
      <div class="peminatan-card reveal">
        <i class="bi bi-check2-circle"></i>
        <span>{{ $item }}</span>
      </div>
    @endforeach
  </div>
</div>
      {{-- VISI & MISI --}}
<div
  id="visi-misi"
  class="glass-card p-8 md:p-10 scroll-mt-32 reveal"
>
  <div class="flex items-center gap-3 mb-10">
    <div class="w-11 h-11 rounded-xl bg-orange-100 text-[#743B72] flex items-center justify-center shadow">
      <i class="bi bi-compass-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold text-[#743B72]">
      Visi & Misi
    </h2>
  </div>

  {{-- VISI --}}
  <div class="visi-box reveal mb-14">
    <span class="badge-visi">VISI</span>
    <p>
      “Menjadikan Program Studi Magister yang Unggul, Berbasis Riset
      dan Berdaya Saing Global pada Tahun 2033”
    </p>
  </div>

  <div class="flex flex-col lg:flex-row gap-12 items-start">
    <div class="lg:w-7/12 space-y-6">
      <span class="inline-block px-4 py-1 rounded-full bg-[#743B72]/15 text-[#743B72] text-sm font-semibold">
        MISI
      </span>

      <ul class="misi-list mt-5">
        @foreach([
          'Pendidikan akademik berbasis riset',
          'Pengembangan ilmu dan teknologi kesehatan masyarakat',
          'Pengabdian kepada masyarakat berbasis riset',
          'Peningkatan tata kelola program studi',
          'Penguatan jejaring nasional dan global'
        ] as $item)
          <li class="misi-card misi-reveal reveal">
            <i class="bi bi-arrow-right-circle-fill text-[#743B72] mt-1"></i>
            <span class="text-gray-700 leading-relaxed">{{ $item }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="lg:w-5/12 relative hidden lg:block group mt-6">
      <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20">
        <img
          src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelkesmas2.png') ?? asset('images/model_s2_2.png') }}"
          alt="Mahasiswa Magister Kesehatan Masyarakat"
          class="w-full max-w-xl scale-125 drop-shadow-2xl"
        />
        <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
      </div>
    </div>
  </div>
</div>
@include('layouts.partials.prodi-tujuan-styled', [
  'prodiProfile' => $prodiProfile ?? null,
  'accent' => '#743B72',
  'accentSoft' => 'rgba(116, 59, 114, .12)',
  'items' => [
    'Menghasilkan lulusan magister kesehatan masyarakat yang unggul dalam riset, analisis kebijakan, dan penguatan sistem kesehatan.',
    'Mengembangkan kemampuan akademik berbasis evidence untuk menjawab persoalan kesehatan masyarakat.',
    'Mendorong penelitian dan pengabdian masyarakat yang relevan dengan kebutuhan nasional dan global.',
    'Memperkuat jejaring akademik, pemerintah, industri, dan masyarakat untuk peningkatan mutu pendidikan pascasarjana.'
  ],
  'imageDefault' => 'modelkesmas1.png',
  'imageAlt' => 'Mahasiswa Magister Kesehatan Masyarakat',
])
      {{-- PROFIL LULUSAN --}}
<div
  id="profil-lulusan"
  class="glass-card p-8 md:p-10 scroll-mt-32 reveal"
>
  <div class="flex items-center gap-3 mb-8">
    <div class="w-11 h-11 rounded-xl bg-orange-100 text-[#743B72] flex items-center justify-center shadow">
      <i class="bi bi-mortarboard-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold text-[#743B72]">
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
@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S2 Kesehatan Masyarakat', 'accentColor' => '#743B72', 'accentSoftClass' => 'bg-orange-100'])

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
  reveals.forEach((el, index) => {
    if (!el.classList.contains("misi-reveal")) {
      el.style.transitionDelay = `${(index % 4) * 60}ms`;
    }
    observer.observe(el);
  });
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
