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

<div class="page-header">

    <h3 class="page-title">
        Edit Pengguna
    </h3>

</div>


<div class="card">

    <div class="card-body">

        <form method="POST"
              action="/admin/users/{{ $user->id }}"
              data-confirm-submit="true"
              data-confirm-title="Update Pengguna?"
              data-confirm-text="Perubahan data pengguna akan disimpan."
              data-confirm-button="Ya, update">

            @csrf
            @method('PUT')


            <input type="text"
                   name="name"
                   class="form-control mb-2"
                   placeholder="Nama"
                   value="{{ old('name', $user->name) }}">


            <input type="email"
                   name="email"
                   class="form-control mb-2"
                   placeholder="Email"
                   value="{{ old('email', $user->email) }}">


            <select name="role"
                    class="form-control mb-2">

                @foreach($roleOptions as $value => $label)
                <option value="{{ $value }}"
                    @if(old('role', $user->role) == $value) selected @endif>
                    {{ $label }}
                </option>
                @endforeach

            </select>


            <input type="text"
                   name="department"
                   class="form-control mb-2"
                   placeholder="Bagian / Departemen"
                   value="{{ old('department', $user->department) }}">


            <input type="password"
                   name="password"
                   class="form-control mb-2"
                   placeholder="Password baru (opsional)">


            <small class="text-muted d-block mb-3">
                Kosongkan password jika tidak ingin mengubah password. Jika diisi, password harus minimal 8 karakter, ada huruf besar, huruf kecil, dan simbol.
            </small>


            <div class="d-flex gap-2">
                <button class="user-form-btn user-form-btn--save"
                        title="Update Pengguna"
                        aria-label="Update Pengguna">
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
