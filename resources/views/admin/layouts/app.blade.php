<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.partials.site-icons')

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Admin Panel')</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/vendors/iconfonts/font-awesome/css/all.min.css') }}?v=20260922">
    <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- endinject -->

@vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/admin.js'])

@yield('css')
@stack('head')





</head>


<body class="admin-shell">
<a class="admin-skip-link" href="#admin-content">Langsung ke konten</a>
<button class="admin-sidebar-backdrop" data-admin-menu-close type="button" aria-label="Tutup navigasi" tabindex="-1"></button>

<div class="container-scroller">

    <!-- NAVBAR -->
    @include('admin.layouts.navbar')


    <div class="container-fluid page-body-wrapper">

        <!-- SIDEBAR -->
        @include('admin.layouts.sidebar')


        <div class="main-panel">

            <main class="content-wrapper" id="admin-content" tabindex="-1">

                @yield('content')

            </main>


            <!-- FOOTER -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        &copy; {{ date('Y') }}.
                    </span>

                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                        Universitas Fort De Kock
                        <i class="far fa-heart text-danger"></i>
                    </span>
                </div>
            </footer>

        </div>

    </div>

</div>


<!-- plugins:js -->
<script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
<!-- endinject -->


<!-- inject:js -->





<!-- endinject -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom js -->


@yield('js')
@stack('scripts')

<script>
    (function () {
        const swalOptions = {
            confirmButtonColor: '#ea580c',
            cancelButtonColor: '#64748b',
        };

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            timer: 2200,
            showConfirmButton: false
        });
        @endif

        @if(session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Informasi',
            text: @json(session('status')),
            timer: 2200,
            showConfirmButton: false
        });
        @endif

        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            html: `{!! collect($errors->all())->map(fn($error) => '<div>'.e($error).'</div>')->implode('') !!}`,
            confirmButtonColor: '#ea580c'
        });
        @endif

        document.querySelectorAll('form').forEach(function (form) {
            if (form.dataset.skipGlobalConfirm === 'true') {
                return;
            }

            const methodInput = form.querySelector('input[name="_method"]');
            const action = form.getAttribute('action') || '';
            const submitButton = form.querySelector('button[type="submit"], button:not([type])');
            const buttonLabel = submitButton ? submitButton.textContent.trim().toLowerCase() : '';
            const confirmSubmit = form.dataset.confirmSubmit === 'true';

            const requiresConfirm =
                confirmSubmit ||
                (methodInput && methodInput.value.toUpperCase() === 'DELETE') ||
                action.includes('/delete/') ||
                action.includes('/logout');

            if (!requiresConfirm) {
                return;
            }

            form.addEventListener('submit', function (event) {
                if (form.dataset.confirmed === 'true') {
                    return;
                }

                event.preventDefault();

                let message = 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
                let title = 'Konfirmasi';
                let confirmButtonText = 'Ya, lanjutkan';
                let icon = 'warning';
                let confirmButtonColor = '#ea580c';

                if (action.includes('/logout')) {
                    message = 'Anda akan keluar dari sesi admin. Lanjutkan logout?';
                    confirmButtonText = 'Ya, logout';
                } else if (buttonLabel.includes('hapus')) {
                    message = 'Data yang dihapus tidak bisa dikembalikan. Yakin ingin menghapus?';
                    title = 'Hapus Data?';
                    confirmButtonText = 'Ya, hapus';
                    confirmButtonColor = '#dc3545';
                } else if (confirmSubmit) {
                    title = form.dataset.confirmTitle || 'Simpan Data?';
                    message = form.dataset.confirmText || 'Data akan disimpan. Lanjutkan?';
                    confirmButtonText = form.dataset.confirmButton || 'Ya, simpan';
                    icon = form.dataset.confirmIcon || 'question';
                }

                if (form.dataset.confirmTitle) {
                    title = form.dataset.confirmTitle;
                }

                if (form.dataset.confirmText) {
                    message = form.dataset.confirmText;
                }

                if (form.dataset.confirmButton) {
                    confirmButtonText = form.dataset.confirmButton;
                }

                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message,
                    showCancelButton: true,
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'Batal',
                    ...swalOptions,
                    confirmButtonColor: confirmButtonColor
                }).then(function (result) {
                    if (result.isConfirmed) {
                        form.dataset.confirmed = 'true';
                        form.requestSubmit();
                    }
                });
            });
        });

        document.querySelectorAll('a[href*="/toggle/"], a[href*="/banner/"][href*="/toggle"]').forEach(function (link) {
            if (link.dataset.skipGlobalConfirm === 'true') {
                return;
            }

            link.addEventListener('click', function (event) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Konfirmasi',
                    text: 'Status data akan diubah. Yakin ingin melanjutkan?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, lanjutkan',
                    cancelButtonText: 'Batal',
                    ...swalOptions
                }).then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = link.href;
                    }
                });
            });
        });
    })();
</script>

</body>
</html>
