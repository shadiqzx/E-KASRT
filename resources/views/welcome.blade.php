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
            /* Theme-switchable vars */
            --kb-accent:  #0284c7;
            --kb-accent2: #2563eb;
            --kb-light:   #38bdf8;
            --kb-bg:      #060b17;
        }

        /* Smooth global color transition on theme switch */
        body, .glass-navbar, .glass-stat-card, .feature-card,
        .cta-box-glass, .site-footer, .hero-pill,
        .btn-cta-primary, .btn-nav-solid, .gradient-text,
        .brand-logo-box, .feature-icon-wrapper,
        .orb, #scroll-progress {
            transition: background 1.2s ease, background-color 1.2s ease,
                        border-color 1.2s ease, color 1.2s ease,
                        box-shadow 1.2s ease, filter 1.2s ease !important;
        }

        /* Full-page theme flash overlay */
        #theme-flash {
            position: fixed;
            inset: 0;
            z-index: 99998;
            pointer-events: none;
            opacity: 0;
            border-radius: 50%;
            transform: scale(0);
            transition: none;
        }
        #theme-flash.burst {
            animation: themeBurst 1.4s cubic-bezier(.22,.68,0,1) forwards;
        }
        @keyframes themeBurst {
            0%   { opacity: 0.55; transform: scale(0);   border-radius: 50%; }
            50%  { opacity: 0.18; transform: scale(2.5); border-radius: 30%; }
            100% { opacity: 0;    transform: scale(4);   border-radius: 10%; }
        }

        /* Theme name toast */
        #theme-toast {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            z-index: 99999;
            background: rgba(2,10,30,0.92);
            backdrop-filter: blur(24px);
            border: 2px solid var(--kb-light, #38bdf8);
            border-radius: 20px;
            padding: 18px 32px;
            text-align: center;
            pointer-events: none;
            opacity: 0;
            transition: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.6);
        }
        #theme-toast.show {
            animation: themeToastPop 2.5s cubic-bezier(.22,.68,0,1.2) forwards;
        }
        @keyframes themeToastPop {
            0%   { opacity:0; transform:translate(-50%,-50%) scale(0.5); }
            15%  { opacity:1; transform:translate(-50%,-50%) scale(1.08); }
            25%  { opacity:1; transform:translate(-50%,-50%) scale(1); }
            75%  { opacity:1; transform:translate(-50%,-50%) scale(1); }
            100% { opacity:0; transform:translate(-50%,-50%) scale(0.8); }
        }
        #theme-toast .tt-emoji { font-size: 36px; display:block; margin-bottom:6px; }
        #theme-toast .tt-label { font-family:'Plus Jakarta Sans',sans-serif; font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px; }
        #theme-toast .tt-name  { font-family:'Plus Jakarta Sans',sans-serif; font-size:20px; font-weight:800; color:#ffffff; }

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

        /* ================================================================
           ANIMATION SYSTEM
           ================================================================ */

        /* --- Page Load Fade-in --- */
        body { animation: pageFadeIn 0.6s ease both; }
        @keyframes pageFadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* --- Scroll Reveal (Intersection Observer) --- */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s cubic-bezier(.22,.68,0,1.1), transform 0.7s cubic-bezier(.22,.68,0,1.1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.7s cubic-bezier(.22,.68,0,1.1), transform 0.7s cubic-bezier(.22,.68,0,1.1);
        }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.7s cubic-bezier(.22,.68,0,1.1), transform 0.7s cubic-bezier(.22,.68,0,1.1);
        }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* Stagger delays */
        .delay-1 { transition-delay: 0.1s !important; }
        .delay-2 { transition-delay: 0.2s !important; }
        .delay-3 { transition-delay: 0.3s !important; }
        .delay-4 { transition-delay: 0.4s !important; }
        .delay-5 { transition-delay: 0.5s !important; }
        .delay-6 { transition-delay: 0.6s !important; }

        /* --- Hero Section Entrance --- */
        .hero-pill     { animation: heroEntrance 0.8s cubic-bezier(.22,.68,0,1.2) 0.2s both; }
        .hero-main-title { animation: heroEntrance 0.9s cubic-bezier(.22,.68,0,1.2) 0.35s both; }
        .hero-subtitle { animation: heroEntrance 0.9s cubic-bezier(.22,.68,0,1.2) 0.5s both; }
        .hero-btn-group { animation: heroEntrance 0.9s cubic-bezier(.22,.68,0,1.2) 0.65s both; }
        @keyframes heroEntrance {
            from { opacity: 0; transform: translateY(32px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* --- Gradient Text Animation --- */
        .gradient-text {
            background-size: 300% 300%;
            animation: gradientShift 5s ease infinite;
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* --- Typing Cursor on hero pill --- */
        .typing-cursor::after {
            content: '|';
            animation: blink 1s step-end infinite;
            color: #38bdf8;
            margin-left: 2px;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }

        /* --- Navbar Logo Spin on Load --- */
        .brand-logo-box {
            animation: logoPop 0.7s cubic-bezier(.22,.68,0,1.4) 0.1s both;
        }
        @keyframes logoPop {
            from { transform: scale(0) rotate(-180deg); opacity: 0; }
            to   { transform: scale(1) rotate(0deg);   opacity: 1; }
        }

        /* --- Navbar Links Stagger --- */
        .nav-links li {
            animation: navLinkFade 0.5s ease both;
        }
        .nav-links li:nth-child(1) { animation-delay: 0.3s; }
        .nav-links li:nth-child(2) { animation-delay: 0.4s; }
        .nav-links li:nth-child(3) { animation-delay: 0.5s; }
        .nav-links li:nth-child(4) { animation-delay: 0.6s; }
        @keyframes navLinkFade {
            from { opacity: 0; transform: translateY(-12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* --- Orb Enhanced Float --- */
        .orb-1 { animation: orbFloat1 18s ease-in-out infinite alternate; }
        .orb-2 { animation: orbFloat2 22s ease-in-out infinite alternate; }
        .orb-3 { animation: orbFloat3 20s ease-in-out infinite alternate; }
        @keyframes orbFloat1 {
            0%   { transform: translate(0,0) scale(1); opacity: 0.65; }
            33%  { transform: translate(60px,-70px) scale(1.1); opacity: 0.75; }
            66%  { transform: translate(-40px, 50px) scale(0.95); opacity: 0.6; }
            100% { transform: translate(30px, -30px) scale(1.05); opacity: 0.7; }
        }
        @keyframes orbFloat2 {
            0%   { transform: translate(0,0) scale(1); opacity: 0.55; }
            50%  { transform: translate(-80px, 60px) scale(1.12); opacity: 0.7; }
            100% { transform: translate(50px, -40px) scale(0.9); opacity: 0.5; }
        }
        @keyframes orbFloat3 {
            0%   { transform: translate(0,0) scale(1) rotate(0deg); opacity: 0.45; }
            50%  { transform: translate(70px, -60px) scale(1.08) rotate(10deg); opacity: 0.6; }
            100% { transform: translate(-50px, 30px) scale(0.93) rotate(-8deg); opacity: 0.4; }
        }

        /* --- Stat Card Counter Animation --- */
        .stat-val[data-count] {
            transition: color 0.3s;
        }

        /* --- Glass Card Shimmer on Hover --- */
        .glass-stat-card, .feature-card, .cta-box-glass {
            position: relative;
            overflow: hidden;
        }
        .glass-stat-card::before, .feature-card::before {
            content: '';
            position: absolute;
            top: -60%;
            left: -60%;
            width: 60%;
            height: 220%;
            background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.08) 50%, transparent 70%);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
            pointer-events: none;
        }
        .glass-stat-card:hover::before, .feature-card:hover::before {
            left: 160%;
        }

        /* --- Button Ripple Effect --- */
        .btn-cta-primary, .btn-cta-secondary, .btn-nav-solid, .btn-nav-outline {
            position: relative;
            overflow: hidden;
        }
        .btn-cta-primary::after, .btn-cta-secondary::after,
        .btn-nav-solid::after, .btn-nav-outline::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            width: 0; height: 0;
            background: rgba(255,255,255,0.25);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s ease, height 0.5s ease, opacity 0.5s ease;
            opacity: 0;
            pointer-events: none;
        }
        .btn-cta-primary:active::after, .btn-cta-secondary:active::after,
        .btn-nav-solid:active::after, .btn-nav-outline:active::after {
            width: 300px; height: 300px; opacity: 0;
            transition: 0s;
        }

        /* --- Feature Icon Bounce on Hover --- */
        .feature-icon-wrapper {
            transition: transform 0.35s cubic-bezier(.22,.68,0,1.4), box-shadow 0.35s;
        }
        .feature-card:hover .feature-icon-wrapper {
            transform: translateY(-6px) scale(1.12) rotate(-5deg);
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
        }

        /* --- Particle Canvas --- */
        #particle-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 1;
            opacity: 0.4;
        }

        /* --- Scroll Progress Bar --- */
        #scroll-progress {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, #0284c7, #38bdf8, #34d399, #818cf8);
            background-size: 200% 100%;
            z-index: 9999;
            transition: width 0.1s linear;
            animation: progressGlow 3s linear infinite;
        }
        @keyframes progressGlow {
            0%   { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        /* --- Section Badge Pulse --- */
        .section-badge {
            animation: badgePulse 3s ease infinite;
        }
        @keyframes badgePulse {
            0%, 100% { opacity: 1; letter-spacing: 1px; }
            50%       { opacity: 0.7; letter-spacing: 1.5px; }
        }

        /* --- Stat Icon Rotate on Hover --- */
        .stat-icon {
            transition: transform 0.4s cubic-bezier(.22,.68,0,1.4), box-shadow 0.3s;
        }
        .glass-stat-card:hover .stat-icon {
            transform: rotate(10deg) scale(1.15);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        /* --- CTA Box Pulsing Border --- */
        .cta-box-glass {
            animation: ctaBorderPulse 4s ease-in-out infinite;
        }
        @keyframes ctaBorderPulse {
            0%, 100% { box-shadow: 0 25px 60px -10px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.0); }
            50%       { box-shadow: 0 25px 60px -10px rgba(0,0,0,0.5), 0 0 30px 2px rgba(2,132,199,0.3); }
        }

        /* --- Navbar on Scroll (shrink) --- */
        .glass-navbar.scrolled {
            height: 58px;
            background: rgba(6, 11, 23, 0.95);
            box-shadow: 0 4px 30px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
        }

        /* --- Floating Scroll Down Arrow --- */
        .scroll-down-hint {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.3);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            animation: scrollHintBounce 2s ease-in-out infinite;
            cursor: pointer;
        }
        .scroll-down-hint i { font-size: 18px; }
        @keyframes scrollHintBounce {
            0%, 100% { transform: translateY(0); opacity: 0.3; }
            50%       { transform: translateY(8px); opacity: 0.6; }
        }

        /* --- Pulse Live Enhanced --- */
        .pulse-live {
            animation: pulseLive 2s infinite, pulseGlow 2s infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.8), 0 0 6px rgba(16,185,129,0.5); }
            70%       { box-shadow: 0 0 0 8px rgba(16,185,129,0), 0 0 12px rgba(16,185,129,0.8); }
        }

        /* --- Footer Fade In --- */
        .site-footer {
            animation: footerFadeIn 1s ease 0.5s both;
        }
        @keyframes footerFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    {{-- ===== FLASH NOTIFICATION TOAST ===== --}}
    @if(session('success') || session('error') || session('warning'))
    <div id="flash-toast" style="
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 99999;
        min-width: 320px;
        max-width: 420px;
        background: rgba(2, 132, 199, 0.15);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(2, 132, 199, 0.4);
        border-radius: 14px;
        padding: 16px 20px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05);
        animation: toastSlideIn 0.4s cubic-bezier(.22,.68,0,1.2) both;
    ">
        @if(session('success'))
        <div style="flex-shrink:0; width:36px; height:36px; border-radius:50%; background:rgba(52,211,153,0.2); border:1px solid rgba(52,211,153,0.5); display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-check" style="color:#34d399; font-size:14px;"></i>
        </div>
        <div style="flex:1; min-width:0;">
            <div style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; color:#34d399; font-size:13px; margin-bottom:4px;">Berhasil</div>
            <div style="font-family:'Plus Jakarta Sans',sans-serif; color:rgba(255,255,255,0.85); font-size:13px; line-height:1.5;">{{ session('success') }}</div>
        </div>
        @elseif(session('error'))
        <div style="flex-shrink:0; width:36px; height:36px; border-radius:50%; background:rgba(239,68,68,0.2); border:1px solid rgba(239,68,68,0.5); display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-times" style="color:#ef4444; font-size:14px;"></i>
        </div>
        <div style="flex:1; min-width:0;">
            <div style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; color:#ef4444; font-size:13px; margin-bottom:4px;">Gagal</div>
            <div style="font-family:'Plus Jakarta Sans',sans-serif; color:rgba(255,255,255,0.85); font-size:13px; line-height:1.5;">{{ session('error') }}</div>
        </div>
        @elseif(session('warning'))
        <div style="flex-shrink:0; width:36px; height:36px; border-radius:50%; background:rgba(251,191,36,0.2); border:1px solid rgba(251,191,36,0.5); display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-exclamation" style="color:#fbbf24; font-size:14px;"></i>
        </div>
        <div style="flex:1; min-width:0;">
            <div style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; color:#fbbf24; font-size:13px; margin-bottom:4px;">Peringatan</div>
            <div style="font-family:'Plus Jakarta Sans',sans-serif; color:rgba(255,255,255,0.85); font-size:13px; line-height:1.5;">{{ session('warning') }}</div>
        </div>
        @endif
        <button onclick="document.getElementById('flash-toast').remove()" style="flex-shrink:0; background:none; border:none; cursor:pointer; color:rgba(255,255,255,0.4); padding:4px; line-height:1; font-size:16px;" title="Tutup">&times;</button>
    </div>
    <style>
        @keyframes toastSlideIn {
            from { opacity: 0; transform: translateX(60px) scale(0.9); }
            to   { opacity: 1; transform: translateX(0) scale(1); }
        }
    </style>
    <script>
        setTimeout(function() {
            var t = document.getElementById('flash-toast');
            if (t) {
                t.style.transition = 'opacity 0.5s, transform 0.5s';
                t.style.opacity = '0';
                t.style.transform = 'translateX(60px) scale(0.9)';
                setTimeout(function() { t && t.remove(); }, 500);
            }
        }, 5000);
    </script>
    @endif
    {{-- ===== END FLASH NOTIFICATION ===== --}}

    <!-- Ambient Glowing Orbs Background -->
    <div class="ambient-canvas">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Scroll Progress Bar -->
    <div id="scroll-progress"></div>

    <!-- Particle Canvas -->
    <canvas id="particle-canvas"></canvas>

    <!-- Theme Flash Overlay -->
    <div id="theme-flash"></div>

    <!-- Theme Name Toast -->
    <div id="theme-toast">
        <span class="tt-emoji" id="tt-emoji">🎨</span>
        <div class="tt-label">Tema Berubah!</div>
        <div class="tt-name" id="tt-name">Ocean Blue</div>
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

            <style id="hydrogen-welcome-css">
                /* Hydrogen Engine: Scroll Progress & Interactive Particle Canvas */
                #scroll-progress-bar {
                    position: fixed;
                    top: 0;
                    left: 0;
                    height: 3px;
                    width: 0%;
                    z-index: 10050;
                    background: linear-gradient(90deg, #06b6d4, #3b82f6, #8b5cf6, #10b981);
                    background-size: 200% 100%;
                    animation: hydroBarShift 4s linear infinite;
                    box-shadow: 0 0 14px rgba(56, 189, 248, 0.75);
                    pointer-events: none;
                }
                @keyframes hydroBarShift {
                    0% { background-position: 0% 50%; }
                    100% { background-position: 200% 50%; }
                }

                #hydrogen-canvas {
                    position: fixed;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    pointer-events: none;
                    z-index: 1;
                    opacity: 0.72;
                }

                /* Neutralize sluggish 1.2s hover stomp while keeping smooth theme color fade */
                body .glass-stat-card,
                body .feature-card,
                body .btn-cta-primary,
                body .hero-showcase-card {
                    transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                                box-shadow 0.32s cubic-bezier(0.22, 1, 0.36, 1),
                                background-color 0.7s ease,
                                border-color 0.45s ease !important;
                    will-change: transform;
                }

                /* Spotlight border radial glow on interactive glass cards */
                .glass-stat-card,
                .feature-card,
                .hero-showcase-card {
                    --mx: 50%;
                    --my: 50%;
                    position: relative;
                    overflow: hidden;
                }
                .glass-stat-card::after,
                .feature-card::after,
                .hero-showcase-card::after {
                    content: '';
                    position: absolute;
                    inset: 0;
                    border-radius: inherit;
                    background: radial-gradient(360px circle at var(--mx) var(--my), rgba(56, 189, 248, 0.16), transparent 55%);
                    opacity: 0;
                    transition: opacity 0.3s ease;
                    pointer-events: none;
                }
                .glass-stat-card:hover::after,
                .feature-card:hover::after,
                .hero-showcase-card:hover::after {
                    opacity: 1;
                }
                .glass-stat-card:hover,
                .feature-card:hover {
                    box-shadow: 0 24px 48px -12px rgba(2, 132, 199, 0.28), 0 0 0 1px rgba(56, 189, 248, 0.35) !important;
                }

                /* Custom inline SVG icon polish */
                .stat-icon svg,
                .hero-svg-badge svg {
                    width: 24px;
                    height: 24px;
                    display: block;
                }
                .stat-icon {
                    position: relative;
                    box-shadow: 0 8px 22px -6px rgba(56, 189, 248, 0.45);
                    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
                }
                .glass-stat-card:hover .stat-icon {
                    transform: scale(1.12) rotate(-4deg);
                }

                /* Feature Card Hydrogen Visual Artwork Banner */
                .feature-svg-artwork {
                    width: 68px;
                    height: 68px;
                    border-radius: 18px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 18px;
                    background: linear-gradient(135deg, rgba(14, 165, 233, 0.14), rgba(99, 102, 241, 0.14));
                    border: 1px solid rgba(56, 189, 248, 0.25);
                    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 10px 24px -8px rgba(2, 132, 199, 0.3);
                    position: relative;
                    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
                }
                .feature-card:hover .feature-svg-artwork {
                    transform: translateY(-4px) scale(1.06);
                    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 16px 32px -8px rgba(56, 189, 248, 0.45);
                }

                /* Hydrogen Hero Interactive Command Hub Visual */
                .hero {
                    position: relative;
                    z-index: 2;
                }
                .hero-hydrogen-stage {
                    width: 100%;
                    max-width: 980px;
                    margin: 46px auto 0 auto;
                    position: relative;
                    perspective: 1200px;
                    z-index: 3;
                }
                .hero-aurora-halo {
                    position: absolute;
                    inset: -28px 6% -20px 6%;
                    border-radius: 36px;
                    background: radial-gradient(ellipse at 30% 40%, rgba(14, 165, 233, 0.32), transparent 58%),
                                radial-gradient(ellipse at 75% 60%, rgba(16, 185, 129, 0.26), transparent 55%),
                                radial-gradient(ellipse at 50% 20%, rgba(139, 92, 246, 0.22), transparent 60%);
                    filter: blur(36px);
                    z-index: 0;
                    animation: hydroHaloPulse 8s ease-in-out infinite alternate;
                    pointer-events: none;
                }
                @keyframes hydroHaloPulse {
                    0% { opacity: 0.65; transform: scale(0.97) translateY(0); }
                    100% { opacity: 1; transform: scale(1.03) translateY(-6px); }
                }

                .hero-showcase-grid {
                    position: relative;
                    z-index: 2;
                    display: grid;
                    grid-template-columns: 1.35fr 1fr;
                    gap: 18px;
                    text-align: left;
                }
                .hero-showcase-card {
                    border-radius: 24px;
                    padding: 22px 24px;
                    background: rgba(15, 23, 42, 0.58);
                    backdrop-filter: blur(22px);
                    -webkit-backdrop-filter: blur(22px);
                    border: 1px solid rgba(148, 163, 184, 0.22);
                    box-shadow: 0 24px 50px -14px rgba(2, 6, 23, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.14);
                    color: #f8fafc;
                }
                [data-theme="light"] .hero-showcase-card {
                    background: rgba(255, 255, 255, 0.78);
                    border-color: rgba(14, 165, 233, 0.24);
                    box-shadow: 0 22px 48px -14px rgba(15, 23, 42, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
                    color: #0f172a;
                }
                [data-theme="light"] .hero-showcase-card .hsc-muted {
                    color: #475569 !important;
                }
                [data-theme="light"] .hero-showcase-card .hsc-chip {
                    background: rgba(14, 165, 233, 0.1);
                    color: #0369a1;
                    border-color: rgba(14, 165, 233, 0.25);
                }

                .hsc-top {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 14px;
                    gap: 10px;
                }
                .hsc-dots {
                    display: flex;
                    gap: 6px;
                    align-items: center;
                }
                /* Only actual dot spans get fixed size — text spans (.hsc-muted) are excluded */
                .hsc-dots .hsc-dot {
                    width: 9px;
                    height: 9px;
                    border-radius: 50%;
                    display: inline-block;
                    flex-shrink: 0;
                }
                .hsc-chip {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 4px 10px;
                    border-radius: 999px;
                    font-size: 11px;
                    font-weight: 700;
                    letter-spacing: 0.4px;
                    background: rgba(16, 185, 129, 0.15);
                    border: 1px solid rgba(52, 211, 153, 0.35);
                    color: #34d399;
                }
                .hsc-pulse {
                    width: 7px;
                    height: 7px;
                    border-radius: 50%;
                    background: #10b981;
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
                    animation: hydroPing 1.8s infinite;
                }
                @keyframes hydroPing {
                    0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.75); }
                    70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
                    100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
                }

                .hsc-amount {
                    font-size: 28px;
                    font-weight: 800;
                    letter-spacing: -0.7px;
                    background: linear-gradient(135deg, #38bdf8, #34d399);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    margin-bottom: 4px;
                }
                [data-theme="light"] .hsc-amount {
                    background: linear-gradient(135deg, #0284c7, #059669);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                }

                .svg-sparkline-path {
                    stroke-dasharray: 420;
                    stroke-dashoffset: 420;
                    animation: hydroDrawPath 2.4s cubic-bezier(0.22, 1, 0.36, 1) forwards 0.3s;
                }
                @keyframes hydroDrawPath {
                    to { stroke-dashoffset: 0; }
                }
                .svg-nfc-wave {
                    transform-origin: center;
                    animation: hydroNfcPulse 2.4s ease-out infinite;
                }
                .svg-nfc-wave-2 { animation-delay: 0.55s; }
                .svg-nfc-wave-3 { animation-delay: 1.1s; }
                @keyframes hydroNfcPulse {
                    0% { opacity: 0.95; transform: scale(0.82); }
                    100% { opacity: 0; transform: scale(1.38); }
                }
                .svg-float-card {
                    animation: hydroFloatSlow 5.5s ease-in-out infinite alternate;
                }
                @keyframes hydroFloatSlow {
                    0% { transform: translateY(0px); }
                    100% { transform: translateY(-6px); }
                }

                /* Truly Centered Single Scroll Down Indicator */
                body .scroll-down-hint {
                    display: inline-flex !important;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    margin: 40px auto 0 auto !important;
                    width: fit-content;
                    position: relative;
                    left: auto;
                    right: auto;
                    text-align: center;
                    cursor: pointer;
                    z-index: 4;
                    padding: 10px 22px;
                    border-radius: 999px;
                    border: 1px solid rgba(56, 189, 248, 0.25);
                    background: rgba(15, 23, 42, 0.28);
                    backdrop-filter: blur(10px);
                    transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease !important;
                    animation: none !important;
                }
                [data-theme="light"] body .scroll-down-hint {
                    background: rgba(255, 255, 255, 0.65);
                    border-color: rgba(14, 165, 233, 0.28);
                }
                body .scroll-down-hint:hover {
                    transform: translateY(3px);
                    border-color: rgba(56, 189, 248, 0.65);
                }
                .scroll-mouse-pill {
                    width: 22px;
                    height: 34px;
                    border-radius: 12px;
                    border: 2px solid rgba(56, 189, 248, 0.7);
                    display: flex;
                    justify-content: center;
                    padding-top: 6px;
                }
                .scroll-mouse-dot {
                    width: 4px;
                    height: 8px;
                    border-radius: 4px;
                    background: #38bdf8;
                    animation: hydroWheelScroll 1.6s cubic-bezier(0.65, 0, 0.35, 1) infinite;
                }
                @keyframes hydroWheelScroll {
                    0% { opacity: 1; transform: translateY(0); }
                    75% { opacity: 0.2; transform: translateY(10px); }
                    100% { opacity: 0; transform: translateY(12px); }
                }
                .scroll-label-row {
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    font-size: 11px;
                    font-weight: 700;
                    letter-spacing: 1.6px;
                    text-transform: uppercase;
                }
                .scroll-chevron-bounce {
                    animation: hydroChev 1.6s ease-in-out infinite;
                }
                @keyframes hydroChev {
                    0%, 100% { transform: translateY(0); opacity: 0.7; }
                    50% { transform: translateY(4px); opacity: 1; }
                }

                @media (max-width: 860px) {
                    .hero-showcase-grid {
                        grid-template-columns: 1fr;
                    }
                    .hero-hydrogen-stage {
                        margin-top: 24px;
                    }
                    .hsc-amount {
                        font-size: 22px;
                    }
                }

                /* Bugfix & Clean Hero Fit Overrides */
                #particle-canvas,
                #scroll-progress {
                    display: none !important;
                }
                /* hsc-dots: only the colored dots get fixed size; text spans are auto */
                .hsc-dots .hsc-dot {
                    width: 9px !important;
                    height: 9px !important;
                    border-radius: 50% !important;
                    display: inline-block !important;
                    flex-shrink: 0;
                }
                /* Ensure hsc-muted text inside hsc-dots is not affected by dot sizing */
                .hsc-dots .hsc-muted {
                    width: auto !important;
                    height: auto !important;
                    border-radius: 0 !important;
                    display: inline !important;
                }
                .hero-banner {
                    padding: 36px 24px 28px !important;
                }
                .hero-pill {
                    margin-bottom: 16px !important;
                }
                .hero-main-title {
                    font-size: clamp(32px, 4.1vw, 48px) !important;
                    margin-bottom: 14px !important;
                }
                .hero-subtitle {
                    font-size: 16px !important;
                    line-height: 1.55 !important;
                    margin: 0 auto 24px !important;
                }
                .hero-btn-group {
                    margin-bottom: 24px !important;
                }
                .hero-hydrogen-stage {
                    margin: 0 auto !important;
                    max-width: 1040px !important;
                }
                .hero-showcase-grid {
                    grid-template-columns: 1fr 0.96fr 1fr !important;
                    gap: 16px !important;
                    align-items: stretch;
                }
                .hero-showcase-card {
                    padding: 16px 18px !important;
                }
                .hero-3d-card {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: space-between;
                    padding: 12px 14px 14px !important;
                    background: radial-gradient(circle at 50% 42%, rgba(14, 165, 233, 0.24), rgba(15, 23, 42, 0.72) 72%) !important;
                    border-color: rgba(56, 189, 248, 0.38) !important;
                }
                [data-theme="light"] .hero-3d-card {
                    background: radial-gradient(circle at 50% 42%, rgba(56, 189, 248, 0.16), rgba(255, 255, 255, 0.88) 76%) !important;
                }
                .hero-3d-stage-wrap {
                    position: relative;
                    width: 100%;
                    height: 186px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: grab;
                    user-select: none;
                    touch-action: pan-y;
                }
                .hero-3d-stage-wrap:active {
                    cursor: grabbing;
                }
                #hero3dCanvas {
                    width: 100%;
                    height: 100%;
                    max-width: 280px;
                    display: block;
                    position: relative;
                    z-index: 2;
                }
                #hero3dFallback {
                    position: absolute;
                    inset: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 1;
                    pointer-events: none;
                    animation: hydroFloatSlow 3.5s ease-in-out infinite alternate;
                }
                .hero-3d-controls {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 6px;
                    flex-wrap: wrap;
                    position: relative;
                    z-index: 3;
                }
                .h3d-btn {
                    border: 1px solid rgba(56, 189, 248, 0.35);
                    background: rgba(14, 165, 233, 0.14);
                    color: #e0f2fe;
                    font-size: 10.5px;
                    font-weight: 700;
                    padding: 4px 10px;
                    border-radius: 999px;
                    cursor: pointer;
                    transition: all 0.2s ease;
                    letter-spacing: 0.2px;
                }
                [data-theme="light"] .h3d-btn {
                    color: #0369a1;
                    background: rgba(14, 165, 233, 0.12);
                }
                .h3d-btn:hover,
                .h3d-btn.active {
                    background: linear-gradient(135deg, #0284c7, #2563eb);
                    color: #ffffff;
                    border-color: #38bdf8;
                    transform: translateY(-1px);
                    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.4);
                }
                body .scroll-down-hint {
                    margin: 22px auto 0 auto !important;
                    padding: 7px 18px !important;
                }
                @media (max-width: 991px) {
                    .hero-showcase-grid {
                        grid-template-columns: 1fr 1fr !important;
                    }
                    .hero-3d-card {
                        grid-column: 1 / -1;
                        order: -1;
                    }
                }
                @media (max-width: 640px) {
                    .hero-showcase-grid {
                        grid-template-columns: 1fr !important;
                    }
                }
            </style>

            <div class="nav-actions">
                @if(Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn-nav-solid">
                        <i class="fas fa-th-large mr-1"></i> Buka Dashboard &rarr;
                    </a>
                    <a href="{{ route('register') }}" class="btn-nav-outline">
                        <i class="fas fa-user-plus mr-1"></i> Daftar Warga
                    </a>
                    <a href="{{ route('logout') }}" class="btn-nav-outline" style="border-color: rgba(239, 68, 68, 0.4); color: #fca5a5;" title="Keluar dari akun saat ini">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
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
                    <i class="fas fa-th-large"></i>
                    <span>Masuk ke Dashboard Utama &rarr;</span>
                </a>
                <a href="{{ route('register') }}" class="btn-cta-secondary">
                    <i class="fas fa-user-plus"></i>
                    <span>Daftar Warga Baru</span>
                </a>
                <a href="{{ route('logout') }}" class="btn-cta-secondary" style="border-color: rgba(239, 68, 68, 0.4); color: #fca5a5;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Ganti Akun / Logout</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-cta-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk ke Sistem Kas &rarr;</span>
                </a>
                <a href="{{ route('register') }}" class="btn-cta-secondary">
                    <i class="fas fa-user-plus"></i>
                    <span>Daftar Warga Baru</span>
                </a>
            @endif
        </div>

        <!-- Hydrogen Interactive 3D Command Hub & IoT Visual Showcase -->
        <div class="hero-hydrogen-stage reveal">
            <div class="hero-aurora-halo"></div>
            <div class="hero-showcase-grid">
                <!-- Left Panel: Live Treasury & Sparkline Preview -->
                <div class="hero-showcase-card hydro-tilt-card">
                    <div class="hsc-top">
                        <div class="hsc-dots">
                            <span class="hsc-dot" style="background:#f87171;"></span>
                            <span class="hsc-dot" style="background:#fbbf24;"></span>
                            <span class="hsc-dot" style="background:#34d399;"></span>
                            <span class="hsc-muted" style="font-size:11.5px; font-weight:700; margin-left:6px; letter-spacing:0.3px; white-space:nowrap;">KAS RT COMMAND CENTER</span>
                        </div>
                        <span class="hsc-chip"><span class="hsc-pulse"></span> LIVE LEDGER</span>
                    </div>
                    <div class="hsc-muted" style="font-size:11.5px; text-transform:uppercase; letter-spacing:1px; font-weight:700; opacity:0.78;">Saldo Kas Terverifikasi</div>
                    <div class="hsc-amount">Rp {{ rupiah($saldo) }}</div>
                    <div style="display:flex; gap:14px; flex-wrap:wrap; font-size:12px; margin-bottom:10px;">
                        <span style="color:#34d399; font-weight:700;">&#8593; Masuk: Rp {{ rupiah($total_masuk) }}</span>
                        <span style="color:#fb7185; font-weight:700;">&#8595; Keluar: Rp {{ rupiah($total_keluar) }}</span>
                    </div>
                    <!-- Custom Animated SVG Sparkline Curve -->
                    <svg viewBox="0 0 360 76" width="100%" height="76" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block; overflow:visible;">
                        <defs>
                            <linearGradient id="heroSparkFill" x1="0" y1="0" x2="0" y2="88" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.38"/>
                                <stop offset="100%" stop-color="#38bdf8" stop-opacity="0.0"/>
                            </linearGradient>
                            <linearGradient id="heroSparkStroke" x1="0" y1="0" x2="360" y2="0" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#38bdf8"/>
                                <stop offset="55%" stop-color="#818cf8"/>
                                <stop offset="100%" stop-color="#34d399"/>
                            </linearGradient>
                        </defs>
                        <line x1="0" y1="22" x2="360" y2="22" stroke="rgba(148,163,184,0.14)" stroke-dasharray="4 4"/>
                        <line x1="0" y1="52" x2="360" y2="52" stroke="rgba(148,163,184,0.14)" stroke-dasharray="4 4"/>
                        <path d="M6 68 C 48 64, 72 44, 114 48 C 156 52, 182 24, 224 28 C 266 32, 298 14, 348 16 L 348 86 L 6 86 Z" fill="url(#heroSparkFill)"/>
                        <path class="svg-sparkline-path" d="M6 68 C 48 64, 72 44, 114 48 C 156 52, 182 24, 224 28 C 266 32, 298 14, 348 16" stroke="url(#heroSparkStroke)" stroke-width="3" stroke-linecap="round"/>
                        <circle cx="348" cy="16" r="5" fill="#34d399"/>
                        <circle cx="348" cy="16" r="11" fill="rgba(52,211,153,0.28)">
                            <animate attributeName="r" values="6;14;6" dur="2.2s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.7;0.1;0.7" dur="2.2s" repeatCount="indefinite"/>
                        </circle>
                    </svg>
                </div>

                <!-- Center Panel: Interactive 3D Character Guardian Stage -->
                <div class="hero-showcase-card hero-3d-card">
                    <div class="hsc-top" style="width:100%; margin-bottom:2px;">
                        <span class="hsc-muted" style="font-size:10.5px; font-weight:800; letter-spacing:0.6px; text-transform:uppercase;">3D Smart-RT Guide</span>
                        <span class="hsc-chip" style="background:rgba(56,189,248,0.16); border-color:rgba(56,189,248,0.4); color:#38bdf8; font-size:10px; padding:2px 8px;">3D LIVE</span>
                    </div>

                    <div class="hero-3d-stage-wrap" id="hero3dStageWrap" title="Geser untuk putar 3D &bull; Klik karakter untuk berinteraksi">
                        <canvas id="hero3dCanvas" width="280" height="190"></canvas>
                        <div id="hero3dFallback" aria-hidden="true">
                            <svg width="108" height="126" viewBox="0 0 96 120">
                                <defs>
                                    <linearGradient id="h3fHead" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#e0f2fe"/><stop offset="100%" stop-color="#38bdf8"/></linearGradient>
                                    <linearGradient id="h3fBody" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#38bdf8"/><stop offset="100%" stop-color="#2563eb"/></linearGradient>
                                </defs>
                                <ellipse cx="48" cy="112" rx="30" ry="6" fill="rgba(56,189,248,0.25)"/>
                                <rect x="20" y="60" width="56" height="38" rx="15" fill="url(#h3fBody)"/>
                                <rect x="12" y="10" width="72" height="48" rx="18" fill="url(#h3fHead)"/>
                                <rect x="17" y="18" width="62" height="32" rx="11" fill="#0f172a"/>
                                <circle cx="34" cy="33" r="6" fill="#38bdf8"/><circle cx="62" cy="33" r="6" fill="#38bdf8"/>
                                <path d="M36 43Q48 50 60 43" stroke="#34d399" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="hero-3d-controls">
                        <button type="button" class="h3d-btn active" onclick="window.HeroChar3D && HeroChar3D.setMode('idle', this)">Idle</button>
                        <button type="button" class="h3d-btn" onclick="window.HeroChar3D && HeroChar3D.setMode('wave', this)">Sapa</button>
                        <button type="button" class="h3d-btn" onclick="window.HeroChar3D && HeroChar3D.setMode('dance', this)">Joget</button>
                        <button type="button" class="h3d-btn" onclick="window.HeroChar3D && HeroChar3D.spinJump()">Putar 360&deg;</button>
                    </div>
                </div>

                <!-- Right Panel: IoT ESP32 RFID & Smart Community Visual -->
                <div class="hero-showcase-card hydro-tilt-card" style="display:flex; flex-direction:column; justify-content:space-between;">
                    <div class="hsc-top" style="margin-bottom:10px;">
                        <span class="hsc-muted" style="font-size:11.5px; font-weight:800; letter-spacing:0.6px; text-transform:uppercase;">IoT e-KTP &amp; Smart Posyandu</span>
                        <span class="hsc-chip" style="background:rgba(56,189,248,0.15); border-color:rgba(56,189,248,0.35); color:#38bdf8;">ESP32 SYNC</span>
                    </div>

                    <div class="svg-float-card" style="display:flex; align-items:center; gap:14px; background:rgba(14,165,233,0.1); border:1px solid rgba(56,189,248,0.24); border-radius:16px; padding:12px 14px;">
                        <!-- Animated Contactless RFID & Shield SVG -->
                        <svg width="56" height="56" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0;">
                            <rect x="6" y="14" width="38" height="28" rx="6" fill="rgba(15,23,42,0.85)" stroke="#38bdf8" stroke-width="2"/>
                            <rect x="12" y="22" width="10" height="8" rx="2" fill="#fbbf24" fill-opacity="0.85"/>
                            <path d="M12 35H30" stroke="#94a3b8" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="48" cy="28" r="3" fill="#34d399"/>
                            <path class="svg-nfc-wave" d="M52 21a10 10 0 0 1 0 14" stroke="#34d399" stroke-width="2.2" stroke-linecap="round"/>
                            <path class="svg-nfc-wave svg-nfc-wave-2" d="M56 17a16 16 0 0 1 0 22" stroke="#38bdf8" stroke-width="2" stroke-linecap="round"/>
                            <path class="svg-nfc-wave svg-nfc-wave-3" d="M60 13a22 22 0 0 1 0 30" stroke="#818cf8" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        <div>
                            <div style="font-size:13px; font-weight:800; margin-bottom:2px;">Tap Kartu e-KTP / RFID</div>
                            <div class="hsc-muted" style="font-size:11.5px; opacity:0.8; line-height:1.35;">Absensi posyandu &amp; identifikasi warga otomatis 0.3 detik.</div>
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:8px; margin-top:12px;">
                        <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(148,163,184,0.18); border-radius:12px; padding:8px 10px;">
                            <div class="hsc-muted" style="font-size:10px; text-transform:uppercase; font-weight:700; opacity:0.7;">Warga</div>
                            <div style="font-size:16px; font-weight:800; color:#a78bfa;">{{ $total_warga }}</div>
                        </div>
                        <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(148,163,184,0.18); border-radius:12px; padding:8px 10px;">
                            <div class="hsc-muted" style="font-size:10px; text-transform:uppercase; font-weight:700; opacity:0.7;">KK</div>
                            <div style="font-size:16px; font-weight:800; color:#38bdf8;">{{ $total_kk }}</div>
                        </div>
                        <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(148,163,184,0.18); border-radius:12px; padding:8px 10px;">
                            <div class="hsc-muted" style="font-size:10px; text-transform:uppercase; font-weight:700; opacity:0.7;">Balita</div>
                            <div style="font-size:16px; font-weight:800; color:#34d399;">{{ $total_balita }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Centered Single Scroll Down Indicator -->
        <div style="width:100%; display:flex; justify-content:center; align-items:center;">
            <div class="scroll-down-hint" onclick="var target = document.querySelector('.stats-grid'); if(target) target.scrollIntoView({behavior:'smooth'});" role="button" tabindex="0" aria-label="Scroll ke bawah">
                <div class="scroll-mouse-pill">
                    <div class="scroll-mouse-dot"></div>
                </div>
                <div class="scroll-label-row">
                    <span>Scroll</span>
                    <svg class="scroll-chevron-bounce" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
            </div>
        </div>
    </section>

    <div id="scroll-progress-bar"></div>
    <canvas id="hydrogen-canvas"></canvas>

    <!-- 3. LIVE STATS TICKER (Real DB Numbers) -->
    <section class="stats-grid" id="statistik">
        <!-- Stat 1: Saldo Kas -->
        <div class="glass-stat-card reveal delay-1">
            <div class="stat-icon stat-icon-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/>
                    <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/>
                </svg>
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
        <div class="glass-stat-card reveal delay-2">
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
        <div class="glass-stat-card reveal delay-3">
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
        <div class="glass-stat-card reveal delay-4">
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
    <script id="hydrogen-welcome-engine">
        (function() {
            function getThemePalette() {
                var t = document.documentElement.getAttribute('data-theme') || 'dark';
                if (t === 'light') {
                    return { dot: 'rgba(2, 132, 199, 0.42)', line: 'rgba(37, 99, 235, ', alpha: 0.14 };
                }
                if (t === 'twilight') {
                    return { dot: 'rgba(251, 191, 36, 0.45)', line: 'rgba(56, 189, 248, ', alpha: 0.17 };
                }
                return { dot: 'rgba(56, 189, 248, 0.58)', line: 'rgba(56, 189, 248, ', alpha: 0.19 };
            }

            function initHydrogenWelcome() {
                // 1. Top Scroll Progress Bar
                var bar = document.getElementById('scroll-progress-bar');
                if (bar) {
                    var updateBar = function() {
                        var docH = document.documentElement.scrollHeight - window.innerHeight;
                        var pct = docH > 0 ? Math.min(100, Math.max(0, (window.scrollY / docH) * 100)) : 0;
                        bar.style.width = pct.toFixed(1) + '%';
                    };
                    window.addEventListener('scroll', updateBar, { passive: true });
                    updateBar();
                }

                // 2. Hydrogen Interactive Particle Constellation Canvas
                var canvas = document.getElementById('hydrogen-canvas');
                if (canvas && canvas.getContext) {
                    var ctx = canvas.getContext('2d');
                    var w = 0, h = 0;
                    var mouse = { x: -9999, y: -9999 };
                    var count = window.innerWidth < 768 ? 20 : 46;
                    var pts = [];
                    var palette = getThemePalette();

                    var obs = new MutationObserver(function() {
                        palette = getThemePalette();
                    });
                    obs.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });

                    function resizeCanvas() {
                        w = canvas.width = window.innerWidth;
                        h = canvas.height = window.innerHeight;
                    }
                    resizeCanvas();
                    window.addEventListener('resize', resizeCanvas, { passive: true });
                    document.addEventListener('mousemove', function(e) {
                        mouse.x = e.clientX;
                        mouse.y = e.clientY;
                    }, { passive: true });

                    for (var i = 0; i < count; i++) {
                        pts.push({
                            x: Math.random() * (w || 1280),
                            y: Math.random() * (h || 800),
                            vx: (Math.random() - 0.5) * 0.48,
                            vy: (Math.random() - 0.5) * 0.48,
                            r: 1.4 + Math.random() * 1.9
                        });
                    }

                    function animateCanvas() {
                        ctx.clearRect(0, 0, w, h);
                        for (var i = 0; i < pts.length; i++) {
                            var p = pts[i];
                            p.x += p.vx;
                            p.y += p.vy;
                            if (p.x < 0 || p.x > w) p.vx *= -1;
                            if (p.y < 0 || p.y > h) p.vy *= -1;

                            var dxm = p.x - mouse.x, dym = p.y - mouse.y;
                            var dm = Math.sqrt(dxm * dxm + dym * dym);
                            if (dm < 145 && dm > 1) {
                                p.x += (dxm / dm) * 0.65;
                                p.y += (dym / dm) * 0.65;
                            }

                            ctx.beginPath();
                            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                            ctx.fillStyle = palette.dot;
                            ctx.fill();

                            for (var j = i + 1; j < pts.length; j++) {
                                var q = pts[j];
                                var dx = p.x - q.x, dy = p.y - q.y;
                                var dist = Math.sqrt(dx * dx + dy * dy);
                                if (dist < 135) {
                                    ctx.beginPath();
                                    ctx.moveTo(p.x, p.y);
                                    ctx.lineTo(q.x, q.y);
                                    ctx.strokeStyle = palette.line + ((1 - dist / 135) * palette.alpha).toFixed(3) + ')';
                                    ctx.lineWidth = 1;
                                    ctx.stroke();
                                }
                            }
                        }
                        requestAnimationFrame(animateCanvas);
                    }
                    animateCanvas();
                }

                // 3. Spotlight Radial Glow & Subtle 3D Tilt on Cards
                var isTouch = window.matchMedia && window.matchMedia('(pointer: coarse)').matches;
                document.querySelectorAll('.glass-stat-card, .feature-card, .hero-showcase-card').forEach(function(card) {
                    if (isTouch) return;
                    card.addEventListener('mousemove', function(e) {
                        var rect = card.getBoundingClientRect();
                        var x = e.clientX - rect.left;
                        var y = e.clientY - rect.top;
                        card.style.setProperty('--mx', x + 'px');
                        card.style.setProperty('--my', y + 'px');
                        var rx = ((y / rect.height) - 0.5) * -5;
                        var ry = ((x / rect.width) - 0.5) * 5;
                        card.style.transform = 'perspective(900px) rotateX(' + rx.toFixed(2) + 'deg) rotateY(' + ry.toFixed(2) + 'deg) translateY(-4px)';
                    });
                    card.addEventListener('mouseleave', function() {
                        card.style.transform = '';
                    });
                });

                // 4. Upgrade All Stat Card Icons with Crisp SVG Fallbacks & Animated Halo
                var statSvgs = [
                    null, // Card 1 already uses custom wallet SVG
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 19h14"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M3.22 12H9.5l1.5-3 2 6 1.5-3h5.28"/></svg>'
                ];
                document.querySelectorAll('.stats-grid .glass-stat-card .stat-icon').forEach(function(iconBox, idx) {
                    if (idx > 0 && statSvgs[idx]) {
                        iconBox.innerHTML = statSvgs[idx];
                    }
                });

                // 5. Upgrade Feature Card Icons into Crisp Custom SVG Artworks (matching exact 6 cards)
                var featureArtworks = [
                    '<svg width="32" height="32" viewBox="0 0 36 36" fill="none"><rect x="4" y="20" width="5" height="10" rx="2" fill="#34d399"/><rect x="12" y="14" width="5" height="16" rx="2" fill="#38bdf8"/><rect x="20" y="9" width="5" height="21" rx="2" fill="#a7f3d0"/><path d="M5 14L13 8L21 11L31 4" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    '<svg width="32" height="32" viewBox="0 0 36 36" fill="none"><path d="M29 19c2.2-2.2 4-4.7 4-8a7 7 0 0 0-12.5-4.3L18 9.5l-2.5-2.8A7 7 0 0 0 3 11c0 3.3 1.8 5.8 4 8l11 11 11-11Z" stroke="#ffffff" stroke-width="2" fill="rgba(255,255,255,0.16)"/><path d="M8 18h5l2.5-5 3.5 9 2.5-4h6" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    '<svg width="32" height="32" viewBox="0 0 36 36" fill="none"><circle cx="14" cy="12" r="4.5" stroke="#ffffff" stroke-width="2.2"/><path d="M5.5 29c0-4.4 3.8-8 8.5-8s8.5 3.6 8.5 8" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round"/><circle cx="26" cy="14" r="3" stroke="#bae6fd" stroke-width="2"/><path d="M25.5 21.5c3 .5 5.5 3 5.5 6.5" stroke="#bae6fd" stroke-width="2" stroke-linecap="round"/></svg>',
                    '<svg width="32" height="32" viewBox="0 0 36 36" fill="none"><rect x="6" y="5" width="24" height="26" rx="4" stroke="#ffffff" stroke-width="2.2" fill="rgba(255,255,255,0.12)"/><path d="M12 13h12M12 19h10M12 25h6" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round"/><circle cx="27" cy="26" r="5" fill="#34d399"/><path d="M24.8 26l1.5 1.5 3-3" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    '<svg width="32" height="32" viewBox="0 0 36 36" fill="none"><path d="M18 5l5 8h-4v7h-2v-7h-4l5-8Z" fill="#ffffff"/><path d="M8 25l-3-5 5-1 1.5 2.5 5-3 1 1.8-6.5 4.2-3 .5ZM28 25l3-5-5-1-1.5 2.5-5-3-1 1.8 6.5 4.2 3 .5Z" fill="#ccfbf1"/><path d="M11 29h14" stroke="#ffffff" stroke-width="2.4" stroke-linecap="round"/></svg>',
                    '<svg width="32" height="32" viewBox="0 0 36 36" fill="none"><path d="M6 12l12-6 12 6v14l-12 6-12-6V12Z" stroke="#ffffff" stroke-width="2.2" fill="rgba(255,255,255,0.14)"/><path d="M6 12l12 6 12-6M18 18v14" stroke="#ffffff" stroke-width="2"/></svg>'
                ];
                document.querySelectorAll('.features-grid .feature-card').forEach(function(card, idx) {
                    var iconWrap = card.querySelector('.feature-icon-wrapper, .feature-icon');
                    if (iconWrap && featureArtworks[idx]) {
                        iconWrap.innerHTML = featureArtworks[idx];
                    }
                });

                // 6. Smooth Number Count-Up Animation on Scroll
                if ('IntersectionObserver' in window) {
                    var counted = new WeakSet();
                    var countObserver = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (!entry.isIntersecting || counted.has(entry.target)) return;
                            counted.add(entry.target);
                            var el = entry.target;
                            // Preserve child span suffix if present (e.g. "9 Jiwa", "1 Balita")
                            var suffixSpan = el.querySelector('span');
                            if (suffixSpan) {
                                var firstNode = el.firstChild;
                                var numVal = firstNode ? parseInt((firstNode.textContent || '').replace(/\D/g, ''), 10) : 0;
                                if (!numVal || numVal <= 0) return;
                                var durShort = 900;
                                var t0 = performance.now();
                                function stepShort(now) {
                                    var p = Math.min(1, (now - t0) / durShort);
                                    var ease = 1 - Math.pow(1 - p, 4);
                                    if (firstNode) firstNode.textContent = Math.round(numVal * ease) + ' ';
                                    if (p < 1) requestAnimationFrame(stepShort);
                                    else if (firstNode) firstNode.textContent = numVal + ' ';
                                }
                                requestAnimationFrame(stepShort);
                                return;
                            }
                            var raw = el.textContent.trim();
                            var match = raw.match(/^(Rp\s*)?([0-9][0-9.]*)(.*)$/);
                            if (!match) return;
                            var prefix = match[1] || '';
                            var target = parseInt(match[2].replace(/\./g, ''), 10);
                            var suffix = match[3] || '';
                            if (!target || target <= 0) return;

                            var duration = 1100;
                            var start = performance.now();
                            function step(now) {
                                var p = Math.min(1, (now - start) / duration);
                                var ease = 1 - Math.pow(1 - p, 4);
                                var val = Math.round(target * ease);
                                el.textContent = prefix + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + suffix;
                                if (p < 1) {
                                    requestAnimationFrame(step);
                                } else {
                                    el.textContent = raw;
                                }
                            }
                            requestAnimationFrame(step);
                        });
                    }, { threshold: 0.35 });

                    document.querySelectorAll('.stats-grid .stat-val, .stats-grid .stat-value').forEach(function(el) {
                        countObserver.observe(el);
                    });
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initHydrogenWelcome);
            } else {
                initHydrogenWelcome();
            }
        })();
    </script>

    <section class="features-section reveal" id="ekosistem">
        <div class="section-header">
            <div class="section-badge">EKOSISTEM SMART RT</div>
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
        <div style="margin-top:14px; display:flex; align-items:center; justify-content:center; gap:14px; flex-wrap:wrap;">
            <span style="font-size:12px; color:#475569; font-weight:600; letter-spacing:0.5px;">Developer:</span>
            <a href="https://www.instagram.com/poelnextdoor" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:7px;padding:7px 16px;border-radius:30px;
                      background:linear-gradient(135deg,rgba(225,48,108,0.15),rgba(131,58,180,0.15));
                      border:1px solid rgba(225,48,108,0.35);color:#f9a8d4;
                      font-size:12.5px;font-weight:700;text-decoration:none;
                      transition:all 0.25s;font-family:'Plus Jakarta Sans',sans-serif;"
               onmouseover="this.style.background='linear-gradient(135deg,rgba(225,48,108,0.28),rgba(131,58,180,0.28))';this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(225,48,108,0.3)'"
               onmouseout="this.style.background='linear-gradient(135deg,rgba(225,48,108,0.15),rgba(131,58,180,0.15))';this.style.transform='';this.style.boxShadow=''">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="20" height="20" rx="6" stroke="#f9a8d4" stroke-width="2"/>
                    <circle cx="12" cy="12" r="4" stroke="#f9a8d4" stroke-width="2"/>
                    <circle cx="17.5" cy="6.5" r="1.3" fill="#f9a8d4"/>
                </svg>
                @poelnextdoor
            </a>
            <a href="https://www.tiktok.com/@poelnextdoor" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:7px;padding:7px 16px;border-radius:30px;
                      background:rgba(45,212,191,0.1);
                      border:1px solid rgba(45,212,191,0.35);color:#5eead4;
                      font-size:12.5px;font-weight:700;text-decoration:none;
                      transition:all 0.25s;font-family:'Plus Jakarta Sans',sans-serif;"
               onmouseover="this.style.background='rgba(45,212,191,0.22)';this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(45,212,191,0.3)'"
               onmouseout="this.style.background='rgba(45,212,191,0.1)';this.style.transform='';this.style.boxShadow=''">
                <svg width="13" height="15" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.59 7.69a5.83 5.83 0 0 1-3.77-4.25V3h-3.45v14.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1v-3.48a6.34 6.34 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V9.84a8.17 8.17 0 0 0 4.78 1.52V7.89a4.85 4.85 0 0 1-1.01-.2z" fill="#5eead4"/>
                </svg>
                @poelnextdoor
            </a>
        </div>
    </footer>

    {{-- ===== ANIMATION ENGINE ===== --}}
    <script>
    (function() {

        /* ── 1. SCROLL PROGRESS BAR ── */
        var prog = document.getElementById('scroll-progress');
        window.addEventListener('scroll', function() {
            var scrolled = document.documentElement.scrollTop;
            var total = document.documentElement.scrollHeight - window.innerHeight;
            if (prog) prog.style.width = (total > 0 ? (scrolled / total * 100) : 0) + '%';
        }, { passive: true });

        /* ── 2. NAVBAR SHRINK ON SCROLL ── */
        var navbar = document.querySelector('.glass-navbar');
        window.addEventListener('scroll', function() {
            if (navbar) {
                if (window.scrollY > 60) navbar.classList.add('scrolled');
                else navbar.classList.remove('scrolled');
            }
        }, { passive: true });

        /* ── 3. SCROLL REVEAL (Intersection Observer) ── */
        var revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        if (revealEls.length > 0 && 'IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
            revealEls.forEach(function(el) { observer.observe(el); });
        } else {
            revealEls.forEach(function(el) { el.classList.add('visible'); });
        }

        /* ── 4. PARTICLE SYSTEM ── */
        var canvas = document.getElementById('particle-canvas');
        if (canvas) {
            var ctx = canvas.getContext('2d');
            var particles = [];
            var W, H;

            function resize() {
                W = canvas.width  = window.innerWidth;
                H = canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', resize, { passive: true });

            var PARTICLE_COUNT = window.innerWidth < 768 ? 35 : 65;
            var colors = ['rgba(2,132,199,', 'rgba(56,189,248,', 'rgba(52,211,153,', 'rgba(129,140,248,', 'rgba(45,212,191,'];

            function rand(min, max) { return Math.random() * (max - min) + min; }

            for (var i = 0; i < PARTICLE_COUNT; i++) {
                particles.push({
                    x:    rand(0, window.innerWidth),
                    y:    rand(0, window.innerHeight),
                    r:    rand(1, 2.8),
                    dx:   rand(-0.25, 0.25),
                    dy:   rand(-0.35, -0.08),
                    op:   rand(0.15, 0.6),
                    dop:  rand(0.003, 0.008),
                    col:  colors[Math.floor(rand(0, colors.length))]
                });
            }

            var mouseX = -9999, mouseY = -9999;
            window.addEventListener('mousemove', function(e) {
                mouseX = e.clientX; mouseY = e.clientY;
            }, { passive: true });

            function loop() {
                ctx.clearRect(0, 0, W, H);
                for (var j = 0; j < particles.length; j++) {
                    var p = particles[j];
                    var ddx = p.x - mouseX, ddy = p.y - mouseY;
                    var dist = Math.sqrt(ddx*ddx + ddy*ddy);
                    if (dist < 100) {
                        var force = (100 - dist) / 100 * 0.4;
                        p.x += ddx / dist * force;
                        p.y += ddy / dist * force;
                    }
                    p.x += p.dx;
                    p.y += p.dy;
                    p.op += p.dop;
                    if (p.op >= 0.6 || p.op <= 0.1) p.dop *= -1;
                    if (p.y < -10) { p.y = H + 5; p.x = rand(0, W); }
                    if (p.x < -10) p.x = W + 5;
                    if (p.x > W + 10) p.x = -5;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.fillStyle = p.col + p.op + ')';
                    ctx.fill();
                }
                for (var a = 0; a < particles.length; a++) {
                    for (var b = a+1; b < particles.length; b++) {
                        var cx = particles[a].x - particles[b].x;
                        var cy = particles[a].y - particles[b].y;
                        var d = Math.sqrt(cx*cx + cy*cy);
                        if (d < 110) {
                            ctx.beginPath();
                            ctx.moveTo(particles[a].x, particles[a].y);
                            ctx.lineTo(particles[b].x, particles[b].y);
                            ctx.strokeStyle = 'rgba(56,189,248,' + (0.07 * (1 - d/110)) + ')';
                            ctx.lineWidth = 0.6;
                            ctx.stroke();
                        }
                    }
                }
                requestAnimationFrame(loop);
            }
            loop();
        }

        /* ── 5. TYPING EFFECT ON HERO PILL ── */
        var pill = document.querySelector('.hero-pill');
        if (pill) {
            var pillText = pill.textContent.trim();
            pill.innerHTML = '<span class="pulse-live"></span><span id="typed-pill"></span>';
            var typedEl = document.getElementById('typed-pill');
            var ti = 0;
            function typePill() {
                if (ti <= pillText.length) {
                    typedEl.textContent = pillText.slice(0, ti);
                    ti++;
                    setTimeout(typePill, ti < 3 ? 0 : 38);
                }
            }
            setTimeout(typePill, 600);
        }

        /* ── 6. RIPPLE on button click ── */
        document.querySelectorAll('.btn-cta-primary, .btn-cta-secondary, .btn-nav-solid, .btn-nav-outline').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                var ripple = document.createElement('span');
                ripple.style.cssText = 'position:absolute;border-radius:50%;background:rgba(255,255,255,0.3);transform:scale(0);animation:rippleAnim 0.6s linear;pointer-events:none;';
                var rect = btn.getBoundingClientRect();
                var size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
                ripple.style.top  = (e.clientY - rect.top  - size/2) + 'px';
                btn.appendChild(ripple);
                setTimeout(function() { ripple.remove(); }, 700);
            });
        });
        var rippleStyle = document.createElement('style');
        rippleStyle.textContent = '@keyframes rippleAnim { to { transform: scale(2.5); opacity: 0; } }';
        document.head.appendChild(rippleStyle);

        /* ── 7. TILT EFFECT on feature cards (desktop only) ── */
        if (window.innerWidth > 768) {
            document.querySelectorAll('.feature-card, .glass-stat-card').forEach(function(card) {
                card.addEventListener('mousemove', function(e) {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var cx = rect.width / 2;
                    var cy = rect.height / 2;
                    var rotX = ((y - cy) / cy) * -6;
                    var rotY = ((x - cx) / cx) *  6;
                    card.style.transform = 'translateY(-6px) perspective(600px) rotateX(' + rotX + 'deg) rotateY(' + rotY + 'deg)';
                });
                card.addEventListener('mouseleave', function() {
                    card.style.transition = 'transform 0.4s ease';
                    card.style.transform = '';
                    setTimeout(function() { card.style.transition = ''; }, 400);
                });
            });
        }

        /* ── 8. HEARTBEAT ICON on Posyandu stat card ── */
        var heartIcon = document.querySelector('.stat-icon-teal .fa-heartbeat');
        if (heartIcon) {
            heartIcon.style.animation = 'heartbeat 1.2s ease-in-out infinite';
            var hbStyle = document.createElement('style');
            hbStyle.textContent = '@keyframes heartbeat{0%,100%{transform:scale(1)}14%{transform:scale(1.3)}28%{transform:scale(1)}42%{transform:scale(1.2)}56%{transform:scale(1)}}';
            document.head.appendChild(hbStyle);
        }

    })();
    </script>
    {{-- ===== END ANIMATION ENGINE ===== --}}

    {{-- ===== THEME ENGINE ===== --}}
    <script>
    window.KasBotTheme = (function() {
        var root    = document.documentElement;
        var body    = document.body;
        var orb1    = document.querySelector('.orb-1');
        var orb2    = document.querySelector('.orb-2');
        var orb3    = document.querySelector('.orb-3');
        var prog    = document.getElementById('scroll-progress');
        var flash   = document.getElementById('theme-flash');
        var toast   = document.getElementById('theme-toast');
        var ttEmoji = document.getElementById('tt-emoji');
        var ttName  = document.getElementById('tt-name');

        var themeIdx = 0;

        var themes = [
            {
                name: 'Ocean Blue', emoji: '🌊',
                bg: '#060b17',
                accent: '#0284c7', accent2: '#2563eb', light: '#38bdf8',
                o1: 'radial-gradient(circle, rgba(2,132,199,0.75) 0%, rgba(37,99,235,0.1) 70%)',
                o2: 'radial-gradient(circle, rgba(16,185,129,0.6) 0%, rgba(6,182,212,0.08) 70%)',
                o3: 'radial-gradient(circle, rgba(124,58,237,0.5) 0%, rgba(219,39,119,0.05) 70%)',
                prog: 'linear-gradient(90deg,#0284c7,#38bdf8,#34d399,#818cf8)',
                flash: 'rgba(2,132,199,0.6)',
            },
            {
                name: 'Cosmic Purple', emoji: '🔮',
                bg: '#0a0618',
                accent: '#7c3aed', accent2: '#6d28d9', light: '#c084fc',
                o1: 'radial-gradient(circle, rgba(124,58,237,0.75) 0%, rgba(109,40,217,0.1) 70%)',
                o2: 'radial-gradient(circle, rgba(236,72,153,0.6) 0%, rgba(167,139,250,0.08) 70%)',
                o3: 'radial-gradient(circle, rgba(239,68,68,0.5) 0%, rgba(124,58,237,0.05) 70%)',
                prog: 'linear-gradient(90deg,#7c3aed,#c084fc,#f472b6,#a78bfa)',
                flash: 'rgba(124,58,237,0.6)',
            },
            {
                name: 'Matrix Green', emoji: '💚',
                bg: '#010f08',
                accent: '#059669', accent2: '#047857', light: '#34d399',
                o1: 'radial-gradient(circle, rgba(5,150,105,0.75) 0%, rgba(4,120,87,0.1) 70%)',
                o2: 'radial-gradient(circle, rgba(16,185,129,0.6) 0%, rgba(6,182,212,0.08) 70%)',
                o3: 'radial-gradient(circle, rgba(6,182,212,0.5) 0%, rgba(5,150,105,0.05) 70%)',
                prog: 'linear-gradient(90deg,#059669,#34d399,#67e8f9,#a7f3d0)',
                flash: 'rgba(5,150,105,0.6)',
            },
            {
                name: 'Solar Flare', emoji: '🔥',
                bg: '#0f0702',
                accent: '#d97706', accent2: '#b45309', light: '#fbbf24',
                o1: 'radial-gradient(circle, rgba(217,119,6,0.75) 0%, rgba(180,83,9,0.1) 70%)',
                o2: 'radial-gradient(circle, rgba(251,191,36,0.6) 0%, rgba(239,68,68,0.08) 70%)',
                o3: 'radial-gradient(circle, rgba(239,68,68,0.5) 0%, rgba(217,119,6,0.05) 70%)',
                prog: 'linear-gradient(90deg,#d97706,#fbbf24,#f97316,#ef4444)',
                flash: 'rgba(217,119,6,0.6)',
            },
            {
                name: 'Cherry Blossom', emoji: '🌸',
                bg: '#0f0208',
                accent: '#e11d48', accent2: '#be123c', light: '#fb7185',
                o1: 'radial-gradient(circle, rgba(225,29,72,0.75) 0%, rgba(190,18,60,0.1) 70%)',
                o2: 'radial-gradient(circle, rgba(244,114,182,0.6) 0%, rgba(251,113,133,0.08) 70%)',
                o3: 'radial-gradient(circle, rgba(236,72,153,0.5) 0%, rgba(225,29,72,0.05) 70%)',
                prog: 'linear-gradient(90deg,#e11d48,#fb7185,#f472b6,#c084fc)',
                flash: 'rgba(225,29,72,0.6)',
            },
            {
                name: 'Neon Cyan', emoji: '⚡',
                bg: '#010d12',
                accent: '#0891b2', accent2: '#0e7490', light: '#67e8f9',
                o1: 'radial-gradient(circle, rgba(8,145,178,0.75) 0%, rgba(14,116,144,0.1) 70%)',
                o2: 'radial-gradient(circle, rgba(45,212,191,0.6) 0%, rgba(103,232,249,0.08) 70%)',
                o3: 'radial-gradient(circle, rgba(16,185,129,0.5) 0%, rgba(8,145,178,0.05) 70%)',
                prog: 'linear-gradient(90deg,#0891b2,#67e8f9,#2dd4bf,#a7f3d0)',
                flash: 'rgba(8,145,178,0.6)',
            },
        ];

        function applyTheme(t, fromCenter) {
            // 1. Background
            body.style.background = t.bg;

            // 2. CSS vars
            root.style.setProperty('--primary-accent', t.accent);
            root.style.setProperty('--kb-accent',  t.accent);
            root.style.setProperty('--kb-accent2', t.accent2);
            root.style.setProperty('--kb-light',   t.light);

            // 3. Orb colors
            if (orb1) orb1.style.background = t.o1;
            if (orb2) orb2.style.background = t.o2;
            if (orb3) orb3.style.background = t.o3;

            // 4. Scroll progress bar gradient
            if (prog) prog.style.backgroundImage = t.prog;

            // 5. Recolor buttons (primary)
            document.querySelectorAll('.btn-cta-primary, .btn-nav-solid').forEach(function(el) {
                el.style.background = 'linear-gradient(135deg,' + t.accent + ' 0%,' + t.accent2 + ' 100%)';
                el.style.boxShadow  = '0 10px 30px -4px ' + t.accent + '88';
            });

            // 6. Brand logo box
            var logoBox = document.querySelector('.brand-logo-box');
            if (logoBox) logoBox.style.background = 'linear-gradient(135deg,' + t.accent + ' 0%,' + t.accent2 + ' 100%)';

            // 7. Gradient text animation (update gradient)
            document.querySelectorAll('.gradient-text').forEach(function(el) {
                el.style.backgroundImage = 'linear-gradient(135deg,' + t.light + ' 0%,' + t.accent + ' 50%,' + t.light + ' 100%)';
            });

            // 8. Section badges & accent text
            document.querySelectorAll('.section-badge, .brand-title-group span, .hero-pill').forEach(function(el) {
                el.style.color = t.light;
            });

            // 9. Hero pill border
            document.querySelectorAll('.hero-pill').forEach(function(el) {
                el.style.borderColor = t.light + '44';
            });

            // 10. KasBot SVG accent (iris, antenna)
            var irisL = document.getElementById('kb-iris-l');
            var irisR = document.getElementById('kb-iris-r');
            var antDot = document.getElementById('kb-antenna-dot');
            if (irisL) irisL.setAttribute('fill', t.light);
            if (irisR) irisR.setAttribute('fill', t.light);
            if (antDot) antDot.setAttribute('fill', t.light);

            // 11. KasBot SVG drop shadow & 3D character theme broadcast
            var svg = document.getElementById('kasbot-svg');
            if (svg) svg.style.filter = 'drop-shadow(0 8px 24px ' + t.accent + '99)';
            try {
                window.dispatchEvent(new CustomEvent('kasbot:theme', { detail: t }));
            } catch (e) {}
        }

        function triggerFlash(t) {
            if (!flash) return;
            // Position flash at robot center
            var wrap = document.getElementById('kasbot-wrap');
            if (wrap) {
                var rect = wrap.getBoundingClientRect();
                var cx = rect.left + rect.width/2;
                var cy = rect.top  + rect.height/2;
                flash.style.left   = cx + 'px';
                flash.style.top    = cy + 'px';
                flash.style.width  = '4px';
                flash.style.height = '4px';
                flash.style.marginLeft = '-2px';
                flash.style.marginTop  = '-2px';
            }
            flash.style.background = t.flash;
            flash.classList.remove('burst');
            void flash.offsetWidth;
            flash.classList.add('burst');
        }

        function triggerToast(t) {
            if (!toast) return;
            ttEmoji.textContent = t.emoji;
            ttName.textContent  = t.name;
            toast.style.borderColor = t.light;
            ttName.style.color      = t.light;
            toast.classList.remove('show');
            void toast.offsetWidth;
            toast.classList.add('show');
            setTimeout(function(){ toast.classList.remove('show'); }, 2600);
        }

        return {
            nextTheme: function() {
                themeIdx = (themeIdx + 1) % themes.length;
                var t = themes[themeIdx];
                triggerFlash(t);
                setTimeout(function() { applyTheme(t); }, 300);
                triggerToast(t);
            },
            currentIdx: function() { return themeIdx; },
            themes: themes,
        };
    })();
    </script>
    {{-- ===== END THEME ENGINE ===== --}}

    {{-- ===== KASBOT MASCOT ===== --}}
    <style>
    /* ── KasBot Container — Zero Gravity ── */
    #kasbot-wrap {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 10000;
        user-select: none;
        touch-action: none;
        cursor: grab;
        will-change: left, top, transform;
        transform-origin: center center;
    }
    #kasbot-wrap:active { cursor: grabbing; }

    /* ── Speech Bubble — dynamically positioned by JS ── */
    #kasbot-bubble {
        position: absolute;
        bottom: calc(100% + 14px);
        left: 50%;
        transform: translateX(-50%) translateY(10px) scale(0.9);
        min-width: 180px;
        max-width: 240px;
        background: rgba(2,20,50,0.92);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(56,189,248,0.5);
        border-radius: 18px 18px 18px 4px;
        padding: 10px 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12.5px;
        font-weight: 600;
        color: #e0f2fe;
        line-height: 1.5;
        box-shadow: 0 8px 32px rgba(2,132,199,0.3);
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        pointer-events: none;
        text-align: center;
        white-space: pre-line;
    }
    #kasbot-bubble.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0) scale(1);
    }
    #kasbot-bubble::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 20px;
        width: 14px; height: 14px;
        background: rgba(2,20,50,0.92);
        border-right: 1px solid rgba(56,189,248,0.5);
        border-bottom: 1px solid rgba(56,189,248,0.5);
        transform: rotate(45deg);
        border-radius: 0 0 3px 0;
    }

    /* ── Tap Counter Badge ── */
    #kasbot-counter {
        position: absolute;
        top: -6px;
        left: -6px;
        min-width: 22px;
        height: 22px;
        border-radius: 11px;
        background: linear-gradient(135deg,#ef4444,#f97316);
        color: #fff;
        font-family: 'JetBrains Mono', monospace;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 5px;
        box-shadow: 0 3px 12px rgba(239,68,68,0.5);
        opacity: 0;
        transform: scale(0);
        transition: all 0.25s cubic-bezier(.22,.68,0,1.4);
    }
    #kasbot-counter.show {
        opacity: 1;
        transform: scale(1);
    }

    /* ── KasBot Inner (animation target, isolated from physics) ── */
    #kasbot-inner {
        display: block;
        transform-origin: center center;
        will-change: transform;
    }

    /* ── KasBot SVG Animations ── */
    #kasbot-svg { display: block; filter: drop-shadow(0 8px 24px rgba(2,132,199,0.6)); }

    /* Body breathe */
    @keyframes kbBreathe {
        0%,100% { transform: scaleY(1); }
        50%      { transform: scaleY(1.03); }
    }
    #kb-body-group { transform-origin: center center; animation: kbBreathe 3s ease-in-out infinite; }

    /* Antenna spark */
    @keyframes kbAntennaGlow {
        0%,100% { r: 4; opacity: 1; }
        50%      { r: 7; opacity: 0.5; }
    }
    #kb-antenna-dot { animation: kbAntennaGlow 1.4s ease-in-out infinite; }

    /* Squash on wall hit — applied to #kasbot-inner */
    @keyframes kbSquashX {
        0%   { transform: scaleX(1)    scaleY(1); }
        30%  { transform: scaleX(0.65) scaleY(1.25); }
        65%  { transform: scaleX(1.1)  scaleY(0.93); }
        100% { transform: scaleX(1)    scaleY(1); }
    }
    @keyframes kbSquashY {
        0%   { transform: scaleX(1)    scaleY(1); }
        30%  { transform: scaleX(1.25) scaleY(0.65); }
        65%  { transform: scaleX(0.93) scaleY(1.1); }
        100% { transform: scaleX(1)    scaleY(1); }
    }
    #kasbot-inner.squash-x { animation: kbSquashX 0.35s cubic-bezier(.22,.68,0,1.2) both; }
    #kasbot-inner.squash-y { animation: kbSquashY 0.35s cubic-bezier(.22,.68,0,1.2) both; }

    /* Tap burst — applied to #kasbot-inner */
    @keyframes kbTapBurst {
        0%   { transform: scale(1) rotate(0deg); }
        25%  { transform: scale(1.3) rotate(6deg); }
        60%  { transform: scale(0.88) rotate(-4deg); }
        85%  { transform: scale(1.05) rotate(1deg); }
        100% { transform: scale(1) rotate(0deg); }
    }
    #kasbot-inner.tap-burst { animation: kbTapBurst 0.45s cubic-bezier(.22,.68,0,1.4) both; }

    /* Spin — applied to #kasbot-inner */
    @keyframes kbSpin {
        from { transform: rotate(0deg) scale(1); }
        50%  { transform: rotate(180deg) scale(1.2); }
        to   { transform: rotate(360deg) scale(1); }
    }
    #kasbot-inner.spin { animation: kbSpin 0.5s cubic-bezier(.22,.68,0,1) both; }

    /* Sleep zZz */
    .kb-zzz {
        position: absolute;
        font-size: 14px;
        font-weight: 900;
        color: #38bdf8;
        opacity: 0;
        pointer-events: none;
        animation: kbZzz 2s ease-in-out infinite;
    }
    .kb-zzz:nth-child(2) { animation-delay: 0.6s; font-size: 11px; }
    .kb-zzz:nth-child(3) { animation-delay: 1.2s; font-size: 9px; }
    @keyframes kbZzz {
        0%   { opacity:0; transform: translate(0,0) scale(0.5); }
        30%  { opacity:1; }
        100% { opacity:0; transform: translate(14px,-28px) scale(1.1); }
    }
    #kb-zzz-wrap {
        position: absolute;
        top: -10px; right: -4px;
        display: none;
        flex-direction: column;
        align-items: flex-start;
        gap: 2px;
    }
    #kb-zzz-wrap.show { display: flex; }
    </style>

    <!-- KasBot Mascot HTML -->
    <div id="kasbot-wrap" title="Klik aku!">

        <!-- Speech Bubble -->
        <div id="kasbot-bubble"></div>

        <!-- Tap Counter -->
        <div id="kasbot-counter">0</div>

        <!-- Sleep ZZz -->
        <div id="kb-zzz-wrap">
            <span class="kb-zzz" style="margin-left:4px">Z</span>
            <span class="kb-zzz" style="margin-left:10px">z</span>
            <span class="kb-zzz" style="margin-left:16px">z</span>
        </div>

        <!-- Inner wrapper — isolates CSS tap animations from physics transform -->
        <div id="kasbot-inner" style="position:relative; width:128px; height:148px;">
        <!-- Real-Time Three.js 3D Character Canvas for KasBot -->
        <canvas id="kasbot-3d-canvas" width="128" height="148" style="display:block; width:128px; height:148px; pointer-events:none; position:relative; z-index:2; filter:drop-shadow(0 12px 26px rgba(2,132,199,0.5));"></canvas>
        <!-- SVG Robot (instant paint & WebGL fallback) -->
        <svg id="kasbot-svg" width="96" height="120" viewBox="0 0 96 120" xmlns="http://www.w3.org/2000/svg" style="position:absolute; left:16px; top:14px; z-index:1; pointer-events:none; transition:opacity 0.35s ease;">
            <defs>
                <linearGradient id="kbBodyGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%"   stop-color="#0ea5e9"/>
                    <stop offset="100%" stop-color="#2563eb"/>
                </linearGradient>
                <linearGradient id="kbHeadGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%"   stop-color="#38bdf8"/>
                    <stop offset="100%" stop-color="#0284c7"/>
                </linearGradient>
                <linearGradient id="kbFaceGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%"   stop-color="#0f172a" stop-opacity="0.9"/>
                    <stop offset="100%" stop-color="#020617" stop-opacity="0.95"/>
                </linearGradient>
                <radialGradient id="kbGlow" cx="50%" cy="50%" r="50%">
                    <stop offset="0%"  stop-color="#38bdf8" stop-opacity="0.3"/>
                    <stop offset="100%" stop-color="#38bdf8" stop-opacity="0"/>
                </radialGradient>
                <filter id="kbShadow" x="-20%" y="-20%" width="140%" height="140%">
                    <feDropShadow dx="0" dy="4" stdDeviation="4" flood-color="#0284c7" flood-opacity="0.5"/>
                </filter>
                <filter id="kbGlowF">
                    <feGaussianBlur stdDeviation="2.5" result="coloredBlur"/>
                    <feMerge><feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
                <clipPath id="kbFaceClip">
                    <rect x="14" y="14" width="68" height="58" rx="16"/>
                </clipPath>
            </defs>

            <!-- Body Group (breathing) -->
            <g id="kb-body-group">

                <!-- Legs -->
                <rect x="26" y="96" width="14" height="20" rx="7" fill="url(#kbBodyGrad)" filter="url(#kbShadow)"/>
                <rect x="56" y="96" width="14" height="20" rx="7" fill="url(#kbBodyGrad)" filter="url(#kbShadow)"/>
                <!-- Feet -->
                <ellipse cx="33" cy="115" rx="10" ry="5" fill="#1d4ed8"/>
                <ellipse cx="63" cy="115" rx="10" ry="5" fill="#1d4ed8"/>

                <!-- Body -->
                <rect x="18" y="62" width="60" height="40" rx="16" fill="url(#kbBodyGrad)" filter="url(#kbShadow)"/>
                <!-- Body glass shine -->
                <rect x="22" y="66" width="52" height="14" rx="8" fill="rgba(255,255,255,0.12)"/>
                <!-- Chest panel -->
                <rect x="30" y="80" width="36" height="16" rx="8" fill="rgba(0,0,0,0.3)" stroke="rgba(56,189,248,0.5)" stroke-width="1"/>
                <!-- Chest LEDs -->
                <circle cx="38" cy="88" r="4" fill="#34d399" id="kb-led1"/>
                <circle cx="48" cy="88" r="4" fill="#38bdf8" id="kb-led2"/>
                <circle cx="58" cy="88" r="4" fill="#818cf8" id="kb-led3"/>

                <!-- Arms -->
                <rect x="2"  y="68" width="16" height="28" rx="8" fill="url(#kbBodyGrad)" filter="url(#kbShadow)" id="kb-arm-l"/>
                <rect x="78" y="68" width="16" height="28" rx="8" fill="url(#kbBodyGrad)" filter="url(#kbShadow)" id="kb-arm-r"/>
                <!-- Hands -->
                <circle cx="10"  cy="96" r="8" fill="#1e40af"/>
                <circle cx="86" cy="96" r="8" fill="#1e40af"/>

                <!-- Neck -->
                <rect x="38" y="56" width="20" height="12" rx="6" fill="#1e40af"/>

                <!-- Head -->
                <rect x="10" y="8" width="76" height="52" rx="20" fill="url(#kbHeadGrad)" filter="url(#kbShadow)"/>
                <!-- Head glass shine -->
                <rect x="14" y="11" width="58" height="12" rx="8" fill="rgba(255,255,255,0.18)"/>

                <!-- Face screen -->
                <rect x="14" y="18" width="68" height="38" rx="13" fill="url(#kbFaceGrad)" stroke="rgba(56,189,248,0.6)" stroke-width="1.5"/>

                <!-- Eyes (default: open circles) -->
                <g id="kb-eyes">
                    <!-- Left Eye -->
                    <g id="kb-eye-l">
                        <circle cx="31" cy="34" r="10" fill="#0f172a" stroke="#38bdf8" stroke-width="1.5"/>
                        <circle cx="31" cy="34" r="6"  fill="#38bdf8" id="kb-iris-l"/>
                        <circle cx="31" cy="34" r="3"  fill="#0f172a"/>
                        <circle cx="34" cy="31" r="2"  fill="white" opacity="0.8"/>
                        <circle cx="28" cy="37" r="1.2" fill="white" opacity="0.4"/>
                    </g>
                    <!-- Right Eye -->
                    <g id="kb-eye-r">
                        <circle cx="65" cy="34" r="10" fill="#0f172a" stroke="#38bdf8" stroke-width="1.5"/>
                        <circle cx="65" cy="34" r="6"  fill="#38bdf8" id="kb-iris-r"/>
                        <circle cx="65" cy="34" r="3"  fill="#0f172a"/>
                        <circle cx="68" cy="31" r="2"  fill="white" opacity="0.8"/>
                        <circle cx="62" cy="37" r="1.2" fill="white" opacity="0.4"/>
                    </g>
                </g>

                <!-- Mouth (default smile) -->
                <g id="kb-mouth">
                    <path id="kb-mouth-path" d="M 33 48 Q 48 56 63 48" stroke="#34d399" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </g>

                <!-- Cheeks blush -->
                <ellipse id="kb-blush-l" cx="20" cy="40" rx="7" ry="4" fill="rgba(251,113,133,0.35)" opacity="0"/>
                <ellipse id="kb-blush-r" cx="76" cy="40" rx="7" ry="4" fill="rgba(251,113,133,0.35)" opacity="0"/>

                <!-- Antenna -->
                <line x1="48" y1="8" x2="48" y2="0" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round"/>
                <circle id="kb-antenna-dot" cx="48" cy="-2" r="4" fill="#38bdf8" filter="url(#kbGlowF)"/>

                <!-- Ear bolts -->
                <circle cx="10" cy="30" r="5" fill="#1e40af" stroke="rgba(56,189,248,0.6)" stroke-width="1"/>
                <circle cx="86" cy="30" r="5" fill="#1e40af" stroke="rgba(56,189,248,0.6)" stroke-width="1"/>

            </g><!-- /body-group -->
        </svg>
        </div><!-- /#kasbot-inner -->
    </div>

    <script>
    (function() {
        var wrap    = document.getElementById('kasbot-wrap');
        var inner   = document.getElementById('kasbot-inner'); // ← CSS animation target
        var bubble  = document.getElementById('kasbot-bubble');
        var counter = document.getElementById('kasbot-counter');
        var zzzWrap = document.getElementById('kb-zzz-wrap');
        var eyeL    = document.getElementById('kb-eye-l');
        var eyeR    = document.getElementById('kb-eye-r');
        var mouth   = document.getElementById('kb-mouth-path');
        var blushL  = document.getElementById('kb-blush-l');
        var blushR  = document.getElementById('kb-blush-r');
        var irisL   = document.getElementById('kb-iris-l');
        var irisR   = document.getElementById('kb-iris-r');
        var led1    = document.getElementById('kb-led1');
        var led2    = document.getElementById('kb-led2');
        var led3    = document.getElementById('kb-led3');
        var armL    = document.getElementById('kb-arm-l');
        var armR    = document.getElementById('kb-arm-r');

        var W = 128, H = 148;

        /* ══════════════════════════════════════════
           ZERO-GRAVITY PHYSICS ENGINE
        ══════════════════════════════════════════ */
        var px, py, vx, vy, rotation = 0, angVel = 0;
        var DAMPING = 0.995, BOUNCE = 0.72, ANG_DAMP = 0.97;
        var physicsRunning = true;
        var isDragging = false;
        var tapCount = 0, isSleeping = false;
        var sleepTimer = null, bubbleTimer = null, faceTimer = null;
        var msgIdx = 0;

        // Safe bottom-left spawn — use clientHeight for reliable VH, clamp to safe zone
        var _vw = document.documentElement.clientWidth  || window.innerWidth  || 1024;
        var _vh = document.documentElement.clientHeight || window.innerHeight || 768;
        px = Math.max(20, Math.min(64, _vw * 0.04));
        py = Math.max(200, _vh - H - 36);
        vx = 0.65;
        vy = -0.35;
        angVel = 0;

        window.__kbPhysicsState = { px: px, py: py, vx: vx, vy: vy, isSleeping: false, face: 'normal', drag: false };

        function applyTransform() {
            wrap.style.left      = Math.round(px) + 'px';
            wrap.style.top       = Math.round(py) + 'px';
            wrap.style.transform = 'rotate(' + rotation.toFixed(2) + 'deg)';
            if (window.__kbPhysicsState) {
                window.__kbPhysicsState.px = px;
                window.__kbPhysicsState.py = py;
                window.__kbPhysicsState.vx = vx;
                window.__kbPhysicsState.vy = vy;
                window.__kbPhysicsState.isSleeping = isSleeping;
                window.__kbPhysicsState.drag = isDragging;
            }
        }
        applyTransform();

        function physicsLoop() {
            var VW = window.innerWidth;
            var VH = window.innerHeight;

            if (!isDragging) {
                // Apply velocity
                px += vx;
                py += vy;

                // Apply damping
                vx *= DAMPING;
                vy *= DAMPING;
                angVel *= ANG_DAMP;
                rotation += angVel;

                // Gently return rotation to 0 when nearly stopped
                var speed = Math.sqrt(vx*vx + vy*vy);
                if (speed < 1.2) {
                    rotation *= 0.97;
                    angVel  *= 0.93;
                }

                // Wall bounce
                var hitX = false, hitY = false;
                if (px <= 0) {
                    px = 0;
                    vx = Math.abs(vx) * BOUNCE + 0.5; // small extra kick to unstick
                    angVel += (Math.random() - 0.5) * 2;
                    hitX = true;
                }
                if (px >= VW - W) {
                    px = VW - W;
                    vx = -(Math.abs(vx) * BOUNCE + 0.5);
                    angVel += (Math.random() - 0.5) * 2;
                    hitX = true;
                }
                if (py <= 0) {
                    py = 0;
                    vy = Math.abs(vy) * BOUNCE + 0.5;
                    angVel += (Math.random() - 0.5) * 2;
                    hitY = true;
                }
                if (py >= VH - H) {
                    py = VH - H;
                    vy = -(Math.abs(vy) * BOUNCE + 0.5);
                    angVel += (Math.random() - 0.5) * 2;
                    hitY = true;
                }

                // Squash on wall hit — only when moving fast enough
                if (hitX && Math.abs(vx) > 1.5) triggerAnim('squash-x', 350);
                if (hitY && Math.abs(vy) > 1.5) triggerAnim('squash-y', 350);

                // Auto-nudge if nearly stopped
                if (speed < 0.12 && !isSleeping) {
                    vx += (Math.random() - 0.5) * 1.2;
                    vy += (Math.random() - 0.5) * 1.2;
                }

                applyTransform();
            }

            requestAnimationFrame(physicsLoop);
        }
        requestAnimationFrame(physicsLoop);

        /* ── RESIZE ── */
        window.addEventListener('resize', function() {
            px = Math.min(px, window.innerWidth  - W);
            py = Math.min(py, window.innerHeight - H);
        }, { passive: true });

        /* ── ANIMATION CLASS — target inner to avoid physics conflict ── */
        var animTimeout = null;
        function triggerAnim(cls, ms) {
            if (!inner) return;
            clearTimeout(animTimeout);
            inner.classList.remove('squash-x','squash-y','tap-burst','spin');
            void inner.offsetWidth; // force reflow so animation restarts
            inner.classList.add(cls);
            animTimeout = setTimeout(function() {
                inner.classList.remove(cls);
            }, ms || 400);
        }

        /* ══════════════════════════════════════════
           FACE SYSTEM
        ══════════════════════════════════════════ */
        var FACE = {
            normal:    { mouth:'M 33 48 Q 48 56 63 48', eyes:'circle', iris:'#38bdf8' },
            happy:     { mouth:'M 30 46 Q 48 60 66 46', eyes:'circle', iris:'#34d399' },
            excited:   { mouth:'M 30 46 Q 48 62 66 46', eyes:'star',   iris:'#fbbf24' },
            surprised: { mouth:'M 40 50 Q 48 56 56 50', eyes:'big',    iris:'#f472b6' },
            sad:       { mouth:'M 33 54 Q 48 46 63 54', eyes:'circle', iris:'#94a3b8' },
            sleeping:  { mouth:'M 36 50 Q 48 54 60 50', eyes:'closed', iris:'#38bdf8' },
            love:      { mouth:'M 30 46 Q 48 60 66 46', eyes:'heart',  iris:'#f472b6' },
            cool:      { mouth:'M 33 48 Q 48 54 63 48', eyes:'sunglasses', iris:'#38bdf8' },
            dizzy:     { mouth:'M 36 50 Q 48 56 60 50', eyes:'x',       iris:'#a78bfa' },
        };
        var faceTimer = null;

        function setFace(name, duration) {
            var f = FACE[name] || FACE.normal;
            mouth.setAttribute('d', f.mouth);
            irisL.setAttribute('fill', f.iris);
            irisR.setAttribute('fill', f.iris);

            var blushAmt = (name === 'happy' || name === 'excited' || name === 'love') ? 1 : 0;
            blushL.style.opacity = blushAmt;
            blushR.style.opacity = blushAmt;

            var eyesEl = document.getElementById('kb-eyes');
            eyesEl.querySelectorAll('.kb-special-eye').forEach(function(e){ e.remove(); });

            if (f.eyes === 'closed') {
                eyeL.style.opacity = '0'; eyeR.style.opacity = '0';
                ['l','r'].forEach(function(side) {
                    var cx = side === 'l' ? 31 : 65;
                    var ln = document.createElementNS('http://www.w3.org/2000/svg','line');
                    ln.setAttribute('x1', cx-9); ln.setAttribute('y1', 34);
                    ln.setAttribute('x2', cx+9); ln.setAttribute('y2', 34);
                    ln.setAttribute('stroke','#38bdf8'); ln.setAttribute('stroke-width','3');
                    ln.setAttribute('stroke-linecap','round'); ln.classList.add('kb-special-eye');
                    eyesEl.appendChild(ln);
                });
            } else if (f.eyes === 'star') {
                eyeL.style.opacity = '0'; eyeR.style.opacity = '0';
                ['l','r'].forEach(function(side) {
                    var cx = side === 'l' ? 31 : 65;
                    var t = document.createElementNS('http://www.w3.org/2000/svg','text');
                    t.setAttribute('x', cx); t.setAttribute('y', 39);
                    t.setAttribute('text-anchor','middle');
                    t.setAttribute('font-size','18'); t.textContent = '★';
                    t.setAttribute('fill','#fbbf24'); t.classList.add('kb-special-eye');
                    eyesEl.appendChild(t);
                });
            } else if (f.eyes === 'heart') {
                eyeL.style.opacity = '0'; eyeR.style.opacity = '0';
                ['l','r'].forEach(function(side) {
                    var cx = side === 'l' ? 31 : 65;
                    var t = document.createElementNS('http://www.w3.org/2000/svg','text');
                    t.setAttribute('x', cx); t.setAttribute('y', 39);
                    t.setAttribute('text-anchor','middle');
                    t.setAttribute('font-size','16'); t.textContent = '♥';
                    t.setAttribute('fill','#f472b6'); t.classList.add('kb-special-eye');
                    eyesEl.appendChild(t);
                });
            } else if (f.eyes === 'x') {
                eyeL.style.opacity = '0'; eyeR.style.opacity = '0';
                ['l','r'].forEach(function(side) {
                    var cx = side === 'l' ? 31 : 65;
                    var t = document.createElementNS('http://www.w3.org/2000/svg','text');
                    t.setAttribute('x', cx); t.setAttribute('y', 39);
                    t.setAttribute('text-anchor','middle');
                    t.setAttribute('font-size','18'); t.textContent = '✕';
                    t.setAttribute('fill','#a78bfa'); t.classList.add('kb-special-eye');
                    eyesEl.appendChild(t);
                });
            } else if (f.eyes === 'sunglasses') {
                eyeL.style.opacity = '0'; eyeR.style.opacity = '0';
                var sg = document.createElementNS('http://www.w3.org/2000/svg','text');
                sg.setAttribute('x', 48); sg.setAttribute('y', 39);
                sg.setAttribute('text-anchor','middle');
                sg.setAttribute('font-size','20'); sg.textContent = '😎';
                sg.classList.add('kb-special-eye');
                eyesEl.appendChild(sg);
            } else if (f.eyes === 'big') {
                eyeL.style.opacity = '1'; eyeR.style.opacity = '1';
                irisL.setAttribute('r','8'); irisR.setAttribute('r','8');
            } else {
                eyeL.style.opacity = '1'; eyeR.style.opacity = '1';
                irisL.setAttribute('r','6'); irisR.setAttribute('r','6');
            }

            clearTimeout(faceTimer);
            if (duration) faceTimer = setTimeout(function(){ setFace('normal'); }, duration);
        }

        /* ── BLINK ── */
        function doBlink() {
            if (isSleeping) return;
            eyeL.style.transform = 'scaleY(0.08)';
            eyeR.style.transform = 'scaleY(0.08)';
            eyeL.style.transformOrigin = 'center 34px';
            eyeR.style.transformOrigin = 'center 34px';
            setTimeout(function() { eyeL.style.transform=''; eyeR.style.transform=''; }, 120);
        }
        function schedBlink() { setTimeout(function(){ doBlink(); schedBlink(); }, 2000+Math.random()*4000); }
        schedBlink();

        /* ── EYE FOLLOW CURSOR ── */
        document.addEventListener('mousemove', function(e) {
            if (isSleeping || isDragging) return;
            var cx = px + W/2, cy = py + H*0.3;
            var angle = Math.atan2(e.clientY - cy, e.clientX - cx);
            var dist  = Math.min(3, Math.sqrt(Math.pow(e.clientX-cx,2)+Math.pow(e.clientY-cy,2)) / 80);
            var ox = Math.cos(angle)*dist, oy = Math.sin(angle)*dist;
            irisL.setAttribute('cx', 31+ox);
            irisL.setAttribute('cy', 34+oy);
            irisR.setAttribute('cx', 65+ox);
            irisR.setAttribute('cy', 34+oy);
        }, { passive: true });

        /* ── LED BLINK ── */
        var ledIdx = 0;
        var leds = [led1,led2,led3];
        var ledColors = [['#34d399','#1e3a8a','#1e3a8a'],['#1e3a8a','#38bdf8','#1e3a8a'],['#1e3a8a','#1e3a8a','#818cf8']];
        setInterval(function() {
            if (isSleeping){ leds.forEach(function(l){ l.setAttribute('fill','#1e3a8a'); }); return; }
            ledIdx = (ledIdx+1)%3;
            leds.forEach(function(l,i){ l.setAttribute('fill', ledColors[ledIdx][i]); });
        }, 500);

        /* ── ARM WAVE ── */
        function waveArms() {
            var t = 0;
            var iv = setInterval(function() {
                var a = Math.sin(t*0.3)*15;
                armL.setAttribute('transform','rotate('+a+',10,80)');
                armR.setAttribute('transform','rotate('+(-a)+',86,80)');
                t++;
                if (t > 40){ clearInterval(iv); armL.removeAttribute('transform'); armR.removeAttribute('transform'); }
            }, 30);
        }

        /* ── BUBBLE ── */
        function showBubble(text, duration) {
            clearTimeout(bubbleTimer);
            bubble.textContent = text;
            bubble.classList.add('show');
            bubbleTimer = setTimeout(function(){ bubble.classList.remove('show'); }, duration || 3500);
        }

        /* ── SLEEP ── */
        function goSleep() {
            if (isSleeping) return;
            isSleeping = true;
            // Slow down to gentle drift
            vx *= 0.1; vy *= 0.1; angVel *= 0.05;
            setFace('sleeping');
            zzzWrap.classList.add('show');
            showBubble('Zzzz... 😴', 99999);
        }
        function wakeUp() {
            if (!isSleeping) return;
            isSleeping = false;
            zzzWrap.classList.remove('show');
            setFace('happy', 1800);
            // Burst awake
            vx = (Math.random()-0.5) * 5;
            vy = (Math.random()-0.5) * 5;
            angVel = (Math.random()-0.5) * 2;
            showBubble('Yawn~ 😪 Aku\nketiduran!', 2500);
            resetSleepTimer();
        }
        function resetSleepTimer() {
            clearTimeout(sleepTimer);
            if (!isSleeping) sleepTimer = setTimeout(goSleep, 25000);
        }
        resetSleepTimer();

        /* ── MESSAGES ── */
        var messages = [
            '👋 Hai! Aku KasBot!\nMaskot E-KASRT mu!',
            '📊 Kas RT transparan\nselalu terpantau!',
            '🏠 Data warga RT\naman & terkelola!',
            '💉 Posyandu Balita\npakai e-KTP lho!',
            '📱 Semua bisa dipantau\ndari smartphone!',
            '🔐 Data kamu aman\ndi server kami!',
            '⚡ Real-time!\nLangsung update!',
            '🎉 Hore! Klik lagi\naku suka di-tap!',
            '😄 Terus klik aku~\nAku seneng!',
            '🤖 Beep boop!\nAku robot keuangan!',
            '💰 Iuran warga RT\nsudah tercatat!',
            '🌟 E-KASRT terbaik\nse-RT!',
            '🚀 Lagi terbang\nke mana ya?',
            '🌊 Weeee~\nTidak ada gravitasi!',
            '💫 Aku bebas\nmelayang! Hehe~',
        ];

        /* ── TAP HANDLER — single unified event, no double-fire ── */
        var lastTap = 0;
        var tapPending = false; // guard against duplicate events

        function onTap(e) {
            // Only fire on primary pointer; ignore if drag happened
            if (isDragging) return;
            if (isSleeping) { wakeUp(); return; }

            // Prevent duplicate: touchstart sets tapPending, click checks it
            if (e.type === 'touchstart') {
                tapPending = true;
                setTimeout(function(){ tapPending = false; }, 500);
            } else if (e.type === 'click') {
                if (tapPending) { tapPending = false; return; } // already handled by touchstart
            }
            e.preventDefault();

            resetSleepTimer();
            tapCount++;
            counter.textContent = tapCount;
            counter.classList.add('show');

            // Velocity kick
            vx += (Math.random()-0.5) * 8;
            vy += (Math.random()-0.5) * 8;
            angVel += (Math.random()-0.5) * 3;

            triggerAnim('tap-burst', 450);

            if (tapCount === 1) {
                setFace('happy', 2000);
                showBubble(messages[msgIdx % messages.length]);
                msgIdx++;
                waveArms();
            } else if (tapCount % 100 === 0) {
                // 🎨 THEME CHANGE every 100 taps!
                if (window.KasBotTheme) window.KasBotTheme.nextTheme();
                var t = window.KasBotTheme ? window.KasBotTheme.themes[window.KasBotTheme.currentIdx()] : null;
                setFace('excited', 4000);
                showBubble('🎨 TEMA BERUBAH!\n' + (t ? t.emoji + ' ' + t.name : '') + '\nUdah ' + tapCount + 'x tap!', 4500);
                triggerAnim('spin', 600);
                blushL.style.opacity='1'; blushR.style.opacity='1';
                angVel += (Math.random()>0.5?1:-1)*8;
                vx = (Math.random()-0.5)*18; vy = (Math.random()-0.5)*18;
            } else if (tapCount % 10 === 0) {
                setFace('excited', 2500);
                showBubble('🤩 WOW! Udah '+tapCount+'x tap!\nKamu keren banget!');
                triggerAnim('spin', 500);
                blushL.style.opacity='1'; blushR.style.opacity='1';
                angVel += (Math.random()>0.5?1:-1)*5;
                vx = (Math.random()-0.5)*14; vy = (Math.random()-0.5)*14;
            } else if (tapCount % 5 === 0) {
                setFace('love', 2000);
                showBubble('💕 Makasih udah\nsayang sama aku!');
            } else {
                var faces = ['happy','surprised','excited','cool','dizzy'];
                setFace(faces[tapCount % faces.length], 1800);
                showBubble(messages[msgIdx % messages.length]);
                msgIdx++;
            }

            // Double tap → turbo spin
            var now = Date.now();
            if (now - lastTap < 380) {
                triggerAnim('spin', 500);
                setFace('dizzy', 1500);
                showBubble('🌀 TURBO MODE!\nBeep boop~');
                vx = (Math.random()>0.5?1:-1)*12;
                vy = (Math.random()>0.5?1:-1)*12;
                angVel = (Math.random()-0.5)*10;
            }
            lastTap = now;
        }

        // Both listeners needed for desktop(click) and mobile(touchstart)
        // tapPending flag prevents double-fire on devices that send both
        wrap.addEventListener('click',      onTap);
        wrap.addEventListener('touchstart', onTap, { passive: false });

        /* ── DRAG WITH THROW ── */
        var dragPrevX, dragPrevY, dragPrevTime;
        var dragVX = 0, dragVY = 0;

        function onDragStart(e) {
            if (e.type === 'touchstart' && e.touches.length !== 1) return;
            isDragging = false;
            var touch = e.touches ? e.touches[0] : e;
            var startX = touch.clientX, startY = touch.clientY;
            var startPX = px, startPY = py;
            dragPrevX = startX; dragPrevY = startY;
            dragPrevTime = Date.now();
            dragVX = 0; dragVY = 0;
            wrap.style.cursor = 'grabbing';

            function onMove(ev) {
                var t2 = ev.touches ? ev.touches[0] : ev;
                var dx = t2.clientX - startX;
                var dy = t2.clientY - startY;
                if (!isDragging && (Math.abs(dx)>5 || Math.abs(dy)>5)) isDragging = true;
                if (!isDragging) return;

                var now = Date.now();
                var dt  = Math.max(1, now - dragPrevTime);
                dragVX = (t2.clientX - dragPrevX) / dt * 16;
                dragVY = (t2.clientY - dragPrevY) / dt * 16;
                dragPrevX = t2.clientX; dragPrevY = t2.clientY;
                dragPrevTime = now;

                px = Math.max(0, Math.min(window.innerWidth  - W,  startPX + dx));
                py = Math.max(0, Math.min(window.innerHeight - H,  startPY + dy));
                applyTransform();
            }
            function onEnd() {
                wrap.style.cursor = 'grab';
                document.removeEventListener('mousemove', onMove);
                document.removeEventListener('mouseup',   onEnd);
                document.removeEventListener('touchmove', onMove);
                document.removeEventListener('touchend',  onEnd);
                if (isDragging) {
                    // Throw: inherit drag velocity
                    vx = dragVX; vy = dragVY;
                    angVel = dragVX * 0.3;
                    setFace('surprised', 1500);
                    showBubble('😲 Wuuush!\nAku dilempar!');
                    triggerAnim('squash-x', 350);
                }
                setTimeout(function(){ isDragging = false; }, 80);
            }
            document.addEventListener('mousemove', onMove, { passive: true });
            document.addEventListener('mouseup',   onEnd);
            document.addEventListener('touchmove', onMove, { passive: true });
            document.addEventListener('touchend',  onEnd);
        }
        wrap.addEventListener('mousedown',  onDragStart);
        wrap.addEventListener('touchstart', onDragStart, { passive: true });

        /* ── IDLE RANDOM ── */
        function randomIdle() {
            if (isSleeping) return;
            var r = Math.random();
            if      (r < 0.2) { setFace('cool', 1500); }
            else if (r < 0.35){ waveArms(); }
            else if (r < 0.5) {
                // Random gentle nudge
                vx += (Math.random()-0.5) * 1.5;
                vy += (Math.random()-0.5) * 1.5;
            }
        }
        setInterval(randomIdle, 7000);

        /* ── GREET on load ── */
        setTimeout(function() {
            setFace('happy', 3000);
            showBubble('👋 Hai! Aku KasBot 3D!\nAku melayang di sini~\nTap & lempar aku ya! 🤖', 4500);
            waveArms();
            resetSleepTimer();
        }, 1000);

    })();
    </script>
    {{-- ===== END KASBOT MASCOT ===== --}}

    {{-- ===== REAL-TIME THREE.JS 3D CHARACTERS ENGINE (HERO & KASBOT 3D) ===== --}}
    <script id="ekasrt-3d-characters">
    (function() {
        var pointerNorm = { x: 0, y: 0, clientX: window.innerWidth * 0.5, clientY: window.innerHeight * 0.5 };
        document.addEventListener('mousemove', function(e) {
            pointerNorm.clientX = e.clientX;
            pointerNorm.clientY = e.clientY;
            pointerNorm.x = (e.clientX / Math.max(1, window.innerWidth)) * 2 - 1;
            pointerNorm.y = -((e.clientY / Math.max(1, window.innerHeight)) * 2 - 1);
        }, { passive: true });

        function hexStringToInt(hex, fallback) {
            if (!hex || typeof hex !== 'string') return fallback;
            var clean = hex.replace('#', '').trim();
            var parsed = parseInt(clean, 16);
            return isNaN(parsed) ? fallback : parsed;
        }

        function buildEkBotRig(THREE, opts) {
            opts = opts || {};
            var accentHex = opts.accentHex || 0x0284c7;
            var lightHex  = opts.lightHex  || 0x38bdf8;
            var emeraldHex = 0x34d399;

            var sceneGroup = new THREE.Group();
            var robotGroup = new THREE.Group();
            sceneGroup.add(robotGroup);

            // Shared PBR Materials
            var armorMat = new THREE.MeshStandardMaterial({
                color: 0xf1f5f9,
                metalness: 0.28,
                roughness: 0.22
            });
            var trimMat = new THREE.MeshStandardMaterial({
                color: accentHex,
                emissive: accentHex,
                emissiveIntensity: 0.35,
                metalness: 0.45,
                roughness: 0.25
            });
            var darkMetalMat = new THREE.MeshStandardMaterial({
                color: 0x1e293b,
                metalness: 0.65,
                roughness: 0.3
            });
            var visorMat = new THREE.MeshStandardMaterial({
                color: 0x061021,
                emissive: 0x030c1a,
                metalness: 0.72,
                roughness: 0.14
            });
            var neonMat = new THREE.MeshStandardMaterial({
                color: 0xe0f2fe,
                emissive: lightHex,
                emissiveIntensity: 1.5,
                roughness: 0.18
            });
            var eyeMatL = neonMat.clone();
            var eyeMatR = neonMat.clone();
            var mouthMat = new THREE.MeshStandardMaterial({
                color: 0xd1fae5,
                emissive: emeraldHex,
                emissiveIntensity: 1.35,
                roughness: 0.2
            });
            var blushMat = new THREE.MeshStandardMaterial({
                color: 0xfb7185,
                emissive: 0xf43f5e,
                emissiveIntensity: 0.75,
                transparent: true,
                opacity: 0
            });
            var flameMat = new THREE.MeshBasicMaterial({
                color: lightHex,
                transparent: true,
                opacity: 0.78
            });

            // ── TORSO ──
            var torsoGroup = new THREE.Group();
            robotGroup.add(torsoGroup);

            var torsoCore = new THREE.Mesh(new THREE.CylinderGeometry(0.42, 0.35, 0.66, 28), armorMat);
            torsoCore.position.y = 0.0;
            torsoGroup.add(torsoCore);

            var torsoTopDome = new THREE.Mesh(new THREE.SphereGeometry(0.42, 24, 16), armorMat);
            torsoTopDome.scale.set(1, 0.44, 1);
            torsoTopDome.position.y = 0.32;
            torsoGroup.add(torsoTopDome);

            var torsoBottomDome = new THREE.Mesh(new THREE.SphereGeometry(0.35, 24, 16), darkMetalMat);
            torsoBottomDome.scale.set(1, 0.48, 1);
            torsoBottomDome.position.y = -0.32;
            torsoGroup.add(torsoBottomDome);

            var beltRing = new THREE.Mesh(new THREE.TorusGeometry(0.37, 0.032, 12, 32), trimMat);
            beltRing.rotation.x = Math.PI / 2;
            beltRing.position.y = -0.18;
            torsoGroup.add(beltRing);

            // Chest Glass Panel & Tri-LEDs
            var chestPlate = new THREE.Mesh(new THREE.BoxGeometry(0.46, 0.25, 0.08), darkMetalMat);
            chestPlate.position.set(0, 0.06, 0.36);
            torsoGroup.add(chestPlate);

            var chestHex = new THREE.Mesh(new THREE.CylinderGeometry(0.065, 0.065, 0.04, 6), neonMat);
            chestHex.rotation.x = Math.PI / 2;
            chestHex.position.set(0, 0.11, 0.405);
            torsoGroup.add(chestHex);

            var chestLeds = [];
            var ledColors = [0x34d399, 0x38bdf8, 0x818cf8];
            for (var li = 0; li < 3; li++) {
                var ledMat = new THREE.MeshStandardMaterial({
                    color: 0xffffff,
                    emissive: ledColors[li],
                    emissiveIntensity: 1.3
                });
                var ledMesh = new THREE.Mesh(new THREE.SphereGeometry(0.03, 12, 12), ledMat);
                ledMesh.position.set(-0.11 + li * 0.11, -0.005, 0.41);
                torsoGroup.add(ledMesh);
                chestLeds.push({ mesh: ledMesh, mat: ledMat, baseColor: ledColors[li] });
            }

            // Back Dual Jetpack & Thruster Flames
            var flames = [];
            [-0.17, 0.17].forEach(function(px) {
                var pod = new THREE.Mesh(new THREE.CylinderGeometry(0.095, 0.125, 0.42, 16), darkMetalMat);
                pod.position.set(px, 0.02, -0.37);
                pod.rotation.x = 0.12;
                torsoGroup.add(pod);

                var nozzleRing = new THREE.Mesh(new THREE.TorusGeometry(0.095, 0.02, 8, 16), trimMat);
                nozzleRing.rotation.x = Math.PI / 2 + 0.12;
                nozzleRing.position.set(px, -0.18, -0.39);
                torsoGroup.add(nozzleRing);

                var flame = new THREE.Mesh(new THREE.ConeGeometry(0.075, 0.28, 12), flameMat);
                flame.rotation.x = Math.PI;
                flame.position.set(px, -0.34, -0.41);
                torsoGroup.add(flame);
                flames.push(flame);
            });

            // ── HEAD & VISOR ──
            var headGroup = new THREE.Group();
            headGroup.position.y = 0.72;
            robotGroup.add(headGroup);

            var neck = new THREE.Mesh(new THREE.CylinderGeometry(0.13, 0.16, 0.2, 16), darkMetalMat);
            neck.position.y = -0.26;
            headGroup.add(neck);

            var helmet = new THREE.Mesh(new THREE.SphereGeometry(0.56, 32, 24), armorMat);
            helmet.scale.set(1.16, 0.88, 0.96);
            helmet.position.y = 0.06;
            headGroup.add(helmet);

            var visor = new THREE.Mesh(new THREE.SphereGeometry(0.51, 32, 24), visorMat);
            visor.scale.set(1.06, 0.72, 0.74);
            visor.position.set(0, 0.04, 0.18);
            headGroup.add(visor);

            var visorRim = new THREE.Mesh(new THREE.TorusGeometry(0.49, 0.024, 10, 36), trimMat);
            visorRim.scale.set(1.06, 0.78, 0.65);
            visorRim.position.set(0, 0.04, 0.36);
            headGroup.add(visorRim);

            // Ear Headphones / Comms Pods
            [-0.65, 0.65].forEach(function(ex) {
                var earCup = new THREE.Mesh(new THREE.CylinderGeometry(0.15, 0.15, 0.11, 20), trimMat);
                earCup.rotation.z = Math.PI / 2;
                earCup.position.set(ex, 0.05, 0.0);
                headGroup.add(earCup);

                var earRing = new THREE.Mesh(new THREE.TorusGeometry(0.125, 0.02, 8, 24), neonMat);
                earRing.rotation.y = Math.PI / 2;
                earRing.position.set(ex > 0 ? ex + 0.058 : ex - 0.058, 0.05, 0.0);
                headGroup.add(earRing);
            });

            // Antenna
            var antennaStem = new THREE.Mesh(new THREE.CylinderGeometry(0.02, 0.032, 0.32, 12), darkMetalMat);
            antennaStem.position.set(0, 0.64, 0);
            headGroup.add(antennaStem);

            var antennaBulb = new THREE.Mesh(new THREE.SphereGeometry(0.08, 16, 16), neonMat);
            antennaBulb.position.set(0, 0.82, 0);
            headGroup.add(antennaBulb);

            // ── 3D EXPRESSIVE FACE ──
            var faceGroup = new THREE.Group();
            faceGroup.position.set(0, 0.03, 0.54);
            headGroup.add(faceGroup);

            var eyeL = new THREE.Mesh(new THREE.SphereGeometry(0.088, 20, 16), eyeMatL);
            eyeL.scale.set(0.95, 1.32, 0.42);
            eyeL.position.set(-0.20, 0.045, 0);
            faceGroup.add(eyeL);

            var eyeR = new THREE.Mesh(new THREE.SphereGeometry(0.088, 20, 16), eyeMatR);
            eyeR.scale.set(0.95, 1.32, 0.42);
            eyeR.position.set(0.20, 0.045, 0);
            faceGroup.add(eyeR);

            var pupilDotMat = new THREE.MeshBasicMaterial({ color: 0xffffff });
            var pupilL = new THREE.Mesh(new THREE.SphereGeometry(0.025, 10, 10), pupilDotMat);
            pupilL.position.set(-0.18, 0.08, 0.035);
            faceGroup.add(pupilL);
            var pupilR = new THREE.Mesh(new THREE.SphereGeometry(0.025, 10, 10), pupilDotMat);
            pupilR.position.set(0.22, 0.08, 0.035);
            faceGroup.add(pupilR);

            var mouth = new THREE.Mesh(new THREE.TorusGeometry(0.115, 0.022, 10, 24, Math.PI * 0.78), mouthMat);
            mouth.rotation.z = Math.PI + (Math.PI - Math.PI * 0.78) / 2;
            mouth.position.set(0, -0.05, 0.015);
            faceGroup.add(mouth);

            var blushL = new THREE.Mesh(new THREE.SphereGeometry(0.055, 12, 10), blushMat);
            blushL.scale.set(1.35, 0.7, 0.35);
            blushL.position.set(-0.31, -0.04, -0.01);
            faceGroup.add(blushL);

            var blushR = new THREE.Mesh(new THREE.SphereGeometry(0.055, 12, 10), blushMat);
            blushR.scale.set(1.35, 0.7, 0.35);
            blushR.position.set(0.31, -0.04, -0.01);
            faceGroup.add(blushR);

            // Sunglasses prop for 'cool' mood
            var shadesGroup = new THREE.Group();
            shadesGroup.visible = false;
            var lensMat = new THREE.MeshStandardMaterial({ color: 0x0f172a, emissive: 0x1e293b, metalness: 0.9, roughness: 0.08 });
            var lensL = new THREE.Mesh(new THREE.BoxGeometry(0.19, 0.11, 0.04), lensMat);
            lensL.position.set(-0.19, 0.045, 0.045);
            var lensR = new THREE.Mesh(new THREE.BoxGeometry(0.19, 0.11, 0.04), lensMat);
            lensR.position.set(0.19, 0.045, 0.045);
            var bridge = new THREE.Mesh(new THREE.BoxGeometry(0.1, 0.028, 0.035), trimMat);
            bridge.position.set(0, 0.06, 0.045);
            shadesGroup.add(lensL, lensR, bridge);
            faceGroup.add(shadesGroup);

            // ── ARTICULATED ARMS ──
            function makeArm(side) {
                var pivot = new THREE.Group();
                pivot.position.set(side * 0.52, 0.18, 0);

                var shoulder = new THREE.Mesh(new THREE.SphereGeometry(0.105, 16, 12), trimMat);
                pivot.add(shoulder);

                var armTube = new THREE.Mesh(new THREE.CylinderGeometry(0.088, 0.08, 0.30, 16), armorMat);
                armTube.position.y = -0.18;
                pivot.add(armTube);

                var hand = new THREE.Mesh(new THREE.SphereGeometry(0.105, 16, 14), darkMetalMat);
                hand.position.y = -0.35;
                pivot.add(hand);

                var palmGlow = new THREE.Mesh(new THREE.SphereGeometry(0.045, 12, 12), neonMat);
                palmGlow.position.set(0, -0.36, 0.07);
                pivot.add(palmGlow);

                return pivot;
            }
            var armL = makeArm(-1);
            var armR = makeArm(1);
            robotGroup.add(armL, armR);

            // ── ARTICULATED LEGS & HOVER BOOTS ──
            function makeLeg(side) {
                var pivot = new THREE.Group();
                pivot.position.set(side * 0.19, -0.36, 0);

                var thigh = new THREE.Mesh(new THREE.CylinderGeometry(0.085, 0.08, 0.22, 14), darkMetalMat);
                thigh.position.y = -0.11;
                pivot.add(thigh);

                var boot = new THREE.Mesh(new THREE.CylinderGeometry(0.095, 0.13, 0.20, 16), armorMat);
                boot.position.y = -0.28;
                pivot.add(boot);

                var soleGlow = new THREE.Mesh(new THREE.TorusGeometry(0.115, 0.022, 8, 22), neonMat);
                soleGlow.rotation.x = Math.PI / 2;
                soleGlow.position.y = -0.38;
                pivot.add(soleGlow);

                return pivot;
            }
            var legL = makeLeg(-1);
            var legR = makeLeg(1);
            robotGroup.add(legL, legR);

            // ── HERO PROPS (Pedestal Hologram Rings + Orbiting Gold Kas Coin & e-KTP Badge) ──
            var props = null;
            if (opts.withProps) {
                var pedGroup = new THREE.Group();
                pedGroup.position.y = -0.94;
                sceneGroup.add(pedGroup);

                var holoRing1 = new THREE.Mesh(new THREE.TorusGeometry(0.95, 0.022, 10, 48), neonMat);
                holoRing1.rotation.x = Math.PI / 2;
                pedGroup.add(holoRing1);

                var holoRing2 = new THREE.Mesh(new THREE.TorusGeometry(0.72, 0.018, 10, 40), trimMat);
                holoRing2.rotation.x = Math.PI / 2;
                pedGroup.add(holoRing2);

                var holoDisc = new THREE.Mesh(
                    new THREE.CylinderGeometry(0.88, 0.88, 0.02, 36),
                    new THREE.MeshBasicMaterial({ color: lightHex, transparent: true, opacity: 0.14 })
                );
                pedGroup.add(holoDisc);

                // Orbiting 3D Golden Kas Coin
                var coinPivot = new THREE.Group();
                sceneGroup.add(coinPivot);
                var coinSpinGroup = new THREE.Group();
                coinSpinGroup.position.set(-1.32, 0.35, 0.18);
                var coinMat = new THREE.MeshStandardMaterial({ color: 0xfbbf24, emissive: 0xd97706, emissiveIntensity: 0.38, metalness: 0.75, roughness: 0.2 });
                var coinMesh = new THREE.Mesh(new THREE.CylinderGeometry(0.24, 0.24, 0.055, 28), coinMat);
                coinMesh.rotation.x = Math.PI / 2;
                var coinRim = new THREE.Mesh(new THREE.TorusGeometry(0.21, 0.02, 8, 24), new THREE.MeshStandardMaterial({ color: 0xfef3c7, emissive: 0xf59e0b, emissiveIntensity: 0.6 }));
                coinSpinGroup.add(coinMesh, coinRim);
                coinPivot.add(coinSpinGroup);

                // Orbiting 3D Smart RFID e-KTP Card
                var cardPivot = new THREE.Group();
                sceneGroup.add(cardPivot);
                var cardGroup = new THREE.Group();
                cardGroup.position.set(1.34, 0.22, 0.18);
                var cardBody = new THREE.Mesh(
                    new THREE.BoxGeometry(0.42, 0.27, 0.036),
                    new THREE.MeshStandardMaterial({ color: 0x0ea5e9, emissive: 0x0369a1, emissiveIntensity: 0.55, metalness: 0.35, roughness: 0.25 })
                );
                var cardChip = new THREE.Mesh(
                    new THREE.BoxGeometry(0.09, 0.075, 0.044),
                    coinMat
                );
                cardChip.position.set(-0.10, 0.015, 0);
                cardGroup.add(cardBody, cardChip);
                cardPivot.add(cardGroup);

                props = {
                    holoRing1: holoRing1,
                    holoRing2: holoRing2,
                    holoDisc: holoDisc,
                    coinPivot: coinPivot,
                    coinSpinGroup: coinSpinGroup,
                    cardPivot: cardPivot,
                    cardGroup: cardGroup
                };
            }

            // Apply Face Expression
            function applyMood(mood) {
                mood = mood || 'normal';
                shadesGroup.visible = (mood === 'cool');
                blushMat.opacity = (mood === 'happy' || mood === 'excited' || mood === 'love') ? 0.62 : 0;

                var c = lightHex;
                if (mood === 'happy') c = 0x34d399;
                else if (mood === 'excited') c = 0xfbbf24;
                else if (mood === 'love' || mood === 'surprised') c = 0xf472b6;
                else if (mood === 'dizzy') c = 0xa78bfa;
                else if (mood === 'sad') c = 0x94a3b8;

                eyeMatL.emissive.setHex(c);
                eyeMatR.emissive.setHex(c);

                if (mood === 'sleeping') {
                    eyeL.scale.set(1.1, 0.14, 0.42);
                    eyeR.scale.set(1.1, 0.14, 0.42);
                    pupilL.visible = false;
                    pupilR.visible = false;
                    mouth.scale.set(0.75, 0.6, 1);
                    mouth.rotation.z = Math.PI + (Math.PI - Math.PI * 0.78) / 2;
                } else if (mood === 'surprised') {
                    eyeL.scale.set(1.18, 1.52, 0.42);
                    eyeR.scale.set(1.18, 1.52, 0.42);
                    pupilL.visible = true;
                    pupilR.visible = true;
                    mouth.scale.set(0.55, 1.15, 1);
                    mouth.rotation.z = (Math.PI - Math.PI * 0.78) / 2;
                } else if (mood === 'sad') {
                    eyeL.scale.set(0.9, 1.05, 0.42);
                    eyeR.scale.set(0.9, 1.05, 0.42);
                    pupilL.visible = true;
                    pupilR.visible = true;
                    mouth.scale.set(0.95, 0.9, 1);
                    mouth.rotation.z = (Math.PI - Math.PI * 0.78) / 2; // upside down frown
                } else {
                    eyeL.scale.set(0.95, 1.32, 0.42);
                    eyeR.scale.set(0.95, 1.32, 0.42);
                    pupilL.visible = (mood !== 'cool');
                    pupilR.visible = (mood !== 'cool');
                    mouth.scale.set(mood === 'happy' || mood === 'excited' || mood === 'love' ? 1.18 : 1.0, 1, 1);
                    mouth.rotation.z = Math.PI + (Math.PI - Math.PI * 0.78) / 2;
                }
            }

            function setThemeColors(accentStr, lightStr) {
                accentHex = hexStringToInt(accentStr, 0x0284c7);
                lightHex  = hexStringToInt(lightStr,  0x38bdf8);
                trimMat.color.setHex(accentHex);
                trimMat.emissive.setHex(accentHex);
                neonMat.emissive.setHex(lightHex);
                flameMat.color.setHex(lightHex);
                if (props && props.holoDisc) {
                    props.holoDisc.material.color.setHex(lightHex);
                }
            }

            return {
                sceneGroup: sceneGroup,
                robotGroup: robotGroup,
                headGroup: headGroup,
                armL: armL,
                armR: armR,
                legL: legL,
                legR: legR,
                eyeL: eyeL,
                eyeR: eyeR,
                antennaBulb: antennaBulb,
                flames: flames,
                chestLeds: chestLeds,
                props: props,
                applyMood: applyMood,
                setThemeColors: setThemeColors
            };
        }

        function boot3DCharacters(THREE) {
            // ── STAGE 1: HERO 3D GUARDIAN CHARACTER ──
            var heroCanvas = document.getElementById('hero3dCanvas');
            var heroWrap = document.getElementById('hero3dStageWrap');
            var heroFallback = document.getElementById('hero3dFallback');

            if (heroCanvas && heroWrap) {
                try {
                    var hScene = new THREE.Scene();
                    var hW = heroWrap.clientWidth || 280;
                    var hH = heroWrap.clientHeight || 186;
                    var hCam = new THREE.PerspectiveCamera(36, hW / hH, 0.1, 50);
                    hCam.position.set(0, 0.22, 4.9);
                    hCam.lookAt(0, 0.12, 0);

                    var hRenderer = new THREE.WebGLRenderer({ canvas: heroCanvas, alpha: true, antialias: true, powerPreference: 'high-performance' });
                    hRenderer.setClearColor(0x000000, 0);
                    hRenderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
                    hRenderer.setSize(hW, hH, false);

                    hScene.add(new THREE.HemisphereLight(0xe0f2fe, 0x0f172a, 0.95));
                    var hKey = new THREE.DirectionalLight(0xffffff, 1.35);
                    hKey.position.set(3, 5, 4);
                    hScene.add(hKey);
                    var hRim1 = new THREE.PointLight(0x38bdf8, 1.65, 12);
                    hRim1.position.set(-3, 2, 3);
                    hScene.add(hRim1);
                    var hRim2 = new THREE.PointLight(0x34d399, 1.25, 10);
                    hRim2.position.set(3, 1.2, -2.5);
                    hScene.add(hRim2);

                    var hRig = buildEkBotRig(THREE, { withProps: true });
                    hScene.add(hRig.sceneGroup);

                    var heroState = {
                        mode: 'idle',
                        spinTarget: 0,
                        spinAngle: 0,
                        jumpT: 0,
                        manualYaw: 0,
                        dragging: false,
                        lastX: 0,
                        moved: false,
                        visible: true,
                        blinkTimer: 2.5
                    };

                    if ('IntersectionObserver' in window) {
                        new IntersectionObserver(function(entries) {
                            heroState.visible = entries[0].isIntersecting;
                        }, { threshold: 0.05 }).observe(heroWrap);
                    }

                    window.addEventListener('resize', function() {
                        var w = heroWrap.clientWidth || 280;
                        var h = heroWrap.clientHeight || 186;
                        hCam.aspect = w / Math.max(1, h);
                        hCam.updateProjectionMatrix();
                        hRenderer.setSize(w, h, false);
                    }, { passive: true });

                    heroWrap.addEventListener('pointerdown', function(e) {
                        heroState.dragging = true;
                        heroState.lastX = e.clientX;
                        heroState.moved = false;
                    });
                    document.addEventListener('pointermove', function(e) {
                        if (!heroState.dragging) return;
                        var dx = e.clientX - heroState.lastX;
                        if (Math.abs(dx) > 3) heroState.moved = true;
                        heroState.manualYaw += dx * 0.015;
                        heroState.lastX = e.clientX;
                    }, { passive: true });
                    document.addEventListener('pointerup', function() {
                        if (heroState.dragging && !heroState.moved) {
                            HeroChar3D.spinJump();
                        }
                        heroState.dragging = false;
                    });

                    window.HeroChar3D = {
                        setMode: function(mode, btn) {
                            heroState.mode = mode;
                            document.querySelectorAll('.hero-3d-controls .h3d-btn').forEach(function(b) {
                                b.classList.remove('active');
                            });
                            if (btn) btn.classList.add('active');
                            if (mode === 'wave') hRig.applyMood('happy');
                            else if (mode === 'dance') hRig.applyMood('excited');
                            else hRig.applyMood('normal');
                        },
                        spinJump: function() {
                            heroState.spinTarget += Math.PI * 2;
                            heroState.jumpT = 1.0;
                            hRig.applyMood('excited');
                            setTimeout(function() {
                                if (heroState.mode === 'idle') hRig.applyMood('normal');
                            }, 1600);
                        }
                    };

                    window.addEventListener('kasbot:theme', function(ev) {
                        if (!ev || !ev.detail) return;
                        hRig.setThemeColors(ev.detail.accent, ev.detail.light);
                        hRim1.color.setHex(hexStringToInt(ev.detail.light, 0x38bdf8));
                    });

                    var hLast = performance.now();
                    var hFirstFrame = false;
                    function renderHero(now) {
                        requestAnimationFrame(renderHero);
                        if (document.hidden || !heroState.visible) {
                            hLast = now;
                            return;
                        }
                        var dt = Math.min(0.05, (now - hLast) / 1000);
                        hLast = now;
                        var t = now * 0.001;

                        // Gentle hover bob + jump bounce
                        var jumpLift = 0;
                        if (heroState.jumpT > 0) {
                            heroState.jumpT = Math.max(0, heroState.jumpT - dt * 1.9);
                            jumpLift = Math.sin(heroState.jumpT * Math.PI) * 0.45;
                        }
                        hRig.robotGroup.position.y = Math.sin(t * 2.2) * 0.07 + jumpLift;

                        // Manual drag orbit + clean 360-degree spin completion
                        heroState.spinAngle += (heroState.spinTarget - heroState.spinAngle) * 0.12;
                        if (!heroState.dragging) {
                            heroState.manualYaw += (Math.sin(t * 0.7) * 0.18 - heroState.manualYaw) * 0.04;
                        }
                        hRig.robotGroup.rotation.y = heroState.manualYaw + heroState.spinAngle;

                        // Head cursor tracking
                        var targetYaw = Math.max(-0.42, Math.min(0.42, pointerNorm.x * 0.4));
                        var targetPitch = Math.max(-0.22, Math.min(0.25, -pointerNorm.y * 0.2));
                        hRig.headGroup.rotation.y += (targetYaw - hRig.headGroup.rotation.y) * 0.09;
                        hRig.headGroup.rotation.x += (targetPitch - hRig.headGroup.rotation.x) * 0.09;

                        // Animated Arms & Legs by Mode
                        if (heroState.mode === 'wave') {
                            hRig.armR.rotation.z = 2.35 + Math.sin(t * 9.0) * 0.35;
                            hRig.armR.rotation.x = 0.25;
                            hRig.armL.rotation.z = -0.25 + Math.sin(t * 2.5) * 0.06;
                            hRig.legL.rotation.x = Math.sin(t * 2.2) * 0.08;
                            hRig.legR.rotation.x = -Math.sin(t * 2.2) * 0.08;
                        } else if (heroState.mode === 'dance') {
                            hRig.robotGroup.position.x = Math.sin(t * 5.0) * 0.14;
                            hRig.robotGroup.rotation.z = Math.sin(t * 5.0) * 0.12;
                            hRig.armL.rotation.z = -1.6 + Math.sin(t * 7.5) * 0.55;
                            hRig.armR.rotation.z = 1.6 + Math.cos(t * 7.5) * 0.55;
                            hRig.legL.rotation.x = Math.sin(t * 7.5) * 0.32;
                            hRig.legR.rotation.x = -Math.sin(t * 7.5) * 0.32;
                        } else {
                            hRig.robotGroup.position.x *= 0.9;
                            hRig.robotGroup.rotation.z *= 0.9;
                            hRig.armL.rotation.z = -0.22 + Math.sin(t * 2.4) * 0.08;
                            hRig.armR.rotation.z = 0.22 - Math.sin(t * 2.4) * 0.08;
                            hRig.armR.rotation.x = 0;
                            hRig.legL.rotation.x = Math.sin(t * 2.2) * 0.1;
                            hRig.legR.rotation.x = -Math.sin(t * 2.2) * 0.1;
                        }

                        // Flicker thrusters & blink
                        hRig.flames.forEach(function(fl, fi) {
                            fl.scale.y = 0.78 + Math.sin(t * 24 + fi * 2) * 0.28;
                        });
                        hRig.chestLeds.forEach(function(ld, i) {
                            ld.mat.emissiveIntensity = 0.6 + 0.9 * (0.5 + 0.5 * Math.sin(t * 4 - i * 1.1));
                        });
                        heroState.blinkTimer -= dt;
                        if (heroState.blinkTimer <= 0) {
                            hRig.eyeL.scale.y = 0.12;
                            hRig.eyeR.scale.y = 0.12;
                            if (heroState.blinkTimer <= -0.11) {
                                hRig.eyeL.scale.y = 1.32;
                                hRig.eyeR.scale.y = 1.32;
                                heroState.blinkTimer = 2.4 + Math.random() * 2.8;
                            }
                        }

                        // Animate Orbiting Props & Hologram Pedestal
                        if (hRig.props) {
                            hRig.props.holoRing1.rotation.z = t * 0.9;
                            hRig.props.holoRing2.rotation.z = -t * 1.3;
                            hRig.props.coinPivot.rotation.y = t * 0.65;
                            hRig.props.coinSpinGroup.rotation.y = t * 2.4;
                            hRig.props.coinSpinGroup.position.y = 0.35 + Math.sin(t * 2.6) * 0.08;
                            hRig.props.cardPivot.rotation.y = t * 0.65 + 0.3;
                            hRig.props.cardGroup.position.y = 0.22 + Math.cos(t * 2.6) * 0.08;
                            hRig.props.cardGroup.rotation.y = Math.sin(t * 1.4) * 0.45;
                        }

                        hRenderer.render(hScene, hCam);
                        if (!hFirstFrame) {
                            hFirstFrame = true;
                            if (heroFallback) heroFallback.style.display = 'none';
                        }
                    }
                    requestAnimationFrame(renderHero);
                } catch (err) {
                    // Fallback SVG stays visible smoothly if WebGL unavailable
                }
            }

            // ── STAGE 2: FLOATING KASBOT 3D MASCOT ──
            var kbCanvas = document.getElementById('kasbot-3d-canvas');
            var kbSvg = document.getElementById('kasbot-svg');
            var kbInner = document.getElementById('kasbot-inner');
            var kbIrisL = document.getElementById('kb-iris-l');
            var kbEyeEl = document.getElementById('kb-eyes');
            var kbArmL  = document.getElementById('kb-arm-l');

            if (kbCanvas) {
                try {
                    var kScene = new THREE.Scene();
                    var kCam = new THREE.PerspectiveCamera(35, 128 / 148, 0.1, 40);
                    kCam.position.set(0, 0.28, 4.1);
                    kCam.lookAt(0, 0.26, 0);

                    var kRenderer = new THREE.WebGLRenderer({ canvas: kbCanvas, alpha: true, antialias: true, powerPreference: 'high-performance' });
                    kRenderer.setClearColor(0x000000, 0);
                    kRenderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
                    kRenderer.setSize(128, 148, false);

                    kScene.add(new THREE.HemisphereLight(0xe0f2fe, 0x0f172a, 1.0));
                    var kKey = new THREE.DirectionalLight(0xffffff, 1.35);
                    kKey.position.set(2.5, 4.5, 4);
                    kScene.add(kKey);
                    var kRim = new THREE.PointLight(0x38bdf8, 1.6, 10);
                    kRim.position.set(-2.5, 1.5, 2.5);
                    kScene.add(kRim);

                    var kRig = buildEkBotRig(THREE, { withProps: false });
                    kScene.add(kRig.sceneGroup);

                    var kb3d = {
                        mood: 'normal',
                        spinTarget: 0,
                        spinAngle: 0,
                        bankYaw: 0,
                        jumpT: 0,
                        blinkTimer: 2.0
                    };

                    function inferMoodFromSvg() {
                        var st = window.__kbPhysicsState;
                        if (st && st.isSleeping) return 'sleeping';
                        if (kbEyeEl) {
                            var spec = kbEyeEl.querySelector('.kb-special-eye');
                            if (spec) {
                                var txt = (spec.textContent || '').trim();
                                if (txt === '★') return 'excited';
                                if (txt === '♥') return 'love';
                                if (txt === '😎') return 'cool';
                                if (txt === '✕') return 'dizzy';
                                return 'sleeping';
                            }
                        }
                        if (kbIrisL) {
                            var fill = (kbIrisL.getAttribute('fill') || '').toLowerCase();
                            if (fill === '#34d399') return 'happy';
                            if (fill === '#f472b6') return 'surprised';
                            if (fill === '#94a3b8') return 'sad';
                        }
                        return 'normal';
                    }

                    if (kbInner) {
                        new MutationObserver(function() {
                            if (kbInner.classList.contains('spin')) {
                                kb3d.spinTarget += Math.PI * 2;
                                kb3d.jumpT = 1.0;
                            } else if (kbInner.classList.contains('tap-burst')) {
                                kb3d.jumpT = 0.7;
                            }
                        }).observe(kbInner, { attributes: true, attributeFilter: ['class'] });
                    }

                    if (kbIrisL && kbEyeEl) {
                        var syncMood = function() {
                            kb3d.mood = inferMoodFromSvg();
                            kRig.applyMood(kb3d.mood);
                        };
                        new MutationObserver(syncMood).observe(kbIrisL, { attributes: true, attributeFilter: ['fill'] });
                        new MutationObserver(syncMood).observe(kbEyeEl, { childList: true });
                    }

                    window.addEventListener('kasbot:theme', function(ev) {
                        if (!ev || !ev.detail) return;
                        kRig.setThemeColors(ev.detail.accent, ev.detail.light);
                        kRim.color.setHex(hexStringToInt(ev.detail.light, 0x38bdf8));
                    });

                    var kLast = performance.now();
                    var kFirstFrame = false;
                    function renderKasBot3D(now) {
                        requestAnimationFrame(renderKasBot3D);
                        if (document.hidden) {
                            kLast = now;
                            return;
                        }
                        var dt = Math.min(0.05, (now - kLast) / 1000);
                        kLast = now;
                        var t = now * 0.001;
                        var st = window.__kbPhysicsState || { px: 60, py: 400, vx: 0, vy: 0, isSleeping: false };

                        // Update sleeping transition cleanly
                        var nowSleep = !!st.isSleeping;
                        if (nowSleep && kb3d.mood !== 'sleeping') {
                            kb3d.mood = 'sleeping';
                            kRig.applyMood('sleeping');
                        } else if (!nowSleep && kb3d.mood === 'sleeping') {
                            kb3d.mood = inferMoodFromSvg();
                            kRig.applyMood(kb3d.mood);
                        }

                        // Jump & Float Bob
                        var jumpOffset = 0;
                        if (kb3d.jumpT > 0) {
                            kb3d.jumpT = Math.max(0, kb3d.jumpT - dt * 2.2);
                            jumpOffset = Math.sin(kb3d.jumpT * Math.PI) * 0.25;
                        }
                        kRig.robotGroup.position.y = (nowSleep ? -0.04 : Math.sin(t * 2.6) * 0.06) + jumpOffset;

                        // Lean toward travel velocity + clean 360-degree barrel roll
                        kb3d.spinAngle += (kb3d.spinTarget - kb3d.spinAngle) * 0.14;
                        var targetBankYaw = Math.max(-0.45, Math.min(0.45, (st.vx || 0) * 0.06));
                        kb3d.bankYaw += (targetBankYaw - kb3d.bankYaw) * 0.1;
                        var bankPitch = Math.max(-0.2, Math.min(0.2, (st.vy || 0) * 0.03));
                        kRig.robotGroup.rotation.y = kb3d.bankYaw + kb3d.spinAngle;
                        kRig.robotGroup.rotation.x += (bankPitch - kRig.robotGroup.rotation.x) * 0.1;

                        // Cursor Aim Relative to Mascot Screen Position
                        if (nowSleep) {
                            kRig.headGroup.rotation.x += (0.28 - kRig.headGroup.rotation.x) * 0.06;
                            kRig.headGroup.rotation.y += (0 - kRig.headGroup.rotation.y) * 0.06;
                        } else {
                            var cx = (st.px || 0) + 64;
                            var cy = (st.py || 0) + 52;
                            var relX = Math.max(-0.52, Math.min(0.52, (pointerNorm.clientX - cx) / 360));
                            var relY = Math.max(-0.24, Math.min(0.26, (pointerNorm.clientY - cy) / 360));
                            kRig.headGroup.rotation.y += (relX - kRig.headGroup.rotation.y) * 0.12;
                            kRig.headGroup.rotation.x += (relY - kRig.headGroup.rotation.x) * 0.12;
                        }

                        // Waving Arms (synced to #kb-arm-l attribute transform or idle sway)
                        var isWaving = kbArmL && kbArmL.hasAttribute('transform');
                        if (isWaving) {
                            kRig.armL.rotation.z = -1.9 + Math.sin(t * 12) * 0.5;
                            kRig.armR.rotation.z = 1.9 + Math.cos(t * 12) * 0.5;
                        } else if (nowSleep) {
                            kRig.armL.rotation.z = -0.1;
                            kRig.armR.rotation.z = 0.1;
                        } else {
                            kRig.armL.rotation.z = -0.24 + Math.sin(t * 2.5) * 0.09;
                            kRig.armR.rotation.z = 0.24 - Math.sin(t * 2.5) * 0.09;
                        }
                        kRig.legL.rotation.x = nowSleep ? 0.1 : Math.sin(t * 2.6) * 0.12;
                        kRig.legR.rotation.x = nowSleep ? 0.1 : -Math.sin(t * 2.6) * 0.12;

                        // Jetpack flames
                        kRig.flames.forEach(function(fl, fi) {
                            fl.visible = !nowSleep;
                            fl.scale.y = 0.72 + Math.sin(t * 25 + fi * 2) * 0.3;
                        });
                        kRig.chestLeds.forEach(function(ld, i) {
                            ld.mat.emissiveIntensity = nowSleep ? 0.15 : (0.6 + 0.9 * (0.5 + 0.5 * Math.sin(t * 4.5 - i * 1.1)));
                        });

                        // Periodic blink in awake states
                        if (!nowSleep) {
                            kb3d.blinkTimer -= dt;
                            if (kb3d.blinkTimer <= 0) {
                                kRig.eyeL.scale.y = 0.12;
                                kRig.eyeR.scale.y = 0.12;
                                if (kb3d.blinkTimer <= -0.11) {
                                    kRig.applyMood(kb3d.mood);
                                    kb3d.blinkTimer = 2.2 + Math.random() * 3.0;
                                }
                            }
                        }

                        kRenderer.render(kScene, kCam);
                        if (!kFirstFrame) {
                            kFirstFrame = true;
                            if (kbSvg) kbSvg.style.opacity = '0';
                        }
                    }
                    requestAnimationFrame(renderKasBot3D);
                } catch (err) {
                    // Fallback SVG remains cleanly visible
                }
            }
        }

        function loadThreeAndBoot() {
            if (window.THREE) {
                boot3DCharacters(window.THREE);
                return;
            }
            var s1 = document.createElement('script');
            s1.src = 'https://cdn.jsdelivr.net/npm/three@0.149.0/build/three.min.js';
            s1.async = true;
            s1.onload = function() {
                if (window.THREE) boot3DCharacters(window.THREE);
            };
            s1.onerror = function() {
                var s2 = document.createElement('script');
                s2.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js';
                s2.async = true;
                s2.onload = function() {
                    if (window.THREE) boot3DCharacters(window.THREE);
                };
                document.head.appendChild(s2);
            };
            document.head.appendChild(s1);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadThreeAndBoot);
        } else {
            loadThreeAndBoot();
        }
    })();
    </script>

    @include('components.ai-cs-widget')
</body>
</html>
