@extends('admin.layouts.app')

@section('css')
<style>
    .user-icon-btn {
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

    .user-icon-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .user-icon-btn--primary {
        background: #4b49ac;
    }

    .user-icon-btn--primary:hover {
        background: #3f3d94;
    }

    .user-icon-btn--warning {
        background: #f59e0b;
    }

    .user-icon-btn--warning:hover {
        background: #d97706;
    }

    .user-icon-btn--danger {
        background: #e11d48;
    }

    .user-icon-btn--danger:hover {
        background: #be123c;
    }
</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Data Pengguna
    </h3>

    <a href="/admin/users/create"
       class="user-icon-btn user-icon-btn--primary"
       title="Tambah Pengguna"
       aria-label="Tambah Pengguna">
        <i class="fas fa-plus"></i>
    </a>

</div>


<div class="card">

    <div class="card-body">

        <x-admin.table-toolbar name="users" label="Cari pengguna: nama, email, peran, atau unit" :paginator="$users" />
<div class="table-responsive">

            <table class="table table-striped align-middle">

                <tr>

                    <th>
                        Nama
                    </th>

                    <th>
                        Email
                    </th>

                    <th width="140">
                        Role
                    </th>

                    <th>
                        Bagian
                    </th>

                    <th width="180">
                        Dibuat
                    </th>

                    <th width="150">
                        Aksi
                    </th>

                </tr>


                @foreach($users as $user)

                <tr>

                    <td>

                        <strong>
                            {{ $user->name }}
                        </strong>

                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>

                        @php
                            $roleBadge = match($user->role) {
                                'super_admin' => 'danger',
                                'admin' => 'primary',
                                'media' => 'warning',
                                'crm' => 'success',
                                'kemahasiswaan' => 'info',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge badge-{{ $roleBadge }}">
                            {{ $roleOptions[$user->role] ?? $user->role }}
                        </span>

                    </td>

                    <td>
                        {{ $user->department ?: '-' }}
                    </td>

                    <td>
                        {{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}
                    </td>

                    <td>

                        <a href="/admin/users/{{ $user->id }}/edit"
                           class="user-icon-btn user-icon-btn--warning"
                           title="Edit Pengguna"
                           aria-label="Edit Pengguna">
                            <i class="fas fa-pen"></i>
                        </a>


                        @if(auth()->id() !== $user->id)
                        <form action="/admin/users/{{ $user->id }}"
                              method="POST"
                              style="display:inline"
                              data-confirm-title="Hapus Pengguna?"
                              data-confirm-text="Akun pengguna yang dihapus tidak bisa dikembalikan."
                              data-confirm-button="Ya, hapus">

                            @csrf
                            @method('DELETE')

                            <button class="user-icon-btn user-icon-btn--danger"
                                    title="Hapus Pengguna"
                                    aria-label="Hapus Pengguna">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </form>
                        @endif

                    </td>

                </tr>

                @endforeach

            @if($users->isEmpty())
<tr><td colspan="6" class="text-center text-muted py-5">Tidak ada data yang ditemukan.</td></tr>
@endif
</table>

        </div>


        <x-admin.table-pagination :paginator="$users" />

    </div>

</div>

<div class="card mt-4">

    <div class="card-body">

        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Permintaan Reset Password</h4>
            <span class="badge badge-danger">{{ ($passwordResetRequests ?? collect())->count() }} Pending</span>
        </div>

        <x-admin.table-toolbar name="passwordResetRequests" label="Cari permintaan reset: nama atau email" :paginator="$passwordResetRequests" />
<div class="table-responsive">

            <table class="table table-striped align-middle">

                <tr>
                    <th>Waktu</th>
                    <th>Nama / Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th width="180">Aksi</th>
                </tr>

                @forelse(($passwordResetRequests ?? collect()) as $resetRequest)
                <tr>
                    <td>{{ optional($resetRequest->requested_at ?? $resetRequest->created_at)->format('d M Y H:i:s') }}</td>
                    <td>
                        <strong>{{ $resetRequest->user->name ?? '-' }}</strong><br>
                        <small class="text-muted">{{ $resetRequest->email }}</small>
                    </td>
                    <td>{{ $roleOptions[$resetRequest->user->role ?? ''] ?? ($resetRequest->user->role ?? '-') }}</td>
                    <td><span class="badge badge-danger text-uppercase">{{ $resetRequest->status }}</span></td>
                    <td>{{ $resetRequest->admin_note ?: 'Menunggu tindakan super admin.' }}</td>
                    <td>
                        <form action="{{ route('admin.password-reset.reset', $resetRequest->id) }}"
                              method="POST"
                              style="display:inline"
                              data-confirm-title="Reset Password?"
                              data-confirm-text="Password baru akan dibuat dan dikirim ke email pengguna."
                              data-confirm-button="Ya, reset">
                            @csrf
                            <button class="user-icon-btn user-icon-btn--primary"
                                    title="Reset Password"
                                    aria-label="Reset Password">
                                <i class="fas fa-key"></i>
                            </button>
                        </form>

                        <form action="{{ route('admin.password-reset.close', $resetRequest->id) }}"
                              method="POST"
                              style="display:inline"
                              data-confirm-title="Tutup Permintaan?"
                              data-confirm-text="Permintaan reset password akan ditutup."
                              data-confirm-button="Ya, tutup">
                            @csrf
                            <button class="user-icon-btn user-icon-btn--danger"
                                    title="Tutup Permintaan"
                                    aria-label="Tutup Permintaan">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada permintaan reset password.</td>
                </tr>
                @endforelse

            </table>

        </div>
<x-admin.table-pagination :paginator="$passwordResetRequests" />

    </div>

</div>

<div class="card mt-4">

    <div class="card-body">

        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
            <h4 class="mb-0">Riwayat Aktivitas Login</h4>
            <span class="badge badge-dark">{{ $loginActivities->count() }} Aktivitas Terakhir</span>
        </div>

        <x-admin.table-toolbar name="loginActivities" label="Cari riwayat login: nama, email, atau status" :paginator="$loginActivities" />
<div class="table-responsive">

            <table class="table table-striped align-middle">

                <tr>
                    <th>Waktu</th>
                    <th>Nama / Email</th>
                    <th>Role</th>
                    <th>Event</th>
                    <th>Status</th>
                    <th>IP</th>
                    <th>Keterangan</th>
                </tr>

                @forelse($loginActivities as $activity)
                <tr>
                    <td>{{ $activity->attempted_at ? $activity->attempted_at->format('d M Y H:i:s') : '-' }}</td>
                    <td>
                        <strong>{{ $activity->name ?: '-' }}</strong><br>
                        <small class="text-muted">{{ $activity->email ?: '-' }}</small>
                    </td>
                    <td>{{ $roleOptions[$activity->role] ?? ($activity->role ?: '-') }}</td>
                    <td class="text-uppercase">{{ $activity->event }}</td>
                    <td>
                        @php
                            $statusBadge = match($activity->status) {
                                'success' => 'success',
                                'failed' => 'danger',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge badge-{{ $statusBadge }}">{{ $activity->status }}</span>
                    </td>
                    <td>{{ $activity->ip_address ?: '-' }}</td>
                    <td>{{ $activity->description ?: '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada riwayat login.</td>
                </tr>
                @endforelse

            </table>

        </div>
<x-admin.table-pagination :paginator="$loginActivities" />

    </div>

</div>

@endsection
