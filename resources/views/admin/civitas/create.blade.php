@extends('admin.layouts.app')

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

    .civitas-field label {
        color: #334155;
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Tambah Civitas</h4>

        <form method="POST"
              action="/admin/civitas"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Simpan Civitas?"
              data-confirm-text="Data civitas baru akan disimpan."
              data-confirm-button="Ya, simpan">
            @csrf

            <div class="civitas-field mb-3">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}" class="form-control">
            </div>

            <div class="civitas-field mb-3">
                <label for="nama">Nama Civitas</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap civitas" value="{{ old('nama') }}" class="form-control">
            </div>

            <div class="civitas-field mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="civitas-field mb-3">
                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Contoh: S2 Kesehatan Masyarakat" value="{{ old('pendidikan_terakhir') }}" class="form-control">
            </div>

            <div class="civitas-field mb-3">
                <label for="asal_pendidikan">Asal Pendidikan</label>
                <input type="text" id="asal_pendidikan" name="asal_pendidikan" placeholder="Masukkan asal pendidikan" value="{{ old('asal_pendidikan') }}" class="form-control">
            </div>

            <div class="civitas-field mb-3">
                <label for="tanggal_masuk_kerja">Tanggal Masuk Kerja</label>
                <input type="date" id="tanggal_masuk_kerja" name="tanggal_masuk_kerja" value="{{ old('tanggal_masuk_kerja') }}" class="form-control">
            </div>

            <div class="civitas-field mb-3">
                <label for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan jabatan civitas" value="{{ old('jabatan') }}" class="form-control">
            </div>

            <div class="civitas-field mb-3">
                <label for="foto">Foto Civitas</label>
                <input type="file" id="foto" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <div class="civitas-field mb-3">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan tambahan jika ada" class="form-control">{{ old('keterangan') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="civitas-form-btn civitas-form-btn--save" title="Simpan Civitas" aria-label="Simpan Civitas">
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
