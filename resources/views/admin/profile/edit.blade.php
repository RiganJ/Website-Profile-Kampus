@extends('admin.layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <img src="{{ $user->profile_photo_url }}"
                     alt="Foto Profil"
                     class="rounded-circle mb-3"
                     style="width: 130px; height: 130px; object-fit: cover;">
                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-1">{{ $user->email }}</p>
                <p class="text-muted mb-0">{{ \App\Models\User::roleOptions()[$user->role] ?? $user->role }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="mb-4">Pengaturan Profil</h4>

                <form method="POST"
                      action="{{ route('admin.profile.update') }}"
                      enctype="multipart/form-data"
                      data-confirm-submit="true"
                      data-confirm-title="Simpan Perubahan?"
                      data-confirm-text="Profil Anda akan diperbarui."
                      data-confirm-button="Ya, simpan">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="department">Bagian / Departemen</label>
                        <input id="department" type="text" name="department" class="form-control" value="{{ old('department', $user->department) }}">
                    </div>

                    <div class="form-group">
                        <label for="profile_photo">Foto Profil</label>
                        <input id="profile_photo" type="file" name="profile_photo" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal 2 MB.</small>
                    </div>

                    <hr>

                    <h5 class="mb-3">Ganti Password</h5>

                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input id="current_password" type="password" name="current_password" class="form-control" placeholder="Isi jika ingin ganti password">
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Password baru">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                    </div>

                    <small class="text-muted d-block mb-3">
                        Jika ingin mengganti password, isi password saat ini, password baru, dan konfirmasinya. Password baru minimal 8 karakter, mengandung huruf besar, huruf kecil, dan simbol.
                    </small>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
