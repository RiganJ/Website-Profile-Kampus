@extends('admin.layouts.app')

@section('title', 'Tambah Profil Pimpinan')

@section('content')
<div class="page-header">
    <h3 class="page-title">Tambah Profil Pimpinan</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/pimpinan-profile" data-confirm-submit="true" data-confirm-title="Simpan Profil?" data-confirm-text="Profil pimpinan baru akan disimpan." data-confirm-button="Ya, simpan">
            @csrf
            @include('admin.pimpinan-profile._form')

            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="fas fa-save"></i></button>
                <a href="/admin/pimpinan-profile" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
