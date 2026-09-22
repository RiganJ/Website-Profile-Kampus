<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.site-icons')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin UFDK</title>
@php
    $manifestPath = public_path('build/manifest.json');
@endphp

@if(file_exists($manifestPath))
    @php
        $manifest = json_decode(file_get_contents($manifestPath), true);

        $css = $manifest['resources/css/app.css']['file'] ?? null;
        $js  = $manifest['resources/js/app.js']['file'] ?? null;
    @endphp

    @if($css)
        <link rel="stylesheet" href="{{ asset('build/'.$css) }}">
    @endif

    @if($js)
        <script type="module" src="{{ asset('build/'.$js) }}"></script>
    @endif
@else
    @if(file_exists(public_path('css/app.css')))
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

    @if(file_exists(public_path('js/app.js')))
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
@endif
</head>
<body class="min-h-screen bg-[#f6f7f4] text-slate-900 antialiased">
    <main class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,_rgba(15,23,42,0.04)_0%,_rgba(255,255,255,0.75)_42%,_rgba(234,88,12,0.08)_100%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(15,23,42,0.035)_1px,_transparent_1px),linear-gradient(90deg,_rgba(15,23,42,0.035)_1px,_transparent_1px)] bg-[size:42px_42px]"></div>

        <section class="relative mx-auto flex min-h-screen w-full max-w-7xl items-center px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid w-full overflow-hidden rounded-[28px] border border-white/70 bg-white/80 shadow-[0_28px_80px_rgba(15,23,42,0.12)] backdrop-blur lg:min-h-[680px] lg:grid-cols-[1.02fr_0.98fr]">
                <aside class="relative hidden overflow-hidden bg-slate-950 px-10 py-10 text-white lg:flex lg:flex-col lg:justify-between">
                    <div class="absolute inset-0 bg-[linear-gradient(145deg,_rgba(234,88,12,0.18)_0%,_rgba(15,23,42,0)_46%,_rgba(16,185,129,0.10)_100%)]"></div>
                    <div class="absolute inset-x-0 bottom-0 h-52 bg-[linear-gradient(0deg,_rgba(234,88,12,0.28),_transparent)]"></div>

                    <div class="relative">
                        <div class="inline-flex items-center gap-4">
                            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white p-2 shadow-xl shadow-black/20">
                                <img src="{{ asset('images/logoufdk.png') }}" alt="Logo Universitas Fort De Kock" class="h-full w-full object-contain">
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-orange-200">Portal Admin</span>
                                <span class="block text-xl font-bold">Universitas Fort De Kock</span>
                            </span>
                        </div>

                        <div class="mt-16 max-w-xl">
                            <p class="text-sm font-semibold uppercase text-orange-200">Dashboard Internal</p>
                            <h1 class="mt-4 text-5xl font-black leading-[1.05] text-white">
                                Akses pengelolaan data kampus yang lebih tertata.
                            </h1>
                            <p class="mt-6 max-w-lg text-base leading-7 text-slate-300">
                                Masuk untuk mengelola konten, layanan akademik, dan kebutuhan administrasi UFDK melalui area yang aman.
                            </p>
                        </div>
                    </div>

                    <div class="relative grid grid-cols-3 gap-3">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                            <span class="block text-2xl font-black">24/7</span>
                            <span class="mt-1 block text-xs font-medium text-slate-300">Akses sistem</span>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                            <span class="block text-2xl font-black">Admin</span>
                            <span class="mt-1 block text-xs font-medium text-slate-300">Area khusus</span>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                            <span class="block text-2xl font-black">UFDK</span>
                            <span class="mt-1 block text-xs font-medium text-slate-300">Terintegrasi</span>
                        </div>
                    </div>
                </aside>

                <div class="flex items-center justify-center px-5 py-8 sm:px-8 lg:px-12">
                    <div class="w-full max-w-md">
                        <div class="mb-8 flex items-center gap-4 lg:hidden">
                            <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white p-2 shadow-lg shadow-slate-200">
                                <img src="{{ asset('images/logoufdk.png') }}" alt="Logo Universitas Fort De Kock" class="h-full w-full object-contain">
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-orange-700">Portal Admin</p>
                                <p class="text-base font-bold text-slate-950">Universitas Fort De Kock</p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <span class="inline-flex rounded-full border border-orange-200 bg-orange-50 px-3 py-1 text-xs font-bold text-orange-700">
                                Login Administrator
                            </span>
                            <h2 class="mt-5 text-3xl font-black leading-tight text-slate-950 sm:text-4xl">
                                Selamat datang kembali
                            </h2>
                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Gunakan akun admin yang terdaftar untuk melanjutkan ke dashboard.
                            </p>
                        </div>

                        @if(session('status'))
                            <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                            @csrf

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-slate-700">Email</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    placeholder="nama@ufdk.local"
                                    class="h-14 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center justify-between gap-3">
                                    <label for="password" class="text-sm font-bold text-slate-700">Password</label>
                                    <button
                                        type="button"
                                        id="toggle-password"
                                        class="rounded-full px-2 py-1 text-xs font-bold text-orange-700 transition hover:bg-orange-50"
                                    >
                                        Tampilkan
                                    </button>
                                </div>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                    class="h-14 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                                >
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-3">
                                    <label for="captcha" class="text-sm font-bold text-slate-700">Verifikasi Captcha</label>
                                    <button
                                        type="button"
                                        id="refresh-captcha"
                                        class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-700 transition hover:border-orange-300 hover:text-orange-700"
                                    >
                                        Refresh
                                    </button>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-[160px_1fr]">
                                    <div
                                        id="captcha-question"
                                        class="flex min-h-14 items-center justify-center rounded-2xl border border-orange-200 bg-orange-50 px-4 py-3 text-center text-xl font-black text-orange-700"
                                        aria-live="polite"
                                    >
                                        {{ $captchaQuestion }}
                                    </div>

                                    <input
                                        id="captcha"
                                        type="text"
                                        name="captcha"
                                        required
                                        autocomplete="off"
                                        placeholder="Ketik jawaban"
                                        class="h-14 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                                    >
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:items-center sm:justify-between">
                                <label class="inline-flex items-center gap-3 text-sm font-medium text-slate-600">
                                    <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                                    Ingat saya
                                </label>

                                <a href="{{ route('password.request') }}" class="text-sm font-bold text-orange-700 transition hover:text-orange-800">
                                    Lupa password?
                                </a>
                            </div>

                            <button
                                type="submit"
                                class="group flex w-full items-center justify-center rounded-2xl bg-slate-950 px-6 py-4 text-sm font-black text-white shadow-xl shadow-slate-300 transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-100"
                            >
                                Masuk ke Dashboard
                            </button>
                        </form>

                        <p class="mt-8 text-center text-xs font-medium text-slate-400">
                            &copy; {{ date('Y') }} Universitas Fort De Kock. Area ini hanya untuk pengguna berwenang.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const refreshButton = document.getElementById('refresh-captcha');
        const captchaQuestion = document.getElementById('captcha-question');
        const togglePasswordButton = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        refreshButton.addEventListener('click', async function () {
            refreshButton.disabled = true;
            refreshButton.textContent = 'Memuat';

            try {
                const response = await fetch('{{ route('captcha.refresh') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                captchaQuestion.textContent = data.question;
            } finally {
                refreshButton.disabled = false;
                refreshButton.textContent = 'Refresh';
            }
        });

        togglePasswordButton.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            togglePasswordButton.textContent = isPassword ? 'Sembunyikan' : 'Tampilkan';
        });
    </script>
</body>
</html>
