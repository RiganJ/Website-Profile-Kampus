@extends('layouts.bisdig')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Bisnis Digital',
  'label' => 'S1 Bisnis Digital',
  'subtitle' => 'Program sarjana yang menyiapkan lulusan adaptif dalam pengembangan bisnis, teknologi digital, inovasi, dan kewirausahaan modern.',
  'accent' => '#6f4227',
  'accentSoft' => '#d3c6be',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#6f4227] via-[#d3c6be]/40 to-[#6f4227] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#6f4227] mb-4">Daftar Isi</h4>
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
                <span class="text-gray-700 font-medium group-hover:text-[#6f4227] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#6f4227]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

      <div class="lg:col-span-8 space-y-16">
        <div id="visi-misi" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#d3c6be]/20 text-[#6f4227] flex items-center justify-center shadow-sm">
              <i class="bi bi-compass-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#6f4227]">
              Visi & Misi Program Studi Sarjana Bisnis Digital
            </h2>
          </div>

          <div class="visi-box reveal mb-12">
            <span class="badge-visi text-white">VISI</span>
            <p class="mt-4 text-[17px] leading-relaxed text-white-700">
              Menjadi Program Studi Bisnis Digital yang unggul di bidang bisnis dan
              pemasaran digital serta mampu menciptakan technopreneur yang inovatif dan
              berdaya saing global pada tahun <strong>2033</strong>.
            </p>
          </div>

          <div class="flex flex-col lg:flex-row items-start gap-12">
            <div class="lg:w-5/12 relative hidden lg:block group">
              <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20 translate-y-6">
                <img
                  src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelbd2.png') ?? asset('images/model_s2_2.png') }}"
                  alt="Mahasiswa Bisnis Digital"
                  class="w-full max-w-xl mx-auto scale-110 drop-shadow-2xl"
                />
                <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
              </div>
            </div>

            <div class="lg:w-7/12 space-y-10">
              <div>
                <span class="badge-misi text-white">MISI</span>
                <ul class="misi-list mt-6 space-y-4">
                  <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                    <i class="bi bi-arrow-right-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="leading-relaxed">
                      Menyelenggarakan Tri Dharma Perguruan Tinggi yang bermutu,
                      berkarakter, dan berkesinambungan berbasis entrepreneur dan
                      teknologi informasi.
                    </span>
                  </li>

                  <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                    <i class="bi bi-arrow-right-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="leading-relaxed">
                      Mengembangkan dan meningkatkan kegiatan akademik yang efektif dan
                      efisien dalam suasana pembelajaran yang beretika dan bermartabat.
                    </span>
                  </li>

                  <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                    <i class="bi bi-arrow-right-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="leading-relaxed">
                      Menjalin kerja sama yang berkelanjutan dengan lembaga pendidikan,
                      pemerintah, dan dunia usaha di tingkat regional, nasional, serta
                      internasional dalam pengembangan bisnis digital.
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#6f4227] rounded-full blur-3xl opacity-30"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#d3c6be]/20 text-[#6f4227] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#6f4227]">
                Sejarah & Latar Belakang Berdirinya Prodi
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Berdirinya Program Studi Sarjana Bisnis Digital di Universitas Fort de Kock (UFDK) pada tahun 2019 merupakan
              respons strategis institusi terhadap disrupsi global yang dibawa oleh era transformasi digital dan Revolusi
              Industri 4.0. Pada masa ini, internet, e-commerce, dan Big Data telah mengubah lanskap ekonomi secara fundamental,
              menuntut adanya tenaga kerja dan wirausahawan yang menguasai integrasi bisnis dan teknologi. UFDK mengambil langkah
              progresif dengan memperluas fokus keilmuan di bawah Fakultas Ekonomi dan Bisnis untuk menyiapkan lulusan yang mampu
              bersaing dalam ekosistem digital.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Pendirian prodi ini mengakui bahwa masa depan perekonomian global akan didominasi oleh perusahaan berbasis teknologi,
              sehingga kurikulum dirancang secara khusus untuk menjembatani kesenjangan antara kemampuan bisnis konvensional dan
              kompetensi teknologi digital.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Program Studi Sarjana Bisnis Digital secara resmi memperoleh izin operasional berdasarkan Keputusan Menteri Pendidikan
              dan Kebudayaan Republik Indonesia Nomor <strong>51 E/O/2023</strong> tentang Izin Pembukaan Program Studi Bisnis Digital
              Program Sarjana pada Universitas Fort De Kock yang diselenggarakan oleh Yayasan Fort De Kock Bukittinggi.
            </p>
          </div>
        </div>

        <div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
            <div class="flex items-center gap-4 lg:col-span-12 mb-3">
              <div class="w-11 h-11 rounded-xl bg-[#d3c6be]/20 text-[#6f4227] flex items-center justify-center shadow-sm">
                <i class="bi bi-bullseye text-xl"></i>
              </div>
              <h3 class="text-2xl md:text-3xl font-semibold text-[#6f4227]">
                Tujuan Program Studi
              </h3>
            </div>

            <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
              <div class="relative group -mt-2">
                <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
                  <img
                    src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modelbd1.png') ?? asset('images/model_ners_2.jpg') }}"
                    alt="Mahasiswa Bisnis Digital"
                    class="w-full max-w-xl scale-110 drop-shadow-2xl"
                  />

                  <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700"></span>
                </div>
              </div>

              <div class="space-y-4 mt-1">
                <ul class="tujuan-list grid gap-3">
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#6f4227] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Menghasilkan lulusan yang memiliki kemampuan berwirausaha di era digital melalui penguasaan bisnis dan teknologi.
                    </span>
                  </li>

                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#6f4227] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Mencetak technopreneur yang inovatif, kreatif, dan mampu merancang serta mengelola startup berbasis digital.
                    </span>
                  </li>

                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#6f4227] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Membekali mahasiswa dengan integrasi ilmu Manajemen Bisnis, Teknologi Informasi, dan Kewirausahaan secara komprehensif.
                    </span>
                  </li>

                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#6f4227] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Mempersiapkan lulusan yang mandiri, adaptif, dan siap menghadapi dinamika ekonomi digital.
                    </span>
                  </li>

                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#6f4227] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#6f4227] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Berkontribusi dalam percepatan pembangunan sumber daya manusia sebagai penggerak utama ekonomi digital Indonesia.
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Bisnis Digital',
          'accentColor' => '#6f4227',
          'accentSoftClass' => 'bg-[#d3c6be]/20',
          'borderClass' => 'border-[#d3c6be]/50',
          'cardBgClass' => 'from-white via-[#f9f5f2] to-[#efe3db]',
          'imageBgClass' => 'bg-[#d7c2b5]',
          'chipRingClass' => 'ring-[#d3c6be]/60',
          'badgeClass' => 'bg-[#6f4227]/10 text-[#6f4227]',
          'badgeIcon' => 'bi bi-bar-chart-steps',
          'badgeLabel' => 'Bisnis Digital',
          'description' => 'Mengarahkan pengembangan akademik Program Studi Bisnis Digital untuk membentuk lulusan yang inovatif, adaptif, dan siap bersaing dalam ekosistem bisnis berbasis teknologi.',
          'highlightOne' => 'Digital Mindset',
          'highlightOneIcon' => 'bi bi-cpu-fill',
          'highlightTwo' => 'Technopreneurship',
          'highlightTwoIcon' => 'bi bi-lightbulb-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#6f4227] mb-4">
              Timeline Akreditasi Program Studi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2019</h4>
              <p>
                Program Studi Sarjana Bisnis Digital Universitas Fort De Kock didirikan
                sebagai respons terhadap transformasi digital dan Revolusi Industri 4.0.
              </p>
              <span class="inline-block px-3 py-1 bg-[#d3c6be]/20 text-[#6f4227] rounded-full text-sm font-semibold">
                Pendirian Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Arah Pengembangan</h4>
              <p>
                Kurikulum mengintegrasikan bisnis dan teknologi digital untuk menghasilkan
                lulusan yang adaptif dan berdaya saing.
              </p>
              <span class="inline-block px-3 py-1 bg-[#d3c6be]/20 text-[#6f4227] rounded-full text-sm font-semibold">
                Pengembangan Kurikulum
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Akreditasi</h4>
              <p>
                Terakreditasi <strong>Baik</strong> dengan masa berlaku
                15 November 2024 - 15 November 2029.
              </p>

              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#d3c6be]/20 text-[#6f4227] rounded-full text-sm font-semibold">
                  Status Akreditasi
                </span>

                @if(!empty($accreditation?->file))
                  <a
                    href="{{ $accreditation->file_url }}"
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#6f4227] text-[#6f4227] text-sm font-semibold hover:bg-[#6f4227] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#d3c6be]/20 text-[#6f4227] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#6f4227]">
              Profil Lulusan Program Studi Sarjana Bisnis Digital
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              [
                'title' => 'Digital Marketing Specialist',
                'desc'  => 'Lulusan mampu merancang, mengelola, dan mengevaluasi strategi pemasaran digital berbasis data melalui media sosial, SEO, SEM, dan platform digital lainnya.',
                'icon'  => 'bi-megaphone-fill'
              ],
              [
                'title' => 'Digital Business Consultant',
                'desc'  => 'Lulusan mampu memberikan solusi dan rekomendasi strategis bagi pengembangan bisnis digital dengan memanfaatkan teknologi informasi dan analisis pasar.',
                'icon'  => 'bi-briefcase-fill'
              ],
              [
                'title' => 'Technopreneur',
                'desc'  => 'Lulusan mampu menciptakan, membangun, dan mengelola startup atau usaha berbasis teknologi digital secara inovatif dan berkelanjutan.',
                'icon'  => 'bi-lightbulb-fill'
              ],
              [
                'title' => 'Business Analyst',
                'desc'  => 'Lulusan mampu menganalisis data bisnis dan tren pasar untuk mendukung pengambilan keputusan strategis dalam organisasi atau perusahaan digital.',
                'icon'  => 'bi-bar-chart-line-fill'
              ]
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#6f4227] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#6f4227] mb-1">
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Bisnis Digital', 'accentColor' => '#1f3f61', 'accentSoftClass' => 'bg-[#274f7a]/20'])

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
