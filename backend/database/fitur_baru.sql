-- 1. Tabel Uang Sampah
CREATE TABLE IF NOT EXISTS `sampah_payment` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `warga_id` INT NOT NULL,
  `bulan` VARCHAR(20) NOT NULL,
  `tahun` INT NOT NULL,
  `jumlah` INT NOT NULL DEFAULT 20000,
  `metode` ENUM('QR', 'Tunai') NOT NULL,
  `bukti_bayar` VARCHAR(100) DEFAULT NULL,
  `status` ENUM('Pending', 'Disetujui', 'Ditolak') NOT NULL DEFAULT 'Pending',
  `tanggal_bayar` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`warga_id`) REFERENCES `data_warga` (`idWarga`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Koperasi
CREATE TABLE IF NOT EXISTS `koperasi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `warga_id` INT NOT NULL,
  `jenis_transaksi` ENUM('Simpanan', 'Pinjaman') NOT NULL,
  `jumlah` INT NOT NULL,
  `keterangan` TEXT,
  `status` ENUM('Disetujui', 'Pending', 'Lunas') DEFAULT 'Pending',
  `tanggal` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`warga_id`) REFERENCES `data_warga` (`idWarga`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Bank Sampah
CREATE TABLE IF NOT EXISTS `bank_sampah` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `warga_id` INT NOT NULL,
  `jenis_sampah` VARCHAR(50) NOT NULL,
  `berat` DECIMAL(5,2) NOT NULL,
  `poin` INT NOT NULL DEFAULT 0,
  `tanggal` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`warga_id`) REFERENCES `data_warga` (`idWarga`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel UMKM
CREATE TABLE IF NOT EXISTS `umkm` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `warga_id` INT NOT NULL,
  `nama_usaha` VARCHAR(100) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL,
  `deskripsi` TEXT,
  `no_wa` VARCHAR(20) NOT NULL,
  `foto` VARCHAR(100) DEFAULT 'umkm_default.png',
  `tanggal_daftar` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`warga_id`) REFERENCES `data_warga` (`idWarga`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel Surat Menyurat
CREATE TABLE IF NOT EXISTS `surat` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `warga_id` INT NOT NULL,
  `jenis_surat` VARCHAR(50) NOT NULL,
  `keperluan` TEXT NOT NULL,
  `status` ENUM('Pending', 'Disetujui', 'Ditolak') NOT NULL DEFAULT 'Pending',
  `keterangan_admin` TEXT,
  `tanggal_pengajuan` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`warga_id`) REFERENCES `data_warga` (`idWarga`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Tabel Posyandu
CREATE TABLE IF NOT EXISTS `posyandu` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_anak` VARCHAR(100) NOT NULL,
  `ibu_nama` VARCHAR(100) NOT NULL,
  `umur_bulan` INT NOT NULL,
  `berat_badan` DECIMAL(4,2) NOT NULL,
  `tinggi_badan` DECIMAL(4,1) NOT NULL,
  `imunisasi` VARCHAR(100) DEFAULT NULL,
  `tanggal_periksa` DATE NOT NULL,
  `catatan` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Tabel Keamanan / Ronda
CREATE TABLE IF NOT EXISTS `ronda` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `hari` ENUM('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu') NOT NULL,
  `nama_petugas` VARCHAR(100) NOT NULL,
  `keterangan` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Tabel Kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_kegiatan` VARCHAR(100) NOT NULL,
  `tanggal` DATE NOT NULL,
  `waktu` TIME NOT NULL,
  `lokasi` VARCHAR(100) NOT NULL,
  `keterangan` TEXT,
  `status` ENUM('Mendatang', 'Selesai', 'Batal') DEFAULT 'Mendatang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Tabel Rukem
CREATE TABLE IF NOT EXISTS `rukem` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_almarhum` VARCHAR(100) NOT NULL,
  `tanggal_meninggal` DATE NOT NULL,
  `santunan` INT DEFAULT 0,
  `status_rukem` VARCHAR(100) DEFAULT 'Dalam Proses Pemakaman',
  `tanggal_input` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. Tabel Aspirasi
CREATE TABLE IF NOT EXISTS `aspirasi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_pengirim` VARCHAR(50) DEFAULT 'Anonim',
  `kategori` ENUM('Keluhan', 'Saran', 'Apresiasi', 'Lainnya') NOT NULL,
  `isi` TEXT NOT NULL,
  `tanggal_kirim` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 11. Tabel Aset RT
CREATE TABLE IF NOT EXISTS `aset` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_barang` VARCHAR(100) NOT NULL,
  `jumlah` INT NOT NULL,
  `kondisi` ENUM('Baik', 'Rusak Ringan', 'Rusak Berat') NOT NULL DEFAULT 'Baik',
  `lokasi` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Mock data ronda
INSERT IGNORE INTO `ronda` (`hari`, `nama_petugas`, `keterangan`) VALUES
('Senin', 'Yohan Riki', 'Ronda malam'),
('Senin', 'Ahmad Sidiq', 'Ronda malam'),
('Selasa', 'Rudi Hidayat', 'Ronda malam');

-- Insert Mock data kegiatan
INSERT IGNORE INTO `kegiatan` (`nama_kegiatan`, `tanggal`, `waktu`, `lokasi`, `keterangan`, `status`) VALUES
('Kerja Bakti Lingkungan', '2026-07-05', '07:30:00', 'Area RT 002', 'Bersih-bersih selokan', 'Mendatang'),
('Rapat Bulanan RT', '2026-07-10', '19:30:00', 'Balai RT 002', 'Membahas keamanan', 'Mendatang');

-- Insert Mock data aset
INSERT IGNORE INTO `aset` (`nama_barang`, `jumlah`, `kondisi`, `lokasi`) VALUES
('Tenda Besi 4x6', 2, 'Baik', 'Gudang RT'),
('Sound System Portable', 1, 'Baik', 'Rumah Pak RT'),
('Kursi Plastik Hijau', 50, 'Baik', 'Gudang RT');
