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

<h4>Edit Mahasiswa</h4>


<form method="POST"
action="/admin/mahasiswa/{{$mhs->id}}"
data-skip-global-confirm="true"
id="mahasiswa-edit-form">

@csrf
@method('PUT')


<input type="text"
name="nim"
value="{{$mhs->nim}}"
class="form-control mb-2">


<input type="text"
name="nama"
value="{{$mhs->nama}}"
class="form-control mb-2">


<select name="prodi_id"
class="form-control mb-2">
@foreach($prodi as $item)
<option value="{{ $item->id }}"
{{ old('prodi_id', $mhs->prodi_id) == $item->id ? 'selected' : '' }}>
{{ $item->nama_prodi }}
</option>
@endforeach
</select>


<input type="number"
name="angkatan"
value="{{$mhs->angkatan}}"
class="form-control mb-2">


<select name="jenis_kelamin"
class="form-control mb-2">

<option value="L"
{{$mhs->jenis_kelamin=='L'?'selected':''}}>
Laki-laki
</option>

<option value="P"
{{$mhs->jenis_kelamin=='P'?'selected':''}}>
Perempuan
</option>

</select>


<div class="d-flex gap-2">
<button class="mahasiswa-form-btn mahasiswa-form-btn--save"
title="Update Data"
aria-label="Update Data">
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
const mahasiswaEditForm = document.getElementById('mahasiswa-edit-form');

mahasiswaEditForm.addEventListener('submit', function (event) {
    if (mahasiswaEditForm.dataset.confirmed === 'true') {
        return;
    }

    event.preventDefault();

    Swal.fire({
        icon: 'question',
        title: 'Update Data?',
        text: 'Perubahan data mahasiswa akan disimpan.',
        showCancelButton: true,
        confirmButtonText: 'Ya, update',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#4b49ac',
        cancelButtonColor: '#6c757d'
    }).then(function (result) {
        if (result.isConfirmed) {
            mahasiswaEditForm.dataset.confirmed = 'true';
            mahasiswaEditForm.requestSubmit();
        }
    });
});
</script>
@endsection
