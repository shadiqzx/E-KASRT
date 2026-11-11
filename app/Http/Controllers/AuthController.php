<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->is_active != 1) {
                return redirect()->back()->with('error', 'Akun Anda belum aktif. Silakan hubungi admin RT.');
            }

            Auth::login($user);
            $request->session()->regenerate();
            $request->session()->put('username', $user->username);
            $request->session()->put('role_id', $user->role_id);
            $request->session()->put('user', $user->user);

            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->withInput($request->only('username'))->with('error', 'Username atau password salah!');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'nik'      => 'required|numeric|digits:16|unique:data_warga,nik',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:4|confirmed',
            'no_hp'    => 'nullable|string|max:20',
            'alamat'   => 'nullable|string|max:255',
            'no_rumah' => 'nullable|string|max:20',
            'jekel'    => 'required|string',
            'no_kk'    => 'nullable|string|max:20',
        ], [
            'nama.required'      => 'Nama lengkap warga wajib diisi.',
            'nik.required'       => 'NIK KTP wajib diisi.',
            'nik.digits'         => 'NIK harus berupa 16 digit angka.',
            'nik.unique'         => 'NIK KTP ini sudah terdaftar sebagai warga.',
            'username.required'  => 'Username wajib diisi untuk login akun.',
            'username.unique'    => 'Username ini sudah digunakan akun lain.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 4 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // 1. Catat ke data_warga
        DataWarga::create([
            'nik'               => $request->nik,
            'nama'              => $request->nama,
            'no_kk'             => $request->no_kk,
            'jekel'             => $request->jekel,
            'hubungan_keluarga' => 'Kepala Keluarga',
            'alamat'            => $request->alamat ?: 'Lingkungan RT',
            'no_rumah'          => $request->no_rumah ?: '-',
        ]);

        // 2. Buat akun user warga (Role ID 4 = Warga, is_active = 1)
        User::create([
            'user'      => $request->nama,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'role_id'   => 4,
            'is_active' => 1,
            'img'       => 'default.png',
            'email'     => $request->email ?: null,
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran warga berhasil! Silakan masuk menggunakan username dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}

