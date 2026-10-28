<?php
// Hitung saldo
$sum_masuk = 0;
foreach ($masuk as $total_masuk) { $sum_masuk += $total_masuk->total; }
$sum_keluar = 0;
foreach ($keluar as $total_keluar) { $sum_keluar += $total_keluar->total; }
$saldo = $sum_masuk - $sum_keluar;

// Data grafik
$bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
$data_masuk_chart  = [1200000,1500000,1800000,1600000,2100000,1900000,2300000,2000000,2400000,2200000,2600000,2800000];
$data_keluar_chart = [800000,900000,1100000,1000000,1300000,1200000,1400000,1100000,1500000,1300000,1600000,1700000];
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- Welcome -->
            <div class="row mb-3 mt-2">
                <div class="col-12 d-flex justify-content-between align-items-center flex-wrap" style="gap:8px;">
                    <div>
                        <h1 style="font-size:22px;font-weight:700;color:#333;margin-bottom:2px;">
                            Selamat datang, <?= $user['username'];?> 👋
                        </h1>
                        <p style="color:#888;font-size:13px;margin:0;">Kelola keuangan RT dengan mudah dan transparan</p>
                    </div>
                    <div style="background:#fff;padding:8px 16px;border-radius:8px;border:1px solid #eee;color:#666;font-size:13px;white-space:nowrap;">
                        <i class="far fa-calendar-alt" style="margin-right:6px;"></i><?= strftime('%A, %d %B %Y') ?>
                    </div>
                </div>
            </div>

            <!-- Top Stats Cards -->
            <div class="top-cards-container">
                <div class="top-card">
                    <div class="top-card-icon icon-green"><i class="fas fa-arrow-down"></i></div>
                    <div class="top-card-info">
                        <h4>Total Pemasukan</h4>
                        <h2>Rp <?= number_format($sum_masuk,0,',','.') ?></h2>
                        <p><span class="trend-up">+12.5%</span> dari bulan lalu</p>
                    </div>
                </div>
                <div class="top-card">
                    <div class="top-card-icon icon-red"><i class="fas fa-arrow-up"></i></div>
                    <div class="top-card-info">
                        <h4>Total Pengeluaran</h4>
                        <h2>Rp <?= number_format($sum_keluar,0,',','.') ?></h2>
                        <p><span class="trend-down">+8.3%</span> dari bulan lalu</p>
                    </div>
                </div>
                <div class="top-card">
                    <div class="top-card-icon icon-blue"><i class="fas fa-wallet"></i></div>
                    <div class="top-card-info">
                        <h4>Saldo Kas</h4>
                        <h2>Rp <?= number_format($saldo,0,',','.') ?></h2>
                        <p>Per <?= date('d M Y') ?></p>
                    </div>
                </div>
                <div class="top-card">
                    <div class="top-card-icon icon-yellow"><i class="fas fa-users"></i></div>
                    <div class="top-card-info">
                        <h4>Total Warga</h4>
                        <h2><?= isset($total_warga) ? $total_warga : 0 ?></h2>
                        <p>KK Terdaftar</p>
                    </div>
                </div>
            </div>

            <!-- Middle Section -->
            <div class="row mb-3">
                <div class="col-12 col-lg-4 mb-3">
                    <div class="saldo-card d-flex flex-column justify-content-between">
                        <div>
                            <h4>Saldo Kas Saat Ini</h4>
                            <h1>Rp <?= number_format($saldo,0,',','.') ?></h1>
                            <p class="mb-2">Saldo tersedia di kas RT</p>
                        </div>
                        <i class="fas fa-wallet bg-icon"></i>
                        <div class="mt-2">
                            <p style="margin:0;opacity:0.85;font-size:0.8rem;"><i class="far fa-calendar-alt mr-1"></i>Per <?= date('d M Y') ?></p>
                        </div>
                    </div>
                </div>
                        <div class="col-12 col-lg-5 mb-3">
                    <div class="au-card" style="height:100%;">
                        <div class="au-card-inner">
                            <h3 class="dashboard-section-title">Grafik Kas Bulanan</h3>
                            <div style="position:relative; height:200px; max-height:200px; overflow:hidden;">
                                <canvas id="kasChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-3">
                    <div class="au-card" style="height:100%;">
                        <div class="au-card-inner">
                            <h3 class="dashboard-section-title">Pengeluaran Kategori</h3>
                            <div style="position:relative; height:180px; max-height:180px; overflow:hidden;">
                                <canvas id="kategoriChart"></canvas>
                                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
                                    <p style="font-size:9px;color:#888;margin:0;">Total</p>
                                    <h5 style="font-size:11px;font-weight:700;color:#333;margin:0;">Rp <?= number_format($sum_keluar,0,',','.') ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="row">
                <div class="col-12 col-lg-5 mb-3">
                    <div class="au-card" style="height:100%;">
                        <div class="au-card-inner">
                            <h3 class="dashboard-section-title">
                                Transaksi Terbaru
                                <a href="<?= base_url('kasRT') ?>">Lihat semua</a>
                            </h3>
                            <?php if (isset($recent_kas) && !empty($recent_kas)): ?>
                                <?php foreach ($recent_kas as $tx): ?>
                                <div class="list-item">
                                    <div class="list-item-icon <?= $tx->jenis=='masuk' ? 'icon-green' : 'icon-red' ?>">
                                        <i class="fas <?= $tx->jenis=='masuk' ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
                                    </div>
                                    <div class="list-item-content">
                                        <h5><?= htmlspecialchars($tx->keterangan) ?></h5>
                                        <p><?= ucfirst($tx->jenis) ?></p>
                                    </div>
                                    <div class="list-item-right">
                                        <span><?= date('d M Y', strtotime($tx->tanggal)) ?></span>
                                        <strong class="<?= $tx->jenis=='masuk' ? 'text-green' : 'text-red' ?>">
                                            <?= $tx->jenis=='masuk' ? '' : '-' ?>Rp <?= number_format($tx->jumlah,0,',','.') ?>
                                        </strong>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-item">
                                    <div class="list-item-icon icon-green"><i class="fas fa-arrow-down"></i></div>
                                    <div class="list-item-content"><h5>Iuran Bulan Mei 2024</h5><p>Pemasukan</p></div>
                                    <div class="list-item-right"><span>7 Mei 2024</span><strong class="text-green">Rp 3.200.000</strong></div>
                                </div>
                                <div class="list-item">
                                    <div class="list-item-icon icon-red"><i class="fas fa-arrow-up"></i></div>
                                    <div class="list-item-content"><h5>Pembelian Alat Kebersihan</h5><p>Pengeluaran</p></div>
                                    <div class="list-item-right"><span>6 Mei 2024</span><strong class="text-red">-Rp 450.000</strong></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-3">
                    <div class="au-card" style="height:100%;">
                        <div class="au-card-inner">
                            <h3 class="dashboard-section-title">Pengumuman <a href="#">Lihat semua</a></h3>
                            <div class="list-item">
                                <div class="list-item-icon icon-blue"><i class="fas fa-bullhorn"></i></div>
                                <div class="list-item-content">
                                    <h5>Kerja Bakti Lingkungan</h5>
                                    <span style="font-size:10px;color:#aaa;display:block;margin-bottom:3px;">5 Mei 2024</span>
                                    <p>Kerja bakti hari Minggu, 12 Mei 2024.</p>
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="list-item-icon icon-blue"><i class="fas fa-bullhorn"></i></div>
                                <div class="list-item-content">
                                    <h5>Pembayaran Iuran Mei 2024</h5>
                                    <span style="font-size:10px;color:#aaa;display:block;margin-bottom:3px;">1 Mei 2024</span>
                                    <p>Iuran RT bulan Mei 2024 sudah dibuka.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-3">
                    <div class="au-card" style="height:100%;">
                        <div class="au-card-inner">
                            <h3 class="dashboard-section-title">Aksi Cepat</h3>
                            <div class="quick-actions">
                                <a href="<?= base_url('kasRT') ?>" class="btn-quick btn-q-green"><i class="fas fa-arrow-down"></i>Tambah Pemasukan</a>
                                <a href="<?= base_url('kasRT/kasKeluar') ?>" class="btn-quick btn-q-red"><i class="fas fa-arrow-up"></i>Tambah Pengeluaran</a>
                                <a href="<?= base_url('warga') ?>" class="btn-quick btn-q-blue"><i class="fas fa-users"></i>Data Warga</a>
                                <a href="<?= base_url('kasRT/laporan') ?>" class="btn-quick btn-q-yellow"><i class="fas fa-file-alt"></i>Laporan Keuangan</a>
                                <a href="<?= base_url('smartrt/backup') ?>" class="btn-quick btn-q-purple"><i class="fas fa-cloud-download-alt"></i>Backup Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

<script>
new Chart(document.getElementById('kasChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [
            { label: 'Pemasukan', data: <?= json_encode($data_masuk_chart) ?>, backgroundColor: 'rgba(33,150,243,0.7)', borderRadius: 6 },
            { label: 'Pengeluaran', data: <?= json_encode($data_keluar_chart) ?>, backgroundColor: 'rgba(244,67,54,0.6)', borderRadius: 6 }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, boxWidth: 12 } } },
        scales: { y: { beginAtZero: true, ticks: { callback: function(v){ return 'Rp '+Number(v/1000000).toFixed(1)+'jt'; }, font: { size: 10 } } } }
    }
});
new Chart(document.getElementById('kategoriChart'), {
    type: 'doughnut',
    data: {
        labels: ['Kegiatan Rutin','Kebersihan','Perawatan','Keamanan','Lainnya'],
        datasets: [{ data: [37,22,19,11,11], backgroundColor: ['#2196F3','#4CAF50','#FFC107','#FF5722','#9E9E9E'], borderWidth: 0 }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});
</script>