<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="{{ url('/admin') }}"><img src="{{ asset('images/logoufdk.png') }}" alt="Logo UFDK"/><span class="admin-brand-copy"><strong>UFDK<span style="color:#c75013">.</span></strong><small>Ruang Administrasi</small></span></a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('/admin') }}"><img src="{{ asset('images/logoufdk.png') }}" alt="logo"/></a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-admin-menu="desktop" aria-label="Buka atau tutup navigasi" aria-controls="sidebar" aria-expanded="true">
        <span class="fas fa-bars"></span>
      </button>

      <ul class="navbar-nav">
        <li class="nav-item nav-search d-none d-md-flex">
          <div class="nav-link">
            <div class="font-weight-semibold text-dark">Ruang kerja admin</div>
            <small class="text-muted">Universitas Fort De Kock</small>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav navbar-nav-right">
<li class="nav-item d-none d-xl-block"><a class="nav-link admin-visit-site" href="{{ url('/') }}" target="_blank" rel="noopener"><i class="fas fa-external-link-alt" aria-hidden="true"></i> Lihat website</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" aria-label="Notifikasi pesan" href="#" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-envelope mx-0"></i>
            <span class="count js-message-count" style="{{ ($unreadMessageCount ?? 0) > 0 ? '' : 'display:none;' }}">{{ $unreadMessageCount ?? 0 }}</span>
          </a>

          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown" style="min-width: 360px;">
            <div class="dropdown-item">
              <p class="mb-0 font-weight-normal float-left">Pesan baru dan antrian live chat</p>
              <a href="{{ route('admin.chat.index') }}" class="badge badge-info badge-pill float-right">Lihat semua</a>
            </div>
            <div class="dropdown-divider"></div>

            <div id="admin-message-feed">
              @forelse(($contactNotifications ?? collect()) as $message)
                <a class="dropdown-item preview-item" href="{{ route('admin.chat.contact.show', $message->id) }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="far fa-envelope mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-medium">{{ $message->subject }}</h6>
                    <p class="font-weight-light small-text mb-0">{{ $message->name }} mengirim pesan</p>
                    <p class="font-weight-light small-text text-muted mb-0">{{ optional($message->created_at)->diffForHumans() }}</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              @empty
              @endforelse

              @foreach(($passwordResetRequests ?? collect()) as $resetRequest)
                <a class="dropdown-item preview-item" href="{{ url('/admin/users') }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-danger">
                      <i class="fas fa-key mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-medium">Reset Password</h6>
                    <p class="font-weight-light small-text mb-0">{{ $resetRequest->email }} meminta reset password</p>
                    <p class="font-weight-light small-text text-muted mb-0">{{ optional($resetRequest->requested_at ?? $resetRequest->created_at)->diffForHumans() }}</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              @endforeach

              @foreach(($chatNotifications ?? collect()) as $session)
                <a class="dropdown-item preview-item" href="{{ route('admin.chat.show', $session->id) }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon {{ $session->status === 'waiting' ? 'bg-warning' : 'bg-success' }}">
                      <i class="fas fa-comments mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-medium">{{ $session->visitor_name }}</h6>
                    <p class="font-weight-light small-text mb-0">
                      {{ $session->status === 'waiting' ? 'Menunggu antrian live chat' : ($session->latestMessage->message ?? 'Live chat aktif') }}
                    </p>
                    <p class="font-weight-light small-text text-muted mb-0">{{ optional($session->last_message_at ?? $session->created_at)->diffForHumans() }}</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              @endforeach

              @if(($contactNotifications ?? collect())->isEmpty() && ($chatNotifications ?? collect())->isEmpty())
                <div class="px-4 py-3 text-center text-muted small">Belum ada pesan baru.</div>
              @endif
            </div>
          </div>
        </li>

        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-label="Menu akun">
            @if(auth()->user()->profile_photo)
                <img src="{{ auth()->user()->profile_photo_url }}" alt="Foto profil"/>
            @else
                <span class="admin-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <div class="dropdown-item-text px-3 py-2">
              <div class="font-weight-bold">{{ auth()->user()->name ?? 'Admin' }}</div>
              <small class="text-muted">{{ \App\Models\User::roleOptions()[auth()->user()->role] ?? 'Admin' }}</small>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
              <i class="fas fa-user-cog text-primary"></i>
              Pengaturan Profil
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('admin.chat.index') }}">
              <i class="fas fa-comments text-primary"></i>
              Pesan & Live Chat
            </a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="dropdown-item border-0 bg-transparent w-100 text-left">
                <i class="fas fa-power-off text-danger"></i>
                Logout
              </button>
            </form>
          </div>
        </li>

        <li class="nav-item nav-settings d-none d-lg-block">
          <a class="nav-link" aria-label="Pesan dan live chat" href="{{ route('admin.chat.index') }}">
            <i class="fas fa-comments"></i>
          </a>
        </li>
      </ul>

      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-admin-menu="mobile" aria-label="Buka navigasi" aria-controls="sidebar" aria-expanded="false">
        <span class="fas fa-bars"></span>
      </button>
    </div>
  </nav>

<script>
    (function () {
      const feedContainer = document.getElementById('admin-message-feed');
      const countBadge = document.querySelector('.js-message-count');
      const feedUrl = @json(route('admin.chat.notifications'));

      if (!feedContainer || !feedUrl) {
        return;
      }

      const renderItem = (item) => {
        const colorClass = item.type === 'contact'
          ? 'bg-info'
          : (item.description.includes('Menunggu') ? 'bg-warning' : 'bg-success');
        const iconClass = item.type === 'contact' ? 'far fa-envelope' : 'fas fa-comments';

        return `
          <a class="dropdown-item preview-item" href="${item.url}">
            <div class="preview-thumbnail">
              <div class="preview-icon ${colorClass}">
                <i class="${iconClass} mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content flex-grow">
              <h6 class="preview-subject ellipsis font-weight-medium">${item.title}</h6>
              <p class="font-weight-light small-text mb-0">${item.description}</p>
              <p class="font-weight-light small-text text-muted mb-0">${item.time}</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
        `;
      };

      const refreshFeed = () => {
        fetch(feedUrl, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
          },
        })
          .then((response) => response.json())
          .then((data) => {
            if (countBadge) {
              if (data.count > 0) {
                countBadge.textContent = data.count;
                countBadge.style.display = 'inline-block';
              } else {
                countBadge.style.display = 'none';
              }
            }

            if (!Array.isArray(data.items) || data.items.length === 0) {
              feedContainer.innerHTML = '<div class="px-4 py-3 text-center text-muted small">Belum ada pesan baru.</div>';
              return;
            }

            feedContainer.innerHTML = data.items.map(renderItem).join('');
          })
          .catch(() => {
            // biarkan feed terakhir tetap tampil
          });
      };

      setInterval(refreshFeed, 12000);
    })();
</script>
