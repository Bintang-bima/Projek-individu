<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(
                Auth::user()->isAdmin() ? route('admin.dashboard') : route('home')
            )->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Handle a registration request for the application.
     */
    public function storeRegister(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'umur'                  => ['nullable', 'integer', 'min:1', 'max:120'],
            'alamat'                => ['nullable', 'string', 'max:255'],
        ], [
            'name.required'       => 'Nama wajib diisi.',
            'name.max'            => 'Nama maksimal :max karakter.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'email.unique'        => 'Email sudah terdaftar, gunakan email lain.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal :min karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
            'umur.integer'        => 'Umur harus berupa angka.',
            'umur.max'            => 'Umur maksimal :max tahun.',
        ]);

        // Create the profile first, then the user referencing it.
        $profile = Profile::create([
            'umur'  => $validated['umur'] ?? 0,
            'bio'   => '',
            'alamat' => $validated['alamat'] ?? '',
        ]);

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'role_id'    => Role::where('name', 'user')->value('id') ?? 1,
            'profile_id' => $profile->id,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat dan Anda sudah login!');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}
