@extends('admin.layouts.app')

@section('css')
<style>
    .berita-form-btn {
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

    .berita-form-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .berita-form-btn--save {
        background: #4b49ac;
    }

    .berita-form-btn--save:hover {
        background: #3f3d94;
    }

    .berita-form-btn--cancel {
        background: #64748b;
    }

    .berita-form-btn--cancel:hover {
        background: #475569;
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <h3 class="page-title">
        Edit Berita
    </h3>

    <a href="/admin/berita"
       class="berita-form-btn berita-form-btn--cancel"
       title="Kembali"
       aria-label="Kembali">
        <i class="fas fa-arrow-left"></i>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="/admin/berita/{{ $berita->id }}"
              method="POST"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Update Berita?"
              data-confirm-text="Perubahan berita akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control" required>
                    @foreach ($kategoriOptions as $value => $label)
                        <option value="{{ $value }}" {{ old('kategori', $berita->kategori) === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                @if($berita->thumbnail)
                <div class="mt-2">
                    <img src="{{ $berita->thumbnail_url }}" width="120">
                </div>
                @endif
            </div>

            <div class="form-group">
                <label>Foto Tambahan</label>
                <input type="file" name="gallery_images[]" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>
                <small class="text-muted">Pilih beberapa foto untuk ditambahkan ke galeri artikel.</small>

                @if(!empty($berita->gallery_images))
                    <div class="mt-3 d-flex flex-wrap" style="gap: 10px;">
                        @foreach($berita->gallery_images as $image)
                            <img src="{{ asset($image['path']) }}"
                                 alt="{{ $image['name'] ?? 'Foto berita' }}"
                                 width="110"
                                 style="height: 76px; object-fit: cover; border-radius: 8px;">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>Lampiran File</label>
                <input type="file" name="attachments[]" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" multiple>
                <small class="text-muted">PDF, Word, Excel, PowerPoint, ZIP, atau RAR. File baru akan ditambahkan ke daftar yang sudah ada.</small>

                @if(!empty($berita->attachments))
                    <ul class="mt-3 mb-0 pl-3">
                        @foreach($berita->attachments as $attachment)
                            <li>
                                <a href="{{ asset($attachment['path']) }}" target="_blank">
                                    {{ $attachment['name'] ?? basename($attachment['path']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group">
                <label>Konten</label>
                <textarea name="konten" rows="6" class="form-control" required>{{ old('konten', $berita->konten) }}</textarea>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d')) }}" required>
            </div>

            <button class="berita-form-btn berita-form-btn--save"
                    title="Update Berita"
                    aria-label="Update Berita">
                <i class="fas fa-save"></i>
            </button>
        </form>
    </div>
</div>

@endsection
