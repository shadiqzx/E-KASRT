<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi – Kas RT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #6366f1; --primary-dark: #4f46e5; --primary-light: #818cf8;
            --success: #10b981; --danger: #ef4444;
            --bg-dark: #0b0b16; --bg-card: rgba(255,255,255,0.04); --border: rgba(255,255,255,0.07);
            --text-primary: #f1f5f9; --text-secondary: #94a3b8; --text-muted: #64748b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
        }
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: -1;
            background: radial-gradient(ellipse at 10% 10%, rgba(99,102,241,0.12) 0%, transparent 40%),
                        radial-gradient(ellipse at 90% 90%, rgba(34,211,238,0.08) 0%, transparent 40%);
        }
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(11,11,22,0.95); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand { display: flex; align-items: center; gap: 0.75rem; }
        .nav-icon {
            width: 38px; height: 38px; background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 18px; box-shadow: 0 4px 12px rgba(99,102,241,0.35);
        }
        .nav-title { font-size: 1.1rem; font-weight: 700; letter-spacing: -0.02em; }
        .nav-title span { color: var(--primary-light); }
        .main { max-width: 720px; margin: 0 auto; padding: 2.5rem 2rem; }
        .breadcrumb {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 1.75rem; font-size: 0.85rem;
        }
        .breadcrumb a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--primary-light); }
        .breadcrumb span { color: var(--text-muted); }
        .breadcrumb .current { color: var(--text-secondary); }
        .page-title { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.03em; margin-bottom: 0.5rem; }
        .page-sub { color: var(--text-muted); font-size: 0.875rem; margin-bottom: 2rem; }
        .form-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 24px; overflow: hidden;
        }
        .form-card-header {
            padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
        }
        .form-card-header h3 { font-size: 1rem; font-weight: 700; letter-spacing: -0.02em; }
        .form-card-header p { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.2rem; }
        .form-body { padding: 1.75rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        @media (max-width: 560px) { .form-row { grid-template-columns: 1fr; } }
        .form-group { margin-bottom: 1.25rem; }
        label {
            display: block; font-size: 0.82rem; font-weight: 500;
            color: var(--text-secondary); margin-bottom: 0.45rem;
        }
        .form-control {
            width: 100%; padding: 0.8rem 1rem;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; color: var(--text-primary);
            font-size: 0.875rem; font-family: 'Inter', sans-serif;
            transition: all 0.25s ease; outline: none;
        }
        .form-control:focus {
            border-color: var(--primary); background: rgba(99,102,241,0.06);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .form-control::placeholder { color: var(--text-muted); }
        select.form-control option { background: #1a1a2e; color: var(--text-primary); }
        .error-text { color: #fca5a5; font-size: 0.78rem; margin-top: 0.35rem; }
        .type-tabs { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; }
        .type-tab {
            padding: 0.7rem; border-radius: 10px; border: 1px solid var(--border);
            background: transparent; color: var(--text-muted); font-size: 0.85rem;
            font-weight: 500; font-family: 'Inter', sans-serif; cursor: pointer;
            transition: all 0.2s; text-align: center;
        }
        .type-tab.active-pemasukan { background: rgba(16,185,129,0.12); border-color: rgba(16,185,129,0.3); color: #34d399; }
        .type-tab.active-pengeluaran { background: rgba(239,68,68,0.12); border-color: rgba(239,68,68,0.3); color: #f87171; }
        input[type="radio"].hidden-radio { display: none; }
        .form-footer {
            display: flex; gap: 1rem; margin-top: 0.5rem;
        }
        .btn-primary {
            flex: 1; padding: 0.85rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white; border: none; border-radius: 12px;
            font-size: 0.9rem; font-weight: 600; font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(99,102,241,0.25);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(99,102,241,0.4); }
        .btn-cancel {
            padding: 0.85rem 1.5rem;
            background: rgba(255,255,255,0.05); border: 1px solid var(--border);
            border-radius: 12px; color: var(--text-secondary);
            font-size: 0.9rem; font-weight: 500; font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.08); color: var(--text-primary); }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <div class="nav-icon">💰</div>
            <span class="nav-title">Kas <span>RT</span></span>
        </div>
    </nav>

    <main class="main">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
            <span>›</span>
            <span class="current">Edit Transaksi</span>
        </div>

        <h1 class="page-title">✏️ Edit Transaksi</h1>
        <p class="page-sub">Perbarui detail transaksi yang sudah tersimpan</p>

        <div class="form-card">
            <div class="form-card-header">
                <h3>Detail Transaksi</h3>
                <p>ID #{{ $transaction->id }} · Dibuat {{ $transaction->created_at->locale('id')->diffForHumans() }}</p>
            </div>
            <div class="form-body">
                <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <div class="type-tabs">
                            <input type="radio" name="type" id="type_masuk" value="pemasukan" class="hidden-radio" {{ $transaction->type == 'pemasukan' ? 'checked' : '' }}>
                            <label for="type_masuk" class="type-tab {{ $transaction->type == 'pemasukan' ? 'active-pemasukan' : '' }}" id="tab_masuk">
                                📈 Pemasukan
                            </label>
                            <input type="radio" name="type" id="type_keluar" value="pengeluaran" class="hidden-radio" {{ $transaction->type == 'pengeluaran' ? 'checked' : '' }}>
                            <label for="type_keluar" class="type-tab {{ $transaction->type == 'pengeluaran' ? 'active-pengeluaran' : '' }}" id="tab_keluar">
                                📉 Pengeluaran
                            </label>
                        </div>
                        @error('type') <p class="error-text">⚠ {{ $message }}</p> @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="amount">Nominal (Rp)</label>
                            <input type="number" name="amount" id="amount" class="form-control"
                                value="{{ old('amount', $transaction->amount) }}" min="1" required>
                            @error('amount') <p class="error-text">⚠ {{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="transaction_date">Tanggal</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                                value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required>
                            @error('transaction_date') <p class="error-text">⚠ {{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <input type="text" name="description" id="description" class="form-control"
                            value="{{ old('description', $transaction->description) }}" placeholder="Deskripsi transaksi" required>
                        @error('description') <p class="error-text">⚠ {{ $message }}</p> @enderror
                    </div>

                    <div class="form-footer">
                        <a href="{{ route('dashboard') }}" class="btn-cancel">← Batal</a>
                        <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const radioMasuk = document.getElementById('type_masuk');
        const radioKeluar = document.getElementById('type_keluar');
        const tabMasuk = document.getElementById('tab_masuk');
        const tabKeluar = document.getElementById('tab_keluar');

        function updateTabs() {
            if (radioMasuk.checked) {
                tabMasuk.className = 'type-tab active-pemasukan';
                tabKeluar.className = 'type-tab';
            } else {
                tabKeluar.className = 'type-tab active-pengeluaran';
                tabMasuk.className = 'type-tab';
            }
        }

        tabMasuk.addEventListener('click', () => { radioMasuk.checked = true; updateTabs(); });
        tabKeluar.addEventListener('click', () => { radioKeluar.checked = true; updateTabs(); });
    </script>
</body>
</html>