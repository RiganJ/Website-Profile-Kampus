@extends('admin.layouts.app')

@section('title', 'Detail Pesan Masuk')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <a href="{{ route('admin.chat.index') }}" class="text-muted small d-inline-flex align-items-center mb-2">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke pusat pesan
        </a>
        <h3 class="mb-1 font-weight-bold">Detail Form Pesan Masuk</h3>
        <p class="mb-0 text-muted">Pesan yang dikirim dari form kontak landing page.</p>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="font-weight-bold mb-0">Form Pesan</h5>
                    <span class="badge {{ $contactMessage->is_read ? 'badge-secondary' : 'badge-info' }}">
                        {{ $contactMessage->is_read ? 'Dibaca' : 'Baru' }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="message-name">Nama Lengkap</label>
                    <input id="message-name" type="text" class="form-control" value="{{ $contactMessage->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="message-email">Email Aktif</label>
                    <input id="message-email" type="text" class="form-control" value="{{ $contactMessage->email }}" readonly>
                </div>

                <div class="form-group">
                    <label for="message-subject">Subjek Pesan</label>
                    <input id="message-subject" type="text" class="form-control" value="{{ $contactMessage->subject }}" readonly>
                </div>

                <div class="form-group mb-0">
                    <label for="message-body">Isi Pesan</label>
                    <textarea id="message-body" class="form-control" rows="9" readonly>{{ $contactMessage->message }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="font-weight-bold mb-3">Status Pesan</h5>

                <div class="mb-3">
                    <div class="text-muted small">Status Saat Ini</div>
                    <div class="font-weight-bold text-uppercase">{{ $contactMessage->status }}</div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Diterima</div>
                    <div class="font-weight-bold">{{ optional($contactMessage->created_at)->format('d M Y H:i') }}</div>
                </div>

                <div class="mb-4">
                    <div class="text-muted small">Dibaca</div>
                    <div class="font-weight-bold">{{ optional($contactMessage->read_at)->format('d M Y H:i') ?: '-' }}</div>
                </div>

                <form method="POST"
                      action="{{ route('admin.chat.contact.status', $contactMessage->id) }}"
                      data-confirm-submit="true"
                      data-confirm-title="Perbarui Status?"
                      data-confirm-text="Status pesan akan diperbarui."
                      data-confirm-button="Ya, simpan">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="status">Pilih Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="new" @selected($contactMessage->status === 'new')>Baru</option>
                            <option value="read" @selected($contactMessage->status === 'read')>Sudah Dibaca</option>
                            <option value="responded" @selected($contactMessage->status === 'responded')>Sudah Direspons</option>
                            <option value="closed" @selected($contactMessage->status === 'closed')>Ditutup</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save mr-2"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
