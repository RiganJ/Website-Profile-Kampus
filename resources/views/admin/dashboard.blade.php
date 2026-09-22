@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('css')
<style>
    .dashboard-stat-card .card-body {
        text-align: center;
    }

    .dashboard-stat-icon {
        font-size: 1.85rem;
        margin-bottom: .75rem;
    }

    .dashboard-table-card .card-body {
        padding: 1.5rem;
    }

    .dashboard-table-card .table-responsive {
        min-height: 290px;
    }

    .dashboard-table-card table {
        margin-bottom: 0;
    }

    .dashboard-table-card .card-title {
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<section class="admin-welcome" aria-label="Ringkasan dashboard">
    <div>
        <span class="admin-eyebrow">Ruang kerja / Overview</span>
        <h1>Selamat datang, {{ auth()->user()->name }}.</h1>
        <p>Pantau data kampus dan aktivitas terbaru, lalu lanjutkan pekerjaan Anda.</p>
    </div>
    <div class="admin-date"><i class="far fa-calendar-alt" aria-hidden="true"></i> {{ now()->locale('id')->translatedFormat('d F Y') }}</div>
</section>
@php
    $metrics = [
        ['Mahasiswa', $jumlahMahasiswa, 'fa-user-graduate'],
        ['Dosen', $jumlahDosen, 'fa-chalkboard-teacher'],
        ['Program studi', $jumlahProdi, 'fa-book-open'],
        ['Fakultas', $jumlahFakultas, 'fa-university'],
        ['Mitra kerja sama', $jumlahMitra, 'fa-handshake'],
        ['Penerima beasiswa', $jumlahBeasiswa, 'fa-award'],
        ['Civitas', $jumlahCivitas, 'fa-users'],
        ['Guru besar', $jumlahGuruBesar, 'fa-user-tie'],
    ];
@endphp
<div class="admin-metrics">
    @foreach($metrics as [$label, $value, $icon])
        <article class="admin-metric">
            <div class="admin-metric-icon"><i class="fas {{ $icon }}" aria-hidden="true"></i></div>
            <div><strong>{{ number_format($value, 0, ',', '.') }}</strong><span>{{ $label }}</span></div>
        </article>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card dashboard-table-card">
            <div class="card-body">
                <h4 class="card-title">Dosen Terbaru</h4>
                <x-admin.table-toolbar name="dosenTerbaru" label="Cari dosen" :paginator="$dosenTerbaru" />
<div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIDN</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosenTerbaru as $dosen)
                                <tr>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>{{ $dosen->nidn }}</td>
                                    <td>{{ $dosen->prodi->pluck('nama_prodi')->implode(', ') ?: '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data dosen.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
<x-admin.table-pagination :paginator="$dosenTerbaru" />
            </div>
        </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card dashboard-table-card">
            <div class="card-body">
                <h4 class="card-title">Mahasiswa Terbaru</h4>
                <x-admin.table-toolbar name="mahasiswaTerbaru" label="Cari mahasiswa" :paginator="$mahasiswaTerbaru" />
<div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswaTerbaru as $mhs)
                                <tr>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->prodi->nama_prodi ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data mahasiswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
<x-admin.table-pagination :paginator="$mahasiswaTerbaru" />
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card dashboard-table-card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                    <h4 class="card-title mb-0">Aktivitas Admin Terbaru</h4>
                    <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-dark btn-sm">
                        Cek Selengkapnya
                    </a>
                </div>

                <x-admin.table-toolbar name="aktivitasTerbaru" label="Cari aktivitas admin" :paginator="$aktivitasTerbaru" />
<div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Pengguna</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aktivitasTerbaru as $aktivitas)
                                <tr>
                                    <td>{{ optional($aktivitas->performed_at)->format('d M Y H:i') ?: '-' }}</td>
                                    <td>
                                        <strong>{{ $aktivitas->name ?: '-' }}</strong>
                                        <div class="text-muted small">{{ $aktivitas->module ?: '-' }}</div>
                                    </td>
                                    <td>
                                        <span class="text-uppercase">{{ $aktivitas->action ?: '-' }}</span>
                                        <div class="text-muted small">{{ $aktivitas->description ?: '-' }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada aktivitas admin terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
<x-admin.table-pagination :paginator="$aktivitasTerbaru" />
            </div>
        </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card dashboard-table-card">
            <div class="card-body">
                <h4 class="card-title">Grafik Mahasiswa per Angkatan</h4>
                <div class="table-responsive d-flex align-items-center" style="min-height: 290px;">
                    <canvas id="chartMahasiswaTahun" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function () {
        const chartElement = document.getElementById('chartMahasiswaTahun');
        if (!chartElement) {
            return;
        }

        const labels = @json($mahasiswaPerTahun->pluck('tahun')->values());
        const totals = @json($mahasiswaPerTahun->pluck('total')->values());

        new Chart(chartElement, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: totals,
                    backgroundColor: 'rgba(234, 88, 12, 0.85)',
                    borderColor: '#ea580c',
                    borderWidth: 1.5,
                    borderRadius: 8,
                    maxBarThickness: 42
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    })();
</script>
@endsection
