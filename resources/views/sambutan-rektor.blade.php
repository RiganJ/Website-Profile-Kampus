@extends('layouts.main')

@section('title', 'Sambutan Rektor - Universitas Fort De Kock')

@push('head')
<!-- Bootstrap Icons + AOS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
@endpush

@section('content')

<style>
.hero-modern{
position:relative;
height:520px;
display:flex;
align-items:center;
background:url('/images/banner-sambutan.jpg') center/cover no-repeat;
overflow:hidden;
}

/* dark overlay */
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

/* glow accent */
.hero-glow{
position:absolute;
top:-120px;
right:-120px;
width:420px;
height:420px;
background:radial-gradient(circle,
rgba(249,115,22,.55),
transparent 70%);
filter:blur(80px);
}

/* breadcrumb */
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

/* title */
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

/* subtitle */
.hero-subtitle{
margin-top:18px;
max-width:720px;
margin-left:auto;
margin-right:auto;
font-size:18px;
color:#e5e7eb;
line-height:1.7;
}

/* accent line */
.hero-line{
width:80px;
height:4px;
background:#fb923c;
margin:30px auto 0;
border-radius:20px;
}

/* scroll indicator */
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

.rektor-message-card{
position:relative;
margin-top:22px;
padding:34px 30px 26px;
border-radius:28px;
background:
linear-gradient(145deg, rgba(255,255,255,.98) 0%, rgba(248,250,252,.96) 52%, rgba(255,255,255,.98) 100%);
border:1px solid rgba(226,232,240,.95);
box-shadow:
0 24px 42px -24px rgba(15,23,42,.35),
0 10px 18px -14px rgba(15,23,42,.25);
overflow:hidden;
}

.rektor-photo-wrap{
position:relative;
padding:14px;
border-radius:30px;
background:linear-gradient(145deg,#ffffff,#f8fafc);
border:1px solid rgba(226,232,240,.9);
box-shadow:0 24px 40px -24px rgba(15,23,42,.35);
overflow:hidden;
}

.rektor-photo-wrap::before{
content:"";
position:absolute;
inset:0;
background:
radial-gradient(circle at top left, rgba(249,115,22,.2), transparent 45%),
radial-gradient(circle at bottom right, rgba(37,99,235,.12), transparent 45%);
pointer-events:none;
}

.rektor-photo-core{
position:relative;
border-radius:24px;
overflow:hidden;
background:#fff;
z-index:1;
}

.rektor-photo-core img{
width:100%;
display:block;
object-fit:cover;
}

.rektor-photo-core::after{
content:"";
position:absolute;
inset:0;
background:linear-gradient(180deg, rgba(15,23,42,0) 45%, rgba(15,23,42,.24) 100%);
pointer-events:none;
}

.rektor-photo-chip{
position:absolute;
left:20px;
right:20px;
bottom:20px;
z-index:3;
display:flex;
align-items:center;
justify-content:space-between;
gap:10px;
padding:12px 14px;
border-radius:16px;
background:rgba(255,255,255,.92);
backdrop-filter:blur(8px);
border:1px solid rgba(255,255,255,.95);
box-shadow:0 10px 18px -14px rgba(15,23,42,.4);
}

.rektor-photo-chip p{
margin:0;
line-height:1.25;
}

.rektor-photo-chip .name{
font-size:14px;
font-weight:700;
color:#0f172a;
}

.rektor-photo-chip .role{
font-size:12px;
color:#64748b;
}

.rektor-photo-chip i{
font-size:18px;
color:#f97316;
}

.rektor-message-card::before{
content:"";
position:absolute;
inset:0;
background:
radial-gradient(circle at top right, rgba(249,115,22,.12) 0%, transparent 42%),
radial-gradient(circle at bottom left, rgba(37,99,235,.08) 0%, transparent 38%);
pointer-events:none;
}

.rektor-message-card::after{
content:"";
position:absolute;
left:0;
right:0;
top:0;
height:4px;
background:linear-gradient(90deg,#f97316,#fb923c,#fdba74);
}

.message-quote-badge{
position:absolute;
top:20px;
right:22px;
width:46px;
height:46px;
border-radius:50%;
display:grid;
place-items:center;
color:#f97316;
background:rgba(255,255,255,.95);
border:1px solid rgba(251,146,60,.28);
box-shadow:0 8px 16px -12px rgba(249,115,22,.55);
font-size:20px;
}

.rektor-message-title{
display:inline-flex;
align-items:center;
gap:10px;
font-size:13px;
font-weight:700;
letter-spacing:.12em;
text-transform:uppercase;
color:#475569;
margin-bottom:16px;
}

.rektor-message-title span{
width:34px;
height:2px;
background:#f97316;
}

.rektor-message-body{
position:relative;
z-index:1;
line-height:1.9;
color:#334155;
font-size:16px;
text-align:justify;
display:grid;
gap:16px;
}

.rektor-message-sign{
margin-top:22px;
padding-top:18px;
border-top:1px dashed rgba(148,163,184,.6);
display:flex;
flex-direction:column;
gap:4px;
}

.rektor-message-sign strong{
font-size:16px;
color:#0f172a;
}

.rektor-message-sign small{
font-size:13px;
color:#64748b;
}

@media (max-width:768px){
.rektor-photo-wrap{
padding:10px;
border-radius:24px;
}

.rektor-photo-core{
border-radius:18px;
}

.rektor-photo-chip{
left:12px;
right:12px;
bottom:12px;
padding:10px 12px;
}

.rektor-photo-chip .name{
font-size:13px;
}

.rektor-message-card{
padding:28px 20px 22px;
border-radius:22px;
}

.message-quote-badge{
top:16px;
right:16px;
width:40px;
height:40px;
font-size:17px;
}

.rektor-message-body{
font-size:15px;
line-height:1.8;
}
}
</style>


<!-- HERO SAMBUTAN REKTOR -->
<section class="hero-modern flex items-center">

<div class="hero-overlay"></div>
<div class="hero-glow"></div>

<div class="relative z-10 w-full">
<div class="max-w-7xl mx-auto px-6 text-center">

<!-- Breadcrumb -->
<nav class="hero-breadcrumb">
<a href="{{ url('/') }}">Beranda</a>
<span>/</span>
<a href="{{ url('/sambutan-rektor') }}" class="active">Sambutan Rektor</a>
</nav>

<!-- Title -->
<h1 class="hero-title">
Sambutan Rektor<br>
<span>Universitas Fort De Kock</span>
</h1>

<!-- Subtitle -->
<p class="hero-subtitle">
Pesan dan sambutan dari pimpinan Universitas Fort De Kock
sebagai refleksi visi, komitmen, dan arah pengembangan
institusi dalam mencetak generasi unggul dan berdaya saing global.
</p>

<div class="hero-line"></div>

</div>
</div>

<!-- Scroll Indicator -->
<div class="scroll-indicator">
<span></span>
</div>

</section>
<!-- CONTENT -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

      <!-- FOTO REKTOR -->
      <div data-aos="fade-right">
        <div class="rektor-photo-wrap">
          <div class="rektor-photo-core">
            <img
              src="{{ asset('images/rektor.png') }}"
              alt="Rektor Universitas Fort De Kock"
              class="foto-rektor"
            >
            <div class="rektor-photo-chip">
              <p>
                <span class="name">Prof. Dr. Hj. Evi Hasnita, S.Pd., Ns., M.Kes.</span><br>
                <span class="role">Rektor Universitas Fort De Kock</span>
              </p>
              <i class="bi bi-award"></i>
            </div>
          </div>
        </div>
      </div>

    <!-- SAMBUTAN -->
<div class="lg:col-span-2" data-aos="fade-left">

  <!-- Jabatan -->
  <p class="text-sm font-semibold mb-2 flex items-center gap-2" style="color:#0f172a;">
    <span style="color:#ea580c;">//</span>
    Rektor Universitas Fort De Kock
  </p>

  <!-- Nama -->
  <h2 class="text-3xl font-bold" style="color:#0f172a;">
    <span style="color:#e96f0c;">
      Prof. Dr. Hj. Evi Hasnita
    </span>, S.Pd., Ns., M.Kes.
  </h2>



      <div class="rektor-message-card">
  <div class="message-quote-badge">
    <i class="bi bi-quote"></i>
  </div>

  <p class="rektor-message-title">
    <span></span>
    Pesan Rektor
  </p>

  <div class="rektor-message-body">
  <p>
    Universitas Fort De Kock terus mengembangkan diri sebagai institusi
    pendidikan tinggi yang berkomitmen terhadap mutu, inovasi, dan
    pengabdian kepada masyarakat.
  </p>

  <p>
    Seiring dengan perkembangan zaman dan tuntutan global, Universitas
    Fort De Kock hadir sebagai jawaban atas kebutuhan sumber daya manusia
    yang unggul, berdaya saing, serta memiliki karakter dan etika
    akademik yang kuat.
  </p>

  <p>
    Kehadiran Universitas Fort De Kock di Kota Bukittinggi diharapkan
    mampu mengembalikan marwah kota ini sebagai
    <strong>“Kota Pendidikan”</strong>, sekaligus mendukung visi dan misi
    pembangunan daerah dalam bidang pendidikan, kesehatan, dan
    peningkatan ekonomi.
  </p>

  <p>
    Saat ini, Universitas Fort De Kock telah menjalin kerja sama dengan
    berbagai mitra, baik di tingkat nasional maupun internasional,
    dalam pelaksanaan Tri Dharma Perguruan Tinggi.
  </p>

  <p>
    Dengan dukungan seluruh sivitas akademika, kami optimis Universitas
    Fort De Kock akan terus tumbuh dan memberikan kontribusi nyata bagi
    bangsa dan negara.
  </p>

  <div class="rektor-message-sign">
    <strong>Prof. Dr. Hj. Evi Hasnita, S.Pd., Ns., M.Kes.</strong>
    <small>Rektor Universitas Fort De Kock</small>
  </div>
</div>
</div>


    </div>
  </div>
</div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 700,
    once: true
  });
</script>
@endpush
