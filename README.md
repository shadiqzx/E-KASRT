# 🏛️ E-KASRT — Sistem Informasi Keuangan & Smart RT Digital (Versi Terbaru)

<p align="center">
  <img src="https://img.shields.io/badge/Framework-Laravel%2011.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11" />
  <img src="https://img.shields.io/badge/PHP-8.2%20%7C%208.3%20%7C%208.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+" />
  <img src="https://img.shields.io/badge/Database-MySQL%208.4%20%7C%20MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL 8.4" />
  <img src="https://img.shields.io/badge/IoT%20Device-NodeMCU%20ESP32%20%2B%20RC522-00979D?style=for-the-badge&logo=arduino&logoColor=white" alt="ESP32 IoT" />
  <img src="https://img.shields.io/badge/UI%20Design-Executive%20Glassmorphism-0284c7?style=for-the-badge" alt="Glassmorphism" />
  <img src="https://img.shields.io/badge/Production-Live%20VPS%20SSL-10b981?style=for-the-badge&logo=nginx&logoColor=white" alt="Live VPS" />
</p>

> **E-KASRT** adalah platform sistem informasi tata kelola lingkungan Rukun Tetangga (RT) modern berbasis **Laravel 11** dengan antarmuka **Executive Glassmorphism**, integrasi **IoT ESP32 RFID/e-KTP (Firmware v4.1)** untuk Posyandu Balita & Loket Iuran Warga, sistem transparansi pembukuan kas lingkungan secara real-time, serta **Pusat Kendali Migrasi & Manajemen Database** terintegrasi.

---

## 📌 Daftar Isi
1. [Keunggulan Utama Versi Terbaru](#-keunggulan-utama-versi-terbaru)
2. [Modul & Fitur Sistem Lengkap](#-modul--fitur-sistem-lengkap)
   - [1. Manajemen Arus Kas & Finansial RT](#1--manajemen-arus-kas--finansial-rt)
   - [2. Smart IoT Posyandu Balita Digital (v4.1)](#2--smart-iot-posyandu-balita-digital-v41)
   - [3. Loket Tap e-KTP Iuran Warga Digital](#3--loket-tap-e-ktp-iuran-warga-digital)
   - [4. Pusat Kendali Database & Migrasi Kas RT](#4--pusat-kendali-database--migrasi-kas-rt)
   - [5. Kependudukan & Layanan Smart RT](#5--kependudukan--layanan-smart-rt)
3. [Arsitektur Perangkat Keras IoT (ESP32 + RC522)](#-arsitektur-perangkat-keras-iot-esp32--rc522)
4. [Hierarki Hak Akses (RBAC)](#-hierarki-hak-akses-rbac)
5. [Struktur Database (26 Tabel Sistem)](#-struktur-database-26-tabel-sistem)
6. [Panduan Instalasi Lokal & Sinkronisasi VPS](#-panduan-instalasi-lokal--sinkronisasi-vps)
7. [Matriks Lengkap Rute URL (Endpoint Matrix)](#-matriks-lengkap-rute-url-endpoint-matrix)
8. [Struktur Direktori Proyek](#-struktur-direktori-proyek)
9. [Deployment VPS & Otomasi CI/CD](#-deployment-vps--otomasi-cicd)
10. [Lisensi & Kontributor](#-lisensi--kontributor)

---

## ✨ Keunggulan Utama Versi Terbaru

1. **Pusat Kendali Migrasi & Database 1-Klik Langsung di Web**:
   - Inspeksi 26 tabel database secara real-time (jumlah record, data size, collation, engine).
   - Live migration status tracker (melihat status `Ran` vs `Pending` untuk setiap file migrasi).
   - Tombol **Jalankan Migrasi** (`php artisan migrate --force`), **Isi Data Awal / Seeder** (`php artisan db:seed --force`), dan **Download SQL Backup Riil** langsung dari antarmuka web.
2. **Smart IoT Posyandu Balita Digital v4.1**:
   - Firmware ESP32 v4.1 dengan auto-detect RST pin (GPIO 22 / GPIO 25) & penguatan antena maksimal (48dB).
   - **Live Serial Monitor Box** langsung di browser via Web Serial API tanpa perlu membuka Arduino IDE.
   - **Auto-Reset Radar e-KTP (6 Detik)**: Radar otomatis kembali ke status standby setelah 6 detik jika tidak ada ketukan baru (mencegah data lama menumpuk).
   - **Fitur Reset Data Uji Coba**: Pilihan aman membersihkan kehadiran sesi hari ini, riwayat log tap, melepas tautan RFID warga, atau reset total data pengujian.
3. **Loket Tap e-KTP Iuran Warga Digital**:
   - Warga cukup menempelkan e-KTP pada sensor RFID untuk verifikasi status iuran kebersihan/kas RT bulan berjalan.
   - Status instan: `SUDAH LUNAS`, `BELUM BAYAR`, atau `KARTU BELUM TERDAFTAR` disertai tombol **Pelunasan Cepat (Quick Pay)** 1-klik yang otomatis membukukan kas masuk.
4. **Modern Executive Glassmorphism UI**:
   - Tampilan berkelas dengan efek *frosted glass* (`backdrop-filter: blur(24px)`), palet warna *Deep Emerald* dan *Obsidian Slate*, serta tipografi profesional **Plus Jakarta Sans** & **JetBrains Mono**.
5. **Transparansi Finansial Komprehensif**:
   - Saldo kas real-time, grafik arus kas 6 bulan berbasis Chart.js, generator kwitansi transaksi resmi, mutasi transfer antar-rekening/QRIS, serta ekspor laporan keuangan.

---

## 🚀 Modul & Fitur Sistem Lengkap

### 1. 💰 Manajemen Arus Kas & Finansial RT
| Fitur | Deskripsi |
|---|---|
| **Dashboard Eksekutif** | 4 Kartu KPI fintech (Pemasukan, Pengeluaran, Saldo Kas Aktif, Total Warga), Chart Tren Arus Kas 6 Bulan, dan Donut Rasio Alokasi Kas |
| **Pencatatan Kas Masuk** | Pencatatan penerimaan iuran warga, sumbangan sukarela, dana CSR, dan sewa fasilitas lingkungan |
| **Pencatatan Kas Keluar** | Realisasi belanja operasional lingkungan, honor satpam/kebersihan, perawatan sarana, dan konsumsi warga |
| **Kwitansi Digital** | Generator bukti pembayaran sah berformat resmi yang dapat langsung diunduh dan dicetak |
| **Transfer Kas Antar-Rekening** | Mutasi dana kas RT antar-rekening bank (BCA, BRI, Mandiri) dan dompet digital/QRIS lingkungan |
| **Rekapitulasi Laporan Keuangan** | Penyaringan laporan pembukuan berkala berdasarkan rentang tanggal dengan format cetak siap audit |

---

### 2. 👶 Smart IoT Posyandu Balita Digital (v4.1)
| Fitur | Deskripsi |
|---|---|
| **Presensi Mandiri e-KTP Balita** | Ibu balita cukup menempelkan e-KTP ke sensor RFID RC522; sistem langsung mendeteksi balita dan mencatat kehadiran |
| **Live Serial Monitor di Web** | Kotak terminal hitam terintegrasi langsung di tab Web Serial untuk memantau log output ESP32 secara real-time |
| **Radar Tap Auto-Reset (6 Detik)** | Komponen radar otomatis kembali ke status `[Standby]` setelah 6 detik jika tidak ada ketukan baru |
| **Audio Synthesizer Feedback** | Notifikasi suara ramah ("*Selamat datang*", "*Sudah absen sebelumnya*", dll.) saat kartu di-tap |
| **Pencatatan Antropometri Balita** | Input berat badan (BB), tinggi badan (TB), lingkar kepala (LK), lingkar lengan atas (LiLA), status gizi WHO, vitamin A, dan obat cacing |
| **KMS Digital Siap Cetak** | Kartu Menuju Sehat elektronik dengan riwayat tumbuh kembang balita lengkap dari bulan ke bulan |
| **Pusat Reset Data Uji Coba** | Modal kendali untuk mengosongkan data uji coba posyandu (kehadiran sesi, log tap, unpair kartu) dengan konfirmasi aman |

---

### 3. 💳 Loket Tap e-KTP Iuran Warga Digital
| Fitur | Deskripsi |
|---|---|
| **Verifikasi Cepat Status Iuran** | Tempel e-KTP warga di perangkat loket; sistem menampilkan rincian nama warga, nomor rumah, dan status pelunasan bulan berjalan |
| **Quick Pay 1-Klik** | Tombol pembayaran instan di loket yang secara otomatis menerbitkan bukti iuran dan mencatat kas masuk ke pembukuan RT |
| **Tautkan / Lepas e-KTP** | Manajemen pairing UID RFID e-KTP ke database warga RT secara aman dan fleksibel |
| **Live Stream Polling Radar** | Komunikasi asinkron antara pembaca kartu (ESP32/Web Serial) dengan dashboard loket pembayaran |

---

### 4. 🗄️ Pusat Kendali Database & Migrasi Kas RT
| Fitur | Deskripsi |
|---|---|
| **Status Migrasi Skema Live** | Memantau file migrasi Laravel (`database/migrations`), batch eksekusi, serta status `Ran` atau `Pending` |
| **Inspeksi 26 Tabel Database** | Melihat daftar seluruh tabel MySQL `kasrt`, jumlah baris record, estimasi ukuran data (KB/MB), engine, dan status terisi/kosong |
| **Jalankan Migrasi Database 1-Klik** | Menjalankan `php artisan migrate --force` langsung dari antarmuka web dengan output hasil instan |
| **Isi Data Awal / Seeder 1-Klik** | Menjalankan `php artisan db:seed --force` untuk mengisi data pokok warga RT, pengurus, sesi posyandu, dan saldo kas awal |
| **Download Backup SQL Riil** | Men-generate dump database riil lengkap dengan struktur dan seluruh baris data dalam format `.sql` siap restore |

---

### 5. 👥 Kependudukan & Layanan Smart RT
| Fitur | Deskripsi |
|---|---|
| **Data Warga Terpadu** | Pengelolaan identitas warga RT (NIK 16 digit, nomor KK, RFID e-KTP, nama lengkap, jenis kelamin, no. rumah, nomor WhatsApp) |
| **Surat Pengantar Digital** | Pengajuan permohonan surat pengantar kelurahan secara online dengan status permohonan transparan |
| **Bank Sampah Lingkungan** | Konversi setoran sampah pilah warga menjadi saldo simpanan kas yang bernilai ekonomis |
| **Kotak Aspirasi Warga** | Saluran aspirasi, aduan, dan masukan warga RT dengan pemantauan tindak lanjut pengurus |
| **Inventaris Aset RT** | Pencatatan barang inventaris milik RT (tenda, kursi, sound system, proyektor) dan pencatatan kondisi barang |
| **Profil Struktural RT** | Informasi kepengurusan RT, kontak pengurus, visi & misi lingkungan, serta pengaturan nomor rekening kas |

---

## 📡 Arsitektur Perangkat Keras IoT (ESP32 + RC522)

Sistem E-KASRT menggunakan modul mikrokontroler **NodeMCU ESP32-WROOM-32D** yang terhubung ke modul pembaca **RFID RC-522 (13.56 MHz)**:

```
           ┌───────────────────────┐
           │     NodeMCU ESP32     │
           │      WROOM-32D        │
           └──────────┬────────────┘
                      │ SPI Bus (3.3V)
           ┌──────────┴────────────┐
           │      RFID RC-522      │
           │  (e-KTP / Kartu 13.56)│
           └───────────────────────┘
```

### Skema Pinout Wiring:
| Pin RC522 | Pin ESP32 | Keterangan |
|:---:|:---:|:---|
| **SDA (SS)** | **GPIO 5** | SPI Slave Select |
| **SCK** | **GPIO 18** | SPI Clock |
| **MOSI** | **GPIO 23** | SPI Master Out Slave In |
| **MISO** | **GPIO 19** | SPI Master In Slave Out |
| **RST** | **GPIO 22 / 25** | Reset pin (Didukung auto-detect di firmware v4.1) |
| **3.3V** | **3V3** | **PERHATIAN: Wajib 3.3V! (Jangan hubungkan ke 5V)** |
| **GND** | **GND** | Ground bersama |
| **BUZZER** | **GPIO 4** | *(Opsional)* Indikator audio beep saat tap berhasil |
| **LED** | **GPIO 2** | *(Opsional)* LED status terhubung |

### Dua Mode Operasi:
1. **Mode USB Web Serial API (Default & Sangat Disarankan)**:
   - ESP32 dihubungkan ke laptop/PC posyandu melalui kabel data USB.
   - Browser (Google Chrome / Edge) membaca langsung data ketukan kartu via Web Serial API (`115200 baud`).
   - Tidak memerlukan koneksi Wi-Fi di perangkat ESP32, anti-delay, dan dilengkapi **Live Serial Monitor Box**.
2. **Mode Wi-Fi HTTP Client**:
   - ESP32 terhubung ke Wi-Fi lokal dan mengirimkan request `POST` berformat JSON ke endpoint `/smartrt/posyandu_rfid_tap` atau `/smartrt/iuran_rfid_tap`.

---

## 👥 Hierarki Hak Akses (RBAC)

| Role ID | Peran | Akun Default | Cakupan Akses |
|:---:|:---:|:---:|:---|
| `1` | **Administrator / Superadmin** | `admin@kasrt.com` / `admin123` | Akses penuh seluruh transaksi kas, master data warga, modul Smart RT, pusat database & migrasi, serta kelola pengguna |
| `2` | **Pengurus RT** | *(Didaftarkan oleh Admin)* | Akses operasional harian: kas masuk/keluar, data kependudukan, pengajuan surat pengantar, dan posyandu |
| `3` | **Petugas Posyandu** | *(Didaftarkan oleh Admin)* | Akses khusus modul posyandu balita: registrasi balita, presensi tap e-KTP, input pemeriksaan gizi, dan cetak KMS |
| `4` | **Warga Lingkungan** | *(Registrasi mandiri di portal)* | Akses portal warga: melihat transparansi saldo kas, riwayat pembayaran iuran, dan pengajuan surat online |

---

## 🗄️ Struktur Database (26 Tabel Sistem)

Database: **`kasrt`** (MySQL 8.4 InnoDB)

| # | Nama Tabel | Deskripsi |
|:---:|:---|:---|
| 1 | `users` | Akun pengguna sistem (nama, email, password hash, role_id) |
| 2 | `user_role` | Definisi peran hak akses pengguna |
| 3 | `data_warga` | Master kependudukan RT (NIK, UID rfid_ktp, nama, alamat, no_kk, no_hp) |
| 4 | `data_kas` | Pembukuan arus kas masuk dan belanja pengeluaran lingkungan |
| 5 | `transaksi_transfer` | Mutasi transfer dana kas antar-rekening bank & QRIS RT |
| 6 | `tabel_kredit` | Catatan kredit/pembiayaan operasional lingkungan |
| 7 | `posyandu_balita` | Master data balita dan hubungan keluarga warga |
| 8 | `posyandu_sesi` | Sesi kegiatan posyandu bulanan (tanggal, lokasi, petugas) |
| 9 | `posyandu_kehadiran` | Catatan kehadiran, antropometri (BB, TB, LK, LiLA), status gizi |
| 10 | `posyandu_tap_log` | Riwayat log ketukan kartu RFID/e-KTP pada perangkat posyandu |
| 11 | `iuran_payment` | Riwayat tagihan dan pembayaran iuran bulanan warga |
| 12 | `surat` | Pengajuan dan status persetujuan surat pengantar RT |
| 13 | `bank_sampah` | Tabungan sampah pilah warga dan perolehan poin saldo kas |
| 14 | `aspirasi` | Kotak saran, aspirasi, dan laporan pengaduan warga |
| 15 | `aset` | Daftar aset inventaris milik RT beserta jumlah dan kondisinya |
| 16 | `pengurus_rt` | Direktori profil struktural pengurus lingkungan RT |
| 17 | `data_rt` | Pengaturan informasi RT/RW, alamat kelurahan, dan rekening resmi |
| 18 | `transactions` | Log transaksi keuangan terintegrasi |
| 19 | `migrations` | Riwayat eksekusi migrasi skema database Laravel |
| 20 | `sessions` | Pengelolaan sesi aktif pengguna web |
| 21 | `cache` | Cache sistem performa tinggi Laravel |
| 22 | `cache_locks` | Mutex lock concurrency cache |
| 23 | `jobs` | Antrean queue jobs background worker |
| 24 | `job_batches` | Batching antrean proses |
| 25 | `failed_jobs` | Pencatatan kegagalan antrean jobs |
| 26 | `password_reset_tokens`| Token keamanan pemulihan kata sandi pengguna |

---

## 💻 Panduan Instalasi Lokal & Sinkronisasi VPS

### Prasyarat Sistem:
- **PHP** >= 8.2 (Disarankan PHP 8.3 / 8.4 dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `curl`)
- **Composer** >= 2.x
- **MySQL** >= 8.0 atau **MariaDB** >= 10.4
- **Web Browser Modern** (Google Chrome / Microsoft Edge disarankan untuk Web Serial IoT)

### Langkah Instalasi di Komputer Lokal:

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/shadiqzx/E-KASRT.git
   cd E-KASRT
   ```

2. **Install Dependensi Composer**:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment `.env`**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Sesuaikan parameter database di file `.env`:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kasrt
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Jalankan Migrasi & Seeder Lengkap**:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
   *Perintah ini otomatis membuat ke-26 tabel dan mengisi data warga awal, akun admin, sesi posyandu, dan saldo kas awal.*

5. **Jalankan Server Lokal**:
   ```bash
   php artisan serve --port=8000
   ```
   Buka browser di: **`http://127.0.0.1:8000`**  
   Login default: `admin@kasrt.com` | Password: `admin123`

---

### Solusi Data Kosong Saat Pindah ke VPS:
Jika Anda memindahkan sistem ke server VPS baru dan mendapati tabel kosong setelah migrasi:
1. Masuk ke halaman **`https://domain-vps-anda/smartrt/backup`**.
2. Klik tombol hijau **`🌱 Isi Data / Seeder`** di pojok kanan atas hero banner.
3. Seluruh master data warga, akun admin, sesi aktif posyandu, dan saldo pembukuan kas akan langsung terisi secara otomatis tanpa perlu membuka terminal SSH!

---

## 🔗 Matriks Lengkap Rute URL (Endpoint Matrix)

### Autentikasi & Portal Publik:
- `GET /` : Landing Page / Portal Selamat Datang E-KASRT
- `GET /login` : Formulir Masuk Pengguna (Glassmorphism Layout)
- `POST /login` : Proses Validasi Login
- `GET /register` : Pendaftaran Akun Warga Baru
- `POST /register` : Proses Registrasi Data Kependudukan
- `GET /logout` : Keluar dari Sesi Sistem

### Panel Keuangan & Kas Lingkungan:
- `GET /dashboard` : Dashboard Eksekutif Finansial & Grafik Kas 6 Bulan
- `GET /kas-masuk` : Pencatatan Penerimaan Kas RT
- `GET /kas-keluar` : Pencatatan Pengeluaran Belanja RT
- `POST /kas/store` : Simpan Transaksi Kas Masuk / Keluar
- `GET /kas/kwitansi/{id}` : Cetak Kwitansi Sah Transaksi Kas
- `GET /kas/laporan` : Laporan Rekapitulasi Pembukuan Kas Berkala
- `GET /smartrt/transfer` : Pengelolaan Transfer Mutasi Rekening Kas

### Smart RT: Posyandu Balita Digital IoT:
- `GET /smartrt/posyandu` : Panel Posyandu Balita & Radar Presensi e-KTP
- `POST /smartrt/posyandu_pair_ktp` : Tautkan UID RFID ke Balita / Warga
- `GET /smartrt/posyandu_unpair_ktp/{id}` : Lepas Tautan Kartu RFID Warga
- `POST /smartrt/posyandu_sesi_tambah` : Buat Jadwal Sesi Posyandu Baru
- `GET /smartrt/posyandu_sesi_status/{id}/{status}` : Aktifkan / Nonaktifkan Sesi
- `GET /smartrt/posyandu_sesi_hapus/{id}` : Hapus Sesi Posyandu
- `POST /smartrt/posyandu_hadir_manual` : Absen Kehadiran Balita Manual
- `GET /smartrt/posyandu_kehadiran_hapus/{id}` : Hapus Rekap Kehadiran Balita
- `POST /smartrt/posyandu_update_pemeriksaan/{id}` : Input Data BB, TB, LK & Gizi
- `POST /smartrt/posyandu_balita_tambah` : Tambah Master Data Balita
- `GET /smartrt/posyandu_balita_hapus/{id}` : Hapus Master Data Balita
- `POST /smartrt/posyandu_reset_data` : Eksekusi Reset Data Uji Coba Posyandu
- `GET /smartrt/posyandu_cetak_kms/{id}` : Cetak Kartu Menuju Sehat (KMS) Digital
- `MATCH /smartrt/posyandu_rfid_tap` : API Endpoint IoT Pembaca Kartu ESP32
- `GET /smartrt/posyandu_live_stream` : Polling Status Radar e-KTP Real-Time

### Smart RT: Loket e-KTP Iuran Warga:
- `GET /smartrt/iuran` : Rekapitulasi Iuran Warga & Loket Tap
- `POST /smartrt/iuran_bayar` : Input Pembayaran Iuran Manual
- `POST /smartrt/iuran_quick_pay` : Pelunasan Cepat 1-Klik dari Loket Kartu
- `POST /smartrt/iuran_pair_ktp` : Tautkan Kartu e-KTP ke Warga di Loket
- `GET /smartrt/iuran_unpair_ktp/{id}` : Lepas Tautan Kartu e-KTP Warga
- `MATCH /smartrt/iuran_rfid_tap` : API Endpoint Verifikasi Status Iuran via ESP32
- `GET /smartrt/iuran_live_stream` : Live Polling Radar Loket Iuran

### Smart RT: Layanan Lingkungan Terpadu:
- `GET /smartrt/banksampah` : Pembukuan Tabungan Bank Sampah Warga
- `POST /smartrt/banksampah_tambah` : Setor Sampah Pilah & Tambah Saldo
- `GET /smartrt/surat` : Layanan Pengajuan Surat Pengantar RT
- `POST /smartrt/surat_ajukan` : Pengajuan Surat Online oleh Warga
- `GET /smartrt/surat_update_status/{id}/{status}` : Persetujuan Surat oleh Pengurus RT
- `GET /smartrt/aspirasi` : Kanal Pengaduan & Aspirasi Warga
- `POST /smartrt/aspirasi_kirim` : Kirim Aspirasi / Keluhan Warga
- `GET /smartrt/aset` : Manajemen Inventaris & Peminjaman Barang RT
- `POST /smartrt/aset_tambah` : Tambah Barang Aset RT
- `GET /smartrt/aset_hapus/{id}` : Hapus Barang Inventaris

### Pusat Database, Migrasi, & Pengguna (Admin Only):
- `GET /smartrt/backup` : Pusat Kendali Database & Status Migrasi
- `POST /smartrt/database_migrate` : Eksekusi `php artisan migrate --force`
- `POST /smartrt/database_seed` : Eksekusi `php artisan db:seed --force`
- `GET /smartrt/database_export_sql` : Download Backup Database Riil (.sql)
- `GET /admin/user` : Manajemen Pengguna & Hak Akses Akun
- `POST /admin/user/store` : Tambah Akun Pengguna Baru
- `POST /admin/user/update/{id}` : Perbarui Data Akun Pengguna
- `GET /admin/user/toggle/{id}` : Aktifkan / Nonaktifkan Akun Pengguna

---

## 📁 Struktur Direktori Proyek

```
E-KASRT/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Login, Registrasi Warga Mandiri, Logout
│   │   ├── DashboardController.php     # Perhitungan Saldo Kas & Statistik Chart.js
│   │   ├── KasController.php           # Kas Masuk, Keluar, Kwitansi Sah, Laporan
│   │   ├── PosyanduController.php      # Posyandu IoT, Web Serial, KMS, Reset Data
│   │   ├── SmartRtController.php       # Loket Iuran, Database & Migrasi, Bank Sampah, Aset
│   │   ├── WargaController.php         # Master Kependudukan & CSV Importer
│   │   └── AdminUserController.php     # Manajemen Akun Pengguna & Hak Akses
│   └── Models/                         # Eloquent Models (DataWarga, DataKas, Posyandu, dll.)
│
├── database/
│   ├── migrations/                     # File Migrasi Skema 26 Tabel Sistem
│   └── seeders/
│       ├── DatabaseSeeder.php          # Master Seeder Terpadu
│       ├── DataWargaSeeder.php         # Seeder Warga Pokok & UID e-KTP Siap Tap
│       ├── DataKasSeeder.php           # Seeder Pembukuan Kas Awal
│       ├── SmartRtSeeder.php           # Seeder Aset RT & Pengurus
│       └── PosyanduSesiSeeder.php      # Seeder Sesi Posyandu Aktif & Balita
│
├── public/
│   ├── assets/                         # Font Plus Jakarta Sans, Icons, Glassmorphism CSS
│   └── firmware_esp32/
│       └── esp32_rfid_posyandu/        # Firmware Arduino C++ ESP32 RC522 (v4.1)
│
├── resources/views/
│   ├── layouts/app.blade.php           # Layout Master Glassmorphism & Sidebar Navigasi
│   ├── welcome.blade.php               # Halaman Selamat Datang / Portal Informasi
│   ├── auth/                           # Tampilan Login & Registrasi Warga
│   ├── dashboard/                      # Tampilan Dashboard Finansial Eksekutif
│   ├── kas/                            # Tampilan Kas Masuk, Keluar, Kwitansi, Laporan
│   ├── warga/                          # Tampilan Master Kependudukan
│   └── smartrt/                        # Modul Smart RT (Posyandu, Iuran, Backup/Migrasi, Surat, dll.)
│
├── routes/web.php                      # Registrasi 70+ Endpoint URL Sistem
└── README.md                           # Dokumentasi Resmi Sistem E-KASRT
```

---

## 🚀 Deployment VPS & Otomasi CI/CD

Sistem E-KASRT telah terintegrasi dengan **GitHub Actions** untuk deployment otomatis:
- Setiap perubahan yang di-push ke branch `main` akan secara otomatis dikirimkan ke server VPS Production (`43.157.230.29`), menjalankan sinkronisasi kode, pembaruan dependensi, serta pembersihan cache Laravel.
- Sistem menggunakan web server **Nginx / OpenResty** dengan **PHP 8.4-FPM** dan sertifikat SSL gratis dari Let's Encrypt.

---

## 📄 Lisensi & Kontributor

- **Pengembang**: Syaifullah Asshadiq ([@shadiqzx](https://github.com/shadiqzx))
- **Lisensi**: Open-source di bawah lisensi [MIT License](LICENSE).
- Didedikasikan untuk transparansi pembukuan kas, pelayanan kesehatan balita terintegrasi, dan kemajuan tata kelola lingkungan Rukun Tetangga di seluruh Indonesia. 🇮🇩
