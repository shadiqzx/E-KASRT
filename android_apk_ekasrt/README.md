# 📱 Project Aplikasi Android E-KASRT (WebView Wrapper)

Project ini adalah aplikasi Android native (Java + AndroidX + Material Design) yang membungkus web **E-KASRT** ke dalam aplikasi APK untuk smartphone Android.

---

## 🌟 Fitur Lengkap Aplikasi Android
- **Tampilan Bersih & Responsif**: Fullscreen tanpa address bar browser.
- **Pull to Refresh**: Tarik ke bawah untuk refresh data terbaru.
- **Progress Bar Modern**: Indikator loading warna ungu khas E-KASRT di bagian atas layar.
- **Dukungan Upload File & Kamera**: Warga bisa unggah bukti transfer sampah/koperasi dan foto KTP langsung dari galeri atau kamera HP.
- **Download Dokumen Otomatis**: Pengunduhan Surat Pengantar RT, Laporan Keuangan, dan Backup SQL langsung tersimpan ke folder *Downloads* HP dengan notifikasi unduhan native Android.
- **Sesi Login Awet (Cookie Sync)**: Pengguna tidak sering logout sendiri berkat sinkronisasi cookie native.
- **Navigasi Tombol Back**: Menekan tombol kembali di HP akan mundur ke halaman web sebelumnya (bukan langsung keluar dari aplikasi).
- **Integrasi Link Eksternal**: Tautan WhatsApp Admin langsung membuka aplikasi WhatsApp di HP.
- **Layar Offline & Pengaturan IP Dinamis**: Jika koneksi terputus atau IP komputer berubah, terdapat tombol **"Ganti Alamat Server IP"** langsung di aplikasi tanpa perlu recompile ulang APK.

---

## 🚀 Cara Membuka & Membuat File APK

### Cara 1: Menggunakan Android Studio (Paling Mudah & Rekomendasi)
1. Buka aplikasi **Android Studio**.
2. Pilih menu **File > Open**, lalu arahkan ke folder ini:
   ```
   D:\Repository\E-KASRT-main\android_apk_ekasrt
   ```
3. Tunggu proses sinkronisasi Gradle selesai secara otomatis.
4. Untuk menghasilkan file `.apk`:
   - Klik menu atas **Build > Build Bundle(s) / APK(s) > Build APK(s)**.
   - Setelah selesai, klik tombol **locate** pada notifikasi di pojok kanan bawah.
   - File APK siap disalin ke HP Android mana saja dan diinstall!

### Cara 2: Menghubungkan HP Android Langsung ke Laptop
1. Aktifkan **USB Debugging** di HP Android Anda (*Pengaturan > Opsi Pengembang > USB Debugging*).
2. Colokkan kabel USB dari HP ke laptop/PC.
3. Di Android Studio, pilih HP Anda lalu klik tombol **Run ▶️ (Shift + F10)**. Aplikasi langsung terinstall di HP Anda.

---

## ⚙️ Mengganti Alamat URL Server
Alamat default telah dikonfigurasi ke:
```
http://192.168.1.7/kasrt/
```
Jika IP komputer Anda berubah, Anda bisa mengubahnya di file:
`app/src/main/res/values/strings.xml` pada tag `<string name="default_web_url">`.
Atau langsung dari aplikasi saat layar offline muncul dengan menekan tombol **"Ganti Alamat Server IP"**.
