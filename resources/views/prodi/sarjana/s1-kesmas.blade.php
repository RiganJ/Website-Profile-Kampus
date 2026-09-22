@extends('layouts.prodi')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Kesehatan Masyarakat',
  'label' => 'S1 Kesehatan Masyarakat',
  'subtitle' => 'Program sarjana unggulan yang menyiapkan tenaga kesehatan masyarakat profesional, inovatif, dan berdaya saing global.',
  'accent' => '#743B72',
  'accentSoft' => '#c7a3c5',
  'image' => file_exists(public_path('images/s1-kesmas-hero.jpg')) ? asset('images/s1-kesmas-hero.jpg') : asset('images/banner1.jpg'),
  'imagePosition' => 'center 34%',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#743B72] via-[#C7A3C5] to-[#743B72] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#743B72] mb-4">
            Daftar Isi
          </h4>

          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Peminatan'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Dosen'],
            ] as $item)
              <li>
                <a href="#{{ $item['id'] }}"
                   class="timeline-link flex items-center justify-between group">
                  <span class="text-gray-700 font-medium group-hover:text-[#743B72] transition-colors">
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
                         class="w-full h-full text-gray-400 group-hover:text-[#743B72]">
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
          'accent' => '#743B72',
          'accentSoft' => 'rgba(116, 59, 114, .12)',
          'title' => 'Visi & Misi',
          'vision' => 'Menghasilkan Sarjana Kesehatan Masyarakat yang unggul dalam promosi kesehatan dan berjiwa entrepreneur serta mampu berdaya saing global tahun 2033.',
          'missions' => [
            'Menyelenggarakan program pendidikan sarjana kesehatan masyarakat secara profesional, dalam pendekatan promosi kesehatan untuk menghasilkan lulusan yang berjiwa entrepreneurship dan inovatif, berkualitas serta mampu berdaya saing global.',
            'Mengembangkan penelitian yang menghasilkan karya ilmiah yang berdaya guna untuk kesehatan masyarakat mengarah pada promosi kesehatan dan entrepreneurship serta menunjang pembangunan nasional dan internasional.',
            'Melaksanakan pengabdian masyarakat yang berkontribusi dalam penanganan masalah kesehatan masyarakat serta mengembangkan promotif dan entrepreneurship kesehatan secara nasional dan internasional.',
            'Membangun kerja sama yang berkelanjutan dengan masyarakat, sektor swasta, pemerintah, dan lembaga-lembaga nasional dalam pengembangan pendidikan, penelitian, dan pengabdian masyarakat baik dalam maupun luar negeri.'
          ],
          'imageDefault' => 'modelkesmas5.png',
          'imageAlt' => 'Mahasiswa Kesehatan Masyarakat',
        ])

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#743B72] rounded-full blur-3xl opacity-40"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
            <div class="w-11 h-11 rounded-xl bg-[#f3eaf2] text-[#743B72] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#743B72]">
                Latar Belakang & Sejarah
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi S1 Kesehatan Masyarakat Universitas Fort De Kock (UFDK) Bukittinggi didirikan sebagai
              respons terhadap kebutuhan tenaga profesional di bidang kesehatan di Sumatera Barat. Pendirian dimulai
              pada tahun 2002 oleh Yayasan Pendidikan Fort De Kock Bukittinggi, dengan tujuan mengatasi keterbatasan lembaga
              pendidikan kesehatan di wilayah tersebut.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Pada 15 Juni 2004, prodi ini resmi berdiri sebagai bagian dari Sekolah Tinggi Ilmu Kesehatan (STIKes)
              Fort De Kock Bukittinggi, dengan fokus pada pendidikan kesehatan masyarakat, seperti epidemiologi,
              promosi kesehatan, dan manajemen layanan kesehatan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Prodi S1 Kesehatan Masyarakat memiliki durasi pendidikan 8 semester (4 tahun) dan beban studi sekitar
              145 SKS, termasuk mata kuliah dasar dan praktik lapangan. Saat ini, program studi ini terakreditasi
              <span class="inline-block px-3 py-1 bg-[#f3eaf2] text-[#743B72] rounded-full text-sm font-medium">
                Baik Sekali
              </span>
              oleh Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT).
            </p>
          </div>
        </div>

        @include('layouts.partials.prodi-tujuan-styled', [
          'prodiProfile' => $prodiProfile ?? null,
          'accent' => '#743B72',
          'accentSoft' => 'rgba(116, 59, 114, .12)',
          'items' => [
            'Menghasilkan lulusan kesehatan masyarakat yang unggul dalam promosi kesehatan dan berjiwa entrepreneur.',
            'Menghasilkan penelitian kesehatan masyarakat yang aplikatif, inovatif, dan bermanfaat bagi pembangunan kesehatan.',
            'Mengembangkan pengabdian masyarakat yang mendukung pemecahan masalah kesehatan berbasis promotif dan preventif.',
            'Membangun jejaring kerja sama berkelanjutan dengan masyarakat, pemerintah, swasta, dan lembaga nasional maupun internasional.'
          ],
          'imageDefault' => 'modelkesmas4.png',
          'imageAlt' => 'Mahasiswa Kesehatan Masyarakat',
        ])

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Kesehatan Masyarakat',
          'accentColor' => '#743B72',
          'accentSoftClass' => 'bg-orange-100',
          'borderClass' => 'border-[#d8c0d6]/40',
          'cardBgClass' => 'from-white via-[#fff8ff] to-[#f6eef7]',
          'imageBgClass' => 'bg-[#ebddec]',
          'chipRingClass' => 'ring-[#ead8e8]/60',
          'badgeClass' => 'bg-[#743B72]/10 text-[#743B72]',
          'badgeIcon' => 'bi bi-mortarboard-fill',
          'badgeLabel' => 'Program Studi Kesmas',
          'description' => 'Memimpin pengembangan akademik Program Studi S1 Kesehatan Masyarakat untuk melahirkan lulusan yang unggul dalam promosi kesehatan, inovatif, dan siap menjawab tantangan kesehatan masyarakat secara global.',
          'highlightOne' => 'Akademik Unggul',
          'highlightOneIcon' => 'bi bi-stars',
          'highlightTwo' => 'Promosi Kesehatan',
          'highlightTwoIcon' => 'bi bi-megaphone-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#743B72] mb-4">Timeline Akreditasi Prodi S1 Kesehatan Masyarakat</h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2004</h4>
              <p>
                Program Studi S1 Kesehatan Masyarakat resmi berdiri sebagai bagian dari Sekolah Tinggi Ilmu Kesehatan (STIKes) Fort De Kock Bukittinggi berdasarkan
                <strong>SK Nomor 77/D/O/2004</strong> tertanggal 15 Juni 2004.
              </p>
              <span class="inline-block px-3 py-1 bg-[#f3eaf2] text-[#743B72] rounded-full text-sm font-medium">SK Pendirian</span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2014</h4>
              <p>
                Program Studi S1 Kesehatan Masyarakat meraih akreditasi pertama dengan peringkat <strong>B</strong> berdasarkan 7 standar akreditasi.
              </p>
              <span class="inline-block px-3 py-1 bg-[#f3eaf2] text-[#743B72] rounded-full text-sm font-medium">Akreditasi B</span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2021</h4>
              <p>
                Program studi menjalani proses reakreditasi dan berhasil meraih <strong>predikat Baik Sekali</strong>.
              </p>
              <span class="inline-block px-3 py-1 bg-[#f3eaf2] text-[#743B72] rounded-full text-sm font-medium">Baik Sekali</span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Saat ini, Program Studi S1 Kesehatan Masyarakat telah berhasil meraih
                <strong>Baik Sekali</strong> dan dokumen akreditasi resminya dapat ditinjau
                melalui file yang tersedia.
              </p>
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#f3eaf2] text-[#743B72] rounded-full text-sm font-medium">Status Akreditasi</span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#743B72] text-[#743B72] text-sm font-semibold hover:bg-[#743B72] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#f3eaf2] text-[#743B72] flex items-center justify-center shadow">
              <i class="bi bi-diagram-3-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#743B72]">
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

        <div id="profil-lulusan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#f3eaf2] text-[#743B72] flex items-center justify-center shadow">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#743B72]">
              Profil Lulusan
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              ['title'=>'Manager', 'desc'=>'Lulusan Sarjana Kesehatan Masyarakat mampu mengatur dan bekerja sama dengan berbagai bidang terkait dalam memberi solusi masalah kesehatan.', 'icon'=>'bi-diagram-3-fill'],
              ['title'=>'Leader', 'desc'=>'Lulusan diharapkan mampu mengatasi health inequality dan berperan dalam kebijakan yang mendukung kepentingan kesehatan masyarakat.', 'icon'=>'bi-person-circle'],
              ['title'=>'Researcher', 'desc'=>'Lulusan mampu mengembangkan penelitian inovatif di bidang ilmu kesehatan masyarakat yang berbasis evidence.', 'icon'=>'bi-search-heart-fill'],
              ['title'=>'Educator', 'desc'=>'Lulusan mampu menyusun model pembelajaran kesehatan masyarakat dengan mempertimbangkan aspek pendidikan, sosial ekonomi, dan budaya.', 'icon'=>'bi-easel-fill'],
              ['title'=>'Communication', 'desc'=>'Lulusan dapat mengembangkan komunikasi program pelayanan kesehatan masyarakat agar diterima oleh masyarakat dan pihak terkait.', 'icon'=>'bi-megaphone-fill'],
              ['title'=>'Entrepreneur', 'desc'=>'Lulusan diharapkan mampu mengorganisir dan mengoperasikan usaha dalam bidang kesehatan, serta mempromosikan kesehatan sebagai industri yang menguntungkan.', 'icon'=>'bi-gear-fill'],
              ['title'=>'Consultant', 'desc'=>'Lulusan mampu menangani tanggung jawab untuk klien dengan melakukan penelitian, analisis masalah, serta memberikan solusi yang tepat.', 'icon'=>'bi-shield-check']
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Kesehatan Masyarakat', 'accentColor' => '#743B72', 'accentSoftClass' => 'bg-[#f3eaf2]'])

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
        link.classList.remove("text-[#743B72]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#743B72]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
