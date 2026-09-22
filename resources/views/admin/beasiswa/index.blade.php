@extends('admin.layouts.app')

@section('title','Data Beasiswa')

@section('css')
<style>
    .beasiswa-icon-btn {
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
    .beasiswa-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .beasiswa-icon-btn--primary { background: #4b49ac; }
    .beasiswa-icon-btn--primary:hover { background: #3f3d94; }
    .beasiswa-icon-btn--warning { background: #f59e0b; }
    .beasiswa-icon-btn--warning:hover { background: #d97706; }
    .beasiswa-icon-btn--danger { background: #e11d48; }
    .beasiswa-icon-btn--danger:hover { background: #be123c; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Beasiswa Mahasiswa</h3>
    <a href="/admin/beasiswa/create" class="beasiswa-icon-btn beasiswa-icon-btn--primary" title="Tambah Data" aria-label="Tambah Data"><i class="fas fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="beasiswas" label="Cari penerima: nama, beasiswa, prodi, atau tahun" :paginator="$beasiswas" />
<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:25%">Nama Mahasiswa</th>
                        <th style="width:20%">Jenis Beasiswa</th>
                        <th style="width:20%">Prodi</th>
                        <th style="width:10%">Angkatan</th>
                        <th style="width:10%">Tahun</th>
                        <th style="width:15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beasiswas as $b)
                    <tr>
                        <td>{{ $b->nama_mahasiswa }}</td>
                        <td>{{ $b->jenis_beasiswa }}</td>
                        <td>{{ $b->prodi }}</td>
                        <td>{{ $b->angkatan }}</td>
                        <td>{{ $b->tahun }}</td>
                        <td>
                            <a href="/admin/beasiswa/{{ $b->id }}/edit" class="beasiswa-icon-btn beasiswa-icon-btn--warning" title="Edit Beasiswa" aria-label="Edit Beasiswa"><i class="fas fa-pen"></i></a>
                            <form action="/admin/beasiswa/{{ $b->id }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="beasiswa-icon-btn beasiswa-icon-btn--danger" title="Hapus Beasiswa" aria-label="Hapus Beasiswa"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Data belum tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3"><x-admin.table-pagination :paginator="$beasiswas" /></div>
    </div>
</div>
@endsection
