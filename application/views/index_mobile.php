<?php
// Hitung saldo
$sum_masuk = 0;
foreach ($masuk as $m) { $sum_masuk += $m->total; }
$sum_keluar = 0;
foreach ($keluar as $k) { $sum_keluar += $k->total; }
$saldo = $sum_masuk - $sum_keluar;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>E-KASRT | Dashboard</title>
<link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.png">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
/* ================================================================
   RESET & BASE — Mobile-only view
   ================================================================ */
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --primary:   #2563EB;
    --primary-d: #1D4ED8;
    --success:   #16A34A;
    --danger:    #DC2626;
    --warning:   #D97706;
    --info:      #0891B2;
    --purple:    #7C3AED;
    --bg:        #F1F5F9;
    --card:      #FFFFFF;
    --text:      #1E293B;
    --muted:     #64748B;
    --border:    #E2E8F0;
    --nav-h:     62px;
    --top-h:     56px;
    --radius:    16px;
}

html, body {
    font-family: -apple-system, 'Segoe UI', Roboto, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}

/* ================================================================
   TOP BAR
   ================================================================ */
.topbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: var(--top-h);
    background: var(--primary);
    display: flex;
    align-items: center;
    padding: 0 16px;
    z-index: 100;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
}
.topbar-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
}
.topbar-logo .logo-icon {
    width: 34px; height: 34px;
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: #fff;
}
.topbar-logo h1 {
    font-size: 17px; font-weight: 700; color: #fff;
    line-height: 1;
}
.topbar-logo span {
    font-size: 10px; color: rgba(255,255,255,0.75);
    display: block; margin-top: 1px;
}
.topbar-right {
    display: flex; align-items: center; gap: 10px;
}
.topbar-notif {
    position: relative;
    width: 36px; height: 36px;
    background: rgba(255,255,255,0.15);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 16px;
    cursor: pointer;
}
.notif-badge {
    position: absolute;
    top: -2px; right: -2px;
    background: #EF4444;
    color: #fff;
    font-size: 9px; font-weight: 700;
    width: 16px; height: 16px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 1.5px solid var(--primary);
}
.topbar-avatar {
    width: 36px; height: 36px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 700; color: #fff;
    text-transform: uppercase;
}

/* ================================================================
   SCROLL CONTAINER
   ================================================================ */
.page-scroll {
    padding-top: var(--top-h);
    padding-bottom: calc(var(--nav-h) + 12px);
    min-height: 100vh;
}

/* ================================================================
   HERO SECTION — Gradient saldo utama
   ================================================================ */
.hero {
    background: linear-gradient(145deg, #2563EB 0%, #7C3AED 100%);
    padding: 20px 16px 36px;
    position: relative;
    overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 160px; height: 160px;
    background: rgba(255,255,255,0.07);
    border-radius: 50%;
}
.hero::after {
    content: '';
    position: absolute;
    bottom: -30px; left: -20px;
    width: 120px; height: 120px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}
.hero-label {
    font-size: 12px; color: rgba(255,255,255,0.75);
    margin-bottom: 6px; letter-spacing: 0.5px;
}
.hero-amount {
    font-size: 32px; font-weight: 800; color: #fff;
    letter-spacing: -0.5px; margin-bottom: 4px;
    line-height: 1;
}
.hero-sub {
    font-size: 12px; color: rgba(255,255,255,0.65);
    margin-bottom: 16px;
}
.hero-meta {
    display: flex; gap: 12px;
}
.hero-meta-item {
    background: rgba(255,255,255,0.15);
    border-radius: 10px;
    padding: 8px 12px;
    flex: 1;
}
.hero-meta-item label {
    font-size: 10px; color: rgba(255,255,255,0.7);
    display: block; margin-bottom: 3px;
}
.hero-meta-item strong {
    font-size: 13px; color: #fff; font-weight: 700;
    display: block;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

/* ================================================================
   STATS CARDS — pull up over hero
   ================================================================ */
.stats-section {
    padding: 0 12px;
    margin-top: -20px;
    position: relative;
    z-index: 10;
}
.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.stat-card {
    background: var(--card);
    border-radius: var(--radius);
    padding: 14px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 12px;
}
.stat-icon {
    width: 40px; height: 40px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.si-green  { background: #DCFCE7; color: #16A34A; }
.si-red    { background: #FEE2E2; color: #DC2626; }
.si-blue   { background: #DBEAFE; color: #2563EB; }
.si-yellow { background: #FEF3C7; color: #D97706; }

.stat-info { min-width: 0; }
.stat-info p {
    font-size: 10px; color: var(--muted);
    margin-bottom: 3px; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
}
.stat-info h3 {
    font-size: 13px; font-weight: 700; color: var(--text);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.stat-info small {
    font-size: 10px; color: var(--muted);
}

/* ================================================================
   SECTION CARD
   ================================================================ */
.section-card {
    background: var(--card);
    border-radius: var(--radius);
    margin: 12px 12px 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    overflow: hidden;
}
.section-header {
    padding: 14px 16px 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--border);
}
.section-header h2 {
    font-size: 14px; font-weight: 700; color: var(--text);
}
.section-header a {
    font-size: 12px; color: var(--primary);
    text-decoration: none; font-weight: 500;
}

/* ================================================================
   QUICK ACTIONS GRID
   ================================================================ */
.action-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border);
}
.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 16px 8px;
    background: var(--card);
    text-decoration: none;
    gap: 8px;
    transition: background 0.15s;
    -webkit-tap-highlight-color: transparent;
}
.action-btn:active { background: #F8FAFC; }
.action-icon {
    width: 44px; height: 44px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
}
.action-btn span {
    font-size: 11px; font-weight: 600;
    color: var(--text); text-align: center;
    line-height: 1.2;
}

/* ================================================================
   TRANSACTION LIST
   ================================================================ */
.tx-list { padding: 0 4px; }
.tx-item {
    display: flex;
    align-items: center;
    padding: 12px 12px;
    gap: 12px;
    border-bottom: 1px solid var(--border);
}
.tx-item:last-child { border-bottom: none; }
.tx-icon {
    width: 38px; height: 38px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.tx-info { flex: 1; min-width: 0; }
.tx-info h4 {
    font-size: 13px; font-weight: 600; color: var(--text);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    margin-bottom: 3px;
}
.tx-info p { font-size: 11px; color: var(--muted); }
.tx-amount { text-align: right; flex-shrink: 0; }
.tx-amount span { font-size: 10px; color: var(--muted); display: block; margin-bottom: 3px; }
.tx-amount strong { font-size: 13px; font-weight: 700; }
.amount-in  { color: #16A34A; }
.amount-out { color: #DC2626; }

.tx-empty {
    padding: 30px 16px;
    text-align: center;
    color: var(--muted);
    font-size: 13px;
}
.tx-empty i { font-size: 32px; display: block; margin-bottom: 10px; opacity: 0.3; }

/* ================================================================
   ANNOUNCEMENT LIST
   ================================================================ */
.ann-item {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    display: flex;
    gap: 12px;
    align-items: flex-start;
}
.ann-item:last-child { border-bottom: none; }
.ann-dot {
    width: 36px; height: 36px;
    background: #DBEAFE;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; color: #2563EB; flex-shrink: 0;
}
.ann-content h4 {
    font-size: 13px; font-weight: 600; color: var(--text);
    margin-bottom: 3px;
}
.ann-content p { font-size: 11px; color: var(--muted); line-height: 1.4; }
.ann-date {
    font-size: 10px; color: #94A3B8;
    display: block; margin-bottom: 4px;
}

/* ================================================================
   BOTTOM NAV
   ================================================================ */
.bottom-nav {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    height: var(--nav-h);
    background: var(--card);
    border-top: 1px solid var(--border);
    display: flex;
    align-items: center;
    z-index: 200;
    box-shadow: 0 -4px 16px rgba(0,0,0,0.06);
}
.nav-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 8px 4px;
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
    cursor: pointer;
}
.nav-item i { font-size: 20px; color: #94A3B8; transition: color 0.15s; }
.nav-item span { font-size: 10px; color: #94A3B8; font-weight: 500; }
.nav-item.active i { color: var(--primary); }
.nav-item.active span { color: var(--primary); font-weight: 700; }
.nav-item.nav-center {
    position: relative;
}
.nav-center-btn {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, var(--primary), var(--purple));
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 12px rgba(37,99,235,0.35);
    margin-bottom: 2px;
}
.nav-center-btn i { font-size: 22px; color: #fff; }
.nav-item.nav-center span { color: var(--primary); font-size: 10px; font-weight: 600; }

/* ================================================================
   GREETING STRIP
   ================================================================ */
.greeting-strip {
    padding: 14px 16px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.greeting-strip h2 {
    font-size: 15px; font-weight: 700; color: var(--text);
}
.greeting-strip p { font-size: 11px; color: var(--muted); }
.date-chip {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 5px 12px;
    font-size: 11px; color: var(--muted);
    white-space: nowrap;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

/* ================================================================
   PAGE FADE-IN
   ================================================================ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
.page-scroll { animation: fadeUp 0.35s ease-out; }

/* ================================================================
   SECTION BOTTOM SPACER
   ================================================================ */
.spacer { height: 20px; }
</style>
</head>
<body>

<!-- ============================================================
     TOP BAR
     ============================================================ -->
<div class="topbar">
    <div class="topbar-logo">
        <div class="logo-icon"><i class="fas fa-wallet"></i></div>
        <div>
            <h1>E-KASRT</h1>
            <span>Keuangan RT</span>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-notif">
            <i class="fas fa-bell"></i>
            <span class="notif-badge">3</span>
        </div>
        <div class="topbar-avatar">
            <?= strtoupper(substr($user['username'], 0, 1)) ?>
        </div>
    </div>
</div>

<!-- ============================================================
     SCROLLABLE CONTENT
     ============================================================ -->
<div class="page-scroll">

    <!-- HERO: Saldo Utama -->
    <div class="hero">
        <div class="greeting-strip" style="padding: 0 0 16px; background: transparent;">
            <div>
                <h2 style="color:#fff; font-size:15px;">Halo, <?= htmlspecialchars($user['username']); ?> 👋</h2>
                <p style="color:rgba(255,255,255,0.7); font-size:11px;">Selamat datang kembali</p>
            </div>
            <div class="date-chip" style="background:rgba(255,255,255,0.15); border:none; color:rgba(255,255,255,0.85);">
                <i class="far fa-calendar-alt" style="margin-right:5px;"></i><?= date('d M Y') ?>
            </div>
        </div>
        <p class="hero-label"><i class="fas fa-wallet" style="margin-right:6px;"></i>SALDO KAS RT</p>
        <div class="hero-amount">Rp <?= number_format($saldo, 0, ',', '.') ?></div>
        <p class="hero-sub">Per tanggal <?= date('d M Y') ?></p>
        <div class="hero-meta">
            <div class="hero-meta-item">
                <label><i class="fas fa-arrow-down" style="margin-right:4px;"></i>Pemasukan</label>
                <strong>Rp <?= number_format($sum_masuk, 0, ',', '.') ?></strong>
            </div>
            <div class="hero-meta-item">
                <label><i class="fas fa-arrow-up" style="margin-right:4px;"></i>Pengeluaran</label>
                <strong>Rp <?= number_format($sum_keluar, 0, ',', '.') ?></strong>
            </div>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon si-green"><i class="fas fa-arrow-down"></i></div>
                <div class="stat-info">
                    <p>Total Pemasukan</p>
                    <h3>Rp <?= number_format($sum_masuk, 0, ',', '.') ?></h3>
                    <small style="color:#16A34A;">+12.5% bulan ini</small>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-red"><i class="fas fa-arrow-up"></i></div>
                <div class="stat-info">
                    <p>Total Pengeluaran</p>
                    <h3>Rp <?= number_format($sum_keluar, 0, ',', '.') ?></h3>
                    <small style="color:#DC2626;">+8.3% bulan ini</small>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-blue"><i class="fas fa-wallet"></i></div>
                <div class="stat-info">
                    <p>Saldo Bersih</p>
                    <h3>Rp <?= number_format($saldo, 0, ',', '.') ?></h3>
                    <small>Kas tersedia</small>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-yellow"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <p>Total Warga</p>
                    <h3><?= isset($total_warga) ? $total_warga : 0 ?> KK</h3>
                    <small>Terdaftar</small>
                </div>
            </div>
        </div>
    </div>

    <!-- AKSI CEPAT -->
    <div class="section-card">
        <div class="section-header">
            <h2><i class="fas fa-bolt" style="color:#D97706;margin-right:8px;"></i>Aksi Cepat</h2>
        </div>
        <div class="action-grid">
            <a href="<?= base_url('kasRT') ?>" class="action-btn">
                <div class="action-icon" style="background:#DCFCE7;">
                    <i class="fas fa-plus-circle" style="color:#16A34A;"></i>
                </div>
                <span>Tambah Pemasukan</span>
            </a>
            <a href="<?= base_url('kasRT/kasKeluar') ?>" class="action-btn">
                <div class="action-icon" style="background:#FEE2E2;">
                    <i class="fas fa-minus-circle" style="color:#DC2626;"></i>
                </div>
                <span>Tambah Pengeluaran</span>
            </a>
            <a href="<?= base_url('warga') ?>" class="action-btn">
                <div class="action-icon" style="background:#DBEAFE;">
                    <i class="fas fa-users" style="color:#2563EB;"></i>
                </div>
                <span>Data Warga</span>
            </a>
            <a href="<?= base_url('kasRT/laporan') ?>" class="action-btn">
                <div class="action-icon" style="background:#FEF3C7;">
                    <i class="fas fa-file-invoice" style="color:#D97706;"></i>
                </div>
                <span>Laporan</span>
            </a>
            <a href="<?= base_url('smartrt/backup') ?>" class="action-btn">
                <div class="action-icon" style="background:#F3E8FF;">
                    <i class="fas fa-cloud-download-alt" style="color:#7C3AED;"></i>
                </div>
                <span>Backup Data</span>
            </a>
            <a href="<?= base_url('admin/user') ?>" class="action-btn">
                <div class="action-icon" style="background:#E0F2FE;">
                    <i class="fas fa-user-cog" style="color:#0891B2;"></i>
                </div>
                <span>Kelola User</span>
            </a>
        </div>
    </div>

    <!-- TRANSAKSI TERBARU -->
    <div class="section-card">
        <div class="section-header">
            <h2><i class="fas fa-history" style="color:#2563EB;margin-right:8px;"></i>Transaksi Terbaru</h2>
            <a href="<?= base_url('kasRT') ?>">Lihat semua →</a>
        </div>
        <div class="tx-list">
            <?php if (isset($recent_kas) && !empty($recent_kas)): ?>
                <?php foreach ($recent_kas as $tx): ?>
                <div class="tx-item">
                    <div class="tx-icon <?= $tx->jenis == 'masuk' ? 'si-green' : 'si-red' ?>">
                        <i class="fas <?= $tx->jenis == 'masuk' ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
                    </div>
                    <div class="tx-info">
                        <h4><?= htmlspecialchars($tx->keterangan) ?></h4>
                        <p><?= ucfirst($tx->jenis) ?></p>
                    </div>
                    <div class="tx-amount">
                        <span><?= date('d M', strtotime($tx->tanggal)) ?></span>
                        <strong class="<?= $tx->jenis == 'masuk' ? 'amount-in' : 'amount-out' ?>">
                            <?= $tx->jenis == 'masuk' ? '+' : '-' ?>Rp <?= number_format($tx->jumlah, 0, ',', '.') ?>
                        </strong>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="tx-empty">
                    <i class="fas fa-receipt"></i>
                    Belum ada transaksi
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- PENGUMUMAN -->
    <div class="section-card">
        <div class="section-header">
            <h2><i class="fas fa-bullhorn" style="color:#D97706;margin-right:8px;"></i>Pengumuman</h2>
            <a href="#">Lihat semua →</a>
        </div>
        <div class="ann-item">
            <div class="ann-dot"><i class="fas fa-tools"></i></div>
            <div class="ann-content">
                <span class="ann-date">5 Mei 2024</span>
                <h4>Kerja Bakti Lingkungan</h4>
                <p>Dilaksanakan hari Minggu, 12 Mei 2024. Mohon partisipasi seluruh warga.</p>
            </div>
        </div>
        <div class="ann-item">
            <div class="ann-dot"><i class="fas fa-money-bill-wave"></i></div>
            <div class="ann-content">
                <span class="ann-date">1 Mei 2024</span>
                <h4>Pembayaran Iuran Mei 2024</h4>
                <p>Iuran RT bulan Mei 2024 sudah dibuka. Terima kasih warga yang sudah membayar.</p>
            </div>
        </div>
    </div>

    <div class="spacer"></div>
</div>

<!-- ============================================================
     BOTTOM NAVIGATION
     ============================================================ -->
<nav class="bottom-nav">
    <a href="<?= base_url('admin') ?>" class="nav-item active">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
    </a>
    <a href="<?= base_url('kasRT') ?>" class="nav-item">
        <i class="fas fa-exchange-alt"></i>
        <span>Transaksi</span>
    </a>
    <a href="<?= base_url('kasRT') ?>" class="nav-item nav-center">
        <div class="nav-center-btn">
            <i class="fas fa-plus"></i>
        </div>
        <span>Tambah</span>
    </a>
    <a href="<?= base_url('warga') ?>" class="nav-item">
        <i class="fas fa-users"></i>
        <span>Warga</span>
    </a>
    <a href="<?= base_url('kasRT/laporan') ?>" class="nav-item">
        <i class="fas fa-file-alt"></i>
        <span>Laporan</span>
    </a>
</nav>

</body>
<script>
/* Kalau layar dibesarkan (F12 ditutup/desktop view), redirect ke desktop */
var _rt;
window.addEventListener('resize', function() {
    clearTimeout(_rt);
    _rt = setTimeout(function() {
        if (window.innerWidth > 768) {
            var desktopUrl = sessionStorage.getItem('desktopUrl') || '<?= base_url('admin') ?>';
            window.location.replace(desktopUrl);
        }
    }, 200);
});
</script>
</html>
