@extends('admin.layouts.app')

@section('css')
<style>
    .prodi-form-btn {
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
    .prodi-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .prodi-form-btn--save { background: #4b49ac; }
    .prodi-form-btn--save:hover { background: #3f3d94; }
    .prodi-form-btn--cancel { background: #64748b; }
    .prodi-form-btn--cancel:hover { background: #475569; }
    .prodi-help-text {
        color: #64748b;
        display: block;
        font-size: 12px;
        margin-top: 6px;
    }
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #e5e7eb;
        min-height: 44px;
        padding: 4px 8px;
    }
    .select2-container--default .select2-selection--single {
        border: 1px solid #e5e7eb;
        height: 44px;
        padding: 6px 8px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #4b49ac;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Tambah Prodi</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/prodi" enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Simpan Prodi?"
              data-confirm-text="Data prodi baru akan disimpan."
              data-confirm-button="Ya, simpan">
            @csrf
            <div class="mb-3"><label>Kode Prodi</label><input type="text" name="kode_prodi" class="form-control" placeholder="contoh: TI" value="{{ old('kode_prodi') }}" required></div>
            <div class="mb-3">
                <label>Nama Prodi</label>
                <select name="nama_prodi" class="form-control" required>
                    <option value="">-- pilih nama prodi --</option>
                    @foreach($namaProdiOptions as $namaProdi)
                        <option value="{{ $namaProdi }}" {{ old('nama_prodi') === $namaProdi ? 'selected' : '' }}>
                            {{ $namaProdi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Nama Kaprodi</label>
                <select name="kaprodi_dosen_id"
                        class="form-control js-kaprodi-select"
                        data-placeholder="Cari dan pilih Kaprodi">
                    <option value=""></option>
                    @foreach($dosenOptions as $dosen)
                        <option value="{{ $dosen->id }}" {{ old('kaprodi_dosen_id') == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="prodi-help-text">Nama dan foto Kaprodi akan mengikuti data dosen yang dipilih.</small>
            </div>
            <div class="mb-3">
                <label>Admin Prodi</label>
                <select name="admin_prodi_civitas_id"
                        class="form-control js-admin-prodi-select"
                        data-placeholder="Cari dan pilih admin prodi">
                    <option value=""></option>
                    @foreach($civitasOptions as $civitas)
                        <option value="{{ $civitas->id }}" {{ old('admin_prodi_civitas_id') == $civitas->id ? 'selected' : '' }}>
                            {{ $civitas->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="prodi-help-text">Data admin prodi diambil dari menu Civitas.</small>
            </div>
            <div class="mb-3">
                <label>Laboran</label>
                <select name="laboran_civitas_ids[]"
                        class="form-control js-admin-prodi-select"
                        data-placeholder="Cari dan pilih laboran"
                        multiple>
                    @foreach($civitasOptions as $civitas)
                        <option value="{{ $civitas->id }}" {{ in_array($civitas->id, old('laboran_civitas_ids', [])) ? 'selected' : '' }}>
                            {{ $civitas->nama }}{{ $civitas->jabatan ? ' — '.$civitas->jabatan : '' }}
                        </option>
                    @endforeach
                </select>
                <small class="prodi-help-text">Dapat memilih lebih dari satu laboran. Ditampilkan pada prodi Fakultas Ilmu Kesehatan.</small>
            </div>
            <div class="mb-4"><label>Fakultas</label><select name="fakultas_id" class="form-control" required><option value="">-- pilih fakultas --</option>@foreach($fakultas as $f)<option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>{{ $f->nama_fakultas }}</option>@endforeach</select></div>
            <div class="border rounded p-3 mb-4">
                <h5 class="mb-3">Hero Halaman Prodi</h5>
                <div class="mb-3">
                    <label>Judul Hero</label>
                    <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title') }}" placeholder="Kosongkan untuk memakai judul bawaan">
                    <small class="prodi-help-text">Judul ini akan tampil di bagian hero halaman prodi.</small>
                </div>
                <div class="mb-3">
                    <label>Deskripsi Hero</label>
                    <textarea name="hero_subtitle" class="form-control" rows="3" placeholder="Kosongkan untuk memakai deskripsi bawaan">{{ old('hero_subtitle') }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Gambar Hero</label>
                    <input type="file" name="hero_image" class="form-control" accept="image/*">
                    <small class="prodi-help-text">Format jpg, jpeg, png, atau webp. Maksimal 4 MB.</small>
                </div>
                <div class="mb-0">
                    <label>Posisi Gambar Hero</label>
                    <input type="text" name="hero_image_position" class="form-control" value="{{ old('hero_image_position') }}" placeholder="contoh: center 35%">
                    <small class="prodi-help-text">Gunakan format CSS object-position. Kosongkan untuk posisi tengah.</small>
                </div>
            </div>
            <div class="mb-4">
                <label>Dosen Pengajar</label>
                <select name="dosen_ids[]"
                        class="form-control js-dosen-select"
                        multiple
                        data-placeholder="Cari dan pilih dosen pengajar">
                    @foreach($dosenOptions as $dosen)
                        <option value="{{ $dosen->id }}" {{ in_array($dosen->id, old('dosen_ids', [])) ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="prodi-help-text">Pilih satu atau lebih dosen dari data dosen yang sudah tersedia.</small>
            </div>
            <div class="d-flex gap-2">
                <button class="prodi-form-btn prodi-form-btn--save" title="Simpan Prodi" aria-label="Simpan Prodi"><i class="fas fa-save"></i></button>
                <a href="/admin/prodi" class="prodi-form-btn prodi-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
        if ($.fn.select2) {
            $('.js-kaprodi-select').select2({
                width: '100%',
                placeholder: 'Cari dan pilih Kaprodi',
                allowClear: true
            });

            $('.js-admin-prodi-select').select2({
                width: '100%',
                placeholder: 'Cari dan pilih admin prodi',
                allowClear: true
            });

            $('.js-dosen-select').select2({
                width: '100%',
                placeholder: 'Cari dan pilih dosen pengajar',
                closeOnSelect: false,
                allowClear: true
            });
        }
    });
</script>
@endsection
