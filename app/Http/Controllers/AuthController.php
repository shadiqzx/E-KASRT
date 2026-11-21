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
            // Cek status verifikasi pendaftaran akun warga
            if ($user->status_verifikasi === 'Menunggu Verifikasi') {
                return redirect()->back()
                    ->withInput($request->only('username'))
                    ->with('warning', '⏳ Pendaftaran akun Anda atas nama "' . ($user->user ?: $user->username) . '" masih dalam proses antrean verifikasi oleh Pengurus RT. Mohon menunggu persetujuan.');
            }

            if ($user->status_verifikasi === 'Ditolak') {
                $alasan = $user->alasan_tolak ?: 'Persyaratan tidak sesuai / bukan warga lingkungan RT setempat.';
                return redirect()->back()
                    ->withInput($request->only('username'))
                    ->with('error', '❌ Pendaftaran akun Anda ditolak oleh Pengurus RT. Alasan: ' . $alasan);
            }

            if ($user->is_active != 1) {
                return redirect()->back()
                    ->withInput($request->only('username'))
                    ->with('error', 'Akun Anda belum aktif atau telah dinonaktifkan oleh Administrator RT.');
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

        // 1. Catat ke data_warga dengan status Menunggu Verifikasi
        DataWarga::create([
            'nik'               => $request->nik,
            'nama'              => $request->nama,
            'no_kk'             => $request->no_kk,
            'no_hp'             => $request->no_hp,
            'jekel'             => $request->jekel,
            'hubungan_keluarga' => 'Kepala Keluarga',
            'tempat_lahir'      => '-',
            'tanggal_lahir'     => '2000-01-01',
            'alamat'            => $request->alamat ?: 'Lingkungan RT',
            'no_rumah'          => $request->no_rumah ?: '-',
            'status_warga'      => 'Menunggu Verifikasi',
        ]);

        // 2. Buat akun user warga (Role ID 4 = Warga, is_active = 0, status_verifikasi = Menunggu Verifikasi)
        User::create([
            'user'              => $request->nama,
            'username'          => $request->username,
            'password'          => Hash::make($request->password),
            'role_id'           => 4,
            'is_active'         => 0,
            'status_verifikasi' => 'Menunggu Verifikasi',
            'tgl_daftar'        => now(),
            'nik'               => $request->nik,
            'img'               => 'default.png',
            'email'             => $request->email ?: ($request->username . '@warga.kasrt.local'),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil diajukan! Akun Anda sedang dalam antrean verifikasi oleh Pengurus RT demi keamanan. Silakan cek status secara berkala.');
    }

    /**
     * Cek status verifikasi pendaftaran akun secara mandiri via NIK / Username
     */
    public function cekStatusWarga(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:100',
        ]);

        $keyword = trim($request->keyword);

        $user = User::where('nik', $keyword)
            ->orWhere('username', $keyword)
            ->first();

        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'found'   => false,
                    'message' => 'Data pendaftaran dengan NIK / Username "' . e($keyword) . '" tidak ditemukan.',
                ]);
            }
            return redirect()->route('login')->with('error', 'Data pendaftaran dengan NIK / Username "' . e($keyword) . '" tidak ditemukan.');
        }

        $warga = $user->dataWarga;

        $response = [
            'found'             => true,
            'nama'              => $user->user ?: ($warga->nama ?? '-'),
            'username'          => $user->username,
            'nik'               => $user->nik ?: ($warga->nik ?? '-'),
            'status_verifikasi' => $user->status_verifikasi ?: 'Disetujui',
            'is_active'         => (int)$user->is_active,
            'tgl_daftar'        => $user->tgl_daftar ? date('d M Y H:i', strtotime($user->tgl_daftar)) : '-',
            'tgl_verifikasi'    => $user->tgl_verifikasi ? date('d M Y H:i', strtotime($user->tgl_verifikasi)) : '-',
            'alasan_tolak'      => $user->alasan_tolak,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($response);
        }

        if ($user->status_verifikasi === 'Menunggu Verifikasi') {
            return redirect()->route('login')->with('warning', '⏳ Pendaftaran atas nama ' . $response['nama'] . ' (NIK: ' . $response['nik'] . ') sedang MENUNGGU VERIFIKASI Pengurus RT.');
        } elseif ($user->status_verifikasi === 'Ditolak') {
            return redirect()->route('login')->with('error', '❌ Pendaftaran atas nama ' . $response['nama'] . ' DITOLAK. Alasan: ' . ($response['alasan_tolak'] ?: 'Data tidak sesuai'));
        } else {
            return redirect()->route('login')->with('success', '✅ Akun ' . $response['nama'] . ' telah DISETUJUI & AKTIF. Silakan langsung login.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Anda telah berhasil keluar dari sistem E-KASRT.');
    }
}

