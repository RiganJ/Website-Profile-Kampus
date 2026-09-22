<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.site-icons')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Universitas Fort De Kock')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind CDN (Development) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  rel="stylesheet"/>
  <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/bidan.css', 'resources/js/app.js'])
    @else
        {{-- Vite manifest not found; use compiled assets if present --}}
        @if (file_exists(public_path('css/bidan.css')))
            <link rel="stylesheet" href="{{ asset('css/bidan.css') }}">
        @endif
        @if (file_exists(public_path('js/app.js')))
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
    @endif
    <style>


/* Footer overlay biar teks kebaca */
.footer-overlay {
  background: linear-gradient(
    rgba(15,23,42,0.85),
    rgba(15,23,42,0.85)
  );
}

/* Link hover effect */
.footer-link {
  transition: all .3s ease;
}

.footer-link:hover {
  color: var(--accent);
  padding-left: 6px;
}

.nav-gradient {
    background: linear-gradient(
        to bottom,
        rgba(15,23,42,0.8),
        rgba(15,23,42,0.4),
        transparent
    );
}

/* Link */
/* Hilangkan background aneh */
.nav-link {
    text-decoration: none;
    transition: 0.3s;
}

.nav-link:hover {
    color: #f97316; /* ganti kalau ga mau oren */
}

/* Dropdown muncul */
.dropdown:hover .dropdown-menu {
    display: block;
}

/* Item dropdown */
.dropdown-item {
    display: flex;
    align-items: center;
    padding: 10px 16px;
    transition: all .2s ease;
}

.dropdown-item:hover {
    background: #f1f5f9;
    padding-left: 20px;
    color: #f97316; /* orange hover */
}
/* ================= NAV GRAY (Glass Abu Transparan) ================= */
.nav-gray {
    background: rgba(31, 41, 55, 0.85); /* slate-800 transparan */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px); /* support Safari */
}
</style>
<!-- ======================= NAVBAR ======================= -->
@include('layouts.partials.topbar')
<!-- ======================= CONTENT ======================= -->
<main class="overflow-visible">
    @yield('content')
</main>


<!-- ======================= FOOTER ======================= -->
@include('layouts.partials.site-footer')

<!-- ======================= SCRIPTS ======================= -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration:700, once:true, offset:100 });
lucide.createIcons();

// Mobile Menu Toggle
const mobileBtn = document.getElementById("mobileBtn");
if (mobileBtn) {
    mobileBtn.addEventListener("click", function(){
        document.getElementById("mobileMenu").classList.toggle("hidden");
    });
}
// Navbar Scroll Behavior
let lastScroll = 0;
const navbar = document.getElementById("navbar");

window.addEventListener("scroll", function() {
    let currentScroll = window.pageYOffset;

    if (currentScroll <= 10) {
        navbar.style.transform = "translateY(0)";
        navbar.classList.remove("nav-gray", "shadow-lg");
        navbar.classList.add("nav-gradient");
        lastScroll = currentScroll;
        return;
    }

    if (currentScroll > lastScroll) {
        navbar.style.transform = "translateY(-120%)";
    } else {
        navbar.style.transform = "translateY(0)";
        navbar.classList.remove("nav-gradient");
        navbar.classList.add("nav-gray", "shadow-lg");
    }

    lastScroll = currentScroll;
});
</script>
@stack('scripts')

</body>
</html>
