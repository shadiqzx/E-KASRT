@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<style>
.user-hero {
    background: linear-gradient(135deg, #312e81 0%, #4338ca 50%, #6366f1 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    box-shadow: 0 20px 40px -12px rgba(67, 56, 202, 0.4);
    margin-bottom: 26px;
}
</style>

<div class="user-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 16px;">
        <div>
            <span class="badge badge-light px-3 py-1 font-weight-bold text-primary mb-2" style="border-radius: 20px; font-size: 11px;">
                <i class="fas fa-user-shield mr-1"></i> HAK AKSES PENGGUNA
            </span>
            <h2 class="font-weight-bold text-white mb-1">Manajemen Pengguna Sistem RT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px;">Kelola akun login admin, ketua RT, bendahara, kader posyandu, dan warga.</p>
        </div>
        <div>
            <button class="btn btn-light font-weight-bold px-4 py-2 text-primary shadow" data-toggle="modal" data-target="#modalTambahUser" style="border-radius: 12px;">
                <i class="fas fa-user-plus mr-1"></i> + Tambah User Baru
            </button>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white py-3 border-bottom font-weight-bold text-dark">
        Daftar Akun Pengguna Terdaftar
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Username</th>
                    <th>Nama Pengguna</th>
                    <th>Hak Akses / Role</th>
                    <th>Status Akun</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td><strong>{{ $u->username }}</strong></td>
                    <td>{{ $u->user }}</td>
                    <td><span class="badge badge-primary px-3 py-1">{{ $u->role->role ?? 'User' }}</span></td>
                    <td>
                        @if($u->is_active == 1)
                            <span class="badge badge-success px-2 py-1">Aktif</span>
                        @else
                            <span class="badge badge-danger px-2 py-1">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-light border" data-toggle="modal" data-target="#modalEditUser{{ $u->user_id }}" title="Edit">
                                <i class="fas fa-edit text-primary"></i>
                            </button>
                            <a href="{{ route('admin.user.toggle', $u->user_id) }}" class="btn btn-light border" title="Aktifkan/Nonaktifkan">
                                <i class="fas fa-power-off {{ $u->is_active == 1 ? 'text-success' : 'text-danger' }}"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #312e81, #4338ca); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Tambah User Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Username</label>
                        <input type="text" name="username" class="form-control" required style="border-radius: 9px;">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Nama Lengkap</label>
                        <input type="text" name="user" class="form-control" required style="border-radius: 9px;">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Password</label>
                        <input type="password" name="password" class="form-control" required style="border-radius: 9px;">
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Role Akses</label>
                        <select name="role_id" class="form-control" style="border-radius: 9px;">
                            @foreach($roles as $r)
                                <option value="{{ $r->id }}">{{ $r->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">Simpan User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
@foreach($users as $u)
<div class="modal fade" id="modalEditUser{{ $u->user_id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #312e81, #4338ca); padding: 22px;">
                <h5 class="modal-title font-weight-bold text-white mb-0">Edit User: {{ $u->username }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('admin.user.update', $u->user_id) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Nama Lengkap</label>
                        <input type="text" name="user" class="form-control" value="{{ $u->user }}" required style="border-radius: 9px;">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px;">Password Baru (Kosongkan bila tidak diganti)</label>
                        <input type="password" name="password" class="form-control" placeholder="Password baru" style="border-radius: 9px;">
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-weight-bold" style="font-size: 13px;">Role Akses</label>
                        <select name="role_id" class="form-control" style="border-radius: 9px;">
                            @foreach($roles as $r)
                                <option value="{{ $r->id }}" {{ $u->role_id == $r->id ? 'selected' : '' }}>{{ $r->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end" style="gap: 8px;">
                        <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
