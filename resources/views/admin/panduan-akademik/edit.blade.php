@extends('admin.layouts.app')

@section('title', 'Edit Panduan Akademik')

@section('css')
<style>
    .panduan-form-btn {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        color: #fff;
        transition: .2s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .panduan-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .panduan-form-btn--save { background: #4b49ac; }
    .panduan-form-btn--save:hover { background: #3f3d94; }
    .panduan-form-btn--cancel { background: #64748b; }
    .panduan-form-btn--cancel:hover { background: #475569; }
    .panduan-form-btn--info { background: #0ea5e9; }
    .panduan-form-btn--info:hover { background: #0284c7; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Panduan Akademik</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/panduan-akademik/{{ $guide->id }}" enctype="multipart/form-data" data-confirm-submit="true" data-confirm-title="Update Panduan?" data-confirm-text="Perubahan panduan akademik akan disimpan." data-confirm-button="Ya, update">
            @csrf
            @method('PUT')

            <label class="mb-1">Judul Panduan</label>
            <input type="text" name="judul" class="form-control mb-3" value="{{ old('judul', $guide->judul) }}" required>

            <label class="mb-1">Kategori</label>
            <select name="kategori" class="form-control mb-3" required>
                @foreach($categoryOptions as $key => $label)
                    <option value="{{ $key }}" {{ old('kategori', $guide->kategori) === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            <label class="mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="form-control mb-3" rows="4">{{ old('deskripsi', $guide->deskripsi) }}</textarea>

            <label class="mb-1">Tanggal Publikasi</label>
            <input type="date" name="published_at" class="form-control mb-3" value="{{ old('published_at', optional($guide->published_at)->format('Y-m-d')) }}">

            <label class="mb-1">Ganti File PDF</label>
            <input type="file" name="file" class="form-control mb-2" accept="application/pdf,.pdf">

            <a href="{{ $guide->file_url }}" target="_blank" class="panduan-form-btn panduan-form-btn--info mb-3" title="Lihat File Lama" aria-label="Lihat File Lama"><i class="fas fa-eye"></i></a>

            <div class="form-check mb-4">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $guide->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Tampilkan di halaman publik</label>
            </div>

            <div class="d-flex gap-2">
                <button class="panduan-form-btn panduan-form-btn--save" title="Update Panduan" aria-label="Update Panduan"><i class="fas fa-save"></i></button>
                <a href="/admin/panduan-akademik" class="panduan-form-btn panduan-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
