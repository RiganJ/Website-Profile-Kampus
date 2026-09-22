@extends('admin.layouts.app')

@section('css')
<style>
    .mahasiswa-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        color: #fff;
        transition: .2s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }

    .mahasiswa-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .mahasiswa-icon-btn--primary {
        background: #4b49ac;
    }

    .mahasiswa-icon-btn--primary:hover {
        background: #3f3d94;
    }

    .mahasiswa-icon-btn--warning {
        background: #f59e0b;
    }

    .mahasiswa-icon-btn--warning:hover {
        background: #d97706;
    }

    .mahasiswa-icon-btn--danger {
        background: #e11d48;
    }

    .mahasiswa-icon-btn--danger:hover {
        background: #be123c;
    }
</style>
@endsection

@section('content')

<div class="page-header">

<h3 class="page-title">
Data Mahasiswa
</h3>

<a href="/admin/mahasiswa/create"
class="mahasiswa-icon-btn mahasiswa-icon-btn--primary"
title="Tambah Mahasiswa"
aria-label="Tambah Mahasiswa">
<i class="fas fa-plus"></i>
</a>

</div>


<div class="card">

<div class="card-body">

<x-admin.table-toolbar name="mahasiswa" label="Cari mahasiswa: nama, NIM, angkatan, atau prodi" :paginator="$mahasiswa" />
<table class="table table-striped">

<tr>

<th>NIM</th>
<th>Nama</th>
<th>Prodi</th>
<th>Angkatan</th>
<th>JK</th>
<th>Aksi</th>

</tr>


@foreach($mahasiswa as $mhs)

<tr>

<td>{{$mhs->nim}}</td>
<td>{{$mhs->nama}}</td>
<td>{{ $mhs->prodi->nama_prodi ?? '-' }}</td>
<td>{{$mhs->angkatan}}</td>
<td>{{$mhs->jenis_kelamin}}</td>

<td>

<a href="/admin/mahasiswa/{{$mhs->id}}/edit"
class="mahasiswa-icon-btn mahasiswa-icon-btn--warning"
title="Edit Mahasiswa"
aria-label="Edit Mahasiswa">
<i class="fas fa-pen"></i>
</a>


<form action="/admin/mahasiswa/{{$mhs->id}}"
method="POST"
style="display:inline"
data-skip-global-confirm="true"
class="js-mahasiswa-delete-form">

@csrf
@method('DELETE')

<button class="mahasiswa-icon-btn mahasiswa-icon-btn--danger"
title="Hapus Mahasiswa"
aria-label="Hapus Mahasiswa">
<i class="fas fa-trash-alt"></i>
</button>

</form>

</td>

</tr>

@endforeach


@if($mahasiswa->isEmpty())
<tr><td colspan="6" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>

<x-admin.table-pagination :paginator="$mahasiswa" />

</div>

</div>

@endsection

@section('js')
<script>
document.querySelectorAll('.js-mahasiswa-delete-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (form.dataset.confirmed === 'true') {
            return;
        }

        event.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Hapus Data Mahasiswa?',
            text: 'Jika disetujui, data langsung terhapus.',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
        }).then(function (result) {
            if (result.isConfirmed) {
                form.dataset.confirmed = 'true';
                form.requestSubmit();
            }
        });
    });
});
</script>
@endsection
