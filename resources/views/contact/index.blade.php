@extends('layouts.main')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @php
        $contactItems = [
        
            [
                'icon' => 'telephone-fill',
                'label' => 'Telepon Kampus',
                'value' => '0811-6607-100',
            ],
            [
                'icon' => 'envelope-fill',
                'label' => 'Email Resmi',
                'value' => 'info@ufdk.ac.id',
            ],
            [
                'icon' => 'geo-alt-fill',
                'label' => 'Lokasi Kampus',
                'value' => 'Bukittinggi, Sumatera Barat',
            ],
        ];

        $serviceHours = [
            [
                'icon' => 'calendar-week',
                'label' => 'Senin - Jumat',
                'value' => '08:00 - 16:00 WIB',
                'valueClass' => 'text-gray-300',
            ],
            [
                'icon' => 'calendar',
                'label' => 'Sabtu',
                'value' => '08:00 - 15:00 WIB',
                'valueClass' => 'text-gray-300',
            ],
            [
                'icon' => 'calendar-x',
                'label' => 'Minggu',
                'value' => 'Tutup',
                'valueClass' => 'text-[#e96f0c] font-semibold',
            ],
        ];
    @endphp

    <style>
        /* HERO */
        .hero-modern {
            position: relative;
            height: 500px;
            display: flex;
            align-items: center;
            background: url("{{ asset('images/bannerkontak.png') }}") center / cover no-repeat;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                120deg,
                rgba(10, 10, 10, 0.85) 0%,
                rgba(10, 10, 10, 0.55) 45%,
                rgba(10, 10, 10, 0.25) 100%
            );
        }

        .hero-glow {
            position: absolute;
            top: -120px;
            right: -120px;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.55), transparent 70%);
            filter: blur(80px);
        }

        .hero-breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
            color: #cbd5e1;
        }

        .hero-breadcrumb a:hover {
            color: #fb923c;
        }

        .hero-title {
            font-size: 46px;
            font-weight: 800;
            line-height: 1.2;
            color: white;
        }

        .hero-title span {
            background: linear-gradient(90deg, #fb923c, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-modern .hero-title span::after {
            display: none;
        }

        .hero-subtitle {
            max-width: 640px;
            margin-top: 16px;
            margin-right: auto;
            margin-left: auto;
            font-size: 18px;
            line-height: 1.6;
            color: #e5e7eb;
        }

        .hero-line {
            width: 70px;
            height: 4px;
            margin: 26px auto 0;
            background: #fb923c;
            border-radius: 20px;
        }

        .contact-fade-up {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .75s ease, transform .75s cubic-bezier(.2, .9, .2, 1);
            transition-delay: var(--delay, 0ms);
        }

        .contact-fade-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <section class="hero-modern">
        <div class="hero-overlay"></div>
        <div class="hero-glow"></div>

        <div class="relative z-10 w-full">
            <div class="mx-auto max-w-6xl px-6 text-center">
                <nav class="hero-breadcrumb contact-fade-up">
                    <a href="{{ route('home', [], false) }}">Beranda</a>
                    <span>/</span>
                    <span class="font-semibold text-orange-400">Kontak</span>
                </nav>

                <h1 class="hero-title contact-fade-up" style="--delay: 120ms">
                    Hubungi Kami<br>
                    <span>Universitas Fort De Kock</span>
                </h1>

                <p class="hero-subtitle contact-fade-up" style="--delay: 220ms">
                    Silakan hubungi kami untuk informasi program studi,
                    layanan akademik, kerja sama institusi,
                    atau kebutuhan lainnya.
                </p>

                <div class="hero-line contact-fade-up" style="--delay: 320ms"></div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 pt-10 pb-14">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-6 lg:grid-cols-2">
            <div class="contact-fade-up relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0f172a] to-[#1e293b] p-12 text-white shadow-xl">
                <div class="absolute -top-16 -right-16 h-64 w-64 rounded-full bg-orange-400/20 blur-3xl"></div>

                <div class="relative z-10">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs tracking-widest uppercase">
                        <i class="bi bi-headset"></i>
                        Contact Center UFDK
                    </div>

                    <h2 class="mb-6 text-4xl font-bold leading-tight">
                        Butuh Bantuan?<br>
                        <span class="text-orange-400">Kami Siap Membantu Anda</span>
                    </h2>

                    <p class="mb-10 leading-relaxed text-slate-300">
                        Hubungi tim Universitas Fort De Kock untuk informasi akademik,
                        pendaftaran mahasiswa baru, layanan administrasi,
                        dan kerja sama institusi.
                    </p>

                    <div class="space-y-4">
                        @foreach ($contactItems as $item)
                            <div class="contact-fade-up flex items-center gap-4" style="--delay: {{ $loop->iteration * 90 }}ms">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500">
                                    <i class="bi bi-{{ $item['icon'] }}"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-300">{{ $item['label'] }}</p>
                                    <p class="font-semibold">{{ $item['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="contact-fade-up relative" style="--delay: 140ms">
                <div class="absolute inset-0 -rotate-1 rounded-3xl bg-gradient-to-r from-[#0f172a] to-[#1e293b]"></div>

                <div class="relative rounded-3xl bg-white/90 p-12 shadow-2xl backdrop-blur-lg">
                    <h3 class="mb-8 flex items-center gap-3 text-3xl font-bold text-[#0f172a]">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#e96f0c] text-white">
                            <i class="bi bi-send-fill"></i>
                        </div>
                        Kirim Pesan Kepada Kami
                    </h3>

                    <form id="formContact" class="grid gap-6 md:grid-cols-2" novalidate>
                        @csrf

                        <div class="relative">
                            <i class="bi bi-person absolute top-4 left-4 text-gray-400"></i>
                            <input
                                type="text"
                                name="name"
                                placeholder="Nama Lengkap"
                                class="w-full rounded-xl border border-gray-200 py-4 pr-4 pl-12 outline-none focus:ring-2 focus:ring-[#e96f0c]"
                            >
                        </div>

                        <div class="relative">
                            <i class="bi bi-envelope absolute top-4 left-4 text-gray-400"></i>
                            <input
                                type="email"
                                name="email"
                                placeholder="Email Aktif"
                                class="w-full rounded-xl border border-gray-200 py-4 pr-4 pl-12 outline-none focus:ring-2 focus:ring-[#e96f0c]"
                            >
                        </div>

                        <div class="relative md:col-span-2">
                            <i class="bi bi-pencil absolute top-4 left-4 text-gray-400"></i>
                            <input
                                type="text"
                                name="subject"
                                placeholder="Subjek Pesan"
                                class="w-full rounded-xl border border-gray-200 py-4 pr-4 pl-12 outline-none focus:ring-2 focus:ring-[#e96f0c]"
                            >
                        </div>

                        <div class="relative md:col-span-2">
                            <i class="bi bi-chat-left-text absolute top-4 left-4 text-gray-400"></i>
                            <textarea
                                name="message"
                                rows="5"
                                placeholder="Tulis pesan Anda di sini..."
                                class="w-full rounded-xl border border-gray-200 py-4 pr-4 pl-12 outline-none focus:ring-2 focus:ring-[#e96f0c]"
                            ></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <button
                                type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#0f172a] py-4 font-semibold text-white transition hover:bg-[#e96f0c]"
                            >
                                <i class="bi bi-send"></i>
                                Kirim Pesan Sekarang
                            </button>
                        </div>

                        <div id="msgSubmit" class="text-sm text-gray-500 md:col-span-2"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#0f172a] to-[#020617] pt-14 pb-6">
        <div class="mx-auto max-w-6xl px-6">
            <div class="contact-fade-up mb-12 text-center">
                <h2 class="mb-2 text-4xl font-bold text-white">Jam Layanan & Lokasi Kampus</h2>
                <div class="mx-auto h-1 w-20 rounded-full bg-[#e96f0c]"></div>
            </div>

            <div class="grid items-start gap-10 lg:grid-cols-5">
                <div class="space-y-5 lg:col-span-2">
<div class="contact-fade-up flex items-center gap-4 rounded-2xl
    {{ $isOpen ? 'bg-[#e96f0c]' : 'bg-red-600' }}
    px-6 py-5 text-white shadow-lg">

    <i class="bi {{ $isOpen ? 'bi-broadcast' : 'bi-x-circle-fill' }} text-2xl"></i>

    <div>
        <p class="text-sm opacity-80">Status Hari Ini</p>
        <p class="text-lg font-semibold">
            {{ $isOpen ? 'Kampus Sedang Buka' : 'Kampus Sedang Tutup' }}
        </p>
    </div>
</div>
                    <div class="space-y-4">
                        @foreach ($serviceHours as $hour)
                            <div class="contact-fade-up flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-5 py-4" style="--delay: {{ $loop->iteration * 90 }}ms">
                                <div class="flex items-center gap-3 text-white">
                                    <i class="bi bi-{{ $hour['icon'] }} text-[#e96f0c]"></i>
                                    {{ $hour['label'] }}
                                </div>
                                <span class="{{ $hour['valueClass'] }}">{{ $hour['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="contact-fade-up lg:col-span-3" style="--delay: 160ms">
                    <div class="overflow-hidden rounded-3xl shadow-xl">
                        <iframe
                            src="https://maps.google.com/maps?q=universitas%20fort%20de%20kock&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            class="h-[360px] w-full border-0"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const revealItems = document.querySelectorAll('.contact-fade-up');

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            revealItems.forEach((item) => revealObserver.observe(item));
        });

        const contactForm = document.getElementById('formContact');
        const submitMessage = document.getElementById('msgSubmit');

        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            submitMessage.innerHTML = '<span class="text-slate-500">Mengirim pesan...</span>';

            try {
                const response = await fetch("{{ route('contact.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        name: this.name.value.trim(),
                        email: this.email.value.trim(),
                        subject: this.subject.value.trim(),
                        message: this.message.value.trim(),
                    }),
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        const messages = Object.values(data.errors).flat().join('<br>');
                        submitMessage.innerHTML = `<span class="text-red-600">${messages}</span>`;
                        return;
                    }

                    throw new Error(data.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }

                submitMessage.innerHTML = '';
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pesan Berhasil Terkirim',
                        text: 'Pesan Anda berhasil terkirim. Silakan pantau email Anda untuk melihat balasan dari tim kami.',
                        confirmButtonColor: '#e96f0c',
                    });
                } else {
                    submitMessage.innerHTML = '<span class="text-green-600">Pesan Anda berhasil terkirim. Silakan pantau email Anda untuk melihat balasan dari tim kami.</span>';
                }
                this.reset();
            } catch (error) {
                submitMessage.innerHTML = `<span class="text-red-600">${error.message || 'Terjadi kesalahan. Silakan coba lagi.'}</span>`;
            }
        });
    </script>
@endsection
