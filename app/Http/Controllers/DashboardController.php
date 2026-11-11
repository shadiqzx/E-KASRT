<?php

namespace App\Http\Controllers;

use App\Models\DataKas;
use App\Models\DataWarga;
use App\Models\PosyanduBalita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_masuk  = DataKas::where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar = DataKas::where('jenis', 'Keluar')->sum('jumlah');
        $saldo        = $total_masuk - $total_keluar;

        $total_warga  = DataWarga::count();
        $total_balita = PosyanduBalita::count();

        $transaksi_terbaru = DataKas::orderBy('tanggal', 'DESC')->limit(5)->get();

        return view('dashboard.index', compact(
            'total_masuk',
            'total_keluar',
            'saldo',
            'total_warga',
            'total_balita',
            'transaksi_terbaru'
        ));
    }
}

