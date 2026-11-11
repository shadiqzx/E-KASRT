<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Selamat Datang di E-KASRT | Sistem Informasi Keuangan & Smart RT</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/favicon.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 5 -->
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --app-font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            --mono-font: 'JetBrains Mono', monospace;
            --glass-bg: rgba(255, 255, 255, 0.07);
            --glass-border: rgba(255, 255, 255, 0.16);
            --glass-card: rgba(255, 255, 255, 0.06);
            --primary-accent: #0284c7;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--app-font);
            background: #060b17;
            color: #ffffff;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Dynamic Glow Orbs Background */
        .ambient-canvas {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.65;
            animation: orbFloat 16s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(2, 132, 199, 0.7) 0%, rgba(37, 99, 235, 0.1) 70%);
            top: -150px;
            left: -100px;
        }

        .orb-2 {
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.55) 0%, rgba(6, 182, 212, 0.08) 70%);
            top: 30%;
            right: -100px;
            animation-duration: 20s;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.45) 0%, rgba(219, 39, 119, 0.05) 70%);
            bottom: 5%;
            left: 15%;
            animation-duration: 18s;
            animation-delay: -10s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(40px, -50px) scale(1.08); }
            100% { transform: translate(-30px, 40px) scale(0.95); }
        }

        /* Grid Background Pattern */
        .ambient-canvas::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ================================================================
           1. STICKY GLASS NAVBAR
           ================================================================ */
        .glass-navbar {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            height: 74px;
            background: rgba(6, 11, 23, 0.75);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 100;
            display: flex;
            align-items: center;
        }

        .nav-container {
            width: 100%;
            max-width: 1220px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
        }

        .brand-logo-box {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 18px;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.45);
        }

        .brand-title-group h2 {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }
        .brand-title-group span {
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
        }

        .nav-links a {
            color: #94a3b8;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-links a:hover {
            color: #ffffff;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-nav-outline {
            padding: 9px 18px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: all 0.2s;
        }
        .btn-nav-outline:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: #38bdf8;
            color: #ffffff;
        }

        .btn-nav-solid {
            padding: 9px 20px;
            border-radius: 12px;
            border: none;
            color: #ffffff;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.4);
            transition: all 0.2s;
        }
        .btn-nav-solid:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.55);
            color: #ffffff;
        }

        /* ================================================================
           2. HERO SECTION
           ================================================================ */
        .hero-banner {
            position: relative;
            z-index: 10;
            padding: 80px 24px 60px;
            text-align: center;
            max-width: 1080px;
            margin: 0 auto;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 18px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(12px);
            font-size: 12px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .pulse-live {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8);
            animation: pulseLive 2s infinite;
        }
        @keyframes pulseLive {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8); }
            70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .hero-main-title {
            font-size: 54px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-bottom: 22px;
            color: #ffffff;
        }

        .gradient-text {
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 50%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #94a3b8;
            line-height: 1.65;
            max-width: 760px;
            margin: 0 auto 36px;
        }

        .hero-btn-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .btn-cta-primary {
            padding: 14px 28px;
            border-radius: 15px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px -4px rgba(2, 132, 199, 0.55);
            transition: all 0.25s;
        }
        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px -4px rgba(2, 132, 199, 0.7);
            color: #ffffff;
        }

        .btn-cta-secondary {
            padding: 14px 28px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s;
        }
        .btn-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #38bdf8;
            transform: translateY(-3px);
            color: #ffffff;
        }

        /* ================================================================
           3. LIVE GLASS STATS TICKER
           ================================================================ */
        .stats-grid {
            position: relative;
            z-index: 10;
            max-width: 1140px;
            margin: 0 auto 80px;
            padding: 0 24px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .glass-stat-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        .glass-stat-card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.09);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 14px;
        }
        .stat-icon-blue { background: rgba(2, 132, 199, 0.2); color: #38bdf8; }
        .stat-icon-green { background: rgba(16, 185, 129, 0.2); color: #34d399; }
        .stat-icon-purple { background: rgba(124, 58, 237, 0.2); color: #c084fc; }
        .stat-icon-teal { background: rgba(13, 148, 136, 0.2); color: #2dd4bf; }

        .stat-label {
            font-size: 12px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .stat-val {
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
            font-family: var(--mono-font);
            margin-bottom: 4px;
        }

        .stat-desc {
            font-size: 12.5px;
            color: #64748b;
        }

        /* ================================================================
           4. FEATURE SHOWCASE (FITUR SEKILAS)
           ================================================================ */
        .features-section {
            position: relative;
            z-index: 10;
            max-width: 1220px;
            margin: 0 auto;
            padding: 40px 24px 100px;
        }

        .section-header {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 54px;
        }

        .section-badge {
            font-size: 12px;
            font-weight: 800;
            color: #38bdf8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 14px;
            color: #ffffff;
        }

        .section-subtitle {
            font-size: 16px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .feature-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 28px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 26px;
            padding: 34px 30px;
            box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: rgba(56, 189, 248, 0.45);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 55px -10px rgba(2, 132, 199, 0.3);
        }

        .feature-badge-corner {
            position: absolute;
            top: 24px;
            right: 24px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #bae6fd;
        }

        .feature-icon-wrapper {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 22px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        .feature-title {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
            letter-spacing: -0.4px;
        }

        .feature-text {
            font-size: 14.5px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .feature-points {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 13px;
            color: #cbd5e1;
        }

        .feature-points li {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .feature-points li i {
            color: #34d399;
            font-size: 12px;
        }

        /* ================================================================
           5. CALL TO ACTION SECTION
           ================================================================ */
        .cta-box-glass {
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.3) 0%, rgba(37, 99, 235, 0.2) 50%, rgba(16, 185, 129, 0.2) 100%);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 30px;
            padding: 50px 40px;
            text-align: center;
            max-width: 960px;
            margin: 0 auto 80px;
            box-shadow: 0 25px 60px -10px rgba(0, 0, 0, 0.5);
        }

        .cta-title {
            font-size: 34px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 14px;
            letter-spacing: -0.8px;
        }

        .cta-desc {
            font-size: 16px;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        /* ================================================================
           6. FOOTER
           ================================================================ */
        .site-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(4, 8, 18, 0.85);
            backdrop-filter: blur(16px);
            padding: 34px 24px;
            text-align: center;
            color: #64748b;
            font-size: 13.5px;
            position: relative;
            z-index: 10;
        }

        .footer-brand {
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }

        @media (max-width: 991px) {
            .nav-links {
                display: none;
            }
            .hero-main-title {
                font-size: 38px;
            }
            .hero-subtitle {
                font-size: 15.5px;
            }
            .section-title {
                font-size: 30px;
            }
            .cta-box-glass {
                padding: 36px 20px;
            }
            .cta-title {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Glowing Orbs Background -->
    <div class="ambient-canvas">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- 1. STICKY GLASS NAVBAR -->
    <header class="glass-navbar">
        <div class="nav-container">
            <a href="{{ route('welcome') }}" class="brand-link">
                <div class="brand-logo-box">
                    <i class="fas fa-home"></i>
                </div>
                <div class="brand-title-group">
                    <h2>E-KASRT</h2>
                    <span>Portal RT Digital</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#fitur">Fitur Sekilas</a></li>
                <li><a href="#kas">Transparansi Kas</a></li>
                <li><a href="#posyandu">Posyandu IoT</a></li>
                <li><a href="#warga">Layanan Warga</a></li>
            </ul>

            <div class="nav-actions">
                @if(Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn-nav-solid">
                        <i class="fas fa-th-large mr-1"></i> Buka Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-outline">
                        <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-nav-solid">
                        <i class="fas fa-user-plus mr-1"></i> Daftar Warga
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- 2. HERO WELCOME SECTION -->
    <section class="hero-banner">
        <div class="hero-pill">
            <span class="pulse-live"></span>
            PORTAL RESMI SISTEM INFORMASI & KEUANGAN RT DIGITAL
        </div>

        <h1 class="hero-main-title">
            Mewujudkan Tata Kelola RT <br>
            yang <span class="gradient-text">Transparan, Cerdas & Guyub.</span>
        </h1>

        <p class="hero-subtitle">
            Selamat datang di ekosistem digital E-KASRT. Solusi terpadu pembukuan kas lingkungan real-time, monitoring iuran warga, verifikasi kwitansi otomatis, dan inovasi smart IoT Posyandu Balita berbasis e-KTP.
        </p>

        <div class="hero-btn-group">
            @if(Auth::check())
                <a href="{{ route('dashboard') }}" class="btn-cta-primary">
                    <span>Masuk ke Dashboard Utama</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-cta-primary">
                    <span>Masuk ke Sistem Kas &rarr;</span>
                </a>
                <a href="{{ route('register') }}" class="btn-cta-secondary">
                    <i class="fas fa-user-plus"></i>
                    <span>Daftar Warga Baru</span>
                </a>
            @endif
            <a href="#fitur" class="btn-cta-secondary">
                <i class="fas fa-compass"></i>
                <span>Jelajahi Fitur Sekilas</span>
            </a>
        </div>
    </section>

    <!-- 3. LIVE STATS TICKER (Real DB Numbers) -->
    <section class="stats-grid">
        <!-- Stat 1: Saldo Kas -->
        <div class="glass-stat-card">
            <div class="stat-icon stat-icon-blue">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="stat-label">Saldo Kas RT Saat Ini</div>
            <div class="stat-val text-primary" style="color: #38bdf8 !important;">
                Rp {{ rupiah($saldo) }}
            </div>
            <div class="stat-desc">
                <i class="fas fa-shield-alt text-success mr-1"></i> Kas likuid terverifikasi aktif
            </div>
        </div>

        <!-- Stat 2: Total Pemasukan -->
        <div class="glass-stat-card">
            <div class="stat-icon stat-icon-green">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="stat-label">Akumulasi Pemasukan</div>
            <div class="stat-val text-success" style="color: #34d399 !important;">
                Rp {{ rupiah($total_masuk) }}
            </div>
            <div class="stat-desc">
                <i class="fas fa-check-circle text-info mr-1"></i> Transparansi pembukuan kas
            </div>
        </div>

        <!-- Stat 3: Warga Terdata -->
        <div class="glass-stat-card">
            <div class="stat-icon stat-icon-purple">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-label">Total Warga Terdata</div>
            <div class="stat-val" style="color: #c084fc !important;">
                {{ $total_warga }} <span style="font-size: 15px; color: #94a3b8;">Jiwa</span>
            </div>
            <div class="stat-desc">
                <i class="fas fa-home text-purple mr-1"></i> Tersebar dalam {{ $total_kk }} Kepala Keluarga
            </div>
        </div>

        <!-- Stat 4: Posyandu IoT -->
        <div class="glass-stat-card">
            <div class="stat-icon stat-icon-teal">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="stat-label">Posyandu Balita IoT</div>
            <div class="stat-val" style="color: #2dd4bf !important;">
                {{ $total_balita }} <span style="font-size: 15px; color: #94a3b8;">Balita</span>
            </div>
            <div class="stat-desc">
                <i class="fas fa-wifi text-success mr-1"></i> Scanner RFID e-KTP Online
            </div>
        </div>
    </section>

    <!-- 4. FEATURE SHOWCASE (FITUR SEKILAS) -->
    <section class="features-section" id="fitur">
        <div class="section-header">
            <div class="section-badge">SEKILAS FITUR UTAMA</div>
            <h2 class="section-title">Teknologi Cerdas untuk Kemajuan Lingkungan RT</h2>
            <p class="section-subtitle">
                E-KASRT dirancang khusus mempermudah tugas pengurus RT dan memberikan rasa aman bagi seluruh warga melalui transparansi digital.
            </p>
        </div>

        <div class="feature-cards-grid">
            <!-- Card 1: Kas Transparan -->
            <div class="feature-card" id="kas">
                <span class="feature-badge-corner">FINTECH RT</span>
                <div class="feature-icon-wrapper" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: #fff;">
                    <i class="fas fa-coins"></i>
                </div>
                <h3 class="feature-title">Manajemen Kas Real-Time</h3>
                <p class="feature-text">
                    Catat kas masuk, pengeluaran belanja lingkungan, cetak bukti kwitansi sah, dan laporan arus kas bulanan secara transparan tanpa selisih.
                </p>
                <ul class="feature-points">
                    <li><i class="fas fa-check"></i> Pencatatan Pemasukan & Pengeluaran</li>
                    <li><i class="fas fa-check"></i> Generator Kwitansi Bukti Sah Otomatis</li>
                    <li><i class="fas fa-check"></i> Export Laporan Kas & Diagram Keuangan</li>
                </ul>
            </div>

            <!-- Card 2: Posyandu Balita IoT -->
            <div class="feature-card" id="posyandu">
                <span class="feature-badge-corner" style="color: #f43f5e; border-color: rgba(244,63,94,0.3);">SMART IOT</span>
                <div class="feature-icon-wrapper" style="background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%); color: #fff;">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3 class="feature-title">Posyandu Balita Digital IoT</h3>
                <p class="feature-text">
                    Inovasi smart scanner e-KTP & kartu RFID untuk presensi balita otomatis, KMS elektronik, grafik status gizi, dan deteksi dini stunting.
                </p>
                <ul class="feature-points">
                    <li><i class="fas fa-check"></i> Presensi e-KTP / RFID via ESP32</li>
                    <li><i class="fas fa-check"></i> Grafik Tumbuh Kembang (BB/TB) Balita</li>
                    <li><i class="fas fa-check"></i> Cetak Kartu Menuju Sehat (KMS) Digital</li>
                </ul>
            </div>

            <!-- Card 3: Layanan Kependudukan & Iuran -->
            <div class="feature-card" id="warga">
                <span class="feature-badge-corner">DATABASE</span>
                <div class="feature-icon-wrapper" style="background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); color: #fff;">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Data Warga & Iuran RT</h3>
                <p class="feature-text">
                    Pendataan kependudukan lengkap per Kartu Keluarga (KK), pencatatan iuran wajib warga bulanan, serta mutasi dompet digital QRIS.
                </p>
                <ul class="feature-points">
                    <li><i class="fas fa-check"></i> Database Kependudukan & Profil RT</li>
                    <li><i class="fas fa-check"></i> Tracking Pembayaran Iuran Warga per Bulan</li>
                    <li><i class="fas fa-check"></i> Transfer Kas Antar-Rekening & QRIS</li>
                </ul>
            </div>

            <!-- Card 4: Surat Pengantar Online -->
            <div class="feature-card">
                <span class="feature-badge-corner">LAYANAN</span>
                <div class="feature-icon-wrapper" style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); color: #fff;">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h3 class="feature-title">Surat Pengantar Digital</h3>
                <p class="feature-text">
                    Permohonan surat keterangan domisili, SKCK, dan pengantar administrasi kelurahan dapat diproses langsung secara terstruktur.
                </p>
                <ul class="feature-points">
                    <li><i class="fas fa-check"></i> Pengajuan Surat Keterangan Warga</li>
                    <li><i class="fas fa-check"></i> Penomoran Surat Resmi Otomatis</li>
                    <li><i class="fas fa-check"></i> Format Cetak Surat Siap Pakai</li>
                </ul>
            </div>

            <!-- Card 5: Bank Sampah Lingkungan -->
            <div class="feature-card">
                <span class="feature-badge-corner">ECO LINGKUNGAN</span>
                <div class="feature-icon-wrapper" style="background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%); color: #fff;">
                    <i class="fas fa-recycle"></i>
                </div>
                <h3 class="feature-title">Bank Sampah Terintegrasi</h3>
                <p class="feature-text">
                    Gerakan pilah sampah lingkungan bernilai ekonomis. Sampah anorganik ditimbang dan dikonversi menjadi saldo simpanan warga.
                </p>
                <ul class="feature-points">
                    <li><i class="fas fa-check"></i> Buku Tabungan Sampah Warga</li>
                    <li><i class="fas fa-check"></i> Konversi Berat Sampah ke Rupiah</li>
                    <li><i class="fas fa-check"></i> Rekap Penjualan Sampah Daur Ulang</li>
                </ul>
            </div>

            <!-- Card 6: Aspirasi & Inventaris Aset -->
            <div class="feature-card">
                <span class="feature-badge-corner">PARTISIPASI</span>
                <div class="feature-icon-wrapper" style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); color: #fff;">
                    <i class="fas fa-boxes"></i>
                </div>
                <h3 class="feature-title">Aspirasi & Aset RT</h3>
                <p class="feature-text">
                    Saluran komunikasi dua arah untuk aduan lingkungan, serta pendataan aset inventaris milik RT (tenda, kursi, sound system, dsb).
                </p>
                <ul class="feature-points">
                    <li><i class="fas fa-check"></i> Kotak Aspirasi & Masukan Warga</li>
                    <li><i class="fas fa-check"></i> Pencatatan Peminjaman Aset RT</li>
                    <li><i class="fas fa-check"></i> Backup Database 1-Klik demi Keamanan</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- 5. CALL TO ACTION BOX -->
    <div class="cta-box-glass">
        <h2 class="cta-title">Siap Mencoba Kemudahan Pengelolaan RT Digital?</h2>
        <p class="cta-desc">
            Akses dashboard sekarang untuk melihat laporan kas secara langsung atau daftarkan diri Anda sebagai warga untuk mulai menikmati kemudahan layanan.
        </p>
        <div class="hero-btn-group" style="margin-bottom: 0;">
            @if(Auth::check())
                <a href="{{ route('dashboard') }}" class="btn-cta-primary">
                    <i class="fas fa-th-large"></i>
                    <span>Buka Dashboard Saya</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-cta-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk ke Akun Anda</span>
                </a>
                <a href="{{ route('register') }}" class="btn-cta-secondary">
                    <i class="fas fa-user-plus"></i>
                    <span>Daftar Akun Warga Baru</span>
                </a>
            @endif
        </div>
    </div>

    <!-- 6. FOOTER -->
    <footer class="site-footer">
        <div class="footer-brand">
            Sistem Informasi E-KASRT &bull; Keuangan & Smart RT Digital
        </div>
        <p class="mb-0">
            Dikelola oleh Pengurus Lingkungan RT &bull; Berbasis Laravel 11 &amp; ESP32 IoT &bull; &copy; {{ date('Y') }} Hak Cipta Dilindungi.
        </p>
    </footer>

</body>
</html>
