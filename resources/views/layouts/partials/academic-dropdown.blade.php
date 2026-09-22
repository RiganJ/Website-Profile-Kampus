<style>
  .academic-submenu,
  .faculty-submenu {
    position: relative;
  }

  .academic-panel,
  .faculty-panel {
    position: absolute;
    top: 0;
    left: 100%;
    min-width: 17rem;
    background: #fff;
    color: #374151;
    border-radius: .75rem;
    box-shadow: 0 18px 45px rgba(15, 23, 42, .18);
    opacity: 0;
    visibility: hidden;
    transform: translateX(10px);
    transition: all .2s ease;
    overflow: visible;
    z-index: 60;
  }

  .academic-panel::before,
  .faculty-panel::before {
    content: "";
    position: absolute;
    top: 0;
    left: -12px;
    width: 12px;
    height: 100%;
  }

  .academic-panel {
    min-width: 20rem;
  }

  .faculty-panel {
    max-height: min(70vh, 31rem);
    overflow-y: auto;
  }

  .academic-submenu:hover > .academic-panel,
  .academic-submenu:focus-within > .academic-panel,
  .faculty-submenu:hover > .faculty-panel,
  .faculty-submenu:focus-within > .faculty-panel {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
  }

  .academic-submenu-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .75rem;
    width: 100%;
  }

  .academic-submenu-link:hover {
    background: #f1f5f9;
    color: #f97316;
  }

  .faculty-submenu:hover > .academic-submenu-link,
  .faculty-submenu:focus-within > .academic-submenu-link {
    background: #fff7ed;
    color: #f97316;
  }

  .faculty-panel a {
    display: block;
    padding: 9px 14px;
    font-size: 13px;
    transition: all .18s ease;
  }

  .faculty-panel a:hover {
    background: #f8fafc;
    color: #f97316;
    padding-left: 18px;
  }
</style>

<div class="academic-submenu">
  <a href="/prodi" class="dropdown-item academic-submenu-link">
    <span class="flex items-center gap-2">
      <i data-lucide="building-2" class="w-4 h-4"></i>
      {{ __('ui.faculty') }}
    </span>
    <i data-lucide="chevron-right" class="w-4 h-4"></i>
  </a>

  <div class="academic-panel">
    <div class="faculty-submenu">
      <a href="{{ route('faculty.show', 'kesehatan', false) }}" class="dropdown-item academic-submenu-link">
        <span class="flex items-center gap-2">
          <i data-lucide="heart-pulse" class="w-4 h-4"></i>
          {{ __('ui.health_faculty') }}
        </span>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
      </a>
      <div class="faculty-panel">
        <a href="{{ route('prodi.pasca-sarjana.s2.kesmas', [], false) }}">S2 Kesehatan Masyarakat</a>
        <a href="{{ route('prodi.sarjana.s1.kesmas', [], false) }}">S1 Kesehatan Masyarakat</a>
        <a href="{{ route('prodi.proefsiners', [], false) }}">Profesi Ners</a>
        <a href="{{ route('prodi.profesibidan', [], false) }}">Profesi Bidan</a>
        <a href="{{ route('prodi.sarjana.s1.farmasi', [], false) }}">S1 Farmasi</a>
        <a href="{{ route('prodi.sarjana.s1.bidan', [], false) }}">S1 Kebidanan</a>
        <a href="{{ route('prodi.sarjana.s1.keperawatan', [], false) }}">S1 Keperawatan</a>
        <a href="{{ route('prodi.sarjana.s1.fisiotrapi', [], false) }}">S1 Fisioterapi</a>
        <a href="{{ route('prodi.diploma.d3.fisiotrapi', [], false) }}">D3 Fisioterapi</a>
      </div>
    </div>

    <div class="faculty-submenu">
      <a href="{{ route('faculty.show', 'sosial-ekonomi-humaniora', false) }}" class="dropdown-item academic-submenu-link">
        <span class="flex items-center gap-2">
          <i data-lucide="landmark" class="w-4 h-4"></i>
          {{ __('ui.social_humanities_faculty') }}
        </span>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
      </a>
      <div class="faculty-panel">
        <a href="{{ route('prodi.sarjana.s1.psikologi', [], false) }}">S1 Psikologi</a>
        <a href="{{ route('prodi.sarjana.s1.bisnisdigital', [], false) }}">S1 Bisnis Digital</a>
        <a href="{{ route('prodi.sarjana.s1.dkv', [], false) }}">S1 Desain Komunikasi Visual</a>
        <a href="{{ route('prodi.sarjana.s1.pariwisata', [], false) }}">S1 Pariwisata</a>
        <a href="{{ route('prodi.sarjana.s1.hukum', [], false) }}">S1 Hukum</a>
        <a href="{{ route('prodi.sarjana.s1.kewirausahaan', [], false) }}">S1 Kewirausahaan</a>
      </div>
    </div>
  </div>
</div>

<a href="https://opac.ufdk.ac.id" class="dropdown-item flex items-center gap-2">
  <i data-lucide="library" class="w-4 h-4"></i>
  {{ __('ui.library') }}
</a>

<a href="{{ route('pusat-informasi.index', [], false) }}" class="dropdown-item flex items-center gap-2">
  <i data-lucide="file-text" class="w-4 h-4"></i>
  {{ __('ui.information_center') }}
</a>
