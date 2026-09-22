<?php

use App\Http\Controllers\AccreditationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoMaknaController;
use App\Http\Controllers\PendiriController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\PanduanAkademikController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SambutanRektorController;
use App\Http\Controllers\SambutanYayasanController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\Admin\AccreditationController as AdminAccreditationController;
use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\GuruBesarController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\KerjasamaController;
use App\Http\Controllers\Admin\CivitasController;
use App\Http\Controllers\Admin\KelolaPenggunaController;
use App\Http\Controllers\Admin\LeadershipProfileController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PasswordResetApprovalController;
use App\Http\Controllers\Admin\PanduanAkademikController as AdminPanduanAkademikController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProdiAdminController;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/biaya-kuliah', 'biaya-kuliah')->name('biaya-kuliah.index');

Route::get('/language/{locale}', function (Request $request, string $locale) {
    abort_unless(in_array($locale, ['id', 'en'], true), 404);

    $request->session()->put('locale', $locale);

    return back();
})->name('language.switch');

Route::get('/language-toggle', function (Request $request) {
    $request->session()->put('locale', app()->getLocale() === 'id' ? 'en' : 'id');

    return back();
})->name('language.toggle');

Route::get('/media/banner/{slide}', function (HeroSlide $slide) {
    if (! str_starts_with((string) $slide->media_path, 'banner/')) {
        abort(404);
    }

    $path = Str::after($slide->media_path, 'banner/');
    $headers = ['Cache-Control' => 'public, max-age=86400, no-transform'];

    $disk = Storage::disk('banner');
    $filePath = null;

    if ($disk->exists($path)) {
        $filePath = $disk->path($path);
    }

    if (! $filePath) {
        $legacyPath = 'banner/' . $path;
        $legacyDisk = Storage::disk('public');

        abort_unless($legacyDisk->exists($legacyPath), 404);

        $filePath = $legacyDisk->path($legacyPath);
    }

    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    return response()->file($filePath, $headers);
})->name('banner.file');

Route::middleware(['guest', 'no_cache'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login')->name('login.attempt');
    Route::get('/forgot-password', [PasswordResetRequestController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetRequestController::class, 'store'])->middleware('throttle:password-reset')->name('password.email');
});

Route::get('/captcha/refresh', [AuthController::class, 'refreshCaptcha'])->middleware('throttle:captcha-refresh')->name('captcha.refresh');
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth', 'no_cache'])->name('logout');

Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
Route::get('/pendiri', [PendiriController::class, 'index'])->name('pendiri.index');
Route::get('/logo-makna', [LogoMaknaController::class, 'index'])->name('logo-makna.index');
Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.index');
Route::get('/pimpinan/{slug}', [PimpinanController::class, 'show'])->name('pimpinan.show');
Route::get('/visimisi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
Route::get('/sambutan-rektor', [SambutanRektorController::class, 'index'])->name('sambutan.rektor');
Route::get('/sambutan-yayasan', [SambutanYayasanController::class, 'index'])->name('sambutan.yayasan');
Route::get('/akreditasi', [AccreditationController::class, 'index'])->name('akreditasi.index');
Route::get('/akreditasi/file/{accreditation}', [AccreditationController::class, 'file'])->name('akreditasi.file');
Route::redirect('/panduan-akademik', '/pusat-informasi');
Route::get('/pusat-informasi', [PanduanAkademikController::class, 'index'])->name('pusat-informasi.index');
Route::get('/panduan-akademik/file/{panduanAkademik}', [PanduanAkademikController::class, 'file'])->name('panduan-akademik.file');
Route::get('/panduan-akademik/download/{panduanAkademik}', [PanduanAkademikController::class, 'download'])->name('panduan-akademik.download');
Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur.index');
Route::get('/fakultas/{slug}', [FacultyController::class, 'show'])
    ->whereIn('slug', ['kesehatan', 'sosial-ekonomi-humaniora'])
    ->name('faculty.show');

Route::get('/prodi/pasca-sarjana/s2-kesehatan-masyarakat', [ProgramStudiController::class, 's2Kesmas'])->name('prodi.pasca-sarjana.s2.kesmas');
Route::get('/prodi/profesi/profesiners', [ProgramStudiController::class, 'profesiners'])->name('prodi.proefsiners');
Route::get('/prodi/profesi/profesibidan', [ProgramStudiController::class, 'profesibidan'])->name('prodi.profesibidan');
Route::get('/prodi/sarjana/s1-kesehatan-masyarakat', [ProgramStudiController::class, 's1kesmas'])->name('prodi.sarjana.s1.kesmas');
Route::get('/prodi/sarjana/s1-kebidanan', [ProgramStudiController::class, 's1bidan'])->name('prodi.sarjana.s1.bidan');
Route::get('/prodi/sarjana/s1-keperawatan', [ProgramStudiController::class, 's1perawat'])->name('prodi.sarjana.s1.keperawatan');
Route::get('/prodi/sarjana/s1-farmasi', [ProgramStudiController::class, 's1farmasi'])->name('prodi.sarjana.s1.farmasi');
Route::get('/prodi/sarjana/s1-psikologi', [ProgramStudiController::class, 's1psikologi'])->name('prodi.sarjana.s1.psikologi');
Route::get('/prodi/sarjana/s1-fisioterapi', [ProgramStudiController::class, 's1fisiotrapi'])->name('prodi.sarjana.s1.fisiotrapi');
Route::get('/prodi/sarjana/s1-bisnis-digital', [ProgramStudiController::class, 's1bisdig'])->name('prodi.sarjana.s1.bisnisdigital');
Route::get('/prodi/sarjana/s1-pariwisata', [ProgramStudiController::class, 's1pariwisata'])->name('prodi.sarjana.s1.pariwisata');
Route::get('/prodi/sarjana/s1-desain-komunikasi-visual', [ProgramStudiController::class, 's1dkv'])->name('prodi.sarjana.s1.dkv');
Route::get('/prodi/sarjana/s1-hukum', [ProgramStudiController::class, 's1hukum'])->name('prodi.sarjana.s1.hukum');
Route::get('/prodi/sarjana/s1-kewirausahaan', [ProgramStudiController::class, 's1kewirausahaan'])->name('prodi.sarjana.s1.kewirausahaan');
Route::get('/prodi/diploma/d3-fisioterapi', [ProgramStudiController::class, 'd3fisioterapi'])->name('prodi.diploma.d3.fisiotrapi');

Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/{slug}', [ProdiController::class, 'show'])->name('prodi.show');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/berita-terbaru', [BeritaController::class, 'beritaTerbaru'])->name('berita.terbaru');
Route::get('/berita/prestasi', [BeritaController::class, 'prestasi'])->name('berita.prestasi');
Route::get('/berita/riset', [BeritaController::class, 'riset'])->name('berita.riset');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/artikel/{slug}', [BeritaController::class, 'show'])->name('artikel.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->middleware('throttle:contact')->name('contact.send');
Route::post('/chat/start', [ChatController::class, 'startSession'])->middleware('throttle:chat-start')->name('chat.start');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->middleware('throttle:chat-send')->name('chat.send');
Route::get('/chat/fetch', [ChatController::class, 'fetchMessages'])->middleware('throttle:chat-fetch')->name('chat.fetch');

Route::middleware(['auth', 'role:super_admin,admin,media,crm,kemahasiswaan', 'no_cache', 'log_admin_activity'])->group(function () {
    Route::prefix('admin/hero')->group(function () {
        Route::get('/', [HeroSlideController::class, 'index'])->name('hero.index')->middleware('module_access:banner,read');
        Route::post('/store', [HeroSlideController::class, 'store'])->name('hero.store')->middleware('module_access:banner,write');
        Route::put('/update/{id}', [HeroSlideController::class, 'update'])->name('hero.update')->middleware('module_access:banner,write');
        Route::delete('/delete/{id}', [HeroSlideController::class, 'destroy'])->name('hero.delete')->middleware('module_access:banner,write');
        Route::patch('/toggle/{id}', [HeroSlideController::class, 'toggle'])->name('hero.toggle')->middleware('module_access:banner,write');
    });

    Route::get('/admin', [DashboardController::class, 'index'])->middleware('module_access:dashboard,read');

    Route::prefix('admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)
            ->middleware('module_access:mahasiswa,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:mahasiswa,write');
        Route::get('dosen/export/csv', [DosenController::class, 'exportCsv'])->name('dosen.export.csv')->middleware('module_access:dosen,read');
        Route::get('dosen/export/excel', [DosenController::class, 'exportExcel'])->name('dosen.export.excel')->middleware('module_access:dosen,read');
        Route::post('dosen/import', [DosenController::class, 'import'])->name('dosen.import')->middleware('module_access:dosen,write');
        Route::resource('dosen', DosenController::class)
            ->middleware('module_access:dosen,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:dosen,write');
        Route::resource('banner', HeroSlideController::class)
            ->middleware('module_access:banner,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:banner,write');
        Route::get('banner/{id}/toggle', [HeroSlideController::class, 'toggle'])->middleware('module_access:banner,write');
        Route::resource('akreditasi', AdminAccreditationController::class)
            ->middleware('module_access:akreditasi,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:akreditasi,write');
        Route::resource('panduan-akademik', AdminPanduanAkademikController::class)
            ->except(['show'])
            ->names('admin.panduan-akademik')
            ->middleware('module_access:panduan_akademik,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:panduan_akademik,write');
        Route::resource('pimpinan-profile', LeadershipProfileController::class)
            ->except(['show'])
            ->names('admin.pimpinan-profile')
            ->middleware('module_access:pimpinan_profile,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:pimpinan_profile,write');
        Route::resource('kerjasama', KerjasamaController::class)
            ->middleware('module_access:kerjasama,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:kerjasama,write');
        Route::get('civitas/export/csv', [CivitasController::class, 'exportCsv'])->name('civitas.export.csv')->middleware('module_access:civitas,read');
        Route::get('civitas/export/excel', [CivitasController::class, 'exportExcel'])->name('civitas.export.excel')->middleware('module_access:civitas,read');
        Route::post('civitas/import', [CivitasController::class, 'import'])->name('civitas.import')->middleware('module_access:civitas,write');
        Route::resource('civitas', CivitasController::class)
            ->middleware('module_access:civitas,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:civitas,write');
        Route::get('prodi-hero', [ProdiAdminController::class, 'heroIndex'])
            ->name('prodi-hero.index')
            ->middleware('module_access:prodi,read');
        Route::get('prodi-hero/{prodi}/edit', [ProdiAdminController::class, 'heroEdit'])
            ->name('prodi-hero.edit')
            ->middleware('module_access:prodi,write');
        Route::put('prodi-hero/{prodi}', [ProdiAdminController::class, 'heroUpdate'])
            ->name('prodi-hero.update')
            ->middleware('module_access:prodi,write');
        Route::resource('prodi', ProdiAdminController::class)
            ->middleware('module_access:prodi,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:prodi,write');
        Route::resource('fakultas', FakultasController::class)
            ->middleware('module_access:fakultas,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:fakultas,write');
        Route::resource('guru-besar', GuruBesarController::class)
            ->middleware('module_access:guru_besar,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:guru_besar,write');
        Route::resource('beasiswa', BeasiswaController::class)
            ->middleware('module_access:beasiswa,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:beasiswa,write');
        Route::resource('berita', BeritaAdminController::class)
            ->middleware('module_access:berita,read')
            ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'module_access:berita,write');
        Route::get('/activities', [AdminActivityController::class, 'index'])->name('admin.activities.index')->middleware('module_access:dashboard,read');
        Route::resource('users', KelolaPenggunaController::class)->middleware('module_access:users,write');
        Route::post('/users/password-reset-requests/{id}/reset', [PasswordResetApprovalController::class, 'reset'])
            ->name('admin.password-reset.reset')
            ->middleware('module_access:users,write');
        Route::post('/users/password-reset-requests/{id}/close', [PasswordResetApprovalController::class, 'close'])
            ->name('admin.password-reset.close')
            ->middleware('module_access:users,write');
        Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('admin.profile.edit')->middleware('module_access:profile,read');
        Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('admin.profile.update')->middleware('module_access:profile,write');
        Route::get('/chat', [AdminChatController::class, 'index'])->name('admin.chat.index')->middleware('module_access:chat,read');
        Route::get('/chat/contact/{id}', [AdminChatController::class, 'showContact'])->name('admin.chat.contact.show')->middleware('module_access:chat,read');
        Route::patch('/chat/contact/{id}/status', [AdminChatController::class, 'updateContactStatus'])->name('admin.chat.contact.status')->middleware('module_access:chat,write');
        Route::get('/chat/notifications/feed', [AdminChatController::class, 'notifications'])->name('admin.chat.notifications')->middleware('module_access:chat,read');
        Route::get('/chat/{id}', [AdminChatController::class, 'show'])->name('admin.chat.show')->middleware('module_access:chat,read');
        Route::get('/chat/{id}/poll', [AdminChatController::class, 'poll'])->name('admin.chat.poll')->middleware('module_access:chat,read');
        Route::post('/chat/reply/{id}', [AdminChatController::class, 'reply'])->name('admin.chat.reply')->middleware('module_access:chat,write');
        Route::post('/chat/{id}/end', [AdminChatController::class, 'end'])->name('admin.chat.end')->middleware('module_access:chat,write');
    });
});
