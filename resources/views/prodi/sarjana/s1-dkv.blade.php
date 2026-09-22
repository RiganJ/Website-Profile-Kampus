@extends('layouts.dkv')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Desain Komunikasi Visual',
  'label' => 'S1 Desain Komunikasi Visual',
  'subtitle' => 'Program studi unggul dalam Desain Komunikasi Visual berbasis creativepreneur, teknologi digital, kearifan lokal, dan daya saing global.',
  'accent' => '#3A3539',
  'accentSoft' => '#4A4448',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#3A3539] via-[#4A4448]/40 to-[#3A3539] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#3A3539] mb-4">Daftar Isi</h4>
          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
            <li>
              <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                <span class="text-gray-700 font-medium group-hover:text-[#3A3539] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#3A3539]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#4A4448]/15 text-[#3A3539] flex items-center justify-center shadow-sm">
              <i class="bi bi-compass-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#3A3539]">
              Visi & Misi Program Studi Desain Komunikasi Visual
            </h2>
          </div>

          <div class="visi-box reveal mb-12">
            <span class="badge-visi text-white">VISI</span>
            <p class="mt-4 text-[17px] leading-relaxed text-white-700">
              "Menjadi Program Studi Desain Komunikasi
Visual yang unggul pada tahun <strong>2033</strong> dalam
pengembangan kreativitas, kewirausahaan
kreatif (creativepreneur), inovasi teknologi
digital, serta penguatan kearifan lokal dan
nilai etika untuk berdaya saing global."
            </p>
          </div>

          <div class="flex flex-col lg:flex-row items-start gap-12">
            <div class="lg:w-5/12 relative hidden lg:block group">
              <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20 translate-y-6">
                <img
                  src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modeldkv6.png') ?? asset('images/model_s2_2.png') }}"
                  alt="Mahasiswa DKV"
                  class="w-full max-w-xl mx-auto scale-110 drop-shadow-2xl"
                />
                <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
              </div>
            </div>

            <div class="lg:w-7/12 space-y-10">
              <div>
                <span class="badge-misi text-white">MISI</span>
                <ul class="misi-list mt-6 space-y-4">
                  @foreach([
                    'Menyelenggarakan Pendidikan Desain Komunikasi Visual berbasis creativepreneur dan teknologi digital yang berwawasan dan berdaya saing global.',
                    'Memiliki peran aktif dalam pengembangan keilmuan desain komunikasi visual melalui penelitian di tingkat nasional dan internasional.',
                    'Melakukan peran aktif dalam pelaksanaan program pengabdian kepada masyarakat dalam upaya meningkatkan potensi kearifan lokal dalam menghadapi tantangan perkembangan bisnis, teknologi dan media di masa depan.',
                    'Mengembangkan pengelolaan program studi yang bertata kelola baik (good governance).',
                    'Membangun jejaring dengan stakeholder Hexahelix (akademia, business, aggregator, government, community dan media) yang relevan dengan Desain Komunikasi Visual.'
                  ] as $item)
                    <li class="misi-card misi-reveal reveal text-gray-700">
                      <i class="bi bi-arrow-right-circle-fill text-[#3A3539] mt-1"></i>
                      <span class="leading-relaxed">{{ $item }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#4A4448] rounded-full blur-3xl opacity-25"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#4A4448]/15 text-[#3A3539] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#3A3539]">
                Latar Belakang Berdirinya Prodi
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Pendidikan tinggi merupakan bagian integral dari sistem pendidikan nasional yang
              berperan penting dalam mencerdaskan kehidupan bangsa serta memajukan ilmu pengetahuan
              dan teknologi. Peran ini dijalankan dengan tetap menjunjung tinggi nilai-nilai
              humaniora, budaya, dan pemberdayaan masyarakat Indonesia secara berkelanjutan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Dalam menghadapi era globalisasi dan pesatnya perkembangan teknologi, masyarakat
              dituntut untuk mampu menyeimbangkan kebutuhan hidup dengan gaya hidup modern yang
              semakin kompleks. Hal ini menjadi landasan bagi Universitas Fort De Kock untuk
              merespons tantangan zaman melalui pembentukan Program Studi Sarjana Desain
              Komunikasi Visual.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Program Studi Desain Komunikasi Visual dirancang untuk menjawab kebutuhan industri
              kreatif yang terus berkembang. Fokus utamanya adalah pada penciptaan karya seni visual
              sebagai media komunikasi, baik secara manual maupun berbasis teknologi digital. Seiring
              dengan kemajuan teknologi yang semakin canggih, individu, kelompok, dan institusi
              dituntut untuk mampu beradaptasi secara kreatif dan strategis.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Oleh karena itu, perguruan tinggi memiliki tanggung jawab untuk mengembangkan ilmu
              desain komunikasi visual yang relevan, inovatif, dan berdaya saing global. Program
              Studi ini resmi didirikan berdasarkan <strong>SK Mendikbudristek Nomor 302/E/0/2024</strong>
              tentang Izin Penyatuan Akademi Kebidanan Puteri Andalas Padang di Kota Padang ke
              Universitas Fort De Kock di Kota Bukittinggi, yang diselenggarakan oleh Yayasan Fort
              De Kock Bukittinggi.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Bersamaan dengan itu, dibentuk pula tiga program studi baru:
              <strong>Desain Komunikasi Visual, Hukum, dan Psikologi</strong>.
            </p>
          </div>
        </div>

        <div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
            <div class="flex items-center gap-4 lg:col-span-12 mb-3">
              <div class="w-11 h-11 rounded-xl bg-[#4A4448]/15 text-[#3A3539] flex items-center justify-center shadow-sm">
                <i class="bi bi-bullseye text-xl"></i>
              </div>
              <h3 class="text-2xl md:text-3xl font-semibold text-[#3A3539]">
                Tujuan Program Studi
              </h3>
            </div>

            <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
              <div class="relative group -mt-2">
                <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
                  <img
                    src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modeldkv4.png') ?? asset('images/model_ners_2.jpg') }}"
                    alt="Mahasiswa Desain Komunikasi Visual"
                    class="w-full max-w-xl scale-110 drop-shadow-2xl"
                  />
                  <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700"></span>
                </div>
              </div>

              <div class="space-y-4 mt-1">
                <ul class="tujuan-list grid gap-3">
                  @foreach([
                    'Menghasilkan lulusan yang unggul di bidang desain dan creativepreneur yang mampu menghadapi tantangan dunia industri desain di masa depan.',
                    'Menghasilkan luaran penelitian yang berkualitas melalui keterlibatan akademika dan industri lokal (UMKM).',
                    'Menghasilkan luaran program pengabdian kepada masyarakat dalam bidang desain, industri kreatif dan teknologi media digital dalam meningkatkan daya saing potensi kearifan lokal.',
                    'Menghasilkan karya cipta desain yang tepat guna dan bermanfaat bagi kebutuhan masyarakat serta dunia industri kreatif.',
                    'Menghasilkan suasana akademik yang kondusif dan produktif bagi pelaksanaan tata kelola pendidikan di bidang Desain Komunikasi Visual.'
                  ] as $item)
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#3A3539] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#3A3539] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">{{ $item }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Desain Komunikasi Visual',
          'accentColor' => '#3A3539',
          'accentSoftClass' => 'bg-[#4A4448]/15',
          'borderClass' => 'border-[#4A4448]/35',
          'cardBgClass' => 'from-white via-[#f5f3f4] to-[#ece8ea]',
          'imageBgClass' => 'bg-[#d7d0d3]',
          'chipRingClass' => 'ring-[#4A4448]/35',
          'badgeClass' => 'bg-[#3A3539]/10 text-[#3A3539]',
          'badgeIcon' => 'bi bi-palette-fill',
          'badgeLabel' => 'Desain Komunikasi Visual',
          'description' => 'Memimpin pengembangan akademik program studi yang berorientasi pada desain, creativepreneurship, teknologi digital, dan penguatan kearifan lokal untuk melahirkan lulusan kreatif yang siap bersaing secara global.',
          'highlightOne' => 'Visual Thinking',
          'highlightOneIcon' => 'bi bi-brush-fill',
          'highlightTwo' => 'Creativepreneur',
          'highlightTwoIcon' => 'bi bi-lightbulb-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#3A3539] mb-4">
              Timeline Akreditasi Program Studi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2024</h4>
              <p>
                Program Studi Sarjana Desain Komunikasi Visual resmi didirikan berdasarkan
                <strong>SK Mendikbudristek Nomor 302/E/0/2024</strong> sebagai bagian dari
                penguatan pengembangan program studi baru di Universitas Fort De Kock.
              </p>
              <span class="inline-block px-3 py-1 bg-[#4A4448]/15 text-[#3A3539] rounded-full text-sm font-semibold">
                Pendirian Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Arah Pengembangan</h4>
              <p>
                Pengembangan keilmuan DKV diarahkan pada integrasi creativepreneur,
                teknologi digital, kearifan lokal, serta kerja sama produktif dengan
                dunia usaha, pemerintah, dan lembaga pendidikan.
              </p>
              <span class="inline-block px-3 py-1 bg-[#4A4448]/15 text-[#3A3539] rounded-full text-sm font-semibold">
                Pengembangan Kurikulum
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Akreditasi</h4>
              <p>
                Dokumen akreditasi Program Studi Desain Komunikasi Visual dapat ditinjau
                melalui file resmi yang tersedia.
              </p>
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#4A4448]/15 text-[#3A3539] rounded-full text-sm font-semibold">
                  Status Akreditasi
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#3A3539] text-[#3A3539] text-sm font-semibold hover:bg-[#3A3539] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#4A4448]/15 text-[#3A3539] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#3A3539]">
              Profil Lulusan
            </h2>
          </div>

          <div class="mb-8 text-gray-700 leading-relaxed space-y-4">
            <p>
              Program Studi Desain Komunikasi Visual di Universitas Fort De Kock Bukittinggi dalam
              menentukan profil lulusan mengacu pada ketentuan dalam Kerangka Kualifikasi Nasional
              Indonesia (KKNI) dan Standar Nasional Pendidikan Tinggi (SN-DIKTI) yang tercantum
              dalam Standar Kompetensi Lulusan (SKL) yang mencakup unsur sikap, pengetahuan, dan
              keterampilan serta mengacu pada rumusan SKKNI Nomor 301 Tahun 2016.
            </p>
            <p>
              Pengembangan keilmuan program studi ini menitikberatkan pada entrepreneurship desain,
              kemampuan profesional di bidang desain, penguasaan teknologi informasi era digital,
              serta kepekaan dan kreativitas dalam menghadapi kebutuhan industri masa depan.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              [
                'title' => 'Profesional Desainer',
                'desc'  => 'Memiliki kompetensi dalam merancang kebutuhan komunikasi visual untuk memberi informasi, mengidentifikasi, dan membujuk melalui media cetak, noncetak, maupun new media.',
                'icon'  => 'bi-vector-pen'
              ],
              [
                'title' => 'Creativepreneur',
                'desc'  => 'Mampu merencanakan, membangun, dan mengembangkan bisnis kreatif di bidang desain komunikasi visual, menyusun strategi pemasaran, serta memimpin bisnis yang dijalankan.',
                'icon'  => 'bi-shop'
              ],
              [
                'title' => 'Design Researcher',
                'desc'  => 'Mampu melakukan penelitian di bidang desain komunikasi visual dengan pemikiran logis, kritis, dan inovatif untuk menghasilkan solusi yang tepat guna, efektif, dan kreatif.',
                'icon'  => 'bi-search-heart-fill'
              ],
              [
                'title' => 'Outcome Based Designer',
                'desc'  => 'Mampu menghasilkan karya komunikasi visual yang estetik, memahami tren dan perilaku audiens, membangun brand yang otentik, serta berkolaborasi dalam ekosistem industri kreatif.',
                'icon'  => 'bi-stars'
              ]
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#3A3539] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#3A3539] mb-1">
                    {{ $item['title'] }}
                  </h4>
                  <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $item['desc'] }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Desain Komunikasi Visual', 'accentColor' => '#3A3539', 'accentSoftClass' => 'bg-[#4A4448]/15'])

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
        link.classList.remove("text-[#3A3539]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#3A3539]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
