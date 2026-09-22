@extends('admin.layouts.app')

@section('css')
<style>
    .prodi-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        color: #fff;
        transition: .2s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .prodi-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .prodi-icon-btn--primary { background: #4b49ac; }
    .prodi-icon-btn--primary:hover { background: #3f3d94; }
    .prodi-icon-btn--warning { background: #f59e0b; }
    .prodi-icon-btn--warning:hover { background: #d97706; }
    .prodi-icon-btn--danger { background: #e11d48; }
    .prodi-icon-btn--danger:hover { background: #be123c; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Prodi</h3>
    <a href="/admin/prodi/create" class="prodi-icon-btn prodi-icon-btn--primary" title="Tambah Prodi" aria-label="Tambah Prodi"><i class="fas fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="prodi" label="Cari prodi: nama, kode, kaprodi, atau fakultas" :paginator="$prodi" />
<table class="table table-striped">
            <tr>
                <th>Kode Prodi</th>
                <th>Nama Prodi</th>
                <th>Nama Kaprodi</th>
                <th>Admin Prodi</th>
                <th>Foto Kaprodi</th>
                <th>Fakultas</th>
                <th>Dosen Pengajar</th>
                <th>Aksi</th>
            </tr>
            @foreach($prodi as $p)
            <tr>
                <td>{{ $p->kode_prodi }}</td>
                <td>{{ $p->nama_prodi }}</td>
                <td>{{ $p->kaprodiDosen?->nama ?? $p->nama_kaprodi ?? '-' }}</td>
                <td>
                    {{ $p->adminProdi?->nama ?? '-' }}
                </td>
                <td>
                    @if($p->kaprodiDosen?->foto_url || $p->foto_kaprodi_url)
                    <img src="{{ $p->kaprodiDosen?->foto_url ?? $p->foto_kaprodi_url }}" alt="{{ $p->kaprodiDosen?->nama ?? $p->nama_kaprodi ?? $p->nama_prodi }}" width="60" height="60" style="object-fit:cover;border-radius:8px;">
                    @else
                    -
                    @endif
                </td>
                <td>{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
                <td>
                    @if($p->dosen->isNotEmpty())
                        <span class="badge badge-info">{{ $p->dosen->count() }} dosen</span>
                        <div class="small text-muted mt-1">
                            {{ $p->dosen->pluck('nama')->take(3)->implode(', ') }}{{ $p->dosen->count() > 3 ? ', ...' : '' }}
                        </div>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="/admin/prodi/{{ $p->id }}/edit" class="prodi-icon-btn prodi-icon-btn--warning" title="Edit Prodi" aria-label="Edit Prodi"><i class="fas fa-pen"></i></a>
                    <form action="/admin/prodi/{{ $p->id }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="prodi-icon-btn prodi-icon-btn--danger" title="Hapus Prodi" aria-label="Hapus Prodi"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        @if($prodi->isEmpty())
<tr><td colspan="8" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>
        <x-admin.table-pagination :paginator="$prodi" />
    </div>
</div>
@endsection
