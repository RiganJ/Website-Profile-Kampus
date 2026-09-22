@extends('layouts.kewirausahaan')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

<style>
.peminatan-card i,
.peminatan-card span,
.misi-list li i,
.lulusan-card h4 {
  color: #ACB734;
}

#visi-misi h2,
#visi-misi .visi-box p,
#visi-misi .misi-list li span {
  color: #ACB734;
}

.visi-box {
  background: linear-gradient(135deg, #E6EBB8, #ACB734);
}

.badge-visi,
.badge-misi {
  background: #ACB734;
  color: #fff;
}

.lulusan-card .icon-box {
  background: linear-gradient(135deg, #E6EBB8, #ACB734);
  color: #fff;
}

.history-timeline::before {
  background: linear-gradient(to bottom, #ACB734, #E6EBB8);
}

#history-timeline h4,
#history-timeline .history-card h4,
#history-timeline .history-card strong,
#history-timeline .history-item .inline-block,
#history-timeline .history-item a {
  color: #ACB734;
}

#history-timeline .history-card a {
  border-color: #ACB734;
}
</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Kewirausahaan',
  'label' => 'S1 Kewirausahaan',
  'subtitle' => 'Program studi yang mencetak wirausahawan muda berkualitas, kreatif, profesional, dan siap membangun usaha inovatif yang berdaya saing global.',
  'accent' => '#ACB734',
  'accentSoft' => '#E6EBB8',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#ACB734] via-[#E6EBB8] to-[#ACB734] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#ACB734] mb-4">Daftar Isi</h4>

          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Fokus Pembelajaran'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
              <li>
                <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                  <span class="text-gray-700 font-medium group-hover:text-[#ACB734] transition-colors">
                    {{ $item['label'] }}
                  </span>
                  <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="w-full h-full text-gray-400 group-hover:text-[#ACB734]">
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
            <div class="w-11 h-11 rounded-xl bg-[#f8fadf] text-[#ACB734] flex items-center justify-center shadow-sm">
                <i class="bi bi-compass-fill text-xl"></i>
            </div>

            <h2 class="text-2xl font-semibold text-[#ACB734]">
                Visi & Misi
            </h2>
        </div>

        {{-- VISI --}}
        <div class="visi-box reveal mb-14">
            <span class="badge-visi">VISI</span>

            <p class="mt-4">
                Mewujudkan Program Studi Sarjana Kewirausahaan yang berkualitas
                dalam rangka menghasilkan wirausahawan yang profesional serta
                memiliki daya saing global tahun 2033.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-start">

            {{-- MISI --}}
            <div class="lg:w-7/12 space-y-6">

                <span class="inline-block px-4 py-1 rounded-full bg-[#f8fadf] text-[#ACB734] text-sm font-semibold">
                    MISI
                </span>

               <ul class="mt-5 space-y-4">
    @foreach([
        'Menyelenggarakan Tri Dharma perguruan tinggi yang bermutu, berkarakter, dan berkesinambungan dalam bidang kewirausahaan berbasis teknologi, sosial, industri kreatif, serta kearifan lokal.',
        'Menciptakan wirausaha yang aplikatif dan berdampak luas bagi masyarakat.',
        'Mengembangkan kegiatan akademik dan non akademik dalam suasana yang kondusif, beretika, bermartabat, dan religius.',
        'Memperluas jaringan kerja sama yang meningkatkan daya saing lulusan.'
    ] as $item)

        <li class="reveal">
            <div class="flex items-start gap-3 rounded-xl border border-[#edf2c9] bg-[#fbfdf2] p-4 transition-all duration-300 hover:border-[#ACB734] hover:shadow-md">
                <i class="bi bi-arrow-right-circle-fill text-[#ACB734] mt-1 text-lg"></i>

                <span class="text-gray-700 leading-relaxed">
                    {{ $item }}
                </span>
            </div>
        </li>

    @endforeach
</ul>

            </div>

            {{-- FOTO --}}
            <div class="lg:w-5/12 relative hidden lg:block group mt-6">

<div class="relative min-h-[520px] pt-16 pb-20 flex items-end justify-center">
                   <img
    src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelkwu1.png') ?? asset('images/modelkwu1.png') }}"
    alt="Mahasiswa Kewirausahaan"
    class="w-full max-w-xl scale-125"
/>

                    {{-- Shine Effect --}}
                    <span
                        class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 transition-transform duration-[1800ms] ease-in-out group-hover:translate-x-full">
                    </span>

                </div>

            </div>

        </div>

    </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#ACB734] rounded-full blur-3xl opacity-25"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#f8fadf] text-[#ACB734] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#ACB734]">
                Sejarah dan Latar Belakang
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Perubahan pola ekonomi global dan ketatnya persaingan kerja
              menuntut lulusan perguruan tinggi untuk tidak hanya siap bekerja,
              tetapi juga mampu menciptakan lapangan kerja. Kewirausahaan
              menjadi solusi strategis dalam menekan pengangguran dan mendorong
              pertumbuhan ekonomi berkelanjutan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Universitas Fort de Kock Bukittinggi merespons tantangan ini
              dengan mendirikan Program Studi S1 Kewirausahaan pada tahun 2019.
              Pendirian ini merupakan bagian dari transformasi universitas dalam
              memperluas cakupan keilmuan di luar bidang kesehatan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Program studi ini bertujuan mencetak generasi muda yang mandiri,
              kreatif, dan berdaya saing tinggi. Kurikulumnya dirancang agar
              mahasiswa tidak hanya memahami teori bisnis, tetapi juga mampu
              membangun dan mengelola usaha secara langsung sejak awal masa studi.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Dengan dukungan inkubator bisnis, kemitraan industri, marketplace
              lokal, serta pendekatan Merdeka Belajar Kampus Merdeka, Prodi
              Kewirausahaan menjadi wadah strategis untuk mencetak wirausahawan
              muda yang siap memberi dampak nyata bagi masyarakat dan kemajuan
              ekonomi bangsa.
            </p>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Kewirausahaan',
          'accentColor' => '#ACB734',
          'accentSoftClass' => 'bg-[#f8fadf]',
          'borderClass' => 'border-[#e4e8b6]',
          'cardBgClass' => 'from-white via-[#fdfef5] to-[#f5f7e1]',
          'imageBgClass' => 'bg-[#eef2c9]',
          'chipRingClass' => 'ring-[#edf0cf]',
          'badgeClass' => 'bg-[#ACB734]/10 text-[#ACB734]',
          'badgeIcon' => 'bi bi-mortarboard-fill',
          'badgeLabel' => 'Program Studi Kewirausahaan',
          'description' => 'Memimpin pengembangan akademik Program Studi S1 Kewirausahaan dengan fokus pada praktik bisnis, inovasi, pengembangan karakter wirausaha, dan kolaborasi industri yang relevan dengan kebutuhan zaman.',
          'highlightOne' => 'Inovasi',
          'highlightOneIcon' => 'bi bi-lightbulb-fill',
          'highlightTwo' => 'Entrepreneurship',
          'highlightTwoIcon' => 'bi bi-briefcase-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#ACB734] mb-4">
              Timeline Akreditasi Program Studi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2019</h4>
              <p>
                Program Studi S1 Kewirausahaan didirikan sebagai respons terhadap
                perubahan ekonomi global dan kebutuhan lulusan yang tidak hanya
                siap bekerja, tetapi juga mampu menciptakan lapangan kerja.
              </p>
              <span class="inline-block px-3 py-1 bg-[#f8fadf] text-[#ACB734] rounded-full text-sm font-semibold">
                Pendirian Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Pengembangan</h4>
              <p>
                Kurikulum dikembangkan berbasis praktik, inovasi, teknologi,
                inkubator bisnis, serta kemitraan industri agar mahasiswa mampu
                membangun usaha sejak semester awal.
              </p>
              <span class="inline-block px-3 py-1 bg-[#f8fadf] text-[#ACB734] rounded-full text-sm font-semibold">
                Pengembangan Kurikulum
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Status akreditasi Program Studi S1 Kewirausahaan saat ini dapat
                ditinjau melalui data dan dokumen resmi yang tersedia.
              </p>
              @if($accreditation)
              <div class="mt-4 grid gap-2 text-sm text-gray-700">
                <p><strong>Peringkat:</strong> {{ $accreditation->predicate }}</p>
                <p><strong>Nomor SK:</strong> {{ $accreditation->nomor_sk }}</p>
                <p><strong>Lembaga:</strong> {{ $accreditation->lembaga }}</p>
              </div>
              @endif
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#f8fadf] text-[#ACB734] rounded-full text-sm font-semibold">
                  {{ $accreditation?->predicate ?? 'Status Akreditasi' }}
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#ACB734] text-[#ACB734] text-sm font-semibold hover:bg-[#ACB734] hover:text-white transition"
                >
                  <i class="bi bi-file-earmark-pdf-fill"></i>
                  Lihat Akreditasi
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div id="peminatan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#f8fadf] text-[#ACB734] flex items-center justify-center shadow">
              <i class="bi bi-diagram-3-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#ACB734]">
              Fokus Pembelajaran
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              'Kewirausahaan Berbasis Teknologi',
              'Kewirausahaan Sosial',
              'Industri Kreatif',
              'Kearifan Lokal dan Pengembangan Bisnis'
            ] as $item)
              <div class="peminatan-card reveal">
                <i class="bi bi-check2-circle"></i>
                <span>{{ $item }}</span>
              </div>
            @endforeach
          </div>
        </div>

        <div id="profil-lulusan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#f8fadf] text-[#ACB734] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#ACB734]">
              Profil Lulusan
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              ['title' => 'Wirausahawan', 'desc' => 'Lulusan yang mampu mengenali peluang usaha, merancang produk baru, menyusun strategi produksi, pemasaran, serta mengelola permodalan untuk membuka lapangan kerja dan meningkatkan kesejahteraan masyarakat.', 'icon' => 'bi-shop-window'],
              ['title' => 'Konsultan Wirausaha', 'desc' => 'Individu yang kompeten dalam membantu merancang, mengembangkan, mendampingi, dan mendukung pemilik usaha dalam membangun serta mengembangkan bisnisnya.', 'icon' => 'bi-briefcase-fill'],
              ['title' => 'Inovator Bisnis', 'desc' => 'Lulusan yang mampu merancang solusi bisnis kreatif, adaptif, dan relevan dengan perkembangan teknologi serta dinamika pasar modern.', 'icon' => 'bi-lightbulb-fill'],
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#ACB734] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#ACB734] mb-1">
                    {{ $item['title'] }}
                  </h4>
                  <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $item['desc'] }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>

          <div class="mt-8 rounded-2xl border border-[#edf0cf] bg-white/70 p-6 text-gray-700 leading-relaxed">
            Program Studi Kewirausahaan hadir sebagai jawaban atas kebutuhan
            bangsa akan sumber daya manusia yang tidak hanya unggul secara
            akademis, tetapi juga siap menjadi pelaku perubahan dalam dunia
            bisnis. Mahasiswa dibekali teori bisnis, pengalaman praktis,
            kesempatan membangun usaha secara langsung, serta ruang eksploratif
            melalui pendekatan MBKM agar siap menciptakan unit usaha yang
            inovatif, adaptif, dan berdaya saing tinggi.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Kewirausahaan', 'accentColor' => '#ACB734', 'accentSoftClass' => 'bg-[#f8fadf]'])

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
    el.style.transitionDelay = `${(index % 4) * 60}ms`;
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
        link.classList.remove("text-[#ACB734]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#ACB734]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
