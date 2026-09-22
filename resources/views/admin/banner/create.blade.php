@extends('admin.layouts.app')

@section('css')
<style>
    .banner-form-btn {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        color: #fff;
        transition: .2s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }

    .banner-form-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .banner-form-btn--save {
        background: #4b49ac;
    }

    .banner-form-btn--save:hover {
        background: #3f3d94;
    }

    .banner-form-btn--cancel {
        background: #64748b;
    }

    .banner-form-btn--cancel:hover {
        background: #475569;
    }

    .banner-upload-guide {
        border: 1px solid #fed7aa;
        background: #fff7ed;
        color: #9a3412;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        line-height: 1.5;
    }

    .banner-upload-guide strong {
        color: #7c2d12;
    }
</style>
@endsection

@section('content')

<div class="card">

    <div class="card-body">

        <h4>
            Tambah Banner
        </h4>



        <form method="POST"
              action="/admin/banner"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Simpan Banner?"
              data-confirm-text="Banner baru akan disimpan."
              data-confirm-button="Ya, simpan">

            @csrf



            <div class="mb-2">

                <input type="text"
                       name="title"
                       placeholder="Title"
                       class="form-control">

            </div>



            <div class="mb-2">

                <textarea name="description"
                          placeholder="Deskripsi"
                          class="form-control"></textarea>

            </div>



            <div class="mb-2">

                <div class="banner-upload-guide mb-2">
                    <strong>Notes ukuran upload banner:</strong><br>
                    Bisa upload gambar <strong>JPG/PNG</strong> atau video profile <strong>MP4/WEBM</strong> sampai <strong>100 MB</strong>.<br>
                    Ukuran terbaik: <strong>2560 x 1440 px</strong>. Minimal aman: <strong>1920 x 1080 px</strong>. Rasio wajib: <strong>16:9</strong>.<br>
                    Untuk video profile, gunakan mode <strong>Hero penuh</strong> agar video mengisi banner rapi tanpa gepeng dan tanpa ruang kosong.
                </div>

                <input type="file"
                       name="media_path"
                       accept=".jpg,.jpeg,.png,.mp4,.webm"
                       class="form-control">
                <small class="text-muted d-block mt-1">
                    Kalau file sudah kamu masukkan manual ke folder public, kosongkan upload ini dan isi path manual di bawah.
                </small>

            </div>


            <div class="mb-2">

                <label class="form-label">
                    Path Manual Media
                </label>

                <input type="text"
                       name="manual_media_path"
                       value="{{ old('manual_media_path') }}"
                       placeholder="videos/profile-ufdk.mp4 atau https://domain.com/video.mp4"
                       class="form-control">

                <small class="text-muted">
                    Contoh: taruh video di <strong>public/videos/profile-ufdk.mp4</strong>, lalu isi <strong>videos/profile-ufdk.mp4</strong>.
                </small>

            </div>



            <div class="mb-2">

                <label class="form-label">
                    Jenis Media Manual
                </label>

                <select name="manual_media_type"
                        class="form-control">

                    <option value="video" @selected(old('manual_media_type') == 'video')>
                        Video
                    </option>

                    <option value="image" @selected(old('manual_media_type') == 'image')>
                        Gambar
                    </option>

                </select>

            </div>



            <div class="mb-2">

                <label class="form-label">
                    Prioritas Tampil
                </label>

                <input type="number"
                       name="sort_order"
                       min="0"
                       max="9999"
                       value="{{ old('sort_order', 0) }}"
                       class="form-control">

                <small class="text-muted">
                    Angka lebih besar tampil lebih awal. Untuk video utama, bisa isi 100.
                </small>

            </div>



            <div class="mb-2">

                <label class="form-label">
                    Mode Tampilan Banner
                </label>

                <select name="media_fit"
                        class="form-control">

                    <option value="fill" selected>
                        Hero penuh - tidak gepeng
                    </option>

                    <option value="contain">
                        Foto full - tidak terpotong
                    </option>

                    <option value="cover">
                        Crop penuh - tampilan seperti contoh
                    </option>

                </select>

            </div>



            <div class="mb-2">

                <label class="form-label">
                    Posisi Fokus Gambar
                </label>

                <select name="media_position"
                        class="form-control">

                    <option value="center center" selected>
                        Tengah
                    </option>

                    <option value="top center">
                        Atas
                    </option>

                    <option value="bottom center">
                        Bawah
                    </option>

                    <option value="left center">
                        Kiri
                    </option>

                    <option value="right center">
                        Kanan
                    </option>

                </select>

            </div>



            <div class="mb-2">

                <label class="form-label">
                    Dimensi Banner
                </label>

                <select name="banner_dimension"
                        class="form-control">

                    <option value="compact" selected>
                        Compact - disarankan untuk promo 16:9
                    </option>

                    <option value="medium">
                        Sedang
                    </option>

                    <option value="large">
                        Besar
                    </option>

                </select>

            </div>



            <div class="mb-2">

                <select name="is_active"
                        class="form-control">

                    <option value="1">
                        Aktif
                    </option>

                    <option value="0">
                        Nonaktif
                    </option>

                </select>

            </div>



            <div class="d-flex gap-2">
                <button class="banner-form-btn banner-form-btn--save"
                        title="Simpan Banner"
                        aria-label="Simpan Banner">
                    <i class="fas fa-save"></i>
                </button>

                <a href="/admin/banner"
                   class="banner-form-btn banner-form-btn--cancel"
                   title="Kembali"
                   aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>



        </form>

    </div>

</div>

@endsection
