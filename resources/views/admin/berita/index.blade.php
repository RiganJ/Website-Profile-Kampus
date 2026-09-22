@extends('admin.layouts.app')

@section('css')
<style>
    .berita-icon-btn {
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

    .berita-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .berita-icon-btn--primary {
        background: #4b49ac;
    }

    .berita-icon-btn--primary:hover {
        background: #3f3d94;
    }

    .berita-icon-btn--warning {
        background: #f59e0b;
    }

    .berita-icon-btn--warning:hover {
        background: #d97706;
    }

    .berita-icon-btn--danger {
        background: #e11d48;
    }

    .berita-icon-btn--danger:hover {
        background: #be123c;
    }
</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Data Berita
    </h3>

    <a href="/admin/berita/create"
       class="berita-icon-btn berita-icon-btn--primary"
       title="Tambah Berita"
       aria-label="Tambah Berita">
        <i class="fas fa-plus"></i>
    </a>

</div>


<div class="card">

<div class="card-body">

<x-admin.table-toolbar name="berita" label="Cari berita: judul, kategori, atau tanggal" :paginator="$berita" />
<table class="table table-striped">

<tr>

<th>Judul</th>
<th>Kategori</th>
<th>Tanggal</th>
<th>Thumbnail</th>
<th>Aksi</th>

</tr>


@foreach($berita as $item)

<tr>

<td>{{ $item->judul }}</td>

<td>{{ $item->kategori }}</td>

<td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>

<td>

@if($item->thumbnail)

<img src="{{ $item->thumbnail_url }}"
     width="80">

@endif

</td>


<td>

<a href="/admin/berita/{{ $item->id }}/edit"
class="berita-icon-btn berita-icon-btn--warning"
title="Edit Berita"
aria-label="Edit Berita">
<i class="fas fa-pen"></i>
</a>


<form action="/admin/berita/{{ $item->id }}"
method="POST"
style="display:inline"
data-confirm-title="Hapus Berita?"
data-confirm-text="Berita yang dihapus tidak bisa dikembalikan."
data-confirm-button="Ya, hapus">

@csrf
@method('DELETE')

<button class="berita-icon-btn berita-icon-btn--danger"
title="Hapus Berita"
aria-label="Hapus Berita">
<i class="fas fa-trash-alt"></i>
</button>

</form>

</td>

</tr>

@endforeach


@if($berita->isEmpty())
<tr><td colspan="5" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>


<x-admin.table-pagination :paginator="$berita" />

</div>

</div>

@endsection
