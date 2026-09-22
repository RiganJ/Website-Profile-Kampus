@extends('admin.layouts.app')

@section('title', 'Edit Civitas')

@section('css')
<style>
    .civitas-form-btn {
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

    .civitas-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .civitas-form-btn--save { background: #4b49ac; }
    .civitas-form-btn--save:hover { background: #3f3d94; }
    .civitas-form-btn--cancel { background: #64748b; }
    .civitas-form-btn--cancel:hover { background: #475569; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Civitas</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST"
              action="/admin/civitas/{{ $civitas->id }}"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Update Civitas?"
              data-confirm-text="Perubahan data civitas akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')

            <input type="text" name="nip" class="form-control mb-2" placeholder="NIP" value="{{ old('nip', $civitas->nip) }}">
            <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" value="{{ old('nama', $civitas->nama) }}">

            <select name="jenis_kelamin" class="form-control mb-2">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" {{ old('jenis_kelamin', $civitas->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $civitas->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <input type="text" name="pendidikan_terakhir" class="form-control mb-2" placeholder="Pendidikan Terakhir" value="{{ old('pendidikan_terakhir', $civitas->pendidikan_terakhir) }}">
            <input type="text" name="asal_pendidikan" class="form-control mb-2" placeholder="Asal Pendidikan" value="{{ old('asal_pendidikan', $civitas->asal_pendidikan) }}">
            <input type="date" name="tanggal_masuk_kerja" class="form-control mb-2" value="{{ old('tanggal_masuk_kerja', $civitas->tanggal_masuk_kerja) }}">
            <input type="text" name="jabatan" class="form-control mb-2" placeholder="Jabatan" value="{{ old('jabatan', $civitas->jabatan) }}">

            @if($civitas->foto_url)
            <div class="mb-2">
                <img src="{{ $civitas->foto_url }}" width="100" height="100" style="object-fit:cover;border-radius:8px;">
            </div>
            @endif

            <input type="file" name="foto" class="form-control mb-2" accept=".jpg,.jpeg,.png,.webp">

            <textarea name="keterangan" class="form-control mb-2" placeholder="Keterangan (opsional)">{{ old('keterangan', $civitas->keterangan) }}</textarea>

            <div class="d-flex gap-2">
                <button class="civitas-form-btn civitas-form-btn--save" title="Update Civitas" aria-label="Update Civitas">
                    <i class="fas fa-save"></i>
                </button>
                <a href="/admin/civitas" class="civitas-form-btn civitas-form-btn--cancel" title="Kembali" aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
