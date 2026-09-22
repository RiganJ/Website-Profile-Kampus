@extends('admin.layouts.app')

@section('css')
<style>
    .banner-icon-btn {
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

    .banner-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .banner-icon-btn--primary {
        background: #4b49ac;
    }

    .banner-icon-btn--primary:hover {
        background: #3f3d94;
    }

    .banner-icon-btn--warning {
        background: #f59e0b;
    }

    .banner-icon-btn--warning:hover {
        background: #d97706;
    }

    .banner-icon-btn--danger {
        background: #e11d48;
    }

    .banner-icon-btn--danger:hover {
        background: #be123c;
    }

    .banner-icon-btn--info {
        background: #0ea5e9;
    }

    .banner-icon-btn--info:hover {
        background: #0284c7;
    }
</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Data Banner
    </h3>

    <a href="/admin/banner/create"
       class="banner-icon-btn banner-icon-btn--primary"
       title="Tambah Banner"
       aria-label="Tambah Banner">
        <i class="fas fa-plus"></i>
    </a>

</div>



<div class="card">

    <div class="card-body">

        <x-admin.table-toolbar name="slides" label="Cari banner: judul, deskripsi, atau jenis" :paginator="$slides" />
<table class="table table-striped">

            <tr>

                <th>Media</th>
                <th>Tampilan</th>
                <th>Title</th>
                <th>Deskripsi</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>



            @foreach($slides as $s)

            <tr>

                <td>

                    @if($s->media_type == 'image')

                        <img src="{{ $s->media_url }}"
                             width="120">

                    @else

                        <video width="150"
                               controls>

                            <source src="{{ $s->media_url }}">

                        </video>

                    @endif

                    <br>
                    <small class="text-muted">
                        {{ str_starts_with($s->media_path ?? '', 'banner/') ? 'Upload CMS' : 'Manual' }}
                    </small>

                </td>


                <td>

                    @if(($s->media_fit ?? 'fill') == 'fill')
                        Hero penuh
                    @elseif(($s->media_fit ?? 'fill') == 'contain')
                        Foto full
                    @else
                        Crop penuh
                    @endif
                    <br>
                    <small class="text-muted">
                        {{ $s->banner_dimension ?? 'compact' }} | {{ $s->media_position ?? 'center center' }}
                    </small>

                </td>



                <td>

                    {{ $s->title }}

                </td>



                <td>

                    {{ $s->description }}

                </td>



                <td>

                    {{ $s->sort_order ?? 0 }}

                </td>



                <td>

                    @if($s->is_active)

                        Aktif

                    @else

                        Nonaktif

                    @endif

                </td>



                <td>

                    <a href="/admin/banner/{{ $s->id }}/edit"
                       class="banner-icon-btn banner-icon-btn--warning"
                       title="Edit Banner"
                       aria-label="Edit Banner">
                        <i class="fas fa-pen"></i>
                    </a>



                    <a href="/admin/banner/{{ $s->id }}/toggle"
                       class="banner-icon-btn banner-icon-btn--info"
                       title="Ubah Status Banner"
                       aria-label="Ubah Status Banner">
                        <i class="fas fa-toggle-on"></i>
                    </a>



                    <form action="/admin/banner/{{ $s->id }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="banner-icon-btn banner-icon-btn--danger"
                                title="Hapus Banner"
                                aria-label="Hapus Banner">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach



        @if($slides->isEmpty())
<tr><td colspan="7" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>

    </div>
<x-admin.table-pagination :paginator="$slides" />

</div>

@endsection
