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

<div class="card">

    <div class="card-body">

        <h4>

            Tambah Berita

        </h4>


        <form method="POST"
              action="/admin/berita"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Simpan Berita?"
              data-confirm-text="Berita baru akan disimpan."
              data-confirm-button="Ya, simpan">

            @csrf


            <input type="text"
                   name="judul"
                   placeholder="Judul Berita"
                   class="form-control mb-2">

            <select name="kategori" class="form-control mb-2" required>
                <option value="">Pilih Kategori Berita</option>
                @foreach ($kategoriOptions as $value => $label)
                    <option value="{{ $value }}" {{ old('kategori') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>



            <input type="file"
                   name="thumbnail"
                   accept=".jpg,.jpeg,.png,.webp"
                   class="form-control mb-2">

            <small class="d-block mb-3 text-muted">Thumbnail utama untuk kartu berita.</small>

            <input type="file"
                   name="gallery_images[]"
                   accept=".jpg,.jpeg,.png,.webp"
                   multiple
                   class="form-control mb-2">

            <small class="d-block mb-3 text-muted">Foto tambahan bisa dipilih lebih dari satu dan akan tampil di galeri artikel.</small>

            <input type="file"
                   name="attachments[]"
                   accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                   multiple
                   class="form-control mb-2">

            <small class="d-block mb-3 text-muted">Lampiran dokumen seperti PDF, Word, Excel, PowerPoint, ZIP, atau RAR.</small>

            <textarea name="konten"
                      placeholder="Konten Berita"
                      class="form-control mb-2"
                      rows="6"></textarea>



            <input type="date"
                   name="tanggal"
                   class="form-control mb-2">



            <div class="d-flex gap-2">
                <button class="berita-form-btn berita-form-btn--save"
                        title="Simpan Berita"
                        aria-label="Simpan Berita">
                    <i class="fas fa-save"></i>
                </button>

                <a href="/admin/berita"
                   class="berita-form-btn berita-form-btn--cancel"
                   title="Kembali"
                   aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>


        </form>

    </div>

</div>

@endsection
