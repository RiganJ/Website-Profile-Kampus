@extends('layouts.fisiotrapi')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Fisioterapi',
  'label' => 'S1 Fisioterapi',
  'subtitle' => 'Program studi unggul yang menghasilkan fisioterapis berdaya saing global dalam bidang fisioterapi muskuloskeletal.',
  'accent' => '#274f7a',
  'accentSoft' => '#4e6f92',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#1f3f61] via-[#4e6f92]/40 to-[#1f3f61] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#1f3f61] mb-4">Daftar Isi</h4>
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
                <span class="text-gray-700 font-medium group-hover:text-[#1f3f61] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#1f3f61]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <div class="w-11 h-11 rounded-xl bg-[#274f7a]/20 text-[#1f3f61] flex items-center justify-center shadow-sm">
              <i class="bi bi-compass-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#1f3f61]">
              Visi & Misi Program Studi S1 Fisioterapi
            </h2>
          </div>

          <div class="visi-box reveal mb-12">
            <span class="badge-visi text-white">VISI</span>
            <p class="mt-4 text-[17px] leading-relaxed text-white-700">
              Mewujudkan program studi yang unggul dalam rangka menghasilkan
              fisioterapis yang berdaya saing global dalam bidang fisioterapi
              musculoskeletal pada Tahun <strong>2033</strong>.
            </p>
          </div>

          <div class="flex flex-col lg:flex-row items-start gap-12">
            <div class="lg:w-5/12 relative hidden lg:block group">
              <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20 translate-y-6">
                <img
                  src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelfisio1.png') ?? asset('images/model_s2_2.png') }}"
                  alt="Mahasiswa Fisioterapi"
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
                    <i class="bi bi-arrow-right-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="leading-relaxed">
                      Menyelenggarakan Tri Dharma Pendidikan Fisioterapi yang bermutu, berkarekter, dan berkesinambungan pada bidang fisioterapi muskuloskeletal.
                    </span>
                  </li>
                  <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                    <i class="bi bi-arrow-right-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="leading-relaxed">
                      Meningkatkan kualitas tata kelola program studi yang baik menuju tata kelola sesuai standar.
                    </span>
                  </li>
                  <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                    <i class="bi bi-arrow-right-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="leading-relaxed">
                      Menjalin kerja sama yang produktif dan berkelanjutan bersama masyarakat, sektor swasta, pemerintah, dan lembaga-lembaga internasional dalam pengembangan pendidikan, penelitian, dan pengabdian masyarakat.
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#274f7a] rounded-full blur-3xl opacity-30"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#274f7a]/20 text-[#1f3f61] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#274f7a]">
                Sejarah & Latar Belakang Berdirinya Prodi
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi Sarjana (S1) Fisioterapi Universitas Fort De Kock (UFDK) Bukittinggi didirikan sebagai bagian dari
              komitmen universitas dalam mengembangkan pendidikan tinggi di bidang kesehatan, khususnya fisioterapi, guna
              menjawab kebutuhan tenaga kesehatan yang <strong>profesional, kompeten, dan berdaya saing</strong> di tingkat nasional
              maupun global.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Cikal bakal Program Studi S1 Fisioterapi berawal dari keberadaan Program Studi Diploma III Fisioterapi yang telah
              lebih dahulu berdiri dan berkembang. Seiring dengan peningkatan kebutuhan layanan fisioterapi berbasis ilmu
              pengetahuan dan teknologi serta permintaan pasar kerja terhadap tenaga fisioterapis yang memiliki kualifikasi
              sarjana, maka dirintislah pembukaan jenjang pendidikan S1 Fisioterapi.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Program Studi S1 Fisioterapi secara resmi memperoleh izin operasional berdasarkan Keputusan Menteri Pendidikan dan
              Kebudayaan Republik Indonesia Nomor <strong>51 E/O/2023</strong> tentang Izin Pembukaan Program Studi Fisioterapi
              Program Sarjana pada Universitas Fort De Kock yang diselenggarakan oleh Yayasan Fort De Kock Bukittinggi.
            </p>
          </div>
        </div>

        <div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
            <div class="flex items-center gap-4 lg:col-span-12 mb-3">
              <div class="w-11 h-11 rounded-xl bg-[#274f7a]/20 text-[#1f3f61] flex items-center justify-center shadow-sm">
                <i class="bi bi-bullseye text-xl"></i>
              </div>
              <h3 class="text-2xl md:text-3xl font-semibold text-[#1f3f61]">
                Tujuan Program Studi
              </h3>
            </div>

            <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
              <div class="relative group -mt-2">
                <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
                  <img
                    src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modelfisio2.png') ?? asset('images/model_ners_2.jpg') }}"
                    alt="Mahasiswa Fisioterapi"
                    class="w-full max-w-xl scale-110 drop-shadow-2xl"
                  />
                  <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700"></span>
                </div>
              </div>

              <div class="space-y-4 mt-1">
                <ul class="tujuan-list grid gap-3">
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#274f7a] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Menghasilkan lulusan fisioterapis yang kompeten, profesional, dan siap bersaing di era digital dan revolusi industri kesehatan.
                    </span>
                  </li>
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#274f7a] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Meningkatkan keterampilan fisioterapis yang adaptif, humanis, dan dapat bekerja di berbagai sektor kesehatan.
                    </span>
                  </li>
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#274f7a] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Mempersiapkan lulusan dengan etika profesional dan pemahaman tentang pentingnya peran fisioterapi dalam pelayanan kesehatan masyarakat.
                    </span>
                  </li>
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#274f7a] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Memberikan mahasiswa pemahaman tentang cara membantu orang kembali bergerak dan hidup lebih sehat melalui fisioterapi.
                    </span>
                  </li>
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#274f7a] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#274f7a] mt-1"></i>
                    <span class="text-gray-700 leading-relaxed">
                      Mendorong lulusan untuk berperan aktif dalam pengembangan ilmu dan praktik fisioterapi untuk kesejahteraan masyarakat.
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Fisioterapi',
          'accentColor' => '#1f3f61',
          'accentSoftClass' => 'bg-[#274f7a]/20',
          'borderClass' => 'border-[#9fb6cf]/40',
          'cardBgClass' => 'from-white via-[#f6f9fc] to-[#eaf0f7]',
          'imageBgClass' => 'bg-[#d7e3ef]',
          'chipRingClass' => 'ring-[#d0dceb]/70',
          'badgeClass' => 'bg-[#274f7a]/10 text-[#1f3f61]',
          'badgeIcon' => 'bi bi-activity',
          'badgeLabel' => 'Program Studi Fisioterapi',
          'description' => 'Memimpin pengembangan akademik Program Studi S1 Fisioterapi untuk menghasilkan lulusan yang profesional, adaptif, dan unggul dalam layanan fisioterapi berbasis ilmu pengetahuan dan kebutuhan masyarakat.',
          'highlightOne' => 'Akademik Unggul',
          'highlightOneIcon' => 'bi bi-stars',
          'highlightTwo' => 'Fisioterapi Profesional',
          'highlightTwoIcon' => 'bi bi-heart-pulse-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#1f3f61] mb-4">
              Timeline Sejarah dan Akreditasi Prodi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Universitas Fort De Kock</h4>
              <p>
                Program Studi Sarjana (S1) Fisioterapi Universitas Fort De Kock (UFDK) Bukittinggi didirikan sebagai bagian dari komitmen universitas dalam mengembangkan pendidikan tinggi di bidang kesehatan, khususnya fisioterapi.
              </p>
              <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                Latar Belakang
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2024</h4>
              <p>
                Cikal bakal Program Studi S1 Fisioterapi berawal dari Program Studi Diploma III Fisioterapi yang telah lebih dahulu berdiri dan berkembang hingga dirintis pembukaan jenjang sarjana.
              </p>
              <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                Pendirian Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Arah Pengembangan</h4>
              <p>
                Program Studi S1 Fisioterapi dikembangkan untuk menjawab kebutuhan masyarakat akan layanan fisioterapi yang berbasis ilmu pengetahuan, teknologi, dan memiliki tenaga fisioterapis yang adaptif, profesional, serta kompeten.
              </p>
              <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                Tujuan Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Dokumen akreditasi Program Studi S1 Fisioterapi dapat dilihat melalui file resmi yang tersedia sebagai referensi status mutu program studi saat ini.
              </p>
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                  Status Akreditasi
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#1f3f61] text-[#1f3f61] text-sm font-semibold hover:bg-[#1f3f61] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#274f7a]/20 text-[#1f3f61] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#1f3f61]">
              Profil Lulusan Program Studi S1 Fisioterapi
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              [
                'title' => 'Manajer',
                'desc'  => 'Lulusan sarjana fisioterapi mampu memimpin, mengelola, membuat keputusan, dan menyelesaikan masalah pengelolaan administrasi fisioterapi dalam sebuah instansi, organisasi, atau komunitas.',
                'icon'  => 'bi-person-bounding-box'
              ],
              [
                'title' => 'Asisten Peneliti',
                'desc'  => 'Lulusan sarjana fisioterapi mampu memberikan kontribusi terhadap pengelolaan riset dan pemanfaatannya dalam pengembangan bidang ilmu fisioterapi.',
                'icon'  => 'bi-search-heart'
              ],
              [
                'title' => 'Komunikator',
                'desc'  => 'Lulusan sarjana fisioterapi mampu mengaplikasikan kemampuan komunikasi efektif dengan masyarakat dan interprofesional dalam bidang ilmu fisioterapi.',
                'icon'  => 'bi-chat-dots-fill'
              ],
              [
                'title' => 'Pembelajar',
                'desc'  => 'Lulusan sarjana fisioterapi mampu melakukan pengembangan diri untuk peningkatan pengetahuan dan keterampilan dengan melanjutkan pendidikan ke jenjang yang lebih tinggi.',
                'icon'  => 'bi-book-fill'
              ]
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#274f7a] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#1f3f61] mb-1">
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Fisioterapi', 'accentColor' => '#1f3f61', 'accentSoftClass' => 'bg-[#274f7a]/20'])

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
