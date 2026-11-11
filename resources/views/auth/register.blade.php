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
    </style>
</head>
<body>

    <!-- Ambient Floating Orbs -->
    <div class="ambient-canvas">
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

            <div class="hero-features-list">
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span>Pantau Arus Kas Masuk & Kas Keluar RT Secara Terbuka</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <span>Riwayat Iuran Warga & Kwitansi Digital Otomatis</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-circle">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <span>Layanan Posyandu Balita IoT & Pengajuan Surat Pengantar</span>
                </div>
            </div>
        </div>

        <!-- RIGHT GLASS CARD -->
        <div class="glass-card-register">
            <div class="card-header-box">
                <div class="brand-badge-mini">
                    <div class="brand-logo-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span class="brand-badge-text">Registrasi Warga Baru</span>
                </div>
                <h2 class="card-title">Daftar Akun</h2>
                <p class="card-subtitle">Lengkapi formulir data kependudukan Anda dengan benar.</p>
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
                        <label class="form-label-custom" for="nik">NIK KTP (16 Digit) *</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-id-card input-pill-icon"></i>
                            <input type="text" name="nik" id="nik" class="input-pill-field" placeholder="16 digit NIK" maxlength="16" value="{{ old('nik') }}" required>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="no_kk">Nomor Kartu Keluarga (KK)</label>
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
                            <i class="fas fa-door-open input-pill-icon"></i>
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
                            <input type="password" name="password" id="password" class="input-pill-field" placeholder="Minimal 4 karakter" required>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="password_confirmation">Ulangi Password *</label>
                        <div class="input-pill-wrap">
                            <i class="fas fa-check-double input-pill-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="input-pill-field" placeholder="Ketik ulang password" required>
                        </div>
                    </div>
                </div>

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

</body>
</html>
