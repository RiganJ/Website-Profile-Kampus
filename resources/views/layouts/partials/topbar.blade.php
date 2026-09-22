<style>
    #navbar .nav-link {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: color .3s ease;
        flex-shrink: 0;
        white-space: nowrap;
    }

    #navbar .topbar-container {
        width: min(100%, 1600px);
        max-width: none;
    }

    #navbar .topbar-row {
        gap: 1rem;
    }

    #navbar .desktop-navigation {
        margin: 0;
    }

    @media (min-width: 1280px) {
        #navbar .topbar-row {
            display: grid;
            grid-template-columns: 180px minmax(0, 1fr) 180px;
            gap: 1rem;
        }

        #navbar .desktop-navigation {
            justify-self: center;
        }

        #navbar .desktop-actions {
            justify-self: end;
        }
    }

    @media (min-width: 1536px) {
        #navbar .topbar-row {
            grid-template-columns: 205px minmax(0, 1fr) 205px;
        }
    }

    #navbar .nav-link:hover {
        color: #f97316;
    }

    #navbar .nav-link-current {
        color: #fb923c;
    }

    #navbar .dropdown-item-current {
        background: #fff7ed;
        color: #ea580c;
        font-weight: 700;
    }

    #navbar .dropdown-toggle,
    #navbar .dropdown-toggle:hover,
    #navbar .dropdown-toggle:focus,
    #navbar .dropdown-toggle:active {
        appearance: none;
        padding: 0;
        border: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        color: inherit !important;
    }

    #navbar .dropdown-toggle:hover {
        color: #f97316 !important;
    }

    #navbar .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        transition: all .2s ease;
    }

    #navbar .dropdown-item:hover {
        background: #f1f5f9;
        color: #f97316;
        padding-left: 20px;
    }

    #navbar .language-switch {
        border: 1px solid rgba(255, 255, 255, .45);
        color: #fff;
        background: rgba(255, 255, 255, .12);
    }

    #navbar .language-switch:hover {
        border-color: #f97316;
        background: #f97316;
        color: #fff;
    }

    @media (min-width: 1280px) and (max-width: 1535px) {
        #navbar .desktop-navigation {
            gap: .5rem;
            font-size: .8125rem;
        }

        #navbar .desktop-register {
            min-width: 142px;
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    #navbar .dropdown.is-open > .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    #navbar .dropdown.is-click-closed > .dropdown-menu {
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(.75rem) !important;
    }

    #navbar .dropdown.is-open > .dropdown-toggle .dropdown-chevron {
        transform: rotate(180deg);
    }

    #navbar .dropdown-toggle:focus-visible,
    #navbar #mobileBtn:focus-visible {
        outline: 2px solid #fb923c;
        outline-offset: 4px;
        border-radius: .5rem;
    }

    @media (max-width: 1279px) {
        #mobileMenu {
            max-height: calc(100dvh - 5rem);
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        #mobileMenu .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: .65rem;
            min-height: 42px;
            padding: .6rem .75rem;
            border-radius: .75rem;
            color: #334155;
            transition: color .2s ease, background-color .2s ease;
        }

        #mobileMenu .mobile-nav-link:hover {
            color: #ea580c;
            background: #fff7ed;
        }

        #mobileMenu .mobile-nav-link > svg {
            width: 17px;
            height: 17px;
            flex: 0 0 auto;
            color: #f97316;
        }

        #mobileMenu .mobile-section {
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            background: #fff;
            padding: .85rem;
        }

        #mobileMenu .mobile-section-title {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: .5rem;
            color: #0f172a;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        #mobileMenu .mobile-section-title > svg {
            width: 16px;
            height: 16px;
            color: #f97316;
        }

        #mobileMenu .mobile-accordion > summary {
            display: flex;
            min-height: 44px;
            cursor: pointer;
            list-style: none;
            align-items: center;
            gap: .65rem;
            border-radius: .75rem;
            padding: .65rem .75rem;
            color: #0f172a;
            font-weight: 700;
            transition: color .2s ease, background-color .2s ease;
        }

        #mobileMenu .mobile-accordion > summary::-webkit-details-marker {
            display: none;
        }

        #mobileMenu .mobile-accordion > summary:hover,
        #mobileMenu .mobile-accordion[open] > summary {
            background: #fff7ed;
            color: #ea580c;
        }

        #mobileMenu .mobile-accordion > summary > svg:first-child {
            width: 18px;
            height: 18px;
            color: #f97316;
        }

        #mobileMenu .mobile-accordion-chevron {
            width: 17px;
            height: 17px;
            margin-left: auto;
            transition: transform .2s ease;
        }

        #mobileMenu .mobile-accordion[open] .mobile-accordion-chevron {
            transform: rotate(180deg);
        }

        #mobileMenu .mobile-accordion-panel {
            display: grid;
            gap: .2rem;
            padding: .35rem .25rem .25rem;
        }

        #mobileMenu .mobile-nav-current {
            background: #fff7ed;
            color: #ea580c;
            font-weight: 700;
        }
    }
</style>

<header id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 transform nav-gradient">
    <div class="topbar-container mx-auto px-4 sm:px-6">
        <div class="topbar-row flex h-20 items-center">
            <a href="/" class="flex shrink-0 items-center">
                <img src="{{ asset('images/logoufdk.png') }}" alt="Logo Universitas Fort De Kock" class="h-16 sm:h-20 w-auto object-contain">
            </a>

            <nav class="desktop-navigation mx-auto hidden min-w-0 items-center justify-center gap-3 text-sm font-medium text-white xl:flex 2xl:gap-5">
                <a href="/" class="nav-link flex items-center gap-2 {{ request()->routeIs('home') ? 'nav-link-current' : '' }}"><i data-lucide="home" class="w-4 h-4"></i>{{ __('ui.home') }}</a>
                <div class="dropdown relative group">
                    <button type="button" class="dropdown-toggle nav-link flex items-center gap-2 {{ request()->routeIs('sejarah.*', 'pendiri.*', 'logo-makna.*', 'visi-misi.*', 'sambutan.*', 'struktur.*', 'pimpinan.*', 'akreditasi.*') ? 'nav-link-current' : '' }}" aria-expanded="false">
                        <i data-lucide="building-2" class="w-4 h-4"></i>{{ __('ui.profile') }}
                        <i data-lucide="chevron-down" class="dropdown-chevron w-4 h-4 transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-60 bg-white text-gray-700 rounded-xl shadow-lg opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200">
                        <a href="/sejarah" class="dropdown-item flex items-center gap-2 {{ request()->routeIs('sejarah.index') ? 'dropdown-item-current' : '' }}"><i data-lucide="book" class="w-4 h-4"></i>{{ __('ui.history') }}</a>
                        <a href="/pendiri" class="dropdown-item flex items-center gap-2"><i data-lucide="landmark" class="w-4 h-4"></i>{{ __('ui.founder') }}</a>
                        <a href="{{ route('logo-makna.index') }}" class="dropdown-item flex items-center gap-2"><i data-lucide="badge" class="w-4 h-4"></i>Logo &amp; Makna</a>
                        <a href="/visimisi" class="dropdown-item flex items-center gap-2"><i data-lucide="target" class="w-4 h-4"></i>{{ __('ui.vision_mission') }}</a>
                        <a href="/sambutan-rektor" class="dropdown-item flex items-center gap-2"><i data-lucide="user" class="w-4 h-4"></i>{{ __('ui.rector_message') }}</a>
                        <a href="/sambutan-yayasan" class="dropdown-item flex items-center gap-2"><i data-lucide="handshake" class="w-4 h-4"></i>{{ __('ui.foundation_message') }}</a>
                        <a href="/struktur" class="dropdown-item flex items-center gap-2"><i data-lucide="network" class="w-4 h-4"></i>{{ __('ui.organization_structure') }}</a>
                        <a href="/pimpinan" class="dropdown-item flex items-center gap-2"><i data-lucide="users" class="w-4 h-4"></i>{{ __('ui.leadership_profile') }}</a>
                        <a href="/akreditasi" class="dropdown-item flex items-center gap-2"><i data-lucide="award" class="w-4 h-4"></i>{{ __('ui.accreditation') }}</a>
                    </div>
                </div>
                <div class="dropdown relative group">
                    <button type="button" class="dropdown-toggle nav-link flex items-center gap-2" aria-expanded="false">
                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>{{ __('ui.academic') }}
                        <i data-lucide="chevron-down" class="dropdown-chevron w-4 h-4 transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-60 bg-white text-gray-700 rounded-xl shadow-lg opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200">
                        @include('layouts.partials.academic-dropdown')
                    </div>
                </div>
                <a href="/berita" class="nav-link flex items-center gap-2"><i data-lucide="newspaper" class="w-4 h-4"></i>{{ __('ui.news') }}</a>
                <a href="{{ route('biaya-kuliah.index') }}" class="nav-link flex items-center gap-2"><i data-lucide="wallet-cards" class="w-4 h-4"></i>Biaya Kuliah</a>
                <a href="https://ppid.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="nav-link flex items-center gap-2"><i data-lucide="info" class="w-4 h-4"></i>PPID</a>
                <div class="dropdown relative shrink-0 group">
                    <button type="button" class="dropdown-toggle nav-link flex shrink-0 items-center gap-2 whitespace-nowrap" aria-expanded="false">
                        <i data-lucide="grid-2x2" class="h-4 w-4"></i>
                        <span class="inline-flex shrink-0 items-center gap-1 whitespace-nowrap">
                            Portal & Layanan
                            <i data-lucide="chevron-down" class="dropdown-chevron h-4 w-4 shrink-0 transition-transform duration-300 group-hover:rotate-180"></i>
                        </span>
                    </button>
                    <div class="dropdown-menu invisible absolute right-0 mt-2 w-64 translate-y-3 rounded-xl bg-white py-2 text-gray-700 opacity-0 shadow-lg transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                        <p class="px-4 pb-1 pt-2 text-[11px] font-bold uppercase tracking-wider text-gray-400">Layanan Akademik</p>
                        <a href="https://opac.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="book-open" class="h-4 w-4"></i>OPAC</a>
                        <a href="https://repo.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="archive" class="h-4 w-4"></i>Repository</a>
                        <a href="https://ojs.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="newspaper" class="h-4 w-4"></i>E-Journal</a>

                        <p class="mt-1 border-t border-gray-100 px-4 pb-1 pt-3 text-[11px] font-bold uppercase tracking-wider text-gray-400">Pembelajaran & Akses</p>
                        <a href="https://student.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="graduation-cap" class="h-4 w-4"></i>Portal Mahasiswa</a>
                        <a href="https://lecturer.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="presentation" class="h-4 w-4"></i>Portal Dosen</a>
                        <a href="https://lms.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="monitor-play" class="h-4 w-4"></i>LMS</a>

                        <p class="mt-1 border-t border-gray-100 px-4 pb-1 pt-3 text-[11px] font-bold uppercase tracking-wider text-gray-400">Institusi & Lainnya</p>
                        <a href="https://etik.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="shield-check" class="h-4 w-4"></i>KEPK</a>
                        <a href="https://alumni.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="users" class="h-4 w-4"></i>Alumni</a>
                        <a href="https://icof.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="globe-2" class="h-4 w-4"></i>ICOF</a>
                        <a href="https://lpmi.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="badge-check" class="h-4 w-4"></i>LPMI</a>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScqg-2njkKrCEfZh9Zf1AYa2lYawCNfDzHjGBoY2sn3sHw6LQ/viewform" target="_blank" rel="noopener noreferrer" class="dropdown-item flex items-center gap-2"><i data-lucide="shield-alert" class="h-4 w-4"></i>PPKPT</a>
                    </div>
                </div>
                <a href="/contact" class="nav-link flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4"></i>{{ __('ui.contact') }}</a>
                <a href="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}"
                   class="language-switch inline-flex h-9 items-center gap-1.5 rounded-full px-3 text-xs font-semibold transition"
                   aria-label="Ganti bahasa ke {{ app()->getLocale() === 'id' ? 'English' : 'Indonesia' }}"
                   title="Ganti bahasa ke {{ app()->getLocale() === 'id' ? 'English' : 'Indonesia' }}">
                    <i data-lucide="languages" class="h-4 w-4"></i>
                    <span>{{ __('ui.lang_switch_to') }}</span>
                </a>
            </nav>

            <div class="desktop-actions hidden shrink-0 items-center xl:flex">
                <a href="https://pmb.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="desktop-register group relative flex h-12 min-w-[150px] items-center justify-between overflow-hidden rounded-full bg-white/20 px-5 text-slate-800 backdrop-blur-md 2xl:h-14 2xl:min-w-[176px] 2xl:px-6">
                    <span class="absolute inset-0 bg-[#f47511] scale-x-0 origin-left transition-transform duration-500 ease-out group-hover:scale-x-100"></span>
                    <span class="relative z-10 text-sm font-medium transition-colors duration-300 group-hover:text-white">{{ __('ui.register_now') }}</span>
                    <i data-lucide="arrow-up-right" class="relative z-10 w-5 h-5 transition-all duration-300 group-hover:rotate-45 group-hover:translate-x-1 group-hover:text-white"></i>
                </a>
            </div>

            <button id="mobileBtn" type="button" class="ml-auto inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-white/30 bg-white/15 text-white backdrop-blur-sm xl:hidden" aria-controls="mobileMenu" aria-expanded="false" aria-label="Buka menu navigasi">
                <i data-lucide="menu" class="h-6 w-6"></i>
            </button>
        </div>

        <div id="mobileMenu" class="absolute top-full left-0 hidden w-full bg-slate-50/95 shadow-xl backdrop-blur-lg xl:hidden">
            <div class="mx-auto flex max-w-3xl flex-col gap-3 p-4 font-medium text-slate-700 sm:p-5">
                <div class="mobile-section">
                    <p class="mobile-section-title"><i data-lucide="menu"></i>Menu Utama</p>
                    <div class="grid grid-cols-2 gap-1">
                        <a href="/" class="mobile-nav-link {{ request()->routeIs('home') ? 'mobile-nav-current' : '' }}"><i data-lucide="home"></i>{{ __('ui.home') }}</a>
                        <a href="/berita" class="mobile-nav-link"><i data-lucide="newspaper"></i>{{ __('ui.news') }}</a>
                        <a href="{{ route('biaya-kuliah.index') }}" class="mobile-nav-link"><i data-lucide="wallet-cards"></i>Biaya Kuliah</a>
                        <a href="https://ppid.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="info"></i>PPID</a>
                        <a href="/contact" class="mobile-nav-link"><i data-lucide="phone"></i>{{ __('ui.contact') }}</a>
                    </div>
                </div>

                <details class="mobile-accordion mobile-section" {{ request()->routeIs('sejarah.*', 'pendiri.*', 'logo-makna.*', 'visi-misi.*', 'sambutan.*', 'struktur.*', 'pimpinan.*', 'akreditasi.*') ? 'open' : '' }}>
                    <summary><i data-lucide="building-2"></i>{{ __('ui.profile') }}<i data-lucide="chevron-down" class="mobile-accordion-chevron"></i></summary>
                    <div class="mobile-accordion-panel sm:grid-cols-2">
                        <a href="/sejarah" class="mobile-nav-link {{ request()->routeIs('sejarah.index') ? 'mobile-nav-current' : '' }}"><i data-lucide="book"></i>{{ __('ui.history') }}</a>
                        <a href="/pendiri" class="mobile-nav-link"><i data-lucide="landmark"></i>{{ __('ui.founder') }}</a>
                        <a href="{{ route('logo-makna.index') }}" class="mobile-nav-link"><i data-lucide="badge"></i>Logo &amp; Makna</a>
                        <a href="/visimisi" class="mobile-nav-link"><i data-lucide="target"></i>{{ __('ui.vision_mission') }}</a>
                        <a href="/sambutan-rektor" class="mobile-nav-link"><i data-lucide="user"></i>{{ __('ui.rector_message') }}</a>
                        <a href="/sambutan-yayasan" class="mobile-nav-link"><i data-lucide="handshake"></i>{{ __('ui.foundation_message') }}</a>
                        <a href="/struktur" class="mobile-nav-link"><i data-lucide="network"></i>{{ __('ui.organization_structure') }}</a>
                        <a href="/pimpinan" class="mobile-nav-link"><i data-lucide="users"></i>{{ __('ui.leadership_profile') }}</a>
                        <a href="/akreditasi" class="mobile-nav-link"><i data-lucide="award"></i>{{ __('ui.accreditation') }}</a>
                    </div>
                </details>

                <details class="mobile-accordion mobile-section">
                    <summary><i data-lucide="graduation-cap"></i>{{ __('ui.academic') }}<i data-lucide="chevron-down" class="mobile-accordion-chevron"></i></summary>
                    <div class="mobile-accordion-panel sm:grid-cols-2">
                        <a href="/prodi" class="mobile-nav-link"><i data-lucide="layout-grid"></i>{{ __('ui.study_program') }}</a>
                        <a href="{{ route('faculty.show', 'kesehatan', false) }}" class="mobile-nav-link"><i data-lucide="heart-pulse"></i>{{ __('ui.health_faculty') }}</a>
                        <a href="{{ route('faculty.show', 'sosial-ekonomi-humaniora', false) }}" class="mobile-nav-link"><i data-lucide="landmark"></i>{{ __('ui.social_humanities_faculty') }}</a>
                        <a href="https://opac.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="library"></i>{{ __('ui.library') }}</a>
                        <a href="{{ route('pusat-informasi.index') }}" class="mobile-nav-link"><i data-lucide="file-text"></i>{{ __('ui.information_center') }}</a>
                    </div>
                </details>

                <details class="mobile-accordion mobile-section">
                    <summary><i data-lucide="grid-2x2"></i>Portal &amp; Layanan<i data-lucide="chevron-down" class="mobile-accordion-chevron"></i></summary>
                    <div class="mobile-accordion-panel grid-cols-2 text-sm sm:grid-cols-3">
                        <a href="https://opac.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="book-open"></i>OPAC</a>
                        <a href="https://repo.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="archive"></i>Repository</a>
                        <a href="https://ojs.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="newspaper"></i>E-Journal</a>
                        <a href="https://student.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="graduation-cap"></i>Portal Mahasiswa</a>
                        <a href="https://lecturer.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="presentation"></i>Portal Dosen</a>
                        <a href="https://lms.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="monitor-play"></i>LMS</a>
                        <a href="https://etik.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="shield-check"></i>KEPK</a>
                        <a href="https://alumni.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="users"></i>Alumni</a>
                        <a href="https://icof.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="globe-2"></i>ICOF</a>
                        <a href="https://lpmi.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="badge-check"></i>LPMI</a>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScqg-2njkKrCEfZh9Zf1AYa2lYawCNfDzHjGBoY2sn3sHw6LQ/viewform" target="_blank" rel="noopener noreferrer" class="mobile-nav-link"><i data-lucide="shield-alert"></i>PPKPT</a>
                    </div>
                </details>

                <div class="grid grid-cols-[auto_1fr] gap-3 pt-1">
                    <a href="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-center text-slate-700 transition hover:border-orange-300 hover:text-orange-600">
                        <i data-lucide="languages" class="h-4 w-4"></i>{{ __('ui.lang_switch_to') }}
                    </a>
                    <a href="https://pmb.ufdk.ac.id" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#f97316] px-4 text-center font-semibold text-white shadow-sm transition hover:bg-[#ea580c]">
                        {{ __('ui.register_now') }}<i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
(() => {
    const navbar = document.getElementById('navbar');
    if (!navbar || navbar.dataset.dropdownClickReady === 'true') return;
    navbar.dataset.dropdownClickReady = 'true';

    const dropdowns = [...navbar.querySelectorAll('nav > .dropdown')];
    const mobileButton = document.getElementById('mobileBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileButton?.addEventListener('click', () => {
        window.setTimeout(() => {
            const isOpen = mobileMenu && !mobileMenu.classList.contains('hidden');
            mobileButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            mobileButton.setAttribute('aria-label', isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi');
        });
    });

    const closeDropdown = (dropdown, forceWhileHovered = false) => {
        dropdown.classList.remove('is-open');
        dropdown.classList.toggle('is-click-closed', forceWhileHovered);
        dropdown.querySelector(':scope > .dropdown-toggle')?.setAttribute('aria-expanded', 'false');
    };

    const closeAll = (except = null) => {
        dropdowns.forEach((dropdown) => {
            if (dropdown !== except) closeDropdown(dropdown);
        });
    };

    dropdowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector(':scope > .dropdown-toggle');
        if (!toggle) return;

        toggle.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            const wasOpen = dropdown.classList.contains('is-open');

            closeAll(dropdown);
            if (wasOpen) {
                closeDropdown(dropdown, true);
                return;
            }

            dropdown.classList.remove('is-click-closed');
            dropdown.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
            navbar.style.transform = 'translateY(0)';
        });

        dropdown.addEventListener('mouseleave', () => {
            dropdown.classList.remove('is-click-closed');
        });
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('#navbar nav > .dropdown')) closeAll();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        const activeToggle = navbar.querySelector('.dropdown-toggle[aria-expanded="true"]');
        closeAll();
        activeToggle?.focus();
    });
})();
</script>
