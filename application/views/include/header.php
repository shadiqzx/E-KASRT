<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Title Page-->
    <title>KAS-RT | <?= $judul;?></title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url();?>assets/favicon.png">
    <!-- Fontfaces CSS-->
    <link href="<?= base_url();?>assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="<?= base_url();?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="<?= base_url();?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url();?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="<?= base_url();?>assets/css/theme.css" rel="stylesheet" media="all">
    <!-- Mobile Responsive Overrides (load setelah theme.css) -->
    <link href="<?= base_url();?>assets/css/mobile-fix.css" rel="stylesheet" media="all">

    <style>
        /* Animasi halus saat halaman dimuat */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-content--bgf7, .table-responsive {
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <!-- Overlay gelap untuk menutup sidebar di mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

        <aside class="menu-sidebar" id="mainSidebar">
            <div class="logo">
                <img src="<?= base_url();?>assets/icon-home.png" width="36" alt="E-KasRT" style="filter: brightness(0) invert(1); flex-shrink:0;" />
                <div class="logo-text">
                    KAS RT
                    <span>Keuangan RT</span>
                </div>
                <!-- Tombol tutup sidebar, hanya tampil di mobile -->
                <button class="sidebar-close-btn" onclick="closeSidebar()" aria-label="Tutup menu">&times;</button>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="<?= ($judul == 'Admin Panel') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin');?>">
                                <i class="fas fa-home"></i>Dashboard</a>
                        </li>
                        
                        <div class="menu-category">TRANSAKSI</div>
                        <li class="<?= ($judul == 'Kas Masuk' || isset($menu) && $menu == 'masuk') ? 'active' : ''; ?>">
                            <a href="<?= base_url('kasRT');?>">
                                <i class="fas fa-arrow-down text-success"></i>Pemasukan</a>
                        </li>
                        <li class="<?= ($judul == 'Kas Keluar' || isset($menu) && $menu == 'keluar') ? 'active' : ''; ?>">
                            <a href="<?= base_url('kasRT/kasKeluar');?>">
                                <i class="fas fa-arrow-up text-danger"></i>Pengeluaran</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-exchange-alt"></i>Transfer</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-list"></i>Kategori</a>
                        </li>

                        <div class="menu-category">MASTER DATA</div>
                        <li class="<?= ($judul == 'Data Warga' || isset($menu) && $menu == 'warga') ? 'active' : ''; ?>">
                            <a href="<?= base_url('warga');?>">
                                <i class="fas fa-users"></i>Warga</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'iuran') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/iuran'); ?>">
                                <i class="fas fa-credit-card"></i>Iuran Warga</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-user-tie"></i>Pengurus RT</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-home"></i>Data RT</a>
                        </li>

                        <div class="menu-category">LAYANAN WARGA</div>
                        <li class="<?= (isset($menu) && $menu == 'sampah') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/sampah'); ?>">
                                <i class="fas fa-trash-alt"></i>Uang Sampah</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'surat') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/surat'); ?>">
                                <i class="fas fa-envelope-open-text"></i>Surat Menyurat</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'aspirasi') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/aspirasi'); ?>">
                                <i class="fas fa-bullhorn"></i>Aspirasi</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'posyandu') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/posyandu'); ?>">
                                <i class="fas fa-baby"></i>Posyandu</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'rukem') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/rukem'); ?>">
                                <i class="fas fa-pray"></i>Rukem (Kematian)</a>
                        </li>

                        <div class="menu-category">EKONOMI</div>
                        <li class="<?= (isset($menu) && $menu == 'koperasi') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/koperasi'); ?>">
                                <i class="fas fa-piggy-bank"></i>Koperasi</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'banksampah') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/banksampah'); ?>">
                                <i class="fas fa-recycle"></i>Bank Sampah</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'umkm') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/umkm'); ?>">
                                <i class="fas fa-store"></i>UMKM</a>
                        </li>

                        <div class="menu-category">KEGIATAN & KEAMANAN</div>
                        <li class="<?= (isset($menu) && $menu == 'kegiatan') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/kegiatan'); ?>">
                                <i class="fas fa-calendar-check"></i>Agenda Kegiatan</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'ronda') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/ronda'); ?>">
                                <i class="fas fa-shield-alt"></i>Jadwal Ronda</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'aset') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/aset'); ?>">
                                <i class="fas fa-boxes"></i>Aset RT</a>
                        </li>

                        <div class="menu-category">LAPORAN</div>
                        <li class="<?= ($judul == 'Laporan' || isset($menu) && $menu == 'laporan') ? 'active' : ''; ?>">
                            <a href="<?= base_url('kasRT/laporan');?>">
                                <i class="fas fa-chart-bar"></i>Laporan Keuangan</a>
                        </li>

                        <div class="menu-category">PENGATURAN</div>
                        <li class="<?= ($judul == 'Hak Akses' || isset($menu) && $menu == 'akses') ? 'active' : ''; ?>">
                            <a href="<?= base_url('admin/user');?>">
                                <i class="fas fa-user-shield"></i>Pengguna</a>
                        </li>
                        <li class="<?= (isset($menu) && $menu == 'backup') ? 'active' : ''; ?>">
                            <a href="<?= base_url('smartrt/backup'); ?>">
                                <i class="fas fa-cloud-download-alt"></i>Backup Data</a>
                        </li>
                        
                        <li style="margin-top: 30px;">
                            <a href="<?= base_url('auth/logout');?>" style="color: #F44336;">
                                <i class="fas fa-sign-out-alt"></i>Keluar</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30" style="padding:0;">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-wrap-left">
                                <!-- Hamburger button (mobile only) -->
                                <button class="btn-hamburger" id="btnHamburger" onclick="openSidebar()" aria-label="Buka menu">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <!-- Desktop menu toggle (hidden on mobile) -->
                                <form class="form-header" action="" method="POST">
                                    <button class="au-btn--submit" type="submit" style="background: transparent; color: #333; font-size: 20px;">
                                        <i class="zmdi zmdi-menu"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications" style="font-size: 24px; color: #333;"></i>
                                        <span class="quantity">3</span>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image" style="width: 40px; height: 40px;">
                                            <img src="<?= base_url('assets/profil/'. $user['img']);?>" alt="User" />
                                        </div>
                                        <div class="content" style="padding-left: 10px;">
                                            <a class="js-acc-btn" href="#" style="color: #333; font-weight: bold;"><?= $user['username'];?></a>
                                            <?php 
                                            $role_data = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
                                            $role_name = $role_data ? $role_data['role'] : 'Ketua RT';
                                            ?>
                                            <span style="display: block; font-size: 12px; color: #888; margin-top: -5px;"><?= $role_name; ?></span>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#!" onclick="changePassword('<?= base_url('admin/changePassword/'. $user['user_id']);?>')">
                                                        <i class="zmdi zmdi-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="<?= base_url('auth/logout');?>">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->
