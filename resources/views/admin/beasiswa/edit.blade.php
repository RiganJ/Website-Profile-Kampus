@extends('admin.layouts.app')

@section('title','Edit Data Beasiswa')

@section('css')
<style>
    .beasiswa-form-btn {
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
    .beasiswa-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .beasiswa-form-btn--save { background: #4b49ac; }
    .beasiswa-form-btn--save:hover { background: #3f3d94; }
    .beasiswa-form-btn--cancel { background: #64748b; }
    .beasiswa-form-btn--cancel:hover { background: #475569; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Data Beasiswa Mahasiswa</h3>
</div>

<div class="card">
    <div class="card-body">
        <form action="/admin/beasiswa/{{ $beasiswa->id }}"
              method="POST"
              data-confirm-submit="true"
              data-confirm-title="Update Beasiswa?"
              data-confirm-text="Perubahan data beasiswa akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')
            <div class="form-group"><label>Nama Mahasiswa</label><input type="text" name="nama_mahasiswa" value="{{ $beasiswa->nama_mahasiswa }}" class="form-control" required></div>
            <div class="form-group"><label>Jenis Beasiswa</label><input type="text" name="jenis_beasiswa" value="{{ $beasiswa->jenis_beasiswa }}" class="form-control" required></div>
            <div class="form-group"><label>Program Studi</label><input type="text" name="prodi" value="{{ $beasiswa->prodi }}" class="form-control" required></div>
            <div class="form-group"><label>Angkatan</label><input type="number" name="angkatan" value="{{ $beasiswa->angkatan }}" class="form-control" required></div>
            <div class="form-group"><label>Tahun Beasiswa</label><input type="number" name="tahun" value="{{ $beasiswa->tahun }}" class="form-control" required></div>
            <div class="d-flex gap-2">
                <button class="beasiswa-form-btn beasiswa-form-btn--save" title="Update Beasiswa" aria-label="Update Beasiswa"><i class="fas fa-save"></i></button>
                <a href="/admin/beasiswa" class="beasiswa-form-btn beasiswa-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
