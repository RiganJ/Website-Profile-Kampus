@extends('admin.layouts.app')

@section('title', 'Panduan Akademik')

@section('css')
<style>
    .panduan-icon-btn {
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
    .panduan-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .panduan-icon-btn--primary { background: #4b49ac; }
    .panduan-icon-btn--primary:hover { background: #3f3d94; }
    .panduan-icon-btn--warning { background: #f59e0b; }
    .panduan-icon-btn--warning:hover { background: #d97706; }
    .panduan-icon-btn--danger { background: #e11d48; }
    .panduan-icon-btn--danger:hover { background: #be123c; }
    .panduan-icon-btn--info { background: #0ea5e9; }
    .panduan-icon-btn--info:hover { background: #0284c7; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Panduan Akademik</h3>
    <a href="/admin/panduan-akademik/create" class="panduan-icon-btn panduan-icon-btn--primary" title="Tambah Panduan" aria-label="Tambah Panduan"><i class="fas fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="guides" label="Cari informasi: judul, kategori, atau deskripsi" :paginator="$guides" />
<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:24%">Judul</th>
                        <th style="width:18%">Kategori</th>
                        <th style="width:24%">Deskripsi</th>
                        <th style="width:12%">Tanggal Publikasi</th>
                        <th style="width:10%">Status</th>
                        <th style="width:8%">File</th>
                        <th style="width:10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guides as $guide)
                        <tr>
                            <td>{{ $guide->judul }}</td>
                            <td>{{ $guide->kategori_label }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($guide->deskripsi ?? '-', 90) }}</td>
                            <td>{{ $guide->published_at ? $guide->published_at->format('d M Y') : '-' }}</td>
                            <td>
                                <span class="badge {{ $guide->is_active ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $guide->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ $guide->file_url }}" target="_blank" class="panduan-icon-btn panduan-icon-btn--info" title="Lihat PDF" aria-label="Lihat PDF"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>
                                <a href="/admin/panduan-akademik/{{ $guide->id }}/edit" class="panduan-icon-btn panduan-icon-btn--warning" title="Edit Panduan" aria-label="Edit Panduan"><i class="fas fa-pen"></i></a>
                                <form action="/admin/panduan-akademik/{{ $guide->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="panduan-icon-btn panduan-icon-btn--danger" title="Hapus Panduan" aria-label="Hapus Panduan"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Data panduan akademik belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3"><x-admin.table-pagination :paginator="$guides" /></div>
    </div>
</div>
@endsection
