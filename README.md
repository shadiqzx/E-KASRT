# e-kasRT - Aplikasi Pengelolaan Kas RT

**Aplication of Kas RT**

The e-kasRT application is a simple cash management application that can be used for financial management in the RT (Rukun Tetangga) area.

## 🚀 Fitur Utama
- **Manajemen Warga:** Pendataan informasi warga RT.
- **Manajemen Kas:** Pencatatan transaksi uang masuk (iuran) dan keluar (pengeluaran).
- **Sistem Autentikasi:** Login dan manajemen hak akses (Auth & Users).
- **Laporan/Dashboard:** Rekapitulasi keuangan yang dapat dikelola oleh Admin.

## 🛠️ Teknologi yang Digunakan
- **Backend Framework:** CodeIgniter 3 (PHP)
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript (berada di folder `assets`)

## 📂 Arsitektur Proyek (Blueprint)
Aplikasi ini dibangun menggunakan pola arsitektur **MVC (Model-View-Controller)**:

### 1. Controllers (`application/controllers/`)
Bagian ini mengatur logika aplikasi dan menghubungkan antara View dan Model:
- `Admin.php`: Mengelola halaman dashboard dan fungsionalitas spesifik untuk admin.
- `Auth.php`: Menangani proses autentikasi (login/logout).
- `KasRT.php`: Controller utama untuk mengelola pencatatan arus kas.
- `Users.php`: Mengatur penambahan, pengubahan, dan penghapusan data pengguna sistem.
- `Warga.php`: Mengatur data warga RT.
- `Welcome.php`: Controller default / halaman muka bawaan.

### 2. Models (`application/models/`)
Bagian ini menangani semua interaksi dengan database (Query):
- `M_auth.php`: Model khusus untuk memvalidasi kredensial pengguna saat login.
- `M_kas.php`: Model utama untuk melakukan operasi CRUD (Create, Read, Update, Delete) pada tabel kas dan data lainnya.

### 3. Folder Penting Lainnya
- `application/views/`: Berisi semua file template HTML/UI untuk menampilkan data kepada pengguna.
- `application/config/`: Berisi konfigurasi inti aplikasi. Konfigurasi database ada di `database.php` (menunjuk ke db `kasrt`).
- `assets/`: Folder untuk menyimpan resource statis seperti file CSS, JavaScript, font, dan gambar.
- `database/`: Biasanya digunakan untuk menyimpan file *dump* (cadangan) `.sql` dari struktur tabel aplikasi.

## ⚙️ Cara Instalasi (Pengembangan Lokal)
1. Pindahkan folder proyek ini (`kasrt`) ke dalam direktori server lokal Anda (contoh: `c:\xampp\htdocs\`).
2. Buat database baru di MySQL (melalui phpMyAdmin) dengan nama **`kasrt`**.
3. *Import* file database berformat `.sql` (jika tersedia di folder `database/`) ke dalam database `kasrt` tersebut.
4. Buka file konfigurasi `application/config/database.php`. Secara default, aplikasi ini di-setting untuk koneksi MySQL di port `3307` dengan user `root` (tanpa password). Sesuaikan dengan konfigurasi XAMPP/MySQL Anda.
5. Akses aplikasi melalui web browser di alamat: `http://localhost/kasrt` (sesuaikan port jika diperlukan).

---
*This application is still far from perfect, therefore it is welcome to be developed and used properly. Thanks very much.*
