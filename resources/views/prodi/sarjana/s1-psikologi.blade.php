@extends('layouts.psikologi')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Psikologi',
  'label' => 'S1 Psikologi',
  'subtitle' => 'Program studi unggul tingkat nasional dalam menghasilkan Sarjana Psikologi yang berdaya saing global dan inovatif dalam dukungan psikososial.',
  'accent' => '#2d9a99',
  'accentSoft' => '#36b8b7',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#2d9a99] via-[#36b8b7] to-[#2d9a99] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#2d9a99] mb-4">Daftar Isi</h4>

          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'pimpinan','label'=>'Ketua Prodi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
              <li>
                <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                  <span class="text-gray-700 font-medium group-hover:text-[#2d9a99] transition-colors">
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
                      class="w-full h-full text-gray-400 group-hover:text-[#2d9a99]">
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
            <div class="w-11 h-11 rounded-xl bg-[#dff6f6] text-[#2d9a99] flex items-center justify-center shadow-sm">
              <i class="bi bi-compass-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#2d9a99]">
              Visi & Misi Program Studi S1 Psikologi
            </h2>
          </div>

          <div class="visi-box reveal mb-12">
            <span class="badge-visi text-white">VISI</span>
            <p class="mt-4 text-[17px] leading-relaxed">
              Menjadi Program Studi unggul tingkat nasional dalam menghasilkan
              Sarjana Psikologi yang berdaya saing global dan inovatif dalam
              peningkatan kualitas kehidupan dengan fokus pada dukungan
              psikososial tahun 2033.
            </p>
          </div>

          <div class="flex flex-col lg:flex-row items-start gap-12">
            <div class="lg:w-5/12 relative hidden lg:block group">
              <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20 translate-y-6">
                <img
                  src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelpsi1.png') ?? asset('images/model_ners_1.jpg') }}"
                  alt="Mahasiswa Psikologi"
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
                    'Melaksanakan Tri Dharma Perguruan Tinggi secara profesional dan taat asas di bidang psikologi.',
                    'Menyelenggarakan pendidikan Sarjana Psikologi berstandar nasional serta mendorong pemanfaatannya dalam meningkatkan kualitas hidup individu dan masyarakat.',
                    'Mewujudkan pengabdian kepada masyarakat melalui penerapan ilmu psikologi, khususnya dalam bidang kesehatan mental, dukungan psikososial, dan trauma healing.',
                    'Menghasilkan Sarjana Psikologi yang kompeten, menguasai konsep psikologi, berpikir kritis, dan memiliki kesadaran sosial.'
                  ] as $item)
                    <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                      <i class="bi bi-arrow-right-circle-fill text-[#2d9a99] mt-1"></i>
                      <span class="leading-relaxed">{{ $item }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#36b8b7] rounded-full blur-3xl opacity-30"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#dff6f6] text-[#2d9a99] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#2d9a99]">
                Latar Belakang
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Universitas Fort De Kock berperan aktif dalam penyelenggaraan
              pendidikan tinggi guna menghasilkan sumber daya manusia yang
              berkualitas, profesional, mandiri, dan berjiwa wirausaha, selaras
              dengan kebutuhan pembangunan dan dinamika masyarakat.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Sebagai bentuk kontribusi nyata terhadap tantangan sosial dan
              kesehatan yang semakin kompleks, universitas mendirikan Program
              Studi Sarjana Psikologi berdasarkan SK Mendikbudristek Nomor
              302/E/0/2024, bersamaan dengan pembentukan beberapa program studi
              baru lainnya.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Program studi ini dirancang untuk menjawab kebutuhan masyarakat
              akan layanan kesehatan mental yang aplikatif, empatik, dan
              kontekstual, melalui pendidikan yang menekankan keseimbangan antara
              penguasaan keilmuan, keterampilan interpersonal, kepekaan sosial,
              serta nilai etika dan tanggung jawab kemanusiaan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Pengembangan kurikulum mengacu pada regulasi nasional seperti
              UU No. 12 Tahun 2012, SN-Dikti, dan KKNI Level 6, serta
              diselaraskan dengan standar kompetensi dan Kode Etik Psikologi
              Indonesia guna menghasilkan lulusan yang kompeten dan berintegritas.
            </p>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Psikologi',
          'accentColor' => '#2d9a99',
          'accentSoftClass' => 'bg-[#dff6f6]',
          'borderClass' => 'border-[#bfe8e7]',
          'cardBgClass' => 'from-white via-[#f6fffe] to-[#eafaf9]',
          'imageBgClass' => 'bg-[#dff6f6]',
          'chipRingClass' => 'ring-[#d6f0ef]',
          'badgeClass' => 'bg-[#2d9a99]/10 text-[#2d9a99]',
          'badgeIcon' => 'bi bi-mortarboard-fill',
          'badgeLabel' => 'Program Studi Psikologi',
          'description' => 'Memimpin pengembangan akademik Program Studi S1 Psikologi dengan fokus pada penguatan ilmu psikologi, layanan psikososial, kesehatan mental, dan pengembangan karakter lulusan yang adaptif serta berdaya saing.',
          'highlightOne' => 'Psikososial',
          'highlightOneIcon' => 'bi bi-heart-pulse-fill',
          'highlightTwo' => 'Kesehatan Mental',
          'highlightTwoIcon' => 'bi bi-stars',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#2d9a99] mb-4">
              Timeline Akreditasi Program Studi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Awal Pengembangan</h4>
              <p>
                Program Studi S1 Psikologi dikembangkan untuk menjawab kebutuhan
                masyarakat akan layanan kesehatan mental, dukungan psikososial,
                dan penguatan kualitas hidup yang berbasis keilmuan psikologi.
              </p>
              <span class="inline-block px-3 py-1 bg-[#dff6f6] text-[#2d9a99] rounded-full text-sm font-semibold">
                Arah Pengembangan
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2024</h4>
              <p>
                Program Studi Sarjana Psikologi Universitas Fort De Kock resmi
                didirikan berdasarkan SK Mendikbudristek Nomor 302/E/0/2024.
              </p>
              <span class="inline-block px-3 py-1 bg-[#dff6f6] text-[#2d9a99] rounded-full text-sm font-semibold">
                Pendirian Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Status akreditasi Program Studi S1 Psikologi saat ini dapat
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
                <span class="inline-block px-3 py-1 bg-[#dff6f6] text-[#2d9a99] rounded-full text-sm font-semibold">
                  {{ $accreditation?->predicate ?? 'Status Akreditasi' }}
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#2d9a99] text-[#2d9a99] text-sm font-semibold hover:bg-[#2d9a99] hover:text-white transition"
                >
                  <i class="bi bi-file-earmark-pdf-fill"></i>
                  Lihat Akreditasi
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
            <div class="flex items-center gap-4 lg:col-span-12 mb-3">
              <div class="w-11 h-11 rounded-xl bg-[#dff6f6] text-[#2d9a99] flex items-center justify-center shadow-sm">
                <i class="bi bi-bullseye text-xl"></i>
              </div>
              <h3 class="text-2xl md:text-3xl font-semibold text-[#2d9a99]">
                Tujuan Program Studi
              </h3>
            </div>

            <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
              <div class="relative group -mt-2">
                <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
                  <img
                    src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modelpsi3.png') ?? asset('images/model_ners_2.jpg') }}"
                    alt="Mahasiswa Psikologi"
                    class="w-full max-w-xl scale-110 drop-shadow-2xl"
                  />
                  <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700"></span>
                </div>
              </div>

              <div class="space-y-4 mt-1">
                <ul class="tujuan-list grid gap-3">
                  @foreach([
                    'Menghasilkan lulusan Sarjana Psikologi yang mampu mengaplikasikan ilmu psikologi secara etis dan bertanggung jawab bagi diri sendiri dan masyarakat.',
                    'Membekali lulusan dengan penguasaan teori dan metode psikologi yang terintegrasi dengan pendekatan psikososial, komunitas, dan budaya.',
                    'Mengembangkan keterampilan dukungan psikososial yang bersifat preventif dan promotif untuk meningkatkan kesejahteraan psikologis.',
                    'Mempersiapkan lulusan yang kompeten dalam asesmen, intervensi, penelitian, serta pengabdian kepada masyarakat.',
                    'Mendorong lulusan berperan aktif dalam pengembangan ilmu, kewirausahaan, dan pemecahan masalah psikososial di tingkat lokal dan nasional.'
                  ] as $item)
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#36b8b7] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#36b8b7] mt-1"></i>
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

        <div id="profil-lulusan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#dff6f6] text-[#2d9a99] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#2d9a99]">
              Profil Lulusan Program Studi S1 Psikologi
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              ['title' => 'Asisten Psikolog', 'desc' => 'Tenaga profesional yang bekerja di bawah pengawasan psikolog sesuai kewenangan yang diatur oleh Kode Etik Psikologi dan peraturan perundang-undangan.', 'icon' => 'bi-person-check-fill'],
              ['title' => 'Konselor Psikologi', 'desc' => 'Tenaga profesional yang memberikan layanan konseling psikologi dengan fokus pada upaya preventif dan promotif berdasarkan teori dan konsep psikologi.', 'icon' => 'bi-chat-heart-fill'],
              ['title' => 'Konsultan Psikologi', 'desc' => 'Tenaga profesional yang memberikan jasa konsultasi psikologi sesuai kompetensi sebagai Sarjana Psikologi.', 'icon' => 'bi-lightbulb-fill'],
              ['title' => 'Peneliti Psikologi', 'desc' => 'Tenaga profesional yang melakukan penelitian psikologi menggunakan metode ilmiah untuk menemukan dan mengembangkan pengetahuan psikologi.', 'icon' => 'bi-search'],
              ['title' => 'Tenaga Profesional Multisektor', 'desc' => 'Tenaga kerja di bidang kesehatan, komunitas, pendidikan, serta industri dan organisasi dengan penerapan ilmu psikologi.', 'icon' => 'bi-people-fill'],
              ['title' => 'Pemberi Intervensi Psikologis', 'desc' => 'Tenaga profesional yang memberikan intervensi psikologis kepada masyarakat melalui berbagai media secara etis dan bertanggung jawab.', 'icon' => 'bi-chat-square-heart-fill'],
              ['title' => 'Pelaku Usaha Mandiri', 'desc' => 'Lulusan yang mampu mengembangkan usaha mandiri dengan mengaplikasikan ilmu psikologi dan pengelolaan bisnis.', 'icon' => 'bi-briefcase-fill'],
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#2d9a99] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#2d9a99] mb-1">
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Psikologi', 'accentColor' => '#2d9a99', 'accentSoftClass' => 'bg-[#dff6f6]'])

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
        link.classList.remove("text-[#2d9a99]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#2d9a99]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

@endsection
