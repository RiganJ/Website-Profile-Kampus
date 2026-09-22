<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.site-icons')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Universitas Fort De Kock')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/psikologi.css', 'resources/js/app.js'])
    @else
        {{-- Vite manifest not found; use compiled assets if present --}}
        @if (file_exists(public_path('css/psikologi.css')))
            <link rel="stylesheet" href="{{ asset('css/psikologi.css') }}">
        @endif
        @if (file_exists(public_path('js/app.js')))
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
    @endif

    <style>
        .footer-overlay { background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)); }
        .footer-link { transition: all .3s ease; }
        .footer-link:hover { color: var(--accent); padding-left: 6px; }
        .nav-gradient { background: linear-gradient(to bottom, rgba(15,23,42,0.8), rgba(15,23,42,0.4), transparent); }
        .nav-link { text-decoration: none; transition: 0.3s; }
        .nav-link:hover { color: #f97316; }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-item { display: flex; align-items: center; padding: 10px 16px; transition: all .2s ease; }
        .dropdown-item:hover { background: #f1f5f9; padding-left: 20px; color: #f97316; }
        .nav-gray { background: rgba(31, 41, 55, 0.85); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
    </style>
</head>
<body>
@include('layouts.partials.topbar')

<main class="overflow-visible">
    @yield('content')
</main>

<div id="liveChatWidget" class="fixed bottom-6 right-6 z-[60]">
    <button id="liveChatToggle" type="button" class="flex h-16 w-16 items-center justify-center rounded-full bg-[#ea580c] text-white shadow-2xl transition hover:scale-105">
        <i class="bi bi-chat-dots-fill text-2xl"></i>
    </button>

    <div id="liveChatPanel" class="mt-4 hidden w-[360px] max-w-[calc(100vw-2rem)] overflow-hidden rounded-[28px] border border-white/20 bg-white shadow-2xl">
        <div class="bg-[#0f172a] px-5 py-4 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold">Live Chat UFDK</h3>
                    <p class="text-xs text-slate-300">Terhubung ke admin dengan sistem antrian.</p>
                </div>
                <button id="liveChatClose" type="button" class="rounded-full bg-white/10 px-2 py-1 text-xs">Tutup</button>
            </div>
        </div>

        <div id="liveChatIntro" class="space-y-4 p-5">
            <div class="rounded-2xl bg-orange-50 px-4 py-3 text-sm text-slate-700">
                Isi nama dan email dulu, lalu chat Anda akan masuk ke admin. Kalau admin masih melayani pengunjung lain, sistem akan menaruh Anda di antrian.
            </div>
            <div class="space-y-3">
                <input id="chatVisitorName" type="text" class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:border-[#ea580c]" placeholder="Nama Anda">
                <input id="chatVisitorEmail" type="email" class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:border-[#ea580c]" placeholder="Email Anda">
                <input id="chatVisitorPhone" type="text" class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:border-[#ea580c]" placeholder="No. WhatsApp (opsional)">
            </div>
            <button id="startLiveChat" type="button" class="w-full rounded-2xl bg-[#ea580c] px-4 py-3 font-semibold text-white transition hover:bg-[#c84d0a]">Mulai Live Chat</button>
            <div id="liveChatIntroError" class="hidden text-sm text-red-500"></div>
        </div>

        <div id="liveChatConversation" class="hidden">
            <div class="border-b border-slate-100 px-5 py-3">
                <div id="liveChatStatusBadge" class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Menunggu</div>
                <p id="liveChatStatusText" class="mt-2 text-sm text-slate-600">Sesi live chat Anda sedang disiapkan.</p>
            </div>
            <div id="liveChatMessages" class="flex h-[320px] flex-col gap-3 overflow-y-auto bg-slate-50 px-4 py-4"></div>
            <div class="border-t border-slate-100 p-4">
                <div class="flex items-center gap-2">
                    <input id="liveChatMessageInput" type="text" class="min-w-0 flex-1 rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:border-[#ea580c]" placeholder="Tulis pesan Anda...">
                    <button id="sendLiveChatMessage" type="button" class="rounded-2xl bg-[#ea580c] px-4 py-3 text-white transition hover:bg-[#c84d0a]"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.site-footer')

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script>
    AOS.init({ duration:700, once:true, offset:100 });
    lucide.createIcons();
    const mobileBtn = document.getElementById('mobileBtn');
    if (mobileBtn) {
        mobileBtn.addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    }
    let lastScroll = 0;
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', function () {
        const currentScroll = window.pageYOffset;
        if (currentScroll <= 10) {
            navbar.style.transform = 'translateY(0)';
            navbar.classList.remove('nav-gray', 'shadow-lg');
            navbar.classList.add('nav-gradient');
            lastScroll = currentScroll;
            return;
        }
        if (currentScroll > lastScroll) {
            navbar.style.transform = 'translateY(-120%)';
        } else {
            navbar.style.transform = 'translateY(0)';
            navbar.classList.remove('nav-gradient');
            navbar.classList.add('nav-gray', 'shadow-lg');
        }
        lastScroll = currentScroll;
    });
</script>
@stack('scripts')
<script>
(() => {
    const panel = document.getElementById('liveChatPanel');
    const toggle = document.getElementById('liveChatToggle');
    const closeButton = document.getElementById('liveChatClose');
    const intro = document.getElementById('liveChatIntro');
    const introError = document.getElementById('liveChatIntroError');
    const conversation = document.getElementById('liveChatConversation');
    const startButton = document.getElementById('startLiveChat');
    const statusBadge = document.getElementById('liveChatStatusBadge');
    const statusText = document.getElementById('liveChatStatusText');
    const messagesBox = document.getElementById('liveChatMessages');
    const messageInput = document.getElementById('liveChatMessageInput');
    const sendButton = document.getElementById('sendLiveChatMessage');
    if (!panel || !toggle) return;
    const routes = { start: @json(route('chat.start')), send: @json(route('chat.send')), fetch: @json(route('chat.fetch')) };
    const csrfToken = @json(csrf_token());
    let pollTimer = null;
    const escapeHtml = (value) => String(value).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    const setStatus = (session) => {
        if (!session) return;
        const states = {
            waiting: { badge: 'Menunggu', badgeClass: 'bg-amber-100 text-amber-700', text: session.queue_label || 'Chat Anda sedang menunggu antrian.' },
            active: { badge: 'Aktif', badgeClass: 'bg-emerald-100 text-emerald-700', text: 'Admin sudah tersedia. Anda bisa melanjutkan percakapan.' },
            ended: { badge: 'Selesai', badgeClass: 'bg-slate-200 text-slate-700', text: 'Sesi chat sudah diakhiri. Mulai chat baru jika masih butuh bantuan.' },
        };
        const current = states[session.status] || states.waiting;
        statusBadge.className = `inline-flex rounded-full px-3 py-1 text-xs font-semibold ${current.badgeClass}`;
        statusBadge.textContent = current.badge;
        statusText.textContent = current.text;
        messageInput.disabled = session.status === 'ended';
        sendButton.disabled = session.status === 'ended';
    };
    const renderMessages = (messages) => {
        messagesBox.innerHTML = messages.map((message) => {
            const fromVisitor = message.sender === 'visitor';
            const fromSystem = message.sender === 'system';
            const wrapperClass = fromVisitor ? 'items-end' : 'items-start';
            const bubbleClass = fromVisitor ? 'bg-[#ea580c] text-white' : (fromSystem ? 'bg-slate-200 text-slate-700' : 'bg-white border border-slate-200 text-slate-700');
            return `<div class="flex flex-col ${wrapperClass}"><div class="max-w-[85%] rounded-2xl px-4 py-3 text-sm shadow-sm ${bubbleClass}">${escapeHtml(message.message)}</div></div>`;
        }).join('');
        messagesBox.scrollTop = messagesBox.scrollHeight;
    };
    const fetchConversation = () => {
        fetch(routes.fetch, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
            .then((response) => response.json())
            .then((data) => {
                if (!data.session) return;
                intro.classList.add('hidden');
                conversation.classList.remove('hidden');
                setStatus(data.session);
                renderMessages(data.messages || []);
            })
            .catch(() => {});
    };
    const startPolling = () => {
        if (pollTimer) clearInterval(pollTimer);
        fetchConversation();
        pollTimer = setInterval(fetchConversation, 5000);
    };
    toggle.addEventListener('click', () => {
        const isHidden = panel.classList.contains('hidden');
        panel.classList.toggle('hidden', !isHidden);
        if (isHidden) fetchConversation();
    });
    closeButton.addEventListener('click', () => panel.classList.add('hidden'));
    startButton.addEventListener('click', () => {
        introError.classList.add('hidden');
        fetch(routes.start, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({
                name: document.getElementById('chatVisitorName').value,
                email: document.getElementById('chatVisitorEmail').value,
                phone: document.getElementById('chatVisitorPhone').value,
                subject: 'Live Chat Landing Page',
            }),
        })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Gagal memulai live chat.');
                return data;
            })
            .then((data) => {
                intro.classList.add('hidden');
                conversation.classList.remove('hidden');
                setStatus(data.session);
                startPolling();
            })
            .catch((error) => {
                introError.textContent = error.message;
                introError.classList.remove('hidden');
            });
    });
    const sendMessage = () => {
        const message = messageInput.value.trim();
        if (!message) return;
        fetch(routes.send, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({ message }),
        })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Pesan gagal dikirim.');
                return data;
            })
            .then(() => {
                messageInput.value = '';
                fetchConversation();
            })
            .catch((error) => {
                statusText.textContent = error.message;
            });
    };
    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }
    });
    fetchConversation();
    startPolling();
})();
</script>
</body>
</html>
