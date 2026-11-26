<?php

namespace App\Services;

use App\Models\AiChatLog;
use App\Models\AiSetting;
use App\Models\Aset;
use App\Models\BankSampah;
use App\Models\DataKas;
use App\Models\DataRt;
use App\Models\DataWarga;
use App\Models\IuranPayment;
use App\Models\PengurusRt;
use App\Models\PosyanduBalita;
use App\Models\PosyanduSesi;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class AiCustomerService
{
    /**
     * Ambil pengaturan AI CS (dengan fallback aman jika tabel belum dimigrasi).
     */
    public function getSettings(): array
    {
        $defaults = [
            'bot_name'        => 'KasBot AI (CS E-KASRT)',
            'welcome_message' => 'Halo! Saya Asisten Virtual E-KASRT. Ada yang bisa saya bantu seputar Kas RT, Iuran Warga, Pendaftaran & Verifikasi Akun, Posyandu Balita, Surat Pengantar, atau layanan Smart RT lainnya?',
            'gemini_api_key'  => config('services.gemini.key'),
            'gemini_model'    => config('services.gemini.model', 'gemini-2.5-flash'),
            'system_prompt'   => null,
            'whatsapp_cs'     => null,
            'is_enabled'      => true,
        ];

        try {
            if (Schema::hasTable('ai_settings')) {
                $row = AiSetting::first();
                if ($row) {
                    return [
                        'bot_name'        => $row->bot_name ?: $defaults['bot_name'],
                        'welcome_message' => $row->welcome_message ?: $defaults['welcome_message'],
                        'gemini_api_key'  => $row->gemini_api_key ?: $defaults['gemini_api_key'],
                        'gemini_model'    => $row->gemini_model ?: $defaults['gemini_model'],
                        'system_prompt'   => $row->system_prompt,
                        'whatsapp_cs'     => $row->whatsapp_cs,
                        'is_enabled'      => (bool) $row->is_enabled,
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Gunakan default aman bila database belum siap
        }

        return $defaults;
    }

    /**
     * Proses pesan pengguna menjadi balasan Customer Service AI (Gemini + Smart E-KASRT NLP Fallback).
     */
    public function answer(
        string $message,
        string $sessionId,
        ?User $user = null,
        array $conversationHistory = [],
        ?string $lastIntent = null
    ): array {
        $cleanMessage = trim($message);
        $settings = $this->getSettings();
        $liveData = $this->gatherLiveContext($user);

        // Cek terlebih dahulu apakah user menanyakan status pendaftaran berdasarkan NIK / username eksplisit
        $regCheck = $this->tryCheckRegistrationFromMessage($cleanMessage);
        if ($regCheck !== null) {
            $result = [
                'reply'       => $regCheck['reply'],
                'intent'      => 'check_registration_status',
                'engine'      => 'smart-nlp-db',
                'suggestions' => ['Cara daftar warga baru', 'Cara login ke portal', 'Kontak Pengurus RT'],
                'actions'     => $this->buildActions('check_registration_status', $user !== null),
            ];
            $this->logChat($sessionId, $user, $cleanMessage, $result);

            return $result;
        }

        // Gunakan Google Gemini API jika API Key dikonfigurasi
        if (!empty($settings['gemini_api_key'])) {
            $geminiReply = $this->askGemini($cleanMessage, $settings, $liveData, $user, $conversationHistory);
            if ($geminiReply !== null) {
                $detectedIntent = $this->detectIntent($cleanMessage, $lastIntent, $user !== null)['intent'];
                $result = [
                    'reply'       => $geminiReply,
                    'intent'      => $detectedIntent,
                    'engine'      => 'gemini-ai',
                    'suggestions' => $this->suggestionsForIntent($detectedIntent, $user !== null),
                    'actions'     => $this->buildActions($detectedIntent, $user !== null),
                ];
                $this->logChat($sessionId, $user, $cleanMessage, $result);

                return $result;
            }
        }

        // Smart E-KASRT Indonesian NLP + Live DB Engine (aktif 24/7 tanpa API key eksternal)
        $detected = $this->detectIntent($cleanMessage, $lastIntent, $user !== null);
        $reply = $this->composeLocalReply($detected['intent'], $cleanMessage, $liveData, $user, $settings);

        $result = [
            'reply'       => $reply,
            'intent'      => $detected['intent'],
            'engine'      => 'smart-nlp',
            'suggestions' => $this->suggestionsForIntent($detected['intent'], $user !== null),
            'actions'     => $this->buildActions($detected['intent'], $user !== null),
        ];

        $this->logChat($sessionId, $user, $cleanMessage, $result);

        return $result;
    }

    /**
     * Kumpulkan data riil terbaru dari database E-KASRT agar jawaban selalu faktual.
     */
    public function gatherLiveContext(?User $user = null): array
    {
        $ctx = [
            'rt' => [
                'rt_number'     => '005',
                'rw_number'     => '012',
                'kelurahan'     => 'Mekarjaya',
                'kecamatan'     => 'Sukmajaya',
                'kota'          => 'Kota Depok',
                'jam_kerja_rt'  => 'Senin - Sabtu (19:00 - 21:00 WIB)',
                'norek_bca'     => '-',
                'norek_mandiri' => '-',
                'jumlah_kk'     => 0,
            ],
            'kas' => [
                'masuk'   => 0.0,
                'keluar'  => 0.0,
                'saldo'   => 0.0,
                'count'   => 0,
                'recent'  => [],
            ],
            'warga_count'   => 0,
            'balita_count'  => 0,
            'sesi_posyandu' => null,
            'pengurus'      => [],
            'aset_count'    => 0,
            'sampah_kg'     => 0.0,
            'personal'      => null,
        ];

        try {
            $rt = DataRt::first();
            if ($rt) {
                $ctx['rt'] = [
                    'rt_number'     => $rt->rt_number ?: '005',
                    'rw_number'     => $rt->rw_number ?: '012',
                    'kelurahan'     => $rt->kelurahan ?: '-',
                    'kecamatan'     => $rt->kecamatan ?: '-',
                    'kota'          => $rt->kota ?: '-',
                    'jam_kerja_rt'  => $rt->jam_kerja_rt ?: 'Senin - Sabtu (19:00 - 21:00 WIB)',
                    'norek_bca'     => $rt->norek_bca ?: '-',
                    'norek_mandiri' => $rt->norek_mandiri ?: '-',
                    'jumlah_kk'     => (int) ($rt->jumlah_kk ?: 0),
                ];
            }

            $masuk = (float) DataKas::where('jenis', 'Masuk')->sum('jumlah');
            $keluar = (float) DataKas::where('jenis', 'Keluar')->sum('jumlah');
            $ctx['kas'] = [
                'masuk'  => $masuk,
                'keluar' => $keluar,
                'saldo'  => $masuk - $keluar,
                'count'  => DataKas::count(),
                'recent' => DataKas::orderBy('idKas', 'DESC')
                    ->limit(3)
                    ->get(['keterangan', 'tanggal', 'jumlah', 'jenis'])
                    ->toArray(),
            ];

            $ctx['warga_count'] = DataWarga::count();
            $ctx['balita_count'] = PosyanduBalita::count();
            $ctx['aset_count'] = Aset::count();
            $ctx['sampah_kg'] = (float) BankSampah::sum('berat');

            $sesi = PosyanduSesi::where('status', 'Aktif')->first()
                ?: PosyanduSesi::where('status', 'Dijadwalkan')->orderBy('tanggal', 'ASC')->first();

            if ($sesi) {
                $ctx['sesi_posyandu'] = [
                    'nama_sesi'   => $sesi->nama_sesi,
                    'tanggal'     => $sesi->tanggal ? date('d M Y', strtotime($sesi->tanggal)) : '-',
                    'waktu_mulai' => $sesi->waktu_mulai ?: '08:00',
                    'lokasi'      => $sesi->lokasi ?: 'Balai Warga RT',
                    'petugas'     => $sesi->petugas ?: 'Kader Posyandu & Bidan',
                    'status'      => $sesi->status,
                ];
            }

            $ctx['pengurus'] = PengurusRt::where('status_aktif', 'Aktif')
                ->limit(4)
                ->get(['nama', 'jabatan', 'no_hp'])
                ->toArray();

            if ($user) {
                $warga = null;
                if (!empty($user->nik)) {
                    $warga = DataWarga::where('nik', $user->nik)->first();
                }
                if (!$warga && !empty($user->user)) {
                    $warga = DataWarga::where('nama', $user->user)->first();
                }

                $bulanIndo = [
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                    '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
                ];
                $bulanIni = $bulanIndo[date('m')];
                $tahunIni = (int) date('Y');

                $iuranLunas = false;
                $suratTerbaru = null;
                if ($warga) {
                    $iuranLunas = IuranPayment::where('warga_id', $warga->idWarga)
                        ->where('bulan', $bulanIni)
                        ->where('tahun', $tahunIni)
                        ->where('status', 'Disetujui')
                        ->exists();

                    $suratTerbaru = Surat::where('warga_id', $warga->idWarga)
                        ->orderBy('id', 'DESC')
                        ->first();
                }

                $ctx['personal'] = [
                    'nama'            => $user->user ?: $user->username,
                    'role'            => $user->role->role ?? 'Warga',
                    'status_verif'    => $user->status_verifikasi ?: 'Disetujui',
                    'bulan_ini'       => $bulanIni . ' ' . $tahunIni,
                    'warga_linked'    => (bool) $warga,
                    'rfid_linked'     => $warga && !empty($warga->rfid_ktp),
                    'iuran_lunas'     => $iuranLunas,
                    'surat_terbaru'   => $suratTerbaru ? ($suratTerbaru->jenis_surat . ' (' . $suratTerbaru->status . ')') : null,
                ];
            }
        } catch (\Throwable $e) {
            // Abaikan error partial DB query agar CS tetap responsif
        }

        return $ctx;
    }

    /**
     * Cek status verifikasi pendaftaran warga jika pengguna menyebut NIK 16 digit atau "cek status <keyword>".
     */
    private function tryCheckRegistrationFromMessage(string $message): ?array
    {
        $keyword = null;

        if (preg_match('/\b(\d{16})\b/', $message, $m)) {
            $keyword = $m[1];
        } elseif (preg_match('/(?:cek\s+status|status\s+pendaftaran|status\s+akun|verifikasi)\s*(?:nik|username|atas\s+nama)?\s*[:#]?\s*([A-Za-z0-9_.-]{3,50})/i', $message, $m)) {
            $candidate = trim($m[1]);
            $ignored = ['saya', 'akun', 'warga', 'pendaftaran', 'daftar', 'baru', 'apa', 'dong', 'gimana', 'ini'];
            if (!in_array(strtolower($candidate), $ignored, true)) {
                $keyword = $candidate;
            }
        }

        if ($keyword === null) {
            return null;
        }

        try {
            $found = User::where('nik', $keyword)
                ->orWhere('username', $keyword)
                ->first();

            if (!$found) {
                return [
                    'reply' => "Data pendaftaran untuk **{$keyword}** tidak ditemukan di sistem E-KASRT.\n\n"
                        . "Pastikan **16 digit NIK KTP** atau **username** yang Anda masukkan sudah benar, atau silakan daftar terlebih dahulu melalui halaman **Daftar Akun Baru**.",
                ];
            }

            $nama = $found->user ?: $found->username;
            $status = $found->status_verifikasi ?: 'Disetujui';
            $tglDaftar = $found->tgl_daftar ? date('d M Y H:i', strtotime($found->tgl_daftar)) . ' WIB' : '-';

            if ($status === 'Menunggu Verifikasi') {
                return [
                    'reply' => "⏳ **Status Pendaftaran: Menunggu Verifikasi**\n"
                        . "• Nama: **{$nama}**\n"
                        . "• Username: `{$found->username}`\n"
                        . "• Waktu Daftar: {$tglDaftar}\n\n"
                        . "Akun Anda masih dalam antrean peninjauan Pengurus RT demi keamanan data warga. Mohon menunggu persetujuan atau hubungi Pengurus RT.",
                ];
            }

            if ($status === 'Ditolak') {
                $alasan = $found->alasan_tolak ?: 'Data tidak sesuai atau bukan warga domisili RT setempat.';

                return [
                    'reply' => "❌ **Status Pendaftaran: Ditolak**\n"
                        . "• Nama: **{$nama}**\n"
                        . "• Username: `{$found->username}`\n"
                        . "• Alasan Penolakan: *\"{$alasan}\"*\n\n"
                        . "Silakan hubungi Pengurus RT apabila ingin mengajukan peninjauan ulang data.",
                ];
            }

            return [
                'reply' => "✅ **Status Akun: Disetujui & Aktif**\n"
                    . "• Nama: **{$nama}**\n"
                    . "• Username: `{$found->username}`\n\n"
                    . "Akun Anda sudah aktif! Silakan langsung masuk melalui halaman **Login**.",
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Deteksi intent utama pertanyaan berbahasa Indonesia (termasuk singkatan sehari-hari).
     */
    public function detectIntent(string $message, ?string $lastIntent = null, bool $isLoggedIn = false): array
    {
        $text = strtolower($message);
        $normalized = $this->normalizeIndonesianSlang($text);

        // Pertanyaan tindak lanjut singkat berdasarkan konteks sebelumnya
        if ($lastIntent && preg_match('/^(caranya|gimana caranya|terus|lalu|dimana menunya|linknya|bisa dijelaskan lagi|contohnya)\??$/i', trim($normalized))) {
            return ['intent' => $lastIntent, 'score' => 5];
        }

        $rules = [
            'personal_status' => [
                'keywords' => ['iuran saya', 'surat saya', 'status saya', 'sudah bayar belum', 'tagihan saya', 'tunggakan saya', 'ktp saya terhubung'],
                'weight'   => 12,
            ],
            'check_registration_status' => [
                'keywords' => ['cek status', 'status pendaftaran', 'sudah diverifikasi', 'belum diverifikasi', 'acc', 'disetujui', 'ditolak', 'menunggu verifikasi', 'verifikasi akun', 'verifikasi warga', 'akun belum aktif'],
                'weight'   => 10,
            ],
            'kas_saldo' => [
                'keywords' => ['saldo', 'kas rt', 'uang kas', 'pemasukan', 'pengeluaran', 'laporan kas', 'keuangan rt', 'dana rt', 'total kas', 'mutasi', 'transparansi'],
                'weight'   => 9,
            ],
            'iuran_bayar' => [
                'keywords' => ['iuran', 'bayar iuran', 'rekening', 'norek', 'bca', 'mandiri', 'qris', 'transfer', 'kebersihan', 'keamanan', 'tagihan', 'bulanan', 'kwitansi'],
                'weight'   => 9,
            ],
            'register_login' => [
                'keywords' => ['daftar', 'registrasi', 'buat akun', 'bikin akun', 'pendaftaran', 'login', 'masuk', 'lupa password', 'password', 'kata sandi', 'username'],
                'weight'   => 8,
            ],
            'posyandu' => [
                'keywords' => ['posyandu', 'balita', 'kms', 'timbang', 'imunisasi', 'vitamin', 'bidan', 'anak', 'jadwal posyandu', 'tap ktp'],
                'weight'   => 9,
            ],
            'surat_pengantar' => [
                'keywords' => ['surat', 'pengantar', 'domisili', 'sktm', 'nikah', 'ktp', 'kk', 'kelurahan', 'administrasi', 'buat surat'],
                'weight'   => 8,
            ],
            'bank_sampah' => [
                'keywords' => ['sampah', 'bank sampah', 'daur ulang', 'poin sampah', 'plastik', 'kardus', 'setor sampah'],
                'weight'   => 9,
            ],
            'aspirasi_aset' => [
                'keywords' => ['aspirasi', 'keluhan', 'lapor', 'pengaduan', 'saran', 'aset', 'inventaris', 'pinjam', 'tenda', 'kursi', 'sound'],
                'weight'   => 8,
            ],
            'iot_rfid' => [
                'keywords' => ['rfid', 'esp32', 'scanner', 'alat', 'tap kartu', 'e-ktp', 'ektp', 'nfc', 'sensor', 'heartbeat'],
                'weight'   => 7,
            ],
            'kontak_rt' => [
                'keywords' => ['pengurus', 'ketua rt', 'pak rt', 'bu rt', 'sekretaris', 'bendahara', 'kontak', 'hubungi', 'whatsapp', 'wa', 'jam kerja', 'jam buka', 'alamat rt', 'lokasi rt', 'sekretariat'],
                'weight'   => 8,
            ],
            'app_android' => [
                'keywords' => ['aplikasi', 'apk', 'android', 'hp', 'download app', 'mobile'],
                'weight'   => 7,
            ],
            'greeting' => [
                'keywords' => ['halo', 'hai', 'hello', 'hi', 'assalamualaikum', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam', 'permisi', 'p', 'menu', 'bantuan', 'tolong', 'fitur'],
                'weight'   => 4,
            ],
            'thanks' => [
                'keywords' => ['makasih', 'terima kasih', 'thanks', 'thank you', 'oke siap', 'sip', 'mantap', 'paham', 'cukup'],
                'weight'   => 5,
            ],
        ];

        $bestIntent = 'fallback';
        $bestScore = 0;

        foreach ($rules as $intent => $rule) {
            if ($intent === 'personal_status' && !$isLoggedIn) {
                continue;
            }
            $score = 0;
            foreach ($rule['keywords'] as $kw) {
                if (str_contains($normalized, $kw)) {
                    $score += $rule['weight'] + (str_contains($kw, ' ') ? 4 : 0);
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestIntent = $intent;
            }
        }

        // Tangani pertanyaan tunggal seperti "halo saya mau tanya iuran" -> kalahkan greeting oleh iuran
        if ($bestScore === 0) {
            $bestIntent = 'fallback';
        }

        return ['intent' => $bestIntent, 'score' => $bestScore];
    }

    /**
     * Normalisasi singkatan / bahasa chat Indonesia agar pencocokan intent lebih akurat.
     */
    private function normalizeIndonesianSlang(string $text): string
    {
        $map = [
            '/\bgmn\b|\bgimana\b|\bbgmn\b/' => 'bagaimana',
            '/\bbrp\b/'                     => 'berapa',
            '/\bbyr\b/'                     => 'bayar',
            '/\btrf\b/'                     => 'transfer',
            '/\bverif\b/'                   => 'verifikasi',
            '/\bsdh\b|\budh\b/'             => 'sudah',
            '/\bblm\b/'                     => 'belum',
            '/\bmksh\b|\btq\b|\bthx\b/'     => 'makasih',
            '/\bsy\b|\baqu\b|\bak\b|\bgua\b|\bgw\b/' => 'saya',
            '/\bktp\b|\bekatape\b/'         => 'ktp',
            '/\bpwd\b|\bpass\b|\bsandi\b/'  => 'password',
            '/\brek\b/'                     => 'rekening',
            '/\bwa\b/'                      => 'whatsapp',
            '/\btlg\b/'                     => 'tolong',
        ];

        return preg_replace(array_keys($map), array_values($map), $text) ?? $text;
    }

    /**
     * Susun balasan informatif terstruktur menggunakan data database real-time.
     */
    private function composeLocalReply(
        string $intent,
        string $message,
        array $live,
        ?User $user,
        array $settings
    ): string {
        $rt = $live['rt'];
        $kas = $live['kas'];
        $rtTitle = "RT {$rt['rt_number']} / RW {$rt['rw_number']} Kel. {$rt['kelurahan']}";

        switch ($intent) {
            case 'greeting':
                $sapaNama = $user ? "**{$user->user}**" : "Warga {$rtTitle}";

                return "Halo {$sapaNama}! 👋 Saya **{$settings['bot_name']}**, layanan Customer Service 24/7 untuk portal **E-KASRT**.\n\n"
                    . "Saya bisa membantu Anda dengan cepat untuk:\n"
                    . "• 💰 Cek **Saldo Kas RT** terbaru (Saat ini: **Rp " . rupiah($kas['saldo']) . "**)\n"
                    . "• 💳 Info pembayaran **Iuran Warga** & verifikasi tap e-KTP\n"
                    . "• 📝 Panduan **Daftar Akun** & **Cek Status Verifikasi** (ketik `cek status [NIK]`)\n"
                    . "• 👶 Jadwal **Posyandu Balita IoT** & cetak KMS\n"
                    . "• 📄 Pengajuan **Surat Pengantar RT**, Bank Sampah & Aspirasi\n\n"
                    . "Silakan ketik pertanyaan Anda atau pilih topik cepat di bawah!";

            case 'personal_status':
                $p = $live['personal'];
                if (!$p) {
                    return "Silakan login terlebih dahulu agar saya dapat memeriksa status iuran & surat akun Anda.";
                }
                $iuranText = $p['iuran_lunas']
                    ? "✅ **LUNAS** untuk bulan {$p['bulan_ini']}"
                    : "⏳ **Belum tercatat lunas** untuk bulan {$p['bulan_ini']} (Rp 50.000)";
                $ktpText = $p['rfid_linked'] ? "✅ Sudah tertaut ke e-KTP" : "⚠️ Belum ditautkan ke e-KTP (bisa ditautkan oleh pengurus RT)";
                $suratText = $p['surat_terbaru'] ?: "Belum ada pengajuan surat terbaru";

                return "Berikut ringkasan status akun Anda (**{$p['nama']}** - Role: {$p['role']}):\n"
                    . "• **Verifikasi Akun:** {$p['status_verif']}\n"
                    . "• **Iuran {$p['bulan_ini']}:** {$iuranText}\n"
                    . "• **Kartu e-KTP Smart RT:** {$ktpText}\n"
                    . "• **Surat Terakhir:** {$suratText}";

            case 'check_registration_status':
                return "🔍 **Cara Cek Status Verifikasi Pendaftaran Warga:**\n"
                    . "Anda bisa mengecek status persetujuan akun langsung di sini! Ketik saja:\n"
                    . "• `cek status [16 digit NIK KTP]` atau `cek status [username]`\n\n"
                    . "**Alur Verifikasi Akun Baru:**\n"
                    . "1. Warga mendaftar di menu **Daftar Akun Baru** (`/register`).\n"
                    . "2. Pengurus RT meninjau data kependudukan di menu **Verifikasi Warga**.\n"
                    . "3. Jika disetujui, akun otomatis aktif dan Anda langsung bisa login.";

            case 'kas_saldo':
                $recentLines = '';
                if (!empty($kas['recent'])) {
                    $recentLines = "\n\n**3 Aktivitas Kas Terbaru:**\n";
                    foreach ($kas['recent'] as $item) {
                        $icon = ($item['jenis'] === 'Masuk') ? '🟢 +' : '🔴 -';
                        $tgl = $item['tanggal'] ? date('d/m/Y', strtotime($item['tanggal'])) : '-';
                        $recentLines .= "• {$icon}Rp " . rupiah((float) $item['jumlah']) . " — {$item['keterangan']} ({$tgl})\n";
                    }
                }

                return "📊 **Laporan Ringkas Keuangan {$rtTitle}:**\n"
                    . "• **Saldo Kas Saat Ini:** **Rp " . rupiah($kas['saldo']) . "**\n"
                    . "• **Total Pemasukan:** Rp " . rupiah($kas['masuk']) . "\n"
                    . "• **Total Pengeluaran:** Rp " . rupiah($kas['keluar']) . "\n"
                    . "• **Total Transaksi Tercatat:** {$kas['count']} transaksi"
                    . $recentLines
                    . ($user ? "\nDetail lengkap & cetak laporan tersedia di menu **Laporan Kas**." : "\nSilakan **Login** untuk melihat rincian mutasi dan cetak laporan kas.");

            case 'iuran_bayar':
                return "💳 **Panduan & Metode Pembayaran Iuran Warga {$rtTitle}:**\n"
                    . "1. **Tunai / Loket RT:** Bayar langsung ke Bendahara / Pengurus RT pada jam layanan ({$rt['jam_kerja_rt']}).\n"
                    . "2. **Transfer Rekening Resmi RT:**\n"
                    . "   • BCA: `{$rt['norek_bca']}`\n"
                    . "   • Mandiri: `{$rt['norek_mandiri']}`\n"
                    . "3. **QRIS & Verifikasi e-KTP:** Tempelkan e-KTP ke reader RFID ESP32 untuk mengecek status lunas secara instan!\n\n"
                    . "Nominal standar iuran bulanan tercatat **Rp 50.000/bulan** (dapat dicek riwayat & kwitansinya di menu **Iuran Warga**).";

            case 'register_login':
                return "📝 **Panduan Pendaftaran & Login Warga E-KASRT:**\n"
                    . "• **Pendaftaran Baru:** Buka halaman **Daftar Akun Baru** (`/register`), isi Nama sesuai KTP, **16 digit NIK**, No. KK, No. HP/WA, Alamat, No. Rumah, Username, dan Password.\n"
                    . "• **Keamanan Verifikasi:** Akun baru tidak langsung aktif sebelum diverifikasi Pengurus RT. Anda dapat cek status persetujuan dengan mengetik `cek status [NIK]` langsung di chat ini.\n"
                    . "• **Masalah Login / Lupa Password:** Hubungi Admin atau Pengurus RT untuk mereset password atau mengaktifkan kembali akun Anda di menu Pengguna.";

            case 'posyandu':
                if ($live['sesi_posyandu']) {
                    $s = $live['sesi_posyandu'];
                    $sesiInfo = "• **Sesi {$s['status']}:** {$s['nama_sesi']}\n"
                        . "• **Tanggal & Jam:** {$s['tanggal']} pukul {$s['waktu_mulai']} WIB\n"
                        . "• **Lokasi:** {$s['lokasi']} (Petugas: {$s['petugas']})\n";
                } else {
                    $sesiInfo = "• Saat ini belum ada jadwal sesi Posyandu baru yang dibuka. Pantau terus di menu **Posyandu Balita IoT**.\n";
                }

                return "👶 **Layanan Posyandu Balita Digital IoT:**\n"
                    . $sesiInfo
                    . "• **Total Balita Terdaftar:** {$live['balita_count']} balita\n\n"
                    . "**Cara Absen Cepat:** Ibu balita cukup menempelkan **e-KTP** ke sensor RFID ESP32 di meja Posyandu—kehadiran anak otomatis tercatat dan data KMS (BB/TB/LK/LiLA/Status Gizi) bisa dicetak digital.";

            case 'surat_pengantar':
                return "📄 **Layanan Pengajuan Surat Pengantar RT:**\n"
                    . "Warga dapat mengajukan surat keterangan domisili, SKTM, pengantar KTP/KK, surat pengantar nikah, atau surat usaha secara online:\n"
                    . "1. Login ke portal E-KASRT lalu buka menu **Surat Pengantar** (`/smartrt/surat`).\n"
                    . "2. Pilih jenis surat dan tuliskan keperluannya.\n"
                    . "3. Pengurus RT akan memproses persetujuan surat (`Pending` → `Disetujui`).";

            case 'bank_sampah':
                return "♻️ **Layanan Bank Sampah {$rtTitle}:**\n"
                    . "• **Total Sampah Terkelola:** " . number_format($live['sampah_kg'], 1, ',', '.') . " kg\n"
                    . "• Warga dapat menyetorkan sampah anorganik terpilah (plastik, kardus, botol, logam) untuk dikonversi menjadi **Poin Bank Sampah** (`100 poin/kg`).\n"
                    . "• Catatan setoran & saldo poin dapat dipantau di menu **Bank Sampah**.";

            case 'aspirasi_aset':
                return "📣 **Aspirasi Warga & Inventaris Aset RT:**\n"
                    . "• **Aspirasi & Pengaduan:** Sampaikan saran, usulan, atau keluhan lingkungan lewat menu **Aspirasi Warga** (`/smartrt/aspirasi`).\n"
                    . "• **Peminjaman Aset RT:** Saat ini terdapat **{$live['aset_count']} jenis inventaris aset RT** tercatat di menu **Aset & Inventaris** (`/smartrt/aset`). Hubungi pengurus RT untuk peminjaman.";

            case 'iot_rfid':
                return "📡 **Integrasi Perangkat RFID / e-KTP ESP32:**\n"
                    . "Sistem E-KASRT terhubung langsung dengan reader RFID RC522 + ESP32 untuk:\n"
                    . "1. **Tap Absensi Posyandu Balita** menggunakan e-KTP Ibu atau kartu khusus balita.\n"
                    . "2. **Tap Cek Verifikasi Pembayaran Iuran** secara instan.\n"
                    . "3. **Auto-fill UID Kartu** saat mendaftarkan atau mengedit data warga di menu Data Warga & Posyandu.";

            case 'kontak_rt':
                $pengurusLines = '';
                if (!empty($live['pengurus'])) {
                    $pengurusLines = "\n\n**Pengurus RT Aktif:**\n";
                    foreach ($live['pengurus'] as $pg) {
                        $hp = !empty($pg['no_hp']) ? " — WA/Telp: `{$pg['no_hp']}`" : '';
                        $pengurusLines .= "• **{$pg['nama']}** ({$pg['jabatan']}){$hp}\n";
                    }
                }
                $waFallback = !empty($settings['whatsapp_cs']) ? "\n• **WhatsApp Layanan RT:** `{$settings['whatsapp_cs']}`" : '';

                return "🏢 **Informasi & Kontak Pengurus {$rtTitle}:**\n"
                    . "• **Wilayah:** RT {$rt['rt_number']} / RW {$rt['rw_number']}, Kel. {$rt['kelurahan']}, Kec. {$rt['kecamatan']}, {$rt['kota']}\n"
                    . "• **Jam Pelayanan:** {$rt['jam_kerja_rt']}"
                    . $waFallback
                    . $pengurusLines;

            case 'app_android':
                return "📱 **Akses Mobile & Aplikasi Android E-KASRT:**\n"
                    . "Portal E-KASRT dirancang *mobile-responsive* sehingga nyaman dibuka langsung lewat browser HP Android maupun iPhone, dan juga tersedia paket aplikasi Android (`APK`) untuk akses cepat warga.";

            case 'thanks':
                return "Sama-sama! 😊 Senang bisa membantu. Jika ada pertanyaan lain seputar kas RT, iuran, surat pengantar, atau verifikasi akun warga, silakan chat kapan saja ya!";

            default:
                $waHint = !empty($settings['whatsapp_cs']) ? " atau menghubungi WhatsApp Pengurus RT (`{$settings['whatsapp_cs']}`)" : '';

                return "Maaf, saya belum sepenuhnya menangkap pertanyaan **\"{$message}\"**.\n\n"
                    . "Sebagai **Customer Service E-KASRT**, saya paling siap membantu topik berikut:\n"
                    . "• **Keuangan & Iuran:** *\"Berapa saldo kas RT sekarang?\"* atau *\"Bagaimana cara bayar iuran?\"*\n"
                    . "• **Akun Warga:** *\"Cara daftar warga baru\"* atau *\"Cek status [16 digit NIK]\"*\n"
                    . "• **Layanan RT:** *\"Jadwal Posyandu balita\"*, *\"Cara ajukan surat pengantar\"*, *\"Bank Sampah\"*, atau *\"Kontak pengurus RT\"*\n\n"
                    . "Silakan pilih salah satu tombol di bawah{$waHint}.";
        }
    }

    /**
     * Panggil Google Gemini API jika API Key tersedia, grounded ke data database live.
     */
    private function askGemini(
        string $message,
        array $settings,
        array $liveData,
        ?User $user,
        array $history
    ): ?string {
        try {
            $apiKey = trim((string) $settings['gemini_api_key']);
            $model = trim((string) ($settings['gemini_model'] ?: 'gemini-2.5-flash'));
            $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $rt = $liveData['rt'];
            $kas = $liveData['kas'];
            $sesiStr = $liveData['sesi_posyandu']
                ? "{$liveData['sesi_posyandu']['nama_sesi']} ({$liveData['sesi_posyandu']['status']}, {$liveData['sesi_posyandu']['tanggal']} {$liveData['sesi_posyandu']['waktu_mulai']} di {$liveData['sesi_posyandu']['lokasi']})"
                : 'Belum ada sesi aktif/dijadwalkan';

            $pengurusJson = json_encode($liveData['pengurus'], JSON_UNESCAPED_UNICODE);
            $personalJson = $liveData['personal'] ? json_encode($liveData['personal'], JSON_UNESCAPED_UNICODE) : 'Tamu (belum login)';

            $customPrompt = !empty($settings['system_prompt']) ? "\nInstruksi Tambahan Admin:\n{$settings['system_prompt']}\n" : '';

            $systemInstruction = "Kamu adalah '{$settings['bot_name']}', asisten Customer Service resmi website Smart RT & Keuangan E-KASRT.\n"
                . "Jawablah dengan Bahasa Indonesia yang ramah, ringkas, profesional, dan akurat.\n"
                . "Gunakan HANYA data faktual di bawah ini; jangan pernah mengarang nominal uang, nomor rekening, atau jadwal yang tidak tercantum.\n"
                . $customPrompt . "\n"
                . "=== DATA LIVE WEBSITE E-KASRT SAAT INI ===\n"
                . "- Wilayah: RT {$rt['rt_number']} / RW {$rt['rw_number']}, Kel. {$rt['kelurahan']}, Kec. {$rt['kecamatan']}, {$rt['kota']}\n"
                . "- Jam Layanan RT: {$rt['jam_kerja_rt']}\n"
                . "- Rekening Resmi: BCA ({$rt['norek_bca']}) | Mandiri ({$rt['norek_mandiri']})\n"
                . "- Saldo Kas RT: Rp " . rupiah($kas['saldo']) . " (Masuk: Rp " . rupiah($kas['masuk']) . ", Keluar: Rp " . rupiah($kas['keluar']) . ")\n"
                . "- Jumlah Warga Terdaftar: {$liveData['warga_count']} warga | Balita Posyandu: {$liveData['balita_count']} balita | Aset RT: {$liveData['aset_count']} jenis | Bank Sampah: {$liveData['sampah_kg']} kg\n"
                . "- Sesi Posyandu Terdekat/Aktif: {$sesiStr}\n"
                . "- Pengurus RT Aktif: {$pengurusJson}\n"
                . "- Status Pengguna Saat Ini: {$personalJson}\n"
                . "- Fitur Utama Portal: Pendaftaran Warga (`/register`) wajib diverifikasi Admin/Pengurus RT sebelum login (`/login`), Iuran Warga & Tap Cek e-KTP (`/smartrt/iuran`), Posyandu Balita IoT (`/smartrt/posyandu`), Surat Pengantar (`/smartrt/surat`), Bank Sampah (`/smartrt/banksampah`), Aspirasi (`/smartrt/aspirasi`), Aset (`/smartrt/aset`).\n"
                . "- Untuk mengecek status pendaftaran warga, arahkan user mengetik: cek status [16 digit NIK] atau klik tombol Cek Status Pendaftaran di halaman Login.";

            $contents = [];
            foreach (array_slice($history, -6) as $turn) {
                if (!empty($turn['user']) && !empty($turn['bot'])) {
                    $contents[] = ['role' => 'user', 'parts' => [['text' => (string) $turn['user']]]];
                    $contents[] = ['role' => 'model', 'parts' => [['text' => (string) $turn['bot']]]];
                }
            }
            $contents[] = ['role' => 'user', 'parts' => [['text' => $message]]];

            $response = Http::timeout(10)->post($endpoint, [
                'systemInstruction' => [
                    'parts' => [['text' => $systemInstruction]],
                ],
                'contents' => $contents,
                'generationConfig' => [
                    'temperature'     => 0.4,
                    'maxOutputTokens' => 500,
                ],
            ]);

            if ($response->successful()) {
                $text = $response->json('candidates.0.content.parts.0.text');
                if (is_string($text) && trim($text) !== '') {
                    return trim($text);
                }
            }
        } catch (\Throwable $e) {
            // Fallback ke Smart NLP engine lokal
        }

        return null;
    }

    /**
     * Rekomendasi chip pertanyaan lanjutan agar percakapan terasa interaktif.
     */
    private function suggestionsForIntent(string $intent, bool $isLoggedIn): array
    {
        $map = [
            'kas_saldo'     => ['Cara bayar iuran', 'Kontak Pengurus RT', 'Jadwal Posyandu'],
            'iuran_bayar'   => $isLoggedIn ? ['Cek iuran saya', 'Saldo Kas RT sekarang', 'Tap e-KTP Smart RT'] : ['Saldo Kas RT sekarang', 'Daftar akun warga', 'Kontak Pengurus RT'],
            'register_login'=> ['Cek status pendaftaran', 'Kontak Pengurus RT', 'Saldo Kas RT sekarang'],
            'posyandu'      => ['Cara tap e-KTP', 'Kontak Pengurus RT', 'Saldo Kas RT sekarang'],
            'surat_pengantar' => ['Kontak Pengurus RT', 'Cara bayar iuran', 'Aspirasi & Aset RT'],
            'kontak_rt'     => ['Cara bayar iuran', 'Daftar akun warga', 'Jadwal Posyandu'],
        ];

        if (isset($map[$intent])) {
            return $map[$intent];
        }

        return $isLoggedIn
            ? ['Saldo Kas RT sekarang', 'Cek iuran saya', 'Jadwal Posyandu', 'Cara ajukan surat']
            : ['Saldo Kas RT sekarang', 'Cara daftar warga baru', 'Cek status pendaftaran', 'Cara bayar iuran'];
    }

    /**
     * Tombol aksi cepat menuju halaman terkait di website E-KASRT.
     */
    private function buildActions(string $intent, bool $isLoggedIn): array
    {
        $actions = [];

        if ($intent === 'register_login' || $intent === 'check_registration_status') {
            if (!$isLoggedIn) {
                $actions[] = ['label' => '📝 Daftar Warga Baru', 'url' => route('register')];
                $actions[] = ['label' => '🔑 Halaman Login', 'url' => route('login')];
            }
        } elseif ($intent === 'kas_saldo' && $isLoggedIn) {
            $actions[] = ['label' => '📊 Buka Laporan Kas', 'url' => route('kas.laporan')];
        } elseif ($intent === 'iuran_bayar' && $isLoggedIn) {
            $actions[] = ['label' => '💳 Buka Menu Iuran', 'url' => route('smartrt.iuran')];
        } elseif ($intent === 'posyandu' && $isLoggedIn) {
            $actions[] = ['label' => '👶 Buka Posyandu IoT', 'url' => route('posyandu.index')];
        } elseif ($intent === 'surat_pengantar' && $isLoggedIn) {
            $actions[] = ['label' => '📄 Ajukan Surat', 'url' => route('smartrt.surat')];
        } elseif ($intent === 'bank_sampah' && $isLoggedIn) {
            $actions[] = ['label' => '♻️ Buka Bank Sampah', 'url' => route('smartrt.banksampah')];
        } elseif ($intent === 'aspirasi_aset' && $isLoggedIn) {
            $actions[] = ['label' => '📣 Kirim Aspirasi', 'url' => route('smartrt.aspirasi')];
        }

        return $actions;
    }

    /**
     * Simpan log percakapan ke database agar admin/RT dapat memantau pertanyaan warga.
     */
    private function logChat(string $sessionId, ?User $user, string $userMsg, array $result): void
    {
        try {
            if (Schema::hasTable('ai_chat_logs')) {
                AiChatLog::create([
                    'session_id'      => substr($sessionId, 0, 120),
                    'user_id'         => $user?->user_id,
                    'sender_name'     => $user ? ($user->user ?: $user->username) : 'Pengunjung Tamu',
                    'user_message'    => $userMsg,
                    'bot_reply'       => $result['reply'],
                    'detected_intent' => $result['intent'],
                    'engine_used'     => $result['engine'],
                    'created_at'      => now(),
                ]);
            }
        } catch (\Throwable $e) {
            // Jangan gagalkan respons chat bila penulisan log bermasalah
        }
    }
}
