<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .welcome h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #666;
            font-size: 16px;
        }

        .btn-logout {
            padding: 12px 24px;
            background: #ff4757;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #ff3747;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }

        .alert {
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 16px;
            background: #e3fcef;
            border: 1px solid #b8f0d7;
            color: #0a6e4d;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
        }

        .card-title h3 {
            font-size: 18px;
            color: #666;
        }

        .card-title h2 {
            font-size: 24px;
            color: #333;
        }

        .info-row {
            display: flex;
            margin-bottom: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .info-label {
            width: 120px;
            color: #666;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            color: #333;
            font-weight: 500;
        }

        .btn-primary {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .btn-secondary {
            display: inline-block;
            padding: 14px 28px;
            background: #f8f9fa;
            color: #333;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            border: 2px solid #e0e0e0;
            text-align: center;
        }

        .btn-warning {
            display: inline-block;
            padding: 14px 28px;
            background: #ff9800;
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: #f57c00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.3);
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            background: #e3f2fd;
            color: #1976d2;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-warning {
            background: #fff3e0;
            color: #e65100;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }

        .progress-card {
            background: #fff4e5;
            border: 1px solid #ffb347;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .progress-icon {
            font-size: 48px;
            background: white;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .progress-content {
            flex: 1;
        }

        .progress-content h3 {
            color: #c66900;
            margin-bottom: 8px;
            font-size: 20px;
        }

        .progress-content p {
            color: #666;
            margin-bottom: 4px;
        }

        .small-text {
            color: #718096;
            font-size: 12px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .progress-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="welcome">
            <h1>Selamat Datang, {{ auth()->user()->name }} 👋</h1>
            <p>Orang Tua dari {{ $siswa->nama_lengkap ?? 'Belum diisi' }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

    <!-- PROGRESS CARD / FORM NOTIFICATION -->
    @if($hasCompletedLayanan && !$hasCompletedQuestionnaire)
    <div class="progress-card">
        <div class="progress-icon">📋</div>
        <div class="progress-content">
            <h3>Lengkapi Data Siswa</h3>
            <p>Bantu guru memahami kebutuhan, minat, dan karakter putra/putri Anda</p>
            <p style="font-size: 13px; color: #e65100;">Formulir ini penting untuk penyesuaian program pembelajaran</p>
        </div>
        <a href="{{ route('ortu.form') }}" class="btn-warning" style="padding: 14px 32px; font-size: 16px;">
            📝 Isi Form Sekarang
        </a>
    </div>
    @endif

    <!-- MAIN DASHBOARD GRID -->
    <div class="dashboard-grid">

        <!-- CARD SISWA -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">👤</div>
                <div class="card-title">
                    <h3>Data Siswa</h3>
                    <h2>{{ $siswa->nama_lengkap ?? 'Belum diisi' }}</h2>
                </div>
            </div>

            @if($siswa)
                <div class="info-row">
                    <span class="info-label">NISN</span>
                    <span class="info-value">{{ $siswa->nisn ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tempat, Tgl Lahir</span>
                    <span class="info-value">
                        {{ $siswa->tempat_lahir ?? '-' }}, 
                        {{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') : '-' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Layanan</span>
                    <span class="info-value">
                        <span class="badge">{{ $siswa->layanan ?? '-' }}</span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status Form</span>
                    <span class="info-value">
                        @if($hasCompletedQuestionnaire)
                            <span class="badge" style="background: #e8f5e9; color: #2e7d32;">✓ Sudah diisi</span>
                        @else
                            <span class="badge badge-warning">⏳ Belum diisi</span>
                        @endif
                    </span>
                </div>
            @else
                <div class="empty-state">
                    <p style="margin-bottom: 16px;">Belum ada data siswa</p>
                    @if($hasCompletedLayanan && !$hasCompletedQuestionnaire)
                        <a href="{{ route('ortu.form') }}" class="btn-primary">
                            Isi Form Data Siswa
                        </a>
                    @endif
                </div>
            @endif

            @if($siswa && !$hasCompletedQuestionnaire && $hasCompletedLayanan)
            <div style="margin-top: 24px;">
                <a href="{{ route('ortu.form') }}" class="btn-primary" style="width: 100%;">
                    📝 Isi Form Data Siswa
                </a>
                <p class="small-text">
                    ⏭️ Jika sudah diisi, abaikan pesan ini
                </p>
            </div>
            @endif
        </div>

        <!-- CARD GURU -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">👩‍🏫</div>
                <div class="card-title">
                    <h3>Guru Pendamping</h3>
                    <h2>{{ $siswa->guru->name ?? 'Belum ditentukan' }}</h2>
                </div>
            </div>

            @if($siswa && $siswa->guru)
                <div class="info-row">
                    <span class="info-label">Divisi</span>
                    <span class="info-value">
                        {{ $siswa->guru->guru_type ?? '-' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">
                        {{ $siswa->guru->email }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Nomor Telepon</span>
                    <span class="info-value">
                        {{ $siswa->guru->nomor_telepon ?? '-' }}
                    </span>
                </div>

                <div style="margin-top: 24px; display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('ortu.jadwal.index') }}" 
                       class="btn-primary" 
                       style="flex: 1;">
                        📅 Lihat Jadwal
                    </a>

                    <a href="{{ route('chat.show', $siswa->id) }}" 
                       class="btn-secondary" 
                       style="flex: 1; background: #38a169; color: white; border: none;">
                        💬 Chat Guru
                    </a>
                </div>

            @else
                <div class="empty-state">
                    <p style="margin-bottom: 16px;">Menunggu penempatan guru</p>
                    <span class="badge badge-warning">Dalam proses</span>
                </div>
            @endif
        </div>

        <!-- CARD PROGRESS / INFORMASI TAMBAHAN -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">📊</div>
                <div class="card-title">
                    <h3>Perkembangan</h3>
                    <h2>Progress Belajar</h2>
                </div>
            </div>

            @if($siswa && $siswa->guru)
                <div style="text-align: center; padding: 20px 0;">
                    <p style="color: #666; margin-bottom: 16px;">
                        Fitur laporan perkembangan akan segera hadir
                    </p>
                    <span class="badge">Dalam pengembangan</span>
                </div>
            @else
                <div class="empty-state">
                    <p style="margin-bottom: 16px;">Belum ada data perkembangan</p>
                </div>
            @endif
        </div>

    </div>

    <!-- INFORMASI TAMBAHAN UNTUK FORM (ALTERNATIVE PLACEMENT) -->
    @if($hasCompletedLayanan && !$hasCompletedQuestionnaire && !$siswa)
    <div style="margin-top: 30px;">
        <div class="card" style="background: #fff4e5; border: 1px solid #ffb347;">
            <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                <div style="font-size: 32px;">📋</div>
                <div style="flex: 1;">
                    <h3 style="color: #c66900; margin-bottom: 4px;">Lengkapi Data Siswa</h3>
                    <p style="color: #666;">Bantu guru memahami kebutuhan putra/putri Anda</p>
                </div>
                <a href="{{ route('ortu.form') }}" class="btn-warning" style="padding: 12px 24px;">
                    Isi Form
                </a>
            </div>
        </div>
    </div>
    @endif

</div>

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
    alert("{{ session('error') }}");
</script>
@endif

</body>
</html>