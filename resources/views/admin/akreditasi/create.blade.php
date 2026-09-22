@extends('admin.layouts.app')

@section('title', 'Tambah Akreditasi')

@section('css')
<style>
    .akreditasi-form-btn {
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

    .akreditasi-form-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .akreditasi-form-btn--save {
        background: #4b49ac;
    }

    .akreditasi-form-btn--save:hover {
        background: #3f3d94;
    }

    .akreditasi-form-btn--cancel {
        background: #64748b;
    }

    .akreditasi-form-btn--cancel:hover {
        background: #475569;
    }
</style>
@endsection

@section('content')

<div class="page-header">

    <h3 class="page-title">
        Tambah Akreditasi
    </h3>

</div>



<div class="card">

    <div class="card-body">

        <form method="POST"
              action="/admin/akreditasi"
              enctype="multipart/form-data"
              data-confirm-submit="true"
              data-confirm-title="Simpan Akreditasi?"
              data-confirm-text="Data akreditasi baru akan disimpan."
              data-confirm-button="Ya, simpan">

            @csrf



            <label class="mb-1">
                Jenis Akreditasi
            </label>

            <select name="accreditation_type"
                    id="accreditation_type"
                    class="form-control mb-3"
                    required>
                <option value="program_studi" {{ old('accreditation_type', 'program_studi') === 'program_studi' ? 'selected' : '' }}>
                    Program Studi
                </option>
                <option value="institusi" {{ old('accreditation_type') === 'institusi' ? 'selected' : '' }}>
                    Institusi
                </option>
            </select>



            <div id="prodi-field">
                <label class="mb-1">
                    Program Studi
                </label>

                <select name="prodi_id"
                        class="form-control mb-3">
                    <option value="">
                        Pilih Program Studi
                    </option>
                    @foreach($prodiOptions as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>



            <input type="text"
                   name="predicate"
                   class="form-control mb-3"
                   placeholder="Predikat (A / B / Unggul)"
                   required>



            <input type="number"
                   name="tahun"
                   class="form-control mb-3"
                   placeholder="Tahun"
                   required>



            <input type="text"
                   name="lembaga"
                   class="form-control mb-3"
                   placeholder="Lembaga Akreditasi"
                   required>



            <input type="text"
                   name="nomor_sk"
                   class="form-control mb-3"
                   placeholder="Nomor SK"
                   required>



            <label class="mb-1">
                Tanggal SK
            </label>

            <input type="date"
                   name="tanggal_sk"
                   class="form-control mb-3"
                   required>



            <label class="mb-1">
                Tanggal Kadaluarsa
            </label>

            <input type="date"
                   name="tanggal_kadaluarsa"
                   class="form-control mb-3">



            <label class="mb-1">
                File SK (PDF/JPG/PNG)
            </label>

            <input type="file"
                   name="file"
                   class="form-control mb-4">



            <div class="d-flex gap-2">
                <button class="akreditasi-form-btn akreditasi-form-btn--save"
                        title="Simpan Akreditasi"
                        aria-label="Simpan Akreditasi">
                    <i class="fas fa-save"></i>
                </button>

                <a href="/admin/akreditasi"
                   class="akreditasi-form-btn akreditasi-form-btn--cancel"
                   title="Kembali"
                   aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>



        </form>

    </div>

</div>

@endsection

@section('js')
<script>
    const accreditationType = document.getElementById('accreditation_type');
    const prodiField = document.getElementById('prodi-field');

    function syncProdiField() {
        prodiField.style.display = accreditationType.value === 'institusi' ? 'none' : 'block';
    }

    accreditationType.addEventListener('change', syncProdiField);
    syncProdiField();
</script>
@endsection
