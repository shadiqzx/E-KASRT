-- ============================================================
-- MIGRASI: Upgrade Posyandu + Integrasi RFID ESP32
-- E-KASRT — Sistem Informasi Warga RT
-- Jalankan file ini di phpMyAdmin setelah kasrt.sql
-- ============================================================

-- --------------------------------------------------------
-- Tabel: posyandu_balita
-- Data permanen balita yang terdaftar di posyandu RT
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posyandu_balita` (
  `id`            INT(11)       NOT NULL AUTO_INCREMENT,
  `warga_id`      INT(11)       NOT NULL COMMENT 'FK ke data_warga (ibu/orang tua)',
  `nama_anak`     VARCHAR(100)  NOT NULL,
  `tanggal_lahir` DATE          NOT NULL,
  `jenis_kelamin` ENUM('L','P') NOT NULL DEFAULT 'L',
  `rfid_uid`      VARCHAR(50)   NULL DEFAULT NULL COMMENT 'UID kartu RFID/KTP yang di-tap',
  `foto`          VARCHAR(100)  NULL DEFAULT NULL,
  `created_at`    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_rfid_uid` (`rfid_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Data balita terdaftar di Posyandu';

-- --------------------------------------------------------
-- Tabel: posyandu_sesi
-- Jadwal dan sesi posyandu yang diselenggarakan RT
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posyandu_sesi` (
  `id`             INT(11)      NOT NULL AUTO_INCREMENT,
  `nama_sesi`      VARCHAR(100) NOT NULL,
  `tanggal`        DATE         NOT NULL,
  `waktu_mulai`    TIME         NOT NULL DEFAULT '08:00:00',
  `waktu_selesai`  TIME         NULL DEFAULT NULL,
  `lokasi`         VARCHAR(150) NOT NULL DEFAULT 'Balai RT',
  `petugas`        VARCHAR(100) NULL DEFAULT NULL,
  `status`         ENUM('Dijadwalkan','Aktif','Selesai') NOT NULL DEFAULT 'Dijadwalkan',
  `catatan`        TEXT         NULL,
  `created_at`     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Sesi/jadwal pelaksanaan posyandu';

-- --------------------------------------------------------
-- Tabel: posyandu_kehadiran
-- Kehadiran balita per sesi + data pemeriksaan
-- Tap RFID -> insert baris baru di sini otomatis
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posyandu_kehadiran` (
  `id`              INT(11)        NOT NULL AUTO_INCREMENT,
  `sesi_id`         INT(11)        NOT NULL,
  `balita_id`       INT(11)        NOT NULL,
  `jam_datang`      DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berat_badan`     DECIMAL(5,2)   NULL DEFAULT NULL,
  `tinggi_badan`    DECIMAL(5,2)   NULL DEFAULT NULL,
  `lingkar_kepala`  DECIMAL(5,2)   NULL DEFAULT NULL,
  `lila`            DECIMAL(5,2)   NULL DEFAULT NULL COMMENT 'Lingkar Lengan Atas (cm)',
  `imunisasi`       VARCHAR(150)   NULL DEFAULT NULL,
  `vitamin_a`       ENUM('Tidak','Kapsul Biru (6-11 bln)','Kapsul Merah (12-59 bln)') DEFAULT 'Tidak',
  `obat_cacing`     ENUM('Tidak','Ya') DEFAULT 'Tidak',
  `status_gizi`     ENUM('Normal','Kurang','Buruk','Lebih') NULL DEFAULT NULL,
  `catatan`         TEXT           NULL,
  `metode_absen`    ENUM('RFID','Manual') NOT NULL DEFAULT 'Manual',
  `rfid_uid`        VARCHAR(50)    NULL DEFAULT NULL,
  `created_at`      TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_sesi_balita` (`sesi_id`, `balita_id`),
  KEY `fk_kehadiran_sesi` (`sesi_id`),
  KEY `fk_kehadiran_balita` (`balita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Kehadiran & data pemeriksaan per sesi posyandu';

-- --------------------------------------------------------
-- Tabel: posyandu_tap_log
-- Log tap real-time dari ESP32 untuk live radar di dashboard
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posyandu_tap_log` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `uid`        VARCHAR(50)  NOT NULL,
  `status`     ENUM('SUCCESS','UNREGISTERED','ALREADY_CHECKED','NO_ACTIVE_SESSION') NOT NULL DEFAULT 'UNREGISTERED',
  `keterangan` VARCHAR(255) NULL,
  `warga_id`   INT(11)      NULL,
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Live stream buffer tap e-KTP dari ESP32';

-- Tambahkan kolom rfid_ktp pada data_warga jika belum ada
ALTER TABLE `data_warga` ADD COLUMN IF NOT EXISTS `rfid_ktp` VARCHAR(50) NULL AFTER `nik`;

-- --------------------------------------------------------
-- Data contoh: 1 sesi aktif posyandu
-- --------------------------------------------------------
INSERT INTO `posyandu_sesi` (`nama_sesi`, `tanggal`, `waktu_mulai`, `lokasi`, `petugas`, `status`) VALUES
('Posyandu Balita Oktober 2025', CURDATE(), '08:00:00', 'Balai RT 03', 'Bidan Sari', 'Aktif');

INSERT INTO `posyandu_balita` (`warga_id`, `nama_anak`, `tanggal_lahir`, `jenis_kelamin`, `rfid_uid`) VALUES
(1, 'Aisyah Putri', '2023-03-15', 'P', NULL),
(3, 'Budi Santoso', '2022-11-20', 'L', NULL),
(4, 'Citra Dewi',   '2024-01-05', 'P', NULL);

