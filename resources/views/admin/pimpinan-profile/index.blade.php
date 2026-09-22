@extends('admin.layouts.app')

@section('title', 'Profil Pimpinan')

@section('css')
<style>
    .leader-icon-btn {
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
    .leader-icon-btn:hover { transform: translateY(-1px); color: #fff; }
    .leader-icon-btn--primary { background: #4b49ac; }
    .leader-icon-btn--warning { background: #f59e0b; }
    .leader-icon-btn--danger { background: #e11d48; }
    .leader-icon-btn--info { background: #0ea5e9; }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Profil Pimpinan</h3>
    <a href="/admin/pimpinan-profile/create" class="leader-icon-btn leader-icon-btn--primary" title="Tambah Profil" aria-label="Tambah Profil"><i class="fas fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="profiles" label="Cari pimpinan: nama, jabatan, atau email" :paginator="$profiles" />
<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Slug</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profiles as $profile)
                        <tr>
                            <td><img src="{{ $profile->photo_url }}" width="72" height="82" style="object-fit:cover; object-position:top; border-radius:10px;" alt="{{ $profile->name }}"></td>
                            <td>{{ $profile->name }}</td>
                            <td>{{ $profile->position }}</td>
                            <td><code>{{ $profile->slug }}</code></td>
                            <td>{{ $profile->sort_order }}</td>
                            <td>
                                <span class="badge {{ $profile->is_active ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $profile->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('pimpinan.show', $profile->slug) }}" target="_blank" class="leader-icon-btn leader-icon-btn--info" title="Lihat Profil" aria-label="Lihat Profil"><i class="fas fa-eye"></i></a>
                                <a href="/admin/pimpinan-profile/{{ $profile->id }}/edit" class="leader-icon-btn leader-icon-btn--warning" title="Edit Profil" aria-label="Edit Profil"><i class="fas fa-pen"></i></a>
                                <form action="/admin/pimpinan-profile/{{ $profile->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="leader-icon-btn leader-icon-btn--danger" title="Hapus Profil" aria-label="Hapus Profil"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Data profil pimpinan belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3"><x-admin.table-pagination :paginator="$profiles" /></div>
    </div>
</div>
@endsection
