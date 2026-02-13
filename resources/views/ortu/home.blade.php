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

        .badge {
            display: inline-block;
            padding: 6px 16px;
            background: #e3f2fd;
            color: #1976d2;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
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
                    <span class="info-label">Layanan</span>
                    <span class="info-value">
                        <span class="badge">{{ $siswa->layanan ?? '-' }}</span>
                    </span>
                </div>
            @else
                <div class="empty-state">
                    Belum ada data siswa
                </div>
            @endif
        </div>

        <!-- CARD GURU (UPDATED) -->
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

                <div style="margin-top: 24px; display: flex; gap: 10px;">
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
                    Menunggu penempatan guru
                </div>
            @endif
        </div>

    </div>
</div>
</body>
</html>
