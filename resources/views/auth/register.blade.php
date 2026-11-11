<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – Kas RT</title>
    <meta name="description" content="Buat akun baru untuk mengakses sistem Kas RT.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #6366f1; --primary-dark: #4f46e5; --primary-light: #818cf8;
            --bg-dark: #0f0f1a; --border: rgba(255,255,255,0.08);
            --text-primary: #f1f5f9; --text-secondary: #94a3b8; --text-muted: #64748b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow-x: hidden; padding: 1.5rem 0;
        }
        .bg-mesh {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(99,102,241,0.2) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(34,211,238,0.12) 0%, transparent 50%);
            animation: bgShift 8s ease-in-out infinite alternate;
        }
        @keyframes bgShift { 0% { transform: scale(1); } 100% { transform: scale(1.08); } }
        .orb { position: fixed; border-radius: 50%; filter: blur(80px); opacity: 0.35; z-index: 0; animation: orbFloat linear infinite; }
        .orb-1 { width: 350px; height: 350px; background: #6366f1; top: -80px; left: -80px; animation-duration: 18s; }
        .orb-2 { width: 250px; height: 250px; background: #22d3ee; bottom: -60px; right: -60px; animation-duration: 14s; animation-direction: reverse; }
        @keyframes orbFloat {
            0% { transform: translate(0,0) scale(1); } 33% { transform: translate(25px,-15px) scale(1.05); }
            66% { transform: translate(-12px,25px) scale(0.95); } 100% { transform: translate(0,0) scale(1); }
        }
        .grid-lines {
            position: fixed; inset: 0; z-index: 0;
            background-image: linear-gradient(rgba(99,102,241,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(99,102,241,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .card-wrapper {
            position: relative; z-index: 10; width: 100%; max-width: 460px; padding: 1.5rem;
            animation: cardIn 0.7s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        @keyframes cardIn { from { opacity: 0; transform: translateY(30px) scale(0.96); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .card {
            background: rgba(15,15,30,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.6), 0 0 0 1px rgba(99,102,241,0.1), inset 0 1px 0 rgba(255,255,255,0.06);
            position: relative; overflow: hidden;
        }
        .card::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.03), transparent);
            animation: shimmer 4s ease-in-out infinite;
        }
        @keyframes shimmer { 0% { left: -100%; } 100% { left: 200%; } }
        .brand { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.75rem; }
        .brand-icon {
            width: 44px; height: 44px; background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            font-size: 20px; box-shadow: 0 6px 20px rgba(99,102,241,0.35);
        }
        .brand-text h1 { font-size: 1.1rem; font-weight: 700; color: var(--text-primary); letter-spacing: -0.02em; }
        .brand-text p { font-size: 0.72rem; color: var(--text-secondary); margin-top: 1px; }
        .card h2 { font-size: 1.6rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.03em; margin-bottom: 0.4rem; }
        .card .subtitle { color: var(--text-secondary); font-size: 0.875rem; margin-bottom: 1.75rem; }
        .alert { padding: 0.8rem 1rem; border-radius: 12px; margin-bottom: 1.25rem; font-size: 0.85rem; }
        .alert-danger { background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.25); color: #fca5a5; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
        .form-group { margin-bottom: 1.1rem; }
        label { display: block; font-size: 0.83rem; font-weight: 500; color: var(--text-secondary); margin-bottom: 0.4rem; }
        .input-wrapper { position: relative; }
        .input-prefix { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none; font-size: 0.95rem; }
        input[type="email"], input[type="password"], input[type="text"] {
            width: 100%; padding: 0.8rem 1rem 0.8rem 2.75rem;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; color: var(--text-primary); font-size: 0.875rem;
            font-family: 'Inter', sans-serif; transition: all 0.25s ease; outline: none;
        }
        input:focus { border-color: var(--primary); background: rgba(99,102,241,0.06); box-shadow: 0 0 0 3px rgba(99,102,241,0.15); }
        input::placeholder { color: var(--text-muted); }
        .input-suffix {
            position: absolute; right: 0.875rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 4px; border-radius: 6px; transition: color 0.2s;
        }
        .input-suffix:hover { color: var(--text-secondary); }
        .error-text { color: #fca5a5; font-size: 0.78rem; margin-top: 0.3rem; }
        .btn-primary {
            width: 100%; padding: 0.875rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white; border: none; border-radius: 12px;
            font-size: 0.9rem; font-weight: 600; font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(99,102,241,0.3);
            position: relative; overflow: hidden; margin-top: 0.5rem;
        }
        .btn-primary::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent); opacity: 0; transition: opacity 0.25s; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(99,102,241,0.45); }
        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }
        .divider { display: flex; align-items: center; gap: 1rem; margin: 1.25rem 0; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .divider span { font-size: 0.78rem; color: var(--text-muted); }
        .login-link { text-align: center; font-size: 0.875rem; color: var(--text-secondary); }
        .login-link a { color: var(--primary-light); font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .login-link a:hover { color: #a5b4fc; text-decoration: underline; }
        .password-strength { margin-top: 0.4rem; display: flex; gap: 4px; }
        .strength-bar { flex: 1; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.08); transition: background 0.3s; }
        .strength-bar.active-1 { background: #ef4444; }
        .strength-bar.active-2 { background: #f59e0b; }
        .strength-bar.active-3 { background: #10b981; }
        .strength-bar.active-4 { background: #6366f1; }
    </style>
</head>
<body>
    <div class="bg-mesh"></div>
    <div class="grid-lines"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="card-wrapper">
        <div class="card">
            <div class="brand">
                <div class="brand-icon">💰</div>
                <div class="brand-text">
                    <h1>Kas RT</h1>
                    <p>Sistem Keuangan Rukun Tetangga</p>
                </div>
            </div>

            <h2>Buat Akun Baru</h2>
            <p class="subtitle">Bergabung dan kelola kas warga dengan mudah</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">👤</span>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" required autofocus style="padding-left: 2.75rem;">
                    </div>
                    @error('name') <p class="error-text">⚠ {{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">✉️</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="username" style="padding-left: 2.75rem;">
                    </div>
                    @error('email') <p class="error-text">⚠ {{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">🔒</span>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password" style="padding-left: 2.75rem; padding-right: 3rem;" oninput="checkStrength(this.value)">
                        <button type="button" class="input-suffix" onclick="togglePass('password','togglePass1')">👁️</button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="sb1"></div>
                        <div class="strength-bar" id="sb2"></div>
                        <div class="strength-bar" id="sb3"></div>
                        <div class="strength-bar" id="sb4"></div>
                    </div>
                    @error('password') <p class="error-text">⚠ {{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-wrapper">
                        <span class="input-prefix">🔑</span>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password" style="padding-left: 2.75rem; padding-right: 3rem;">
                        <button type="button" class="input-suffix" onclick="togglePass('password_confirmation','togglePass2')">👁️</button>
                    </div>
                </div>

                <button type="submit" class="btn-primary" id="registerBtn">
                    Buat Akun →
                </button>
            </form>

            <div class="divider"><span>sudah punya akun?</span></div>
            <p class="login-link">
                <a href="{{ route('login') }}">Masuk Sekarang</a>
            </p>
        </div>
    </div>

    <script>
        function togglePass(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }

        function checkStrength(val) {
            const bars = [document.getElementById('sb1'), document.getElementById('sb2'), document.getElementById('sb3'), document.getElementById('sb4')];
            bars.forEach(b => b.className = 'strength-bar');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            for (let i = 0; i < score; i++) {
                bars[i].classList.add('active-' + score);
            }
        }

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('registerBtn');
            btn.textContent = 'Membuat akun...';
            btn.style.opacity = '0.8';
        });
    </script>
</body>
</html>
