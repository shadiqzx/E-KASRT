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
            <a href="#fitur" class="btn-cta-secondary">
                <i class="fas fa-compass"></i>
                <span>Jelajahi Fitur Sekilas</span>
            </a>
        </div>

        <!-- Scroll Down Hint -->
        <div class="scroll-down-hint" onclick="document.querySelector('.stats-grid').scrollIntoView({behavior:'smooth'})">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- 3. LIVE STATS TICKER (Real DB Numbers) -->
    <section class="stats-grid">
        <!-- Stat 1: Saldo Kas -->
        <div class="glass-stat-card reveal delay-1">
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

        <!-- Scroll Down Hint -->
        <div class="scroll-down-hint" onclick="document.querySelector('.stats-grid').scrollIntoView({behavior:'smooth'})">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- 4. FEATURE SHOWCASE (FITUR SEKILAS) -->
    <section class="features-section reveal" id="fitur">
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

        <!-- Scroll Down Hint -->
        <div class="scroll-down-hint" onclick="document.querySelector('.stats-grid').scrollIntoView({behavior:'smooth'})">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
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
        <div id="kasbot-inner">
        <!-- SVG Robot -->
        <svg id="kasbot-svg" width="96" height="120" viewBox="0 0 96 120" xmlns="http://www.w3.org/2000/svg">
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

        var W = 96, H = 120;

        /* ══════════════════════════════════════════
           ZERO-GRAVITY PHYSICS ENGINE
        ══════════════════════════════════════════ */
        var px, py, vx, vy, rotation = 0, angVel = 0;
        var DAMPING = 0.995, BOUNCE = 0.72, ANG_DAMP = 0.97;
        var physicsRunning = true; // ← BUG FIX: was missing → loop returned immediately
        var isDragging = false;
        var tapCount = 0, isSleeping = false;
        var sleepTimer = null, bubbleTimer = null, faceTimer = null;
        var msgIdx = 0;

        px = window.innerWidth  / 2 - W / 2;
        py = window.innerHeight / 2 - H / 2;
        vx = (Math.random() - 0.5) * 2.5;
        vy = (Math.random() - 0.5) * 2.5;
        angVel = (Math.random() - 0.5) * 0.6;

        // KEY FIX: position via left/top (NOT transform) so wrap.style.transform
        // is free for rotation ONLY — and inner is NEVER touched by JS inline style,
        // so CSS animations on inner (.tap-burst, .squash-x, .spin) run without conflict.
        function applyTransform() {
            wrap.style.left      = Math.round(px) + 'px';
            wrap.style.top       = Math.round(py) + 'px';
            wrap.style.transform = 'rotate(' + rotation.toFixed(2) + 'deg)';
            // inner is NEVER set here — CSS animations own inner's transform
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
            showBubble('👋 Hai! Aku KasBot!\nAku bebas melayang~\nTap aku dong! 🤖', 4500);
            waveArms();
            resetSleepTimer();
        }, 1000);

    })();
    </script>
    {{-- ===== END KASBOT MASCOT ===== --}}

</body>
</html>
