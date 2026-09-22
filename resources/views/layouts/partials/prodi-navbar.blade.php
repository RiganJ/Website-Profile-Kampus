<header id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 transform nav-gradient">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex items-center justify-between h-20">
      <a href="{{ url('/home') }}" class="flex items-center">
        <img
          src="{{ asset('images/logoufdk.png') }}"
          alt="Logo Universitas Fort De Kock"
          class="h-20 w-auto object-contain"
        >
      </a>

      <nav class="hidden md:flex items-center gap-10 text-sm font-medium text-white">
        <a href="{{ url('/home') }}" class="nav-link flex items-center gap-2">
          <i data-lucide="home" class="w-4 h-4"></i>
          Beranda
        </a>

        <div class="dropdown relative group">
          <a href="#" class="nav-link flex items-center gap-2">
            <i data-lucide="building-2" class="w-4 h-4"></i>
            Profil
            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"></i>
          </a>

          <div class="dropdown-menu absolute left-0 mt-2 w-60 bg-white text-gray-700 rounded-xl shadow-lg opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200">
            <a href="{{ url('/pendiri') }}" class="dropdown-item flex items-center gap-2">
              <i data-lucide="landmark" class="w-4 h-4"></i>
              Pendiri
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="target" class="w-4 h-4"></i>
              Visi & Misi
            </a>
            <a href="{{ url('/sambutan-rektor') }}" class="dropdown-item flex items-center gap-2">
              <i data-lucide="user" class="w-4 h-4"></i>
              Sambutan Rektor
            </a>
            <a href="{{ url('/sambutan-yayasan') }}" class="dropdown-item flex items-center gap-2">
              <i data-lucide="handshake" class="w-4 h-4"></i>
              Sambutan Yayasan
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="network" class="w-4 h-4"></i>
              Struktur Organisasi
            </a>
            <a href="{{ url('/pimpinan') }}" class="dropdown-item flex items-center gap-2">
              <i data-lucide="users" class="w-4 h-4"></i>
              Profil Pimpinan
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="map-pin" class="w-4 h-4"></i>
              Lokasi
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="award" class="w-4 h-4"></i>
              Akreditasi
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="trophy" class="w-4 h-4"></i>
              Prestasi & Penghargaan
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="file-text" class="w-4 h-4"></i>
              Laporan Tahunan
            </a>
          </div>
        </div>

        <div class="dropdown relative group">
          <a href="#" class="nav-link flex items-center gap-2">
            <i data-lucide="graduation-cap" class="w-4 h-4"></i>
            Akademik
            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"></i>
          </a>

          <div class="dropdown-menu absolute left-0 mt-2 w-60 bg-white text-gray-700 rounded-xl shadow-lg opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200">
            <a href="{{ url('/program-studi') }}" class="dropdown-item flex items-center gap-2">
              <i data-lucide="book-open" class="w-4 h-4"></i>
              Program Studi
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="library" class="w-4 h-4"></i>
              Perpustakaan
            </a>
            <a href="#" class="dropdown-item flex items-center gap-2">
              <i data-lucide="gift" class="w-4 h-4"></i>
              Beasiswa
            </a>
          </div>
        </div>

        <a href="{{ url('/berita') }}" class="nav-link flex items-center gap-2">
          <i data-lucide="newspaper" class="w-4 h-4"></i>
          Berita
        </a>

        <a href="{{ url('/contact') }}" class="nav-link flex items-center gap-2">
          <i data-lucide="phone" class="w-4 h-4"></i>
          Kontak
        </a>
      </nav>

      <div class="hidden md:flex items-center">
        <a
          href="{{ url('/contact') }}"
          class="group relative w-36 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-between px-5 text-white transition-all duration-300 hover:bg-orange-500"
        >
          <span class="text-sm font-medium transition-colors duration-300 group-hover:text-white">
            Kontak Kami
          </span>
          <i data-lucide="arrow-up-right" class="w-5 h-5 transition-all duration-300 group-hover:rotate-45 rotate-0 group-hover:translate-x-1"></i>
        </a>
      </div>

      <button id="mobileBtn" class="md:hidden rounded-lg bg-white/20 px-3 py-2 text-sm font-semibold text-white backdrop-blur">
        Menu
      </button>
    </div>

    <div id="mobileMenu" class="md:hidden bg-white/95 backdrop-blur-lg absolute top-full left-0 w-full hidden shadow-xl">
      <div class="flex flex-col p-6 gap-4 text-slate-700 font-medium">
        <a href="{{ url('/home') }}">Beranda</a>
        <a href="#">Profil</a>
        <a href="{{ url('/program-studi') }}">Akademik</a>
        <a href="{{ url('/berita') }}">Berita</a>
        <a href="{{ url('/contact') }}">Kontak</a>
      </div>
    </div>
  </div>
</header>
