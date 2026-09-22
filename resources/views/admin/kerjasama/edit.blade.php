@extends('admin.layouts.app')

@section('title', 'Edit Kerja Sama')

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
    <h3 class="page-title">Edit Kerja Sama</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/kerjasama/{{ $kerjasama->id }}"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Update Kerja Sama?"
              data-confirm-text="Perubahan data kerja sama akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')
            <div class="mb-3"><label class="form-label">Nama Mitra</label><input type="text" name="nama" class="form-control" value="{{ $kerjasama->nama ?? $kerjasama->partner_mou }}" required></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Tahun Mulai</label><input type="number" name="tahun_mulai" class="form-control" min="1900" max="2100" value="{{ $kerjasama->tahun_mulai ?? (isset($kerjasama->tanggal_mulai) ? date('Y', strtotime($kerjasama->tanggal_mulai)) : '') }}" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Tahun Berakhir</label><input type="number" name="tahun_berakhir" class="form-control" min="1900" max="2100" value="{{ $kerjasama->tahun_berakhir ?? (isset($kerjasama->tanggal_berakhir) ? date('Y', strtotime($kerjasama->tanggal_berakhir)) : '') }}"></div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Kriteria Mitra</label>
                    <select name="kriteria" class="form-control" required>
                        <option value="1" {{ ( ($kerjasama->kriteria ?? $kerjasama->kriteria_mitra) == 1) ? 'selected' : '' }}>1 - Industri</option>
                        <option value="2" {{ ( ($kerjasama->kriteria ?? $kerjasama->kriteria_mitra) == 2) ? 'selected' : '' }}>2 - Pemerintahan</option>
                        <option value="3" {{ ( ($kerjasama->kriteria ?? $kerjasama->kriteria_mitra) == 3) ? 'selected' : '' }}>3 - Pendidikan</option>
                        <option value="4" {{ ( ($kerjasama->kriteria ?? $kerjasama->kriteria_mitra) == 4) ? 'selected' : '' }}>4 - NGO</option>
                        <option value="5" {{ ( ($kerjasama->kriteria ?? $kerjasama->kriteria_mitra) == 5) ? 'selected' : '' }}>5 - Lainnya</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label class="form-label">Skala Kerja Sama</label>
                    <select name="skala" class="form-control" required>
                        <option value="Lokal" {{ $kerjasama->skala == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                        <option value="Nasional" {{ $kerjasama->skala == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="Internasional" {{ $kerjasama->skala == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                    </select>
                </div>
            </div>
            <div class="mb-3"><label class="form-label">Logo Mitra (opsional)</label><input type="file" name="logo" accept="image/*" class="form-control"></div>
            @if(!empty($kerjasama->logo) && file_exists(public_path($kerjasama->logo)))
                <div class="mb-3">
                    <label class="form-label">Logo Saat Ini</label>
                    <div><img src="{{ asset($kerjasama->logo) }}" alt="logo" style="max-height:80px"></div>
                </div>
            @endif
            <div class="d-flex gap-2">
                <button class="kerjasama-form-btn kerjasama-form-btn--save" title="Update Kerja Sama" aria-label="Update Kerja Sama"><i class="fas fa-save"></i></button>
                <a href="/admin/kerjasama" class="kerjasama-form-btn kerjasama-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
