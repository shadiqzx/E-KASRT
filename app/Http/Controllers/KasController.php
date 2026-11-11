<?php

namespace App\Http\Controllers;

use App\Models\DataKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasController extends Controller
{
    public function masuk()
    {
        $masuk = DataKas::where('jenis', 'Masuk')->orderBy('tanggal', 'DESC')->orderBy('idKas', 'DESC')->get();
        $kas = $masuk;
        $total_masuk = DataKas::where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar = DataKas::where('jenis', 'Keluar')->sum('jumlah');
        $saldo_kas = $total_masuk - $total_keluar;
        $saldo = $saldo_kas;

        $currentMonth = date('Y-m');
        $masuk_bulan_ini = DataKas::where('jenis', 'Masuk')->where('tanggal', 'like', $currentMonth . '%')->sum('jumlah');
        $count_bulan_ini = DataKas::where('jenis', 'Masuk')->where('tanggal', 'like', $currentMonth . '%')->count();
        $count_total = $masuk->count();
        $rata_rata = $count_total > 0 ? round($total_masuk / $count_total) : 0;

        return view('kas.kas_masuk', compact(
            'masuk', 'kas', 'total_masuk', 'total_keluar', 'saldo', 'saldo_kas',
            'masuk_bulan_ini', 'count_bulan_ini', 'count_total', 'rata_rata'
        ));
    }

    public function keluar()
    {
        $keluar = DataKas::where('jenis', 'Keluar')->orderBy('tanggal', 'DESC')->orderBy('idKas', 'DESC')->get();
        $kas = $keluar;
        $total_masuk = DataKas::where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar = DataKas::where('jenis', 'Keluar')->sum('jumlah');
        $saldo_kas = $total_masuk - $total_keluar;
        $saldo = $saldo_kas;

        $currentMonth = date('Y-m');
        $keluar_bulan_ini = DataKas::where('jenis', 'Keluar')->where('tanggal', 'like', $currentMonth . '%')->sum('jumlah');
        $count_bulan_ini = DataKas::where('jenis', 'Keluar')->where('tanggal', 'like', $currentMonth . '%')->count();
        $count_total = $keluar->count();
        $rata_rata = $count_total > 0 ? round($total_keluar / $count_total) : 0;

        return view('kas.kas_keluar', compact(
            'keluar', 'kas', 'total_masuk', 'total_keluar', 'saldo', 'saldo_kas',
            'keluar_bulan_ini', 'count_bulan_ini', 'count_total', 'rata_rata'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|numeric',
            'jenis'      => 'required',
        ]);

        $jenis = ucfirst(strtolower($request->jenis));
        if ($jenis !== 'Masuk' && $jenis !== 'Keluar') {
            $jenis = 'Masuk';
        }

        DataKas::create([
            'keterangan' => $request->keterangan,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'jenis'      => $jenis,
        ]);

        $route = $jenis === 'Masuk' ? 'kas.masuk' : 'kas.keluar';
        return redirect()->route($route)->with('success', 'Transaksi kas berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $kas = DataKas::findOrFail($id);
        $kas->update([
            'keterangan' => $request->keterangan,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
        ]);

        $route = $kas->jenis === 'Masuk' ? 'kas.masuk' : 'kas.keluar';
        return redirect()->route($route)->with('success', 'Transaksi kas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kas = DataKas::findOrFail($id);
        $jenis = $kas->jenis;
        $kas->delete();

        $route = $jenis === 'Masuk' ? 'kas.masuk' : 'kas.keluar';
        return redirect()->route($route)->with('success', 'Transaksi kas berhasil dihapus!');
    }

    public function kwitansi($id)
    {
        $kas = DataKas::findOrFail($id);
        return view('kas.kwitansi', compact('kas'));
    }

    public function laporan(Request $request)
    {
        $tgl_mulai   = $request->tgl_mulai ?: date('Y-m-01');
        $tgl_selesai = $request->tgl_selesai ?: date('Y-m-d');

        $kas_list = DataKas::whereBetween('tanggal', [$tgl_mulai, $tgl_selesai])
            ->orderBy('tanggal', 'ASC')
            ->get();

        $total_masuk  = DataKas::whereBetween('tanggal', [$tgl_mulai, $tgl_selesai])->where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar = DataKas::whereBetween('tanggal', [$tgl_mulai, $tgl_selesai])->where('jenis', 'Keluar')->sum('jumlah');
        $saldo        = $total_masuk - $total_keluar;

        return view('kas.laporan', compact('kas_list', 'tgl_mulai', 'tgl_selesai', 'total_masuk', 'total_keluar', 'saldo'));
    }

    public function kategori()
    {
        return view('kas.kategori');
    }
}
