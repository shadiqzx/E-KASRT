        <!-- MAIN CONTENT-->
        <div class="main-content" style="padding-top: 30px;">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    
                    <!-- WELCOME -->
                    <div class="row mb-4">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="title-4" style="font-size: 24px; font-weight: bold; color: #333;">
                                    Selamat datang, <?= $user['username'];?> <span style="font-size: 20px;">👋</span>
                                </h1>
                                <p style="color: #888; font-size: 14px; margin-top: 5px;">Kelola keuangan RT dengan mudah dan transparan</p>
                            </div>
                            <div>
                                <div style="background: #fff; padding: 10px 20px; border-radius: 8px; border: 1px solid #eee; color: #666; font-size: 13px;">
                                    <i class="far fa-calendar-alt" style="margin-right: 8px;"></i> <?= strftime('%A, %d %B %Y') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sum_masuk = 0;
                        foreach ($masuk as $total_masuk) {
                            $sum_masuk += $total_masuk->total;
                        }
                        $sum_keluar = 0;
                        foreach ($keluar as $total_keluar) {
                            $sum_keluar += $total_keluar->total;
                        }
                        $saldo = $sum_masuk - $sum_keluar;
                    ?>

                    <!-- TOP CARDS -->
                    <div class="top-cards-container">
                        <!-- Card 1: Total Pemasukan -->
                        <div class="top-card">
                            <div class="top-card-icon icon-green">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div class="top-card-info">
                                <h4>Total Pemasukan</h4>
                                <h2>Rp <?= rupiah($sum_masuk);?></h2>
                                <p><span class="trend-up">+12.5%</span> dari bulan lalu</p>
                            </div>
                        </div>

                        <!-- Card 2: Total Pengeluaran -->
                        <div class="top-card">
                            <div class="top-card-icon icon-red">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="top-card-info">
                                <h4>Total Pengeluaran</h4>
                                <h2>Rp <?= rupiah($sum_keluar);?></h2>
                                <p><span class="trend-down">+8.3%</span> dari bulan lalu</p>
                            </div>
                        </div>

                        <!-- Card 3: Saldo Kas -->
                        <div class="top-card">
                            <div class="top-card-icon icon-blue">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="top-card-info">
                                <h4>Saldo Kas</h4>
                                <h2>Rp <?= rupiah($saldo);?></h2>
                                <p>Per <?= date('d M Y') ?></p>
                            </div>
                        </div>

                        <!-- Card 4: Total Warga -->
                        <div class="top-card">
                            <div class="top-card-icon icon-yellow">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="top-card-info">
                                <h4>Total Warga</h4>
                                <h2><?= isset($total_warga) ? $total_warga : 128; ?></h2>
                                <p>KK Terdaftar</p>
                            </div>
                        </div>
                    </div>

                    <!-- MIDDLE SECTION -->
                    <div class="row mb-4">
                        <!-- Saldo Saat Ini (Large) -->
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="saldo-card">
                                <h4>Saldo Kas Saat Ini</h4>
                                <h1>Rp <?= rupiah($saldo);?></h1>
                                <p>Saldo tersedia di kas RT</p>
                                <i class="fas fa-wallet bg-icon"></i>
                                <div style="position: absolute; bottom: 30px; left: 30px;">
                                    <p style="margin: 0;">Per <?= date('d M Y') ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Kas Bulanan -->
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="au-card" style="height: 100%; border-radius: 16px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <div class="au-card-inner">
                                    <h3 class="dashboard-section-title" style="margin-bottom: 20px;">Grafik Kas Bulanan</h3>
                                    <canvas id="kasChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Pengeluaran per Kategori (Doughnut) -->
                        <div class="col-lg-3">
                            <div class="au-card" style="height: 100%; border-radius: 16px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <div class="au-card-inner">
                                    <h3 class="dashboard-section-title" style="margin-bottom: 20px;">Pengeluaran per Kategori</h3>
                                    <div style="position: relative;">
                                        <canvas id="kategoriChart" height="220"></canvas>
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                            <p style="font-size: 10px; color: #888; margin: 0;">Total</p>
                                            <h5 style="font-size: 13px; font-weight: bold; color: #333; margin: 0;">Rp <?= rupiah($sum_keluar);?></h5>
                                        </div>
                                    </div>
                                    <div style="margin-top: 15px; font-size: 11px;">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span><i class="fas fa-circle" style="color: #2196F3; margin-right: 5px;"></i> Kegiatan Rutin</span>
                                            <span>37%</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span><i class="fas fa-circle" style="color: #4CAF50; margin-right: 5px;"></i> Kebersihan</span>
                                            <span>22%</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span><i class="fas fa-circle" style="color: #FFC107; margin-right: 5px;"></i> Perawatan</span>
                                            <span>19%</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span><i class="fas fa-circle" style="color: #FF5722; margin-right: 5px;"></i> Keamanan</span>
                                            <span>11%</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><i class="fas fa-circle" style="color: #9E9E9E; margin-right: 5px;"></i> Lainnya</span>
                                            <span>11%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTTOM SECTION -->
                    <div class="row">
                        <!-- Transaksi Terbaru -->
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="au-card" style="height: 100%; border-radius: 16px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <div class="au-card-inner">
                                    <h3 class="dashboard-section-title">
                                        Transaksi Terbaru
                                        <a href="<?= base_url('kasRT'); ?>">Lihat semua</a>
                                    </h3>
                                    
                                    <?php if(isset($recent_kas) && !empty($recent_kas)): ?>
                                        <?php foreach($recent_kas as $tx): ?>
                                            <div class="list-item">
                                                <div class="list-item-icon <?= $tx->jenis == 'masuk' ? 'icon-green' : 'icon-red' ?>" style="font-size: 14px;">
                                                    <i class="fas <?= $tx->jenis == 'masuk' ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
                                                </div>
                                                <div class="list-item-content">
                                                    <h5><?= $tx->keterangan; ?></h5>
                                                    <p><?= ucfirst($tx->jenis); ?></p>
                                                </div>
                                                <div class="list-item-right">
                                                    <span><?= date('d M Y', strtotime($tx->tanggal)); ?></span>
                                                    <strong class="<?= $tx->jenis == 'masuk' ? 'text-green' : 'text-red' ?>">
                                                        <?= $tx->jenis == 'masuk' ? '' : '-' ?>Rp <?= rupiah($tx->jumlah); ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- Mockup jika tidak ada transaksi -->
                                        <div class="list-item">
                                            <div class="list-item-icon icon-green" style="font-size: 14px;"><i class="fas fa-arrow-down"></i></div>
                                            <div class="list-item-content">
                                                <h5>Iuran Bulan Mei 2024</h5>
                                                <p>Pemasukan - Iuran Warga</p>
                                            </div>
                                            <div class="list-item-right">
                                                <span>7 Mei 2024</span>
                                                <strong class="text-green">Rp 3.200.000</strong>
                                            </div>
                                        </div>
                                        <div class="list-item">
                                            <div class="list-item-icon icon-red" style="font-size: 14px;"><i class="fas fa-arrow-up"></i></div>
                                            <div class="list-item-content">
                                                <h5>Pembelian Alat Kebersihan</h5>
                                                <p>Pengeluaran - Kebersihan</p>
                                            </div>
                                            <div class="list-item-right">
                                                <span>6 Mei 2024</span>
                                                <strong class="text-red">-Rp 450.000</strong>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Pengumuman -->
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="au-card" style="height: 100%; border-radius: 16px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <div class="au-card-inner">
                                    <h3 class="dashboard-section-title">
                                        Pengumuman
                                        <a href="#">Lihat semua</a>
                                    </h3>
                                    
                                    <!-- Pengumuman 1 -->
                                    <div class="list-item">
                                        <div class="list-item-icon icon-blue" style="font-size: 16px;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div class="list-item-content">
                                            <h5>Kerja Bakti Lingkungan</h5>
                                            <span style="font-size: 11px; color: #aaa; margin-bottom: 5px; display: block;">5 Mei 2024</span>
                                            <p>Akan dilaksanakan kerja bakti lingkungan pada hari Minggu, 12 Mei 2024. Mohon partisipasi seluruh warga.</p>
                                        </div>
                                    </div>

                                    <!-- Pengumuman 2 -->
                                    <div class="list-item">
                                        <div class="list-item-icon icon-blue" style="font-size: 16px;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div class="list-item-content">
                                            <h5>Pembayaran Iuran Mei 2024</h5>
                                            <span style="font-size: 11px; color: #aaa; margin-bottom: 5px; display: block;">1 Mei 2024</span>
                                            <p>Pembayaran iuran RT bulan Mei 2024 sudah dibuka. Terima kasih kepada warga yang sudah membayar.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Aksi Cepat -->
                        <div class="col-lg-3">
                            <div class="au-card" style="height: 100%; border-radius: 16px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                                <div class="au-card-inner">
                                    <h3 class="dashboard-section-title" style="margin-bottom: 20px;">Aksi Cepat</h3>
                                    
                                    <div class="quick-actions">
                                        <a href="<?= base_url('kasRT') ?>" class="btn-quick btn-q-green">
                                            <i class="fas fa-arrow-down"></i>
                                            Tambah Pemasukan
                                        </a>
                                        <a href="<?= base_url('kasRT/kasKeluar') ?>" class="btn-quick btn-q-red">
                                            <i class="fas fa-arrow-up"></i>
                                            Tambah Pengeluaran
                                        </a>
                                        <a href="<?= base_url('warga') ?>" class="btn-quick btn-q-blue">
                                            <i class="fas fa-users"></i>
                                            Data Warga
                                        </a>
                                        <a href="<?= base_url('kasRT/laporan') ?>" class="btn-quick btn-q-yellow">
                                            <i class="fas fa-file-alt"></i>
                                            Laporan Keuangan
                                        </a>
                                        <a href="#" class="btn-quick btn-q-purple">
                                            <i class="fas fa-cloud-download-alt"></i>
                                            Backup Data
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

        <!-- Script Chart -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Konfigurasi umum
                Chart.defaults.global.defaultFontFamily = "'Inter', 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif";
                Chart.defaults.global.defaultFontColor = '#888';

                // Line Chart (Grafik Kas Bulanan)
                const ctxLine = document.getElementById('kasChart').getContext('2d');
                new Chart(ctxLine, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                        datasets: [
                            {
                                label: 'Pemasukan',
                                data: [10, 13, 10, 11, 15, 12, 16],
                                borderColor: '#4CAF50',
                                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                                lineTension: 0.4,
                                fill: false,
                                borderWidth: 2,
                                pointBackgroundColor: '#4CAF50',
                                pointBorderWidth: 2,
                                pointRadius: 4
                            },
                            {
                                label: 'Pengeluaran',
                                data: [4, 6, 4, 6, 8, 5, 7],
                                borderColor: '#F44336',
                                backgroundColor: 'rgba(244, 67, 54, 0.1)',
                                lineTension: 0.4,
                                fill: false,
                                borderWidth: 2,
                                pointBackgroundColor: '#F44336',
                                pointBorderWidth: 2,
                                pointRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top',
                            align: 'center',
                            labels: { boxWidth: 12, usePointStyle: true }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 20,
                                    callback: function(value) { return value + ' jt'; }
                                },
                                gridLines: { color: '#f0f0f0', drawBorder: false }
                            }],
                            xAxes: [{
                                gridLines: { display: false, drawBorder: false }
                            }]
                        }
                    }
                });

                // Doughnut Chart (Pengeluaran per Kategori)
                const ctxDoughnut = document.getElementById('kategoriChart').getContext('2d');
                new Chart(ctxDoughnut, {
                    type: 'doughnut',
                    data: {
                        labels: ['Kegiatan Rutin', 'Kebersihan', 'Perawatan', 'Keamanan', 'Lainnya'],
                        datasets: [{
                            data: [37, 22, 19, 11, 11],
                            backgroundColor: [
                                '#2196F3', // Blue
                                '#4CAF50', // Green
                                '#FFC107', // Yellow
                                '#FF5722', // Orange
                                '#9E9E9E'  // Grey
                            ],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutoutPercentage: 75,
                        legend: { display: false },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                    var currentValue = dataset.data[tooltipItem.index];
                                    return ' ' + data.labels[tooltipItem.index] + ': ' + currentValue + '%';
                                }
                            }
                        }
                    }
                });
            });
        </script>