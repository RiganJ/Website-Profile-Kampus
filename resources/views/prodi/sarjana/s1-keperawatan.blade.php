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
  'title' => 'S1 Keperawatan',
  'label' => 'S1 Keperawatan',
  'subtitle' => 'Program Studi Keperawatan yang menghasilkan perawat profesional, berkarakter Islami, dan berdaya saing global.',
  'accent' => '#701F2B',
  'accentSoft' => '#9A4A56',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#701F2B] via-[#9A4A56]/40 to-[#701F2B] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#701F2B] mb-4">Daftar Isi</h4>
          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Peminatan'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
            <li>
              <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                <span class="text-gray-700 font-medium group-hover:text-[#701F2B] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#701F2B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

      <div class="lg:col-span-8 flex flex-col gap-16">
        <div id="visi-misi" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-10">
            <div class="w-11 h-11 rounded-xl bg-[#9A4A56]/15 text-[#701F2B] flex items-center justify-center shadow-sm">
              <i class="bi bi-compass-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#701F2B]">
              Visi & Misi
            </h2>
          </div>

          <div class="visi-box reveal mb-14">
            <span class="badge-visi">VISI</span>
            <p class="mt-4">
              Menjadi Program Studi yang Menghasilkan Lulusan yang Unggul dan berdaya saing Global dalam Bidang Keperawatan Komplementer pada tahun 2025.
            </p>
          </div>

          <div class="flex flex-col lg:flex-row gap-12 items-start">
            <div class="lg:w-7/12 space-y-6">
              <span class="inline-block px-4 py-1 rounded-full bg-[#9A4A56]/15 text-[#701F2B] text-sm font-semibold">
                MISI
              </span>

            <ul class="misi-list mt-5">
    @foreach([
        'Menyelenggarakan tri dharma perguruan tinggi yang bermutu, berkarakter, dan berkesinambungan khususnya pada lingkup penyakit komplementer.',
        'Meningkatkan kualitas tata kelola program studi yang baik menuju tata kelola sesuai standar.',
        'Menjalin kerja sama yang produktif dan berkelanjutan bersama masyarakat, sektor swasta, pemerintah, dan lembaga-lembaga internasional dalam pengembangan pendidikan, penelitian, dan pengabdian kepada masyarakat.'
    ] as $item)
        <li class="misi-card misi-reveal reveal">
            <i class="bi bi-arrow-right-circle-fill text-[#701F2B] mt-1"></i>
            <span class="text-gray-700 leading-relaxed">
                {{ $item }}
            </span>
        </li>
    @endforeach
</ul>
            </div>

<div class="lg:w-5/12 relative hidden lg:block group mt-6">
    <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20">
        <img
            src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelperawat3.png') ?? asset('images/model_ners_1.jpg') }}"
            alt="Mahasiswi Keperawatan"
            class="w-full max-w-xl scale-125 drop-shadow-2xl"
        />

        <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
    </div>
            </div>
          </div>
        </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
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
        Program Studi Keperawatan Universitas Fort de Kock berawal dari Program Studi
        Keperawatan yang didirikan pada tahun <strong>2004</strong> sebagai bagian dari
        <strong>Sekolah Tinggi Ilmu Kesehatan (STIKes) Fort de Kock Bukittinggi</strong>.
        Pada saat itu, STIKes Fort de Kock menyelenggarakan pendidikan di bidang
        Keperawatan dan Kesehatan Masyarakat sebagai bentuk komitmen dalam mencetak
        tenaga kesehatan yang profesional dan berkualitas.
    </p>

    <p class="mt-4 text-gray-700 leading-relaxed">
        Seiring dengan perkembangan institusi, pada tahun <strong>2019</strong> STIKes
        Fort de Kock resmi bertransformasi menjadi <strong>Universitas Fort de Kock</strong>,
        sehingga Program Studi Keperawatan menjadi bagian dari universitas dengan
        komitmen untuk terus meningkatkan mutu pendidikan, penelitian, dan pengabdian
        kepada masyarakat. Dalam perjalanan pengembangannya, program studi ini terus
        melakukan peningkatan kualitas dan berhasil memperoleh
        <strong>predikat Akreditasi Unggul pada tahun 2024</strong>.
    </p>

    <p class="mt-4 text-gray-700 leading-relaxed">
        Program Studi Keperawatan Universitas Fort de Kock bertujuan menghasilkan
        tenaga keperawatan profesional yang kompeten, inovatif, religius, dan
        berkarakter Islami. Lulusan dipersiapkan untuk mampu mengembangkan ilmu
        pengetahuan dan keterampilan keperawatan, menerapkan konsep keperawatan secara
        holistik di berbagai tatanan pelayanan kesehatan, serta berkontribusi dalam
        pengembangan ilmu keperawatan dan peningkatan derajat kesehatan masyarakat
        melalui kegiatan penelitian dan pengabdian kepada masyarakat.
    </p>
</div>
        </div>

        <div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
            <div class="flex items-center gap-4 lg:col-span-12 mb-2">
              <div class="w-11 h-11 rounded-xl bg-[#9A4A56]/15 text-[#701F2B] flex items-center justify-center shadow-sm">
                <i class="bi bi-bullseye text-xl"></i>
              </div>
              <h3 class="text-2xl md:text-3xl font-semibold text-[#701F2B]">
                Tujuan Program Studi
              </h3>
            </div>

            <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
              <div class="relative group -mt-2">
                <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
<img
    src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modelperawat4.png') ?? asset('images/model_ners_2.jpg') }}"
    alt="Mahasiswi Keperawatan"
    class="w-full max-w-xl scale-110 drop-shadow-2xl"
/>                  <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700"></span>
                </div>
              </div>

              <div class="space-y-4 mt-1">
                <ul class="tujuan-list grid gap-3">
                  @foreach([
                    'Menghasilkan lulusan perawat profesional dan berkarakter.',
                    'Mengembangkan ilmu dan keterampilan keperawatan sesuai perkembangan ilmu kesehatan.',
                    'Menerapkan konsep keperawatan holistik di berbagai tatanan pelayanan.',
                    'Membangun sikap profesional, komunikasi efektif, dan kerja sama tim.',
                    'Berkontribusi dalam penelitian dan pengabdian kepada masyarakat.'
                  ] as $item)
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#701F2B] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#701F2B] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      {{ $item }}
                    </span>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Keperawatan',
          'accentColor' => '#701F2B',
          'accentSoftClass' => 'bg-[#9A4A56]/15',
          'borderClass' => 'border-[#cda8b0]/40',
          'cardBgClass' => 'from-white via-[#fff7f8] to-[#f7eaed]',
          'imageBgClass' => 'bg-[#efd8dd]',
          'chipRingClass' => 'ring-[#e8cfd5]/60',
          'badgeClass' => 'bg-[#701F2B]/10 text-[#701F2B]',
          'badgeIcon' => 'bi bi-heart-pulse-fill',
          'badgeLabel' => 'Program Studi Keperawatan',
          'description' => 'Memimpin pengembangan akademik dan tata kelola Program Studi S1 Keperawatan untuk menghadirkan pembelajaran yang unggul, adaptif, dan relevan dengan kebutuhan pelayanan keperawatan profesional.',
          'highlightOne' => 'Akademik Unggul',
          'highlightOneIcon' => 'bi bi-stars',
          'highlightTwo' => 'Keperawatan Profesional',
          'highlightTwoIcon' => 'bi bi-heart-pulse-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#701F2B] mb-4">
              Timeline Akreditasi Prodi S1 Keperawatan
            </h4>
          </div>

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

          <div class="history-item reveal">
            <div class="history-card">
              <h4>28 Februari 2015 28 Februari 2020</h4>
              <p>
                Program studi Keperawatan Universitas Fort de Kock memperoleh
                <strong>peringkat B</strong> pada periode ini.
              </p>
              <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
                Akreditasi B
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>26 Oktober 2019 25 Oktober 2024</h4>
              <p>
                Program studi Keperawatan kembali meraih
                <strong>peringkat B</strong> pada periode ini.
              </p>
              <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
                Akreditasi B
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>13 September 2024 12 September 2029</h4>
              <p>
                Program studi Keperawatan berhasil meraih
                <strong>predikat Unggul</strong> setelah reakreditasi.
              </p>
              <span class="inline-block px-3 py-1 bg-[#9A4A56] text-white rounded-full text-sm font-medium">
                Akreditasi Unggul
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Dokumen akreditasi Program Studi S1 Keperawatan dapat ditinjau melalui file resmi
                yang tersedia sebagai referensi status akreditasi program studi saat ini.
              </p>
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#9A4A56]/15 text-[#701F2B] rounded-full text-sm font-medium">
                  Status Akreditasi
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#701F2B] text-[#701F2B] text-sm font-semibold hover:bg-[#701F2B] hover:text-white transition"
                >
                  <i class="bi bi-file-earmark-pdf-fill"></i>
                  Lihat Akreditasi
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div id="profil-lulusan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
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
        [
            'title' => 'Perawat Profesional',
            'desc' => 'Menghasilkan tenaga keperawatan yang berpegang teguh pada filosofi, etika profesi, dan aspek legal, bertanggung jawab atas setiap keputusan klinis, serta senantiasa mengikuti perkembangan ilmu pengetahuan dan keterampilan keperawatan terkini.',
            'icon' => 'bi-person-check-fill'
        ],
        [
            'title' => 'Berdaya Saing Global',
            'desc' => 'Lulusan mampu bersaing di tingkat nasional maupun internasional melalui penguasaan kompetensi keperawatan, didukung oleh program kerja sama internasional seperti student exchange, lecturer exchange, dan studi banding ke luar negeri.',
            'icon' => 'bi-globe-asia-australia'
        ],
        [
            'title' => 'Keperawatan Komplementer',
            'desc' => 'Lulusan mampu menerapkan keperawatan komplementer sebagai bagian dari intervensi keperawatan holistik dalam memberikan asuhan keperawatan yang berkualitas kepada masyarakat.',
            'icon' => 'bi-heart-pulse-fill'
        ],
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
</section>

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Keperawatan', 'accentColor' => '#701F2B', 'accentSoftClass' => 'bg-[#9A4A56]/15'])

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
  const sections = [...links]
    .map(link => {
      const href = link.getAttribute("href") || "";
      return document.querySelector(href);
    })
    .filter(Boolean);

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) {
        return;
      }

      links.forEach(link => {
        link.classList.remove("text-[#F38020]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#F38020]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
