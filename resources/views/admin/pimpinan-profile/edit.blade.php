@extends('admin.layouts.app')

@section('title', 'Edit Profil Pimpinan')

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Profil Pimpinan</h3>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/pimpinan-profile/{{ $profile->id }}" data-confirm-submit="true" data-confirm-title="Update Profil?" data-confirm-text="Perubahan profil pimpinan akan disimpan." data-confirm-button="Ya, update">
            @csrf
            @method('PUT')
            @include('admin.pimpinan-profile._form')

            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="fas fa-save"></i></button>
                <a href="/admin/pimpinan-profile" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>
</div>
@endsection
