@extends('admin.layouts.app')

@section('title', 'Tambah Kerja Sama')

@section('css')
<style>
    .kerjasama-form-btn {
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
    .kerjasama-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .kerjasama-form-btn--save { background: #4b49ac; }
    .kerjasama-form-btn--save:hover { background: #3f3d94; }
    .kerjasama-form-btn--cancel { background: #64748b; }
    .kerjasama-form-btn--cancel:hover { background: #475569; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Tambah Kerja Sama</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/kerjasama"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Simpan Kerja Sama?"
              data-confirm-text="Data kerja sama baru akan disimpan."
              data-confirm-button="Ya, simpan">
            @csrf
            <div class="mb-3"><label class="form-label">Nama Mitra</label><input type="text" name="nama" class="form-control" placeholder="Nama instansi / perusahaan" required></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Tahun Mulai</label><input type="number" name="tahun_mulai" class="form-control" min="1900" max="2100" placeholder="2024" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Tahun Berakhir</label><input type="number" name="tahun_berakhir" class="form-control" min="1900" max="2100" placeholder="2026 (opsional)"></div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Kriteria Mitra</label>
                    <select name="kriteria" class="form-control" required>
                        <option value="1">1 - Industri</option>
                        <option value="2">2 - Pemerintahan</option>
                        <option value="3">3 - Pendidikan</option>
                        <option value="4">4 - NGO</option>
                        <option value="5">5 - Lainnya</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label class="form-label">Skala Kerja Sama</label>
                    <select name="skala" class="form-control" required>
                        <option value="Lokal">Lokal</option>
                        <option value="Nasional" selected>Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>
            </div>
            <div class="mb-3"><label class="form-label">Logo Mitra (opsional)</label><input type="file" name="logo" accept="image/*" class="form-control"></div>
            <div class="d-flex gap-2">
                <button class="kerjasama-form-btn kerjasama-form-btn--save" title="Simpan Kerja Sama" aria-label="Simpan Kerja Sama"><i class="fas fa-save"></i></button>
                <a href="/admin/kerjasama" class="kerjasama-form-btn kerjasama-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
