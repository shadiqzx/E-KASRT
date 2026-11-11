# 🏛️ E-KASRT — Sistem Informasi Keuangan & Smart RT Digital

<p align="center">
  <img src="https://img.shields.io/badge/Framework-Laravel%2011.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11" />
  <img src="https://img.shields.io/badge/PHP-8.2%20%7C%208.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+" />
  <img src="https://img.shields.io/badge/Database-MySQL%20%7C%20MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/IoT%20Device-ESP32%20RFID%20RC522-00979D?style=for-the-badge&logo=arduino&logoColor=white" alt="ESP32 IoT" />
  <img src="https://img.shields.io/badge/UI%20Design-Executive%20Glassmorphism-0284c7?style=for-the-badge" alt="Glassmorphism" />
</p>

> **E-KASRT** adalah platform sistem informasi tata kelola lingkungan Rukun Tetangga (RT) modern berbasis **Laravel 11** dengan antarmuka **Executive Glassmorphism**, integrasi **IoT ESP32 RFID/e-KTP** untuk Posyandu Balita, serta sistem transparansi pembukuan kas lingkungan secara real-time.

---

## 📌 Daftar Isi
- [Keunggulan Utama](#-keunggulan-utama)
- [Fitur Sistem Lengkap](#-fitur-sistem-lengkap)
- [Integrasi IoT Smart Posyandu Balita](#-integrasi-iot-smart-posyandu-balita)
- [Hierarki Hak Akses (RBAC)](#-hierarki-hak-akses-rbac)
- [Struktur Database](#-struktur-database)
- [Panduan Instalasi Lokal](#-panduan-instalasi-lokal)
- [Peta Rute URL (Endpoint Matrix)](#-peta-rute-url-endpoint-matrix)
- [Struktur Direktori Proyek](#-struktur-direktori-proyek)
- [Deployment VPS & GitHub Actions](#-deployment-vps--github-actions)

---

## ✨ Keunggulan Utama

1. **Modern Executive Glassmorphism UI**:
   - Efek *frosted glass* (`backdrop-filter: blur(24px)`), pencahayaan *ambient mesh orbs*, dan palet warna *Obsidian Slate* (`#090e1d` & `#0b1329`) yang mewah dan sejuk di mata.
   - Tipografi berkelas menggunakan **Plus Jakarta Sans** (teks UI & heading) dan **JetBrains Mono** (angka nominal rupiah & kode transaksi).
2. **Halaman Selamat Datang (Landing Page Portal)**:
   - Portal publik informatif sebelum masuk ke dashboard, menyajikan ringkasan fitur, live stat kas RT, dan tautan pendaftaran warga baru.
3. **Form Registrasi Warga Baru (Sign Up)**:
   - Form pendaftaran mandiri warga dengan validasi NIK KTP (16 digit), nomor KK, dan pembuatan akun warga otomatis terintegrasi ke database kependudukan.
4. **Smart IoT Posyandu Balita Digital**:
   - Presensi balita otomatis menggunakan sensor **ESP32 + RFID RC-522** dengan kartu e-KTP / kartu RFID balita, didukung Web Serial API, KMS elektronik, radar animasi, dan audio feedback suara.
5. **Transparansi Finansial Real-Time**:
   - Pencatatan kas masuk, pengeluaran belanja lingkungan, mutasi antar-rekening bank/QRIS, generator kwitansi sah otomatis, dan ekspor laporan berkala.

---

## 🚀 Fitur Sistem Lengkap

### 1. 💰 Manajemen Keuangan & Kas RT
| Fitur | Deskripsi |
|---|---|
| **Dashboard Eksekutif** | 4 Kartu KPI fintech (Pemasukan, Pengeluaran, Saldo Kas Aktif, Total Warga), Chart.js Tren Kas 6 Bulan, dan Donut Rasio Alokasi Kas |
| **Kas Masuk** | Pencatatan penerimaan dana kas (iuran warga, donasi, sumbangan, sewa aset) |
| **Kas Keluar** | Realisasi pengeluaran belanja pemeliharaan lingkungan, honor keamanan, konsumsi rapat, dll. |
| **Kwitansi Digital** | Generator bukti kwitansi transaksi otomatis dengan nomor sah dan format cetak resmi |
| **Transfer Kas** | Mutasi dana kas antar-rekening RT (Rekening BCA RT, Bank BRI, Dompet Digital / QRIS RT) |
| **Laporan Keuangan** | Rekapitulasi pembukuan kas berkala yang dapat disaring per rentang tanggal dan dicetak |

### 2. 👥 Kependudukan & Layanan Warga
| Fitur | Deskripsi |
|---|---|
| **Data Warga Terpadu** | Manajemen identitas kependudukan RT (NIK, No. KK, nama lengkap, jenis kelamin, alamat, no. rumah) |
| **Iuran Warga** | Monitoring pembayaran iuran bulanan dan sampah per KK dengan metode tunai maupun transfer |
| **Surat Pengantar Digital** | Pengajuan surat pengantar kelurahan/domisili secara online dengan penomoran otomatis |
| **Pengurus RT** | Direktori profil struktural pengurus lingkungan RT beserta jabatan dan kontak |
| **Profil & Data RT** | Pengaturan informasi RT, RW, kelurahan, kecamatan, nomor rekening, dan tarif iuran |

### 3. 👶 Layanan Smart RT & Lingkungan
| Fitur | Deskripsi |
|---|---|
| **Posyandu Balita IoT** | Presensi balita dengan tap e-KTP / RFID, tracking tumbuh kembang (BB, TB, Lingkar Kepala), status gizi WHO, dan cetak KMS Digital |
| **Bank Sampah** | Tabungan sampah pilah warga yang dikonversi menjadi saldo simpanan kas RT bernilai ekonomis |
| **Aspirasi Warga** | Kanal aduan, kritik, dan saran warga lingkungan yang transparan dan dapat dipantau statusnya |
| **Inventaris Aset RT** | Pencatatan barang dan aset milik RT (tenda, kursi, sound system, terpal) serta riwayat peminjaman |

---

## 📡 Integrasi IoT Smart Posyandu Balita

Sistem E-KASRT terhubung langsung dengan perangkat keras **ESP32 + RFID Reader RC-522** untuk mempercepat proses kehadiran balita di Posyandu:

### Skema Pinout Wiring ESP32 ke MFRC522:
```
MFRC522 PIN      ESP32 GPIO
────────────────────────────
SDA (SS)   ───>  GPIO 5
SCK        ───>  GPIO 18
MOSI       ───>  GPIO 23
MISO       ───>  GPIO 19
RST        ───>  GPIO 22
3.3V       ───>  3V3 (PERHATIAN: Jangan gunakan 5V!)
GND        ───>  GND
BUZZER     ───>  GPIO 4 (Opsional: Audio Feedback)
LED HIJAU  ───>  GPIO 2 (Opsional: Indikator Berhasil)
```

### Cara Kerja Komunikasi:
1. **Mode Direct Web Serial API**: Browser Chrome terhubung langsung ke ESP32 melalui kabel USB (baudrate `115200`), membaca UID kartu secara instan tanpa memerlukan server perantara.
2. **Mode Wi-Fi HTTP POST**: ESP32 mengirimkan UID kartu melalui endpoint API `/smartrt/posyandu_rfid_tap` dengan otentikasi API Key aman.
3. Firmware Arduino C++ siap pakai tersedia untuk diunduh langsung di panel Posyandu (`.ino` dan `.zip`).

---

## 👥 Hierarki Hak Akses (RBAC)

| Role ID | Peran | Akun Default | Hak Akses |
|:---:|:---:|:---:|:---|
| `1` | **Superadmin** | `admin` / `admin` | Akses absolut: seluruh transaksi, modul Smart RT, pengaturan sistem, dan kelola akun pengguna |
| `2` | **RT** | *(didaftarkan)* | Akses operasional pengurus RT: kas, warga, surat pengantar, dan posyandu |
| `3` | **Bendahara** | *(didaftarkan)* | Akses pengelolaan keuangan: kas masuk, kas keluar, transfer rekening, dan laporan kas |
| `4` | **Warga** | *(registrasi mandiri)* | Akses portal warga: melihat saldo kas transparan, riwayat iuran, dan pengajuan surat |

---

## 🗄️ Struktur Database

Database: **`kasrt`** (MySQL / MariaDB)

| Tabel | Deskripsi |
|---|---|
| `users` | Akun pengguna sistem (username, password hash, role_id, is_active) |
| `user_role` | Data master hak akses (Superadmin, RT, Bendahara, Warga) |
| `data_warga` | Master kependudukan (NIK, rfid_ktp, no_kk, nama, jekel, alamat, no_rumah) |
| `data_kas` | Arus kas masuk dan pengeluaran lingkungan RT |
| `transaksi_transfer` | Mutasi transfer kas antar-rekening RT dan dompet digital |
| `posyandu_balita` | Data master balita dan nama orang tua |
| `posyandu_sesi` | Sesi aktif kegiatan posyandu bulanan |
| `posyandu_kehadiran` | Catatan kehadiran, penimbangan berat badan, dan pengukuran tinggi badan balita |
| `posyandu_tap_log` | Riwayat log ketukan kartu RFID / e-KTP |
| `surat` | Pengajuan surat pengantar dan status persetujuan |
| `bank_sampah` | Setoran sampah anorganik dan konversi saldo warga |
| `aspirasi` | Kotak saran dan masukan warga |
| `aset` | Inventaris aset milik RT dan kondisi barang |
| `iuran_payment` | Riwayat pembayaran iuran warga |

---

## 💻 Panduan Instalasi Lokal

### Prasyarat Sistem:
- PHP >= 8.2 (ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `curl`)
- Composer >= 2.x
- MySQL >= 8.0 atau MariaDB >= 10.4
- Web Browser modern (Google Chrome disarankan untuk Web Serial IoT)

### Langkah Instalasi:

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/shadiqzx/E-KASRT.git
   cd E-KASRT
   ```

2. **Install Dependensi Composer**:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**:
   Salin file konfigurasi environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database di `.env`**:
   Sesuaikan parameter database Anda:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kasrt
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Import Database**:
   Import file database `database/kasrt.sql` ke MySQL Anda via phpMyAdmin atau CLI:
   ```bash
   mysql -u root -p kasrt < database/kasrt.sql
   ```

6. **Jalankan Development Server**:
   ```bash
   php artisan serve --port=8000
   ```
   Akses aplikasi di browser: **`http://127.0.0.1:8000`**

---

## 🔗 Peta Rute URL (Endpoint Matrix)

### Halaman Publik & Autentikasi:
- `GET /` : Halaman Selamat Datang / Landing Page & Sekilas Fitur
- `GET /login` : Halaman Login (Glassmorphism Split Layout)
- `POST /login` : Proses Autentikasi Masuk
- `GET /register` : Formulir Pendaftaran Akun Warga Baru
- `POST /register` : Proses Registrasi Warga & Pembuatan Akun
- `GET /logout` : Keluar dari Sistem

### Panel Dashboard & Keuangan (Auth Required):
- `GET /dashboard` : Dashboard Eksekutif & Chart Tren Arus Kas
- `GET /kas-masuk` : Pencatatan Kas Masuk RT
- `GET /kas-keluar` : Pencatatan Belanja Pengeluaran RT
- `POST /kas/store` : Simpan Transaksi Kas Masuk / Keluar
- `GET /kas/kwitansi/{id}` : Cetak Bukti Kwitansi Transaksi
- `GET /kas/laporan` : Rekapitulasi Laporan Keuangan Berkala

### Layanan Smart RT & IoT:
- `GET /smartrt/posyandu` : Panel Kelola Posyandu Balita IoT & Radar Scan
- `GET /smartrt/posyandu_cetak_kms/{id}` : Cetak KMS Balita
- `GET /smartrt/transfer` : Kelola Transfer Rekening Kas RT
- `GET /smartrt/iuran` : Rekap Iuran Warga & Status Tagihan
- `GET /smartrt/banksampah` : Pembukuan Bank Sampah Lingkungan
- `GET /smartrt/surat` : Layanan Pengajuan Surat Pengantar RT
- `GET /smartrt/aspirasi` : Kotak Aspirasi & Masukan Warga
- `GET /smartrt/aset` : Inventaris Aset & Peminjaman Barang RT
- `GET /smartrt/backup` : Backup Database MySQL 1-Klik

---

## 📁 Struktur Direktori Proyek

```
E-KASRT/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Login, Register Warga, Logout
│   │   ├── DashboardController.php     # Perhitungan Saldo, Chart.js 6 Bulan
│   │   ├── KasController.php           # Kas Masuk, Keluar, Kwitansi, Laporan
│   │   ├── PosyanduController.php      # Posyandu Balita IoT & Web Serial
│   │   ├── SmartRtController.php       # Iuran, Transfer, Surat, Bank Sampah, Aset
│   │   ├── WargaController.php         # Manajemen Data Warga & CSV Import
│   │   └── AdminUserController.php     # Manajemen Pengguna & Hak Akses
│   └── Models/                         # Eloquent Models (User, DataKas, DataWarga, dll.)
│
├── database/                           # Skema Database & Backup SQL
├── public/
│   ├── assets/                         # Font, Icons, CSS tema, JS libraries
│   │   └── css/mobile-fix.css          # Executive Glassmorphism & Modal Stacking Engine
│   └── firmware_esp32/                 # Source code firmware ESP32 RFID (.ino & .zip)
│
├── resources/views/
│   ├── layouts/app.blade.php           # Master layout Glassmorphism (Dark Slate Sidebar)
│   ├── welcome.blade.php               # Halaman Selamat Datang & Sekilas Fitur Portal
│   ├── auth/
│   │   ├── login.blade.php             # Login Glassmorphism Split-Hero
│   │   └── register.blade.php          # Pendaftaran Warga Baru
│   ├── dashboard/index.blade.php       # Dashboard Eksekutif Arus Kas & Posyandu
│   ├── kas/                            # View Kas Masuk, Keluar, Kwitansi, Laporan
│   ├── warga/                          # View Data Kependudukan Warga
│   ├── smartrt/                        # View Modul Smart RT (Posyandu, Iuran, Surat, dll.)
│   └── admin/                          # View Manajemen Akun & Hak Akses
│
├── routes/web.php                      # Pendaftaran 70+ Endpoint URL Laravel
└── README.md                           # Dokumentasi Resmi Proyek
```

---

## 🚀 Deployment VPS & GitHub Actions

Repositori ini telah dikonfigurasi dengan alur kerja **CI/CD GitHub Actions** (`.github/workflows/deploy.yml`):
- Setiap kali branch `main` menerima `push`, workflow secara otomatis melakukan deploy via SSH ke VPS Server Production (`43.157.230.29`), menjalankan `composer install`, clear cache, dan sinkronisasi file ke web root production.

---

## 📄 Lisensi & Kontributor

- **Pengembang**: Syaifullah Asshadiq ([@shadiqzx](https://github.com/shadiqzx))
- **Lisensi**: Open-source di bawah lisensi [MIT License](LICENSE).
- Dibuat dengan bangga untuk kemajuan tata kelola lingkungan rukun tetangga di Indonesia. 🇮🇩
