<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KAS-RT | @yield('title', 'Sistem Informasi RT')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/favicon.png') }}">

    <!-- Fontfaces & Icons CSS -->
    <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Main Theme & Mobile CSS -->
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/css/mobile-fix.css') }}" rel="stylesheet" media="all">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
        }
        .page-wrapper {
            background: #f8fafc;
        }
        .header-desktop {
            position: fixed;
            top: 0;
            right: 0;
            left: 280px;
            height: 75px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            z-index: 99;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
        }
        @media (max-width: 991px) {
            .header-desktop {
                left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="page-wrapper">
        <!-- Overlay gelap untuk mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

        <!-- ASIDE SIDEBAR -->
        <aside class="menu-sidebar" id="mainSidebar">
            <div class="logo">
                <img src="{{ asset('assets/icon-home.png') }}" width="36" alt="E-KasRT" style="filter: brightness(0) invert(1); flex-shrink:0;" />
                <div class="logo-text">
                    KAS RT
                    <span>Keuangan & Smart RT</span>
                </div>
                <button class="sidebar-close-btn" onclick="closeSidebar()" aria-label="Tutup menu">&times;</button>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>

                        <div class="menu-category">TRANSAKSI</div>
                        <li class="{{ request()->routeIs('kas.masuk') ? 'active' : '' }}">
                            <a href="{{ route('kas.masuk') }}">
                                <i class="fas fa-arrow-down text-success"></i> Pemasukan
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('kas.keluar') ? 'active' : '' }}">
                            <a href="{{ route('kas.keluar') }}">
                                <i class="fas fa-arrow-up text-danger"></i> Pengeluaran
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.transfer*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.transfer') }}">
                                <i class="fas fa-exchange-alt text-primary"></i> Transfer Kas
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('kas.laporan') ? 'active' : '' }}">
                            <a href="{{ route('kas.laporan') }}">
                                <i class="fas fa-file-invoice-dollar text-warning"></i> Laporan Kas
                            </a>
                        </li>

                        <div class="menu-category">MASTER DATA</div>
                        <li class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">
                            <a href="{{ route('warga.index') }}">
                                <i class="fas fa-users"></i> Data Warga
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.iuran*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.iuran') }}">
                                <i class="fas fa-money-check-alt text-success"></i> Iuran Warga
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.pengurus*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.pengurus') }}">
                                <i class="fas fa-user-tie text-info"></i> Pengurus RT
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.datart*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.datart') }}">
                                <i class="fas fa-building text-secondary"></i> Profil & Data RT
                            </a>
                        </li>

                        <div class="menu-category">LAYANAN SMART RT</div>
                        <li class="{{ request()->routeIs('posyandu.*') ? 'active' : '' }}">
                            <a href="{{ route('posyandu.index') }}">
                                <i class="fas fa-heartbeat text-danger"></i> Posyandu Balita IoT
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.banksampah*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.banksampah') }}">
                                <i class="fas fa-recycle text-teal" style="color: #0d9488;"></i> Bank Sampah
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.surat*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.surat') }}">
                                <i class="fas fa-envelope-open-text text-primary"></i> Surat Pengantar
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.aspirasi*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.aspirasi') }}">
                                <i class="fas fa-comments text-purple" style="color: #8b5cf6;"></i> Aspirasi Warga
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.aset*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.aset') }}">
                                <i class="fas fa-boxes text-warning"></i> Aset & Inventaris
                            </a>
                        </li>

                        <div class="menu-category">PENGATURAN</div>
                        <li class="{{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user') }}">
                                <i class="fas fa-user-shield"></i> Pengguna & Hak Akses
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.backup*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.backup') }}">
                                <i class="fas fa-database text-info"></i> Backup Database
                            </a>
                        </li>
                        <li style="margin-top: 20px;">
                            <a href="{{ route('logout') }}" style="color: #ef4444 !important;">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- PAGE CONTAINER -->
        <div class="page-container">
            <!-- TOP NAVBAR -->
            <header class="header-desktop px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light d-lg-none mr-3" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="font-weight-bold text-dark d-none d-sm-inline" style="font-size: 15px;">
                        Sistem Informasi E-KASRT <span class="badge badge-primary ml-1">Laravel 11</span>
                    </span>
                </div>

                <div class="account-wrap d-flex align-items-center" style="gap: 15px;">
                    <div class="text-right d-none d-sm-block">
                        <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                            {{ Auth::user()->user ?? 'Administrator' }}
                        </div>
                        <small class="text-muted text-uppercase" style="font-size: 11px;">
                            {{ Auth::user()->role->role ?? 'Admin' }}
                        </small>
                    </div>
                    <img src="{{ asset('assets/avatar.png') }}" class="rounded-circle border" width="40" height="40" alt="Avatar">
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm font-weight-bold ml-2" title="Keluar">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <div class="main-content" style="padding-top: 85px;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!-- Flash Message Alerts -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                {!! session('success') !!}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                {!! session('error') !!}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show text-dark" role="alert" style="border-radius: 12px;">
                                {!! session('warning') !!}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>

    <script>
        function toggleSidebar() {
            var sb = document.getElementById('mainSidebar');
            var ov = document.getElementById('sidebarOverlay');
            if (sb) sb.classList.toggle('show');
            if (ov) ov.classList.toggle('show');
        }
        function closeSidebar() {
            var sb = document.getElementById('mainSidebar');
            var ov = document.getElementById('sidebarOverlay');
            if (sb) sb.classList.remove('show');
            if (ov) ov.classList.remove('show');
        }
    </script>
    @stack('scripts')
</body>

</html>

