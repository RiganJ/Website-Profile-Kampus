@extends('admin.layouts.app')

@section('css')
<style>
    .fakultas-icon-btn {
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
    .fakultas-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .fakultas-icon-btn--primary { background: #4b49ac; }
    .fakultas-icon-btn--primary:hover { background: #3f3d94; }
    .fakultas-icon-btn--warning { background: #f59e0b; }
    .fakultas-icon-btn--warning:hover { background: #d97706; }
    .fakultas-icon-btn--danger { background: #e11d48; }
    .fakultas-icon-btn--danger:hover { background: #be123c; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Fakultas</h3>
    <a href="/admin/fakultas/create" class="fakultas-icon-btn fakultas-icon-btn--primary" title="Tambah Fakultas" aria-label="Tambah Fakultas"><i class="fas fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="fakultas" label="Cari fakultas: nama, kode, atau dekan" :paginator="$fakultas" />
<table class="table table-striped">
            <tr>
                <th>Kode Fakultas</th>
                <th>Nama Fakultas</th>
                <th>Dekan</th>
                <th>Aksi</th>
            </tr>
            @foreach($fakultas as $f)
            <tr>
                <td>{{ $f->kode_fakultas }}</td>
                <td>{{ $f->nama_fakultas }}</td>
                <td>{{ $f->dekan }}</td>
                <td>
                    <a href="/admin/fakultas/{{ $f->id }}/edit" class="fakultas-icon-btn fakultas-icon-btn--warning" title="Edit Fakultas" aria-label="Edit Fakultas"><i class="fas fa-pen"></i></a>
                    <form action="/admin/fakultas/{{ $f->id }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="fakultas-icon-btn fakultas-icon-btn--danger" title="Hapus Fakultas" aria-label="Hapus Fakultas"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        @if($fakultas->isEmpty())
<tr><td colspan="4" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>
        <x-admin.table-pagination :paginator="$fakultas" />
    </div>
</div>
@endsection
