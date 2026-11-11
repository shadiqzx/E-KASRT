<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KAS-RT</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #091a30 0%, #0369a1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            max-width: 440px;
            width: 100%;
            padding: 38px 34px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .login-btn {
            background: #0284c7;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            transition: all 0.2s;
        }
        .login-btn:hover {
            background: #0369a1;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.4);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/icon-home.png') }}" width="60" alt="Logo" class="mb-2">
            <h3 class="font-weight-bold text-dark mb-1">E-KASRT</h3>
            <p class="text-muted" style="font-size: 13.5px;">Sistem Informasi Keuangan & Smart RT</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger" style="border-radius: 10px; font-size: 13px;">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" style="border-radius: 10px; font-size: 13px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="font-weight-bold" style="font-size: 13px;">Username / Email</label>
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required value="{{ old('username') }}" style="border-radius: 10px; padding: 12px;">
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="font-weight-bold" style="font-size: 13px;">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required style="border-radius: 10px; padding: 12px;">
            </div>

            <button type="submit" class="login-btn mb-3">
                <i class="fas fa-sign-in-alt mr-1"></i> Masuk ke Sistem
            </button>
        </form>

        <div class="text-center mt-3">
            <small class="text-muted">Default admin login: <code>admin</code> / password: <code>admin</code></small>
        </div>
    </div>
</body>
</html>
