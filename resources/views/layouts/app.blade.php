<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KAS-RT | @yield('title', 'Sistem Informasi RT')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/favicon.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Fontfaces & Icons CSS -->
    <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Main Theme & Mobile CSS with Cache Busting -->
    <link href="{{ asset('assets/css/theme.css') }}?v=2.3" rel="stylesheet" media="all">
    <link href="{{ asset('assets/css/mobile-fix.css') }}?v=2.3" rel="stylesheet" media="all">

    <style>
        :root {
            --app-font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --mono-font: 'JetBrains Mono', monospace;
            --sidebar-bg: #0b1329;
            --sidebar-text: #94a3b8;
            --primary-accent: #0284c7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--app-font) !important;
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.07) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.06) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(244, 63, 94, 0.04) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a;
            -webkit-font-smoothing: antialiased;
            letter-spacing: -0.01em;
            margin: 0;
            padding: 0;
        }

        .font-mono {
            font-family: var(--mono-font) !important;
        }

        .page-wrapper {
            background: transparent;
            min-height: 100vh;
        }

        /* Modern Executive Dark Slate Sidebar */
        .menu-sidebar {
            background: linear-gradient(180deg, #090e1d 0%, #0b1329 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.12);
            width: 270px;
        }
        .menu-sidebar .logo {
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .logo-text {
            font-weight: 800;
            color: #ffffff;
            font-size: 17px;
            letter-spacing: -0.5px;
            line-height: 1.2;
            font-family: var(--app-font);
        }
        .logo-text span {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .menu-category {
            padding: 16px 24px 6px;
            font-size: 10.5px;
            font-weight: 800;
            color: #64748b;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: var(--app-font);
        }
        .navbar-sidebar .navbar__list li a {
            padding: 11px 18px;
            font-size: 13.5px;
            font-weight: 600;
            color: #94a3b8;
            border-radius: 12px;
            margin: 3px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            font-family: var(--app-font);
        }
        .navbar-sidebar .navbar__list li a i {
            font-size: 15px;
            width: 20px;
            text-align: center;
        }
        .navbar-sidebar .navbar__list li a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
            transform: translateX(3px);
        }
        .navbar-sidebar .navbar__list li.active a,
        .menu-sidebar .navbar__list li.active > a {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.35);
            font-weight: 700;
        }
        .navbar-sidebar .navbar__list li.active a i,
        .menu-sidebar .navbar__list li.active a i {
            color: #ffffff !important;
        }

        /* Modern Frosted Glass Top Navbar */
        .header-desktop {
            position: fixed;
            top: 0;
            right: 0;
            left: 270px;
            height: 72px;
            background: rgba(255, 255, 255, 0.82) !important;
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
            z-index: 99;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
            display: flex;
            align-items: center;
        }

        .page-container {
            padding-left: 270px;
            min-height: 100vh;
        }

        /* Glassmorphic Components Helpers */
        .glass-card {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 0 0 1px rgba(226, 232, 240, 0.6);
            border-radius: 20px;
        }

        .pulse-live-green {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulseLiveGreen 2s infinite;
        }
        @keyframes pulseLiveGreen {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Universal Modal & Backdrop Stacking Fix */
        .section__content {
            position: static !important;
            z-index: auto !important;
        }
        .main-content {
            position: static !important;
            z-index: auto !important;
        }
        .page-wrapper {
            overflow: visible !important;
        }
        .modal-backdrop {
            z-index: 1060 !important;
            opacity: 0.65 !important;
            background-color: #0b1329 !important;
        }
        .modal {
            z-index: 1070 !important;
        }
        .modal-dialog {
            z-index: 1075 !important;
            position: relative !important;
        }
        .modal-content {
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4) !important;
        }

        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(11, 19, 41, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1025;
        }
        .sidebar-overlay.show,
        .sidebar-overlay.sidebar-open {
            display: block !important;
        }
        @media (min-width: 992px) {
            .sidebar-overlay {
                display: none !important;
            }
        }

        @media (max-width: 991px) {
            .header-desktop {
                left: 0;
            }
            .page-container {
                padding-left: 0;
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
                <div style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.4); flex-shrink: 0;">
                    <i class="fas fa-home text-white font-size-18"></i>
                </div>
                <div class="logo-text">
                    KAS RT
                    <span>Keuangan & Smart RT</span>
                </div>
                <button class="sidebar-close-btn d-lg-none ml-auto btn btn-sm btn-link text-white" onclick="closeSidebar()" aria-label="Tutup menu">&times;</button>
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
                                <i class="fas fa-recycle" style="color: #0d9488;"></i> Bank Sampah
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.surat*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.surat') }}">
                                <i class="fas fa-envelope-open-text text-primary"></i> Surat Pengantar
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.aspirasi*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.aspirasi') }}">
                                <i class="fas fa-comments" style="color: #8b5cf6;"></i> Aspirasi Warga
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
                    <button class="btn btn-light d-lg-none mr-3 shadow-sm border" onclick="toggleSidebar()" style="border-radius: 8px;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-flex align-items-center" style="gap: 10px;">
                        <div class="pulse-live-green d-none d-sm-block"></div>
                        <span class="font-weight-bold text-dark d-none d-sm-inline" style="font-size: 15px; letter-spacing: -0.3px;">
                            Sistem Informasi E-KASRT
                        </span>
                        <span class="badge badge-primary px-2 py-1 font-weight-bold d-none d-md-inline" style="border-radius: 6px; font-size: 11px; background: #0284c7;">
                            Laravel 11 &bull; Live
                        </span>
                    </div>
                </div>

                <div class="account-wrap d-flex align-items-center" style="gap: 14px;">
                    <div class="text-right d-none d-sm-block">
                        <div class="font-weight-bold text-dark" style="font-size: 13.5px; line-height: 1.2;">
                            {{ Auth::user()->user ?? 'Administrator' }}
                        </div>
                        <small class="text-muted text-uppercase" style="font-size: 10.5px; font-weight: 700; letter-spacing: 0.5px;">
                            {{ Auth::user()->role->role ?? 'SUPERADMIN' }}
                        </small>
                    </div>
                    <div style="position: relative;">
                        <img src="{{ asset('assets/avatar.png') }}" class="rounded-circle border" width="40" height="40" alt="Avatar" style="box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                        <span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #10b981; border: 2px solid #fff; border-radius: 50%;"></span>
                    </div>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm font-weight-bold ml-1" title="Keluar dari Sistem" style="border-radius: 8px;">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <div class="main-content" style="padding-top: 92px;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!-- Flash Message Alerts -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 14px; border: 1px solid #a7f3d0; background: #ecfdf5; color: #065f46;">
                                <i class="fas fa-check-circle mr-2"></i> {!! session('success') !!}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 14px; border: 1px solid #fecdd3; background: #fff1f2; color: #9f1239;">
                                <i class="fas fa-exclamation-circle mr-2"></i> {!! session('error') !!}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show shadow-sm text-dark" role="alert" style="border-radius: 14px; border: 1px solid #fde68a; background: #fffbeb; color: #92400e;">
                                <i class="fas fa-info-circle mr-2"></i> {!! session('warning') !!}
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
        // Pindahkan modal ke <body> saat akan ditampilkan
        // agar tidak tertindih oleh backdrop (.modal-backdrop) akibat CSS stacking context
        $(document).on('show.bs.modal', '.modal', function () {
            $(this).appendTo('body');
        });

        function toggleSidebar() {
            var sb = document.getElementById('mainSidebar');
            var ov = document.getElementById('sidebarOverlay');
            if (sb) sb.classList.toggle('sidebar-open');
            if (ov) ov.classList.toggle('show');
        }
        function closeSidebar() {
            var sb = document.getElementById('mainSidebar');
            var ov = document.getElementById('sidebarOverlay');
            if (sb) sb.classList.remove('sidebar-open');
            if (ov) ov.classList.remove('show');
        }
    </script>
    @stack('scripts')
</body>

</html>
