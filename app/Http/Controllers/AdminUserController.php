<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
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
}

