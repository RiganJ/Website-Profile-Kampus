@extends('layouts.main')

@section('title', $profile->name . ' - Profil Pimpinan')

@section('content')
<style>
    .leader-hero {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: linear-gradient(120deg, rgba(15, 23, 42, .94), rgba(15, 23, 42, .68)), url('/images/sejarah1.jpg') center/cover no-repeat;
    }

    .leader-hero::after {
        content: "";
        position: absolute;
        right: -140px;
        top: -140px;
        width: 420px;
        height: 420px;
        border-radius: 999px;
        background: rgba(249, 115, 22, .45);
        filter: blur(80px);
    }

    .profile-shell {
        margin-top: -90px;
        position: relative;
        z-index: 5;
    }

    .profile-card {
        border: 1px solid rgba(226, 232, 240, .95);
        border-radius: 18px;
        background: rgba(255, 255, 255, .96);
        box-shadow: 0 24px 70px rgba(15, 23, 42, .12);
        overflow: hidden;
    }

    .leader-photo {
        aspect-ratio: 4 / 5;
        width: 100%;
        object-fit: cover;
        object-position: top center;
        background: #f8fafc;
    }

    .academic-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 44px;
        border-radius: 999px;
        padding: 10px 16px;
        background: #0f172a;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        transition: .25s ease;
    }

    .academic-link:hover {
        background: #ea580c;
        color: #fff;
        transform: translateY(-2px);
    }

    .profile-content {
        color: #475569;
        line-height: 1.75;
    }

    .profile-content .profile-block {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #fff;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 14px 42px rgba(15, 23, 42, .05);
    }

    .profile-content h2 {
        margin: 0 0 18px;
        color: #0f172a;
        font-size: 24px;
        font-weight: 800;
    }

    .profile-content h2::after {
        content: "";
        display: block;
        width: 56px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: #f97316;
    }

    .profile-content .identity-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .profile-content .identity-grid div {
        border-radius: 12px;
        background: #f8fafc;
        padding: 14px 16px;
        border: 1px solid #e2e8f0;
    }

    .profile-content .identity-grid span {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .profile-content .identity-grid strong {
        color: #0f172a;
    }

    .profile-content table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 12px;
    }

    .profile-content th,
    .profile-content td {
        border: 1px solid #e2e8f0;
        padding: 12px 14px;
        vertical-align: top;
    }

    .profile-content th {
        background: #0f172a;
        color: #fff;
        font-weight: 800;
    }

    .profile-content ul {
        display: grid;
        gap: 12px;
        padding-left: 20px;
    }

    .profile-content .publication-block {
        background:
            linear-gradient(180deg, rgba(255, 247, 237, .92), rgba(255, 255, 255, .98));
        border-color: #fed7aa;
    }

    .profile-content .publication-list,
    .profile-content .publication-block ul {
        list-style: none;
        padding-left: 0;
        gap: 14px;
    }

    .profile-content .publication-list li,
    .profile-content .publication-block ul li {
        position: relative;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #f97316;
        border-radius: 14px;
        background: #fff;
        padding: 16px 18px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .06);
    }

    .profile-content .publication-title,
    .profile-content .publication-block ul:not(.publication-list) li {
        color: #0f172a;
        font-size: 16px;
        line-height: 1.65;
    }

    .profile-content .publication-title strong,
    .profile-content .publication-block ul:not(.publication-list) li em {
        font-weight: 800;
    }

    .profile-content .publication-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .profile-content .publication-meta,
    .profile-content .publication-note {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 800;
    }

    .profile-content .publication-meta {
        background: #0f172a;
        color: #fff;
    }

    .profile-content .publication-note {
        background: #ffedd5;
        color: #9a3412;
    }

    @media (max-width: 768px) {
        .leader-hero { min-height: 460px; }
        .profile-shell { margin-top: -60px; }
        .profile-content .identity-grid { grid-template-columns: 1fr; }
        .profile-content .profile-block { padding: 20px; }
        .profile-content table { display: block; overflow-x: auto; }
    }
</style>

<section class="leader-hero">
    <div class="relative z-10 w-full">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="text-sm text-slate-300 mb-6">
                <a href="{{ url('/') }}" class="hover:text-orange-400">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('pimpinan.index') }}" class="hover:text-orange-400">Pimpinan Universitas</a>
                <span class="mx-2">/</span>
                <span class="text-orange-400">{{ $profile->position }}</span>
            </nav>

            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-orange-500 px-4 py-2 text-sm font-bold text-white">
                    <i data-lucide="user-round-check" class="w-4 h-4"></i>
                    {{ $profile->position }}
                </span>
                <h1 class="mt-5 text-4xl md:text-6xl font-extrabold leading-tight text-white">
                    {{ $profile->name }}
                </h1>
                @if($profile->summary)
                    <p class="mt-5 max-w-2xl text-lg leading-relaxed text-slate-200">
                        {{ $profile->summary }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-50 pb-20">
    <div class="profile-shell max-w-7xl mx-auto px-6">
        <div class="profile-card">
            <div class="grid lg:grid-cols-[360px_1fr]">
                <aside class="bg-white border-r border-slate-200">
                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->name }}" class="leader-photo">
                    <div class="p-7">
                        <h2 class="text-2xl font-extrabold text-slate-900">{{ $profile->name }}</h2>
                        <p class="mt-2 font-semibold text-orange-600">{{ $profile->position }}</p>

                        <div class="mt-6 grid gap-3 text-sm text-slate-600">
                            @if($profile->email)
                                <a href="mailto:{{ $profile->email }}" class="flex items-center gap-3 hover:text-orange-600">
                                    <i data-lucide="mail" class="w-4 h-4"></i>
                                    {{ $profile->email }}
                                </a>
                            @endif
                            @if($profile->phone)
                                <a href="tel:{{ $profile->phone }}" class="flex items-center gap-3 hover:text-orange-600">
                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                    {{ $profile->phone }}
                                </a>
                            @endif
                        </div>

                        @if(count($profile->academic_link_items))
                            <div class="mt-7">
                                <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-500">Tautan Profil Akademik</h3>
                                <div class="mt-4 flex flex-wrap gap-3">
                                    @foreach($profile->academic_link_items as $link)
                                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener" class="academic-link">
                                            <i data-lucide="{{ $link['icon'] }}" class="w-4 h-4"></i>
                                            {{ $link['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </aside>

                <main class="p-6 md:p-10">
                    <div class="profile-content">
                        {!! $profile->content_html ?: '<section class="profile-block"><h2>Profil</h2><p>Informasi profil belum tersedia.</p></section>' !!}
                    </div>
                </main>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.profile-content .profile-block').forEach(function (section) {
        const heading = section.querySelector('h2');

        if (heading && heading.textContent.toLowerCase().includes('publikasi')) {
            section.classList.add('publication-block');
        }
    });
});
</script>
@endsection
