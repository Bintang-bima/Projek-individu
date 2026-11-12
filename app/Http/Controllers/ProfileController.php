<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile (edit form).
     */
    public function edit(Request $request)
    {
        $user = $request->user()->load('profile');

        // Pastikan user selalu punya profil (menangani akun lama tanpa profil).
        if (! $user->profile) {
            $user->profile()->create(['umur' => 0, 'bio' => '', 'alamat' => '']);
            $user->load('profile');
        }

        return view('profile', compact('user'));
    }

    /**
     * Update the authenticated user's profile data.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'umur'   => ['required', 'integer', 'min:1', 'max:120'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'bio'    => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'umur.required' => 'Umur wajib diisi.',
            'umur.integer'  => 'Umur harus berupa angka.',
            'umur.max'      => 'Umur maksimal :max tahun.',
        ]);

        $user->update(['name' => $validated['name']]);

        Profile::updateOrCreate(
            ['id' => $user->profile_id],
            [
                'umur'   => $validated['umur'],
                'alamat' => $validated['alamat'] ?? '',
                'bio'    => $validated['bio'] ?? '',
            ]
        );

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini salah.',
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password baru minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Password berhasil diubah.');
    }
}
