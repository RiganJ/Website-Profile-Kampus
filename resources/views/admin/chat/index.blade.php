@extends('admin.layouts.app')

@section('title', 'Pesan & Live Chat')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h3 class="mb-1 font-weight-bold">Pesan & Live Chat</h3>
                <p class="mb-0 text-muted">Inbox aktif dan riwayat percakapan admin ada di halaman ini.</p>
            </div>
            <a href="{{ route('admin.chat.index') }}" class="btn btn-primary">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
            </a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 font-weight-bold">Live Chat Aktif</h5>
                    <span class="badge badge-success">{{ $activeSession ? 'Sedang Berjalan' : 'Kosong' }}</span>
                </div>

                @if($activeSession)
                    <div class="rounded-lg bg-light p-3">
                        <div class="font-weight-bold">{{ $activeSession->visitor_name }}</div>
                        <div class="text-muted small">{{ $activeSession->visitor_email ?: 'Email tidak diisi' }}</div>
                        <div class="text-muted small mt-2">{{ $activeSession->latestMessage->message ?? 'Belum ada pesan terbaru.' }}</div>
                        <a href="{{ route('admin.chat.show', $activeSession->id) }}" class="btn btn-primary btn-sm mt-3">Buka Chat</a>
                    </div>
                @else
                    <div class="rounded-lg border border-dashed p-4 text-center text-muted">
                        Belum ada sesi live chat yang sedang aktif.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 font-weight-bold">Antrian Live Chat</h5>
                    <span class="badge badge-warning">{{ $waitingSessions->count() }} Menunggu</span>
                </div>

                @forelse($waitingSessions as $session)
                    <div class="rounded-lg border p-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-weight-bold">{{ $session->visitor_name }}</div>
                                <div class="small text-muted">{{ $session->visitor_email ?: 'Tanpa email' }}</div>
                            </div>
                            <span class="badge badge-warning">#{{ $loop->iteration }}</span>
                        </div>
                        <div class="small text-muted mt-2">{{ $session->latestMessage->message ?? 'Menunggu admin.' }}</div>
                        <a href="{{ route('admin.chat.show', $session->id) }}" class="btn btn-outline-dark btn-sm mt-3">Lihat Detail</a>
                    </div>
                @empty
                    <div class="rounded-lg border border-dashed p-4 text-center text-muted">
                        Tidak ada antrian live chat saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 font-weight-bold">Pesan Landing Page</h5>
                    <span class="badge badge-info">{{ $contactMessages->count() }} Aktif</span>
                </div>

                @forelse($contactMessages as $message)
                    <a href="{{ route('admin.chat.contact.show', $message->id) }}" class="d-block rounded-lg border p-3 mb-3 text-decoration-none text-dark bg-light">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="font-weight-bold">Form Pesan Masuk</div>
                            <span class="badge {{ $message->is_read ? 'badge-secondary' : 'badge-info' }}">
                                {{ $message->is_read ? 'Dibaca' : 'Baru' }}
                            </span>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small text-muted mb-1">Nama</label>
                            <div class="form-control bg-white">{{ $message->name }}</div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small text-muted mb-1">Email</label>
                            <div class="form-control bg-white">{{ $message->email }}</div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small text-muted mb-1">Subjek</label>
                            <div class="form-control bg-white">{{ $message->subject }}</div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="small text-muted mb-1">Pesan</label>
                            <div class="form-control bg-white" style="height:auto; min-height:72px;">
                                {{ \Illuminate\Support\Str::limit($message->message, 110) }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="rounded-lg border border-dashed p-4 text-center text-muted">
                        Tidak ada pesan aktif dari form landing page.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 font-weight-bold">Riwayat Pesan Form</h5>
                    <span class="badge badge-light">{{ $contactHistory->count() }} Riwayat</span>
                </div>

                <x-admin.table-toolbar name="contactHistory" label="Cari riwayat pesan: nama, email, subjek, atau isi" :paginator="$contactHistory" />
<div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th>Terakhir Diperbarui</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contactHistory as $message)
                                <tr>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td><span class="badge badge-secondary text-uppercase">{{ $message->status }}</span></td>
                                    <td>{{ optional($message->responded_at ?? $message->updated_at ?? $message->created_at)->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.chat.contact.show', $message->id) }}" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat pesan form.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
<x-admin.table-pagination :paginator="$contactHistory" />
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 font-weight-bold">Riwayat Live Chat</h5>
                    <span class="badge badge-light">{{ $recentSessions->count() }} Riwayat</span>
                </div>

                <x-admin.table-toolbar name="recentSessions" label="Cari riwayat chat: nama, email, atau subjek" :paginator="$recentSessions" />
<div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Pengunjung</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Terakhir Aktif</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSessions as $session)
                                <tr>
                                    <td>{{ $session->visitor_name }}</td>
                                    <td>{{ $session->visitor_email ?: '-' }}</td>
                                    <td><span class="badge badge-secondary text-uppercase">{{ $session->status }}</span></td>
                                    <td>{{ optional($session->ended_at ?? $session->last_message_at)->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.chat.show', $session->id) }}" class="btn btn-outline-dark btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat live chat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
<x-admin.table-pagination :paginator="$recentSessions" />
            </div>
        </div>
    </div>
</div>
@endsection
