# UFDK Portal

> Portal informasi universitas dan panel administrasi berbasis Laravel.

UFDK Portal menghubungkan kebutuhan informasi publik dengan pengelolaan data internal dalam satu aplikasi: mulai dari profil universitas, program studi, berita, akreditasi, dan kerja sama hingga dashboard admin, hak akses berbasis modul, live chat, dan pencatatan aktivitas.

<p align="center">
  <strong>Portal Publik</strong> · <strong>Panel Admin</strong> · <strong>Manajemen Konten</strong> · <strong>Live Chat</strong>
</p>

## Daftar Isi

- [Tentang Sistem](#tentang-sistem)
- [Fitur](#fitur)
- [Alur Sistem](#alur-sistem)
- [Stack Teknologi](#stack-teknologi)
- [Struktur Proyek](#struktur-proyek)
- [Menjalankan Lokal](#menjalankan-lokal)
- [Perintah Penting](#perintah-penting)
- [Konfigurasi Hosting](#konfigurasi-hosting)
- [Aturan Asset dan Git](#aturan-asset-dan-git)
- [Keamanan](#keamanan)
- [Kontribusi](#kontribusi)

## Tentang Sistem

Sistem memiliki dua area utama:

| Area | Peran |
| --- | --- |
| **Portal publik** | Menyajikan informasi universitas kepada pengunjung. |
| **Panel admin** | Mengelola konten, data akademik, komunikasi, pengguna, dan aktivitas. |

Arsitektur aplikasi mengikuti pola Laravel MVC:

```text
Browser
   │
   ▼
public/index.php
   │
   ▼
Routes → Middleware → Controller
                         │
                         ▼
                   Model / Service
                         │
                         ▼
                   Database / Storage
                         │
                         ▼
                    Blade + Vite
```

## Fitur

### Portal publik

- Beranda dengan hero/banner, statistik, berita, dan mitra kerja sama.
- Profil universitas: sejarah, pendiri, makna logo, visi-misi, sambutan, dan struktur.
- Informasi fakultas dan program studi.
- Berita berdasarkan kategori berita terbaru, prestasi, dan riset.
- Informasi akreditasi dan pusat informasi akademik.
- Informasi biaya kuliah.
- Formulir kontak.
- Live chat dengan status sesi dan antrean pengunjung.
- Dukungan bahasa Indonesia dan Inggris.

### Panel admin

- Dashboard ringkasan data dan aktivitas.
- CRUD banner, berita, mahasiswa, dosen, civitas, guru besar, fakultas, program studi, beasiswa, akreditasi, panduan akademik, pimpinan, dan kerja sama.
- Pengelolaan pesan kontak dan live chat.
- Pengelolaan pengguna dan profil sesuai hak akses.
- Impor/ekspor data tertentu.
- Pencatatan aktivitas login dan aktivitas administrasi.
- Pemeriksaan integritas sumber kode melalui service dan Artisan command.

### Role pengguna

Role yang tersedia:

`super_admin` · `admin` · `media` · `crm` · `kemahasiswaan`

Hak akses diterapkan pada level modul dan operasi:

- `read` — melihat daftar atau detail data.
- `write` — membuat, mengubah, menghapus, atau mengubah status data.

Definisi kewenangan berada di [`App\Models\User`](./app/Models/User.php).

## Alur Sistem

### Pengunjung

1. Pengunjung membuka halaman publik melalui `public/index.php`.
2. Route mengarahkan request ke controller yang sesuai.
3. Controller mengambil data melalui Eloquent dan service.
4. Blade merender halaman dengan asset hasil build Vite.
5. Form kontak menyimpan pesan baru untuk diproses admin.
6. Live chat membuat sesi; pengunjung masuk antrean jika admin sedang melayani sesi lain.

### Login admin

1. Pengguna mengirim email, password, dan CAPTCHA.
2. Request melewati validasi dan pembatasan percobaan.
3. Login berhasil mengarahkan pengguna ke dashboard.
4. Role dan akses modul diperiksa sebelum halaman atau aksi admin dijalankan.
5. Aktivitas login dan perubahan data dicatat sesuai alur aplikasi.

### Publikasi konten

```text
Admin membuat/mengubah data
          │
          ▼
Validasi + pemeriksaan hak akses
          │
          ▼
Database / media storage
          │
          ▼
Controller publik membaca data terbaru
          │
          ▼
Pengunjung melihat konten
```

## Stack Teknologi

| Lapisan | Teknologi |
| --- | --- |
| Backend | PHP 8.2+ |
| Framework | Laravel 12 |
| ORM | Laravel Eloquent |
| View | Blade |
| Frontend build | Vite 7 + Laravel Vite Plugin |
| CSS | Tailwind CSS 4 + stylesheet proyek |
| JavaScript | ES Modules + Axios |
| Database | SQLite default; mendukung MySQL, MariaDB, PostgreSQL, dan SQL Server |
| Testing | PHPUnit 11 melalui Laravel Test Runner |
| Utility | Yasumi, Laravel Tinker, Laravel Pint |

## Struktur Proyek

```text
app/
├── Http/Controllers/       Controller publik dan admin
├── Http/Middleware/        Auth, locale, role, throttle, dan logging
├── Models/                 Model Eloquent
├── Services/               Service kalender dan audit
└── Support/                Helper aplikasi

bootstrap/                  Bootstrap Laravel
config/                     Konfigurasi aplikasi
database/
├── factories/              Factory data
├── migrations/             Perubahan skema database
└── seeders/                Seeder data pengembangan

public/                     Document root hosting
├── build/                  Manifest dan asset hasil Vite
├── css/, js/               Asset publik tambahan
├── images/                 Foto/media runtime
├── files/                  File publik yang diunggah
├── vendors/                Asset pihak ketiga
├── .htaccess
└── index.php               Front controller Laravel

resources/
├── views/                  Template Blade publik dan admin
├── css/                    Source stylesheet
└── js/                     Source JavaScript

routes/                     Route web dan console
storage/                    Log, cache, dan storage aplikasi
tests/                      Pengujian
```

## Menjalankan Lokal

### Prasyarat

- PHP 8.2 atau lebih baru
- Composer
- Node.js dan npm
- Ekstensi PHP yang dibutuhkan oleh Laravel dan driver database

### Instalasi

Jalankan dari root proyek:

```bash
composer install
npm install
```

Buat `.env` lokal dari template yang tersedia, kemudian isi konfigurasi lokal secara aman. Jangan menggunakan kredensial produksi.

```bash
php artisan key:generate
php artisan migrate
npm run build
```

### Mode pengembangan

Untuk menjalankan server aplikasi dan Vite secara terpisah:

```bash
php artisan serve
npm run dev
```

Atau gunakan seluruh proses pengembangan melalui Composer:

```bash
composer run dev
```

## Perintah Penting

| Kebutuhan | Perintah |
| --- | --- |
| Melihat route | `php artisan route:list` |
| Menjalankan migration | `php artisan migrate` |
| Menjalankan test | `php artisan test` |
| Menjalankan test via Composer | `composer run test` |
| Build asset production | `npm run build` |
| Mode Vite development | `npm run dev` |
| Format kode PHP | `vendor/bin/pint` |
| Membuat symbolic link storage | `php artisan storage:link` |

## Konfigurasi Hosting

Struktur proyek telah mengikuti pola Laravel standar:

```text
DocumentRoot → project/public
```

**Jangan** mengarahkan document root ke root repository karena folder seperti `app`, `config`, `database`, `resources`, `routes`, dan `vendor` tidak boleh terekspos langsung.

Checklist deployment:

1. Arahkan document root web server ke `public/`.
2. Pastikan `public/index.php` dapat memuat `../vendor/autoload.php`.
3. Pastikan rewrite Apache aktif agar request non-file diteruskan ke `index.php`.
4. Jalankan `npm run build` sebelum rilis asset frontend.
5. Siapkan environment production melalui secret manager atau konfigurasi server.
6. Jalankan migration secara terkontrol setelah backup database.
7. Pastikan permission `storage/` dan `bootstrap/cache/` sesuai kebutuhan Laravel.
8. Verifikasi halaman publik, login admin, hak akses, upload media, kontak, dan live chat.
