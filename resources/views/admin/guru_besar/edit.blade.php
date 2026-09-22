@extends('admin.layouts.app')

@section('title', 'Edit Guru Besar')

@section('css')
<style>
    .guru-besar-form-btn {
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
    .guru-besar-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .guru-besar-form-btn--save { background: #4b49ac; }
    .guru-besar-form-btn--save:hover { background: #3f3d94; }
    .guru-besar-form-btn--cancel { background: #64748b; }
    .guru-besar-form-btn--cancel:hover { background: #475569; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Guru Besar</h3>
</div>

<div class="card">
    <div class="card-body">
        <form action="/admin/guru-besar/{{ $guru_besar->id }}"
              method="POST"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Update Guru Besar?"
              data-confirm-text="Perubahan data guru besar akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $guru_besar->nama }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Bidang Keahlian</label>
                <input type="text" name="bidang_keahlian" value="{{ $guru_besar->bidang_keahlian }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tahun Pengangkatan</label>
                <input type="number" name="tahun_pengangkatan" value="{{ $guru_besar->tahun_pengangkatan }}" class="form-control" required>
            </div>
            @if($guru_besar->foto_url)
            <div class="form-group">
                <img src="{{ $guru_besar->foto_url }}" width="100" height="100" style="object-fit:cover;border-radius:10px;">
            </div>
            @endif
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            </div>
            <div class="d-flex gap-2">
                <button class="guru-besar-form-btn guru-besar-form-btn--save" title="Update Guru Besar" aria-label="Update Guru Besar"><i class="fas fa-save"></i></button>
                <a href="/admin/guru-besar" class="guru-besar-form-btn guru-besar-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
