<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Kas RT</title>
    <meta name="description" content="Dashboard pengelolaan kas rukun tetangga.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --accent: #22d3ee;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --bg-dark: #0b0b16;
            --bg-nav: rgba(11,11,22,0.95);
            --bg-card: rgba(255,255,255,0.04);
            --bg-card-hover: rgba(255,255,255,0.07);
            --border: rgba(255,255,255,0.07);
            --border-hover: rgba(99,102,241,0.3);
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Fixed background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(ellipse at 10% 10%, rgba(99,102,241,0.12) 0%, transparent 40%),
                radial-gradient(ellipse at 90% 90%, rgba(34,211,238,0.08) 0%, transparent 40%);
        }

        /* ======= NAVBAR ======= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--bg-nav);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(99,102,241,0.35);
        }

        .nav-title {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .nav-title span {
            color: var(--primary-light);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 1rem 0.4rem 0.6rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 100px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .nav-user:hover {
            border-color: var(--border-hover);
            background: var(--bg-card-hover);
        }

        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
        }

        .nav-user-name {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px;
            color: #fca5a5;
            font-size: 0.83rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: rgba(239,68,68,0.18);
            border-color: rgba(239,68,68,0.35);
        }

        /* ======= MAIN CONTENT ======= */
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 2rem 3rem;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text-primary);
        }

        .page-header .date-badge {
            font-size: 0.8rem;
            color: var(--text-muted);
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 0.35rem 0.875rem;
            border-radius: 100px;
        }

        /* ======= STATS CARDS ======= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main { padding: 1.5rem 1rem 2rem; }
            .navbar { padding: 0 1rem; }
        }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: default;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            border-radius: 20px 20px 0 0;
        }

        .stat-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.3);
        }

        .stat-card.saldo::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
        .stat-card.pemasukan::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card.pengeluaran::before { background: linear-gradient(90deg, #ef4444, #f87171); }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.75rem;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 1rem;
            float: right;
        }

        .stat-card.saldo .stat-icon { background: rgba(99,102,241,0.15); }
        .stat-card.pemasukan .stat-icon { background: rgba(16,185,129,0.15); }
        .stat-card.pengeluaran .stat-icon { background: rgba(239,68,68,0.15); }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text-primary);
            clear: both;
        }

        .stat-card.pemasukan .stat-value { color: #34d399; }
        .stat-card.pengeluaran .stat-value { color: #f87171; }

        .stat-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        /* ======= LAYOUT GRID ======= */
        .content-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
        }

        /* ======= FORM CARD ======= */
        .form-card, .table-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h3 {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .card-header .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            font-weight: 600;
        }

        .badge-purple {
            background: rgba(99,102,241,0.15);
            color: var(--primary-light);
            border: 1px solid rgba(99,102,241,0.2);
        }

        .badge-count {
            background: rgba(255,255,255,0.08);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .form-body {
            padding: 1.5rem;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.4rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.25s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(99,102,241,0.06);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .form-control::placeholder { color: var(--text-muted); }

        select.form-control option {
            background: #1a1a2e;
            color: var(--text-primary);
        }

        /* Type tabs */
        .type-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .type-tab {
            padding: 0.65rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .type-tab:hover { border-color: rgba(255,255,255,0.2); color: var(--text-secondary); }

        .type-tab.active-pemasukan {
            background: rgba(16,185,129,0.12);
            border-color: rgba(16,185,129,0.3);
            color: #34d399;
        }

        .type-tab.active-pengeluaran {
            background: rgba(239,68,68,0.12);
            border-color: rgba(239,68,68,0.3);
            color: #f87171;
        }

        /* Hidden radio */
        input[type="radio"].hidden-radio { display: none; }

        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(99,102,241,0.25);
            margin-top: 0.25rem;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99,102,241,0.4);
        }

        /* ======= TABLE ======= */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 0.875rem 1.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            background: rgba(255,255,255,0.02);
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: background 0.15s;
        }

        tbody tr:hover { background: rgba(255,255,255,0.03); }
        tbody tr:last-child { border-bottom: none; }

        tbody td {
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
        }

        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.65rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-masuk {
            background: rgba(16,185,129,0.12);
            color: #34d399;
            border: 1px solid rgba(16,185,129,0.2);
        }

        .badge-keluar {
            background: rgba(239,68,68,0.12);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
        }

        .amount-positive { color: #34d399; font-weight: 700; }
        .amount-negative { color: #f87171; font-weight: 700; }

        .text-muted-sm { color: var(--text-muted); font-size: 0.8rem; }

        /* Action buttons */
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.3rem 0.65rem;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid;
            cursor: pointer;
            background: none;
            font-family: 'Inter', sans-serif;
        }

        .btn-edit {
            color: var(--primary-light);
            border-color: rgba(99,102,241,0.2);
            background: rgba(99,102,241,0.08);
        }

        .btn-edit:hover {
            background: rgba(99,102,241,0.15);
            border-color: rgba(99,102,241,0.35);
        }

        .btn-delete {
            color: #f87171;
            border-color: rgba(239,68,68,0.2);
            background: rgba(239,68,68,0.08);
        }

        .btn-delete:hover {
            background: rgba(239,68,68,0.15);
            border-color: rgba(239,68,68,0.35);
        }

        /* Empty state */
        .empty-state {
            padding: 3rem 2rem;
            text-align: center;
        }

        .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.5; }
        .empty-state p { color: var(--text-muted); font-size: 0.9rem; }

        /* Alert */
        .alert {
            padding: 0.875rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.25);
            color: #6ee7b7;
        }

        .alert-danger {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            color: #fca5a5;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">
            <div class="nav-icon">💰</div>
            <span class="nav-title">Kas <span>RT</span></span>
        </div>

        <div class="nav-right">
            <div class="nav-user">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <span class="nav-user-name">{{ Auth::user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout">
                    🚪 Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Main -->
    <main class="main">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2>Dashboard Keuangan</h2>
                <p style="color: var(--text-muted); font-size: 0.875rem; margin-top: 0.25rem;">Kelola kas RT Anda dengan mudah</p>
            </div>
            <div class="date-badge">📅 {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">⚠️ {{ $errors->first() }}</div>
        @endif

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card saldo">
                <div class="stat-icon">💼</div>
                <div class="stat-label">Saldo Saat Ini</div>
                <div class="stat-value">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                <div class="stat-sub">{{ $transactions->count() }} total transaksi</div>
            </div>
            <div class="stat-card pemasukan">
                <div class="stat-icon">📈</div>
                <div class="stat-label">Total Pemasukan</div>
                <div class="stat-value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                <div class="stat-sub">{{ $transactions->where('type','pemasukan')->count() }} transaksi masuk</div>
            </div>
            <div class="stat-card pengeluaran">
                <div class="stat-icon">📉</div>
                <div class="stat-label">Total Pengeluaran</div>
                <div class="stat-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div class="stat-sub">{{ $transactions->where('type','pengeluaran')->count() }} transaksi keluar</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Add Transaction Form -->
            <div class="form-card">
                <div class="card-header">
                    <h3>➕ Tambah Transaksi</h3>
                    <span class="badge badge-purple">Baru</span>
                </div>
                <div class="form-body">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <!-- Type selector -->
                        <div class="form-group">
                            <label>Jenis Transaksi</label>
                            <div class="type-tabs">
                                <input type="radio" name="type" id="type_masuk" value="pemasukan" class="hidden-radio" {{ old('type','pemasukan') == 'pemasukan' ? 'checked' : '' }}>
                                <label for="type_masuk" class="type-tab {{ old('type','pemasukan') == 'pemasukan' ? 'active-pemasukan' : '' }}" id="tab_masuk">
                                    📈 Pemasukan
                                </label>

                                <input type="radio" name="type" id="type_keluar" value="pengeluaran" class="hidden-radio" {{ old('type') == 'pengeluaran' ? 'checked' : '' }}>
                                <label for="type_keluar" class="type-tab {{ old('type') == 'pengeluaran' ? 'active-pengeluaran' : '' }}" id="tab_keluar">
                                    📉 Pengeluaran
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount">Nominal (Rp)</label>
                            <input type="number" name="amount" id="amount" class="form-control"
                                placeholder="0" min="1" value="{{ old('amount') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Iuran bulanan, pembelian, dll." value="{{ old('description') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="transaction_date">Tanggal</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                                value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        </div>

                        <button type="submit" class="btn-submit">
                            Simpan Transaksi →
                        </button>
                    </form>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="table-card">
                <div class="card-header">
                    <h3>📋 Riwayat Transaksi</h3>
                    <span class="badge badge-count">{{ $transactions->count() }} data</span>
                </div>
                <div class="table-wrapper">
                    @if($transactions->isEmpty())
                        <div class="empty-state">
                            <div class="icon">📭</div>
                            <p>Belum ada transaksi.<br>Mulai tambahkan transaksi pertama Anda!</p>
                        </div>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $trx)
                                <tr>
                                    <td>
                                        <span style="font-size: 0.875rem; color: var(--text-secondary);">
                                            {{ \Carbon\Carbon::parse($trx->transaction_date)->locale('id')->isoFormat('D MMM Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 500;">{{ $trx->description }}</span>
                                    </td>
                                    <td>
                                        @if($trx->type === 'pemasukan')
                                            <span class="type-badge badge-masuk">📈 Masuk</span>
                                        @else
                                            <span class="type-badge badge-keluar">📉 Keluar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $trx->type === 'pemasukan' ? 'amount-positive' : 'amount-negative' }}">
                                            {{ $trx->type === 'pemasukan' ? '+' : '-' }}Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 0.4rem; align-items: center;">
                                            <a href="{{ route('transactions.edit', $trx->id) }}" class="action-btn btn-edit">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn btn-delete">🗑️ Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        // Type tab toggling
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

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(a => {
                a.style.transition = 'opacity 0.5s, transform 0.5s';
                a.style.opacity = '0';
                a.style.transform = 'translateY(-10px)';
                setTimeout(() => a.remove(), 500);
            });
        }, 4000);
    </script>
</body>
</html>