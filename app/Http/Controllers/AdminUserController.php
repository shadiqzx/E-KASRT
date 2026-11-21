<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = UserRole::all();
        return view('admin.user', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'user'     => 'required',
            'password' => 'required',
            'role_id'  => 'required',
        ]);

        User::create([
            'username'  => $request->username,
            'user'      => $request->user,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'is_active' => 1,
            'img'       => 'default.jpg',
        ]);

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $u = User::findOrFail($id);
        $data = [
            'user'    => $request->user,
            'role_id' => $request->role_id,
        ];
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $u->update($data);

        return redirect()->route('admin.user')->with('success', 'Data user berhasil diperbarui!');
    }

    public function toggleActive($id)
    {
        $u = User::findOrFail($id);
        $u->is_active = $u->is_active == 1 ? 0 : 1;
        $u->save();

        return redirect()->route('admin.user')->with('success', 'Status user berhasil diubah!');
    }

    /**
     * Halaman Menu Verifikasi Pendaftaran Warga Baru
     */
    public function verifikasiWarga()
    {
        $pending = User::where('status_verifikasi', 'Menunggu Verifikasi')
            ->with('dataWarga')
            ->orderBy('tgl_daftar', 'desc')
            ->get();

        $approved = User::where('status_verifikasi', 'Disetujui')
            ->where('role_id', 4)
            ->with(['dataWarga', 'verifikator'])
            ->orderBy('tgl_verifikasi', 'desc')
            ->take(100)
            ->get();

        $rejected = User::where('status_verifikasi', 'Ditolak')
            ->with(['dataWarga', 'verifikator'])
            ->orderBy('tgl_verifikasi', 'desc')
            ->take(100)
            ->get();

        $stats = [
            'pending'  => $pending->count(),
            'approved' => User::where('status_verifikasi', 'Disetujui')->where('role_id', 4)->count(),
            'rejected' => User::where('status_verifikasi', 'Ditolak')->count(),
        ];

        return view('admin.verifikasi_warga', compact('pending', 'approved', 'rejected', 'stats'));
    }

    /**
     * Setujui pendaftaran warga (Aktifkan akun dan verifikasi)
     */
    public function setujuiWarga($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status_verifikasi' => 'Disetujui',
            'is_active'         => 1,
            'verifikator_id'    => Auth::id(),
            'tgl_verifikasi'    => now(),
            'alasan_tolak'      => null,
        ]);

        if ($user->nik) {
            DataWarga::where('nik', $user->nik)->update([
                'status_warga' => 'Terverifikasi',
            ]);
        }

        return redirect()->back()->with('success', 'Pendaftaran akun warga "' . ($user->user ?: $user->username) . '" berhasil disetujui & akun telah aktif!');
    }

    /**
     * Tolak pendaftaran warga dengan alasan penolakan
     */
    public function tolakWarga(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => 'nullable|string|max:500',
        ]);

        $user = User::findOrFail($id);
        $alasan = $request->alasan_tolak ?: 'Data tidak sesuai atau bukan warga lingkungan RT setempat.';

        $user->update([
            'status_verifikasi' => 'Ditolak',
            'is_active'         => 0,
            'alasan_tolak'      => $alasan,
            'verifikator_id'    => Auth::id(),
            'tgl_verifikasi'    => now(),
        ]);

        if ($user->nik) {
            DataWarga::where('nik', $user->nik)->update([
                'status_warga' => 'Ditolak',
            ]);
        }

        return redirect()->back()->with('success', 'Pendaftaran warga "' . ($user->user ?: $user->username) . '" telah ditolak.');
    }
}

