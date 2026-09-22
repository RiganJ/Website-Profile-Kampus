@extends('admin.layouts.app')

@section('css')
<style>
    .hero-prodi-thumb {
        width: 120px;
        height: 64px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
    }
    .hero-prodi-empty {
        width: 120px;
        height: 64px;
        border-radius: 8px;
        border: 1px dashed #cbd5e1;
        background: #f8fafc;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
    .hero-prodi-btn {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: #4b49ac;
        transition: .2s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .hero-prodi-btn:hover {
        color: #fff;
        background: #3f3d94;
        transform: translateY(-1px);
    }
    .hero-prodi-muted {
        color: #64748b;
        font-size: 12px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Hero Prodi</h3>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="prodi" label="Cari hero prodi: prodi, judul, atau deskripsi" :paginator="$prodi" />
<div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Prodi</th>
                        <th>Judul Hero</th>
                        <th>Deskripsi Hero</th>
                        <th>Gambar</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prodi as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->nama_prodi }}</strong>
                                <div class="hero-prodi-muted">{{ $item->kode_prodi ?? '-' }}</div>
                            </td>
                            <td>{{ $item->hero_title ?: '-' }}</td>
                            <td>{{ $item->hero_subtitle ? \Illuminate\Support\Str::limit($item->hero_subtitle, 90) : '-' }}</td>
                            <td>
                                @if($item->hero_image_url)
                                    <img src="{{ $item->hero_image_url }}" alt="Hero {{ $item->nama_prodi }}" class="hero-prodi-thumb">
                                @else
                                    <span class="hero-prodi-empty">Default</span>
                                @endif
                            </td>
                            <td>{{ $item->hero_image_position ?: 'center center' }}</td>
                            <td>
                                <a href="{{ route('prodi-hero.edit', $item) }}" class="hero-prodi-btn" title="Edit Hero Prodi" aria-label="Edit Hero Prodi">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data prodi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-admin.table-pagination :paginator="$prodi" />
    </div>
</div>
@endsection
