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
        $validated = $request->validate([
            'nik'               => 'required|string|max:50',
            'no_kk'             => 'nullable|string|max:50',
            'nama'              => 'required|string|max:50',
            'hubungan_keluarga' => 'nullable|string|max:50',
            'jekel'             => 'nullable|string|max:20',
            'rfid_ktp'          => 'nullable|string|max:50',
            'tempat_lahir'      => 'nullable|string|max:100',
            'tanggal_lahir'     => 'nullable|date',
            'alamat'            => 'nullable|string',
            'no_rumah'          => 'nullable|string|max:50',
            'no_hp'             => 'nullable|string|max:30',
        ]);

        try {
            $data = [
                'nik'               => trim($validated['nik']),
                'no_kk'             => $request->filled('no_kk') ? trim($request->input('no_kk')) : null,
                'nama'              => trim($validated['nama']),
                'hubungan_keluarga' => $request->input('hubungan_keluarga') ?: 'Kepala Keluarga',
                'jekel'             => $request->input('jekel') ?: 'Laki-Laki',
                'rfid_ktp'          => $request->filled('rfid_ktp') ? strtoupper(trim($request->input('rfid_ktp'))) : null,
                'tempat_lahir'      => $request->filled('tempat_lahir') ? trim($request->input('tempat_lahir')) : '-',
                'tanggal_lahir'     => $request->filled('tanggal_lahir') ? $request->input('tanggal_lahir') : '2000-01-01',
                'alamat'            => $request->filled('alamat') ? trim($request->input('alamat')) : '-',
                'no_rumah'          => $request->filled('no_rumah') ? strtoupper(trim($request->input('no_rumah'))) : null,
                'no_hp'             => $request->filled('no_hp') ? trim($request->input('no_hp')) : null,
                'status_warga'      => 'Terverifikasi',
            ];

            DataWarga::create($data);
            return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data warga: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $w = DataWarga::findOrFail($id);

        $validated = $request->validate([
            'nik'               => 'required|string|max:50',
            'no_kk'             => 'nullable|string|max:50',
            'nama'              => 'required|string|max:50',
            'hubungan_keluarga' => 'nullable|string|max:50',
            'jekel'             => 'nullable|string|max:20',
            'rfid_ktp'          => 'nullable|string|max:50',
            'tempat_lahir'      => 'nullable|string|max:100',
            'tanggal_lahir'     => 'nullable|date',
            'alamat'            => 'nullable|string',
            'no_rumah'          => 'nullable|string|max:50',
            'no_hp'             => 'nullable|string|max:30',
        ]);

        try {
            $w->update([
                'nik'               => trim($validated['nik']),
                'no_kk'             => $request->filled('no_kk') ? trim($request->input('no_kk')) : null,
                'nama'              => trim($validated['nama']),
                'hubungan_keluarga' => $request->input('hubungan_keluarga') ?: $w->hubungan_keluarga,
                'jekel'             => $request->input('jekel') ?: $w->jekel,
                'rfid_ktp'          => $request->filled('rfid_ktp') ? strtoupper(trim($request->input('rfid_ktp'))) : null,
                'tempat_lahir'      => $request->filled('tempat_lahir') ? trim($request->input('tempat_lahir')) : ($w->tempat_lahir ?: '-'),
                'tanggal_lahir'     => $request->filled('tanggal_lahir') ? $request->input('tanggal_lahir') : ($w->tanggal_lahir ?: '2000-01-01'),
                'alamat'            => $request->filled('alamat') ? trim($request->input('alamat')) : ($w->alamat ?: '-'),
                'no_rumah'          => $request->filled('no_rumah') ? strtoupper(trim($request->input('no_rumah'))) : null,
                'no_hp'             => $request->filled('no_hp') ? trim($request->input('no_hp')) : $w->no_hp,
            ]);

            return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data warga: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DataWarga::destroy($id);
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
