<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Aspirasi;
use App\Models\BankSampah;
use App\Models\DataKas;
use App\Models\DataRt;
use App\Models\DataWarga;
use App\Models\IuranPayment;
use App\Models\PengurusRt;
use App\Models\Surat;
use App\Models\TransaksiTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmartRtController extends Controller
{
    // ==========================================
    // 1. KAS TRANSFER
    // ==========================================
    public function transfer()
    {
        $transfer_list = TransaksiTransfer::with('warga')->orderBy('id', 'DESC')->get();
        $total_masuk   = DataKas::where('jenis', 'Masuk')->sum('jumlah');
        $total_keluar  = DataKas::where('jenis', 'Keluar')->sum('jumlah');
        $saldo_kas     = $total_masuk - $total_keluar;
        $warga_list    = DataWarga::orderBy('nama', 'ASC')->get();

        return view('smartrt.transfer', compact('transfer_list', 'saldo_kas', 'warga_list'));
    }

    public function addTransfer(Request $request)
    {
        $request->validate([
            'jenis'      => 'required',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'required',
        ]);

        TransaksiTransfer::create([
            'warga_id'      => $request->warga_id ?: null,
            'jenis'         => $request->jenis,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
            'metode'        => $request->metode ?: 'Transfer Bank',
            'rekening_info' => $request->rekening_info ?: '-',
            'status'        => 'Disetujui',
            'created_at'    => now(),
        ]);

        // Catat juga ke DataKas
        DataKas::create([
            'keterangan' => '[TRANSFER] ' . $request->keterangan,
            'tanggal'    => date('Y-m-d'),
            'jumlah'     => $request->jumlah,
            'jenis'      => $request->jenis,
        ]);

        return redirect()->route('smartrt.transfer')->with('success', 'Transaksi transfer kas berhasil diproses!');
    }

    // ==========================================
    // 2. IURAN WARGA
    // ==========================================
    public function iuran()
    {
        $iuran_list = IuranPayment::with('warga')->orderBy('id', 'DESC')->get();
        $warga_list = DataWarga::orderBy('nama', 'ASC')->get();
        $total_terkumpul = IuranPayment::where('status', 'Disetujui')->sum('jumlah');

        return view('smartrt.iuran', compact('iuran_list', 'warga_list', 'total_terkumpul'));
    }

    public function iuranBayar(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'bulan'    => 'required',
            'tahun'    => 'required|numeric',
            'jumlah'   => 'required|numeric',
        ]);

        IuranPayment::create([
            'warga_id'      => $request->warga_id,
            'bulan'         => $request->bulan,
            'tahun'         => $request->tahun,
            'jumlah'        => $request->jumlah,
            'metode'        => $request->metode ?: 'Tunai',
            'status'        => 'Disetujui',
            'tanggal_bayar' => now(),
        ]);

        $warga = DataWarga::find($request->warga_id);
        $namaWarga = $warga ? $warga->nama : 'Warga';

        DataKas::create([
            'keterangan' => "Iuran Warga Bulan {$request->bulan} {$request->tahun} ({$namaWarga})",
            'tanggal'    => date('Y-m-d'),
            'jumlah'     => $request->jumlah,
            'jenis'      => 'Masuk',
        ]);

        return redirect()->route('smartrt.iuran')->with('success', 'Pembayaran iuran berhasil dicatat!');
    }

    public function iuranUpdateStatus($id, $status)
    {
        $i = IuranPayment::findOrFail($id);
        $i->update(['status' => $status]);
        return redirect()->route('smartrt.iuran')->with('success', 'Status iuran berhasil diperbarui!');
    }

    // ==========================================
    // 3. BANK SAMPAH
    // ==========================================
    public function banksampah()
    {
        $sampah_list = BankSampah::with('warga')->orderBy('id', 'DESC')->get();
        $warga_list  = DataWarga::orderBy('nama', 'ASC')->get();
        $total_berat = BankSampah::sum('berat');
        $total_poin  = BankSampah::sum('poin');

        return view('smartrt.banksampah', compact('sampah_list', 'warga_list', 'total_berat', 'total_poin'));
    }

    public function banksampahTambah(Request $request)
    {
        $request->validate([
            'warga_id'     => 'required',
            'jenis_sampah' => 'required',
            'berat'        => 'required|numeric',
        ]);

        $poin = (int)($request->berat * 100);

        BankSampah::create([
            'warga_id'     => $request->warga_id,
            'jenis_sampah' => $request->jenis_sampah,
            'berat'        => $request->berat,
            'poin'         => $poin,
            'tanggal'      => now(),
        ]);

        return redirect()->route('smartrt.banksampah')->with('success', 'Setoran bank sampah berhasil dicatat!');
    }

    // ==========================================
    // 4. SURAT PENGANTAR RT
    // ==========================================
    public function surat()
    {
        $surat_list = Surat::with('warga')->orderBy('id', 'DESC')->get();
        $warga_list = DataWarga::orderBy('nama', 'ASC')->get();

        return view('smartrt.surat', compact('surat_list', 'warga_list'));
    }

    public function suratAjukan(Request $request)
    {
        $request->validate([
            'warga_id'    => 'required',
            'jenis_surat' => 'required',
            'keperluan'   => 'required',
        ]);

        Surat::create([
            'warga_id'          => $request->warga_id,
            'jenis_surat'       => $request->jenis_surat,
            'keperluan'         => $request->keperluan,
            'status'            => 'Pending',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()->route('smartrt.surat')->with('success', 'Permohonan surat berhasil diajukan!');
    }

    public function suratUpdateStatus($id, $status)
    {
        $s = Surat::findOrFail($id);
        $s->update(['status' => $status]);
        return redirect()->route('smartrt.surat')->with('success', 'Status surat berhasil diperbarui!');
    }

    // ==========================================
    // 5. ASPIRASI WARGA
    // ==========================================
    public function aspirasi()
    {
        $aspirasi_list = Aspirasi::orderBy('id', 'DESC')->get();
        return view('smartrt.aspirasi', compact('aspirasi_list'));
    }

    public function aspirasiKirim(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required',
            'kategori'      => 'required',
            'isi'           => 'required',
        ]);

        Aspirasi::create([
            'nama_pengirim' => $request->nama_pengirim,
            'kategori'      => $request->kategori,
            'isi'           => $request->isi,
            'tanggal_kirim' => now(),
        ]);

        return redirect()->route('smartrt.aspirasi')->with('success', 'Aspirasi Anda berhasil dikirim ke Pengurus RT!');
    }

    // ==========================================
    // 6. INVENTARIS / ASET RT
    // ==========================================
    public function aset()
    {
        $aset_list   = Aset::orderBy('id', 'DESC')->get();
        $total_items = Aset::sum('jumlah');

        return view('smartrt.aset', compact('aset_list', 'total_items'));
    }

    public function asetTambah(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah'      => 'required|numeric',
            'kondisi'     => 'required',
        ]);

        Aset::create([
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $request->jumlah,
            'kondisi'     => $request->kondisi,
            'lokasi'      => $request->lokasi ?: 'Gudang RT',
        ]);

        return redirect()->route('smartrt.aset')->with('success', 'Data aset inventaris berhasil ditambahkan!');
    }

    public function asetHapus($id)
    {
        Aset::destroy($id);
        return redirect()->route('smartrt.aset')->with('success', 'Aset berhasil dihapus!');
    }

    // ==========================================
    // 7. PENGURUS RT & PROFIL RT
    // ==========================================
    public function pengurus()
    {
        $pengurus_list = PengurusRt::all();
        return view('smartrt.pengurus', compact('pengurus_list'));
    }

    public function datart()
    {
        $profil = DataRt::first();
        return view('smartrt.datart', compact('profil'));
    }

    public function datartUpdate(Request $request)
    {
        $profil = DataRt::first() ?: new DataRt();
        $profil->fill($request->all());
        $profil->save();

        return redirect()->route('smartrt.datart')->with('success', 'Profil RT berhasil diperbarui!');
    }

    // ==========================================
    // 8. BACKUP DATA
    // ==========================================
    public function backup()
    {
        return view('smartrt.backup');
    }
}

