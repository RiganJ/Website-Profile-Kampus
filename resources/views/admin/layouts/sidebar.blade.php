@php
    $user = auth()->user();
    $groups = [
        'Ringkasan' => [
            ['dashboard', '/admin', 'Dashboard', 'fa-th-large'],
        ],
        'Data kampus' => [
            ['mahasiswa', '/admin/mahasiswa', 'Mahasiswa', 'fa-user-graduate'],
            ['dosen', '/admin/dosen', 'Dosen', 'fa-chalkboard-teacher'],
            ['civitas', '/admin/civitas', 'Civitas', 'fa-users'],
            ['prodi', '/admin/prodi', 'Program Studi', 'fa-book-open'],
            ['fakultas', '/admin/fakultas', 'Fakultas', 'fa-university'],
            ['guru_besar', '/admin/guru-besar', 'Guru Besar', 'fa-user-tie'],
            ['beasiswa', '/admin/beasiswa', 'Beasiswa', 'fa-graduation-cap'],
        ],
        'Konten website' => [
            ['berita', '/admin/berita', 'Berita', 'fa-newspaper'],
            ['banner', '/admin/banner', 'Banner', 'fa-image'],
            ['prodi', '/admin/prodi-hero', 'Hero Program Studi', 'fa-images'],
            ['pimpinan_profile', '/admin/pimpinan-profile', 'Profil Pimpinan', 'fa-id-card'],
            ['akreditasi', '/admin/akreditasi', 'Akreditasi', 'fa-award'],
            ['panduan_akademik', '/admin/panduan-akademik', 'Pusat Informasi', 'fa-file-alt'],
            ['kerjasama', '/admin/kerjasama', 'Kerja Sama', 'fa-handshake'],
        ],
        'Komunikasi & akses' => [
            ['chat', '/admin/chat', 'Pesan & Live Chat', 'fa-comments'],
            ['users', '/admin/users', 'Kelola Pengguna', 'fa-user-shield'],
        ],
    ];
@endphp
<nav class="sidebar" id="sidebar" aria-label="Navigasi utama admin">
    <div class="admin-mobile-close"><button type="button" data-admin-menu-close aria-label="Tutup navigasi"><i class="fas fa-times" aria-hidden="true"></i> Tutup</button></div>
    <div class="admin-profile">
        @if($user->profile_photo)
            <img src="{{ $user->profile_photo_url }}" alt="Foto profil {{ $user->name }}">
        @else
            <span class="admin-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
        @endif
        <div><strong>{{ $user->name }}</strong><small>{{ \App\Models\User::roleOptions()[$user->role] ?? 'Admin' }}</small></div>
    </div>
    <ul class="nav">
        @foreach($groups as $group => $items)
            @php $visibleItems = array_filter($items, fn ($item) => $user->canAccessModule($item[0])); @endphp
            @if(count($visibleItems))
                <li class="admin-nav-group">{{ $group }}</li>
                @foreach($visibleItems as [$module, $path, $label, $icon])
                    @php
                        $active = '/'.request()->path() === $path || ($path !== '/admin' && str_starts_with('/'.request()->path(), $path.'/'));
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ $active ? 'active' : '' }}" href="{{ url($path) }}" @if($active) aria-current="page" @endif>
                            <i class="fas {{ $icon }} menu-icon" aria-hidden="true"></i><span class="menu-title">{{ $label }}</span>
                        </a>
                    </li>
                @endforeach
            @endif
        @endforeach
        <li class="admin-nav-group">Akun saya</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}" @if(request()->routeIs('admin.profile.*')) aria-current="page" @endif>
                <i class="fas fa-user-cog menu-icon" aria-hidden="true"></i><span class="menu-title">Pengaturan Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="nav-link admin-logout"><i class="fas fa-sign-out-alt menu-icon" aria-hidden="true"></i><span class="menu-title">Keluar</span></button>
            </form>
        </li>
    </ul>
</nav>
