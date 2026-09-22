@extends('admin.layouts.app')

@section('title', 'Data Guru Besar')

@section('css')
<style>
    .guru-besar-icon-btn {
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
    .guru-besar-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .guru-besar-icon-btn--primary { background: #4b49ac; }
    .guru-besar-icon-btn--primary:hover { background: #3f3d94; }
    .guru-besar-icon-btn--warning { background: #f59e0b; }
    .guru-besar-icon-btn--warning:hover { background: #d97706; }
    .guru-besar-icon-btn--danger { background: #e11d48; }
    .guru-besar-icon-btn--danger:hover { background: #be123c; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Guru Besar</h3>
    <a href="/admin/guru-besar/create" class="guru-besar-icon-btn guru-besar-icon-btn--primary" title="Tambah Guru Besar" aria-label="Tambah Guru Besar">
        <i class="fas fa-plus"></i>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="guru_besars" label="Cari guru besar: nama, bidang, atau tahun" :paginator="$guru_besars" />
<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:15%">Foto</th>
                        <th style="width:30%">Nama</th>
                        <th style="width:30%">Bidang Keahlian</th>
                        <th style="width:15%">Tahun Pengangkatan</th>
                        <th style="width:10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru_besars as $gb)
                    <tr>
                        <td>
                            @if($gb->foto_url)
                            <img src="{{ $gb->foto_url }}" width="64" height="64" style="object-fit:cover;border-radius:10px;">
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $gb->nama }}</td>
                        <td>{{ $gb->bidang_keahlian }}</td>
                        <td>{{ $gb->tahun_pengangkatan }}</td>
                        <td>
                            <a href="/admin/guru-besar/{{ $gb->id }}/edit" class="guru-besar-icon-btn guru-besar-icon-btn--warning" title="Edit Guru Besar" aria-label="Edit Guru Besar">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="/admin/guru-besar/{{ $gb->id }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="guru-besar-icon-btn guru-besar-icon-btn--danger" title="Hapus Guru Besar" aria-label="Hapus Guru Besar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data belum tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <x-admin.table-pagination :paginator="$guru_besars" />
        </div>
    </div>
</div>
@endsection
