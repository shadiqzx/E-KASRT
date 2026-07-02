<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <style>
        /* Animasi halus saat halaman dimuat */
        @-webkit-keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Target utama konten halaman */
        .page-content--bgf7, .container, .table-responsive, .main-content {
            -webkit-animation: fadeIn 0.4s ease-in-out;
            animation: fadeIn 0.4s ease-in-out;
        }

        /* Custom Sidebar & Dashboard Styling based on Image */
        body {
            background-color: #F8F9FA !important;
        }
        .page-wrapper {
            background: #F8F9FA;
        }
        .menu-sidebar {
            background-color: #03A9F4; /* Light Blue */
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .logo {
            background-color: #03A9F4;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 20px;
            display: flex;
            align-items: center;
        }
        .logo-text {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            margin-left: 10px;
            line-height: 1.2;
        }
        .logo-text span {
            display: block;
            font-size: 12px;
            font-weight: normal;
            color: #B3E5FC;
        }
        .menu-sidebar .navbar__list li {
            border: none !important;
            margin: 0;
            padding: 0;
        }
        .menu-sidebar .navbar__list li::before,
        .menu-sidebar .navbar__list li::after {
            display: none !important;
        }
        .menu-sidebar .navbar__list li a {
            color: #E1F5FE;
            padding: 12px 20px;
            display: block;
            border-radius: 8px;
            margin: 5px 15px;
            font-size: 15px;
            transition: all 0.3s;
            border: none !important;
            box-shadow: none !important;
            text-decoration: none !important;
        }
        .menu-sidebar .navbar__list li a::before,
        .menu-sidebar .navbar__list li a::after {
            display: none !important;
        }
        .menu-sidebar .navbar__list li a i {
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }
        .menu-sidebar .navbar__list li a:hover,
        .menu-sidebar .navbar__list li.active > a {
            background-color: #0288D1; /* Highlight active in darker blue */
            color: #fff;
        }
        .menu-category {
            color: #E1F5FE;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 20px 5px 20px;
            font-weight: 600;
        }

        .page-container {
            padding-left: 260px;
            background: transparent;
        }
        .header-desktop {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            left: 260px;
            height: 70px;
            border: none !important;
        }
        .header-wrap {
            border: none !important;
        }
        .form-header {
            border: none !important;
            box-shadow: none !important;
        }
        .form-header button {
            border: none !important;
            outline: none !important;
        }
        .header-button {
            justify-content: flex-end;
        }
        
        .top-cards-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .top-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
        }
        .top-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }
        .icon-green { background: #E8F5E9; color: #4CAF50; }
        .icon-red { background: #FFEBEE; color: #F44336; }
        .icon-blue { background: #E1F5FE; color: #03A9F4; }
        .icon-yellow { background: #FFF8E1; color: #FFC107; }

        .top-card-info h4 {
            font-size: 13px;
            color: #6C757D;
            margin-bottom: 5px;
            font-weight: normal;
        }
        .top-card-info h2 {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 2px;
        }
        .top-card-info p {
            font-size: 11px;
            color: #999;
            margin: 0;
        }
        .top-card-info .trend-up { color: #4CAF50; font-weight: 600; }
        .top-card-info .trend-down { color: #F44336; font-weight: 600; }

        .saldo-card {
            background: linear-gradient(135deg, #29B6F6 0%, #0288D1 100%);
            border-radius: 16px;
            padding: 30px;
            color: #fff;
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(3, 169, 244, 0.2);
        }
        .saldo-card h4 { color: rgba(255,255,255,0.8); font-weight: normal; font-size: 15px; margin-bottom: 10px; }
        .saldo-card h1 { color: #fff; font-size: 32px; font-weight: bold; margin-bottom: 10px; }
        .saldo-card p { color: rgba(255,255,255,0.6); font-size: 13px; }
        .saldo-card i.bg-icon {
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 120px;
            color: rgba(255,255,255,0.05);
            transform: rotate(-15deg);
        }

        .dashboard-section-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .dashboard-section-title a {
            font-size: 13px;
            color: #2196F3;
            font-weight: normal;
        }

        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn-quick {
            border-radius: 10px;
            padding: 12px 18px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
            text-decoration: none !important;
        }
        .btn-quick i { font-size: 18px; width: 24px; text-align: center; }
        .btn-quick:hover { transform: translateX(3px); }
        .btn-q-green { background: #E8F5E9; color: #4CAF50; }
        .btn-q-red { background: #FFEBEE; color: #F44336; }
        .btn-q-blue { background: #E3F2FD; color: #2196F3; }
        .btn-q-yellow { background: #FFF8E1; color: #FF9800; }
        .btn-q-purple { background: #F3E5F5; color: #9C27B0; }

        .list-item {
            display: flex;
            align-items: flex-start;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .list-item:last-child { border-bottom: none; }
        .list-item-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }
        .list-item-content { flex: 1; }
        .list-item-content h5 { font-size: 14px; font-weight: 600; color: #333; margin-bottom: 3px; }
        .list-item-content p { font-size: 12px; color: #888; margin: 0; }
        .list-item-right { text-align: right; }
        .list-item-right span { font-size: 12px; color: #888; display: block; margin-bottom: 5px; }
        .list-item-right strong { font-size: 14px; }
        .text-green { color: #4CAF50; }
        .text-red { color: #F44336; }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <img src="<?= base_url();?>assets/icon-home.png" width="40" alt="E-KasRT" style="filter: brightness(0) invert(1);" />
                <div class="logo-text">
                    KAS RT
                    <span>Keuangan RT</span>
                </div>
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
                        <li>
                            <a href="#">
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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <button class="au-btn--submit" type="submit" style="background: transparent; color: #333; font-size: 20px;">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </form>
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
