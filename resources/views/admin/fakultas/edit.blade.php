@extends('admin.layouts.app')

@section('css')
<style>
    .fakultas-form-btn {
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
    .fakultas-form-btn:hover { transform: translateY(-1px); color: #fff; }
    .fakultas-form-btn--save { background: #4b49ac; }
    .fakultas-form-btn--save:hover { background: #3f3d94; }
    .fakultas-form-btn--cancel { background: #64748b; }
    .fakultas-form-btn--cancel:hover { background: #475569; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Fakultas</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/fakultas/{{ $fakultas->id }}"
              data-confirm-submit="true"
              data-confirm-title="Update Fakultas?"
              data-confirm-text="Perubahan data fakultas akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')
            <div class="mb-3"><label>Kode Fakultas</label><input type="text" name="kode_fakultas" class="form-control" value="{{ $fakultas->kode_fakultas }}" required></div>
            <div class="mb-3"><label>Nama Fakultas</label><input type="text" name="nama_fakultas" class="form-control" value="{{ $fakultas->nama_fakultas }}" required></div>
            <div class="mb-4"><label>Dekan</label><input type="text" name="dekan" class="form-control" value="{{ $fakultas->dekan }}" required></div>
            <div class="d-flex gap-2">
                <button class="fakultas-form-btn fakultas-form-btn--save" title="Update Fakultas" aria-label="Update Fakultas"><i class="fas fa-save"></i></button>
                <a href="/admin/fakultas" class="fakultas-form-btn fakultas-form-btn--cancel" title="Kembali" aria-label="Kembali"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
