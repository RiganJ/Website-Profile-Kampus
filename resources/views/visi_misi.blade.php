@extends('layouts.main')

@section('title', 'Visi & Misi | Universitas Fort De Kock')

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
background:url('/images/sejarah1.jpg') center/cover no-repeat;
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
}</style>
<!-- HERO VISI MISI -->
<section class="hero-modern flex items-center">

<div class="hero-overlay"></div>
<div class="hero-glow"></div>

<div class="relative z-10 w-full">
<div class="max-w-7xl mx-auto px-6 text-center">

<!-- Breadcrumb -->
<nav class="hero-breadcrumb">
<a href="{{ url('/') }}">Beranda</a>
<span>/</span>
<a href="{{ url('/visimis') }}" class="active">Visi & Misi</a>
</nav>

<!-- Title -->
<h1 class="hero-title">
Visi & Misi<br>
<span>Universitas Fort De Kock</span>
</h1>

<!-- Subtitle -->
<p class="hero-subtitle">
Landasan strategis Universitas Fort De Kock dalam
mengembangkan pendidikan berkualitas,
mencetak lulusan unggul, dan berdaya saing global.
</p>

<div class="hero-line"></div>

</div>
</div>

<!-- Scroll Indicator -->
<div class="scroll-indicator">
<span></span>
</div>

</section>

<section class="py-24 bg-gray-50 overflow-hidden">

<div class="max-w-7xl mx-auto px-6">

<div class="grid md:grid-cols-[0.8fr_1.2fr] items-start gap-8">

    <!-- LEFT -->
    <div class="flex justify-center lg:justify-end"
         data-aos="fade-right"
         data-aos-duration="1200">

        <div class="relative shine-wrapper">
            <img
                src="/images/modelvisii.png"
                class="h-[520px] w-auto object-contain transition duration-700 hover:scale-105"
                alt="Model">
        </div>

    </div>

    <!-- RIGHT -->
    <div class="flex flex-col justify-start h-full">

        <p class="text-sm tracking-widest text-gray-500 font-semibold mb-3"
           data-aos="fade-left"
           data-aos-duration="1200"
           data-aos-delay="100">
            <span class="text-[#e96f0c]">//</span> visi-misi
        </p>

        <h2 class="text-5xl font-bold text-[#e96f0c] mb-6"
            data-aos="fade-left"
            data-aos-duration="1200"
            data-aos-delay="200">
            Visi
        </h2>

        <p class="text-gray-600 mb-8"
           data-aos="fade-left"
           data-aos-duration="1200"
           data-aos-delay="300">
            Universitas Fort De Kock dalam setiap langkahnya berpedoman pada visi berikut:
        </p>

        <div class="flex items-start gap-4"
             data-aos="fade-left"
             data-aos-duration="1200"
             data-aos-delay="400">

            <div class="text-[#e96f0c] text-xl mt-1">
                <i class="fa-solid fa-arrow-right"></i>
            </div>

            <p class="text-lg text-[#0f172a] font-medium leading-relaxed">
                {{ $visi }}
            </p>

        </div>

    </div>

</div>
</div>

</section>
{{-- MISI SECTION --}}
<section class="py-24 bg-[#e96f0c] text-white overflow-hidden">

<div class="max-w-7xl mx-auto px-6">

<div class="grid md:grid-cols-2 gap-16 items-start">

<!-- LEFT CONTENT -->
<div>

<!-- Title -->
<div class="mb-16" data-aos="fade-up">

<p class="text-sm tracking-widest text-white/70 mb-3">
<span>//</span> visi-misi
</p>

<h2 class="text-5xl font-bold">
<span class="text-[#0f172a]">Misi</span> Universitas
</h2>
<div class="w-20 h-1 bg-white/60 mt-4"></div>

</div>


<!-- Timeline -->
<div class="relative">

<!-- vertical line -->
<div class="absolute left-6 top-0 bottom-0 w-[2px] bg-white/30"></div>

@foreach($misi as $index => $item)

<div class="relative flex items-start gap-10 mb-16" data-aos="fade-up">

<!-- number -->
<div class="flex-shrink-0 w-12 h-12 rounded-full bg-white text-[#e96f0c] 
flex items-center justify-center font-bold text-lg shadow-lg z-10">

{{ $index+1 }}

</div>

<!-- content -->
<div>

<h3 class="text-xl font-semibold mb-2">
{{ $item['title'] }}
</h3>

<div class="w-10 h-[2px] bg-white/40"></div>

</div>

</div>

@endforeach

</div>

</div>


<!-- RIGHT IMAGE -->
<div class="relative" data-aos="fade-left">

<div class="shine-container rounded-3xl overflow-hidden shadow-2xl">

<img src="/images/fdk.jpeg"
class="w-full h-[520px] object-cover">

<div class="shine-effect"></div>

</div>

</div>

</div>

</div>

</section>
<section class="py-28 bg-gray-50 overflow-hidden relative">

<!-- decorative background -->
<div class="absolute w-[400px] h-[400px] bg-[#e96f0c]/10 rounded-full blur-3xl -top-20 -left-20"></div>
<div class="absolute w-[350px] h-[350px] bg-[#0f172a]/10 rounded-full blur-3xl bottom-0 right-0"></div>

<div class="max-w-6xl mx-auto px-6 relative">

<!-- Title -->
<div class="text-center mb-24 relative" data-aos="fade-up">

<!-- label -->
<div class="inline-block px-4 py-1 text-sm tracking-widest text-[#e96f0c] bg-orange-50 rounded-full mb-6">
VISI • MISI • TUJUAN
</div>

<!-- title -->
<h2 class="text-5xl md:text-6xl font-bold text-[#0f172a] leading-tight">

Tujuan 
<span class="text-[#e96f0c] relative">

Universitas

<!-- underline accent -->
<span class="absolute left-0 -bottom-2 w-full h-[6px] bg-orange-200 rounded-full -z-10"></span>

</span>

</h2>

<!-- subtitle line -->
<div class="flex justify-center mt-8">

<span class="w-16 h-[3px] bg-[#e96f0c] rounded-full"></span>
<span class="w-3 h-[3px] bg-[#0f172a] rounded-full mx-2"></span>
<span class="w-8 h-[3px] bg-[#e96f0c] rounded-full"></span>

</div>

</div>


<!-- Timeline -->
<div class="relative">

<!-- center line -->
<div class="absolute left-1/2 transform -translate-x-1/2 w-[3px] bg-[#e96f0c]/30 top-0 bottom-0"></div>


<!-- ITEM 1 -->
<div class="mb-20 flex justify-start relative" data-aos="fade-right">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pr-12 text-right">

<div class="timeline-card chat-left relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">01</span>

Menyelenggarakan pendidikan yang menghasilkan sumber daya manusia yang berkualitas, berkarakter, handal, profesional, mandiri dan berjiwa interpreniur sesuai dengan kebutuhan pembangunan.

</div>

</div>

</div>


<!-- ITEM 2 -->
<div class="mb-20 flex justify-end relative" data-aos="fade-left">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pl-12">

<div class="timeline-card chat-right relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">02</span>

Menyelenggarakan penelitian yang menghasilkan produk yang sesuai kebutuhan pembangunan dan meningkatkan publikasi ilmiah.

</div>

</div>

</div>


<!-- ITEM 3 -->
<div class="mb-20 flex justify-start relative" data-aos="fade-right">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pr-12 text-right">

<div class="timeline-card chat-left relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">03</span>

Menyelenggarakan pengabdian masyarakat berdasarkan permasalahan terkini dan berbasis evidence.

</div>

</div>

</div>


<!-- ITEM 4 -->
<div class="mb-20 flex justify-end relative" data-aos="fade-left">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pl-12">

<div class="timeline-card chat-right relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">04</span>

Mewujudkan luaran hasil Tri Dharma Perguruan Tinggi memiliki HAKI/Hak Paten.

</div>

</div>

</div>


<!-- ITEM 5 -->
<div class="mb-20 flex justify-start relative" data-aos="fade-right">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pr-12 text-right">

<div class="timeline-card chat-left relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">05</span>

Mewujudkan program studi yang unggul sesuai dengan visi dan misi program studi.

</div>

</div>

</div>


<!-- ITEM 6 -->
<div class="mb-20 flex justify-end relative" data-aos="fade-left">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pl-12">

<div class="timeline-card chat-right relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">06</span>

Meningkatkan kuantitas dan kualitas penyelenggaraan program studi.

</div>

</div>

</div>


<!-- ITEM 7 -->
<div class="flex justify-start relative" data-aos="fade-right">

<div class="timeline-dot top-6"></div>

<div class="w-1/2 pr-12 text-right">

<div class="timeline-card chat-left relative p-7 rounded-2xl shadow-md inline-block">

<span class="font-bold mr-2 text-white/80 text-lg">07</span>

Menghasilkan kerjasama yang berkualitas dan berkesinambungan antar multidisiplin ilmu baik secara nasional maupun internasional.

</div>

</div>

</div>

</div>

</div>

</section>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 700,
        once: true,
        offset: 100
    });
</script>
@endpush
