# 🏘️ E-KASRT — Sistem Informasi Warga Rukun Tetangga

> Aplikasi pengelolaan administrasi RT yang modern dan terintegrasi, dibangun dengan **CodeIgniter 3** di atas arsitektur **MVC**.

---

## 📌 Deskripsi Proyek

**E-KASRT** adalah sistem informasi manajemen RT (*Rukun Tetangga*) berbasis web yang mencakup seluruh aspek administrasi lingkungan — mulai dari keuangan, data warga, layanan surat, hingga kegiatan dan keamanan lingkungan.

Sistem ini dirancang dengan pendekatan **multi-role** agar setiap pemangku kepentingan (Superadmin, RT, Bendahara, dan Warga) mendapatkan tampilan dan akses yang sesuai dengan tanggung jawabnya.

---

## 🚀 Fitur Lengkap

### 💰 Keuangan
| Fitur | Deskripsi |
|---|---|
| **Kas Masuk** | Pencatatan seluruh pemasukan RT (iuran, donasi, dll.) |
| **Kas Keluar** | Pencatatan seluruh pengeluaran RT |
| **Laporan Keuangan** | Rekapitulasi saldo, debit/kredit per periode |

### 🏠 Data Kependudukan
| Fitur | Deskripsi |
|---|---|
| **Data Warga** | CRUD lengkap data warga (NIK, nama, TTL, alamat, JK) |
| **Import CSV** | Impor data warga massal via file CSV |

### 💳 Pembayaran Sampah
| Fitur | Deskripsi |
|---|---|
| **Uang Sampah** | Pembayaran iuran sampah via QR Code QRIS atau tatap muka |
| **Riwayat Pembayaran** | Warga dapat melihat status dan riwayat pembayaran sendiri |
| **Kelola Tagihan** | Admin/RT dapat verifikasi dan setujui pembayaran |

### 🏦 Ekonomi Warga
| Fitur | Deskripsi |
|---|---|
| **Koperasi** | Pencatatan simpan-pinjam warga dengan status persetujuan |
| **Bank Sampah** | Setoran sampah warga dikonversi ke poin (1 kg = 1.000 poin) |
| **UMKM** | Direktori usaha warga dengan kategori dan kontak WhatsApp |

### 📄 Layanan Administrasi
| Fitur | Deskripsi |
|---|---|
| **Surat Menyurat** | Pengajuan surat pengantar RT secara online, dilengkapi notifikasi status |
| **Posyandu** | Pencatatan tumbuh kembang balita (BB, TB, imunisasi) |
| **Rukem** | Manajemen data rukun kematian & santunan |
| **Aspirasi** | Kotak saran/keluhan warga, bisa dikirim secara anonim |

### 🛡️ Keamanan & Kegiatan
| Fitur | Deskripsi |
|---|---|
| **Jadwal Ronda** | Penjadwalan petugas ronda malam per hari |
| **Agenda Kegiatan** | Penjadwalan kegiatan RT (kerja bakti, rapat, dll.) |
| **Aset RT** | Inventaris barang/aset milik RT beserta kondisi dan lokasi |

### ☁️ Sistem & Backup
| Fitur | Deskripsi |
|---|---|
| **Backup Database** | Export database MySQL otomatis via mysqldump |
| **Sinkronisasi GitHub** | Upload otomatis file proyek ke repository GitHub `shadiqzx/E-KASRT` menggunakan GitHub REST API (tanpa Git CLI) |
| **Download Backup** | Unduh file `.sql` langsung dari browser |

---

## 👥 Sistem Hak Akses (Role-Based Access Control)

| Role ID | Nama Role | Akun Default | Akses |
|---|---|---|---|
| `1` | **Superadmin** | `admin` | Full akses: semua modul + kelola pengguna |
| `2` | **RT** | `avika` | Full akses kecuali manajemen pengguna |
| `3` | **Bendahara** | `audia` | Akses keuangan + laporan + layanan warga |
| `4` | **Warga** | *(per KK)* | Layanan warga saja: bayar sampah, surat, aspirasi, dll. |

> **Catatan:** Superadmin, RT, dan Bendahara menggunakan sidebar navigasi yang sama (`header.php`) — perubahan menu otomatis berlaku untuk ketiganya.

---

## 🗄️ Struktur Database

```
DATABASE: kasrt
```

| Tabel | Deskripsi |
|---|---|
| `users` | Data akun pengguna sistem |
| `user_role` | Master role: Superadmin, RT, Bendahara |
| `data_warga` | Data kependudukan warga RT |
| `data_kas` | Transaksi kas masuk & keluar |
| `sampah_payment` | Data pembayaran iuran uang sampah |
| `koperasi` | Transaksi simpan-pinjam koperasi warga |
| `bank_sampah` | Data setoran sampah & poin warga |
| `umkm` | Daftar usaha UMKM warga |
| `surat` | Pengajuan dan status surat menyurat |
| `posyandu` | Data pemeriksaan kesehatan balita |
| `ronda` | Jadwal petugas ronda malam |
| `kegiatan` | Agenda kegiatan RT |
| `rukem` | Data rukun kematian & santunan |
| `aspirasi` | Kotak aspirasi & saran warga |
| `aset` | Inventaris aset/barang milik RT |
| `tabel_kredit` | Catatan kredit keuangan RT |

---

## 🏗️ Arsitektur Proyek (Blueprint MVC)

```
E-KASRT/
├── application/
│   ├── controllers/
│   │   ├── Admin.php           # Dashboard & manajemen pengguna (Superadmin)
│   │   ├── Auth.php            # Login, logout, ganti password
│   │   ├── KasRT.php           # Kas masuk, kas keluar, laporan
│   │   ├── SmartRT.php         # ★ Semua fitur baru (11 modul + backup)
│   │   ├── Users.php           # Panel RT, Bendahara, Warga
│   │   └── Warga.php           # CRUD data warga
│   │
│   ├── models/
│   │   ├── M_auth.php          # Validasi login & kredensial
│   │   └── M_kas.php           # CRUD kas, warga, laporan
│   │
│   ├── views/
│   │   ├── include/
│   │   │   ├── header.php      # ★ Sidebar kiri — Superadmin, RT, Bendahara
│   │   │   ├── header_warga.php # Navbar atas — khusus Warga
│   │   │   └── footer.php      # Footer + JS global
│   │   │
│   │   ├── admin/              # View halaman Admin (kas, laporan, warga)
│   │   ├── bendahara/          # View halaman Bendahara
│   │   ├── rt/                 # View halaman RT
│   │   ├── warga/              # View halaman Warga
│   │   ├── laporan/            # Template cetak laporan
│   │   │
│   │   ├── smartrt/            # ★ 23 view modul SmartRT
│   │   │   ├── sampah.php / sampah_kelola.php
│   │   │   ├── koperasi.php / koperasi_kelola.php
│   │   │   ├── banksampah.php / banksampah_kelola.php
│   │   │   ├── umkm.php / umkm_kelola.php
│   │   │   ├── surat.php / surat_kelola.php
│   │   │   ├── posyandu.php / posyandu_kelola.php
│   │   │   ├── ronda.php / ronda_kelola.php
│   │   │   ├── kegiatan.php / kegiatan_kelola.php
│   │   │   ├── rukem.php / rukem_kelola.php
│   │   │   ├── aspirasi.php / aspirasi_kelola.php
│   │   │   ├── aset.php / aset_kelola.php
│   │   │   └── backup.php
│   │   │
│   │   ├── index.php           # Halaman dashboard utama
│   │   └── login.php           # Halaman login
│   │
│   └── config/
│       ├── database.php        # Koneksi MySQL
│       └── routes.php          # Routing URL
│
├── assets/                     # CSS, JS, Font, Gambar
├── database/
│   ├── fitur_baru.sql          # Migrasi 11 tabel fitur baru
│   ├── kasrt_backup.sql        # ★ Auto-generated backup
│   └── .htaccess               # Proteksi akses publik ke folder ini
│
├── system/                     # CodeIgniter 3 core (jangan diubah)
├── .htaccess                   # URL rewriting (mod_rewrite)
└── README.md                   # Dokumentasi ini
```

---

## 🔗 Peta URL Endpoint

### Publik
| URL | Deskripsi |
|---|---|
| `GET /kasrt/auth` | Halaman login |
| `POST /kasrt/auth/login` | Proses login |
| `GET /kasrt/auth/logout` | Logout |

### Admin / RT / Bendahara
| URL | Deskripsi |
|---|---|
| `GET /kasrt/admin` | Dashboard utama |
| `GET /kasrt/kasrt` | Kas masuk |
| `GET /kasrt/kasrt/kasKeluar` | Kas keluar |
| `GET /kasrt/kasrt/laporan` | Laporan keuangan |
| `GET /kasrt/warga` | Data warga |
| `GET /kasrt/admin/user` | Manajemen pengguna |

### SmartRT (Modul Layanan)
| URL | Deskripsi |
|---|---|
| `GET /kasrt/smartrt/sampah` | Uang sampah |
| `GET /kasrt/smartrt/koperasi` | Koperasi |
| `GET /kasrt/smartrt/banksampah` | Bank sampah |
| `GET /kasrt/smartrt/umkm` | Direktori UMKM |
| `GET /kasrt/smartrt/surat` | Surat menyurat |
| `GET /kasrt/smartrt/posyandu` | Posyandu |
| `GET /kasrt/smartrt/ronda` | Jadwal ronda |
| `GET /kasrt/smartrt/kegiatan` | Agenda kegiatan |
| `GET /kasrt/smartrt/rukem` | Rukun kematian |
| `GET /kasrt/smartrt/aspirasi` | Kotak aspirasi |
| `GET /kasrt/smartrt/aset` | Inventaris aset |
| `GET /kasrt/smartrt/backup` | Halaman backup & GitHub sync |
| `GET /kasrt/smartrt/backup_db` | Jalankan backup database |
| `GET /kasrt/smartrt/backup_github` | Push ke GitHub |
| `GET /kasrt/smartrt/backup_download` | Download file SQL |

---

## ⚙️ Cara Instalasi (Pengembangan Lokal)

### Prasyarat
- **XAMPP** atau server lokal berbasis PHP 7.x+
- **MariaDB / MySQL** (XAMPP default menggunakan MariaDB 10.x)
- Browser modern (Chrome, Firefox, Edge)

### Langkah Instalasi

```bash
# 1. Clone atau salin folder proyek ke htdocs XAMPP
# contoh: D:\data app\htdocs\kasrt

# 2. Buat database baru di phpMyAdmin
#    Database name: kasrt

# 3. Import tabel dasar
#    (Jika file schema tersedia, import melalui phpMyAdmin)

# 4. Import tabel fitur baru
#    Import file: database/fitur_baru.sql

# 5. Akses aplikasi
#    http://localhost/kasrt
```

### Konfigurasi Database
Edit file `application/config/database.php`:
```php
$db['default'] = [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',         // sesuaikan password MySQL Anda
    'database' => 'kasrt',
    'port'     => 3306,       // default XAMPP: 3306 atau 3307
    ...
];
```

### Akun Default
| Username | Password | Role |
|---|---|---|
| `admin` | `admin` | Superadmin |
| `avika` | `avika` | RT |
| `audia` | `audia` | Bendahara |

---

## ☁️ Sinkronisasi ke GitHub

Fitur backup otomatis mendukung push ke repository **`shadiqzx/E-KASRT`** via GitHub REST API (tidak memerlukan Git CLI).

**Cara aktivasi:**
1. Buat **Personal Access Token** di [github.com/settings/tokens](https://github.com/settings/tokens/new) dengan scope `repo`
2. Buka halaman: `http://localhost/kasrt/smartrt/backup`
3. Masukkan token → klik **Simpan Token**
4. Klik **Push ke GitHub** untuk upload semua file proyek

> Token disimpan di `database/.gh_token` yang dilindungi `.htaccess` dari akses publik.

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Backend Framework | CodeIgniter 3 (PHP) |
| Database | MariaDB 10.4 / MySQL 5.7+ |
| Frontend UI | Bootstrap 4.1, Font Awesome 5, Custom CSS |
| Grafik | Chart.js |
| AJAX/DOM | jQuery 3.x |
| Pembayaran | QRIS (QR Code statis) |
| GitHub Sync | GitHub REST API v3 (cURL/HTTPS) |

---

## 📝 Catatan Pengembangan

- Semua perubahan sidebar menu cukup dilakukan di **satu file**: `application/views/include/header.php` — perubahan otomatis berlaku untuk role Superadmin, RT, dan Bendahara.
- Proteksi akses berbasis `role_id` diterapkan di level controller, bukan hanya di view.
- File sensitif (token GitHub, backup SQL) dilindungi dari akses publik via `.htaccess` di folder `database/`.

---

*Dikembangkan untuk kemajuan administrasi RT Indonesia 🇮🇩*
