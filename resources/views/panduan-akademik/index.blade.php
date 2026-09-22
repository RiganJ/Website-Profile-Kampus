@extends('layouts.main')

@section('title', 'Pusat Informasi')

@section('content')
    <section class="relative flex h-[520px] items-center overflow-hidden bg-[url('/images/bannerkontak.png')] bg-cover bg-center">
        <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(10,10,10,0.88)_0%,rgba(10,10,10,0.58)_45%,rgba(10,10,10,0.24)_100%)]"></div>
        <div class="absolute -top-24 -right-24 h-80 w-80 rounded-full bg-orange-500/30 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-40 w-full bg-gradient-to-t from-slate-950/70 to-transparent"></div>

        <div class="relative z-10 mx-auto w-full max-w-6xl px-6 text-center" data-aos="fade-up">
            <nav class="mb-5 text-sm text-slate-300">
                <a href="{{ url('/') }}" class="transition hover:text-orange-300">Beranda</a>
                <span class="px-2">/</span>
                <span class="font-semibold text-orange-400">Pusat Informasi</span>
            </nav>

            <div class="mx-auto inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-orange-200 backdrop-blur-md">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                Pusat Informasi
            </div>

            <h1 class="mt-6 text-4xl font-black leading-tight text-white md:text-5xl lg:text-6xl">
                Pusat
                <span class="bg-gradient-to-r from-orange-300 to-orange-500 bg-clip-text text-transparent">Informasi</span>
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-base leading-7 text-slate-200 md:text-lg">
                Kumpulan dokumen resmi Universitas Fort De Kock untuk panduan akademik,
                panduan aplikasi, serta kebutuhan form yudisium dan wisuda.
            </p>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.28em] text-orange-500">Daftar Dokumen</span>
                    <h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                        Informasi dan dokumen yang tersedia
                    </h2>
                </div>

                <p class="max-w-xl text-sm leading-7 text-slate-600 md:text-base">
                    Setiap dokumen dikelompokkan berdasarkan kategori agar lebih mudah dicari,
                    dibuka, dan diunduh sesuai kebutuhan.
                </p>
            </div>

            <div class="space-y-14">
                @foreach ($guideSections as $section)
                    <section data-aos="fade-up">
                        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <div>
                                <span class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-500">Pusat Informasi</span>
                                <h3 class="mt-2 text-2xl font-black text-slate-900 md:text-3xl">{{ $section['label'] }}</h3>
                            </div>

                            <span class="inline-flex w-max rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm ring-1 ring-slate-200">
                                {{ $section['guides']->count() }} Dokumen
                            </span>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-2">
                            @forelse ($section['guides'] as $guide)
                                <article class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-[0_18px_70px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-[0_24px_80px_rgba(15,23,42,0.12)]" data-aos="{{ $loop->odd ? 'fade-right' : 'fade-left' }}" data-aos-delay="{{ 80 + (($loop->index % 4) * 70) }}">
                                    <div class="grid min-h-[360px] md:grid-cols-[0.92fr_1.08fr]">
                                        <div class="relative bg-gradient-to-br from-[#0f172a] to-[#1d2b40] p-6 text-white">
                                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 text-2xl">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            </div>

                                            <h4 class="mt-6 text-2xl font-black leading-tight">
                                                {{ $guide->judul }}
                                            </h4>

                                            @if ($guide->deskripsi)
                                                <p class="mt-4 text-sm leading-7 text-slate-300">
                                                    {{ $guide->deskripsi }}
                                                </p>
                                            @endif

                                            <p class="mt-5 text-xs font-semibold uppercase tracking-[0.22em] text-orange-200">
                                                {{ $guide->published_at ? $guide->published_at->translatedFormat('d M Y') : $guide->kategori_label }}
                                            </p>

                                            <div class="mt-7 flex flex-wrap gap-3">
                                                <a href="{{ $guide->file_url }}" target="_blank" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-orange-100">
                                                    <i class="bi bi-eye-fill"></i>
                                                    Lihat PDF
                                                </a>
                                                <a href="{{ $guide->download_url }}" class="inline-flex items-center gap-2 rounded-full bg-orange-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-600">
                                                    <i class="bi bi-download"></i>
                                                    Download
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bg-slate-100 p-4">
                                            <iframe
                                                src="{{ $guide->file_url }}#toolbar=0&navpanes=0"
                                                title="{{ $guide->judul }}"
                                                class="h-full min-h-[330px] w-full rounded-2xl border border-slate-200 bg-white"
                                            ></iframe>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="rounded-[30px] border border-dashed border-slate-300 bg-white px-6 py-12 text-center text-slate-500">
                                    Data untuk kategori ini belum tersedia.
                                </div>
                            @endforelse
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </section>
@endsection
