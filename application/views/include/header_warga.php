<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Title Page-->
    <title>SIK RT 002 - <?= $judul; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/favicon.png">
    <!-- Fontfaces CSS-->
    <link href="<?= base_url(); ?>assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="<?= base_url(); ?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="<?= base_url(); ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <!-- Custom Style for Dashboard elements -->
    <style>
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
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="<?= base_url('admin'); ?>">
                            <img src="<?= base_url(); ?>assets/icon-home.png" width="50%" alt="E-KasRT" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="<?= base_url('admin'); ?>">
                                    <i class="fas fa-home"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('warga'); ?>">
                                    <i class="fas fa-check-square"></i>
                                    <span class="bot-line"></span>Warga</a>
                            </li>
                            <li>
                                <a href="<?= base_url('kasRT/laporan'); ?>">
                                    <i class="fas fa-bar-chart-o"></i>
                                    <span class="bot-line"></span>Laporan</a>
                            </li>
                            <li>
                                <a href="<?= base_url('smartrt/sampah'); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="bot-line"></span>Uang Sampah</a>
                            </li>
                            <li>
                                <a href="<?= base_url('smartrt/surat'); ?>">
                                    <i class="fas fa-file-alt"></i>
                                    <span class="bot-line"></span>Surat</a>
                            </li>
                            <li>
                                <a href="<?= base_url('smartrt/kegiatan'); ?>">
                                    <i class="fas fa-calendar-check"></i>
                                    <span class="bot-line"></span>Kegiatan</a>
                            </li>
                            <li>
                                <a href="<?= base_url('smartrt/aspirasi'); ?>">
                                    <i class="fas fa-bullhorn"></i>
                                    <span class="bot-line"></span>Aspirasi</a>
                            </li>
                            <li>
                                <a href="<?= base_url('smartrt/umkm'); ?>">
                                    <i class="fas fa-store"></i>
                                    <span class="bot-line"></span>UMKM</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="<?= base_url('assets/profil/' . $user['img']); ?>" alt="John Doe" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#"><?= $user['username']; ?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#!" onclick="changePassword('<?= base_url('admin/changePassword/' . $user['user_id']); ?>')">
                                                <i class="zmdi zmdi-key"></i>Change Password</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="<?= base_url('auth/logout'); ?>">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->