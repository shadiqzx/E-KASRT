<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar Warga Baru | E-KASRT</title>
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
            --primary-glow: #0284c7;
            --accent-glow: #2563eb;
            --emerald-glow: #10b981;
        }

        body {
            font-family: var(--app-font);
            background: #070d1b;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            padding: 30px 20px;
        }

        /* Ambient Dynamic Background & Glowing Mesh Orbs */
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
            filter: blur(80px);
            opacity: 0.65;
            animation: orbFloat 14s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(2, 132, 199, 0.75) 0%, rgba(37, 99, 235, 0.1) 70%);
            top: -120px;
            left: -80px;
            animation-duration: 16s;
        }

        .orb-2 {
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.6) 0%, rgba(6, 182, 212, 0.08) 70%);
            bottom: -100px;
            right: 5%;
            animation-duration: 18s;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.5) 0%, rgba(219, 39, 119, 0.05) 70%);
            top: 40%;
            left: 45%;
            animation-duration: 20s;
            animation-delay: -8s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.08); }
            100% { transform: translate(-25px, 35px) scale(0.95); }
        }

        /* Grid Pattern Overlay */
        .ambient-canvas::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 85%);
            -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 85%);
        }

        /* Main Container Layout */
        .register-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1180px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 1.25fr;
            align-items: center;
            gap: 48px;
        }

        /* LEFT HERO SECTION */
        .hero-section {
            padding: 20px 10px;
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            color: #7dd3fc;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.8);
            animation: pulseGlow 2s infinite;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.8); }
            70% { box-shadow: 0 0 0 8px rgba(52, 211, 153, 0); }
            100% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0); }
        }

        .hero-title {
            font-size: 44px;
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -1.2px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .hero-title span.accent-text {
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 50%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .hero-desc {
            font-size: 15.5px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 34px;
            max-width: 480px;
        }

        .hero-features-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 14.5px;
            color: #e2e8f0;
            font-weight: 600;
        }

        .feature-icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #38bdf8;
            font-size: 15px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* RIGHT PURE GLASS CARD */
        .glass-card-register {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(28px) saturate(190%);
            -webkit-backdrop-filter: blur(28px) saturate(190%);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 30px;
            padding: 40px 36px;
            box-shadow: 
                0 30px 60px -15px rgba(0, 0, 0, 0.5),
                inset 0 1px 1px rgba(255, 255, 255, 0.35),
                inset 0 -1px 1px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .glass-card-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #38bdf8, #818cf8, #34d399);
        }

        .card-header-box {
            margin-bottom: 24px;
        }

        .brand-badge-mini {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .brand-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 17px;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.45);
        }

        .brand-badge-text {
            font-size: 12px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .card-title {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.6px;
            margin-bottom: 4px;
        }

        .card-subtitle {
            font-size: 13px;
            color: #94a3b8;
        }

        /* Form Grid 2 Cols */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group-custom {
            margin-bottom: 16px;
            position: relative;
        }

        .form-label-custom {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 6px;
        }

        .input-pill-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-pill-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 14px;
            pointer-events: none;
        }

        .input-pill-field {
            width: 100%;
            height: 46px;
            padding: 10px 14px 10px 42px;
            background: #ffffff;
            border: 1.5px solid transparent;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            font-family: var(--app-font);
            outline: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .input-pill-field:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
        }

        .input-pill-field::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        select.input-pill-field {
            cursor: pointer;
            padding-right: 30px;
        }

        .toggle-pwd-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #64748b;
            font-size: 14px;
            cursor: pointer;
            padding: 4px;
            outline: none;
        }

        /* Validation Alerts */
        .glass-alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            backdrop-filter: blur(8px);
        }
        .glass-alert-error {
            background: rgba(225, 29, 72, 0.2);
            border: 1px solid rgba(251, 113, 133, 0.4);
            color: #fecdd3;
        }
        .glass-alert-error ul {
            margin: 6px 0 0 18px;
            font-size: 12.5px;
        }

        /* Submit Button */
        .btn-submit-glass {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 10px 25px -4px rgba(16, 185, 129, 0.45), inset 0 1px 1px rgba(255, 255, 255, 0.3);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            margin-bottom: 18px;
        }

        .btn-submit-glass:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -4px rgba(16, 185, 129, 0.6), inset 0 1px 1px rgba(255, 255, 255, 0.4);
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
        }

        .card-footer-links {
            text-align: center;
            font-size: 13px;
            color: #cbd5e1;
        }

        .card-footer-links a {
            color: #38bdf8;
            font-weight: 700;
            text-decoration: none;
        }
        .card-footer-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .register-wrapper {
                grid-template-columns: 1fr;
                gap: 28px;
                max-width: 520px;
            }
            .hero-section {
                text-align: center;
                padding: 10px 0;
            }
            .hero-title {
                font-size: 32px;
            }
            .hero-desc {
                margin: 0 auto 20px auto;
            }
            .hero-features-list {
                display: none;
            }
            .form-grid-2 {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .glass-card-register {
                padding: 30px 22px;
                border-radius: 24px;
            }
        }

        /* ================================================================
           HYDROGEN VISUAL, INTERACTIVE DIGITAL ID & ANIMATION ENGINE
           ================================================================ */
        #hydrogen-canvas {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes hydroRiseIn {
            from { opacity: 0; transform: translateY(20px) scale(0.985); filter: blur(4px); }
            to { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
        }
        .hero-section .hero-badge-pill { animation: hydroRiseIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) both 0.04s; }
        .hero-section .hero-title      { animation: hydroRiseIn 0.65s cubic-bezier(0.22, 1, 0.36, 1) both 0.12s; }
        .hero-section .hero-desc       { animation: hydroRiseIn 0.7s cubic-bezier(0.22, 1, 0.36, 1) both 0.2s; }
        .live-ekasrt-card-wrap         { animation: hydroRiseIn 0.75s cubic-bezier(0.22, 1, 0.36, 1) both 0.28s; }
        .reg-flow-steps                { animation: hydroRiseIn 0.75s cubic-bezier(0.22, 1, 0.36, 1) both 0.36s; }
        .glass-card-register           { animation: hydroRiseIn 0.75s cubic-bezier(0.22, 1, 0.36, 1) both 0.16s; }

        /* Live Interactive 3D Digital Resident Card */
        .live-ekasrt-card-wrap {
            perspective: 1000px;
            margin: 22px 0 20px 0;
        }
        .live-ekasrt-card {
            position: relative;
            border-radius: 22px;
            padding: 20px 22px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.24) 0%, rgba(15, 23, 42, 0.82) 55%, rgba(16, 185, 129, 0.22) 100%);
            border: 1px solid rgba(56, 189, 248, 0.35);
            box-shadow: 0 24px 48px -14px rgba(2, 6, 23, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            overflow: hidden;
            transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.3s ease;
            transform-style: preserve-3d;
        }
        .live-ekasrt-card::before {
            content: '';
            position: absolute;
            inset: -40%;
            background: conic-gradient(from 0deg at 50% 50%, transparent, rgba(56, 189, 248, 0.16), transparent, rgba(52, 211, 153, 0.16), transparent);
            animation: cardHoloSpin 11s linear infinite;
            pointer-events: none;
        }
        @keyframes cardHoloSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .lec-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            position: relative;
            z-index: 2;
        }
        .lec-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: #e0f2fe;
        }
        .lec-status-pill {
            font-size: 9.5px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 999px;
            background: rgba(245, 158, 11, 0.22);
            border: 1px solid rgba(251, 191, 36, 0.45);
            color: #fde68a;
            letter-spacing: 0.4px;
        }
        .lec-mid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            position: relative;
            z-index: 2;
        }
        .lec-nik {
            font-family: var(--mono-font);
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1.6px;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(56, 189, 248, 0.35);
            position: relative;
            z-index: 2;
            margin-bottom: 12px;
        }
        .lec-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            position: relative;
            z-index: 2;
        }
        .lec-label {
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-bottom: 2px;
        }
        .lec-val {
            font-size: 13.5px;
            font-weight: 700;
            color: #f8fafc;
            max-width: 190px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* 3-Step Registration Visual Flow */
        .reg-flow-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 22px;
        }
        .reg-step-box {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 11px 12px;
            transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease;
        }
        .reg-step-box:hover {
            transform: translateY(-3px);
            border-color: rgba(56, 189, 248, 0.45);
            background: rgba(56, 189, 248, 0.09);
        }
        .reg-step-num {
            font-family: var(--mono-font);
            font-size: 10.5px;
            font-weight: 700;
            color: #38bdf8;
            margin-bottom: 3px;
        }
        .reg-step-txt {
            font-size: 11.5px;
            font-weight: 600;
            color: #e2e8f0;
            line-height: 1.3;
        }

        /* Glass Card Spotlight & Shimmer CTA */
        .glass-card-register {
            --mx: 50%;
            --my: 50%;
            position: relative;
            overflow: hidden;
        }
        .glass-card-register::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(460px circle at var(--mx) var(--my), rgba(16, 185, 129, 0.12), transparent 55%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .glass-card-register:hover::after { opacity: 1; }

        .btn-submit-glass {
            position: relative;
            overflow: hidden;
        }
        .btn-submit-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 70%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: skewX(-22deg);
            transition: left 0.7s ease;
        }
        .btn-submit-glass:hover::before { left: 160%; }

        .input-pill-wrap:focus-within .input-pill-icon {
            color: #059669;
            transform: scale(1.1);
            transition: all 0.2s;
        }

        /* Live Helpers: NIK Counter, Password Strength & Match Pill */
        .field-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }
        .field-meta-row .form-label-custom {
            margin-bottom: 0;
        }
        .meta-counter-pill {
            font-family: var(--mono-font);
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            background: rgba(148, 163, 184, 0.16);
            color: #cbd5e1;
            transition: all 0.2s;
        }
        .meta-counter-pill.is-valid {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }
        .pwd-strength-track {
            height: 4px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            margin-top: 7px;
            overflow: hidden;
        }
        .pwd-strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 999px;
            transition: width 0.3s ease, background 0.3s ease;
        }
        .pwd-status-note {
            font-size: 11px;
            margin-top: 5px;
            color: #94a3b8;
            min-height: 15px;
            font-weight: 600;
        }

        @media (max-width: 991px) {
            .live-ekasrt-card-wrap,
            .reg-flow-steps {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Floating Orbs & Hydrogen Constellation Canvas -->
    <div class="ambient-canvas">
        <canvas id="hydrogen-canvas"></canvas>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Main Container -->
    <div class="register-wrapper">

        <!-- LEFT HERO SECTION -->
        <div class="hero-section">
            <div class="hero-badge-pill">
                <span class="pulse-dot"></span>
                PORTAL RESMI PENDAFTARAN WARGA
            </div>

            <h1 class="hero-title">
                Bergabung Bersama <br>
                Komunitas <span class="accent-text">RT Kita.</span>
            </h1>

            <p class="hero-desc">
                Daftarkan identitas Anda untuk akses transparansi kas, status pembayaran iuran, dan kemudahan administrasi kependudukan digital.
            </p>

            <!-- Live Interactive 3D Digital Resident Card Preview -->
            <div class="live-ekasrt-card-wrap">
                <div class="live-ekasrt-card" id="liveResidentCard">
                    <div class="lec-top">
                        <div class="lec-brand">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            <span>KARTU WARGA DIGITAL E-KASRT</span>
                        </div>
                        <span class="lec-status-pill">VERIFIKASI RT</span>
                    </div>
                    <div class="lec-mid">
                        <!-- Custom Chip + Contactless NFC Waves SVG -->
                        <svg width="40" height="30" viewBox="0 0 40 30" fill="none">
                            <rect x="1" y="1" width="38" height="28" rx="6" fill="rgba(251,191,36,0.22)" stroke="#fbbf24" stroke-width="1.3"/>
                            <path d="M1 11H14M1 19H14M26 11H39M26 19H39M14 1V29M26 1V29" stroke="rgba(251,191,36,0.65)" stroke-width="1.1"/>
                        </svg>
                        <svg width="34" height="34" viewBox="0 0 36 36" fill="none">
                            <circle cx="10" cy="18" r="2.5" fill="#34d399"/>
                            <path d="M15 12.5a7.5 7.5 0 0 1 0 11" stroke="#38bdf8" stroke-width="2" stroke-linecap="round">
                                <animate attributeName="opacity" values="0.3;1;0.3" dur="1.6s" repeatCount="indefinite"/>
                            </path>
                            <path d="M19.5 8.5a13 13 0 0 1 0 19" stroke="#34d399" stroke-width="2" stroke-linecap="round">
                                <animate attributeName="opacity" values="0.2;0.95;0.2" dur="1.6s" begin="0.4s" repeatCount="indefinite"/>
                            </path>
                            <path d="M24 5a18 18 0 0 1 0 26" stroke="#a78bfa" stroke-width="2" stroke-linecap="round">
                                <animate attributeName="opacity" values="0.15;0.85;0.15" dur="1.6s" begin="0.8s" repeatCount="indefinite"/>
                            </path>
                        </svg>
                    </div>
                    <div class="lec-nik" id="previewCardNik">3201 •••• •••• ••••</div>
                    <div class="lec-bottom">
                        <div>
                            <div class="lec-label">Nama Warga</div>
                            <div class="lec-val" id="previewCardName">CALON WARGA RT</div>
                        </div>
                        <div style="text-align:right;">
                            <div class="lec-label">Rumah / Gender</div>
                            <div class="lec-val" id="previewCardHome">RT Digital</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3-Step Flow Visual -->
            <div class="reg-flow-steps">
                <div class="reg-step-box">
                    <div class="reg-step-num">01. DAFTAR</div>
                    <div class="reg-step-txt">Lengkapi NIK &amp; profil warga</div>
                </div>
                <div class="reg-step-box">
                    <div class="reg-step-num">02. TINJAUAN</div>
                    <div class="reg-step-txt">Validasi oleh Pengurus RT</div>
                </div>
                <div class="reg-step-box">
                    <div class="reg-step-num">03. AKTIF</div>
                    <div class="reg-step-txt">Akses kas, iuran &amp; IoT</div>
                </div>
            </div>

            <div class="hero-features-list">
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <span>Pantau Arus Kas Masuk &amp; Kas Keluar RT Secara Terbuka</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="m9 15 2 2 4-4"/></svg>
                    </div>
                    <span>Riwayat Iuran Warga &amp; Kwitansi Digital Otomatis</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#f472b6" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M3.22 12H9.5l1.5-3 2 6 1.5-3h5.28"/></svg>
                    </div>
                    <span>Layanan Posyandu Balita IoT &amp; Pengajuan Surat Pengantar</span>
                </div>
            </div>
        </div>

        <!-- RIGHT GLASS CARD -->
        <div class="glass-card-register">
            <div class="card-header-box">
                <div class="brand-badge-mini">
                    <div class="brand-logo-icon">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    </div>
                    <span class="brand-badge-text">Registrasi Warga Baru</span>
                </div>
                <h2 class="card-title">Daftar Akun</h2>
                <p class="card-subtitle">Lengkapi formulir data kependudukan Anda dengan benar.</p>
                
                <!-- Notice: Akun Harus Diverifikasi Pengurus RT -->
                <div style="background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.35); border-radius: 14px; padding: 12px 16px; margin-top: 14px; margin-bottom: 16px; display: flex; align-items: flex-start; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" style="flex-shrink:0; margin-top:2px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                    <div style="font-size: 12.5px; color: #fde68a; line-height: 1.5;">
                        <strong style="color: #fbbf24;">Verifikasi Pengurus RT:</strong> Akun baru tidak langsung aktif demi keamanan data warga. Setelah mendaftar, Pengurus RT akan meninjau dan memverifikasi data Anda sebelum akun dapat digunakan untuk login.
                    </div>
                </div>
            </div>

            <!-- Error Alerts -->
            @if($errors->any())
                <div class="glass-alert glass-alert-error">
                    <div>
                        <strong><i class="fas fa-exclamation-circle mr-1"></i> Mohon periksa kembali form:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Form Registrasi -->
            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="nama">Nama Lengkap (Sesuai KTP) *</label>
                    <div class="input-pill-wrap">
                        <i class="fas fa-user input-pill-icon"></i>
                        <input type="text" name="nama" id="nama" class="input-pill-field" placeholder="Contoh: Rahmat Hidayat" value="{{ old('nama') }}" required>
                    </div>
                </div>

                <!-- Grid NIK & No KK -->
                <div class="form-grid-2">
                    <div class="form-group-custom">
                        <div class="field-meta-row">
                            <label class="form-label-custom" for="nik">NIK KTP (16 Digit) *</label>
                            <span class="meta-counter-pill" id="nikCountPill">0/16</span>
                        </div>
                        <div class="input-pill-wrap">
                            <i class="fas fa-id-card input-pill-icon"></i>
                            <input type="text" name="nik" id="nik" class="input-pill-field" placeholder="16 digit NIK" maxlength="16" value="{{ old('nik') }}" required>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <div class="field-meta-row">
                            <label class="form-label-custom" for="no_kk">Nomor Kartu Keluarga (KK)</label>
                            <span class="meta-counter-pill" id="kkCountPill">0/16</span>
                        </div>
                        <div class="input-pill-wrap">
                            <i class="fas fa-home input-pill-icon"></i>
                            <input type="text" name="no_kk" id="no_kk" class="input-pill-field" placeholder="16 digit No. KK" maxlength="16" value="{{ old('no_kk') }}">
                        </div>
                    </div>
                </div>

                <!-- Grid Jenis Kelamin & No WhatsApp -->
                <div class="form-grid-2">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="jekel">Jenis Kelamin *</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-venus-mars input-pill-icon"></i>
                            <select name="jekel" id="jekel" class="input-pill-field" required>
                                <option value="Laki-laki" {{ old('jekel') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jekel') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="no_hp">No. WhatsApp / HP</label>
                        <div class="input-pill-wrap">
                            <i class="fab fa-whatsapp input-pill-icon"></i>
                            <input type="text" name="no_hp" id="no_hp" class="input-pill-field" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
                        </div>
                    </div>
                </div>

                <!-- Alamat & No Rumah -->
                <div class="form-grid-2">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="alamat">Alamat / Blok Rumah</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-map-marker-alt input-pill-icon"></i>
                            <input type="text" name="alamat" id="alamat" class="input-pill-field" placeholder="Contoh: Jl. Kenanga Blok C" value="{{ old('alamat') }}">
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="no_rumah">No. Rumah</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-building input-pill-icon"></i>
                            <input type="text" name="no_rumah" id="no_rumah" class="input-pill-field" placeholder="No. 12" value="{{ old('no_rumah') }}">
                        </div>
                    </div>
                </div>

                <!-- Username Akun -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="username">Username untuk Login *</label>
                    <div class="input-pill-wrap">
                        <i class="fas fa-at input-pill-icon"></i>
                        <input type="text" name="username" id="username" class="input-pill-field" placeholder="Ketik username akun (tanpa spasi)..." value="{{ old('username') }}" required>
                    </div>
                </div>

                <!-- Password & Konfirmasi Password -->
                <div class="form-grid-2">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="password">Password *</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-lock input-pill-icon"></i>
                            <input type="password" name="password" id="password" class="input-pill-field" placeholder="Minimal 4 karakter" required style="padding-right:40px;">
                            <button type="button" class="toggle-pwd-btn" onclick="toggleRegPassword('password', 'regEye1')" title="Lihat Password">
                                <i class="fas fa-eye" id="regEye1"></i>
                            </button>
                        </div>
                        <div class="pwd-strength-track"><div class="pwd-strength-fill" id="pwdStrengthFill"></div></div>
                        <div class="pwd-status-note" id="pwdStrengthNote"></div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="password_confirmation">Ulangi Password *</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-check-circle input-pill-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="input-pill-field" placeholder="Ketik ulang password" required style="padding-right:40px;">
                            <button type="button" class="toggle-pwd-btn" onclick="toggleRegPassword('password_confirmation', 'regEye2')" title="Lihat Konfirmasi Password">
                                <i class="fas fa-eye" id="regEye2"></i>
                            </button>
                        </div>
                        <div class="pwd-status-note" id="pwdMatchNote" style="margin-top:11px;"></div>
                    </div>
                </div>

                <script id="hydrogen-register-engine">
                    function toggleRegPassword(inputId, iconId) {
                        var input = document.getElementById(inputId);
                        var icon = document.getElementById(iconId);
                        if (!input || !icon) return;
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            input.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    }

                    (function() {
                        // Hydrogen Constellation Particle Background
                        var canvas = document.getElementById('hydrogen-canvas');
                        if (canvas && canvas.getContext) {
                            var ctx = canvas.getContext('2d');
                            var w = 0, h = 0;
                            var mouse = { x: -9999, y: -9999 };
                            var count = window.innerWidth < 768 ? 18 : 38;
                            var pts = [];

                            function resize() {
                                w = canvas.width = window.innerWidth;
                                h = canvas.height = window.innerHeight;
                            }
                            resize();
                            window.addEventListener('resize', resize, { passive: true });
                            document.addEventListener('mousemove', function(e) {
                                mouse.x = e.clientX;
                                mouse.y = e.clientY;
                            }, { passive: true });

                            for (var i = 0; i < count; i++) {
                                pts.push({
                                    x: Math.random() * (w || 1200),
                                    y: Math.random() * (h || 800),
                                    vx: (Math.random() - 0.5) * 0.42,
                                    vy: (Math.random() - 0.5) * 0.42,
                                    r: 1.4 + Math.random() * 1.7
                                });
                            }

                            function loop() {
                                ctx.clearRect(0, 0, w, h);
                                for (var i = 0; i < pts.length; i++) {
                                    var p = pts[i];
                                    p.x += p.vx;
                                    p.y += p.vy;
                                    if (p.x < 0 || p.x > w) p.vx *= -1;
                                    if (p.y < 0 || p.y > h) p.vy *= -1;

                                    var dxm = p.x - mouse.x, dym = p.y - mouse.y;
                                    var dm = Math.sqrt(dxm * dxm + dym * dym);
                                    if (dm < 130 && dm > 1) {
                                        p.x += (dxm / dm) * 0.55;
                                        p.y += (dym / dm) * 0.55;
                                    }

                                    ctx.beginPath();
                                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                                    ctx.fillStyle = 'rgba(52, 211, 153, 0.5)';
                                    ctx.fill();

                                    for (var j = i + 1; j < pts.length; j++) {
                                        var q = pts[j];
                                        var dx = p.x - q.x, dy = p.y - q.y;
                                        var d = Math.sqrt(dx * dx + dy * dy);
                                        if (d < 125) {
                                            ctx.beginPath();
                                            ctx.moveTo(p.x, p.y);
                                            ctx.lineTo(q.x, q.y);
                                            ctx.strokeStyle = 'rgba(56, 189, 248, ' + ((1 - d / 125) * 0.16).toFixed(3) + ')';
                                            ctx.lineWidth = 1;
                                            ctx.stroke();
                                        }
                                    }
                                }
                                requestAnimationFrame(loop);
                            }
                            loop();
                        }

                        // Live Interactive 3D Digital Resident Card Preview Sync
                        var namaEl = document.getElementById('nama');
                        var nikEl = document.getElementById('nik');
                        var kkEl = document.getElementById('no_kk');
                        var rumahEl = document.getElementById('no_rumah');
                        var jekelEl = document.getElementById('jekel');
                        var previewName = document.getElementById('previewCardName');
                        var previewNik = document.getElementById('previewCardNik');
                        var previewHome = document.getElementById('previewCardHome');
                        var nikPill = document.getElementById('nikCountPill');
                        var kkPill = document.getElementById('kkCountPill');

                        function formatNikMask(val) {
                            var clean = (val || '').replace(/\D/g, '').slice(0, 16);
                            if (!clean.length) return '3201 •••• •••• ••••';
                            var padded = clean + '•'.repeat(Math.max(0, 16 - clean.length));
                            return padded.replace(/(.{4})/g, '$1 ').trim();
                        }

                        function syncCardPreview() {
                            if (previewName && namaEl) {
                                var n = namaEl.value.trim();
                                previewName.textContent = n ? n.toUpperCase() : 'CALON WARGA RT';
                            }
                            if (nikEl) {
                                var cleanNik = nikEl.value.replace(/\D/g, '').slice(0, 16);
                                if (nikEl.value !== cleanNik) nikEl.value = cleanNik;
                                if (previewNik) previewNik.textContent = formatNikMask(cleanNik);
                                if (nikPill) {
                                    nikPill.textContent = cleanNik.length + '/16';
                                    nikPill.classList.toggle('is-valid', cleanNik.length === 16);
                                }
                            }
                            if (kkEl && kkPill) {
                                var cleanKk = kkEl.value.replace(/\D/g, '').slice(0, 16);
                                if (kkEl.value !== cleanKk) kkEl.value = cleanKk;
                                kkPill.textContent = cleanKk.length + '/16';
                                kkPill.classList.toggle('is-valid', cleanKk.length === 16);
                            }
                            if (previewHome) {
                                var rmh = rumahEl && rumahEl.value.trim() ? rumahEl.value.trim() : 'RT Digital';
                                var jk = jekelEl && jekelEl.value ? (jekelEl.value === 'Laki-laki' ? 'L' : 'P') : '-';
                                previewHome.textContent = rmh + ' • ' + jk;
                            }
                        }

                        ['input', 'change'].forEach(function(evt) {
                            if (namaEl) namaEl.addEventListener(evt, syncCardPreview);
                            if (nikEl) nikEl.addEventListener(evt, syncCardPreview);
                            if (kkEl) kkEl.addEventListener(evt, syncCardPreview);
                            if (rumahEl) rumahEl.addEventListener(evt, syncCardPreview);
                            if (jekelEl) jekelEl.addEventListener(evt, syncCardPreview);
                        });
                        syncCardPreview();

                        // Live Card & Form 3D Tilt + Spotlight
                        var resCard = document.getElementById('liveResidentCard');
                        if (resCard && !window.matchMedia('(pointer: coarse)').matches) {
                            resCard.addEventListener('mousemove', function(e) {
                                var r = resCard.getBoundingClientRect();
                                var rx = ((e.clientY - r.top) / r.height - 0.5) * -12;
                                var ry = ((e.clientX - r.left) / r.width - 0.5) * 14;
                                resCard.style.transform = 'perspective(900px) rotateX(' + rx.toFixed(2) + 'deg) rotateY(' + ry.toFixed(2) + 'deg) scale(1.02)';
                            });
                            resCard.addEventListener('mouseleave', function() {
                                resCard.style.transform = '';
                            });
                        }

                        var regCard = document.querySelector('.glass-card-register');
                        if (regCard && !window.matchMedia('(pointer: coarse)').matches) {
                            regCard.addEventListener('mousemove', function(e) {
                                var r = regCard.getBoundingClientRect();
                                regCard.style.setProperty('--mx', (e.clientX - r.left) + 'px');
                                regCard.style.setProperty('--my', (e.clientY - r.top) + 'px');
                            });
                        }

                        // Real-Time Password Strength & Confirmation Match
                        var pwd = document.getElementById('password');
                        var pwdConf = document.getElementById('password_confirmation');
                        var fill = document.getElementById('pwdStrengthFill');
                        var strengthNote = document.getElementById('pwdStrengthNote');
                        var matchNote = document.getElementById('pwdMatchNote');

                        function updatePwdFeedback() {
                            if (pwd && fill && strengthNote) {
                                var val = pwd.value || '';
                                if (!val.length) {
                                    fill.style.width = '0%';
                                    strengthNote.textContent = '';
                                } else {
                                    var score = 0;
                                    if (val.length >= 4) score++;
                                    if (val.length >= 8) score++;
                                    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
                                    if (/\d/.test(val) || /[^A-Za-z0-9]/.test(val)) score++;
                                    var pct = [25, 50, 75, 100][Math.max(0, score - 1)] || 25;
                                    var colors = ['#ef4444', '#f59e0b', '#38bdf8', '#10b981'];
                                    var labels = ['Terlalu pendek', 'Cukup', 'Kuat', 'Sangat kuat'];
                                    var idx = Math.min(3, Math.max(0, score - 1));
                                    fill.style.width = pct + '%';
                                    fill.style.background = colors[idx];
                                    strengthNote.style.color = colors[idx];
                                    strengthNote.textContent = 'Kekuatan: ' + labels[idx];
                                }
                            }
                            if (pwd && pwdConf && matchNote) {
                                if (!pwdConf.value.length) {
                                    matchNote.textContent = '';
                                } else if (pwd.value === pwdConf.value) {
                                    matchNote.style.color = '#34d399';
                                    matchNote.textContent = '✓ Password cocok';
                                } else {
                                    matchNote.style.color = '#fb7185';
                                    matchNote.textContent = '✕ Password belum sama';
                                }
                            }
                        }
                        if (pwd) pwd.addEventListener('input', updatePwdFeedback);
                        if (pwdConf) pwdConf.addEventListener('input', updatePwdFeedback);
                    })();
                </script>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit-glass">
                    <span>Daftar Akun Sekarang</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Footer Links -->
                <div class="card-footer-links">
                    Sudah punya akun warga? <a href="{{ route('login') }}">Masuk ke Sistem &rarr;</a>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('welcome') }}" style="font-size: 12px; color: #64748b; text-decoration: none;">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Selamat Datang
                    </a>
                </div>
            </form>
        </div>

    </div>

    @include('components.ai-cs-widget')
</body>
</html>
