@extends('layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')
    @php
        $primaryColor = '#e96f0c';
        $accentColor = '#0f172a';

        $facultyGroups = collect($faculties ?? [])->map(function ($faculty) {
            return [
                'nama_fakultas' => $faculty->nama_fakultas ?? 'Fakultas',
                'dekan' => $faculty->dekan ?? 'Informasi dekan belum tersedia',
                'foto_dekan' => $faculty->dean_photo_url ?? null,
                'jabatan_dekan' => $faculty->dean_position ?? ('Dekan ' . ($faculty->nama_fakultas ?? 'Fakultas')),
                'prodi' => collect($faculty->prodi ?? [])->map(function ($prodi) {
                    $kaprodi = $prodi->kaprodiDosen;
                    $dosenProdi = collect($prodi->dosen ?? [])
                        ->reject(fn ($dosen) => $kaprodi && $dosen->id === $kaprodi->id);

                    if ($kaprodi) {
                        $dosenProdi->prepend($kaprodi);
                    }

                    return [
                        'nama_prodi' => $prodi->nama_prodi ?? 'Program Studi',
                        'kode_prodi' => $prodi->kode_prodi ?? null,
                        'dosen' => $dosenProdi->map(function ($dosen) use ($kaprodi) {
                            $isKaprodi = $kaprodi && $dosen->id === $kaprodi->id;

                            return [
                                'nama' => $dosen->nama ?? 'Nama dosen',
                                'jabatan' => $isKaprodi ? 'Ketua Program Studi' : ($dosen->jabatan ?? 'Dosen'),
                                'is_kaprodi' => $isKaprodi,
                                'pendidikan_terakhir' => $dosen->pendidikan_terakhir ?? '-',
                                'asal_pendidikan' => $dosen->asal_pendidikan ?? '-',
                                'nip' => $dosen->nip ?? '-',
                                'foto' => $dosen->foto_url ?? null,
                            ];
                        })->values(),
                    ];
                })->values(),
            ];
        })->values();

        $leaderCards = collect($leaders ?? [])->map(function ($leader) {
            return [
                'nama' => $leader->nama ?? 'Nama pimpinan',
                'jabatan' => $leader->jabatan ?? 'Pimpinan Universitas',
                'pendidikan_terakhir' => $leader->pendidikan_terakhir ?? '-',
                'asal_pendidikan' => $leader->asal_pendidikan ?? '-',
                'nip' => $leader->nip ?? '-',
                'foto' => $leader->foto_url ?? null,
            ];
        })->values();

        if ($leaderCards->isEmpty()) {
            $leaderCards = collect([
                [
                    'nama' => 'Prof. Dr. Hj. Evi Hasnita, S.Pd., Ns., M.Kes.',
                    'jabatan' => 'Rektor',
                    'pendidikan_terakhir' => '-',
                    'asal_pendidikan' => '-',
                    'nip' => '-',
                    'foto' => asset('images/rektor.png'),
                ],
                [
                    'nama' => 'Dr. Nurhayati, S.St, M.Biomed',
                    'jabatan' => 'Wakil Rektor I',
                    'pendidikan_terakhir' => '-',
                    'asal_pendidikan' => '-',
                    'nip' => '-',
                    'foto' => asset('images/wakil1.jpg'),
                ],
                [
                    'nama' => 'Dr. Zuraida, S.St, M.Biomed',
                    'jabatan' => 'Wakil Rektor II',
                    'pendidikan_terakhir' => '-',
                    'asal_pendidikan' => '-',
                    'nip' => '-',
                    'foto' => asset('images/wakil2.jpg'),
                ],
                [
                    'nama' => 'Ns. Ratna Dewi, S.Kep, M.Kep',
                    'jabatan' => 'Wakil Rektor III',
                    'pendidikan_terakhir' => '-',
                    'asal_pendidikan' => '-',
                    'nip' => '-',
                    'foto' => asset('images/wakil3.jpg'),
                ],
            ]);
        }

        if ($facultyGroups->isEmpty()) {
            $facultyGroups = collect([
                [
                    'nama_fakultas' => 'Fakultas Kesehatan',
                    'dekan' => 'Dr. Hj. Siti Amanah, M.Pd',
                    'prodi' => collect([
                        [
                            'nama_prodi' => 'S1 Keperawatan',
                            'kode_prodi' => 'S1KEP',
                            'dosen' => collect([
                                [
                                    'nama' => 'Ns. Ratna Dewi, S.Kep., M.Kep',
                                    'jabatan' => 'Koordinator Prodi',
                                    'pendidikan_terakhir' => 'S2 Keperawatan',
                                    'asal_pendidikan' => 'Universitas Andalas',
                                    'nip' => '19781203 200501 2 001',
                                    'foto' => null,
                                ],
                                [
                                    'nama' => 'Dr. Maya Putri, S.Kep., M.Kes',
                                    'jabatan' => 'Dosen Tetap',
                                    'pendidikan_terakhir' => 'S3 Kesehatan Masyarakat',
                                    'asal_pendidikan' => 'Universitas Indonesia',
                                    'nip' => '19790514 200702 2 004',
                                    'foto' => null,
                                ],
                            ]),
                        ],
                        [
                            'nama_prodi' => 'S1 Kebidanan',
                            'kode_prodi' => 'S1BDN',
                            'dosen' => collect([
                                [
                                    'nama' => 'Dr. Nurhayati, S.St., M.Biomed',
                                    'jabatan' => 'Koordinator Prodi',
                                    'pendidikan_terakhir' => 'S3 Biomedik',
                                    'asal_pendidikan' => 'Universitas Airlangga',
                                    'nip' => '19800211 200812 2 006',
                                    'foto' => null,
                                ],
                                [
                                    'nama' => 'Ns. Lusi Anggraini, M.Keb',
                                    'jabatan' => 'Dosen Tetap',
                                    'pendidikan_terakhir' => 'S2 Kebidanan',
                                    'asal_pendidikan' => 'Universitas Brawijaya',
                                    'nip' => '19830412 201001 2 002',
                                    'foto' => null,
                                ],
                            ]),
                        ],
                    ]),
                ],
                [
                    'nama_fakultas' => 'Fakultas Sosial Ekonomi dan Humaniora',
                    'dekan' => 'Dr. Ir. Agus Santoso, M.Sc',
                    'prodi' => collect([
                        [
                            'nama_prodi' => 'S1 Bisnis Digital',
                            'kode_prodi' => 'S1BSD',
                            'dosen' => collect([
                                [
                                    'nama' => 'Dr. Zuraida, S.St., M.Biomed',
                                    'jabatan' => 'Koordinator Prodi',
                                    'pendidikan_terakhir' => 'S3 Manajemen',
                                    'asal_pendidikan' => 'Universitas Padjadjaran',
                                    'nip' => '19810618 200903 2 005',
                                    'foto' => null,
                                ],
                                [
                                    'nama' => 'Riko Pratama, S.Kom., M.M',
                                    'jabatan' => 'Dosen Tetap',
                                    'pendidikan_terakhir' => 'S2 Manajemen Bisnis',
                                    'asal_pendidikan' => 'Universitas Gadjah Mada',
                                    'nip' => '19871120 201304 2 003',
                                    'foto' => null,
                                ],
                            ]),
                        ],
                    ]),
                ],
            ]);
        }

        $totalFaculties = $facultyGroups->count();
        $totalPrograms = $facultyGroups->sum(fn ($faculty) => collect($faculty['prodi'])->count());
        $totalLecturers = $facultyGroups->sum(
            fn ($faculty) => collect($faculty['prodi'])->sum(fn ($prodi) => collect($prodi['dosen'])->count())
        );
        $totalLeaders = $leaderCards->count();
    @endphp

    <section class="relative flex h-[520px] items-center overflow-hidden bg-[url('/images/bannerkontak.png')] bg-cover bg-center">
        <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(10,10,10,0.88)_0%,rgba(10,10,10,0.58)_45%,rgba(10,10,10,0.24)_100%)]"></div>
        <div class="absolute -top-24 -right-24 h-80 w-80 rounded-full blur-3xl" style="background-color: rgba(233, 111, 12, 0.28);"></div>
        <div class="absolute bottom-0 left-0 h-40 w-full bg-gradient-to-t from-slate-950/70 to-transparent"></div>

        <div class="relative z-10 mx-auto w-full max-w-6xl px-6 text-center" data-aos="fade-up">
            <nav class="mb-5 text-sm text-slate-300">
                <a href="{{ url('/') }}" class="transition hover:text-[#e96f0c]">Beranda</a>
                <span class="px-2">/</span>
                <span class="font-semibold text-[#e96f0c]">Struktur Organisasi</span>
            </nav>

            <div class="mx-auto inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#f6b27f] backdrop-blur-md">
                <i class="bi bi-diagram-3-fill"></i>
                Struktur Kepemimpinan dan Akademik
            </div>

            <h1 class="mt-6 text-4xl font-black leading-tight text-white md:text-5xl lg:text-6xl">
                Struktur Organisasi
                <span class="bg-gradient-to-r from-[#ffbe86] to-[#e96f0c] bg-clip-text text-transparent">Universitas Fort De Kock</span>
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-base leading-7 text-slate-200 md:text-lg">
                Halaman ini menampilkan bagan struktur organisasi kampus dan susunan dosen
                yang dikelompokkan berdasarkan fakultas dan program studi agar lebih mudah ditelusuri.
            </p>
        </div>
    </section>


    <section class="bg-white py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.28em] text-[#e96f0c]">Pimpinan Universitas</span>
                    <h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                        Rektor dan Wakil Rektor Universitas Fort De Kock
                    </h2>
                </div>

             
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($leaderCards as $leader)
                    <article class="group overflow-hidden rounded-[28px] border border-slate-200 bg-slate-50 shadow-[0_16px_50px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:border-orange-200 hover:bg-white hover:shadow-[0_22px_70px_rgba(15,23,42,0.12)]" data-aos="{{ $loop->odd ? 'fade-right' : 'fade-left' }}" data-aos-delay="{{ 80 + (($loop->index % 4) * 80) }}">
                        <div class="relative h-72 overflow-hidden bg-gradient-to-br from-[#0f172a] to-[#1d2b40]">
                            @if (!empty($leader['foto']))
                                <img
                                    src="{{ $leader['foto'] }}"
                                    alt="{{ $leader['nama'] }}"
                                    class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full w-full flex-col items-center justify-center px-6 text-center text-white">
                                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-3xl text-[#f6b27f]">
                                        <i class="bi bi-person-badge-fill"></i>
                                    </div>
                                    <p class="mt-5 text-lg font-bold leading-tight">{{ $leader['nama'] }}</p>
                                </div>
                            @endif

                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/85 to-transparent p-5">
                                <span class="inline-flex rounded-full bg-[#e96f0c] px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-white">
                                    {{ $leader['jabatan'] }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-black leading-tight text-slate-900">{{ $leader['nama'] }}</h3>

                            <div class="mt-4 space-y-3 text-sm text-slate-600">
                                <div class="flex items-start gap-3">
                                    <i class="bi bi-mortarboard mt-0.5 text-[#e96f0c]"></i>
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Pendidikan Terakhir</p>
                                        <p class="mt-1 font-medium text-slate-800">{{ $leader['pendidikan_terakhir'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <i class="bi bi-building-check mt-0.5 text-[#0f172a]"></i>
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Asal Pendidikan</p>
                                        <p class="mt-1 font-medium text-slate-800">{{ $leader['asal_pendidikan'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 max-w-2xl" data-aos="fade-right">
                <span class="text-sm font-semibold uppercase tracking-[0.28em] text-[#e96f0c]">Bagan Organisasi</span>
<h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
    Struktur Organisasi Universitas Fort De Kock
</h2>
<p class="mt-4 text-base leading-7 text-slate-600">
    Struktur organisasi menggambarkan susunan kepemimpinan, hubungan kerja, serta pembagian tugas dan tanggung jawab dalam mendukung penyelenggaraan tata kelola Universitas Fort De Kock secara efektif dan profesional.
</p>            </div>

            <div class="relative overflow-hidden rounded-[34px] border border-slate-200 bg-slate-50 p-4 shadow-[0_18px_70px_rgba(15,23,42,0.08)] md:p-6" data-aos="fade-left">
                <div class="absolute top-0 right-0 h-48 w-48 rounded-full bg-[#fff1e7] blur-3xl"></div>

                <div class="relative z-10 overflow-hidden rounded-[28px] border border-dashed border-slate-300 bg-white">
                    <img
                        src="{{ asset('images/strukturbaru.png') }}"
                        alt="Struktur Organisasi Universitas Fort De Kock"
                        class="h-auto max-h-[820px] w-full object-contain"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 max-w-3xl" data-aos="fade-right">
                <span class="text-sm font-semibold uppercase tracking-[0.28em] text-[#e96f0c]">Tupoksi Struktur Organisasi</span>
                <h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                    Tupoksi Struktur Organisasi Universitas Fort De Kock
                </h2>
                <p class="mt-4 text-base leading-7 text-slate-600">
                    Dokumen ini memuat surat keputusan, struktur organisasi, serta tugas pokok dan fungsi
                    setiap unsur organisasi Universitas Fort De Kock.
                </p>
            </div>

            <div class="overflow-hidden rounded-[34px] border border-slate-200 bg-white shadow-[0_18px_70px_rgba(15,23,42,0.08)]" data-aos="fade-up">
                <div class="flex flex-col gap-4 border-b border-slate-200 bg-gradient-to-r from-[#0f172a] to-[#1d2b40] px-6 py-5 text-white md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#f6b27f]">Dokumen Resmi</p>
                        <h3 class="mt-2 text-xl font-black leading-tight">
                            SK Struktur Organisasi dan Tupoksi UFDK 2026
                        </h3>
                    </div>
                    <a
                        href="{{ asset('files/sk-struktur-organisasi-dan-tupoksi-ufdk-2026.pdf') }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex w-fit items-center gap-2 rounded-full bg-[#e96f0c] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#c85f0a]"
                    >
                        <i class="bi bi-box-arrow-up-right"></i>
                        Buka PDF
                    </a>
                </div>

                <div class="bg-slate-100 p-3 md:p-5">
                    <object
                        data="{{ asset('files/sk-struktur-organisasi-dan-tupoksi-ufdk-2026.pdf') }}#toolbar=1&navpanes=0"
                        type="application/pdf"
                        class="h-[760px] w-full rounded-[24px] border border-slate-200 bg-white"
                    >
                        <iframe
                            src="{{ asset('files/sk-struktur-organisasi-dan-tupoksi-ufdk-2026.pdf') }}#toolbar=1&navpanes=0"
                            title="SK Struktur Organisasi dan Tupoksi UFDK 2026"
                            class="h-[760px] w-full rounded-[24px] border border-slate-200 bg-white"
                        ></iframe>
                    </object>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
                <div class="max-w-2xl">
                    <span class="text-sm font-semibold uppercase tracking-[0.28em] text-[#e96f0c]">Dosen Berdasarkan Struktur Akademik</span>
                    <h2 class="mt-4 text-3xl font-black leading-tight text-slate-900 md:text-4xl">
                        Temukan profil dosen sesuai fakultas dan program studi.
                    </h2>
                </div>


            </div>

            <div class="space-y-10">
                @foreach ($facultyGroups as $faculty)
                    <section class="overflow-hidden rounded-[34px] border border-slate-200 bg-white shadow-[0_18px_70px_rgba(15,23,42,0.08)]" data-aos="fade-up" data-aos-delay="{{ 80 + (($loop->index % 3) * 80) }}">
                        <div class="relative overflow-hidden bg-gradient-to-r from-[#0f172a] to-[#1d2b40] px-8 py-8 text-white">
                            <div class="absolute -top-10 right-0 h-32 w-32 rounded-full blur-3xl" style="background-color: rgba(233, 111, 12, 0.22);"></div>

                            <div class="relative z-10 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                                <div>
                                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-[#f6b27f]">
                                        <i class="bi bi-bank"></i>
                                        Fakultas
                                    </span>
                                    <h3 class="mt-4 text-3xl font-black leading-tight">{{ $faculty['nama_fakultas'] }}</h3>
                                </div>

                                <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 px-5 py-4">
                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-2xl border border-white/15 bg-white/10">
                                        @if (!empty($faculty['foto_dekan']))
                                            <img src="{{ $faculty['foto_dekan'] }}" alt="{{ $faculty['dekan'] }}" class="h-full w-full object-cover object-top">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-3xl text-[#f6b27f]">
                                                <i class="bi bi-person-badge-fill"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.22em] text-slate-300">{{ $faculty['jabatan_dekan'] ?? 'Dekan Fakultas' }}</p>
                                        <p class="mt-2 text-base font-semibold text-white">{{ $faculty['dekan'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8 p-8">
                            @foreach ($faculty['prodi'] as $prodi)
                                <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-6" data-aos="{{ $loop->odd ? 'fade-right' : 'fade-left' }}">
                                    <div class="mb-6 flex flex-col gap-4 border-b border-slate-200 pb-5 md:flex-row md:items-end md:justify-between">
                                        <div>
                                            <span class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Program Studi</span>
                                            <h4 class="mt-2 text-2xl font-black text-slate-900">{{ $prodi['nama_prodi'] }}</h4>
                                        </div>

                                        @if (!empty($prodi['kode_prodi']))
                                            <span class="inline-flex w-fit rounded-full bg-[#e96f0c] px-4 py-2 text-sm font-semibold text-white">
                                                {{ $prodi['kode_prodi'] }}
                                            </span>
                                        @endif
                                    </div>

                                    @if (collect($prodi['dosen'])->isNotEmpty())
                                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                                            @foreach ($prodi['dosen'] as $dosen)
                                                <article class="group overflow-hidden rounded-[26px] border {{ !empty($dosen['is_kaprodi']) ? 'border-orange-300 ring-2 ring-orange-100' : 'border-slate-200' }} bg-white transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_60px_rgba(15,23,42,0.10)]" data-aos="fade-up" data-aos-delay="{{ 60 + (($loop->index % 3) * 70) }}">
                                                    <div class="relative h-64 overflow-hidden bg-gradient-to-br from-[#0f172a] to-[#1d2b40]">
                                                        @if (!empty($dosen['foto']))
                                                            <img
                                                                src="{{ $dosen['foto'] }}"
                                                                alt="{{ $dosen['nama'] }}"
                                                                class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105"
                                                            >
                                                        @else
                                                            <div class="flex h-full w-full flex-col items-center justify-center px-6 text-center text-white">
                                                                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-3xl text-[#f6b27f]">
                                                                    <i class="bi bi-person-badge-fill"></i>
                                                                </div>
                                                                <p class="mt-5 text-lg font-bold leading-tight">{{ $dosen['nama'] }}</p>
                                                                <p class="mt-2 text-sm text-slate-300">{{ $dosen['jabatan'] }}</p>
                                                            </div>
                                                        @endif

                                                        <div class="absolute bottom-4 left-4">
                                                            <span class="inline-flex rounded-full bg-[#e96f0c] px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-white">
                                                                {{ $dosen['jabatan'] }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="p-6">
                                                        <h5 class="text-xl font-black leading-tight text-slate-900">{{ $dosen['nama'] }}</h5>

                                                        <div class="mt-4 space-y-3 text-sm text-slate-600">
                                                            <div class="flex items-start gap-3">
                                                                <i class="bi bi-mortarboard mt-0.5 text-[#e96f0c]"></i>
                                                                <div>
                                                                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Pendidikan Terakhir</p>
                                                                    <p class="mt-1 font-medium text-slate-800">{{ $dosen['pendidikan_terakhir'] }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="flex items-start gap-3">
                                                                <i class="bi bi-building-check mt-0.5 text-[#0f172a]"></i>
                                                                <div>
                                                                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Asal Pendidikan</p>
                                                                    <p class="mt-1 font-medium text-slate-800">{{ $dosen['asal_pendidikan'] }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="flex items-start gap-3">
                                                                <i class="bi bi-person-vcard mt-0.5 text-[#e96f0c]"></i>
                                                                <div>
                                                                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">NIP</p>
                                                                    <p class="mt-1 font-medium text-slate-800">{{ $dosen['nip'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-8 text-center text-slate-500">
                                            Data dosen untuk program studi ini belum tersedia.
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </section>
@endsection
