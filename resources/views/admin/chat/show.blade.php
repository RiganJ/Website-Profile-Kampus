@extends('admin.layouts.app')

@section('title', 'Detail Live Chat')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <a href="{{ route('admin.chat.index') }}" class="text-muted small d-inline-flex align-items-center mb-2">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke pusat pesan
                </a>
                <h3 class="mb-1 font-weight-bold">Live Chat: {{ $session->visitor_name }}</h3>
                <p class="mb-0 text-muted">
                    Status: <span id="chat-session-status" class="font-weight-bold text-uppercase">{{ $session->status }}</span>
                    • {{ $session->visitor_email ?: 'Email tidak diisi' }}
                </p>
            </div>

            @if($session->status !== 'ended')
                <form method="POST"
                      action="{{ route('admin.chat.end', $session->id) }}"
                      data-confirm-submit="true"
                      data-confirm-title="Akhiri Chat?"
                      data-confirm-text="Chat ini akan ditutup dan antrian berikutnya akan dipanggil."
                      data-confirm-button="Ya, akhiri">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-phone-slash mr-2"></i> Akhiri Chat
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="font-weight-bold mb-3">Informasi Sesi</h5>
                <div class="mb-3">
                    <div class="text-muted small">Nama Pengunjung</div>
                    <div class="font-weight-bold">{{ $session->visitor_name }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">Email</div>
                    <div class="font-weight-bold">{{ $session->visitor_email ?: '-' }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">Sumber</div>
                    <div class="font-weight-bold text-uppercase">{{ $session->source }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">Antrian Tersisa</div>
                    <div class="font-weight-bold">{{ $waitingCount }}</div>
                </div>
                <div class="mb-0">
                    <div class="text-muted small">Mulai</div>
                    <div class="font-weight-bold">{{ optional($session->started_at)->format('d M Y H:i') ?: '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div id="chat-messages" class="d-flex flex-column" style="max-height: 520px; overflow-y: auto; gap: 12px;">
                    @foreach($session->messages->sortBy('created_at') as $msg)
                        <div class="d-flex {{ $msg->sender === 'admin' ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="px-3 py-2 rounded-lg {{ $msg->sender === 'admin' ? 'bg-primary text-white' : ($msg->sender === 'system' ? 'bg-light border' : 'bg-white border') }}" style="max-width: 75%;">
                                <div class="small font-weight-bold mb-1 text-uppercase">{{ $msg->sender }}</div>
                                <div>{{ $msg->message }}</div>
                                <div class="small mt-2 {{ $msg->sender === 'admin' ? 'text-white-50' : 'text-muted' }}">
                                    {{ optional($msg->created_at)->format('H:i') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($session->status !== 'ended')
                    <form method="POST"
                          action="{{ route('admin.chat.reply', $session->id) }}"
                          class="mt-4"
                          data-skip-global-confirm="true"
                          id="admin-chat-reply-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Tulis balasan untuk pengunjung..." required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="alert alert-light mt-4 mb-0">
                        Chat ini sudah berakhir. Anda masih bisa melihat riwayat percakapannya.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    (function () {
        const chatBox = document.getElementById('chat-messages');
        const statusLabel = document.getElementById('chat-session-status');
        const pollUrl = @json(route('admin.chat.poll', $session->id));
        const replyForm = document.getElementById('admin-chat-reply-form');

        const escapeHtml = (value) => String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

        const renderMessage = (message) => {
            const isAdmin = message.sender === 'admin';
            const isSystem = message.sender === 'system';
            const wrapperClass = isAdmin ? 'justify-content-end' : 'justify-content-start';
            const bubbleClass = isAdmin ? 'bg-primary text-white' : (isSystem ? 'bg-light border' : 'bg-white border');
            const timeClass = isAdmin ? 'text-white-50' : 'text-muted';
            const time = new Date(message.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            return `
                <div class="d-flex ${wrapperClass}">
                    <div class="px-3 py-2 rounded-lg ${bubbleClass}" style="max-width: 75%;">
                        <div class="small font-weight-bold mb-1 text-uppercase">${escapeHtml(message.sender)}</div>
                        <div>${escapeHtml(message.message)}</div>
                        <div class="small mt-2 ${timeClass}">${time}</div>
                    </div>
                </div>
            `;
        };

        const refreshChat = () => {
            fetch(pollUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    statusLabel.textContent = data.session.status;
                    chatBox.innerHTML = data.messages.map(renderMessage).join('');
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(() => {
                    // biarkan state terakhir
                });
        };

        if (replyForm) {
            replyForm.addEventListener('submit', function (event) {
                const input = replyForm.querySelector('input[name="message"]');
                if (!input.value.trim()) {
                    event.preventDefault();
                    return;
                }

                event.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: 'Kirim Balasan?',
                    text: 'Pesan akan langsung dikirim ke pengunjung.',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, kirim',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#ea580c',
                    cancelButtonColor: '#64748b',
                }).then((result) => {
                    if (result.isConfirmed) {
                        replyForm.submit();
                    }
                });
            });
        }

        chatBox.scrollTop = chatBox.scrollHeight;
        setInterval(refreshChat, 6000);
    })();
</script>
@endsection
