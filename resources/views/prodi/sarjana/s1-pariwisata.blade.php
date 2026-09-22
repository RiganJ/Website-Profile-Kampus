@extends('layouts.pariwisata')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Pariwisata',
  'label' => 'S1 Pariwisata',
  'subtitle' => 'Program studi unggulan yang menyiapkan lulusan pariwisata profesional, kreatif, berjiwa entrepreneur, dan siap bersaing di tingkat global.',
  'accent' => '#00adef',
  'accentSoft' => '#33bdf2',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#00adef] via-[#33bdf2] to-[#00adef] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#00adef] mb-4">Daftar Isi</h4>

          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Peminatan'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
              <li>
                <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                  <span class="text-gray-700 font-medium group-hover:text-[#00adef] transition-colors">
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
                      class="w-full h-full text-gray-400 group-hover:text-[#00adef]">
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
          'accent' => '#00adef',
          'accentSoft' => 'rgba(0, 173, 239, .12)',
          'title' => 'Visi & Misi',
          'vision' => 'Menjadi program studi yang unggul di tingkat nasional dalam bidang pengembangan ekonomi dan pariwisata berbasis kewirausahaan (entrepreneurship) pada tahun 2033.',
          'missions' => [
            'Menyelenggarakan pendidikan dan pengajaran pariwisata yang berkualitas dengan mengintegrasikan teori dan praktik.',
            'Mengembangkan penelitian di bidang pariwisata untuk menghasilkan pengetahuan baru dan berkontribusi pada pengembangan industri pariwisata.',
            'Menyelenggarakan pengabdian kepada masyarakat dalam bidang pengembangan pariwisata.',
            'Menjalin kemitraan dengan industri pariwisata dan pemangku kepentingan untuk meningkatkan kerja sama dalam pengembangan sumber daya manusia dan produk wisata.',
            'Mendorong pengembangan kewirausahaan di bidang pariwisata dan menghasilkan lulusan yang mampu menciptakan lapangan kerja sendiri.'
          ],
          'imageDefault' => 'modelprw1.png',
          'imageAlt' => 'Mahasiswa Pariwisata',
          'imagePosition' => 'left',
        ])

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#00adef] rounded-full blur-3xl opacity-30"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#e6f7ff] text-[#00adef] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
<h2 class="text-2xl font-semibold text-[#00adef]">
  Latar Belakang
</h2>
</div>

<p class="text-gray-700 leading-relaxed">
  Perkembangan industri pariwisata yang semakin dinamis menuntut tersedianya
  sumber daya manusia yang memiliki kompetensi akademik, keterampilan
  profesional, serta kemampuan beradaptasi terhadap perubahan global.
  Pariwisata tidak lagi dipandang sebagai sektor yang hanya berorientasi pada
  kunjungan wisatawan, tetapi telah berkembang menjadi penggerak pertumbuhan
  ekonomi, pelestarian budaya, pemberdayaan masyarakat, dan pembangunan
  berkelanjutan.
</p>

<p class="mt-4 text-gray-700 leading-relaxed">
  Kondisi tersebut mendorong kebutuhan akan pendidikan tinggi yang mampu
  menghasilkan lulusan yang menguasai ilmu kepariwisataan, manajemen, ekonomi
  pariwisata, serta kewirausahaan secara terpadu. Berangkat dari kebutuhan
  tersebut, Program Studi S1 Pariwisata Universitas Fort De Kock Bukittinggi
  hadir sebagai institusi pendidikan yang berfokus pada pengembangan
  kompetensi di bidang pariwisata melalui penyelenggaraan pendidikan,
  penelitian, dan pengabdian kepada masyarakat yang relevan dengan kebutuhan
  dunia kerja serta perkembangan industri.
</p>

<p class="mt-4 text-gray-700 leading-relaxed">
  Dengan memanfaatkan potensi pariwisata Sumatera Barat sebagai
  <em>"laboratorium pembelajaran"</em>, program studi ini berupaya mencetak
  lulusan yang inovatif, adaptif, berdaya saing, serta mampu memberikan
  kontribusi nyata dalam pengembangan pariwisata yang berkualitas,
  berkelanjutan, dan berorientasi pada kesejahteraan masyarakat.
</p>          </div>
        </div>

        @include('layouts.partials.prodi-tujuan-styled', [
          'prodiProfile' => $prodiProfile ?? null,
          'accent' => '#00adef',
          'accentSoft' => 'rgba(0, 173, 239, .12)',
          'items' => [
            'Menghasilkan lulusan pariwisata yang profesional, kreatif, dan mampu mengintegrasikan teori dengan praktik industri.',
            'Mengembangkan kompetensi penelitian dan inovasi untuk mendukung pengembangan destinasi serta industri pariwisata.',
            'Membentuk lulusan yang mampu melakukan pengabdian dan pemberdayaan masyarakat dalam bidang pariwisata.',
            'Menyiapkan lulusan yang mampu menjalin kemitraan industri serta mengembangkan kewirausahaan pariwisata.'
          ],
          'imageDefault' => 'modelprw2.png',
          'imageAlt' => 'Mahasiswa Pariwisata',
        ])

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Pariwisata',
          'accentColor' => '#00adef',
          'accentSoftClass' => 'bg-[#e6f7ff]',
          'borderClass' => 'border-[#c9e8f8]',
          'cardBgClass' => 'from-white via-[#f6fcff] to-[#eaf7fd]',
          'imageBgClass' => 'bg-[#dff3fd]',
          'chipRingClass' => 'ring-[#d6eef9]',
          'badgeClass' => 'bg-[#00adef]/10 text-[#00adef]',
          'badgeIcon' => 'bi bi-mortarboard-fill',
          'badgeLabel' => 'Program Studi Pariwisata',
          'description' => 'Berkomitmen menghasilkan lulusan yang unggul, profesional, dan berjiwa entrepreneur melalui pendidikan berbasis Outcome-Based Education (OBE), kolaborasi dengan dunia usaha dan industri, serta penguatan inovasi untuk mendukung pariwisata yang berkelanjutan.',          'highlightOne' => 'Hospitality',
          'highlightOneIcon' => 'bi bi-stars',
          'highlightTwo' => 'Entrepreneurship',
          'highlightTwoIcon' => 'bi bi-briefcase-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#00adef] mb-4">
              Timeline Akreditasi Program Studi
            </h4>
          </div>

<div class="history-item reveal">
  <div class="history-card">
    <h4>Awal Berdiri</h4>
    <p>
      Program Studi S1 Pariwisata Universitas Fort De Kock Bukittinggi resmi
      didirikan pada Juli 2023 sebagai wujud komitmen universitas dalam
      mendukung pengembangan pendidikan tinggi di bidang pariwisata serta
      memenuhi kebutuhan industri akan sumber daya manusia yang profesional dan
      berdaya saing. Sejak awal berdiri, program studi mengembangkan kurikulum
      yang mengintegrasikan aspek akademik, praktik, dan kewirausahaan, serta
      menawarkan tiga bidang peminatan, yaitu Kuliner, Usaha Perjalanan Wisata,
      dan Perhotelan.
    </p>
    <span
      class="inline-block px-3 py-1 bg-[#e6f7ff] text-[#00adef] rounded-full text-sm font-semibold">
      Juli 2023
    </span>
  </div>
</div>

<div class="history-item reveal">
  <div class="history-card">
    <h4>Pengembangan Program Studi</h4>
    <p>
      Sejak berdiri, Program Studi S1 Pariwisata terus melakukan pengembangan
      melalui penyempurnaan kurikulum berbasis Outcome-Based Education (OBE),
      penguatan pembelajaran berbasis praktik dan proyek, peningkatan kompetensi
      dosen, serta perluasan kerja sama dengan pemerintah, dunia usaha, dan
      dunia industri. Program studi juga mengembangkan laboratorium pembelajaran
      pada bidang Kuliner, Usaha Perjalanan Wisata, dan Perhotelan untuk
      mendukung pengalaman belajar yang sesuai dengan kebutuhan industri.
    </p>
    <span
      class="inline-block px-3 py-1 bg-[#e6f7ff] text-[#00adef] rounded-full text-sm font-semibold">
      Pengembangan Berkelanjutan
    </span>
  </div>
</div>

<div class="history-item reveal">
  <div class="history-card">
    <h4>Status Akreditasi</h4>
    <p>
      Program Studi S1 Pariwisata Universitas Fort De Kock Bukittinggi
      memperoleh Status Akreditasi <strong>Baik</strong> yang berlaku sejak
      <strong>14 Januari 2025</strong>. Saat ini program studi terus melakukan
      peningkatan mutu melalui penguatan kurikulum OBE, peningkatan kualitas
      SDM, kerja sama dengan dunia usaha dan industri, serta penguatan
      penelitian dan pengabdian kepada masyarakat sebagai persiapan menuju
      akreditasi <strong>Unggul</strong>.
    </p>
    <span
      class="inline-block px-3 py-1 bg-[#e6f7ff] text-[#00adef] rounded-full text-sm font-semibold">
      Akreditasi Baik
    </span>
  </div>
</div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Status akreditasi Program Studi S1 Pariwisata saat ini dapat
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
                <span class="inline-block px-3 py-1 bg-[#e6f7ff] text-[#00adef] rounded-full text-sm font-semibold">
                  {{ $accreditation?->predicate ?? 'Status Akreditasi' }}
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#00adef] text-[#00adef] text-sm font-semibold hover:bg-[#00adef] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#e6f7ff] text-[#00adef] flex items-center justify-center shadow">
              <i class="bi bi-diagram-3-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#00adef]">
              Peminatan
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              'Kuliner',
              'Perhotelan',
              'Usaha Perjalanan Wisata',
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
            <div class="w-11 h-11 rounded-xl bg-[#e6f7ff] text-[#00adef] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#00adef]">
              Profil Lulusan
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              ['title' => 'Konsultan & Pendamping Destinasi Wisata', 'desc' => 'Lulusan mampu berperan sebagai konsultan dan pendamping dalam perencanaan, pengembangan, serta pengelolaan destinasi wisata yang berkelanjutan dan berbasis potensi lokal.', 'icon' => 'bi-geo-alt-fill'],
              ['title' => 'Promosi & Pemasaran Pariwisata', 'desc' => 'Lulusan mampu mengelola kegiatan promosi dan pemasaran wisata baik secara konvensional maupun digital untuk meningkatkan daya tarik dan kunjungan wisata.', 'icon' => 'bi-megaphone-fill'],
              ['title' => 'Tenaga Profesional Hospitality', 'desc' => 'Lulusan siap bekerja secara profesional di sektor perhotelan, tour & travel, kapal pesiar, event organizer, dan industri hospitality lainnya.', 'icon' => 'bi-building-fill'],
              ['title' => 'Perencana & Wirausahawan Wisata', 'desc' => 'Lulusan mampu merancang dan mengelola kegiatan wisata edukatif serta mengembangkan usaha mandiri melalui produk dan layanan wisata yang bernilai ekonomi dan budaya.', 'icon' => 'bi-lightbulb-fill'],
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#00adef] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#00adef] mb-1">
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Pariwisata', 'accentColor' => '#00adef', 'accentSoftClass' => 'bg-[#e6f7ff]'])

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
        link.classList.remove("text-[#00adef]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#00adef]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
