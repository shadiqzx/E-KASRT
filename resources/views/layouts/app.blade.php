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

    <!-- Fontfaces & Icons CSS (Local + FA 5.15.4 Complete Free Icon Pack) -->
    <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Main Theme & Mobile CSS with Cache Busting -->
    <link href="{{ asset('assets/css/theme.css') }}?v=2.4" rel="stylesheet" media="all">
    <link href="{{ asset('assets/css/mobile-fix.css') }}?v=2.4" rel="stylesheet" media="all">

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

        html, body {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--app-font) !important;
            background-color: #f4f7fb;
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.09) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.06) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(244, 63, 94, 0.04) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a;
            -webkit-font-smoothing: antialiased;
            letter-spacing: -0.01em;
            margin: 0;
            padding: 0;
            transition: background-color 0.28s ease, color 0.25s ease;
        }

        .font-mono {
            font-family: var(--mono-font) !important;
        }

        .page-wrapper {
            background: transparent;
            min-height: 100vh;
            overflow: visible !important;
        }

        /* Modern Executive Dark Slate Sidebar */
        .menu-sidebar {
            background: linear-gradient(180deg, #070d1d 0%, #0b1329 55%, #0f172a 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 4px 0 28px rgba(0, 0, 0, 0.16);
            width: 270px;
            scrollbar-width: thin;
            scrollbar-color: rgba(56, 189, 248, 0.35) transparent;
        }
        .menu-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .menu-sidebar::-webkit-scrollbar-thumb {
            background: rgba(56, 189, 248, 0.3);
            border-radius: 99px;
        }
        .menu-sidebar .logo {
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            padding: 18px 20px;
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
            font-size: 10.5px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.7px;
            text-transform: uppercase;
        }

        /* Sidebar Inline Quick Search */
        .sidebar-search-wrap {
            padding: 12px 16px 6px;
        }
        .sidebar-search-box {
            position: relative;
            display: flex;
            align-items: center;
        }
        .sidebar-search-box i {
            position: absolute;
            left: 12px;
            font-size: 12px;
            color: #64748b;
            pointer-events: none;
        }
        .sidebar-search-input {
            width: 100%;
            height: 36px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 10px;
            padding: 6px 12px 6px 32px;
            color: #f8fafc;
            font-size: 12.5px;
            font-weight: 600;
            outline: none;
            transition: all 0.2s;
        }
        .sidebar-search-input::placeholder {
            color: #64748b;
        }
        .sidebar-search-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(56, 189, 248, 0.55);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.14);
        }

        .menu-category {
            padding: 15px 22px 6px;
            font-size: 10px;
            font-weight: 800;
            color: #64748b;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: var(--app-font);
        }
        .navbar-sidebar .navbar__list {
            padding-bottom: 42px !important;
        }
        .navbar-sidebar .navbar__list li a {
            padding: 10.5px 16px !important;
            font-size: 13.5px;
            font-weight: 600;
            color: #94a3b8;
            border-radius: 12px;
            margin: 3px 14px !important;
            display: flex;
            align-items: center;
            gap: 11px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            font-family: var(--app-font);
        }
        .navbar-sidebar .navbar__list li a i {
            font-size: 14.5px;
            width: 20px;
            text-align: center;
        }
        .navbar-sidebar .navbar__list li a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(3px);
        }
        .navbar-sidebar .navbar__list li.active a,
        .menu-sidebar .navbar__list li.active > a {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.38);
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
            background: rgba(255, 255, 255, 0.86) !important;
            backdrop-filter: blur(18px) saturate(180%);
            -webkit-backdrop-filter: blur(18px) saturate(180%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
            z-index: 900 !important;
            box-shadow: 0 4px 22px -4px rgba(15, 23, 42, 0.05);
            display: flex;
            align-items: center;
            transition: background 0.25s ease, border-color 0.25s ease;
        }

        .page-container {
            padding-left: 270px;
            min-height: 100vh;
        }

        /* Command Palette Trigger in Header */
        .cmd-trigger-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-width: 250px;
            height: 38px;
            padding: 0 12px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            color: #64748b;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .cmd-trigger-btn:hover {
            background: #ffffff;
            border-color: #38bdf8;
            color: #0284c7;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.08);
        }
        .cmd-kbd {
            font-family: var(--mono-font);
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 6px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
        }

        .header-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }
        .header-icon-btn:hover {
            background: #ffffff;
            border-color: #38bdf8;
            color: #0284c7;
            transform: translateY(-1px);
        }
        .header-badge-dot {
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 18px;
            height: 18px;
            border-radius: 99px;
            background: #f59e0b;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid #ffffff;
        }

        .iot-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none !important;
            transition: all 0.2s;
        }
        .iot-status-pill.is-online {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .iot-status-pill.is-standby {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        /* Glassmorphic & Global UI Polish across Subpages */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 0 0 1px rgba(226, 232, 240, 0.6);
            border-radius: 20px;
        }
        .card {
            border-radius: 18px;
            transition: box-shadow 0.2s ease;
        }
        .form-control {
            border-radius: 10px;
            border-color: #dbe3ee;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.16);
        }
        .btn {
            transition: transform 0.18s ease, box-shadow 0.18s ease, background-color 0.18s ease;
        }
        .table-responsive::-webkit-scrollbar {
            height: 7px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 99px;
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

        /* Back-to-top floating button (bottom-left so zero collision with bottom-right CS AI) */
        #dashScrollTop {
            position: fixed;
            left: 292px;
            bottom: 22px;
            z-index: 980;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            color: #0284c7;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        #dashScrollTop.show {
            display: inline-flex;
        }
        #dashScrollTop:hover {
            transform: translateY(-2px);
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
        }

        /* Command Palette Overlay (Vanilla, non-Bootstrap so zero backdrop clash) */
        #kasCommandModal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 10050;
            background: rgba(7, 13, 27, 0.65);
            backdrop-filter: blur(8px);
            align-items: flex-start;
            justify-content: center;
            padding: 84px 16px 24px;
        }
        #kasCommandModal.open {
            display: flex;
        }
        .kas-cmd-panel {
            width: 100%;
            max-width: 560px;
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 28px 65px rgba(2, 6, 23, 0.35);
            overflow: hidden;
            animation: cmdPopIn 0.18s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes cmdPopIn {
            from { opacity: 0; transform: translateY(-10px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .kas-cmd-head {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-bottom: 1px solid #e2e8f0;
        }
        .kas-cmd-input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            background: transparent;
        }
        .kas-cmd-list {
            max-height: 360px;
            overflow-y: auto;
            padding: 8px;
        }
        .kas-cmd-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none !important;
            color: #1e293b;
            transition: background 0.14s ease;
            margin-bottom: 2px;
        }
        .kas-cmd-item:hover,
        .kas-cmd-item.selected {
            background: #eff6ff;
            color: #0369a1;
        }
        .kas-cmd-item-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .kas-cmd-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        .kas-cmd-item.selected .kas-cmd-icon,
        .kas-cmd-item:hover .kas-cmd-icon {
            background: #0284c7;
            color: #ffffff;
        }

        /* Executive Dark Theme Toggle Overrides */
        body.dark-exec {
            background-color: #070d1b !important;
            background-image:
                radial-gradient(at 0% 0%, rgba(14, 165, 233, 0.14) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.08) 0px, transparent 50%) !important;
            color: #e2e8f0 !important;
        }
        body.dark-exec .header-desktop {
            background: rgba(11, 19, 41, 0.88) !important;
            border-bottom-color: rgba(148, 163, 184, 0.16) !important;
        }
        body.dark-exec .header-desktop .text-dark {
            color: #f8fafc !important;
        }
        body.dark-exec .cmd-trigger-btn {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(148, 163, 184, 0.25);
            color: #cbd5e1;
        }
        body.dark-exec .cmd-kbd {
            background: #0f172a;
            border-color: #334155;
            color: #94a3b8;
        }
        body.dark-exec .header-icon-btn {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(148, 163, 184, 0.25);
            color: #cbd5e1;
        }
        body.dark-exec .glass-card,
        body.dark-exec .glass-kpi-card,
        body.dark-exec .glass-section-card,
        body.dark-exec .card,
        body.dark-exec .ai-bento-card {
            background: rgba(15, 23, 42, 0.86) !important;
            border-color: rgba(148, 163, 184, 0.18) !important;
            color: #e2e8f0 !important;
            box-shadow: 0 14px 36px rgba(2, 6, 23, 0.4) !important;
        }
        body.dark-exec .card-header,
        body.dark-exec .bg-white,
        body.dark-exec .bg-light,
        body.dark-exec .table-custom-dash thead th {
            background: rgba(15, 23, 42, 0.95) !important;
            color: #e2e8f0 !important;
            border-color: rgba(148, 163, 184, 0.18) !important;
        }
        body.dark-exec .table,
        body.dark-exec .table td,
        body.dark-exec .table th,
        body.dark-exec .text-dark {
            color: #f1f5f9 !important;
            border-color: rgba(148, 163, 184, 0.14) !important;
        }
        body.dark-exec .table-custom-dash tbody tr:hover td,
        body.dark-exec .table-hover tbody tr:hover {
            background: rgba(30, 41, 59, 0.65) !important;
        }
        body.dark-exec .form-control {
            background: #0b1329 !important;
            border-color: rgba(148, 163, 184, 0.25) !important;
            color: #f8fafc !important;
        }
        body.dark-exec .kas-cmd-panel {
            background: #0f172a;
            border-color: rgba(148, 163, 184, 0.25);
        }
        body.dark-exec .kas-cmd-head {
            border-bottom-color: rgba(148, 163, 184, 0.2);
        }
        body.dark-exec .kas-cmd-input {
            color: #f8fafc;
        }
        body.dark-exec .kas-cmd-item {
            color: #e2e8f0;
        }
        body.dark-exec .kas-cmd-icon {
            background: #1e293b;
        }
        body.dark-exec .kas-cmd-item:hover,
        body.dark-exec .kas-cmd-item.selected {
            background: rgba(14, 165, 233, 0.2);
            color: #38bdf8;
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
            #dashScrollTop {
                left: 16px;
                bottom: 16px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    @php
        $pendingVerifCount = 0;
        $navRfidOnline = false;
        try {
            $pendingVerifCount = \App\Models\User::where('status_verifikasi', 'Menunggu Verifikasi')->count();
            $navRfidOnline = (bool) \Illuminate\Support\Facades\Cache::get('rfid_device_online', false);
        } catch (\Throwable $e) {}
    @endphp

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
                    <span>Keuangan &amp; Smart RT</span>
                </div>
                <button class="sidebar-close-btn d-lg-none ml-auto btn btn-sm btn-link text-white" onclick="closeSidebar()" aria-label="Tutup menu">&times;</button>
            </div>

            <!-- Inline Quick Menu Filter -->
            <div class="sidebar-search-wrap">
                <div class="sidebar-search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="sidebarQuickSearch" class="sidebar-search-input" placeholder="Cari menu cepat..." autocomplete="off">
                </div>
            </div>

            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list" id="sidebarMenuList">
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
                        <li class="{{ request()->routeIs('admin.warga.verifikasi*') ? 'active' : '' }}">
                            <a href="{{ route('admin.warga.verifikasi') }}" class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-user-check" style="color: #06b6d4;"></i> Verifikasi Warga</span>
                                @if($pendingVerifCount > 0)
                                    <span class="badge badge-warning" style="border-radius: 12px; font-size: 10.5px; padding: 2px 7px; font-weight: 800; background: #f59e0b; color: #fff;">{{ $pendingVerifCount }}</span>
                                @endif
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
                                <i class="fas fa-building text-secondary"></i> Profil &amp; Data RT
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
                                <i class="fas fa-boxes text-warning"></i> Aset &amp; Inventaris
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.ai_cs*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.ai_cs') }}">
                                <i class="fas fa-robot text-info"></i> AI Customer Service
                            </a>
                        </li>

                        <div class="menu-category">PENGATURAN</div>
                        <li class="{{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user') }}">
                                <i class="fas fa-user-shield"></i> Pengguna &amp; Hak Akses
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('smartrt.backup*') ? 'active' : '' }}">
                            <a href="{{ route('smartrt.backup') }}">
                                <i class="fas fa-database text-info"></i> Database &amp; Migrasi
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
                <div class="d-flex align-items-center" style="gap: 10px;">
                    <button class="btn btn-light d-lg-none mr-1 shadow-sm border" onclick="toggleSidebar()" style="border-radius: 8px;" aria-label="Buka menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-flex align-items-center" style="gap: 10px;">
                        <div class="pulse-live-green d-none d-sm-block"></div>
                        <span class="font-weight-bold text-dark d-none d-sm-inline" style="font-size: 15px; letter-spacing: -0.3px;">
                            @yield('title', 'Sistem Informasi E-KASRT')
                        </span>
                        <a href="{{ route('posyandu.index') }}" class="iot-status-pill d-none d-md-inline-flex {{ $navRfidOnline ? 'is-online' : 'is-standby' }}" title="Status Perangkat Scanner RFID ESP32">
                            <i class="fas fa-wifi" style="font-size: 10px;"></i>
                            <span>RFID {{ $navRfidOnline ? 'Online' : 'Standby' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Center Quick Command Search -->
                <button type="button" class="cmd-trigger-btn d-none d-xl-flex" onclick="window.openKasCommand()" title="Cari fitur atau lompat ke halaman lain (Ctrl+K)">
                    <span><i class="fas fa-search mr-2"></i>Cari fitur atau menu...</span>
                    <span class="cmd-kbd">Ctrl K</span>
                </button>

                <div class="account-wrap d-flex align-items-center" style="gap: 10px;">
                    <button type="button" class="header-icon-btn d-xl-none" onclick="window.openKasCommand()" title="Cari Menu Cepat (Ctrl+K)">
                        <i class="fas fa-search"></i>
                    </button>

                    <button type="button" class="header-icon-btn" id="dashThemeToggle" onclick="window.toggleDashTheme()" title="Ganti Mode Tampilan (Terang / Gelap)">
                        <i class="fas fa-moon" id="dashThemeIcon"></i>
                    </button>

                    <a href="{{ route('admin.warga.verifikasi') }}" class="header-icon-btn" title="Antrean Verifikasi Warga Baru">
                        <i class="fas fa-bell"></i>
                        @if($pendingVerifCount > 0)
                            <span class="header-badge-dot">{{ $pendingVerifCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('welcome') }}" class="header-icon-btn d-none d-sm-inline-flex" title="Lihat Portal Depan E-KASRT">
                        <i class="fas fa-globe"></i>
                    </a>

                    <div class="text-right d-none d-md-block ml-1">
                        <div class="font-weight-bold text-dark" style="font-size: 13.5px; line-height: 1.2;">
                            {{ Auth::user()->user ?? 'Administrator' }}
                        </div>
                        <small class="text-muted text-uppercase" style="font-size: 10.5px; font-weight: 700; letter-spacing: 0.5px;">
                            {{ Auth::user()->role->role ?? 'SUPERADMIN' }}
                        </small>
                    </div>
                    <div style="position: relative;">
                        <img src="{{ asset('assets/avatar.png') }}" class="rounded-circle border" width="38" height="38" alt="Avatar" style="box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                        <span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #10b981; border: 2px solid #fff; border-radius: 50%;"></span>
                    </div>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm font-weight-bold ml-1" title="Keluar dari Sistem" style="border-radius: 10px;">
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
                            <div class="alert alert-success alert-dismissible fade show shadow-sm dash-auto-alert" role="alert" style="border-radius: 14px; border: 1px solid #a7f3d0; background: #ecfdf5; color: #065f46;">
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

    <!-- Scroll to top helper -->
    <button type="button" id="dashScrollTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Kembali ke Atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Command Palette Modal (Ctrl+K Quick Jumper) -->
    <div id="kasCommandModal" role="dialog" aria-modal="true" aria-label="Pencarian Cepat Fitur E-KASRT">
        <div class="kas-cmd-panel">
            <div class="kas-cmd-head">
                <i class="fas fa-search text-primary"></i>
                <input type="text" id="kasCmdInput" class="kas-cmd-input" placeholder="Ketik nama menu atau fitur (misal: Pemasukan, Posyandu, Warga)..." autocomplete="off">
                <button type="button" onclick="window.closeKasCommand()" style="border:none;background:none;color:#94a3b8;font-size:18px;cursor:pointer;">&times;</button>
            </div>
            <div class="kas-cmd-list" id="kasCmdList"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>

    <script type="application/json" id="kasCommandsJson">{!! json_encode([
        ['title' => 'Dashboard Eksekutif', 'desc' => 'Ringkasan kas, grafik & pantauan RT', 'icon' => 'fas fa-home', 'url' => route('dashboard')],
        ['title' => 'Pemasukan Kas', 'desc' => 'Catat dana masuk & cetak kwitansi', 'icon' => 'fas fa-arrow-down', 'url' => route('kas.masuk')],
        ['title' => 'Pengeluaran Kas', 'desc' => 'Catat pengeluaran operasional RT', 'icon' => 'fas fa-arrow-up', 'url' => route('kas.keluar')],
        ['title' => 'Transfer Kas', 'desc' => 'Mutasi kas antar rekening RT', 'icon' => 'fas fa-exchange-alt', 'url' => route('smartrt.transfer')],
        ['title' => 'Laporan Kas', 'desc' => 'Rekap arus kas bulanan & cetak', 'icon' => 'fas fa-file-invoice-dollar', 'url' => route('kas.laporan')],
        ['title' => 'Data Warga', 'desc' => 'Kelola profil warga, NIK & kartu KK', 'icon' => 'fas fa-users', 'url' => route('warga.index')],
        ['title' => 'Verifikasi Pendaftaran Warga', 'desc' => 'Setujui atau tolak akun warga baru', 'icon' => 'fas fa-user-check', 'url' => route('admin.warga.verifikasi')],
        ['title' => 'Iuran Warga', 'desc' => 'Tagihan bulanan, quick pay & RFID', 'icon' => 'fas fa-money-check-alt', 'url' => route('smartrt.iuran')],
        ['title' => 'Posyandu Balita IoT', 'desc' => 'Absensi e-KTP ESP32 & KMS balita', 'icon' => 'fas fa-heartbeat', 'url' => route('posyandu.index')],
        ['title' => 'Surat Pengantar Digital', 'desc' => 'Proses pengajuan surat domisili/SKCK', 'icon' => 'fas fa-envelope-open-text', 'url' => route('smartrt.surat')],
        ['title' => 'Bank Sampah', 'desc' => 'Setoran & saldo tabungan sampah warga', 'icon' => 'fas fa-recycle', 'url' => route('smartrt.banksampah')],
        ['title' => 'Pengurus RT', 'desc' => 'Daftar struktur pengurus lingkungan', 'icon' => 'fas fa-user-tie', 'url' => route('smartrt.pengurus')],
        ['title' => 'Profil & Data RT', 'desc' => 'Info wilayah, QRIS & rekening RT', 'icon' => 'fas fa-building', 'url' => route('smartrt.datart')],
        ['title' => 'Aspirasi Warga', 'desc' => 'Kotak masukan & laporan lingkungan', 'icon' => 'fas fa-comments', 'url' => route('smartrt.aspirasi')],
        ['title' => 'Aset & Inventaris', 'desc' => 'Pendataan aset inventaris milik RT', 'icon' => 'fas fa-boxes', 'url' => route('smartrt.aset')],
        ['title' => 'AI Customer Service', 'desc' => 'Atur KasBot AI & riwayat pertanyaan', 'icon' => 'fas fa-robot', 'url' => route('smartrt.ai_cs')],
        ['title' => 'Pengguna & Hak Akses', 'desc' => 'Manajemen akun administrator & role', 'icon' => 'fas fa-user-shield', 'url' => route('admin.user')],
        ['title' => 'Database & Backup SQL', 'desc' => 'Export database .sql & migrasi', 'icon' => 'fas fa-database', 'url' => route('smartrt.backup')],
        ['title' => 'Portal Depan (Welcome Page)', 'desc' => 'Buka halaman utama portal publik', 'icon' => 'fas fa-globe', 'url' => route('welcome')]
    ]) !!}</script>
    <script>
        // Bootstrap Modal Elevation Fix
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

        // Theme Switcher (Light / Dark Executive)
        window.applyDashTheme = function(mode) {
            var isDark = (mode === 'dark');
            document.body.classList.toggle('dark-exec', isDark);
            var icon = document.getElementById('dashThemeIcon');
            if (icon) {
                icon.className = isDark ? 'fas fa-sun text-warning' : 'fas fa-moon';
            }
            try { localStorage.setItem('ekasrt_dash_theme', mode); } catch (e) {}
            try { window.dispatchEvent(new CustomEvent('dash:theme', { detail: { dark: isDark } })); } catch (e) {}
        };
        window.toggleDashTheme = function() {
            var next = document.body.classList.contains('dark-exec') ? 'light' : 'dark';
            window.applyDashTheme(next);
        };
        (function() {
            try {
                var saved = localStorage.getItem('ekasrt_dash_theme');
                if (saved === 'dark') window.applyDashTheme('dark');
            } catch (e) {}
        })();

        // Sidebar Quick Filter + Scroll Active Item into View + Back to Top
        document.addEventListener('DOMContentLoaded', function() {
            var activeLi = document.querySelector('#sidebarMenuList li.active');
            if (activeLi && activeLi.scrollIntoView) {
                activeLi.scrollIntoView({ block: 'nearest' });
            }

            var sbInput = document.getElementById('sidebarQuickSearch');
            if (sbInput) {
                sbInput.addEventListener('input', function() {
                    var q = (sbInput.value || '').trim().toLowerCase();
                    var children = document.getElementById('sidebarMenuList').children;
                    for (var i = 0; i < children.length; i++) {
                        var el = children[i];
                        if (el.tagName === 'LI') {
                            var txt = (el.textContent || '').toLowerCase();
                            el.style.display = (!q || txt.indexOf(q) !== -1) ? '' : 'none';
                        } else if (el.classList.contains('menu-category')) {
                            el.style.display = q ? 'none' : '';
                        }
                    }
                });
            }

            // Back to top button visibility
            var topBtn = document.getElementById('dashScrollTop');
            if (topBtn) {
                window.addEventListener('scroll', function() {
                    topBtn.classList.toggle('show', window.scrollY > 320);
                }, { passive: true });
            }

            // Auto-hide flash success alerts gently
            setTimeout(function() {
                document.querySelectorAll('.dash-auto-alert').forEach(function(al) {
                    al.style.transition = 'opacity 0.5s ease';
                    al.style.opacity = '0';
                    setTimeout(function() { if (al.parentNode) al.remove(); }, 500);
                });
            }, 6000);
        });

        // Command Palette Quick Search
        (function() {
            var commands = [];
            try {
                var jsonEl = document.getElementById('kasCommandsJson');
                if (jsonEl) commands = JSON.parse(jsonEl.textContent || '[]');
            } catch (e) { commands = []; }

            var modal = document.getElementById('kasCommandModal');
            var input = document.getElementById('kasCmdInput');
            var list  = document.getElementById('kasCmdList');
            var filtered = commands.slice();
            var selectedIdx = 0;

            function renderList() {
                if (!list) return;
                if (!filtered.length) {
                    list.innerHTML = '<div class="text-center py-4 text-muted" style="font-size:13px;">Tidak ada menu yang cocok.</div>';
                    return;
                }
                list.innerHTML = filtered.map(function(c, i) {
                    return '<a href="' + c.url + '" class="kas-cmd-item' + (i === selectedIdx ? ' selected' : '') + '">' +
                        '<div class="kas-cmd-item-left">' +
                            '<div class="kas-cmd-icon"><i class="' + c.icon + '"></i></div>' +
                            '<div>' +
                                '<div style="font-size:13.5px;font-weight:700;">' + c.title + '</div>' +
                                '<div style="font-size:11.5px;opacity:0.7;">' + c.desc + '</div>' +
                            '</div>' +
                        '</div>' +
                        '<i class="fas fa-arrow-right" style="font-size:11px;opacity:0.5;"></i>' +
                    '</a>';
                }).join('');
            }

            window.openKasCommand = function() {
                if (!modal) return;
                filtered = commands.slice();
                selectedIdx = 0;
                if (input) input.value = '';
                renderList();
                modal.classList.add('open');
                setTimeout(function() { if (input) input.focus(); }, 40);
            };
            window.closeKasCommand = function() {
                if (modal) modal.classList.remove('open');
            };

            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) window.closeKasCommand();
                });
            }
            if (input) {
                input.addEventListener('input', function() {
                    var q = (input.value || '').trim().toLowerCase();
                    filtered = commands.filter(function(c) {
                        return !q || c.title.toLowerCase().indexOf(q) !== -1 || c.desc.toLowerCase().indexOf(q) !== -1;
                    });
                    selectedIdx = 0;
                    renderList();
                });
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        if (filtered.length) selectedIdx = (selectedIdx + 1) % filtered.length;
                        renderList();
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        if (filtered.length) selectedIdx = (selectedIdx - 1 + filtered.length) % filtered.length;
                        renderList();
                    } else if (e.key === 'Enter' && filtered[selectedIdx]) {
                        e.preventDefault();
                        window.location.href = filtered[selectedIdx].url;
                    }
                });
            }

            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    if (modal && modal.classList.contains('open')) window.closeKasCommand();
                    else window.openKasCommand();
                } else if (e.key === 'Escape' && modal && modal.classList.contains('open')) {
                    window.closeKasCommand();
                }
            });
        })();
    </script>
    @stack('scripts')
    @include('components.ai-cs-widget')
</body>

</html>
