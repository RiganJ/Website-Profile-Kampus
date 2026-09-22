<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class KelolaPenggunaController extends Controller
{
    public function index()
    {
        $users = AdminTable::paginate(User::latest(), ['name', 'email', 'role', 'department'], 'users', 10);
        $loginActivities = AdminTable::paginate(LoginActivity::latest('attempted_at'), ['name', 'email', 'event', 'status', 'ip_address'], 'loginActivities', 10);
        $passwordResetRequests = AdminTable::paginate(PasswordResetRequest::with('user')
            ->where('status', 'pending')
            ->latest('requested_at'), ['email', 'user.name'], 'passwordResetRequests', 10);
        $roleOptions = User::roleOptions();

        return view('admin.kelola_pengguna.index', compact('users', 'loginActivities', 'passwordResetRequests', 'roleOptions'));
    }

    public function create()
    {
        $roleOptions = User::roleOptions();

        return view('admin.kelola_pengguna.create', compact('roleOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:' . implode(',', User::ROLES)],
            'department' => ['nullable', 'string', 'max:255'],
            'password' => ['required', Password::min(8)->mixedCase()->symbols()],
        ]);

        User::create($validated);

        return redirect('/admin/users')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roleOptions = User::roleOptions();

        return view('admin.kelola_pengguna.edit', compact('user', 'roleOptions'));
    }

    public function show($id)
    {
        return redirect("/admin/users/{$id}/edit");
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:' . implode(',', User::ROLES)],
            'department' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', Password::min(8)->mixedCase()->symbols()],
        ]);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect('/admin/users')
            ->with('success', 'Pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return back()->withErrors(['user' => 'Akun yang sedang dipakai tidak bisa dihapus.']);
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus');
    }
}
