@extends('layouts.pariwisata')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Hukum',
  'label' => 'S1 Hukum',
  'subtitle' => 'Program studi yang menyiapkan sarjana hukum berkualitas, profesional, berintegritas, menjunjung kearifan lokal, dan siap bersaing secara global.',
  'accent' => '#009B4C',
  'accentSoft' => '#80CDA6',
])

<style>
  .hukum-theme .peminatan-card i,
  .hukum-theme .peminatan-card span,
  .hukum-theme .history-card h4,
  .hukum-theme .lulusan-card h4 {
    color: #009B4C;
  }

  .hukum-theme .lulusan-card .icon-box {
    color: #009B4C;
    background: rgba(128, 205, 166, .16);
  }

  .hukum-theme .visi-box {
    background: linear-gradient(135deg, #80CDA6, #009B4C);
  }

  .hukum-theme .badge-visi,
  .hukum-theme .badge-misi {
    background: #009B4C;
    color: #fff;
  }

  .hukum-theme .history-timeline::before {
    background: linear-gradient(to bottom, #009B4C, #80CDA6);
  }
</style>

<section class="hukum-theme py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#009B4C] via-[#80CDA6] to-[#009B4C] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#009B4C] mb-4">Daftar Isi</h4>

          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Fokus Kompetensi'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
              <li>
                <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                  <span class="text-gray-700 font-medium group-hover:text-[#009B4C] transition-colors">
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
                      class="w-full h-full text-gray-400 group-hover:text-[#009B4C]">
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
        @include('layouts.partials.prodi-visi-misi-styled', [
          'prodiProfile' => $prodiProfile ?? null,
          'accent' => '#009B4C',
          'accentSoft' => 'rgba(128, 205, 166, .18)',
          'title' => 'Visi & Misi',
          'vision' => 'Menjadikan Program Studi Hukum sebagai pusat pengembangan ilmu terkemuka yang menghasilkan sarjana hukum berkualitas, profesional, kompetitif, mandiri, menjunjung tinggi kearifan lokal, serta memiliki daya saing global tahun 2033.',
          'missions' => [
            'Menyelenggarakan pendidikan dalam ilmu hukum yang berkualitas dan profesional.',
            'Menyelenggarakan Program Studi Ilmu Hukum yang menganut prinsip-prinsip tata kelola yang baik.',
            'Melaksanakan dan mengembangkan penelitian serta pengabdian kepada masyarakat di bidang hukum.',
            'Melaksanakan dan mengembangkan kerja sama dengan pihak lain di bidang hukum dengan prinsip kesetaraan dan kemanfaatan.',
            'Menyelenggarakan pendidikan dengan metode pembelajaran yang bebas, merdeka, dan terbuka hingga melahirkan praktisi hukum yang handal.'
          ],
          'imageDefault' => 'modelhukum2.png',
          'imageAlt' => 'Mahasiswa Hukum',
          'imagePosition' => 'left',
        ])

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#009B4C] rounded-full blur-3xl opacity-25"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#e8f7ef] text-[#009B4C] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#009B4C]">
                Sejarah dan Latar Belakang
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi Hukum didirikan pada tahun 2024 dengan tujuan utama
              untuk memenuhi kebutuhan masyarakat akan profesional yang kompeten
              di bidang hukum, serta berperan aktif dalam penegakan hukum di
              tingkat nasional maupun internasional.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Seiring dengan perkembangan zaman dan dinamika kehidupan sosial,
              politik, dan ekonomi, hukum memainkan peranan yang semakin penting
              dalam menjaga ketertiban, keadilan, dan perlindungan hak-hak
              individu maupun kelompok dalam masyarakat.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Sebagai bagian dari perguruan tinggi, Program Studi Hukum
              berkomitmen menyediakan pendidikan berkualitas dengan kurikulum
              yang berorientasi pada pengembangan keilmuan, keterampilan praktik
              hukum, dan penguatan etika profesi.
            </p>
          </div>
        </div>

        @include('layouts.partials.prodi-tujuan-styled', [
          'prodiProfile' => $prodiProfile ?? null,
          'accent' => '#009B4C',
          'accentSoft' => 'rgba(128, 205, 166, .18)',
          'items' => [
            'Melahirkan sarjana hukum yang menguasai teori hukum, keterampilan praktik hukum, serta memiliki integritas moral dan etika profesi yang tinggi.',
            'Menyiapkan lulusan yang mampu berperan sebagai pengacara, hakim, jaksa, notaris, konsultan hukum, legal officer, maupun profesi lain yang membutuhkan pemahaman hukum mendalam.',
            'Mengembangkan kemampuan lulusan untuk menerapkan hukum secara efektif dan adil dalam berbagai situasi praktis.',
            'Membentuk sarjana hukum yang mampu menjawab tantangan globalisasi, perkembangan teknologi, dan perubahan regulasi yang terus-menerus.'
          ],
          'imageDefault' => 'modelhukum1.png',
          'imageAlt' => 'Mahasiswa Hukum',
        ])

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Hukum',
          'accentColor' => '#009B4C',
          'accentSoftClass' => 'bg-[#e8f7ef]',
          'borderClass' => 'border-[#bfe5d0]',
          'cardBgClass' => 'from-white via-[#f5fcf8] to-[#e8f7ef]',
          'imageBgClass' => 'bg-[#dff3e8]',
          'chipRingClass' => 'ring-[#ccebd9]',
          'badgeClass' => 'bg-[#009B4C]/10 text-[#009B4C]',
          'badgeIcon' => 'bi bi-bank2',
          'badgeLabel' => 'Program Studi Hukum',
          'description' => 'Memimpin pengembangan akademik Program Studi S1 Hukum dengan fokus pada penguatan ilmu hukum, praktik profesi, etika, kearifan lokal, dan daya saing global.',
          'highlightOne' => 'Praktik Hukum',
          'highlightOneIcon' => 'bi bi-briefcase-fill',
          'highlightTwo' => 'Etika Profesi',
          'highlightTwoIcon' => 'bi bi-shield-check',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#009B4C] mb-4">
              Timeline Akreditasi Program Studi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Awal Berdiri</h4>
              <p>
                Program Studi S1 Hukum didirikan pada tahun 2024 untuk menjawab
                kebutuhan masyarakat terhadap profesional hukum yang kompeten,
                beretika, dan mampu berkontribusi dalam penegakan hukum.
              </p>
              <span class="inline-block px-3 py-1 bg-[#e8f7ef] text-[#009B4C] rounded-full text-sm font-semibold">
                Pendirian Prodi 2024
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Pengembangan</h4>
              <p>
                Kurikulum dikembangkan untuk memadukan teori hukum, praktik
                profesi, penelitian, pengabdian kepada masyarakat, serta kerja
                sama yang berlandaskan kesetaraan dan kemanfaatan.
              </p>
              <span class="inline-block px-3 py-1 bg-[#e8f7ef] text-[#009B4C] rounded-full text-sm font-semibold">
                Penguatan Kurikulum
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Status akreditasi Program Studi S1 Hukum saat ini dapat
                ditinjau melalui dokumen resmi yang tersedia pada tombol berikut.
              </p>
              @if($accreditation)
              <div class="mt-4 grid gap-2 text-sm text-gray-700">
                <p><strong>Peringkat:</strong> {{ $accreditation->predicate }}</p>
                <p><strong>Nomor SK:</strong> {{ $accreditation->nomor_sk }}</p>
                <p><strong>Lembaga:</strong> {{ $accreditation->lembaga }}</p>
              </div>
              @endif
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#e8f7ef] text-[#009B4C] rounded-full text-sm font-semibold">
                  {{ $accreditation?->predicate ?? 'Status Akreditasi' }}
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#009B4C] text-[#009B4C] text-sm font-semibold hover:bg-[#009B4C] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#e8f7ef] text-[#009B4C] flex items-center justify-center shadow">
              <i class="bi bi-diagram-3-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#009B4C]">
              Fokus Kompetensi
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              'Penguasaan teori dan asas-asas hukum',
              'Keterampilan praktik hukum dan advokasi',
              'Penelitian dan pengabdian bidang hukum',
              'Etika profesi dan integritas penegakan hukum',
              'Legal drafting, konsultasi, dan kepatuhan hukum',
              'Kesiapan menghadapi dinamika regulasi global'
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
            <div class="w-11 h-11 rounded-xl bg-[#e8f7ef] text-[#009B4C] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#009B4C]">
              Profil Lulusan
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              ['title' => 'Penegak Hukum / Praktisi Hukum', 'desc' => 'Lulusan siap berperan sebagai pengacara, hakim, jaksa, notaris, konsultan hukum, maupun profesi hukum lain yang membutuhkan penguasaan hukum secara mendalam.', 'icon' => 'bi-bank2'],
              ['title' => 'Akademisi / Peneliti', 'desc' => 'Lulusan mampu mengembangkan kajian hukum melalui penelitian, publikasi, dan pengabdian kepada masyarakat untuk memperkuat pengetahuan hukum yang berdampak.', 'icon' => 'bi-journal-text'],
              ['title' => 'Legal Officer', 'desc' => 'Lulusan memiliki kompetensi untuk menangani legal drafting, kepatuhan hukum, konsultasi internal, dan analisis regulasi pada institusi publik maupun swasta.', 'icon' => 'bi-file-earmark-check-fill'],
              ['title' => 'Profesional Hukum Berdaya Saing Global', 'desc' => 'Lulusan dibekali etika profesi, kemandirian, wawasan global, dan kemampuan menjawab perubahan regulasi serta perkembangan teknologi.', 'icon' => 'bi-globe2'],
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#009B4C] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#009B4C] mb-1">
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Hukum', 'accentColor' => '#009B4C', 'accentSoftClass' => 'bg-[#e8f7ef]'])

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
        link.classList.remove("text-[#009B4C]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#009B4C]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
