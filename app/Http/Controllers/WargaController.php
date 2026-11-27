<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $warga = DataWarga::orderBy('no_rumah', 'ASC')
            ->orderBy('no_kk', 'ASC')
            ->orderBy('idWarga', 'ASC')
            ->get();

        // Kelompokkan data warga berdasarkan Rumah (no_rumah atau alamat) lalu berdasarkan No. KK
        $rumahMap = [];
        foreach ($warga as $w) {
            $kodeRumah = trim((string) ($w->no_rumah ?? ''));
            $alamat    = trim((string) ($w->alamat ?? ''));

            if ($kodeRumah !== '') {
                $key = strtoupper($kodeRumah);
            } elseif ($alamat !== '') {
                $key = strtoupper($alamat);
            } else {
                $key = 'BELUM-TERDATA';
            }

            if (!isset($rumahMap[$key])) {
                $blok = '-';
                if (preg_match('/^([A-Z])/i', $kodeRumah, $m)) {
                    $blok = strtoupper($m[1]);
                } elseif (preg_match('/Blok\s+([A-Z])/i', $alamat, $m)) {
                    $blok = strtoupper($m[1]);
                }

                $rumahMap[$key] = [
                    'key' => $key,
                    'kode_rumah' => $kodeRumah !== '' ? strtoupper($kodeRumah) : 'N/A',
                    'blok' => $blok,
                    'alamat' => $alamat !== '' ? $alamat : 'Alamat belum dilengkapi',
                    'total_jiwa' => 0,
                    'kk_groups' => [],
                ];
            }

            // Update alamat jika sebelumnya kosong
            if ($rumahMap[$key]['alamat'] === 'Alamat belum dilengkapi' && $alamat !== '') {
                $rumahMap[$key]['alamat'] = $alamat;
            }

            $noKk = trim((string) ($w->no_kk ?? ''));
            $kkKey = $noKk !== '' ? $noKk : 'NO-KK-' . $w->idWarga;

            if (!isset($rumahMap[$key]['kk_groups'][$kkKey])) {
                $rumahMap[$key]['kk_groups'][$kkKey] = [
                    'no_kk' => $noKk !== '' ? $noKk : 'Belum Ada No. KK',
                    'kepala' => $w->nama,
                    'anggota' => [],
                ];
            }

            if (stripos((string) $w->hubungan_keluarga, 'kepala') !== false) {
                $rumahMap[$key]['kk_groups'][$kkKey]['kepala'] = $w->nama;
            }

            $rumahMap[$key]['kk_groups'][$kkKey]['anggota'][] = $w;
            $rumahMap[$key]['total_jiwa']++;
        }

        // Susun ulang menjadi list terurut berdasarkan kode rumah
        ksort($rumahMap, SORT_NATURAL);
        $rumahGroups = [];
        $totalKk = 0;
        $rumahMultiKk = 0;
        $mapHouses = [];

        foreach ($rumahMap as $r) {
            $kkList = array_values($r['kk_groups']);
            $kkCount = count($kkList);
            $totalKk += $kkCount;
            if ($kkCount > 1) {
                $rumahMultiKk++;
            }

            $r['kk_groups'] = $kkList;
            $r['total_kk'] = $kkCount;
            $rumahGroups[] = $r;

            $mapHouses[] = [
                'key' => $r['key'],
                'kode_rumah' => $r['kode_rumah'],
                'blok' => $r['blok'],
                'alamat' => $r['alamat'],
                'total_kk' => $kkCount,
                'total_jiwa' => $r['total_jiwa'],
                'kk_list' => array_map(function ($kk) {
                    return [
                        'no_kk' => $kk['no_kk'],
                        'kepala' => $kk['kepala'],
                        'anggota' => array_map(function ($a) {
                            return [
                                'id' => $a->idWarga,
                                'nama' => $a->nama,
                                'nik' => $a->nik,
                                'hubungan' => $a->hubungan_keluarga ?: 'Anggota',
                                'jekel' => $a->jekel,
                                'rfid' => $a->rfid_ktp,
                            ];
                        }, $kk['anggota']),
                    ];
                }, $kkList),
            ];
        }

        $totalWarga = $warga->count();
        $totalRumah = count($rumahGroups);

        return view('warga.index', compact(
            'warga',
            'rumahGroups',
            'mapHouses',
            'totalWarga',
            'totalRumah',
            'totalKk',
            'rumahMultiKk'
        ));
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
