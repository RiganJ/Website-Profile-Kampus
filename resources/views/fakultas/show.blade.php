@extends('layouts.main')

@section('title', $faculty['name'] . ' | Universitas Fort De Kock')

@section('content')
<section class="relative flex min-h-[560px] items-end overflow-hidden pt-24" style="background: {{ $faculty['hero_background'] }};">
    <img
        src="{{ asset($faculty['hero_image']) }}"
        alt="{{ $faculty['name'] }}"
        class="absolute inset-0 h-full w-full object-cover"
        style="object-position: {{ $faculty['hero_position'] }}; transform: {{ $faculty['hero_transform'] }};"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/75 to-slate-900/35"></div>
    <div class="absolute inset-0 opacity-20" style="background: radial-gradient(circle at 78% 20%, {{ $faculty['accent'] }}, transparent 35%);"></div>

    <div class="relative z-10 mx-auto w-full max-w-7xl px-6 pb-16 md:pb-20">
        <nav class="mb-7 flex flex-wrap items-center gap-2 text-sm text-white/70">
            <a href="{{ route('home') }}" class="transition hover:text-white">Beranda</a>
            <span>/</span>
            <a href="{{ route('prodi.index') }}" class="transition hover:text-white">Fakultas</a>
            <span>/</span>
            <span class="font-semibold text-white">{{ $faculty['short_name'] }}</span>
        </nav>

        <span class="inline-flex rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[.22em] text-white backdrop-blur">
            {{ $faculty['eyebrow'] }}
        </span>
        <h1 class="mt-6 max-w-5xl text-4xl font-black leading-tight text-white md:text-6xl">
            {{ $faculty['name'] }}
        </h1>
        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-200 md:text-lg">
            {{ $faculty['description'] }}
        </p>
    </div>
</section>

<main class="bg-slate-50">
    <section class="mx-auto max-w-7xl px-6 py-20">
        <div class="grid items-center gap-12 overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 md:p-10 lg:grid-cols-[.8fr_1.2fr]">
            <div class="relative mx-auto w-full max-w-sm">
                <div class="absolute -inset-4 rounded-[2rem] opacity-20 blur-2xl" style="background: {{ $faculty['accent'] }};"></div>
                <div class="relative overflow-hidden rounded-[1.75rem]" style="background: {{ $faculty['accent_soft'] }};">
                    @if($dean['photo_url'])
                        <img
                            src="{{ $dean['photo_url'] }}"
                            alt="{{ $dean['name'] }}"
                            class="aspect-[4/5] w-full object-cover object-top"
                        >
                    @else
                        <div class="grid aspect-[4/5] w-full place-items-center text-center font-bold text-slate-500">
                            Foto dekan belum tersedia
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <span class="text-sm font-extrabold uppercase tracking-[.24em]" style="color: {{ $faculty['accent'] }};">Sambutan Dekan</span>
                <h2 class="mt-3 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                    Selamat Datang di {{ $faculty['short_name'] }}
                </h2>
                <div class="mt-6 h-1 w-20 rounded-full" style="background: {{ $faculty['accent'] }};"></div>
                <p class="mt-7 text-base leading-8 text-slate-600">{{ $faculty['welcome'] }}</p>
                <p class="mt-6 text-base leading-8 text-slate-600">{{ $dean['summary'] }}</p>

                <div class="mt-8 border-l-4 pl-5" style="border-color: {{ $faculty['accent'] }};">
                    <p class="text-lg font-extrabold text-slate-900">{{ $dean['name'] }}</p>
                    <p class="mt-1 text-sm text-slate-500">{{ $dean['position'] }}</p>
                </div>

                <a
                    href="{{ $dean['profile_url'] }}"
                    class="group relative mt-8 inline-flex h-14 min-w-52 items-center justify-between gap-5 overflow-hidden rounded-full bg-slate-100 px-6 text-slate-800"
                >
                    <span class="absolute inset-0 origin-left scale-x-0 transition-transform duration-500 ease-out group-hover:scale-x-100" style="background: {{ $faculty['accent'] }};"></span>
                    <span class="relative z-10 text-sm font-medium transition-colors duration-300 group-hover:text-white">Lihat Profil Dekan</span>
                    <i data-lucide="arrow-up-right" class="relative z-10 h-5 w-5 transition-all duration-300 group-hover:translate-x-1 group-hover:rotate-45 group-hover:text-white"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-20">
            <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <span class="text-sm font-extrabold uppercase tracking-[.24em]" style="color: {{ $faculty['accent'] }};">Program Akademik</span>
                    <h2 class="mt-3 text-3xl font-black text-slate-900 md:text-4xl">Program Studi {{ $faculty['short_name'] }}</h2>
                    <p class="mt-4 max-w-2xl leading-7 text-slate-600">Pilih program studi untuk melihat profil, visi dan misi, kurikulum, pimpinan, serta informasi akademiknya.</p>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full px-4 py-2 text-sm font-bold" style="background: {{ $faculty['accent_soft'] }}; color: {{ $faculty['accent_dark'] }};">
                    <i data-lucide="graduation-cap" class="h-4 w-4"></i>
                    {{ count($faculty['programs']) }} Program Studi
                </span>
            </div>

            <div class="mt-12 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($faculty['programs'] as $program)
                    <a href="{{ route($program['route']) }}" class="group overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ asset($program['image']) }}" alt="{{ $program['name'] }}" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/10 to-transparent"></div>
                            <span class="absolute bottom-4 left-4 rounded-full bg-white/90 px-3 py-1 text-xs font-extrabold backdrop-blur" style="color: {{ $faculty['accent_dark'] }};">
                                {{ $program['level'] }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between gap-4 p-5">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[.18em] text-slate-400">Program Studi</p>
                                <h3 class="mt-2 text-lg font-extrabold text-slate-900 transition" style="--faculty-accent: {{ $faculty['accent'] }};">{{ $program['name'] }}</h3>
                            </div>
                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full transition duration-300 group-hover:translate-x-1" style="background: {{ $faculty['accent_soft'] }}; color: {{ $faculty['accent_dark'] }};">
                                <i data-lucide="arrow-right" class="h-4 w-4"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
