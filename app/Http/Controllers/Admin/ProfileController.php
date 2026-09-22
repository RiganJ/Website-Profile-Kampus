<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->symbols()],
        ]);

        $payload = [
            'name' => $validated['name'],
            'department' => $validated['department'] ?? null,
        ];

        if ($request->hasFile('profile_photo')) {
            $directory = public_path('images/profiles');

            if (! File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            if ($user->profile_photo) {
                $oldFile = public_path('images/profiles/' . basename($user->profile_photo));
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('profile_photo');
            $filename = 'profile-' . $user->id . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);

            $payload['profile_photo'] = $filename;
        }

        if (! empty($validated['password'])) {
            $payload['password'] = $validated['password'];
        }

        $user->update($payload);

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
