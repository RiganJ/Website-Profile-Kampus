@php
    $dosenPengajar = collect($dosenPengajar ?? $prodiProfile?->dosen ?? []);
    $adminProdi = $prodiProfile?->adminProdi;
    $laborans = collect($prodiProfile?->laborans ?? []);
    $healthPrograms = [
        'S2 Kesehatan Masyarakat', 'Profesi Ners', 'Profesi Bidan',
        'S1 Kesehatan Masyarakat', 'S1 Keperawatan', 'S1 Kebidanan',
        'S1 Farmasi', 'S1 Fisioterapi', 'D3 Fisioterapi',
    ];
    $isHealthProgram = in_array($prodiProfile?->nama_prodi ?? $programName ?? '', $healthPrograms, true);
    $accentColor = $accentColor ?? '#743B72';
    $accentSoftClass = $accentSoftClass ?? 'bg-orange-100';
    $programName = $programName ?? $prodiProfile?->nama_prodi ?? 'Program Studi';
    $dosenLoopCount = $dosenPengajar->count() < 4 ? 6 : 3;
    $dosenSlideDistance = '-' . (100 / $dosenLoopCount) . '%';
    $dosenSlideDuration = max($dosenPengajar->count() * 8, 38);
@endphp

<style>
  .prodi-dosen-slider {
    overflow: hidden;
    padding: 6px 0 18px;
    -webkit-mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent);
    mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent);
  }

  .prodi-dosen-track {
    display: flex;
    width: max-content;
    gap: 24px;
    animation: prodiDosenSlide var(--dosen-slide-duration, 42s) linear infinite;
    will-change: transform;
  }

  .prodi-dosen-card {
    width: clamp(220px, 20vw, 260px);
    overflow: hidden;
    border-radius: 24px;
    background: #fff;
    border: 1px solid rgba(226, 232, 240, .9);
    box-shadow: 0 18px 42px rgba(15, 23, 42, .1);
  }

  .prodi-dosen-photo {
    position: relative;
    height: clamp(260px, 28vw, 330px);
    overflow: hidden;
    background: #f1f5f9;
  }

  .prodi-dosen-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    filter: contrast(.92) saturate(.95) blur(.15px);
    transform: translateZ(0);
    image-rendering: auto;
  }

  .prodi-dosen-placeholder {
    display: flex;
    height: 100%;
    width: 100%;
    align-items: center;
    justify-content: center;
    font-size: 82px;
  }

  .prodi-dosen-info {
    min-height: 150px;
    padding: 18px;
  }

  .prodi-dosen-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .12em;
    text-transform: uppercase;
  }

  .prodi-admin-card-public {
    display: flex;
    min-width: 0;
    flex-direction: column;
    align-self: stretch;
    overflow: hidden;
    border-radius: 24px;
    border: 1px solid rgba(226, 232, 240, .9);
    background: #fff;
    box-shadow: 0 18px 42px rgba(15, 23, 42, .1);
    width: clamp(220px, 20vw, 260px);
    height: auto;
  }

  .prodi-admin-card-public__photo {
    height: clamp(260px, 28vw, 330px);
    flex: 0 0 clamp(260px, 28vw, 330px);
    overflow: hidden;
    background: #f1f5f9;
  }

  .prodi-admin-card-public__photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    filter: contrast(.92) saturate(.95) blur(.15px);
    image-rendering: auto;
  }

  .prodi-admin-card-public__body {
    display: flex;
    min-width: 0;
    flex-direction: column;
    justify-content: flex-start;
    gap: 14px;
    min-height: 150px;
    padding: 18px;
    flex: 1;
  }

  .prodi-admin-card-public--wide {
    width: 100%;
    flex-direction: row;
  }

  .prodi-admin-card-public--wide .prodi-admin-card-public__photo {
    width: min(260px, 36%);
    height: 320px;
    flex: 0 0 min(260px, 36%);
  }

  .prodi-admin-card-public--wide .prodi-admin-card-public__body {
    justify-content: center;
    padding: 28px;
  }

  .prodi-staff-grid {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    gap: 24px;
  }

  @keyframes prodiDosenSlide {
    from { transform: translateX(0); }
    to { transform: translateX(var(--dosen-slide-distance, -33.3333%)); }
  }

  @media (max-width: 640px) {
    .prodi-dosen-slider {
      overflow-x: auto;
      padding-bottom: 12px;
      -webkit-mask-image: none;
      mask-image: none;
      scroll-snap-type: x mandatory;
    }

    .prodi-dosen-track {
      animation: none;
      gap: 16px;
    }

    .prodi-dosen-card {
      width: 72vw;
      scroll-snap-align: start;
    }

    .prodi-dosen-photo {
      height: 320px;
    }

    .prodi-admin-card-public__photo {
      height: 320px;
      flex-basis: 320px;
    }

    .prodi-staff-grid {
      gap: 16px;
    }

    .prodi-admin-card-public {
      width: min(72vw, 260px);
    }

    .prodi-admin-card-public--wide {
      width: 100%;
      flex-direction: column;
    }

    .prodi-admin-card-public--wide .prodi-admin-card-public__photo {
      width: 100%;
      height: 340px;
      flex-basis: 340px;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .prodi-dosen-track {
      animation: none;
    }
  }
</style>

<div id="dosen" class="glass-card p-6 md:p-10 scroll-mt-32 reveal max-w-7xl mx-auto overflow-hidden relative">
  <div class="absolute inset-x-0 top-0 h-1.5" style="background: linear-gradient(90deg, {{ $accentColor }}, rgba(255,255,255,0));"></div>

  <div class="flex flex-col gap-5 mb-8 md:flex-row md:items-end md:justify-between">
    <div class="flex items-start gap-4">
      <div class="w-12 h-12 rounded-2xl {{ $accentSoftClass }} flex shrink-0 items-center justify-center shadow-sm ring-1 ring-black/5" style="color: {{ $accentColor }}">
        <i class="bi bi-people-fill text-xl"></i>
      </div>
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.22em] text-gray-400">
          Tim Akademik
        </p>
        <h2 class="mt-1 text-2xl md:text-3xl font-bold leading-tight" style="color: {{ $accentColor }}">
          Tenaga Pengajar
        </h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-600">
          Dosen {{ $programName }} yang mendukung proses pembelajaran, pendampingan akademik, dan pengembangan keilmuan mahasiswa.
        </p>
      </div>
    </div>

    <div class="inline-flex w-fit items-center gap-2 rounded-full bg-white/80 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-200">
      <span class="flex h-2.5 w-2.5 rounded-full" style="background: {{ $accentColor }}"></span>
      {{ $dosenPengajar->count() }} Dosen
    </div>
  </div>

  @if($dosenPengajar->isNotEmpty())
  <div class="prodi-dosen-slider"
       style="--dosen-slide-distance: {{ $dosenSlideDistance }}; --dosen-slide-duration: {{ $dosenSlideDuration }}s;">
    <div class="prodi-dosen-track">
      @for($loopIndex = 0; $loopIndex < $dosenLoopCount; $loopIndex++)
        @foreach($dosenPengajar as $dosen)
          <article class="prodi-dosen-card">
            <div class="prodi-dosen-photo">
              @if($dosen->foto_url)
                <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama }}" />
              @else
                <div class="prodi-dosen-placeholder" style="color: {{ $accentColor }}; background: color-mix(in srgb, {{ $accentColor }} 10%, white);">
                  <i class="bi bi-person-fill"></i>
                </div>
              @endif
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950/45 via-transparent to-transparent"></div>
            </div>

            <div class="prodi-dosen-info">
              <div class="prodi-dosen-badge" style="color: {{ $accentColor }}; background: color-mix(in srgb, {{ $accentColor }} 10%, white);">
                <i class="bi bi-mortarboard-fill"></i>
                Dosen
              </div>

              <h4 class="mt-3 text-lg font-bold leading-snug text-gray-950" title="{{ $dosen->nama }}">
                {{ $dosen->nama }}
              </h4>

              @if(!empty($dosen->jabatan))
                <p class="mt-2 line-clamp-2 text-sm font-semibold leading-5 text-gray-600">
                  {{ $dosen->jabatan }}
                </p>
              @endif

              @if(!empty($dosen->pendidikan_terakhir) || !empty($dosen->asal_pendidikan))
                <div class="mt-4 flex items-start gap-2 border-t border-gray-100 pt-3 text-xs leading-5 text-gray-500">
                  <i class="bi bi-journal-bookmark-fill mt-0.5 shrink-0" style="color: {{ $accentColor }}"></i>
                  <span class="min-w-0">
                    {{ $dosen->pendidikan_terakhir ?? 'Pendidikan' }}
                    @if(!empty($dosen->asal_pendidikan))
                      <span class="text-gray-400">/</span> {{ $dosen->asal_pendidikan }}
                    @endif
                  </span>
                </div>
              @endif
            </div>
          </article>
        @endforeach
      @endfor
    </div>
  </div>
  @else
  <div class="rounded-2xl border border-dashed border-gray-300 bg-white/80 p-8 text-center text-gray-600">
    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl {{ $accentSoftClass }}" style="color: {{ $accentColor }}">
      <i class="bi bi-person-plus-fill text-2xl"></i>
    </div>
    <p class="font-semibold text-gray-800">Belum ada data dosen.</p>
    <p class="mt-1 text-sm text-gray-500">Data tenaga pengajar untuk {{ $programName }} akan tampil di sini.</p>
  </div>
  @endif

  <section class="mt-10 border-t border-gray-200 pt-8" aria-labelledby="prodi-staff-title">
    <div class="mb-6">
      <p class="text-xs font-bold uppercase tracking-[0.22em] text-gray-400">Layanan Akademik</p>
      <h3 id="prodi-staff-title" class="mt-2 text-2xl font-bold" style="color: {{ $accentColor }};">
        {{ $isHealthProgram && $laborans->isNotEmpty() ? 'Admin Prodi dan Laboran' : 'Admin Program Studi' }}
      </h3>
      <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-600">
        {{ $isHealthProgram && $laborans->isNotEmpty()
            ? 'Tenaga kependidikan yang mendukung administrasi program studi dan kegiatan laboratorium mahasiswa.'
            : 'Tenaga kependidikan yang mendukung administrasi dan layanan akademik program studi.' }}
      </p>
    </div>

    <div class="prodi-staff-grid">
    <article class="prodi-admin-card-public {{ !$isHealthProgram || $laborans->isEmpty() ? 'prodi-admin-card-public--wide' : '' }}">
    <div class="prodi-admin-card-public__photo">
          @if($adminProdi?->foto_url)
            <img src="{{ $adminProdi->foto_url }}"
                 alt="{{ $adminProdi->nama }}"
                 class="h-full w-full object-cover">
          @else
            <div class="flex h-full w-full items-center justify-center {{ $accentSoftClass }}" style="color: {{ $accentColor }};">
              <i class="bi bi-person-badge-fill text-7xl"></i>
            </div>
          @endif
    </div>

    <div class="prodi-admin-card-public__body">
      <div class="inline-flex w-fit items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold" style="color: {{ $accentColor }}; background: color-mix(in srgb, {{ $accentColor }} 10%, white);">
        <i class="bi bi-building-check"></i>
        Administrasi Program Studi
      </div>

      <div class="min-w-0">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">
          Admin Prodi
        </p>
        <h3 class="mt-2 text-lg font-bold leading-snug text-gray-950">
          {{ $adminProdi?->nama ?? 'Data admin prodi belum tersedia' }}
        </h3>
        <p class="mt-3 text-sm leading-6 text-gray-600">
          Kontak administrasi program studi untuk mendukung layanan akademik, koordinasi, dan kebutuhan informasi mahasiswa.
        </p>
      </div>
    </div>
    </article>
  @if($isHealthProgram)
  @foreach($laborans as $laboran)
  <article class="prodi-admin-card-public">
    <div class="prodi-admin-card-public__photo">
      @if($laboran?->foto_url)
        <img src="{{ $laboran->foto_url }}" alt="{{ $laboran->nama }}" class="h-full w-full object-cover">
      @else
        <div class="flex h-full w-full items-center justify-center {{ $accentSoftClass }}" style="color: {{ $accentColor }};">
          <i class="bi bi-person-workspace text-7xl"></i>
        </div>
      @endif
    </div>
    <div class="prodi-admin-card-public__body">
      <div class="inline-flex w-fit items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold" style="color: {{ $accentColor }}; background: color-mix(in srgb, {{ $accentColor }} 10%, white);">
        <i class="bi bi-eyedropper"></i>
        Layanan Laboratorium
      </div>
      <div class="min-w-0">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Laboran</p>
        <h3 class="mt-2 text-lg font-bold leading-snug text-gray-950">
          {{ $laboran?->nama ?? 'Data laboran belum tersedia' }}
        </h3>
        <p class="mt-3 text-sm leading-6 text-gray-600">
          Mendukung praktikum dan layanan laboratorium mahasiswa.
        </p>
      </div>
    </div>
  </article>
  @endforeach
  @endif
    </div>
  </section>
</div>
