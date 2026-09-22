# Laporan pembersihan — 22 September 2026

Pekerjaan dilakukan pada salinan lokal `D:\public_html (5)`. Tidak ada perubahan
yang dikirim ke hosting dan tidak ada database produksi yang diubah.

## Verifikasi yang menghalangi halaman

- Ditemukan blok Hostinger LiteShield di `.htaccess`: `LsRecaptcha 100` dan
  `E=verifycaptcha:drop`. Blok ini dihapus.
- Blok yang sama juga ada di `storage/app/integrity-baseline/.htaccess`.
  Baseline disamakan dengan konfigurasi yang sudah diperbaiki agar pemulihan
  otomatis tidak mengembalikan CAPTCHA. Validator pemulihan kini menolak
  konfigurasi yang mengandung kedua direktif tersebut.
- `google4ccb7b860dd15ef2.html` dan `google0fd2ae6e3680e773.html` hanya berisi
  satu baris verifikasi kepemilikan situs. Tidak ada script atau pengalihan di
  dalamnya, sehingga keduanya dipertahankan.
- CAPTCHA lokal pada form login admin tetap ada. CAPTCHA itu bukan gerbang
  verifikasi eksternal sebelum halaman publik terbuka.

## Artefak serangan yang dihapus

Tujuh file berikut masih tersimpan di karantina lama
`storage/app/quarantine/compromise-2026-09-03/` dan sekarang sudah dihapus:

| File | Temuan |
| --- | --- |
| `.htaccetzt` | Aturan pengalihan khusus user-agent Google ke `index.html` |
| `rock.php` | Kode tersamarkan, evaluasi kode dan eksekusi perintah |
| `rock.zip` | Arsip berisi `rock.php` |
| `wsv2.zip` | Arsip berisi `wsv2.php` |
| `._divitaz.php` | File manager/shell dengan unggah dan eksekusi perintah |
| `git-ref-sql-query.php` | Salinan shell dengan unggah dan eksekusi perintah |
| `grock.php` | Tiny File Manager/web shell |

Ukuran dan SHA-256 sebelum penghapusan tersimpan di
`storage/app/quarantine/removed-artifacts-2026-09-22.json`.
Karantina juga diberi `.htaccess` yang menolak semua akses HTTP.

Pemindaian sumber, konfigurasi tersembunyi, signature berisiko pada vendor,
dan isi 714 file unggahan/font tidak menemukan indikator tambahan yang
dikonfirmasi sebagai backdoor atau judol aktif. Kecocokan byte pendek pada
gambar diperiksa ulang; tidak ditemukan kode tertanam yang dapat ditindak.
Ini bukan verifikasi kriptografis seluruh dependency atau pemeriksaan server.

## Perbaikan file dan tampilan

- Regenerasi autoloader Composer dengan `--no-scripts --no-plugins --optimize`.
  Sebelumnya `vendor/composer/autoload_files.php` berisi kelas autoloader yang
  salah, bukan daftar file autoload.
- `.htaccess` tidak lagi memblokir folder aset frontend `vendors`. Folder
  dependency PHP `vendor`, konfigurasi, metadata Git, dan storage internal
  tetap diblokir.
- Lokasi publik Laravel dan keluaran Vite disesuaikan dengan susunan hosting
  ini: `index.php`, `images`, `vendors`, dan `build` berada di root proyek.
  Deteksi kembali memakai susunan Laravel standar jika root `index.php`
  tidak ada. Penggunaan document root `public/` memerlukan pemindahan aset
  secara konsisten; jangan hanya mengganti document root pada salinan ini.
- Penanda Vite development `hot` yang menunjuk `[::1]:5173` dihapus.
- Tautan file build dengan hash lama di template diganti dengan pemuatan
  manifest Vite atau dihapus jika sudah dimuat oleh layout.
- Referensi gambar yang hilang diperbaiki memakai aset yang tersedia,
  termasuk `pattern2.gif`, banner Ners, banner kontak, gambar kampus, dan
  model kewirausahaan.
- Dua gambar yang hanya ada di `public/images` disalin ke lokasi aset root.
- Build produksi dibuat ulang di `build/`; cache Blade lama dibersihkan.

## Validasi

- Lint 156 file PHP aplikasi/infrastruktur: lulus.
- Build Vite terakhir: lulus tanpa peringatan aset tidak ditemukan.
- Semua file yang dirujuk manifest build tersedia.
- Kompilasi seluruh template Blade: lulus; cache kemudian dibersihkan agar
  tidak membawa path lokal ke hosting.
- `php artisan website:integrity-scan`: tidak ada temuan.
- `php artisan test --filter=PublicAccessTest`: 3 tes, 11 assertion lulus.
  Memeriksa halaman biaya kuliah, aset login, serta autentikasi admin.
- `python tests/verify_apache.py`: 12 pemeriksaan Apache lulus. Aset memberi
  HTTP 200, sedangkan rahasia, internal, karantina, dan jalur spam memberi 403.
  Server pengujian sementara hanya memeriksa aset dan aturan akses, tanpa
  menjalankan PHP; server sudah dihentikan.
- Suite pengujian lama belum sepenuhnya lulus: tes beranda pada
  `Tests\Feature\ExampleTest` memberi 500 karena database SQLite pengujian
  tidak mempunyai tabel `hero_slides`. Database produksi dan konten beranda
  belum dapat divalidasi dari salinan ini.

## Batas pemeriksaan

Pengaturan Hostinger/LiteSpeed di luar folder, konfigurasi WAF/CDN, database,
akun hosting, dan proses server tidak tercakup. Jika CAPTCHA muncul kembali
setelah file ini diterapkan, perlu memeriksa lapisan hosting yang dapat
menambahkan aturan atau tantangan di luar aplikasi.

`SECURITY_AUDIT.md` adalah catatan historis pemeriksaan sebelumnya, bukan
hasil pemeriksaan dependency terbaru. Temuan tanggal ini tercatat di sini.
