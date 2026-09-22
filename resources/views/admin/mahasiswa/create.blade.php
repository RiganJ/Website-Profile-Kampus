@extends('admin.layouts.app')

@section('css')
<style>
    .mahasiswa-form-btn {
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

    .mahasiswa-form-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .mahasiswa-form-btn--save {
        background: #4b49ac;
    }

    .mahasiswa-form-btn--save:hover {
        background: #3f3d94;
    }

    .mahasiswa-form-btn--cancel {
        background: #64748b;
    }

    .mahasiswa-form-btn--cancel:hover {
        background: #475569;
    }
</style>
@endsection

@section('content')

<div class="card">

<div class="card-body">

<h4>Tambah Mahasiswa</h4>


<form method="POST"
action="/admin/mahasiswa"
data-skip-global-confirm="true"
id="mahasiswa-create-form">

@csrf


<input type="text"
name="nim"
placeholder="NIM"
class="form-control mb-2">


<input type="text"
name="nama"
placeholder="Nama"
class="form-control mb-2">


<select name="prodi_id"
class="form-control mb-2">
<option value="">Pilih Prodi</option>
@foreach($prodi as $item)
<option value="{{ $item->id }}" {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
{{ $item->nama_prodi }}
</option>
@endforeach
</select>


<input type="number"
name="angkatan"
placeholder="Angkatan"
class="form-control mb-2">


<select name="jenis_kelamin"
class="form-control mb-2">

<option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
Laki-laki
</option>

<option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
Perempuan
</option>

</select>


<div class="d-flex gap-2">
<button class="mahasiswa-form-btn mahasiswa-form-btn--save"
title="Simpan Data"
aria-label="Simpan Data">
<i class="fas fa-save"></i>
</button>

<a href="/admin/mahasiswa"
class="mahasiswa-form-btn mahasiswa-form-btn--cancel"
title="Kembali"
aria-label="Kembali">
<i class="fas fa-arrow-left"></i>
</a>
</div>


</form>

</div>

</div>

@endsection

@section('js')
<script>
const mahasiswaCreateForm = document.getElementById('mahasiswa-create-form');

mahasiswaCreateForm.addEventListener('submit', function (event) {
    if (mahasiswaCreateForm.dataset.confirmed === 'true') {
        return;
    }

    event.preventDefault();

    Swal.fire({
        icon: 'question',
        title: 'Simpan Data?',
        text: 'Data mahasiswa baru akan disimpan.',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#4b49ac',
        cancelButtonColor: '#6c757d'
    }).then(function (result) {
        if (result.isConfirmed) {
            mahasiswaCreateForm.dataset.confirmed = 'true';
            mahasiswaCreateForm.requestSubmit();
        }
    });
});
</script>
@endsection
