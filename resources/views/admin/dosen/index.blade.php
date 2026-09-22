@extends('admin.layouts.app')

@section('css')
<style>
    .dosen-icon-btn {
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

    .dosen-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .dosen-icon-btn--primary {
        background: #4b49ac;
    }

    .dosen-icon-btn--primary:hover {
        background: #3f3d94;
    }

    .dosen-icon-btn--warning {
        background: #f59e0b;
    }

    .dosen-icon-btn--warning:hover {
        background: #d97706;
    }

    .dosen-icon-btn--danger {
        background: #e11d48;
    }

    .dosen-icon-btn--danger:hover {
        background: #be123c;
    }

    .dosen-import-card {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .dosen-import-form {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .dosen-action-link {
        align-items: center;
        border-radius: 10px;
        color: #fff;
        display: inline-flex;
        font-size: 13px;
        font-weight: 600;
        gap: 7px;
        padding: 10px 14px;
        transition: .2s ease;
    }

    .dosen-action-link:hover {
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .dosen-action-link--csv {
        background: #0f766e;
    }

    .dosen-action-link--excel {
        background: #15803d;
    }
</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Data Dosen
    </h3>

    <a href="/admin/dosen/create"
       class="dosen-icon-btn dosen-icon-btn--primary"
       title="Tambah Dosen"
       aria-label="Tambah Dosen">
        <i class="fas fa-plus"></i>
    </a>

</div>



<div class="card">

    <div class="card-body">

        <div class="dosen-import-card">
            <div>
                <h5 class="mb-1">Import / Export Data Dosen</h5>
                <small class="text-muted">
                    Gunakan kolom: nip, nama, jenis_kelamin, pendidikan_terakhir, asal_pendidikan, tanggal_masuk_kerja, jabatan, keterangan.
                </small>
            </div>

            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                <a href="{{ route('dosen.export.csv') }}"
                   class="dosen-action-link dosen-action-link--csv">
                    <i class="fas fa-file-alt"></i>
                    Export CSV
                </a>

                <a href="{{ route('dosen.export.excel') }}"
                   class="dosen-action-link dosen-action-link--excel">
                    <i class="fas fa-file-excel"></i>
                    Export Excel
                </a>
            </div>
        </div>

        <form action="{{ route('dosen.import') }}"
              method="POST"
              enctype="multipart/form-data"
              class="dosen-import-form mb-4"
              data-confirm-submit="true"
              data-confirm-title="Import Data Dosen?"
              data-confirm-text="Data dosen dari file akan ditambahkan atau diperbarui berdasarkan NIP."
              data-confirm-button="Ya, import">
            @csrf
            <input type="file"
                   name="file"
                   class="form-control"
                   accept=".csv,.txt,.xlsx"
                   required
                   style="max-width: 360px;">

            <button class="btn btn-primary" type="submit">
                <i class="fas fa-upload mr-1"></i>
                Import CSV/XLSX
            </button>
        </form>

        <x-admin.table-toolbar name="dosen" label="Cari dosen: nama, NIP, atau jabatan" :paginator="$dosen" />
<div class="table-responsive">

            <table class="table table-striped align-middle">

                <tr>

                    <th width="100">
                        Foto
                    </th>

                    <th width="120">
                        NIP
                    </th>

                    <th>
                        Identitas
                    </th>

                    <th width="80">
                        JK
                    </th>

                    <th>
                        Pendidikan
                    </th>

                    <th>
                        Jabatan
                    </th>

                    <th width="120">
                        Tgl Masuk
                    </th>

                    <th>
                        Ket
                    </th>

                    <th width="150">
                        Aksi
                    </th>

                </tr>



                @foreach($dosen as $d)

                <tr>

                    <td>

                        @if($d->foto_url)
                        <img src="{{ $d->foto_url }}"
                             width="60"
                             height="60"
                             style="object-fit:cover;border-radius:8px;">
                        @else
                        <span class="text-muted">
                            -
                        </span>
                        @endif

                    </td>

                    <td>

                        {{ $d->nip }}

                    </td>


                    <td>

                        <strong>

                            {{ $d->nama }}

                        </strong>

                    </td>


                    <td>

                        {{ $d->jenis_kelamin }}

                    </td>



                    <td>

                        {{ $d->pendidikan_terakhir }}

                        <br>

                        <small class="text-muted">

                            {{ $d->asal_pendidikan }}

                        </small>

                    </td>



                    <td>

                        {{ $d->jabatan }}

                    </td>


                    <td>

                        {{ date('d M Y', strtotime($d->tanggal_masuk_kerja)) }}

                    </td>



                    <td>

                        <small>

                            {{ Str::limit($d->keterangan, 40) }}

                        </small>

                    </td>



                    <td>

                        <a href="/admin/dosen/{{ $d->id }}/edit"
                           class="dosen-icon-btn dosen-icon-btn--warning"
                           title="Edit Dosen"
                           aria-label="Edit Dosen">
                            <i class="fas fa-pen"></i>
                        </a>



                        <form action="/admin/dosen/{{ $d->id }}"
                              method="POST"
                              style="display:inline"
                              data-skip-global-confirm="true"
                              class="js-dosen-delete-form">

                            @csrf
                            @method('DELETE')

                            <button class="dosen-icon-btn dosen-icon-btn--danger"
                                    title="Hapus Dosen"
                                    aria-label="Hapus Dosen">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach



            @if($dosen->isEmpty())
<tr><td colspan="9" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>

        </div>



        <x-admin.table-pagination :paginator="$dosen" />

    </div>

</div>

@endsection

@section('js')
<script>
    document.querySelectorAll('.js-dosen-delete-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data Dosen?',
                text: 'Jika disetujui, data langsung terhapus beserta foto yang tersimpan.',
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
