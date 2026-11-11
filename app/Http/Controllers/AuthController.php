<?php

namespace App\Http\Controllers;

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}

