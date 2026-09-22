@extends('layouts.main')

@section('title', 'Berita & Informasi Kampus')

@section('content')
@php
    $sections = [
        [
            'title' => 'Berita Terkini',
            'label' => 'Informasi Kampus',
            'description' => 'Kabar terbaru seputar kegiatan, layanan, dan dinamika Universitas Fort De Kock.',
            'data' => $berita,
            'route' => route('berita.terbaru'),
            'accent' => 'orange',
            'icon' => 'newspaper',
        ],
        [
            'title' => 'Prestasi Terbaru',
            'label' => 'Capaian Civitas',
            'description' => 'Apresiasi untuk mahasiswa, dosen, dan institusi dalam berbagai bidang unggulan.',
            'data' => $prestasi,
            'route' => route('berita.prestasi'),
            'accent' => 'emerald',
            'icon' => 'award',
        ],
        [
            'title' => 'Riset Unggulan',
            'label' => 'Inovasi Akademik',
            'description' => 'Publikasi riset, pengabdian, dan pengembangan ilmu yang memberi dampak nyata.',
            'data' => $riset,
            'route' => route('berita.riset'),
            'accent' => 'sky',
            'icon' => 'microscope',
        ],
    ];

    $style = [
        'orange' => [
            'badge' => 'bg-orange-50 text-orange-700 ring-orange-200',
            'solid' => 'bg-orange-600',
            'button' => 'bg-orange-600 hover:bg-orange-700 focus:ring-orange-200',
            'soft' => 'bg-orange-50 text-orange-700',
            'text' => 'text-orange-600',
            'border' => 'border-orange-100',
        ],
        'emerald' => [
            'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'solid' => 'bg-emerald-600',
            'button' => 'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-200',
            'soft' => 'bg-emerald-50 text-emerald-700',
            'text' => 'text-emerald-600',
            'border' => 'border-emerald-100',
        ],
        'sky' => [
            'badge' => 'bg-sky-50 text-sky-700 ring-sky-200',
            'solid' => 'bg-sky-600',
            'button' => 'bg-sky-600 hover:bg-sky-700 focus:ring-sky-200',
            'soft' => 'bg-sky-50 text-sky-700',
            'text' => 'text-sky-600',
            'border' => 'border-sky-100',
        ],
    ];

    $totalBerita = collect($sections)->sum(fn ($section) => $section['data']->count());
    $cleanExcerpt = fn ($content, $limit = 120) => \Illuminate\Support\Str::limit(
        preg_replace('/\s+/', ' ', trim(strip_tags((string) $content))),
        $limit
    );
@endphp

<style>
    .berita-hero {
        min-height: 500px;
        background-image:
            linear-gradient(105deg, rgba(15, 23, 42, .94), rgba(15, 23, 42, .72) 54%, rgba(234, 88, 12, .18)),
            url('/images/banner5.png');
        background-position: center;
        background-size: cover;
    }

    .berita-pattern {
        background-image: url('/images/pattern2.gif');
        background-repeat: repeat;
        background-size: 300px;
    }

    .berita-fade-up {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity .75s ease, transform .75s cubic-bezier(.2, .9, .2, 1);
        transition-delay: var(--delay, 0ms);
    }

    .berita-fade-up.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .berita-shine {
        position: relative;
        overflow: hidden;
    }

    .berita-shine::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(115deg, transparent 30%, rgba(255,255,255,.35), transparent 70%);
        transform: translateX(-120%);
        transition: transform .8s ease;
    }

    .group:hover .berita-shine::after {
        transform: translateX(120%);
    }

    .news-clamp-2,
    .news-clamp-3 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-clamp-2 { -webkit-line-clamp: 2; }
    .news-clamp-3 { -webkit-line-clamp: 3; }

    .news-thumb {
        aspect-ratio: 16 / 10;
    }

    .mini-thumb {
        aspect-ratio: 4 / 3;
    }

    @media (max-width: 768px) {
        .berita-hero {
            min-height: 420px;
        }
    }
</style>

<main class="bg-white text-slate-900">
    <section class="berita-hero relative flex items-center overflow-hidden pt-20">
        <div class="absolute inset-0 berita-pattern opacity-10"></div>
        <div class="absolute -bottom-24 -right-20 h-72 w-72 rounded-full bg-[#FF7F11]/25 blur-3xl"></div>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-6 py-16">
            <nav class="berita-fade-up mb-7 flex items-center gap-2 text-sm font-medium text-slate-200">
                <a href="{{ url('/') }}" class="transition hover:text-orange-300">Beranda</a>
                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                <span class="text-orange-300">Berita</span>
            </nav>

            <div class="max-w-3xl berita-fade-up" style="--delay: 120ms">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-orange-200 ring-1 ring-white/20 backdrop-blur">
                    <i data-lucide="newspaper" class="h-4 w-4"></i>
                    Portal Informasi
                </span>
                <h1 class="mt-6 text-4xl font-black leading-tight text-white md:text-6xl">
                    Berita & Informasi Kampus
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-200 md:text-lg">
                    Kumpulan berita kampus, prestasi, dan riset Universitas Fort De Kock yang tersusun rapi berdasarkan rubrik.
                </p>
            </div>
        </div>
    </section>

    <section class="relative border-b border-slate-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-3 px-6 py-5 md:grid-cols-4">
            <div class="berita-fade-up rounded-2xl bg-[#0F172A] p-5 text-white shadow-lg shadow-slate-900/10">
                <p class="text-xs font-bold uppercase tracking-[0.16em] text-orange-200">Total Publikasi</p>
                <p class="mt-2 text-3xl font-black">{{ $totalBerita }}</p>
            </div>

            @foreach($sections as $index => $section)
                @php $classes = $style[$section['accent']]; @endphp
                <a href="#{{ \Illuminate\Support\Str::slug($section['title']) }}" class="berita-fade-up group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-orange-100 hover:shadow-xl" style="--delay: {{ ($index + 1) * 90 }}ms">
                    <div class="flex items-center justify-between gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-full text-white shadow-md {{ $classes['solid'] }}">
                            <i data-lucide="{{ $section['icon'] }}" class="h-5 w-5"></i>
                        </span>
                        <span class="rounded-full px-3 py-1 text-xs font-black {{ $classes['soft'] }}">{{ $section['data']->count() }}</span>
                    </div>
                    <p class="mt-4 text-sm font-semibold text-slate-500">{{ $section['label'] }}</p>
                    <h2 class="mt-1 text-lg font-black text-slate-950 transition group-hover:text-[#e96f0c]">{{ $section['title'] }}</h2>
                </a>
            @endforeach
        </div>
    </section>

    <div class="relative overflow-hidden bg-gray-50">
        <div class="absolute inset-0 berita-pattern opacity-10"></div>
        <div class="relative mx-auto max-w-7xl space-y-14 px-6 py-12 md:py-20">
        @foreach($sections as $section)
            @php
                $items = $section['data']->values();
                $featured = $items->first();
                $others = $items->slice(1);
                $classes = $style[$section['accent']];
            @endphp

            <section id="{{ \Illuminate\Support\Str::slug($section['title']) }}" class="scroll-mt-28">
                <div class="berita-fade-up mb-7 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-black uppercase tracking-[0.16em] ring-1 {{ $classes['badge'] }}">
                            <i data-lucide="{{ $section['icon'] }}" class="h-3.5 w-3.5"></i>
                            {{ $section['label'] }}
                        </span>
                        <h2 class="mt-3 text-2xl font-black text-slate-950 md:text-3xl">{{ $section['title'] }}</h2>
                        <p class="mt-3 max-w-xl text-sm leading-7 text-slate-600">{{ $section['description'] }}</p>
                    </div>

                    <a href="{{ $section['route'] }}" class="group relative inline-flex h-12 w-fit items-center justify-between gap-3 overflow-hidden rounded-full bg-[#e96f0c] px-6 text-sm font-semibold text-white shadow-lg shadow-orange-600/20 transition hover:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-orange-200">
                        Lihat Semua
                        <i data-lucide="arrow-up-right" class="h-4 w-4 transition duration-300 group-hover:rotate-45"></i>
                    </a>
                </div>

                @if($featured)
                    <div class="grid items-start gap-5 lg:grid-cols-[.95fr_1.05fr]">
                        <a href="{{ route('artikel.show', $featured->slug) }}" class="berita-fade-up group self-start overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                            <div class="news-thumb berita-shine overflow-hidden bg-slate-100">
                                <img src="{{ $featured->thumbnail_url }}" alt="{{ $featured->judul }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            </div>
                            <div class="p-6">
                                <div class="flex flex-wrap items-center gap-3 text-xs font-bold text-slate-500">
                                    <span class="rounded-full px-3 py-1 {{ $classes['soft'] }}">{{ $section['title'] }}</span>
                                    <span>{{ \Carbon\Carbon::parse($featured->tanggal)->translatedFormat('d F Y') }}</span>
                                </div>
                                <h3 class="mt-4 text-xl font-black leading-tight text-slate-950 md:text-2xl news-clamp-2">
                                    {{ $featured->judul }}
                                </h3>
                                <p class="mt-3 text-sm leading-7 text-slate-600 news-clamp-3">
                                    {{ $cleanExcerpt($featured->konten, 150) }}
                                </p>
                                <div class="mt-5 inline-flex items-center gap-2 text-sm font-black {{ $classes['text'] }}">
                                    Baca selengkapnya
                                    <i data-lucide="arrow-up-right" class="h-4 w-4 transition duration-300 group-hover:rotate-45"></i>
                                </div>
                            </div>
                        </a>

                        <div class="grid gap-4 sm:grid-cols-2">
                            @forelse($others->take(4) as $itemIndex => $item)
                                <a href="{{ route('artikel.show', $item->slug) }}" class="berita-fade-up group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" style="--delay: {{ ($itemIndex + 1) * 80 }}ms">
                                    <div class="grid grid-cols-[118px_1fr] gap-0 sm:block">
                                        <div class="mini-thumb berita-shine overflow-hidden bg-slate-100">
                                            <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        </div>
                                        <div class="min-w-0 p-4">
                                            <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}
                                            </p>
                                            <h3 class="mt-2 text-sm font-black leading-snug text-slate-950 news-clamp-2">
                                                {{ $item->judul }}
                                            </h3>
                                            <p class="mt-2 hidden text-xs leading-6 text-slate-600 sm:block news-clamp-2">
                                                {{ $cleanExcerpt($item->konten, 82) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="berita-fade-up flex min-h-[160px] items-center rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-sm leading-7 text-slate-500 sm:col-span-2">
                                    Berita lain pada kategori ini akan tampil di sini setelah data tambahan tersedia.
                                </div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="berita-fade-up rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center shadow-sm">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                            <i data-lucide="file-text" class="h-6 w-6"></i>
                        </div>
                        <h3 class="mt-4 text-lg font-black text-slate-950">Belum ada data {{ strtolower($section['title']) }}</h3>
                        <p class="mx-auto mt-2 max-w-xl text-sm leading-7 text-slate-600">
                            Konten pada kategori ini akan otomatis muncul setelah berita dipublikasikan melalui halaman admin.
                        </p>
                    </div>
                @endif
            </section>
        @endforeach
        </div>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll(".berita-fade-up");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    reveals.forEach((el) => observer.observe(el));
});
</script>
@endsection
