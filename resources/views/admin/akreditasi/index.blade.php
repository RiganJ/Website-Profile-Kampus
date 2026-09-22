@extends('admin.layouts.app')

@section('title', 'Data Akreditasi')

@section('css')
<style>
    .akreditasi-icon-btn {
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

    .akreditasi-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .akreditasi-icon-btn--primary {
        background: #4b49ac;
    }

    .akreditasi-icon-btn--primary:hover {
        background: #3f3d94;
    }

    .akreditasi-icon-btn--warning {
        background: #f59e0b;
    }

    .akreditasi-icon-btn--warning:hover {
        background: #d97706;
    }

    .akreditasi-icon-btn--danger {
        background: #e11d48;
    }

    .akreditasi-icon-btn--danger:hover {
        background: #be123c;
    }

    .akreditasi-icon-btn--info {
        background: #0ea5e9;
    }

    .akreditasi-icon-btn--info:hover {
        background: #0284c7;
    }
</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Data Akreditasi
    </h3>

    <a href="/admin/akreditasi/create"
       class="akreditasi-icon-btn akreditasi-icon-btn--primary"
       title="Tambah Akreditasi"
       aria-label="Tambah Akreditasi">
        <i class="fas fa-plus"></i>
    </a>

</div>



<div class="card">

    <div class="card-body">

        <x-admin.table-toolbar name="accreditations" label="Cari akreditasi: prodi, peringkat, lembaga, atau tahun" :paginator="$accreditations" />
<div class="table-responsive">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th style="width:10%">
                            Jenis
                        </th>

                        <th style="width:15%">
                            Program Studi
                        </th>

                        <th style="width:10%">
                            Predikat
                        </th>

                        <th style="width:8%">
                            Tahun
                        </th>

                        <th style="width:15%">
                            Lembaga
                        </th>

                        <th style="width:12%">
                            Nomor SK
                        </th>

                        <th style="width:12%">
                            Tanggal SK
                        </th>

                        <th style="width:12%">
                            Kadaluarsa
                        </th>

                        <th style="width:8%">
                            File
                        </th>

                        <th style="width:8%">
                            Aksi
                        </th>

                    </tr>

                </thead>



                <tbody>

                    @foreach($accreditations as $a)

                    <tr>

                        <td>
                            {{ ($a->accreditation_type ?? 'program_studi') === 'institusi' ? 'Institusi' : 'Prodi' }}
                        </td>



                        <td>
                            {{ $a->program_studi }}
                        </td>



                        <td>

                            <span class="badge badge-success">

                                {{ $a->predicate }}

                            </span>

                        </td>



                        <td>
                            {{ $a->tahun }}
                        </td>



                        <td>
                            {{ $a->lembaga }}
                        </td>



                        <td>
                            {{ $a->nomor_sk }}
                        </td>



                        <td>

                            {{ $a->tanggal_sk
                                ? date('d M Y', strtotime($a->tanggal_sk))
                                : '-' }}

                        </td>



                        <td>

                            {{ $a->tanggal_kadaluarsa
                                ? date('d M Y', strtotime($a->tanggal_kadaluarsa))
                                : '-' }}

                        </td>



                        <td>

                            @if($a->file)

                                <a href="{{ $a->file_url }}"
                                   target="_blank"
                                   class="akreditasi-icon-btn akreditasi-icon-btn--info"
                                   title="Lihat File"
                                   aria-label="Lihat File">
                                    <i class="fas fa-eye"></i>
                                </a>

                            @else

                                -

                            @endif

                        </td>



                        <td>

                            <a href="/admin/akreditasi/{{ $a->id }}/edit"
                               class="akreditasi-icon-btn akreditasi-icon-btn--warning"
                               title="Edit Akreditasi"
                               aria-label="Edit Akreditasi">
                                <i class="fas fa-pen"></i>
                            </a>



                            <form action="/admin/akreditasi/{{ $a->id }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="akreditasi-icon-btn akreditasi-icon-btn--danger"
                                        title="Hapus Akreditasi"
                                        aria-label="Hapus Akreditasi">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                @if($accreditations->isEmpty())
<tr><td colspan="10" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</tbody>

            </table>

        </div>



        <div class="mt-3">

            <x-admin.table-pagination :paginator="$accreditations" />

        </div>



    </div>

</div>

@endsection
