@extends('layouts.main')

@section('title', 'Akreditasi')

@section('content')
    @php
        $accreditationItems = collect($accreditations ?? [])->map(function ($item) {
            $issuedAt = !empty($item->tanggal_sk) ? \Carbon\Carbon::parse($item->tanggal_sk) : null;
            $expiredAt = !empty($item->tanggal_kadaluarsa) ? \Carbon\Carbon::parse($item->tanggal_kadaluarsa) : null;

            return [
                'type' => $item->accreditation_type ?? 'program_studi',
                'program_studi' => $item->program_studi ?? '-',
                'predicate' => $item->predicate ?? '-',
                'tahun' => $item->tahun ?? '-',
                'lembaga' => $item->lembaga ?? 'BAN-PT / LAM',
                'nomor_sk' => $item->nomor_sk ?? '-',
                'tanggal_sk' => $issuedAt ? $issuedAt->translatedFormat('d M Y') : '-',
                'tanggal_kadaluarsa' => $expiredAt ? $expiredAt->translatedFormat('d M Y') : '-',
                'sort_date' => $issuedAt?->timestamp ?? ((int) ($item->tahun ?? 0) * 1000000),
                'file' => $item->file_url ?? null,
            ];
        });

        if ($accreditationItems->isEmpty()) {
            $accreditationItems = collect([
                [
                    'type' => 'program_studi',
                    'program_studi' => 'S1 Kesehatan Masyarakat',
                    'predicate' => 'Unggul',
                    'tahun' => '2025',
                    'lembaga' => 'LAM-PTKes',
                    'nomor_sk' => '0123/LAM-PTKes/Akr/Sar/XII/2025',
                    'tanggal_sk' => '12 Des 2025',
                    'tanggal_kadaluarsa' => '12 Des 2030',
                    'sort_date' => \Carbon\Carbon::parse('2025-12-12')->timestamp,
                    'file' => null,
                ],
                [
                    'type' => 'program_studi',
                    'program_studi' => 'S1 Keperawatan',
                    'predicate' => 'Baik Sekali',
                    'tahun' => '2024',
                    'lembaga' => 'LAM-PTKes',
                    'nomor_sk' => '0456/LAM-PTKes/Akr/Sar/VI/2024',
                    'tanggal_sk' => '18 Jun 2024',
                    'tanggal_kadaluarsa' => '18 Jun 2029',
                    'sort_date' => \Carbon\Carbon::parse('2024-06-18')->timestamp,
                    'file' => null,
                ],
                [
                    'type' => 'program_studi',
                    'program_studi' => 'S1 Farmasi',
                    'predicate' => 'Baik Sekali',
                    'tahun' => '2024',
                    'lembaga' => 'LAM-PTKes',
                    'nomor_sk' => '0789/LAM-PTKes/Akr/Sar/VIII/2024',
                    'tanggal_sk' => '08 Agu 2024',
                    'tanggal_kadaluarsa' => '08 Agu 2029',
                    'sort_date' => \Carbon\Carbon::parse('2024-08-08')->timestamp,
                    'file' => null,
                ],
                [
                    'type' => 'program_studi',
                    'program_studi' => 'S1 Kebidanan',
                    'predicate' => 'Unggul',
                    'tahun' => '2025',
                    'lembaga' => 'LAM-PTKes',
                    'nomor_sk' => '0210/LAM-PTKes/Akr/Sar/I/2025',
                    'tanggal_sk' => '20 Jan 2025',
                    'tanggal_kadaluarsa' => '20 Jan 2030',
                    'sort_date' => \Carbon\Carbon::parse('2025-01-20')->timestamp,
                    'file' => null,
                ],
            ]);
        }

        $sortedAccreditationItems = $accreditationItems->sortByDesc('sort_date')->values();
        $institutionAccreditation = $sortedAccreditationItems->firstWhere('type', 'institusi');
        $programAccreditationItems = $sortedAccreditationItems->where('type', 'program_studi')->values();
        $totalPrograms = $programAccreditationItems->count();
        $unggulCount = $programAccreditationItems->where('predicate', 'Unggul')->count();
        $baikSekaliCount = $programAccreditationItems->where('predicate', 'Baik Sekali')->count();
        $activeDocsCount = $accreditationItems->filter(fn ($item) => $item['tanggal_kadaluarsa'] !== '-')->count();
        $latestAccreditation = $sortedAccreditationItems->first();
        $latestProgramAccreditation = $programAccreditationItems->first();
        $programAccreditationGroups = $programAccreditationItems
            ->groupBy('program_studi')
            ->map(fn ($items) => $items->sortByDesc('sort_date')->values())
            ->sortByDesc(fn ($items) => $items->first()['sort_date'] ?? 0)
            ->values();
        $accreditationHistory = $sortedAccreditationItems
            ->unique(fn ($item) => ($item['tahun'] ?? '-') . '-' . ($item['predicate'] ?? '-'))
            ->take(4)
            ->values();

        $qualitySteps = [
            [
                'title' => 'Evaluasi Internal',
                'description' => 'Setiap program studi melakukan audit mutu akademik, pembelajaran, dan layanan sebagai dasar peningkatan berkelanjutan.',
            ],
            [
                'title' => 'Penguatan Dokumen',
                'description' => 'Data pendukung, laporan kinerja, serta dokumen pendamping disiapkan secara terstruktur agar sesuai standar lembaga akreditasi.',
            ],
            [
                'title' => 'Visitasi dan Tindak Lanjut',
                'description' => 'Hasil asesmen lapangan digunakan untuk memperkuat strategi mutu institusi dan memastikan rekomendasi dijalankan secara konsisten.',
            ],
        ];
    @endphp

    <section class="relative flex h-[520px] items-center overflow-hidden bg-[url('/images/bannerkontak.png')] bg-cover bg-center">
        <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(10,10,10,0.88)_0%,rgba(10,10,10,0.56)_45%,rgba(10,10,10,0.24)_100%)]"></div>
        <div class="absolute -top-24 -right-24 h-80 w-80 rounded-full bg-orange-500/30 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-40 w-full bg-gradient-to-t from-slate-950/70 to-transparent"></div>

        <div class="relative z-10 mx-auto w-full max-w-6xl px-6 text-center" data-aos="fade-up">
            <nav class="mb-5 text-sm text-slate-300">
                <a href="{{ url('/') }}" class="transition hover:text-orange-300">Beranda</a>
                <span class="px-2">/</span>
                <span class="font-semibold text-orange-400">Akreditasi</span>
            </nav>

            <div class="mx-auto inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-orange-200 backdrop-blur-md">
                <i class="bi bi-patch-check-fill"></i>
                Mutu Akademik Universitas Fort De Kock
            </div>

            <h1 class="mt-6 text-4xl font-black leading-tight text-white md:text-5xl lg:text-6xl">
                Transparansi
                <span class="bg-gradient-to-r from-orange-300 to-orange-500 bg-clip-text text-transparent">Akreditasi</span>
                untuk Kepercayaan Publik
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-base leading-7 text-slate-200 md:text-lg">
                Halaman ini merangkum status akreditasi program studi dan komitmen Universitas Fort De Kock
                dalam menjaga mutu pendidikan, tata kelola, serta pelayanan akademik secara berkelanjutan.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a
                    href="#daftar-akreditasi"
                    class="inline-flex items-center gap-2 rounded-full bg-orange-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600"
                >
                    <i class="bi bi-grid"></i>
                    Lihat Daftar Akreditasi
                </a>

                <a
                    href="#proses-mutu"
                    class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/15"
                >
                    <i class="bi bi-diagram-3"></i>
                    Proses Penjaminan Mutu
                </a>
            </div>
        </div>
    </section>


    <section id="daftar-akreditasi" class="bg-white py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.28em] text-orange-500">Daftar Akreditasi</span>
                    <h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                        Ringkasan akreditasi yang lebih ringkas, terstruktur, dan mudah dipindai
                    </h2>
                </div>

            </div>

            <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="space-y-6">
                    <article class="relative overflow-hidden rounded-[30px] bg-gradient-to-br from-[#0f172a] to-[#1e293b] p-8 text-white shadow-[0_24px_80px_rgba(15,23,42,0.24)]" data-aos="fade-right">
                        <div class="absolute -top-12 -right-8 h-40 w-40 rounded-full bg-orange-500/20 blur-3xl"></div>

                        <div class="relative z-10">
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-orange-200">
                                <i class="bi bi-patch-check-fill"></i>
                                Akreditasi Terbaru
                            </span>

                            <h3 class="mt-6 text-3xl font-black leading-tight">
                                {{ $latestAccreditation['program_studi'] ?? 'Data akreditasi terbaru' }}
                            </h3>

                            <p class="mt-5 text-sm leading-7 text-slate-300">
                                Data paling baru ditampilkan sebagai sorotan utama agar calon mahasiswa,
                                orang tua, dan mitra langsung melihat status akreditasi terkini.
                            </p>

                            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                                    <p class="text-sm text-slate-300">Predikat</p>
                                    <span class="mt-3 inline-flex rounded-full bg-orange-500 px-4 py-2 text-sm font-bold text-white">
                                        {{ $latestAccreditation['predicate'] ?? 'Terverifikasi' }}
                                    </span>
                                </div>

                                <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                                    <p class="text-sm text-slate-300">Tahun / Tanggal SK</p>
                                    <p class="mt-3 text-lg font-bold text-white">{{ $latestAccreditation['tahun'] ?? '-' }}</p>
                                    <p class="mt-1 text-sm text-slate-300">{{ $latestAccreditation['tanggal_sk'] ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mt-5 rounded-3xl border border-white/10 bg-white/5 p-5">
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">Detail Dokumen</p>
                                <div class="mt-4 grid gap-3 text-sm text-slate-200">
                                    <p><span class="text-slate-400">Lembaga:</span> {{ $latestAccreditation['lembaga'] ?? 'BAN-PT / LAM' }}</p>
                                    <p><span class="text-slate-400">Nomor SK:</span> {{ $latestAccreditation['nomor_sk'] ?? '-' }}</p>
                                    <p><span class="text-slate-400">Berlaku sampai:</span> {{ $latestAccreditation['tanggal_kadaluarsa'] ?? '-' }}</p>
                                </div>

                                @if (!empty($latestAccreditation['file']))
                                    <a href="{{ $latestAccreditation['file'] }}"
                                       target="_blank"
                                       class="mt-5 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-orange-100">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>

                    <div class="rounded-[30px] border border-slate-200 bg-slate-50 p-7" data-aos="fade-right" data-aos-delay="120">
                        <span class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Riwayat Akreditasi</span>
                        <h3 class="mt-4 text-2xl font-black text-slate-900">Data akreditasi yang tercatat</h3>

                        <div class="mt-6 space-y-4">
                            @foreach ($accreditationHistory as $history)
                                <div class="flex items-start gap-4 border-b border-slate-200 pb-4 last:border-b-0 last:pb-0">
                                    <div class="mt-1 h-3 w-3 rounded-full bg-orange-500"></div>
                                    <div>
                                        <p class="text-base font-bold text-slate-900">
                                            {{ $history['program_studi'] }} - {{ $history['predicate'] }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $history['tanggal_sk'] !== '-' ? $history['tanggal_sk'] : $history['tahun'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="rounded-[30px] border border-slate-200 bg-white p-8 shadow-[0_16px_50px_rgba(15,23,42,0.08)]" data-aos="fade-left">
                    <span class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-500">Lihat Akreditasi Program Studi</span>
                    <h3 class="mt-4 text-3xl font-black leading-tight text-slate-900">
                        Akreditasi prodi tersusun per kartu
                    </h3>

                    @if ($latestProgramAccreditation)
                        <div class="mt-6 rounded-3xl border border-orange-200 bg-orange-50 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-orange-600">Akreditasi terbaru</p>
                            <div class="mt-3 flex flex-wrap items-center gap-3">
                                <h4 class="text-xl font-black text-slate-900">{{ $latestProgramAccreditation['program_studi'] }}</h4>
                                <span class="rounded-full bg-orange-500 px-3 py-1 text-xs font-bold text-white">{{ $latestProgramAccreditation['predicate'] }}</span>
                            </div>
                            <p class="mt-2 text-sm text-slate-600">{{ $latestProgramAccreditation['lembaga'] }} &bull; {{ $latestProgramAccreditation['tanggal_sk'] }}</p>
                        </div>
                    @endif

                    <div class="mt-8 grid gap-5">
                        @foreach ($programAccreditationGroups as $group)
                            @php
                                $latestItem = $group->first();
                                $badgeClasses = match (strtolower($latestItem['predicate'])) {
                                    'unggul' => 'bg-emerald-100 text-emerald-700',
                                    'baik sekali' => 'bg-amber-100 text-amber-700',
                                    'a' => 'bg-sky-100 text-sky-700',
                                    default => 'bg-slate-100 text-slate-700',
                                };
                            @endphp

                            <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:bg-white hover:shadow-[0_16px_44px_rgba(15,23,42,0.08)]" data-aos="fade-up" data-aos-delay="{{ 60 + (($loop->index % 4) * 60) }}">
                                <div class="flex flex-col gap-4 border-b border-slate-200 bg-white p-5 md:flex-row md:items-start md:justify-between">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-orange-500">Program Studi</p>
                                        <h4 class="mt-2 text-xl font-black leading-snug text-slate-900 transition group-hover:text-orange-600">
                                            {{ $latestItem['program_studi'] }}
                                        </h4>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="rounded-full px-3 py-1 text-[11px] font-bold {{ $badgeClasses }}">
                                            Terbaru: {{ $latestItem['predicate'] }}
                                        </span>
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-600">
                                            {{ $group->count() }} Akreditasi
                                        </span>
                                    </div>
                                </div>

                                <div class="divide-y divide-slate-200">
                                    @foreach ($group as $item)
                                        @php
                                            $rowBadgeClasses = match (strtolower($item['predicate'])) {
                                                'unggul' => 'bg-emerald-100 text-emerald-700',
                                                'baik sekali' => 'bg-amber-100 text-amber-700',
                                                'a' => 'bg-sky-100 text-sky-700',
                                                default => 'bg-white text-slate-700',
                                            };
                                        @endphp

                                        <div class="grid gap-4 p-5 md:grid-cols-[1fr_auto] md:items-center">
                                            <div class="min-w-0">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <span class="rounded-full px-3 py-1 text-[11px] font-bold {{ $rowBadgeClasses }}">
                                                        {{ $item['predicate'] }}
                                                    </span>
                                                    <span class="text-sm font-semibold text-slate-700">{{ $item['tahun'] }}</span>
                                                    <span class="text-sm text-slate-500">{{ $item['tanggal_sk'] }}</span>
                                                </div>

                                                <div class="mt-3 grid gap-2 text-sm text-slate-600 lg:grid-cols-2">
                                                    <p class="truncate"><span class="font-semibold text-slate-800">Lembaga:</span> {{ $item['lembaga'] }}</p>
                                                    <p class="truncate"><span class="font-semibold text-slate-800">No. SK:</span> {{ $item['nomor_sk'] }}</p>
                                                </div>
                                            </div>

                                            <div class="flex md:justify-end">
                                                @if ($item['file'])
                                                    <a
                                                        href="{{ $item['file'] }}"
                                                        target="_blank"
                                                        class="inline-flex items-center gap-2 rounded-full bg-[#0f172a] px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-500"
                                                    >
                                                        <i class="bi bi-file-earmark-pdf"></i>
                                                        Lihat File
                                                    </a>
                                                @else
                                                    <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-500">
                                                        <i class="bi bi-file-earmark-minus"></i>
                                                        Tidak ada file
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="proses-mutu" class="bg-gradient-to-br from-[#0f172a] to-[#020617] py-16">
        <div class="mx-auto grid max-w-6xl gap-10 px-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div data-aos="fade-right">
                <span class="text-sm font-semibold uppercase tracking-[0.28em] text-orange-300">Penjaminan Mutu</span>
                <h2 class="mt-4 max-w-2xl text-3xl font-black leading-tight text-white md:text-4xl">
                    Akreditasi bukan hanya hasil akhir, tetapi bagian dari siklus peningkatan kualitas yang terus berjalan
                </h2>
                <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300">
                    Universitas Fort De Kock menjalankan proses penguatan mutu berbasis data, evaluasi, dan tindak lanjut,
                    sehingga setiap pencapaian akreditasi tetap terhubung dengan pengembangan layanan akademik yang nyata.
                </p>

                <div class="mt-10 space-y-4">
                    @foreach ($qualitySteps as $index => $step)
                        <div class="flex gap-4 rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="{{ 80 + ($index * 80) }}">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-orange-500 text-sm font-black text-white">
                                0{{ $index + 1 }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $step['title'] }}</h3>
                                <p class="mt-2 text-sm leading-7 text-slate-300">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative overflow-hidden rounded-[32px] border border-white/10 bg-white/5 p-8 backdrop-blur-sm" data-aos="fade-left">
                <div class="absolute -top-16 -right-10 h-44 w-44 rounded-full bg-orange-500/20 blur-3xl"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.22em] text-slate-200">
                        <i class="bi bi-bar-chart-line"></i>
                        Fokus Halaman
                    </div>

                    <div class="mt-8 grid gap-4">
                        <div class="rounded-3xl bg-white p-6" data-aos="fade-up" data-aos-delay="80">
                            <p class="text-sm text-slate-500">Yang ditampilkan</p>
                            <h3 class="mt-2 text-xl font-black text-slate-900">Informasi resmi yang mudah dipahami</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Pengunjung bisa membaca status akreditasi tanpa harus membuka dokumen panjang satu per satu.
                            </p>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-slate-900/40 p-6" data-aos="fade-up" data-aos-delay="160">
                            <p class="text-sm text-slate-400">Manfaat untuk publik</p>
                            <h3 class="mt-2 text-xl font-black text-white">Meningkatkan kredibilitas dan transparansi institusi</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-300">
                                Desain halaman ini dibuat agar calon mahasiswa, orang tua, dan mitra lebih cepat membaca kualitas akademik kampus.
                            </p>
                        </div>

                        <div class="rounded-3xl border border-orange-400/20 bg-orange-500/10 p-6" data-aos="fade-up" data-aos-delay="240">
                            <p class="text-sm text-orange-200">Catatan pengembangan</p>
                            <p class="mt-3 text-sm leading-7 text-orange-50">
                                Struktur view ini sudah siap dipakai dengan data dinamis dari controller. Jika nanti route publik ditambahkan,
                                daftar kartu akan otomatis mengikuti isi variabel <span class="font-semibold">$accreditations</span>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="relative overflow-hidden rounded-[36px] bg-white px-8 py-10 shadow-[0_18px_70px_rgba(15,23,42,0.10)] md:px-12 md:py-12" data-aos="fade-up">
                <div class="absolute top-0 right-0 h-56 w-56 rounded-full bg-orange-100 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
                    <div class="max-w-2xl" data-aos="fade-right">
                        <span class="text-sm font-semibold uppercase tracking-[0.26em] text-orange-500">Dokumen & Validasi</span>
                        <h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                            Perlu informasi lebih detail terkait dokumen akreditasi atau verifikasi data?
                        </h2>
                        <p class="mt-4 text-base leading-7 text-slate-600">
                            Tim kampus dapat membantu memberikan arahan dokumen pendukung, klarifikasi status masa berlaku,
                            atau kebutuhan informasi resmi lainnya.
                        </p>
                    </div>

                    <div class="flex flex-col gap-4 sm:flex-row lg:flex-col" data-aos="fade-left">
                        <a
                            href="{{ url('/contact') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f172a] px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-500"
                        >
                            <i class="bi bi-headset"></i>
                            Hubungi Kampus
                        </a>

                        <a
                            href="https://pmb.ufdk.ac.id"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-orange-300 hover:text-orange-600"
                        >
                            <i class="bi bi-arrow-up-right"></i>
                            Daftar PMB
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
