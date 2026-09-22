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

<h4>Edit Banner</h4>


<form method="POST"
action="/admin/banner/{{ $slide->id }}"
enctype="multipart/form-data"
data-confirm-submit="true"
data-confirm-title="Update Banner?"
data-confirm-text="Perubahan banner akan disimpan."
data-confirm-button="Ya, update">

@csrf
@method('PUT')

@php
    $isManualMedia = $slide->media_path && !str_starts_with($slide->media_path, 'banner/');
@endphp


<input type="text"
name="title"
value="{{ $slide->title }}"
class="form-control mb-2">


<textarea name="description"
class="form-control mb-2">{{ $slide->description }}</textarea>



@if($slide->media_type == 'image')

<img src="{{ $slide->media_url }}"
width="150"
class="mb-2">

@else

<video width="200"
controls
class="mb-2">

<source src="{{ $slide->media_url }}">

</video>

@endif


<input type="file"
name="media_path"
accept=".jpg,.jpeg,.png,.mp4,.webm"
class="form-control mb-2">

<small class="text-muted d-block mb-2">
Upload file baru kalau ingin mengganti lewat CMS. Kalau file sudah ada di public, isi path manual di bawah.
</small>

<div class="banner-upload-guide mb-2">
<strong>Notes ukuran upload banner:</strong><br>
Bisa upload gambar <strong>JPG/PNG</strong> atau video profile <strong>MP4/WEBM</strong> sampai <strong>100 MB</strong>.<br>
Ukuran terbaik: <strong>2560 x 1440 px</strong>. Minimal aman: <strong>1920 x 1080 px</strong>. Rasio wajib: <strong>16:9</strong>.<br>
Untuk video profile, gunakan mode <strong>Hero penuh</strong> agar video mengisi banner rapi tanpa gepeng dan tanpa ruang kosong.
</div>


<label class="form-label">
Path Manual Media
</label>

<input type="text"
name="manual_media_path"
value="{{ old('manual_media_path', $isManualMedia ? $slide->media_path : '') }}"
placeholder="videos/profile-ufdk.mp4 atau https://domain.com/video.mp4"
class="form-control mb-2">

<small class="text-muted d-block mb-2">
Contoh: taruh video di <strong>public/videos/profile-ufdk.mp4</strong>, lalu isi <strong>videos/profile-ufdk.mp4</strong>.
</small>


<label class="form-label">
Jenis Media Manual
</label>

<select name="manual_media_type"
class="form-control mb-2">

<option value="video"
@if(old('manual_media_type', $slide->media_type) == 'video') selected @endif>
Video
</option>

<option value="image"
@if(old('manual_media_type', $slide->media_type) == 'image') selected @endif>
Gambar
</option>

</select>


<label class="form-label">
Prioritas Tampil
</label>

<input type="number"
name="sort_order"
min="0"
max="9999"
value="{{ old('sort_order', $slide->sort_order ?? 0) }}"
class="form-control mb-2">

<small class="text-muted d-block mb-2">
Angka lebih besar tampil lebih awal. Untuk video utama, bisa isi 100.
</small>


<label class="form-label">
Mode Tampilan Banner
</label>

<select name="media_fit"
class="form-control mb-2">

<option value="fill"
@if(($slide->media_fit ?? 'fill') == 'fill') selected @endif>
Hero penuh - tidak gepeng
</option>

<option value="cover"
@if(($slide->media_fit ?? 'fill') == 'cover') selected @endif>
Crop penuh - tampilan seperti contoh
</option>

<option value="contain"
@if(($slide->media_fit ?? 'fill') == 'contain') selected @endif>
Foto full - tidak terpotong
</option>

</select>


<label class="form-label">
Posisi Fokus Gambar
</label>

<select name="media_position"
class="form-control mb-2">

<option value="center center"
@if(($slide->media_position ?? 'center center') == 'center center') selected @endif>
Tengah
</option>

<option value="top center"
@if(($slide->media_position ?? 'center center') == 'top center') selected @endif>
Atas
</option>

<option value="bottom center"
@if(($slide->media_position ?? 'center center') == 'bottom center') selected @endif>
Bawah
</option>

<option value="left center"
@if(($slide->media_position ?? 'center center') == 'left center') selected @endif>
Kiri
</option>

<option value="right center"
@if(($slide->media_position ?? 'center center') == 'right center') selected @endif>
Kanan
</option>

</select>


<label class="form-label">
Dimensi Banner
</label>

<select name="banner_dimension"
class="form-control mb-2">

<option value="compact"
@if(($slide->banner_dimension ?? 'compact') == 'compact') selected @endif>
Compact - disarankan untuk promo 16:9
</option>

<option value="medium"
@if(($slide->banner_dimension ?? 'compact') == 'medium') selected @endif>
Sedang
</option>

<option value="large"
@if(($slide->banner_dimension ?? 'compact') == 'large') selected @endif>
Besar
</option>

</select>


<select name="is_active"
class="form-control mb-2">

<option value="1"
@if($slide->is_active) selected @endif>

Aktif

</option>


<option value="0"
@if(!$slide->is_active) selected @endif>

Nonaktif

</option>

</select>


<div class="d-flex gap-2">
<button class="banner-form-btn banner-form-btn--save"
title="Update Banner"
aria-label="Update Banner">
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
