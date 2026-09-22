@extends('layouts.main')

@section('title', 'Logo & Makna - Universitas Fort De Kock')

@push('head')
<style>
    .logo-page-hero {
        position: relative;
        height: 520px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: url('{{ asset('images/banner-sambutan.jpg') }}') center / cover no-repeat;
    }

    .logo-page-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(10, 10, 10, .85) 0%, rgba(10, 10, 10, .55) 45%, rgba(10, 10, 10, .25) 100%);
    }

    .logo-hero-glow {
        position: absolute;
        top: -120px;
        right: -120px;
        width: 420px;
        height: 420px;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(249, 115, 22, .55), transparent 70%);
        filter: blur(80px);
    }

    .logo-hero-title {
        color: #fff;
        font-size: 48px;
        font-weight: 800;
        line-height: 1.2;
    }

    .logo-hero-title span {
        background: linear-gradient(90deg, #fb923c, #f97316);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .logo-hero-scroll {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
    }

    .logo-hero-scroll span {
        position: relative;
        display: block;
        width: 26px;
        height: 40px;
        border: 2px solid #fff;
        border-radius: 20px;
    }

    .logo-hero-scroll span::after {
        content: "";
        position: absolute;
        top: 8px;
        left: 50%;
        width: 4px;
        height: 8px;
        border-radius: 4px;
        background: #fff;
        transform: translateX(-50%);
        animation: logoHeroScroll 2s infinite;
    }

    @keyframes logoHeroScroll {
        0% { opacity: 0; transform: translate(-50%, 0); }
        50% { opacity: 1; }
        100% { opacity: 0; transform: translate(-50%, 10px); }
    }

    .meaning-image {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 24px;
        box-shadow: 0 28px 65px -38px rgba(15, 23, 42, .48);
    }

    .download-logo {
        display: flex;
        min-height: 390px;
        align-items: center;
        justify-content: center;
        padding: 28px;
        border-bottom: 1px solid #e2e8f0;
        background:
            linear-gradient(45deg, #f8fafc 25%, transparent 25%),
            linear-gradient(-45deg, #f8fafc 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, #f8fafc 75%),
            linear-gradient(-45deg, transparent 75%, #f8fafc 75%);
        background-size: 24px 24px;
        background-position: 0 0, 0 12px, 12px -12px, -12px 0;
    }

    .download-logo img {
        max-width: 100%;
        max-height: 330px;
        object-fit: contain;
    }

    .download-item {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 20px 50px -38px rgba(15, 23, 42, .45);
    }

    @media (max-width: 640px) {
        .logo-page-hero { height: 480px; }
        .logo-hero-title { font-size: 38px; }
        .meaning-image,
        .download-item { border-radius: 18px; }
        .download-logo { min-height: 300px; padding: 20px; }
        .download-logo img { max-height: 260px; }
    }
</style>
@endpush

@section('content')
<section class="logo-page-hero">
    <div class="logo-hero-glow" aria-hidden="true"></div>
    <div class="relative z-[2] mx-auto w-full max-w-7xl px-5 pb-10 pt-24 text-center sm:px-6">
        <div class="mb-5 text-sm text-slate-300" data-aos="fade-down">
            <a href="{{ route('home') }}" class="transition hover:text-orange-400">Beranda</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-orange-400">Logo &amp; Makna</span>
        </div>
        <h1 class="logo-hero-title" data-aos="fade-up">
            Logo &amp; <span>Makna</span>
        </h1>
        <p class="mx-auto mt-[18px] max-w-[760px] text-base leading-[1.7] text-gray-200 sm:text-lg" data-aos="fade-up" data-aos-delay="100">
            Filosofi dan identitas resmi Universitas Fort De Kock Bukittinggi.
        </p>
        <div class="mx-auto mt-[30px] h-1 w-20 rounded-full bg-orange-500"></div>
    </div>
    <div class="logo-hero-scroll" aria-hidden="true"><span></span></div>
</section>

<section class="bg-slate-50 px-4 py-14 sm:px-6 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 text-center" data-aos="fade-up">
            <p class="text-xs font-bold uppercase tracking-[.2em] text-slate-500">Filosofi Identitas</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Makna Lambang Universitas Fort De Kock</h2>
        </div>

        <img
            src="{{ asset('images/makna-logo-ufdk.webp') }}"
            alt="Infografik makna lambang Universitas Fort De Kock"
            class="meaning-image"
            data-aos="fade-up"
            data-aos-delay="100"
        >
    </div>
</section>

<section class="px-4 py-14 sm:px-6 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="mx-auto mb-10 max-w-3xl text-center" data-aos="fade-up">
            <p class="text-xs font-bold uppercase tracking-[.2em] text-slate-500">Aset Resmi</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Unduh Logo UFDK</h2>
            <p class="mt-4 leading-7 text-slate-600">Pilih format logo yang sesuai dengan kebutuhan publikasi Anda.</p>
        </div>

        <div class="grid gap-7 md:grid-cols-2">
            <article class="download-item" data-aos="fade-up">
                <div class="download-logo">
                    <img src="{{ asset('images/logo-ufdk-vertikal.webp') }}" alt="Logo vertikal Universitas Fort De Kock">
                </div>
                <div class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Logo Vertikal</h3>
                        <p class="mt-1 text-sm text-slate-500">Format WEBP · latar transparan</p>
                    </div>
                    <a href="{{ asset('images/logo-ufdk-vertikal.webp') }}" download="Logo-UFDK-Vertikal.webp" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                        <i data-lucide="download" class="h-4 w-4"></i>
                        Download
                    </a>
                </div>
            </article>

            <article class="download-item" data-aos="fade-up" data-aos-delay="100">
                <div class="download-logo">
                    <img src="{{ asset('images/logo-ufdk-horizontal.png') }}" alt="Logo horizontal Universitas Fort De Kock">
                </div>
                <div class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Logo Horizontal</h3>
                        <p class="mt-1 text-sm text-slate-500">Format PNG · latar transparan</p>
                    </div>
                    <a href="{{ asset('images/logo-ufdk-horizontal.png') }}" download="Logo-UFDK-Horizontal.png" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                        <i data-lucide="download" class="h-4 w-4"></i>
                        Download
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
