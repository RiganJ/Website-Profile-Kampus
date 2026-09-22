@extends('admin.layouts.app')

@section('title', 'Edit Dosen')

@section('css')
<style>
    .dosen-form-btn {
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

    .dosen-form-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .dosen-form-btn--save {
        background: #4b49ac;
    }

    .dosen-form-btn--save:hover {
        background: #3f3d94;
    }

    .dosen-form-btn--cancel {
        background: #64748b;
    }

    .dosen-form-btn--cancel:hover {
        background: #475569;
    }

</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Edit Dosen
    </h3>

</div>



<div class="card">

    <div class="card-body">

        <form method="POST"
              action="/admin/dosen/{{ $dosen->id }}"
              enctype="multipart/form-data"
              data-skip-global-confirm="true"
              id="dosen-edit-form">

            @csrf
            @method('PUT')



            <input type="text"
                   name="nip"
                   class="form-control mb-2"
                   placeholder="NIP"
                   value="{{ $dosen->nip }}">


            <input type="text"
                   name="nama"
                   class="form-control mb-2"
                   placeholder="Nama"
                   value="{{ $dosen->nama }}">



            <select name="jenis_kelamin"
                    class="form-control mb-2">

                <option value="L"
                    @if($dosen->jenis_kelamin == 'L') selected @endif>

                    Laki-laki

                </option>



                <option value="P"
                    @if($dosen->jenis_kelamin == 'P') selected @endif>

                    Perempuan

                </option>

            </select>



            <input type="text"
                   name="pendidikan_terakhir"
                   class="form-control mb-2"
                   placeholder="Pendidikan Terakhir"
                   value="{{ $dosen->pendidikan_terakhir }}">



            <input type="text"
                   name="asal_pendidikan"
                   class="form-control mb-2"
                   placeholder="Asal Pendidikan"
                   value="{{ $dosen->asal_pendidikan }}">



            <input type="date"
                   name="tanggal_masuk_kerja"
                   class="form-control mb-2"
                   value="{{ $dosen->tanggal_masuk_kerja }}">



            <input type="text"
                   name="jabatan"
                   class="form-control mb-2"
                   placeholder="Jabatan"
                   value="{{ $dosen->jabatan }}">



            @if($dosen->foto_url)
            <div class="mb-2">
                <img src="{{ $dosen->foto_url }}"
                     width="100"
                     height="100"
                     style="object-fit:cover;border-radius:8px;">
            </div>
            @endif


            <input type="file"
                   name="foto"
                   class="form-control mb-2"
                   accept=".jpg,.jpeg,.png,.webp">



            <textarea name="keterangan"
                      class="form-control mb-2"
                      placeholder="Keterangan (opsional)">{{ $dosen->keterangan }}</textarea>



            <div class="d-flex gap-2">
                <button class="dosen-form-btn dosen-form-btn--save"
                        title="Update Data"
                        aria-label="Update Data">
                    <i class="fas fa-save"></i>
                </button>

                <a href="/admin/dosen"
                   class="dosen-form-btn dosen-form-btn--cancel"
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
    const dosenEditForm = document.getElementById('dosen-edit-form');

    dosenEditForm.addEventListener('submit', function (event) {
        if (dosenEditForm.dataset.confirmed === 'true') {
            return;
        }

        event.preventDefault();

        Swal.fire({
            icon: 'question',
            title: 'Update Data?',
            text: 'Perubahan data dosen akan disimpan.',
            showCancelButton: true,
            confirmButtonText: 'Ya, update',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#4b49ac',
            cancelButtonColor: '#6c757d'
        }).then(function (result) {
            if (result.isConfirmed) {
                dosenEditForm.dataset.confirmed = 'true';
                dosenEditForm.requestSubmit();
            }
        });
    });
</script>
@endsection
