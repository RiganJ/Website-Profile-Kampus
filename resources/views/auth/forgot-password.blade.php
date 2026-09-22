<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.site-icons')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password Admin UFDK</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Vite manifest not found; use compiled assets if present --}}
        @if (file_exists(public_path('css/app.css')))
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif
        @if (file_exists(public_path('js/app.js')))
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
    @endif
</head>
<body class="min-h-screen bg-stone-100 text-slate-900">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(234,88,12,0.14),_transparent_30%),linear-gradient(180deg,_#fffaf5_0%,_#f5f5f4_100%)]"></div>
        <div class="relative w-full max-w-md rounded-[30px] border border-orange-100 bg-white p-6 shadow-[0_25px_70px_rgba(15,23,42,0.08)] sm:p-8">
            <div class="mb-8 text-center">
                <div class="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-[#ea580c] text-lg font-black text-white shadow-lg shadow-orange-200">
                    UFDK
                </div>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-950">Lupa Password</h1>
                <p class="mt-2 text-sm text-slate-500">
                    Kirim permintaan reset password ke super admin.
                </p>
            </div>

            @if($errors->any())
                <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="nama@ufdk.local"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition focus:border-[#ea580c] focus:ring-4 focus:ring-orange-100"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full rounded-2xl bg-[#ea580c] px-6 py-4 text-sm font-bold uppercase tracking-[0.16em] text-white transition hover:bg-orange-700"
                >
                    Kirim Permintaan
                </button>

                <a href="{{ route('login') }}" class="block text-center text-sm font-semibold text-[#ea580c] hover:text-orange-700">
                    Kembali ke login
                </a>
            </form>
        </div>
    </div>
</body>
</html>
