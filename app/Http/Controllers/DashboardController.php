<?php

namespace App\Http\Controllers;

use App\Models\DataKas;
use App\Models\DataWarga;
use App\Models\PosyanduBalita;
use App\Models\PosyanduSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_masuk  = (float) DataKas::where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar = (float) DataKas::where('jenis', 'Keluar')->sum('jumlah');
        $saldo        = $total_masuk - $total_keluar;

        $currentYearMonth = date('Y-m');
        $masuk_bulan_ini  = (float) DataKas::where('jenis', 'Masuk')->where('tanggal', 'like', $currentYearMonth . '%')->sum('jumlah');
        $keluar_bulan_ini = (float) DataKas::where('jenis', 'Keluar')->where('tanggal', 'like', $currentYearMonth . '%')->sum('jumlah');
        $surplus_bulan_ini = $masuk_bulan_ini - $keluar_bulan_ini;

        $total_warga  = DataWarga::count();
        $total_balita = PosyanduBalita::count();
        $total_kk     = DataWarga::whereNotNull('no_kk')->where('no_kk', '!=', '')->distinct('no_kk')->count('no_kk') ?: (int)($total_warga / 3);

        $transaksi_terbaru = DataKas::orderBy('tanggal', 'DESC')->orderBy('idKas', 'DESC')->limit(7)->get();

        // 6 Bulan Terakhir untuk Grafik Trend
        $chart_labels = [];
        $chart_masuk  = [];
        $chart_keluar = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthTime = strtotime("-$i months");
            $ym = date('Y-m', $monthTime);
            $chart_labels[] = date('M Y', $monthTime);

            $m = (float) DataKas::where('jenis', 'Masuk')->where('tanggal', 'like', $ym . '%')->sum('jumlah');
            $k = (float) DataKas::where('jenis', 'Keluar')->where('tanggal', 'like', $ym . '%')->sum('jumlah');

            $chart_masuk[]  = $m;
            $chart_keluar[] = $k;
        }

        // Rasio Kesehatan Keuangan RT (Persentase surplus)
        $rasio_keuangan = $total_masuk > 0 ? min(100, max(0, round(($saldo / $total_masuk) * 100))) : 100;

        $sesi_aktif = PosyanduSesi::where('status', 'Aktif')->first();

        return view('dashboard.index', compact(
            'total_masuk',
            'total_keluar',
            'saldo',
            'masuk_bulan_ini',
            'keluar_bulan_ini',
            'surplus_bulan_ini',
            'total_warga',
            'total_balita',
            'total_kk',
            'transaksi_terbaru',
            'chart_labels',
            'chart_masuk',
            'chart_keluar',
            'rasio_keuangan',
            'sesi_aktif'
        ));
    }
}
