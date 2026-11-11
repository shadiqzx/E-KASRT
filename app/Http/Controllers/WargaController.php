<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $warga = DataWarga::orderBy('idWarga', 'DESC')->get();
        return view('warga.index', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'  => 'required',
            'nama' => 'required',
        ]);

        DataWarga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $w = DataWarga::findOrFail($id);
        $w->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DataWarga::destroy($id);
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}

