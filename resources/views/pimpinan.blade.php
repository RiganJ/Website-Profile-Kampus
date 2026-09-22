@extends('layouts.main')

@section('title', 'Pimpinan - Universitas Fort De Kock')

@section('content')
<style>
    .leader-hero {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: linear-gradient(120deg, rgba(15, 23, 42, .9), rgba(15, 23, 42, .54)), url('/images/sejarah1.jpg') center/cover no-repeat;
    }

    .leader-hero-title {
        color: #fff;
        font-size: clamp(2.4rem, 5vw, 4.6rem);
        font-weight: 900;
        line-height: 1.05;
        letter-spacing: 0;
    }

    .leader-hero-title span {
        color: #fb923c;
    }

    .leader-card img {
        background: #f8fafc;
    }

    .leader-card .leader-summary {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .profile-cta {
        position: relative;
        display: inline-flex;
        height: 52px;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        overflow: hidden;
        border-radius: 999px;
        padding: 0 16px;
        background: #0f172a;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        width: max-content;
    }

    .profile-cta::before {
        content: "";
        position: absolute;
        inset: 0;
        transform: scaleX(0);
        transform-origin: left;
        background: #f47511;
        transition: transform .5s ease;
    }

    .profile-cta:hover::before {
        transform: scaleX(1);
    }

    .profile-cta span,
    .profile-cta svg {
        position: relative;
        z-index: 1;
    }

    .profile-cta svg {
        transition: transform .3s ease, color .3s ease;
    }
</style>

<section class="leader-hero">
    <div class="relative z-10 w-full">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <nav class="mb-6 text-sm text-slate-300">
                <a href="{{ url('/home') }}" class="transition hover:text-orange-400">Beranda</a>
                <span class="mx-2">/</span>
                <span class="font-semibold text-orange-400">Pimpinan Universitas</span>
            </nav>

            <h1 class="leader-hero-title">
                Pimpinan Universitas<br>
                <span>Fort De Kock</span>
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-lg leading-relaxed text-slate-200">
                Tokoh-tokoh yang memimpin arah pengembangan Universitas Fort De Kock dengan dedikasi, visi akademik, dan komitmen membangun masa depan pendidikan.
            </p>
        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-slate-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        @php
            $universityLeaders = $pimpinan->where('group', 'university')->values();
            $rector = $universityLeaders->first(fn ($leader) => strtolower($leader->position) === 'rektor');
            $viceRectors = $universityLeaders->reject(fn ($leader) => strtolower($leader->position) === 'rektor')->values();
            $facultyLeaders = $pimpinan->where('group', 'faculty')->values();
        @endphp

        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-aos="fade-up">
            <div>
                <p class="text-sm font-extrabold uppercase tracking-[0.22em] text-orange-600">Pimpinan Universitas</p>
                <h2 class="mt-3 text-3xl font-extrabold text-slate-900 md:text-4xl">Rektor dan Wakil Rektor</h2>
            </div>
        </div>

        @if($universityLeaders->count())
            @if($rector)
                <article class="leader-card group overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" data-aos="fade-up">
                    <div class="grid lg:grid-cols-[420px_1fr]">
                        <div class="relative overflow-hidden">
                            <img src="{{ $rector->photo_url }}" alt="{{ $rector->name }}" class="h-[460px] w-full object-cover object-top transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 to-transparent p-6">
                                <span class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-4 py-2 text-xs font-extrabold text-white">
                                    <i data-lucide="badge-check" class="h-3.5 w-3.5"></i>
                                    {{ $rector->position }}
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center p-8 md:p-10">
                            <p class="text-sm font-extrabold uppercase tracking-[0.22em] text-orange-600">Pimpinan Utama</p>
                            <h3 class="mt-4 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">{{ $rector->name }}</h3>
                            <p class="mt-5 max-w-3xl text-base leading-relaxed text-slate-600">{{ $rector->summary ?: 'Informasi belum tersedia.' }}</p>
                            <a href="{{ route('pimpinan.show', $rector->slug) }}" class="profile-cta group mt-7">
                                <span>Lihat Profil</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-up-right" aria-hidden="true" class="lucide lucide-arrow-up-right relative z-10 w-5 h-5 transition-all duration-300 group-hover:rotate-45 group-hover:translate-x-1 group-hover:text-white"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endif

            @if($viceRectors->count())
                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    @foreach($viceRectors as $i => $p)
                    <article class="leader-card group overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 90) }}">
                        <div class="relative overflow-hidden">
                            <img src="{{ $p->photo_url }}" alt="{{ $p->name }}" class="h-80 w-full object-cover object-top transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 to-transparent p-5">
                                <span class="inline-flex items-center gap-2 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-extrabold text-white">
                                    <i data-lucide="badge-check" class="h-3.5 w-3.5"></i>
                                    {{ $p->position }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-extrabold leading-snug text-slate-900">{{ $p->name }}</h3>
                            <p class="leader-summary mt-3 text-sm leading-relaxed text-slate-600">{{ $p->summary ?: 'Informasi belum tersedia.' }}</p>
                            <a href="{{ route('pimpinan.show', $p->slug) }}" class="profile-cta group mt-5">
                                <span>Lihat Profil</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-up-right" aria-hidden="true" class="lucide lucide-arrow-up-right relative z-10 w-5 h-5 transition-all duration-300 group-hover:rotate-45 group-hover:translate-x-1 group-hover:text-white"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            @endif
        @else
            <div class="rounded-lg border border-slate-200 bg-white p-10 text-center text-slate-500">
                Data profil pimpinan belum tersedia.
            </div>
        @endif

        <div class="mt-20 mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-aos="fade-up">
            <div>
                <p class="text-sm font-extrabold uppercase tracking-[0.22em] text-orange-600">Dekan Fakultas</p>
                <h2 class="mt-3 text-3xl font-extrabold text-slate-900 md:text-4xl">Pimpinan Fakultas</h2>
            </div>
        </div>

        @if($facultyLeaders->count())
            <div class="grid gap-6 md:grid-cols-2">
                @foreach($facultyLeaders as $i => $p)
                    <article class="leader-card grid overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl md:grid-cols-[180px_1fr]" data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 90) }}">
                        <img src="{{ $p->photo_url }}" alt="{{ $p->name }}" class="h-64 w-full object-cover object-top md:h-full">
                        <div class="p-6">
                            <span class="inline-flex items-center gap-2 rounded-lg bg-orange-100 px-3 py-1.5 text-xs font-extrabold text-orange-700">
                                <i data-lucide="building-2" class="h-3.5 w-3.5"></i>
                                {{ $p->position }}
                            </span>
                            <h3 class="mt-4 text-2xl font-extrabold leading-snug text-slate-900">{{ $p->name }}</h3>
                            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $p->summary }}</p>
                            <a href="{{ route('pimpinan.show', $p->slug) }}" class="profile-cta group mt-5">
                                <span>Lihat Profil</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-up-right" aria-hidden="true" class="lucide lucide-arrow-up-right relative z-10 w-5 h-5 transition-all duration-300 group-hover:rotate-45 group-hover:translate-x-1 group-hover:text-white"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <div class="mt-16 flex justify-center" data-aos="fade-up">
            <a href="{{ url('/struktur') }}" class="profile-cta group">
                <span>Lihat Struktur Organisasi</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-up-right" aria-hidden="true" class="lucide lucide-arrow-up-right relative z-10 w-5 h-5 transition-all duration-300 group-hover:rotate-45 group-hover:translate-x-1 group-hover:text-white"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 700,
            once: true,
            offset: 80
        });
    }
</script>
@endpush
