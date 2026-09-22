@extends('layouts.fisiotrapi')

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"
/>
@push('head')
@vite('resources/css/inspired-campus.css')
@endpush
@php
  $d3Accreditation = $accreditation ?? null;
@endphp

@section('content')
@include('layouts.partials.prodi-hero', [
  'title' => 'D3 Fisioterapi',
  'label' => 'D3 Fisioterapi',
  'subtitle' => 'Program pendidikan vokasi yang mencetak Ahli Madya Fisioterapi terampil, siap kerja, beretika, dan unggul dalam pelayanan fisioterapi muskuloskeletal.',
  'accent' => '#274f7a',
  'accentSoft' => '#d7e3ef',
])

<section class="d3-fisioterapi-page py-16 bg-gray-50 relative">
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
              ['id'=>'pembelajaran','label'=>'Pembelajaran'],
              ['id'=>'profil-lulusan','label'=>'Profil Lulusan'],
              ['id'=>'dosen','label'=>'Tenaga Pengajar'],
            ] as $item)
              <li>
                <a href="#{{ $item['id'] }}" class="timeline-link flex items-center justify-between group">
                  <span class="text-gray-700 font-medium group-hover:text-[#1f3f61] transition-colors">
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
                      class="w-full h-full text-gray-400 group-hover:text-[#1f3f61]">
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
                Visi & Misi Program Studi D3 Fisioterapi
            </h2>
        </div>

        <div class="visi-box reveal mb-12">
            <span class="badge-visi text-white">VISI</span>
            <p class="mt-4 text-[17px] leading-relaxed text-white-700">
                Menjadi Program Studi D-III Fisioterapi yang unggul, berjiwa
                entrepreneur, dan berdaya saing global dalam pelayanan
                fisioterapi muskuloskeletal pada tahun <strong>2030</strong>.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-start gap-12">

            {{-- FOTO --}}
            <div class="lg:w-5/12 relative hidden lg:block group">

                <div class="relative min-h-[520px] pt-16 pb-20 translate-y-6 flex items-end justify-center">

                    <img
                        src="{{ $prodiProfile?->contentImageUrl('visi_misi', 'modeld3.png') ?? asset('images/model_s2_2.png') }}"
                        alt="Mahasiswa Fisioterapi"
                        class="w-full max-w-xl mx-auto scale-110"
                    />

                    {{-- Shine Effect --}}
                    <span
                        class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700">
                    </span>

                </div>

            </div>

            {{-- KONTEN --}}
            <div class="lg:w-7/12 space-y-10">

                <div>

                    <span class="badge-misi text-white">MISI</span>

                    <ul class="misi-list mt-6 space-y-4">
                        @foreach([
                            'Menyelenggarakan pendidikan vokasi fisioterapi yang menghasilkan Ahli Madya Fisioterapi yang kompeten dalam pelayanan muskuloskeletal sesuai standar nasional dan perkembangan ilmu pengetahuan.',
                            'Mengembangkan keterampilan praktik klinik berbasis evidence-based dalam penanganan gangguan muskuloskeletal.',
                            'Meningkatkan peran serta dalam pengabdian kepada masyarakat melalui layanan fisioterapi muskuloskeletal yang promotif, preventif, dan rehabilitatif.',
                            'Menumbuhkan jiwa kewirausahaan dan etika profesional pada mahasiswa untuk mampu bersaing di dunia kerja.',
                            'Menjalin kemitraan dengan fasilitas pelayanan kesehatan dan dunia industri untuk meningkatkan mutu pembelajaran, praktik, dan penyerapan lulusan.'
                        ] as $item)
                            <li class="misi-card flex items-start gap-3 reveal text-gray-700">
                                <i class="bi bi-arrow-right-circle-fill text-[#274f7a] mt-1"></i>
                                <span class="leading-relaxed">
                                    {{ $item }}
                                </span>
                            </li>
                        @endforeach
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
                Latar Belakang dan Sejarah Berdirinya Program Studi
              </h2>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Studi Diploma III (D-III) Fisioterapi Universitas Fort De
              Kock Bukittinggi merupakan program pendidikan vokasi yang didirikan
              untuk memenuhi kebutuhan masyarakat dan dunia kesehatan akan tenaga
              fisioterapi yang kompeten, terampil, dan mampu beradaptasi di
              berbagai layanan kesehatan.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Sejak awal pembentukannya, program studi ini menjadi wujud
              komitmen universitas dalam menghadirkan pendidikan kesehatan yang
              bermutu melalui proses pembelajaran yang menekankan keterampilan
              praktik, pemahaman ilmiah, serta pengalaman klinik yang relevan
              dengan kebutuhan pelayanan fisioterapi.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Seiring meningkatnya gangguan muskuloskeletal di masyarakat, baik
              karena pola hidup, aktivitas kerja, cedera olahraga, maupun kondisi
              degeneratif, kebutuhan akan fisioterapis yang memiliki kemampuan
              khusus di bidang ini semakin bertambah. Oleh karena itu, Prodi
              D-III Fisioterapi UFDK mengembangkan kurikulum yang menonjolkan
              kompetensi pelayanan muskuloskeletal sebagai ciri utama program
              studi.
            </p>

            <p class="mt-4 text-gray-700 leading-relaxed">
              Dalam perjalanannya, Program Studi D-III Fisioterapi terus berupaya
              meningkatkan mutu pendidikan melalui pengembangan kurikulum,
              penyediaan fasilitas laboratorium yang memadai, serta kerja sama
              dengan rumah sakit, klinik fisioterapi, dan berbagai institusi
              kesehatan.
            </p>
          </div>
        </div>

        @include('layouts.partials.prodi-kaprodi-card', [
          'prodiProfile' => $prodiProfile ?? null,
          'programName' => 'D3 Fisioterapi',
          'accentColor' => '#1f3f61',
          'accentSoftClass' => 'bg-[#274f7a]/20',
          'borderClass' => 'border-[#9fb6cf]/40',
          'cardBgClass' => 'from-white via-[#f6f9fc] to-[#eaf0f7]',
          'imageBgClass' => 'bg-[#d7e3ef]',
          'chipRingClass' => 'ring-[#d0dceb]/70',
          'badgeClass' => 'bg-[#274f7a]/10 text-[#1f3f61]',
          'badgeIcon' => 'bi bi-activity',
          'badgeLabel' => 'Program Studi D3 Fisioterapi',
          'description' => 'Memimpin pengembangan pendidikan vokasi fisioterapi yang berfokus pada keterampilan praktik, pelayanan muskuloskeletal, pengalaman klinik, dan etika profesional bagi calon Ahli Madya Fisioterapi.',
          'highlightOne' => 'Muskuloskeletal',
          'highlightOneIcon' => 'bi bi-heart-pulse-fill',
          'highlightTwo' => 'Vokasi Siap Kerja',
          'highlightTwoIcon' => 'bi bi-briefcase-fill',
        ])

        <div id="history-timeline" class="history-timeline scroll-mt-32">
          <div class="history-item reveal">
            <h4 class="text-xl font-semibold text-[#1f3f61] mb-4">
              Timeline Sejarah dan Akreditasi Prodi
            </h4>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Awal Berdiri</h4>
              <p>
                Program Studi D-III Fisioterapi didirikan untuk memenuhi
                kebutuhan masyarakat dan dunia kesehatan akan tenaga fisioterapi
                yang kompeten, terampil, dan mampu beradaptasi di berbagai
                layanan kesehatan.
              </p>
              <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                Pendidikan Vokasi
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Arah Pengembangan</h4>
              <p>
                Kurikulum dikembangkan dengan ciri pelayanan fisioterapi
                muskuloskeletal, praktik klinik berbasis evidence-based, dan
                pembelajaran yang relevan dengan kebutuhan pasien.
              </p>
              <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                Muskuloskeletal
              </span>
            </div>
          </div>

          <div class="history-item reveal">
            <div class="history-card">
              <h4>Sekarang</h4>
              <p>
                Dokumen akreditasi Program Studi D3 Fisioterapi dapat dilihat
                melalui file resmi yang tersedia sebagai referensi status mutu
                program studi saat ini.
              </p>
              @if($d3Accreditation)
              <div class="mt-4 grid gap-2 text-sm text-gray-700">
                <p><strong>Peringkat:</strong> {{ $d3Accreditation->predicate }}</p>
                <p><strong>Nomor SK:</strong> {{ $d3Accreditation->nomor_sk }}</p>
                <p><strong>Lembaga:</strong> {{ $d3Accreditation->lembaga }}</p>
              </div>
              @endif
              <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-block px-3 py-1 bg-[#274f7a]/20 text-[#1f3f61] rounded-full text-sm font-semibold">
                  {{ $d3Accreditation?->predicate ?? 'Status Akreditasi' }}
                </span>
                @if(!empty($d3Accreditation?->file))
                <a
                  href="{{ $d3Accreditation->file_url }}"
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

        <div id="pembelajaran" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#274f7a]/20 text-[#1f3f61] flex items-center justify-center shadow-sm">
              <i class="bi bi-diagram-3-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#1f3f61]">
              Fokus Pembelajaran
            </h2>
          </div>

          <div class="content-photo-layout">
<div class="content-photo-panel reveal relative overflow-hidden group">
    <img
        src="{{ $prodiProfile?->contentImageUrl('fokus_pembelajaran', 'model2d3.png') ?? asset('images/model_s2_1.png') }}"
        alt="Fokus pembelajaran D3 Fisioterapi"
        class="content-section-photo content-section-photo--focus"
    />

    {{-- Shine Effect --}}
<span
    class="pointer-events-none absolute inset-0
    bg-gradient-to-r from-transparent via-white/40 to-transparent
    -translate-x-full
    skew-x-12
    transition-transform
    duration-[1400ms]
    ease-in-out
    group-hover:translate-x-full">
</span>
</div>

            <div class="grid grid-cols-1 gap-6">
              @foreach([
                'Keterampilan praktik fisioterapi',
                'Asesmen dan penanganan gangguan muskuloskeletal',
                'Modalitas fisioterapi yang aman dan tepat',
                'Praktik klinik, simulasi laboratorium, dan pembelajaran berbasis kasus'
              ] as $item)
                <div class="peminatan-card reveal">
                  <i class="bi bi-check2-circle"></i>
                  <span>{{ $item }}</span>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div id="profil-lulusan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
          <div class="flex items-center gap-3 mb-8">
            <div class="w-11 h-11 rounded-xl bg-[#274f7a]/20 text-[#1f3f61] flex items-center justify-center shadow-sm">
              <i class="bi bi-mortarboard-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-semibold text-[#1f3f61]">
              Profil Lulusan Program Studi D3 Fisioterapi
            </h2>
          </div>

         

            <div class="grid grid-cols-1 gap-6">
              @foreach([
                ['title' => 'Pelaksana Layanan Fisioterapi', 'desc' => 'Mampu melakukan asesmen, menentukan tujuan terapi, serta memberikan intervensi fisioterapi dasar-menengah pada berbagai kondisi gangguan fungsi dan gerak secara aman dan efektif.', 'icon' => 'bi-heart-pulse-fill'],
                ['title' => 'Asisten Peneliti Terapan', 'desc' => 'Mampu mendukung pelaksanaan penelitian terapan melalui pengumpulan data, observasi klinis, dokumentasi, dan penerapan prinsip evidence-based.', 'icon' => 'bi-search-heart'],
                ['title' => 'Komunikator Kesehatan', 'desc' => 'Mampu memberikan edukasi kesehatan dan berkomunikasi efektif dengan pasien, keluarga, masyarakat, serta bekerja dalam tim interprofesional.', 'icon' => 'bi-chat-dots-fill'],
                ['title' => 'Administrator Layanan Fisioterapi', 'desc' => 'Mampu melaksanakan dokumentasi, penjadwalan, pengelolaan alat, serta tugas administratif dalam unit pelayanan fisioterapi.', 'icon' => 'bi-clipboard2-check-fill'],
                ['title' => 'Pembelajar', 'desc' => 'Mampu mengembangkan diri melalui pelatihan, sertifikasi, atau melanjutkan pendidikan demi peningkatan kompetensi profesional.', 'icon' => 'bi-book-fill'],
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

         <div class="relative mt-10 overflow-hidden rounded-3xl bg-gradient-to-br from-[#274f7a] to-[#1f3f61] px-8 py-10 text-white shadow-2xl reveal">

    {{-- Background Decoration --}}
    <div class="absolute -top-10 -right-10 w-44 h-44 rounded-full bg-white/10 blur-3xl"></div>
    <div class="absolute -bottom-12 -left-12 w-56 h-56 rounded-full bg-white/5 blur-3xl"></div>

    <div class="relative z-10">

        <div class="flex items-center gap-3 mb-5">
            <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur flex items-center justify-center">
                <i class="bi bi-heart-pulse-fill text-2xl text-white"></i>
            </div>

            <div>
                <span class="uppercase tracking-[3px] text-sm font-semibold text-white/70">
                    D3 Fisioterapi Universitas Fort De Kock
                </span>

                <h3 class="text-3xl font-bold mt-1">
                    Bergerak Lebih Baik, Hidup Lebih Berkualitas.
                </h3>
            </div>
        </div>

        <p class="text-lg leading-8 text-white/90">
            Program Studi <strong>D-III Fisioterapi</strong> Universitas Fort De Kock
            membentuk fisioterapis vokasi yang profesional, terampil, siap kerja,
            serta mampu memberikan pelayanan rehabilitasi yang aman, efektif,
            dan berorientasi pada kebutuhan pasien.
        </p>

        <div class="mt-8 border-l-4 border-white/40 pl-6 italic text-xl leading-9 text-white">
            “Gerakan kecil dapat membawa perubahan besar.”
            <br>
            <span class="not-italic text-lg text-white/85">
                Bersama kami, mahasiswa belajar membantu pasien mengurangi nyeri,
                memulihkan fungsi tubuh, meningkatkan kualitas hidup, dan meraih
                kembali kemandiriannya melalui pendekatan ilmiah yang dipadukan
                dengan empati.
            </span>
        </div>

    </div>

</div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('layouts.partials.prodi-dosen-list', ['prodiProfile' => $prodiProfile ?? null, 'programName' => 'D3 Fisioterapi', 'accentColor' => '#1f3f61', 'accentSoftClass' => 'bg-[#274f7a]/20'])

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
        link.classList.remove("text-[#1f3f61]");
      });

      const active = document.querySelector(`.timeline-link[href="#${entry.target.id}"]`);
      if (active) {
        active.classList.add("text-[#1f3f61]");
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(section => observer.observe(section));
});
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll("[data-remove-white-background]");

  images.forEach((image) => {
    const source = new Image();
    source.crossOrigin = "anonymous";

    source.onload = () => {
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d", { willReadFrequently: true });

      canvas.width = source.naturalWidth;
      canvas.height = source.naturalHeight;
      context.drawImage(source, 0, 0);

      const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
      const data = imageData.data;
      const width = canvas.width;
      const height = canvas.height;
      const visited = new Uint8Array(width * height);
      const queue = [];
      const tolerance = 42;

      const pixelIndex = (x, y) => y * width + x;
      const dataIndex = (x, y) => pixelIndex(x, y) * 4;
      const backgroundColor = (() => {
        const points = [
          [0, 0],
          [width - 1, 0],
          [0, height - 1],
          [width - 1, height - 1],
        ];
        const color = [0, 0, 0];

        points.forEach(([x, y]) => {
          const index = dataIndex(x, y);
          color[0] += data[index];
          color[1] += data[index + 1];
          color[2] += data[index + 2];
        });

        return color.map((channel) => Math.round(channel / points.length));
      })();

      const matchesBackground = (x, y) => {
        const index = dataIndex(x, y);
        const red = data[index] - backgroundColor[0];
        const green = data[index + 1] - backgroundColor[1];
        const blue = data[index + 2] - backgroundColor[2];

        return Math.sqrt(red * red + green * green + blue * blue) <= tolerance;
      };

      for (let x = 0; x < width; x++) {
        queue.push([x, 0], [x, height - 1]);
      }

      for (let y = 0; y < height; y++) {
        queue.push([0, y], [width - 1, y]);
      }

      while (queue.length) {
        const [x, y] = queue.pop();

        if (x < 0 || x >= width || y < 0 || y >= height) {
          continue;
        }

        const point = pixelIndex(x, y);

        if (visited[point] || !matchesBackground(x, y)) {
          continue;
        }

        visited[point] = 1;
        data[dataIndex(x, y) + 3] = 0;

        queue.push([x + 1, y], [x - 1, y], [x, y + 1], [x, y - 1]);
      }

      context.putImageData(imageData, 0, 0);
      image.src = canvas.toDataURL("image/png");
    };

    source.src = image.currentSrc || image.src;
  });
});
</script>

@endsection
