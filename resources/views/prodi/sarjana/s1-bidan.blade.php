@extends('layouts.bidan')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Kebidanan',
  'label' => 'S1 Kebidanan',
  'subtitle' => 'Program sarjana kebidanan yang menyiapkan lulusan profesional, humanis, dan berdaya saing dalam pelayanan kesehatan ibu dan anak.',
  'accent' => '#F27C76',
  'accentSoft' => '#F7A9A5',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#F27C76] via-[#F7A9A5]/40 to-[#F27C76] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#F27C76] mb-4">Daftar Isi</h4>
          <ul id="timeline-menu" class="space-y-4">
            @foreach([
              ['id'=>'visi-misi','label'=>'Visi & Misi'],
              ['id'=>'latar-belakang','label'=>'Latar Belakang'],
              ['id'=>'tujuan','label'=>'Tujuan Program Studi'],
              ['id'=>'pimpinan','label'=>'Ketua Program Studi'],
              ['id'=>'history-timeline','label'=>'Timeline Akreditasi'],
              ['id'=>'peminatan','label'=>'Peminatan'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
            <li>
              <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                <span class="text-gray-700 font-medium group-hover:text-[#F27C76] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#F27C76]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
        @include('layouts.partials.prodi-visi-misi-styled', [
          'prodiProfile' => $prodiProfile ?? null,
          'accent' => '#F27C76',
          'accentSoft' => 'rgba(247, 169, 165, .18)',
          'title' => 'Visi & Misi',
          'vision' => 'Menjadikan Program Studi Magister yang unggul, berbasis riset, dan berdaya saing global pada tahun 2033.',
          'missions' => [
            'Menyelenggarakan Tri Dharma Perguruan Tinggi yang bermutu, berkarakter, dan berkelanjutan berbasis entrepreneur.',
            'Meningkatkan kualitas tata kelola program studi menuju standar unggul.',
            'Menjalin kerja sama produktif dan berkelanjutan di tingkat daerah, nasional, dan internasional.'
          ],
          'imageDefault' => 'modelbdn3.png',
          'imageAlt' => 'Mahasiswi Kebidanan',
        ])

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#F27C76] rounded-full blur-3xl opacity-30"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#F7A9A5]/15 text-[#F27C76] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#F27C76]">
                Latar Belakang & Sejarah
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi Kebidanan Universitas Fort De Kock telah berkembang sejak
              pendirian <strong>Program Studi DIII Kebidanan pada tahun 2008</strong>.
              Selanjutnya, <strong>Program DIV Bidan Pendidik</strong> dibuka pada
              tahun 2009, kemudian bertransformasi menjadi
              <strong>Program Studi Kebidanan Sarjana Terapan</strong> pada tahun 2018,
              dan akhirnya berkembang menjadi
              <strong>Program Studi Kebidanan Program Sarjana</strong> pada tahun 2022.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Pendidikan <strong>Profesi Bidan</strong> dimulai sejak
              <strong>6 Juni 2018</strong> berdasarkan
              <strong>SK Kepmenristekdikti Nomor 499/KPT/I/2018</strong>.
              Program ini bertujuan untuk menghasilkan lulusan bidan yang
              <strong>profesional, kompeten, dan berdaya saing</strong>
              dalam memberikan asuhan kebidanan komprehensif
              pada perempuan, ibu, dan anak.
            </p>
          </div>
        </div>

        @include('layouts.partials.prodi-tujuan-styled', [
          'prodiProfile' => $prodiProfile ?? null,
          'accent' => '#F27C76',
          'accentSoft' => 'rgba(247, 169, 165, .18)',
          'items' => [
            'Menghasilkan lulusan kebidanan yang profesional, kompeten, dan berkarakter dalam pelayanan kesehatan ibu dan anak.',
            'Mengembangkan pembelajaran kebidanan yang bermutu, adaptif, dan relevan dengan kebutuhan pelayanan kesehatan.',
            'Mendorong penelitian dan pengabdian kepada masyarakat di bidang kebidanan secara berkelanjutan.',
            'Menguatkan tata kelola program studi dan jejaring kerja sama untuk meningkatkan daya saing lulusan.'
          ],
          'imageDefault' => 'modelbdn4.png',
          'imageAlt' => 'Mahasiswi Kebidanan',
        ])

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'S1 Kebidanan',
          'accentColor' => '#F27C76',
          'accentSoftClass' => 'bg-[#F7A9A5]/15',
          'borderClass' => 'border-[#F7A9A5]/40',
          'cardBgClass' => 'from-white via-[#fff7f5] to-[#fde7e3]',
          'imageBgClass' => 'bg-[#f8d6d1]',
          'chipRingClass' => 'ring-[#F7A9A5]/40',
          'badgeClass' => 'bg-[#F27C76]/10 text-[#F27C76]',
          'badgeIcon' => 'bi bi-mortarboard-fill',
          'badgeLabel' => 'Program Sarjana Kebidanan',
          'description' => 'Memimpin pengembangan akademik dan tata kelola Program Studi S1 Kebidanan untuk menghadirkan pembelajaran yang unggul, adaptif, dan relevan dengan kebutuhan layanan kesehatan ibu dan anak.',
          'highlightOne' => 'Akademik Unggul',
          'highlightOneIcon' => 'bi bi-stars',
          'highlightTwo' => 'Kebidanan Profesional',
          'highlightTwoIcon' => 'bi bi-heart-pulse-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#F27C76] mb-6">
              Timeline Perkembangan Program Studi Kebidanan
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2008</h4>
              <p>
                Program Studi Kebidanan Universitas Fort De Kock berawal dari
                <strong>pendirian Prodi DIII Kebidanan</strong>
                sebagai dasar pengembangan pendidikan kebidanan.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/15 text-[#F27C76] rounded-full text-sm font-medium">
                Awal Pendirian
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2009</h4>
              <p>
                Dibukanya
                <strong>Program DIV Bidan Pendidik</strong>
                sebagai penguatan peran bidan di bidang pendidikan dan akademik.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/15 text-[#F27C76] rounded-full text-sm font-medium">
                Pengembangan Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2018</h4>
              <p>
                Program DIV Bidan Pendidik
                <strong>bertransformasi menjadi Program Studi Kebidanan
                Sarjana Terapan</strong>.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/15 text-[#F27C76] rounded-full text-sm font-medium">
                Transformasi Kurikulum
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>6 Juni 2018</h4>
              <p>
                Pendidikan
                <strong>Profesi Bidan</strong>
                resmi dibuka berdasarkan
                <strong>SK Kepmenristekdikti No. 499/KPT/I/2018</strong>,
                untuk menghasilkan bidan profesional dan kompeten.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/15 text-[#F27C76] rounded-full text-sm font-medium">
                Profesi Bidan
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2022</h4>
              <p>
                Program Studi Kebidanan resmi
                <strong>berubah menjadi Program Studi Kebidanan
                Program Sarjana (S1)</strong>.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/15 text-[#F27C76] rounded-full text-sm font-medium">
                Program Sarjana
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Saat Ini</h4>
              <p>
                Program Studi Kebidanan Universitas Fort De Kock
                telah terakreditasi dengan predikat
                <strong>Baik Sekali</strong>.
              </p>

              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#F27C76] text-white rounded-full text-sm font-semibold">
                  Akreditasi Baik Sekali
                </span>

                @if(!empty($accreditation?->file))
                  <a
                    href="{{ $accreditation->file_url }}"
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#F27C76] text-[#F27C76] text-sm font-semibold hover:bg-[#F27C76] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#F7A9A5]/15 text-[#F27C76] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#F27C76]">
              Profil Lulusan
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              [
                'title' => 'Bidan Praktisi',
                'desc'  => 'Memberikan asuhan kebidanan komprehensif pada berbagai level pelayanan serta mengambil keputusan yang independen, kritis, dan etis secara profesional.',
                'icon'  => 'bi-heart-pulse-fill'
              ],
              [
                'title' => 'Edukator dan Konselor',
                'desc'  => 'Memberikan informasi, edukasi, dan konseling kesehatan kepada perempuan, keluarga, dan masyarakat secara tepat sesuai tanggung jawabnya.',
                'icon'  => 'bi-chat-dots-fill'
              ],
              [
                'title' => 'Penggerak Masyarakat',
                'desc'  => 'Berperan sebagai pemimpin, penggerak, dan pemberdaya perempuan dalam isu kesehatan perempuan, ibu, dan anak di masyarakat.',
                'icon'  => 'bi-people-fill'
              ],
              [
                'title' => 'Pengelola Pelayanan',
                'desc'  => 'Mampu menjalankan fungsi manajerial dan kepemimpinan dalam pengelolaan pelayanan dan sumber daya kebidanan atau kesehatan.',
                'icon'  => 'bi-gear-fill'
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Kebidanan', 'accentColor' => '#F27C76', 'accentSoftClass' => 'bg-[#F7A9A5]/15'])

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
