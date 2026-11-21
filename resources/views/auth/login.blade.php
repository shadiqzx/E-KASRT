<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login | E-KASRT – Sistem Informasi Keuangan & Smart RT</title>
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
            padding: 24px;
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

        .orb-4 {
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(225, 29, 72, 0.45) 0%, rgba(244, 63, 94, 0.05) 70%);
            top: 10%;
            right: 15%;
            animation-duration: 15s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.08); }
            100% { transform: translate(-25px, 35px) scale(0.95); }
        }

        /* Grid Pattern Overlay for Depth */
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

        /* Main Container Layout (Split Hero + Glass Card) */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1140px;
            margin: auto;
            display: grid;
            grid-template-columns: 1.15fr 0.95fr;
            align-items: center;
            gap: 48px;
        }

        /* ================================================================
           LEFT HERO BRANDING SECTION
           ================================================================ */
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
            font-size: 46px;
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
            font-size: 16px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 34px;
            max-width: 520px;
        }

        .hero-features-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
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
            width: 36px;
            height: 36px;
            border-radius: 10px;
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

        /* ================================================================
           RIGHT PURE GLASSMORPHISM LOGIN CARD
           ================================================================ */
        .glass-card-login {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(28px) saturate(190%);
            -webkit-backdrop-filter: blur(28px) saturate(190%);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 30px;
            padding: 44px 38px;
            box-shadow: 
                0 30px 60px -15px rgba(0, 0, 0, 0.5),
                inset 0 1px 1px rgba(255, 255, 255, 0.35),
                inset 0 -1px 1px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #38bdf8, #818cf8, #34d399);
        }

        .card-header-box {
            margin-bottom: 28px;
        }

        .brand-badge-mini {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .brand-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 19px;
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.45);
        }

        .brand-badge-text {
            font-size: 13px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .card-title {
            font-size: 32px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.6px;
            margin-bottom: 6px;
        }

        .card-subtitle {
            font-size: 13.5px;
            color: #94a3b8;
            margin-bottom: 0;
        }

        /* Input Form Group Styling */
        .form-group-custom {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 8px;
        }

        .form-label-custom .forgot-link {
            font-size: 12px;
            color: #38bdf8;
            text-decoration: none;
            transition: color 0.2s;
        }
        .form-label-custom .forgot-link:hover {
            color: #7dd3fc;
            text-decoration: underline;
        }

        .input-pill-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-pill-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-pill-field {
            width: 100%;
            height: 50px;
            padding: 12px 18px 12px 46px;
            background: #ffffff;
            border: 1.5px solid transparent;
            border-radius: 14px;
            font-size: 14.5px;
            font-weight: 600;
            color: #0f172a;
            font-family: var(--app-font);
            outline: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        }

        .input-pill-field:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.25), 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .input-pill-field::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .toggle-pwd-btn {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #64748b;
            font-size: 15px;
            cursor: pointer;
            padding: 6px;
            outline: none;
            transition: color 0.2s;
        }
        .toggle-pwd-btn:hover {
            color: #0f172a;
        }

        /* Flash Message Alerts */
        .glass-alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            backdrop-filter: blur(8px);
        }
        .glass-alert-error {
            background: rgba(225, 29, 72, 0.2);
            border: 1px solid rgba(251, 113, 133, 0.4);
            color: #fecdd3;
        }
        .glass-alert-warning {
            background: rgba(245, 158, 11, 0.22);
            border: 1px solid rgba(251, 191, 36, 0.5);
            color: #fde68a;
        }
        .glass-alert-info {
            background: rgba(14, 165, 233, 0.22);
            border: 1px solid rgba(56, 189, 248, 0.5);
            color: #bae6fd;
        }
        .glass-alert-success {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(52, 211, 153, 0.4);
            color: #a7f3d0;
        }

        /* Submit Button (Lets Go ->) */
        .btn-submit-glass {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 60%, #1d4ed8 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 10px 25px -4px rgba(2, 132, 199, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.3);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-submit-glass:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -4px rgba(2, 132, 199, 0.65), inset 0 1px 1px rgba(255, 255, 255, 0.4);
            background: linear-gradient(135deg, #0369a1 0%, #1d4ed8 60%, #1e40af 100%);
        }

        .btn-submit-glass:active {
            transform: translateY(0);
        }

        /* Demo Quick-Fill Pill */
        .quick-fill-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px dashed rgba(255, 255, 255, 0.18);
            border-radius: 12px;
            padding: 10px 14px;
            text-align: center;
            font-size: 12px;
            color: #cbd5e1;
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }
        .quick-fill-box:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #38bdf8;
            color: #ffffff;
        }
        .quick-fill-box code {
            font-family: var(--mono-font);
            color: #38bdf8;
            background: rgba(2, 132, 199, 0.2);
            padding: 2px 6px;
            border-radius: 5px;
            font-weight: 700;
        }

        .card-footer-note {
            text-align: center;
            font-size: 12px;
            color: #64748b;
            margin-top: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* ================================================================
           MOBILE & TABLET RESPONSIVE (Stacked View as Image 2)
           ================================================================ */
        @media (max-width: 991px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                gap: 32px;
                max-width: 480px;
            }

            .hero-section {
                text-align: center;
                padding: 10px 0;
            }

            .hero-title {
                font-size: 34px;
            }

            .hero-desc {
                margin: 0 auto 24px auto;
                font-size: 14.5px;
            }

            .hero-features-list {
                display: none; /* Bersih di mobile seperti referensi gambar 2 */
            }

            .glass-card-login {
                padding: 34px 26px;
                border-radius: 26px;
            }

            .card-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Floating Orbs for Real Glass Refraction -->
    <div class="ambient-canvas">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
    </div>

    <!-- Main Container -->
    <div class="login-wrapper">

        <!-- LEFT HERO SECTION -->
        <div class="hero-section">
            <div class="hero-badge-pill">
                <span class="pulse-dot"></span>
                E-KASRT v11 &bull; Smart System
            </div>

            <h1 class="hero-title">
                Transparansi Kas, <br>
                Membangun <span class="accent-text">Warga.</span>
            </h1>

            <p class="hero-desc">
                Sistem Informasi Manajemen Keuangan Lingkungan, Monitoring Iuran Warga & Layanan Smart RT Terintegrasi.
            </p>

            <div class="hero-features-list">
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <span>Pembukuan Kas Masuk, Kas Keluar & Laporan Real-Time</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <span>Bukti Kwitansi Transaksi & Transfer Bank Terverifikasi</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <span>Integrasi IoT Posyandu Balita Digital Berbasis e-KTP</span>
                </div>
            </div>
        </div>

        <!-- RIGHT PURE GLASSMORPHISM LOGIN CARD -->
        <div class="glass-card-login">
            <div class="card-header-box">
                <div class="brand-badge-mini">
                    <div class="brand-logo-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="brand-badge-text">E-KASRT System</span>
                </div>
                <h2 class="card-title">Login</h2>
                <p class="card-subtitle">Silakan masukkan kredensial akun pengurus RT Anda.</p>
            </div>

            <!-- Flash Error Message -->
            @if(session('error'))
                <div class="glass-alert glass-alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Flash Warning (Pending Verification) Message -->
            @if(session('warning'))
                <div class="glass-alert glass-alert-warning">
                    <i class="fas fa-hourglass-half"></i>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            <!-- Flash Info Message -->
            @if(session('info'))
                <div class="glass-alert glass-alert-info">
                    <i class="fas fa-info-circle"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="glass-alert glass-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Username / Email Input -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="usernameInput">
                        <span>Username / Email</span>
                    </label>
                    <div class="input-pill-wrap">
                        <i class="fas fa-user input-pill-icon"></i>
                        <input 
                            type="text" 
                            name="username" 
                            id="usernameInput" 
                            class="input-pill-field" 
                            placeholder="Ketik username Anda..." 
                            required 
                            value="{{ old('username') }}"
                            autocomplete="username"
                        >
                    </div>
                </div>

                <!-- Password Input -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="passwordInput">
                        <span>Password</span>
                        <a href="#" class="forgot-link" onclick="quickFillCredentials(); return false;">Lupa Password?</a>
                    </label>
                    <div class="input-pill-wrap">
                        <i class="fas fa-lock input-pill-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="passwordInput" 
                            class="input-pill-field" 
                            placeholder="Ketik password Anda..." 
                            required 
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-pwd-btn" onclick="togglePasswordVisibility()" title="Lihat Password">
                            <i class="fas fa-eye" id="pwdEyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit-glass">
                    <span>Masuk ke Sistem</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Link to Register Warga Baru & Cek Status -->
                <div class="text-center my-3" style="font-size: 13.5px; color: #cbd5e1;">
                    Belum punya akun warga? 
                    <a href="{{ route('register') }}" style="color: #38bdf8; font-weight: 700; text-decoration: none;">Daftar Akun Baru &rarr;</a>
                </div>

                <div class="text-center mb-3">
                    <button type="button" onclick="openCekStatusModal()" style="background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(56, 189, 248, 0.35); color: #38bdf8; border-radius: 12px; padding: 8px 16px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-search"></i>
                        <span>Cek Status Pendaftaran Warga</span>
                    </button>
                </div>

                <!-- Demo Quick Fill Pill -->
                <div class="quick-fill-box" onclick="quickFillCredentials()" title="Klik untuk mengisi akun admin otomatis">
                    ⚡ Demo Cepat: Akun <code>admin</code> / Password: <code>admin</code>
                </div>

                <!-- Security Note & Back to Welcome -->
                <div class="card-footer-note flex-column gap-1">
                    <div>
                        <i class="fas fa-shield-alt text-info"></i>
                        <span>Sistem Terenkripsi &bull; Transparan & Akuntabel</span>
                    </div>
                    <a href="{{ route('welcome') }}" style="font-size: 12px; color: #64748b; text-decoration: none; margin-top: 6px;">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Selamat Datang
                    </a>
                </div>
            </form>
        </div>

    </div>

    <!-- Script for Interactions -->
    <script>
        function togglePasswordVisibility() {
            var pwdField = document.getElementById('passwordInput');
            var eyeIcon = document.getElementById('pwdEyeIcon');
            if (pwdField.type === 'password') {
                pwdField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                pwdField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        function quickFillCredentials() {
            document.getElementById('usernameInput').value = 'admin';
            document.getElementById('passwordInput').value = 'admin';
            
            // Visual feedback
            var btn = document.querySelector('.btn-submit-glass');
            btn.style.transform = 'scale(0.98)';
            setTimeout(function() {
                btn.style.transform = '';
            }, 150);
        }

        // Modal Cek Status Pendaftaran Warga
        function openCekStatusModal() {
            document.getElementById('cekStatusModal').style.display = 'flex';
            document.getElementById('cekStatusInput').focus();
        }

        function closeCekStatusModal() {
            document.getElementById('cekStatusModal').style.display = 'none';
            document.getElementById('cekStatusResult').innerHTML = '';
            document.getElementById('cekStatusInput').value = '';
        }

        function submitCekStatus(e) {
            e.preventDefault();
            var keyword = document.getElementById('cekStatusInput').value.trim();
            if (!keyword) return;

            var resultDiv = document.getElementById('cekStatusResult');
            resultDiv.innerHTML = '<div style="text-align: center; color: #94a3b8; padding: 15px;"><i class="fas fa-spinner fa-spin mr-2"></i> Memeriksa data pendaftaran...</div>';

            var formData = new FormData();
            formData.append('keyword', keyword);
            formData.append('_token', '{{ csrf_token() }}');

            fetch("{{ route('auth.cek_status') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (!data.found) {
                    resultDiv.innerHTML = `
                        <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 12px; padding: 14px; color: #fecdd3; font-size: 13px;">
                            <i class="fas fa-exclamation-circle mr-1"></i> Data tidak ditemukan. Pastikan NIK 16 digit atau Username yang Anda masukkan sudah benar.
                        </div>
                    `;
                } else if (data.status_verifikasi === 'Menunggu Verifikasi') {
                    resultDiv.innerHTML = `
                        <div style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.45); border-radius: 14px; padding: 16px; color: #fde68a; font-size: 13px;">
                            <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 14px; color: #fbbf24; margin-bottom: 8px;">
                                <i class="fas fa-clock fa-lg"></i>
                                <span>Sedang Menunggu Verifikasi Pengurus RT</span>
                            </div>
                            <div style="margin-bottom: 4px;"><strong>Nama:</strong> ${data.nama}</div>
                            <div style="margin-bottom: 4px;"><strong>NIK:</strong> ${data.nik}</div>
                            <div style="margin-bottom: 4px;"><strong>Waktu Daftar:</strong> ${data.tgl_daftar}</div>
                            <div style="margin-top: 10px; font-size: 12px; color: #fef3c7; background: rgba(0,0,0,0.2); padding: 8px 10px; border-radius: 8px;">
                                ℹ️ Akun Anda saat ini masih dalam antrean peninjauan oleh Pengurus RT. Mohon periksa kembali nanti atau hubungi pengurus RT setempat.
                            </div>
                        </div>
                    `;
                } else if (data.status_verifikasi === 'Disetujui') {
                    resultDiv.innerHTML = `
                        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.45); border-radius: 14px; padding: 16px; color: #a7f3d0; font-size: 13px;">
                            <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 14px; color: #34d399; margin-bottom: 8px;">
                                <i class="fas fa-check-circle fa-lg"></i>
                                <span>Akun Telah Disetujui & Aktif!</span>
                            </div>
                            <div style="margin-bottom: 4px;"><strong>Nama:</strong> ${data.nama}</div>
                            <div style="margin-bottom: 4px;"><strong>Username:</strong> ${data.username}</div>
                            <div style="margin-bottom: 4px;"><strong>Waktu Disetujui:</strong> ${data.tgl_verifikasi}</div>
                            <button type="button" onclick="closeCekStatusModal(); document.getElementById('usernameInput').value='${data.username}'; document.getElementById('passwordInput').focus();" style="margin-top: 12px; width: 100%; padding: 8px; background: #059669; color: #fff; border: none; border-radius: 8px; font-weight: 700; cursor: pointer;">
                                Masuk Sekarang &rarr;
                            </button>
                        </div>
                    `;
                } else if (data.status_verifikasi === 'Ditolak') {
                    resultDiv.innerHTML = `
                        <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.45); border-radius: 14px; padding: 16px; color: #fecdd3; font-size: 13px;">
                            <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 14px; color: #f87171; margin-bottom: 8px;">
                                <i class="fas fa-times-circle fa-lg"></i>
                                <span>Pendaftaran Akun Ditolak</span>
                            </div>
                            <div style="margin-bottom: 4px;"><strong>Nama:</strong> ${data.nama}</div>
                            <div style="margin-bottom: 4px;"><strong>Alasan Penolakan:</strong></div>
                            <div style="background: rgba(0,0,0,0.3); padding: 8px 10px; border-radius: 8px; color: #fee2e2; margin-top: 4px;">
                                "${data.alasan_tolak || 'Data tidak sesuai / bukan warga lingkungan RT setempat'}"
                            </div>
                        </div>
                    `;
                }
            })
            .catch(err => {
                resultDiv.innerHTML = '<div style="color: #f87171; font-size: 13px;">Gagal memuat status. Silakan coba lagi.</div>';
            });
        }
    </script>

    <!-- Custom Modal Cek Status Pendaftaran Warga -->
    <div id="cekStatusModal" style="display: none; position: fixed; inset: 0; background: rgba(7, 13, 27, 0.75); backdrop-filter: blur(10px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #0f172a; border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 20px; width: 100%; max-width: 440px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); overflow: hidden; animation: modalPop 0.25s ease;">
            <div style="padding: 20px 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 34px; height: 34px; border-radius: 10px; background: rgba(56, 189, 248, 0.15); color: #38bdf8; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-search"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #fff;">Cek Status Pendaftaran</h4>
                        <small style="color: #94a3b8; font-size: 11.5px;">Pantau status verifikasi akun oleh Pengurus RT</small>
                    </div>
                </div>
                <button type="button" onclick="closeCekStatusModal()" style="background: none; border: none; color: #94a3b8; font-size: 18px; cursor: pointer;">&times;</button>
            </div>
            <div style="padding: 20px 24px;">
                <form onsubmit="submitCekStatus(event)">
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 12.5px; font-weight: 600; color: #cbd5e1; margin-bottom: 6px;">Masukkan NIK KTP atau Username</label>
                        <input type="text" id="cekStatusInput" placeholder="Ketik 16 digit NIK atau username..." required style="width: 100%; height: 46px; border-radius: 12px; background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.15); color: #fff; padding: 10px 14px; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#38bdf8'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                    </div>
                    <button type="submit" style="width: 100%; height: 44px; background: linear-gradient(135deg, #0284c7, #2563eb); border: none; border-radius: 12px; color: #fff; font-weight: 700; font-size: 13.5px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fas fa-search"></i>
                        <span>Periksa Status</span>
                    </button>
                </form>
                <div id="cekStatusResult" style="margin-top: 16px;"></div>
            </div>
        </div>
    </div>
</body>
</html>
