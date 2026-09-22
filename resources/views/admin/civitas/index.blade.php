@extends('admin.layouts.app')

@section('css')
<style>
    .civitas-icon-btn {
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

    .civitas-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .civitas-icon-btn--primary { background: #4b49ac; }
    .civitas-icon-btn--primary:hover { background: #3f3d94; }
    .civitas-icon-btn--warning { background: #f59e0b; }
    .civitas-icon-btn--warning:hover { background: #d97706; }
    .civitas-icon-btn--danger { background: #e11d48; }
    .civitas-icon-btn--danger:hover { background: #be123c; }

    .civitas-import-card {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .civitas-import-form {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .civitas-action-link {
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

    .civitas-action-link:hover {
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .civitas-action-link--csv { background: #0f766e; }
    .civitas-action-link--excel { background: #15803d; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Data Civitas</h3>
    <a href="/admin/civitas/create"
       class="civitas-icon-btn civitas-icon-btn--primary"
       title="Tambah Civitas"
       aria-label="Tambah Civitas">
        <i class="fas fa-plus"></i>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="civitas-import-card">
            <div>
                <h5 class="mb-1">Import / Export Data Civitas</h5>
                <small class="text-muted">
                    Gunakan kolom: nip, nama, jenis_kelamin, pendidikan_terakhir, asal_pendidikan, tanggal_masuk_kerja, jabatan, keterangan.
                </small>
            </div>

            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                <a href="{{ route('civitas.export.csv') }}"
                   class="civitas-action-link civitas-action-link--csv">
                    <i class="fas fa-file-alt"></i>
                    Export CSV
                </a>

                <a href="{{ route('civitas.export.excel') }}"
                   class="civitas-action-link civitas-action-link--excel">
                    <i class="fas fa-file-excel"></i>
                    Export Excel
                </a>
            </div>
        </div>

        <form action="{{ route('civitas.import') }}"
              method="POST"
              enctype="multipart/form-data"
              class="civitas-import-form mb-4"
              data-confirm-submit="true"
              data-confirm-title="Import Data Civitas?"
              data-confirm-text="Data civitas dari file akan ditambahkan atau diperbarui berdasarkan NIP."
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

        <x-admin.table-toolbar name="civitas" label="Cari civitas: nama, NIP, jabatan, atau unit" :paginator="$civitas" />
<div class="table-responsive">
            <table class="table table-striped align-middle">
                <tr>
                    <th width="100">Foto</th>
                    <th width="120">NIP</th>
                    <th>Identitas</th>
                    <th width="80">JK</th>
                    <th>Pendidikan</th>
                    <th>Jabatan</th>
                    <th width="120">Tgl Masuk</th>
                    <th>Ket</th>
                    <th width="150">Aksi</th>
                </tr>

                @forelse($civitas as $item)
                <tr>
                    <td>
                        @if($item->foto_url)
                        <img src="{{ $item->foto_url }}" width="60" height="60" style="object-fit:cover;border-radius:8px;">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->nip ?? '-' }}</td>
                    <td>
                        <strong>{{ $item->nama }}</strong>
                    </td>
                    <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                    <td>
                        {{ $item->pendidikan_terakhir ?? '-' }}
                        <br>
                        <small class="text-muted">{{ $item->asal_pendidikan ?? '-' }}</small>
                    </td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->tanggal_masuk_kerja ? date('d M Y', strtotime($item->tanggal_masuk_kerja)) : '-' }}</td>
                    <td><small>{{ Str::limit($item->keterangan, 40) }}</small></td>
                    <td>
                        <a href="/admin/civitas/{{ $item->id }}/edit"
                           class="civitas-icon-btn civitas-icon-btn--warning"
                           title="Edit Civitas"
                           aria-label="Edit Civitas">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="/admin/civitas/{{ $item->id }}"
                              method="POST"
                              style="display:inline"
                              data-skip-global-confirm="true"
                              class="js-civitas-delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="civitas-icon-btn civitas-icon-btn--danger"
                                    title="Hapus Civitas"
                                    aria-label="Hapus Civitas">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">Data belum tersedia</td>
                </tr>
                @endforelse
            </table>
        </div>

        <x-admin.table-pagination :paginator="$civitas" />
    </div>
</div>
@endsection

@section('js')
<script>
    document.querySelectorAll('.js-civitas-delete-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data Civitas?',
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
