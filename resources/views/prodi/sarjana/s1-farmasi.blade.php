@extends('layouts.farmasi')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

</style>

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'S1 Farmasi',
  'label' => 'S1 Farmasi',
  'subtitle' => 'Program studi unggul dalam pemanfaatan dan pengembangan bahan alam sebagai bahan baku sediaan farmasi yang berdaya saing global.',
  'accent' => '#EC1F25',
  'accentSoft' => '#F7A9A5',
])

<section class="py-16 bg-gray-50 relative">
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="hidden lg:block absolute top-0 bottom-0 left-[33.33%] w-1 bg-gradient-to-b from-[#EC1F25] via-[#F7A9A5]/40 to-[#EC1F25] rounded-full"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      <aside class="self-start lg:col-span-4 lg:sticky lg:top-32">
        <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
          <h4 class="text-xl font-semibold text-[#EC1F25] mb-4">Daftar Isi</h4>
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
                <span class="text-gray-700 font-medium group-hover:text-[#EC1F25] transition">
                  {{ $item['label'] }}
                </span>
                <span class="arrow-icon w-5 h-5 transition-all duration-300 -rotate-45 group-hover:rotate-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 group-hover:text-[#EC1F25]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <div class="w-11 h-11 rounded-xl bg-[#F7A9A5]/30 text-[#EC1F25] flex items-center justify-center shadow-sm">
              <i class="bi bi-compass-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#EC1F25]">
              Visi & Misi Program Studi S1 Farmasi
            </h2>
          </div>

          <div class="visi-box reveal mb-12">
            <span class="badge-visi bg-[#EC1F25] text-white">VISI</span>
<p class="mt-4 text-[17px] leading-relaxed text-white-700">
  Menjadi Program Studi yang <strong>Unggul</strong> dan
  <strong>Berdaya Saing Global</strong> dalam Pengembangan
  <strong>Bahan Alam</strong> dan <strong>Pelayanan Kefarmasian</strong>
  Tahun <strong>2033</strong>.
</p>
          </div>

<div class="flex flex-col lg:flex-row items-start gap-12">
<div class="lg:w-5/12 relative hidden lg:block group bg-transparent">
    <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20 bg-transparent shadow-none">
        <img
            src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modelfarmasi2.png') ?? asset('images/model_ners_1.jpg') }}"
            alt="Mahasiswa Farmasi"
            class="w-full max-w-xl mx-auto scale-110 drop-shadow-2xl"
        />

        <!-- Shine Effect -->
        <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
    </div>
</div>
            <div class="lg:w-7/12 space-y-10">
              <div>
                <span class="badge-misi bg-[#EC1F25] text-white">MISI</span>
                <ul class="misi-list mt-6 space-y-4">
                  @foreach([
                    'Menyelenggarakan Tri Dharma Kefarmasian Dalam Pengembangan Bahan Alam dan Pelayanan Kefarmasian',
                    'Membangun Tata Kelola Yang Baik Dalam Penyelenggaraan Program Studi Kefarmasian',
                    'Melakukan Kerja Sama di Bidang Kefarmasian Pada Tingkat Regional, Nasional dan Internasioanl'
                  ] as $item)
                    <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                      <i class="bi bi-arrow-right-circle-fill text-[#9A4A56] mt-1"></i>
                      <span class="leading-relaxed">{{ $item }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="latar-belakang" class="glass-card p-8 md:p-10 scroll-mt-32 reveal fade-up relative overflow-hidden">
          <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#EC1F25] rounded-full blur-3xl opacity-25"></div>

          <div class="relative z-10">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-11 h-11 rounded-xl bg-[#F7A9A5]/20 text-[#EC1F25] flex items-center justify-center shadow">
                <i class="bi bi-book-half text-xl"></i>
              </div>
              <h2 class="text-2xl font-semibold text-[#EC1F25]">
                Sejarah & Latar Belakang
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi <strong>S1 Farmasi Universitas Fort De Kock</strong>
              didirikan pada tahun <strong>2018</strong>, saat institusi masih bernama
              <strong>STIKes Fort De Kock</strong>. Program studi ini lahir dari kebutuhan
              akan tenaga farmasi yang profesional, berintegritas, dan adaptif terhadap
              perkembangan dunia kesehatan modern.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Prodi S1 Farmasi hadir untuk menjawab tantangan di bidang
              <strong>pelayanan kefarmasian</strong>, <strong>industri farmasi</strong>,
              serta pengembangan dan pemanfaatan <strong>bahan alam Nusantara</strong>
              secara ilmiah dan berkelanjutan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Dengan dukungan tenaga pengajar dari berbagai disiplin ilmu dan
              fasilitas laboratorium yang terus berkembang, Program Studi Farmasi
              berkembang pesat dan menjadi salah satu program unggulan sejak
              Universitas Fort De Kock resmi berdiri pada tahun <strong>2019</strong>.
            </p>
          </div>
        </div>

        <div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
            <div class="flex items-center gap-4 lg:col-span-12 mb-3">
              <div class="w-11 h-11 rounded-xl bg-[#F7A9A5]/20 text-[#EC1F25] flex items-center justify-center shadow-sm">
                <i class="bi bi-bullseye text-xl"></i>
              </div>
              <h3 class="text-2xl md:text-3xl font-semibold text-[#EC1F25]">
                Tujuan Program Studi
              </h3>
            </div>

<div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
    <div class="relative group -mt-2">
        <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
            <img
                src="{{ $prodiProfile?->contentImageUrl('tujuan', 'modelfarmasi4.png') ?? asset('images/model_ners_2.jpg') }}"
                alt="Mahasiswa Farmasi"
                class="w-full max-w-xl scale-110 drop-shadow-2xl"
            />

            <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
        </div>
    </div>

              <div class="space-y-4 mt-1">
                <ul class="tujuan-list grid gap-3">
                  @foreach([
                    'Menghasilkan lulusan Sarjana Farmasi yang unggul, inovatif, dan berdaya saing di tingkat nasional.',
                    'Membekali lulusan dengan kompetensi akademik dan profesional yang tinggi serta menjunjung etika kefarmasian.',
                    'Mempersiapkan lulusan yang adaptif terhadap perkembangan ilmu pengetahuan, teknologi, dan praktik kefarmasian.',
                    'Mendorong kontribusi aktif lulusan dalam bidang farmasi klinis, teknologi farmasi, dan pemanfaatan bahan alam.',
                    'Mengembangkan tridarma perguruan tinggi melalui pendidikan, penelitian, dan pengabdian masyarakat yang aplikatif dan berkelanjutan.'
                  ] as $item)
                  <li class="tujuan-card flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 border-l-[#EC1F25] bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="bi bi-check-circle-fill text-[#EC1F25] mt-1"></i>
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
          'programName' => 'S1 Farmasi',
          'accentColor' => '#EC1F25',
          'accentSoftClass' => 'bg-[#F7A9A5]/15',
          'borderClass' => 'border-[#F7A9A5]/40',
          'cardBgClass' => 'from-white via-[#fff7f5] to-[#fde7e3]',
          'imageBgClass' => 'bg-[#f8d6d1]',
          'chipRingClass' => 'ring-[#F7A9A5]/40',
          'badgeClass' => 'bg-[#EC1F25]/10 text-[#EC1F25]',
          'badgeIcon' => 'bi bi-capsule-pill',
          'badgeLabel' => 'Program Studi Farmasi',
          'description' => 'Memimpin pengembangan akademik Program Studi S1 Farmasi untuk menghasilkan lulusan yang unggul dalam pelayanan kefarmasian, pengembangan bahan alam, dan praktik farmasi yang adaptif terhadap kemajuan ilmu kesehatan.',
          'highlightOne' => 'Akademik Unggul',
          'highlightOneIcon' => 'bi bi-stars',
          'highlightTwo' => 'Farmasi Profesional',
          'highlightTwoIcon' => 'bi bi-heart-pulse-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#EC1F25] mb-4">
              Timeline Sejarah & Akreditasi Prodi S1 Farmasi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2018</h4>
              <p>
                Program Studi Farmasi Universitas Fort De Kock didirikan saat institusi
                masih bernama <strong>STIKes Fort De Kock</strong>. Prodi ini lahir untuk
                menjawab kebutuhan tenaga farmasi yang profesional, berintegritas, serta
                mampu berperan dalam pelayanan farmasi, industri, dan pemanfaatan bahan
                alam Nusantara.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/30 text-[#EC1F25] rounded-full text-sm font-semibold">
                Pendirian Prodi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>2019</h4>
              <p>
                Seiring transformasi institusi menjadi
                <strong>Universitas Fort De Kock</strong>, Program Studi Farmasi
                berkembang pesat dan mulai ditetapkan sebagai salah satu
                program unggulan universitas.
              </p>
              <span class="inline-block px-3 py-1 bg-[#F7A9A5]/30 text-[#EC1F25] rounded-full text-sm font-semibold">
                Transformasi Institusi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>10 Juni 2022 09 Juni 2027</h4>
              <p>
                Program Studi Farmasi Universitas Fort De Kock memperoleh
                status akreditasi dengan predikat
                <strong>Baik Sekali</strong>, sebagai pengakuan atas mutu
                penyelenggaraan pendidikan, sarana prasarana, dan tata kelola program studi.
              </p>
              <span class="inline-block px-3 py-1 bg-[#EC1F25] text-white rounded-full text-sm font-semibold">
                Akreditasi Baik Sekali
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Dokumen akreditasi resmi Program Studi S1 Farmasi dapat ditinjau melalui file
                akreditasi yang tersedia sebagai referensi status mutu program studi saat ini.
              </p>
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#F7A9A5]/30 text-[#EC1F25] rounded-full text-sm font-semibold">
                  Status Akreditasi
                </span>
                @if(!empty($accreditation?->file))
                <a
                  href="{{ $accreditation->file_url }}"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#EC1F25] text-[#EC1F25] text-sm font-semibold hover:bg-[#EC1F25] hover:text-white transition"
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
            <div class="w-11 h-11 rounded-xl bg-[#F7A9A5]/30 text-[#EC1F25] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#EC1F25]">
              Profil Lulusan Program Studi S1 Farmasi
            </h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
              [
                'title' => 'Care Giver',
                'desc'  => 'Mampu memberikan pelayanan farmasi berorientasi pada pasien (pharmaceutical care), termasuk pengelolaan terapi obat secara individual untuk meningkatkan hasil terapi dan kualitas hidup pasien.',
                'icon'  => 'bi-heart-pulse-fill'
              ],
              [
                'title' => 'Educator',
                'desc'  => 'Mampu memberikan edukasi dan pengetahuan terkait obat kepada pasien, mahasiswa, maupun masyarakat.',
                'icon'  => 'bi-easel-fill'
              ],
              [
                'title' => 'Communicator',
                'desc'  => 'Mampu berkomunikasi secara efektif dengan pasien, tenaga kesehatan, dan masyarakat untuk memastikan penggunaan obat yang tepat.',
                'icon'  => 'bi-chat-dots-fill'
              ],
              [
                'title' => 'Leader',
                'desc'  => 'Mampu berperan sebagai pemimpin dalam tim kesehatan, menjadi panutan, serta mendorong perubahan positif dalam sistem pelayanan kesehatan.',
                'icon'  => 'bi-person-badge-fill'
              ],
              [
                'title' => 'Decision Maker',
                'desc'  => 'Mampu mengambil keputusan yang tepat terkait pemilihan obat dan terapi berdasarkan praktik berbasis bukti ilmiah (evidence-based practice).',
                'icon'  => 'bi-diagram-3-fill'
              ],
              [
                'title' => 'Manager',
                'desc'  => 'Bertanggung jawab dalam pengelolaan sumber daya, perencanaan, pengorganisasian, dan pengawasan operasional di apotek atau fasilitas kesehatan.',
                'icon'  => 'bi-gear-fill'
              ],
              [
                'title' => 'Life-long Learner',
                'desc'  => 'Memiliki komitmen untuk terus memperbarui pengetahuan dan keterampilan seiring perkembangan ilmu dan teknologi kefarmasian.',
                'icon'  => 'bi-book-half'
              ],
              [
                'title' => 'Personal & Professional Responsibilities',
                'desc'  => 'Menjunjung tinggi etika, integritas, tanggung jawab profesional, serta menjaga kepercayaan pasien, masyarakat, dan institusi.',
                'icon'  => 'bi-shield-check'
              ],
              [
                'title' => 'Scientific Comprehension & Research Abilities',
                'desc'  => 'Mampu memahami konsep ilmiah farmasi dan menerapkannya dalam penelitian, pengembangan obat, serta evaluasi terapi.',
                'icon'  => 'bi-book-half'
              ],
            ] as $item)
              <div class="lulusan-card reveal flex gap-4 p-5 rounded-xl bg-white/60 backdrop-blur hover:shadow-lg transition">
                <div class="icon-box text-[#9A4A56] text-2xl">
                  <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-[#EC1F25] mb-1">
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

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'S1 Farmasi', 'accentColor' => '#EC1F25', 'accentSoftClass' => 'bg-[#F7A9A5]/30'])

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
