@extends('layouts.main')

@section('content')
<main class="bg-[#fffaf5]">
<style>
.article-hero{
position:relative;
overflow:hidden;
background:
radial-gradient(circle at top right, rgba(249,115,22,.18), transparent 30%),
linear-gradient(135deg, #0f172a 0%, #1e293b 55%, #334155 100%);
}
.article-hero::after{
content:"";
position:absolute;
inset:0;
background:linear-gradient(180deg, rgba(15,23,42,.25), rgba(15,23,42,.65));
pointer-events:none;
}
.article-shell{
position:relative;
z-index:1;
}
.article-card{
background:#fff;
border:1px solid rgba(226,232,240,.9);
box-shadow:0 24px 50px rgba(15,23,42,.08);
}
.article-body{
font-size:1rem;
line-height:1.9;
color:#334155;
}
.article-body h1,
.article-body h2,
.article-body h3,
.article-body h4{
color:#0f172a;
font-weight:700;
line-height:1.3;
margin-top:1.75rem;
margin-bottom:.85rem;
}
.article-body p{
margin-bottom:1.15rem;
text-align:justify;
}
.article-body ul,
.article-body ol{
margin-bottom:1rem;
padding-left:1.25rem;
}
.article-body img{
max-width:100%;
height:auto;
border-radius:18px;
margin:1.25rem 0;
}
.article-body blockquote{
border-left:4px solid #f97316;
padding-left:1rem;
color:#475569;
font-style:italic;
margin:1.5rem 0;
}
.related-card{
transition:transform .22s ease, box-shadow .22s ease;
}
.related-card:hover{
transform:translateY(-4px);
box-shadow:0 18px 35px rgba(15,23,42,.08);
}
.article-gallery{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:1rem;
}
.article-gallery img{
width:100%;
height:180px;
object-fit:cover;
border-radius:18px;
}
.download-card{
display:flex;
align-items:center;
justify-content:space-between;
gap:1rem;
border:1px solid #fed7aa;
background:#fff7ed;
border-radius:18px;
padding:1rem;
transition:transform .2s ease, box-shadow .2s ease;
}
.download-card:hover{
transform:translateY(-2px);
box-shadow:0 12px 28px rgba(249,115,22,.12);
}
</style>

<section class="article-hero text-white">
    <div class="article-shell max-w-6xl mx-auto px-6 py-16 md:py-24">
        <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-sm text-orange-200 hover:text-white transition">
            <span>&larr;</span>
            <span>Kembali ke Berita</span>
        </a>

        <div class="mt-6 max-w-4xl">
            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[3px] text-orange-100 backdrop-blur">
                {{ \App\Models\Berita::KATEGORI_OPTIONS[$berita->kategori] ?? $berita->kategori }}
            </span>

            <h1 class="mt-5 text-4xl md:text-6xl font-black leading-tight">
                {{ $berita->judul }}
            </h1>

            <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-slate-200">
                <span>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
                <span class="h-1.5 w-1.5 rounded-full bg-orange-300"></span>
                <span>Artikel Universitas Fort De Kock</span>
            </div>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-10 md:py-14">
    <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px] items-start">
        <article class="article-card rounded-[28px] overflow-hidden">
            <img
                src="{{ $berita->thumbnail_url }}"
                alt="{{ $berita->judul }}"
                class="w-full h-[260px] md:h-[430px] object-cover"
            >

            <div class="px-6 py-8 md:px-10 md:py-10">
                <div class="flex flex-wrap items-center gap-3 text-sm">
                    <span class="rounded-full bg-orange-100 px-4 py-2 font-semibold text-orange-700">
                        {{ \App\Models\Berita::KATEGORI_OPTIONS[$berita->kategori] ?? $berita->kategori }}
                    </span>
                    <span class="text-slate-500">{{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}</span>
                </div>

                <div class="article-body mt-8">
                    @php
                        $content = trim((string) $berita->konten);
                        $hasHtml = $content !== strip_tags($content);
                        $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><blockquote><h2><h3><h4><a><img>';
                    @endphp

                    @if($content === '')
                        <p>Konten berita belum tersedia.</p>
                    @elseif($hasHtml)
                        {!! strip_tags($content, $allowedTags) !!}
                    @else
                        @foreach(preg_split("/\r\n\r\n|\n\n|\r\r/", $content) as $paragraph)
                            @if(trim($paragraph) !== '')
                                <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                            @endif
                        @endforeach
                    @endif
                </div>

                @if(!empty($berita->gallery_images))
                    <div class="mt-10 border-t border-slate-200 pt-8">
                        <h2 class="text-2xl font-bold text-slate-900">Galeri Foto</h2>
                        <div class="article-gallery mt-5">
                            @foreach($berita->gallery_images as $image)
                                <a href="{{ asset($image['path']) }}" target="_blank" rel="noopener">
                                    <img src="{{ asset($image['path']) }}" alt="{{ $image['name'] ?? $berita->judul }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(!empty($berita->attachments))
                    <div class="mt-10 border-t border-slate-200 pt-8">
                        <h2 class="text-2xl font-bold text-slate-900">File Lampiran</h2>
                        <div class="mt-5 space-y-3">
                            @foreach($berita->attachments as $attachment)
                                @php
                                    $size = !empty($attachment['size']) ? number_format($attachment['size'] / 1024, 0) . ' KB' : null;
                                @endphp
                                <a href="{{ asset($attachment['path']) }}"
                                   download
                                   class="download-card">
                                    <span class="min-w-0">
                                        <span class="block truncate font-semibold text-slate-900">
                                            {{ $attachment['name'] ?? basename($attachment['path']) }}
                                        </span>
                                        <span class="mt-1 block text-sm text-slate-500">
                                            {{ strtoupper(pathinfo($attachment['path'], PATHINFO_EXTENSION)) }}{{ $size ? ' - ' . $size : '' }}
                                        </span>
                                    </span>
                                    <span class="shrink-0 rounded-full bg-orange-500 px-4 py-2 text-sm font-semibold text-white">
                                        Download
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>

        <aside class="space-y-6">
            <div class="article-card rounded-[24px] p-6">
                <p class="text-xs font-semibold uppercase tracking-[3px] text-slate-500">Informasi Artikel</p>
                <div class="mt-5 space-y-4 text-sm text-slate-600">
                    <div>
                        <p class="font-semibold text-slate-900">Kategori</p>
                        <p>{{ \App\Models\Berita::KATEGORI_OPTIONS[$berita->kategori] ?? $berita->kategori }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900">Tanggal Publikasi</p>
                        <p>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}</p>
                    </div>
                    @if(!empty($berita->attachments))
                    <div>
                        <p class="font-semibold text-slate-900">Lampiran</p>
                        <p>{{ count($berita->attachments) }} file tersedia</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="article-card rounded-[24px] p-6">
                <p class="text-xs font-semibold uppercase tracking-[3px] text-slate-500">Berita Terkait</p>

                <div class="mt-5 space-y-4">
                    @forelse ($relatedNews as $item)
                        <a href="{{ route('artikel.show', $item->slug) }}" class="related-card block rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex gap-4">
                                <img
                                    src="{{ $item->thumbnail_url }}"
                                    alt="{{ $item->judul }}"
                                    class="h-20 w-20 rounded-2xl object-cover"
                                >
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-[2px] text-orange-600">
                                        {{ \App\Models\Berita::KATEGORI_OPTIONS[$item->kategori] ?? $item->kategori }}
                                    </p>
                                    <h3 class="mt-2 text-sm font-bold leading-6 text-slate-900">
                                        {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                    </h3>
                                    <p class="mt-2 text-xs text-slate-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4 text-sm text-slate-500">
                            Belum ada berita terkait pada kategori yang sama.
                        </div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</section>
</main>
@endsection
