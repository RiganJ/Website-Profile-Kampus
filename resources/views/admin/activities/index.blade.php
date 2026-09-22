@extends('admin.layouts.app')

@section('title', 'Semua Aktivitas Admin')

@section('content')
<div class="page-header">
    <div>
        <h3 class="page-title">Semua Aktivitas Admin</h3>
        <p class="text-muted mb-0">
            {{ auth()->user()->isSuperAdmin() ? 'Menampilkan seluruh aktivitas dari semua role.' : 'Menampilkan aktivitas akun Anda.' }}
        </p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <x-admin.table-toolbar name="activities" label="Cari aktivitas: admin, modul, atau tindakan" :paginator="$activities" />
<div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Role</th>
                        <th>Modul</th>
                        <th>Aksi</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>{{ optional($activity->performed_at)->format('d M Y H:i:s') ?: '-' }}</td>
                            <td>
                                <strong>{{ $activity->name ?: '-' }}</strong><br>
                                <small class="text-muted">{{ $activity->email ?: '-' }}</small>
                            </td>
                            <td>{{ \App\Models\User::roleOptions()[$activity->role] ?? ($activity->role ?: '-') }}</td>
                            <td>{{ $activity->module ?: '-' }}</td>
                            <td class="text-uppercase">{{ $activity->action ?: '-' }}</td>
                            <td>{{ $activity->description ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada aktivitas admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-admin.table-pagination :paginator="$activities" />
    </div>
</div>
@endsection
