@extends('admin.layouts.app')

@section('css')
<style>
    .user-form-btn {
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

    .user-form-btn:hover {
        transform: translateY(-1px);
        color: #fff;
    }

    .user-form-btn--save {
        background: #4b49ac;
    }

    .user-form-btn--save:hover {
        background: #3f3d94;
    }

    .user-form-btn--cancel {
        background: #64748b;
    }

    .user-form-btn--cancel:hover {
        background: #475569;
    }
</style>
@endsection

@section('content')

<div class="card">

    <div class="card-body">

        <h4>Tambah Pengguna</h4>


        <form method="POST"
              action="/admin/users"
              data-confirm-submit="true"
              data-confirm-title="Simpan Pengguna?"
              data-confirm-text="Pengguna baru akan disimpan."
              data-confirm-button="Ya, simpan">

            @csrf


            <input type="text"
                   name="name"
                   placeholder="Nama"
                   class="form-control mb-2"
                   value="{{ old('name') }}">


            <input type="email"
                   name="email"
                   placeholder="Email"
                   class="form-control mb-2"
                   value="{{ old('email') }}">


            <select name="role"
                    class="form-control mb-2">

                <option value="">
                    Pilih Role
                </option>

                @foreach($roleOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('role') == $value)>
                    {{ $label }}
                </option>
                @endforeach

            </select>


            <input type="text"
                   name="department"
                   placeholder="Bagian / Departemen"
                   class="form-control mb-2"
                   value="{{ old('department') }}">


            <input type="password"
                   name="password"
                   placeholder="Password"
                   class="form-control mb-2">


            <small class="text-muted d-block mb-3">
                Password minimal 8 karakter, wajib huruf besar, huruf kecil, dan simbol.
            </small>


            <div class="d-flex gap-2">
                <button class="user-form-btn user-form-btn--save"
                        title="Simpan Pengguna"
                        aria-label="Simpan Pengguna">
                    <i class="fas fa-save"></i>
                </button>

                <a href="/admin/users"
                   class="user-form-btn user-form-btn--cancel"
                   title="Kembali"
                   aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
