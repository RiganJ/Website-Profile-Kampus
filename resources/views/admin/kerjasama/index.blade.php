@extends('admin.layouts.app')

@section('css')
<style>
    .kerjasama-icon-btn {
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
    .kerjasama-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .kerjasama-icon-btn--primary { background: #4b49ac; }
    .kerjasama-icon-btn--primary:hover { background: #3f3d94; }
    .kerjasama-icon-btn--warning { background: #f59e0b; }
    .kerjasama-icon-btn--warning:hover { background: #d97706; }
    .kerjasama-icon-btn--danger { background: #e11d48; }
    .kerjasama-icon-btn--danger:hover { background: #be123c; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Kerja Sama</h3>
    <a href="/admin/kerjasama/create" class="kerjasama-icon-btn kerjasama-icon-btn--primary" title="Tambah Kerja Sama" aria-label="Tambah Kerja Sama">
        <i class="fas fa-plus"></i>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="kerjasama" label="Cari mitra: nama, kriteria, atau skala" :paginator="$kerjasama" />
<table class="table table-striped">
            <tr>
                <th>Logo</th>
                <th>Nama Mitra</th>
                <th>Tahun Mulai</th>
                <th>Tahun Berakhir</th>
                <th>Kriteria</th>
                <th>Skala</th>
                <th>Aksi</th>
            </tr>
            @foreach($kerjasama as $k)
            <tr>
<td>
    @if(!empty($k->logo) && file_exists(base_path($k->logo)))
        <img 
            src="{{ asset($k->logo) }}" 
            alt="logo" 
            style="max-height:48px"
        >
    @else
        Tidak ada logo
    @endif
</td>
                <td>{{ $k->nama ?? $k->partner_mou }}</td>
                <td>{{ $k->tahun_mulai ?? (isset($k->tanggal_mulai) ? date('Y', strtotime($k->tanggal_mulai)) : '-') }}</td>
                <td>{{ $k->tahun_berakhir ?? (isset($k->tanggal_berakhir) ? date('Y', strtotime($k->tanggal_berakhir)) : '-') }}</td>
                <td>{{ $k->kriteria_label }}</td>
                <td><span class="badge badge-info">{{ $k->skala ?? 'Nasional' }}</span></td>
                <td>
                    <a href="/admin/kerjasama/{{ $k->id }}/edit" class="kerjasama-icon-btn kerjasama-icon-btn--warning" title="Edit Kerja Sama" aria-label="Edit Kerja Sama">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="/admin/kerjasama/{{ $k->id }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="kerjasama-icon-btn kerjasama-icon-btn--danger" title="Hapus Kerja Sama" aria-label="Hapus Kerja Sama">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        @if($kerjasama->isEmpty())
<tr><td colspan="7" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>
        <x-admin.table-pagination :paginator="$kerjasama" />
    </div>
</div>
@endsection
