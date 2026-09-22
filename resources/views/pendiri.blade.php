@extends('layouts.main')

@section('title', 'Pendiri - Universitas Fort De Kock')

@push('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
.hero-modern{
position:relative;
height:520px;
display:flex;
align-items:center;
background:url('/images/banner-sambutan.jpg') center/cover no-repeat;
overflow:hidden;
}

.hero-overlay{
position:absolute;
inset:0;
background:linear-gradient(
120deg,
rgba(10,10,10,.85) 0%,
rgba(10,10,10,.55) 45%,
rgba(10,10,10,.25) 100%
);
}

.hero-glow{
position:absolute;
top:-120px;
right:-120px;
width:420px;
height:420px;
background:radial-gradient(circle, rgba(249,115,22,.55), transparent 70%);
filter:blur(80px);
}

.hero-breadcrumb{
color:#cbd5e1;
font-size:14px;
margin-bottom:22px;
}

.hero-breadcrumb a{
transition:.3s;
}

.hero-breadcrumb a:hover{
color:#fb923c;
}

.hero-breadcrumb .active{
color:#fb923c;
font-weight:600;
}

.hero-title{
font-size:48px;
font-weight:800;
color:white;
line-height:1.2;
}

.hero-title span{
background:linear-gradient(90deg,#fb923c,#f97316);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.hero-subtitle{
margin-top:18px;
max-width:760px;
margin-left:auto;
margin-right:auto;
font-size:18px;
color:#e5e7eb;
line-height:1.7;
}

.hero-line{
width:80px;
height:4px;
background:#fb923c;
margin:30px auto 0;
border-radius:20px;
}

.scroll-indicator{
position:absolute;
bottom:30px;
left:50%;
transform:translateX(-50%);
}

.scroll-indicator span{
display:block;
width:26px;
height:40px;
border:2px solid white;
border-radius:20px;
position:relative;
}

.scroll-indicator span::after{
content:'';
position:absolute;
top:8px;
left:50%;
width:4px;
height:8px;
background:white;
border-radius:4px;
transform:translateX(-50%);
animation:scroll 2s infinite;
}

@keyframes scroll{
0%{opacity:0;transform:translate(-50%,0);}
50%{opacity:1;}
100%{opacity:0;transform:translate(-50%,10px);}
}

.pendiri-intro{
position:relative;
margin-top:-72px;
z-index:5;
}

.intro-shell{
position:relative;
overflow:hidden;
border-radius:32px;
background:
linear-gradient(135deg, rgba(255,255,255,.98), rgba(248,250,252,.94)),
linear-gradient(135deg, rgba(249,115,22,.08), rgba(37,99,235,.06));
border:1px solid rgba(226,232,240,.95);
box-shadow:0 30px 60px -36px rgba(15,23,42,.45);
}

.intro-shell::before{
content:"";
position:absolute;
inset:-20% auto auto -10%;
width:280px;
height:280px;
background:radial-gradient(circle, rgba(249,115,22,.16), transparent 65%);
pointer-events:none;
}

.intro-shell::after{
content:"";
position:absolute;
right:-80px;
bottom:-80px;
width:240px;
height:240px;
background:radial-gradient(circle, rgba(37,99,235,.10), transparent 70%);
pointer-events:none;
}

.intro-badge{
display:inline-flex;
align-items:center;
gap:10px;
padding:10px 16px;
border-radius:999px;
background:rgba(249,115,22,.10);
color:#c2410c;
font-size:13px;
font-weight:700;
letter-spacing:.08em;
text-transform:uppercase;
}

.intro-badge i{
font-size:14px;
}

.intro-lead{
font-size:18px;
line-height:1.85;
color:#334155;
}

.intro-highlight{
display:grid;
grid-template-columns:repeat(3, minmax(0, 1fr));
gap:16px;
}

.intro-chip{
padding:18px 18px 16px;
border-radius:22px;
background:rgba(255,255,255,.78);
border:1px solid rgba(226,232,240,.85);
box-shadow:0 18px 40px -32px rgba(15,23,42,.35);
}

.intro-chip small{
display:block;
margin-top:6px;
font-size:13px;
line-height:1.6;
color:#64748b;
}

.intro-chip strong{
font-size:24px;
line-height:1;
color:#0f172a;
}

.section-kicker{
display:inline-flex;
align-items:center;
gap:10px;
font-size:13px;
font-weight:700;
letter-spacing:.12em;
text-transform:uppercase;
color:#475569;
}

.section-kicker span{
width:34px;
height:2px;
background:#f97316;
}

.section-heading{
font-size:38px;
line-height:1.15;
font-weight:800;
color:#0f172a;
}

.section-copy{
font-size:17px;
line-height:1.85;
color:#475569;
max-width:780px;
}

.pendiri-slider-wrap{
position:relative;
padding:0 70px 46px;
}

.founder-card{
position:relative;
height:100%;
overflow:hidden;
border-radius:28px;
background:linear-gradient(180deg, rgba(255,255,255,.98), rgba(248,250,252,.96));
border:1px solid rgba(226,232,240,.95);
box-shadow:0 28px 50px -36px rgba(15,23,42,.45);
transition:transform .45s ease, box-shadow .45s ease;
}

.swiper-slide-active .founder-card,
.founder-card:hover{
transform:translateY(-8px);
box-shadow:0 36px 60px -34px rgba(15,23,42,.48);
}

.founder-card::before{
content:"";
position:absolute;
inset:0;
background:
linear-gradient(180deg, rgba(249,115,22,.08), transparent 28%),
radial-gradient(circle at top right, rgba(37,99,235,.10), transparent 30%);
pointer-events:none;
}

.founder-media{
position:relative;
padding:18px 18px 0;
}

.founder-media img{
width:100%;
height:420px;
object-fit:cover;
display:block;
border-radius:24px;
}

.founder-order{
position:absolute;
top:32px;
left:32px;
display:inline-flex;
align-items:center;
justify-content:center;
width:52px;
height:52px;
border-radius:50%;
background:rgba(15,23,42,.82);
color:#fff;
font-size:14px;
font-weight:700;
backdrop-filter:blur(8px);
}

.founder-content{
position:relative;
padding:24px 24px 26px;
}

.founder-role{
display:inline-flex;
align-items:center;
gap:8px;
padding:8px 12px;
border-radius:999px;
background:rgba(249,115,22,.10);
color:#c2410c;
font-size:12px;
font-weight:700;
letter-spacing:.08em;
text-transform:uppercase;
}

.founder-name{
margin-top:14px;
font-size:24px;
line-height:1.3;
font-weight:800;
color:#0f172a;
}

.founder-desc{
margin-top:10px;
font-size:15px;
line-height:1.8;
color:#64748b;
}

.swiper-button-next,
.swiper-button-prev{
color:#f97316;
width:48px;
height:48px;
border-radius:999px;
background:rgba(255,255,255,.95);
box-shadow:0 14px 28px -18px rgba(15,23,42,.45);
}

.swiper-button-next::after,
.swiper-button-prev::after{
font-size:18px;
font-weight:800;
}

.swiper-pagination-bullet{
background:#cbd5e1;
opacity:1;
}

.swiper-pagination-bullet-active{
background:#f97316;
}

.pendiri-grid{
display:grid;
grid-template-columns:repeat(4, minmax(0, 1fr));
gap:22px;
}

.pendiri-grid-card{
position:relative;
overflow:hidden;
border-radius:24px;
background:#fff;
border:1px solid rgba(226,232,240,.9);
box-shadow:0 24px 48px -34px rgba(15,23,42,.45);
transition:transform .35s ease, box-shadow .35s ease;
}

.pendiri-grid-card:hover{
transform:translateY(-8px);
box-shadow:0 30px 52px -30px rgba(15,23,42,.5);
}

.pendiri-grid-card img{
width:100%;
height:280px;
object-fit:cover;
display:block;
transition:transform .6s ease;
}

.pendiri-grid-card:hover img{
transform:scale(1.06);
}

.pendiri-grid-card .body{
padding:18px 18px 20px;
}

.pendiri-grid-card h3{
font-size:18px;
line-height:1.45;
font-weight:800;
color:#0f172a;
}

.pendiri-grid-card p{
margin-top:8px;
font-size:14px;
line-height:1.75;
color:#64748b;
}

@media (max-width: 1024px){
.intro-highlight{
grid-template-columns:1fr;
}

.pendiri-slider-wrap{
padding:0 0 46px;
}

.pendiri-grid{
grid-template-columns:repeat(2, minmax(0, 1fr));
}
}

@media (max-width: 768px){
.hero-modern{
height:500px;
}

.hero-title{
font-size:34px;
}

.hero-subtitle{
font-size:16px;
}

.pendiri-intro{
margin-top:-40px;
}

.intro-shell{
border-radius:26px;
}

.section-heading{
font-size:30px;
}

.founder-media img{
height:320px;
}

.pendiri-grid{
grid-template-columns:1fr;
}

.swiper-button-next,
.swiper-button-prev{
display:none;
}
}
.founders-showcase{position:relative;overflow:hidden;border-radius:30px;background:#fff;border:1px solid rgba(226,232,240,.95);box-shadow:0 24px 60px -40px rgba(15,23,42,.35)}
.founders-showcase::before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 8% 5%,rgba(249,115,22,.13),transparent 25%),radial-gradient(circle at 94% 20%,rgba(37,99,235,.09),transparent 27%);pointer-events:none}
.founders-gallery{position:relative;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:24px}
.founder-portrait{position:relative;display:flex;min-width:0;flex-direction:column;overflow:hidden;border-radius:22px;background:#fff;border:1px solid #e2e8f0;box-shadow:0 14px 34px -25px rgba(15,23,42,.45);transition:transform .35s ease,border-color .35s ease,box-shadow .35s ease}
.founder-portrait:nth-child(n){grid-column:auto;grid-row:auto}
.founder-portrait:hover{transform:translateY(-5px);border-color:#fed7aa;box-shadow:0 24px 44px -28px rgba(15,23,42,.48)}
.founder-portrait img{width:100%;aspect-ratio:4/5;object-fit:cover;object-position:center top;background:#f1f5f9;transition:transform .55s ease}
.founder-portrait::after{display:none}
.founder-portrait:hover img{transform:scale(1.025)}
.founder-number{position:absolute;z-index:2;top:14px;right:14px;display:flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:12px;background:rgba(255,255,255,.92);color:#c2410c;font-size:11px;font-weight:800;border:1px solid rgba(255,255,255,.8);box-shadow:0 8px 20px rgba(15,23,42,.12);backdrop-filter:blur(10px)}
.founder-caption{position:relative;display:flex;min-height:128px;flex-direction:column;justify-content:center;padding:20px 18px 22px;color:#0f172a;border-top:3px solid #f97316;background:#fff}
.founder-caption p{order:2;margin:8px 0 0;color:#c2410c;font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase}
.founder-caption h3{order:1;font-size:18px;line-height:1.45;font-weight:800;text-shadow:none}
@media(max-width:1024px){.founders-gallery{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:640px){.founders-showcase{border-radius:24px}.founders-gallery{grid-template-columns:1fr;gap:18px}.founder-portrait{max-width:420px;width:100%;margin:0 auto}.founder-caption{min-height:112px}}
</style>
@endpush

@section('content')
<section class="hero-modern flex items-center">
  <div class="hero-overlay"></div>
  <div class="hero-glow"></div>

  <div class="relative z-10 w-full">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <nav class="hero-breadcrumb">
        <a href="{{ url('/') }}">Beranda</a>
        <span>/</span>
        <a href="{{ url('/pendiri') }}" class="active">Pendiri</a>
      </nav>

      <h1 class="hero-title">
        Para Pendiri<br>
        <span>Universitas Fort De Kock</span>
      </h1>

      <p class="hero-subtitle">
        Tokoh-tokoh visioner yang meletakkan fondasi nilai, arah, dan semangat
        pengabdian Universitas Fort De Kock sebagai institusi pendidikan yang terus tumbuh.
      </p>

      <div class="hero-line"></div>
    </div>
  </div>

  <div class="scroll-indicator">
    <span></span>
  </div>
</section>

<section class="py-16 md:py-20 bg-slate-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="founders-showcase px-5 py-8 md:px-10 md:py-12" data-aos="fade-up">
      <div class="relative grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-8 lg:items-end mb-10 md:mb-12">
        <div>
          <div class="intro-badge"><i class="bi bi-stars"></i> Warisan Nilai dan Visi</div>
          <h2 class="mt-5 max-w-4xl text-3xl md:text-5xl font-black text-slate-900 leading-tight">
            Menghormati para perintis yang membangun
            <span class="text-orange-500">fondasi Universitas Fort De Kock</span>
          </h2>
          <p class="intro-lead mt-5 max-w-4xl">
            Universitas Fort De Kock bertumbuh dari visi, keberanian, dan pengabdian para
            pendirinya. Komitmen mereka terhadap pendidikan bermutu menjadi landasan bagi
            pengembangan institusi, pelayanan kepada masyarakat, serta lahirnya generasi
            profesional yang berintegritas.
          </p>
        </div>
        <div class="flex lg:flex-col items-center lg:items-start gap-3 rounded-2xl border border-orange-100 bg-orange-50/80 px-6 py-5">
          <strong class="text-4xl font-black text-orange-600">{{ count($pendiri) }}</strong>
          <span class="max-w-[190px] text-sm font-semibold leading-6 text-slate-600">
            tokoh dalam sejarah pendirian Universitas Fort De Kock
          </span>
        </div>
      </div>

      <div class="founders-gallery">
        @foreach($pendiri as $index => $p)
        <article class="founder-portrait" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 70 }}">
          <img src="{{ asset('images/' . $p['img']) }}" alt="Potret {{ $p['nama'] }}">
          <span class="founder-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
          <div class="founder-caption">
            <p>{{ $p['jabatan'] }}</p>
            <h3>{{ $p['nama'] }}</h3>
          </div>
        </article>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  if (window.AOS) {
    AOS.init({
      duration: 800,
      once: true,
      offset: 80
    });
  }
});
</script>
@endpush
