<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Belajar - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back {
            padding: 12px 24px;
            background: #f0f0f0;
            color: #666;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .stat-icon {
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

        .stat-info h3 {
            font-size: 14px;
            color: #718096;
            margin-bottom: 6px;
        }

        .stat-info .number {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
        }

        .jadwal-section {
            background: white;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-title h2 {
            font-size: 20px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fed7d7;
            color: #742a2a;
        }

        .badge-approved {
            background: #c6f6d5;
            color: #22543d;
        }

        .badge-completed {
            background: #e2e8f0;
            color: #2d3748;
        }

        .jadwal-card {
            display: flex;
            align-items: center;
            padding: 20px;
            background: #f8fafc;
            border-radius: 16px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .jadwal-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .jadwal-date {
            min-width: 100px;
            text-align: center;
            padding-right: 20px;
            border-right: 2px solid #e2e8f0;
        }

        .jadwal-date .day {
            font-size: 28px;
            font-weight: 700;
            color: #667eea;
            line-height: 1;
        }

        .jadwal-date .month {
            font-size: 14px;
            color: #718096;
        }

        .jadwal-info {
            flex: 1;
            padding: 0 20px;
        }

        .jadwal-siswa {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .jadwal-time {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #718096;
            font-size: 14px;
        }

        .jadwal-notes {
            margin-top: 8px;
            color: #4a5568;
            font-size: 14px;
            background: white;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .jadwal-action {
            min-width: 150px;
            text-align: right;
        }

        .btn-action {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-approve {
            background: #38a169;
        }

        .btn-reject {
            background: #e53e3e;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #f8fafc;
            border-radius: 16px;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .jadwal-card {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .jadwal-date {
                border-right: none;
                border-bottom: 2px solid #e2e8f0;
                padding-bottom: 15px;
                margin-bottom: 15px;
                width: 100%;
            }
            
            .jadwal-action {
                text-align: left;
                margin-top: 15px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <span>📅</span> Jadwal Belajar
            </h1>
            <a href="{{ route('orangtua.home') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        @if(session('success'))
            <div style="background: #e3fcef; color: #0a6e4d; padding: 16px; border-radius: 12px; margin-bottom: 20px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-info">
                    <h3>Menunggu</h3>
                    <div class="number">{{ $jadwalPending->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <h3>Disetujui</h3>
                    <div class="number">{{ $jadwalDisetujui->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎉</div>
                <div class="stat-info">
                    <h3>Selesai</h3>
                    <div class="number">{{ $jadwalSelesai->count() }}</div>
                </div>
            </div>
        </div>

        @if($jadwalPending->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>⏳</span> Perlu Persetujuan
                </h2>
                <span class="badge badge-pending">{{ $jadwalPending->count() }} Jadwal</span>
            </div>

            @foreach($jadwalPending as $jadwal)
            <div class="jadwal-card">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">
                        {{ $jadwal->siswa->nama_lengkap }}
                        <span style="font-size: 12px; color: #718096; margin-left: 10px;">
                            {{ $jadwal->siswa->layanan }}
                        </span>
                    </div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }}</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                        <span>👤 {{ $jadwal->guru->name }}</span>
                    </div>
                    @if($jadwal->catatan)
                    <div class="jadwal-notes">
                        📝 {{ $jadwal->catatan }}
                    </div>
                    @endif
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-action" style="margin-bottom: 5px;">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($jadwalDisetujui->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>✅</span> Jadwal Disetujui
                </h2>
                <span class="badge badge-approved">{{ $jadwalDisetujui->count() }} Jadwal</span>
            </div>

            @foreach($jadwalDisetujui as $jadwal)
            <div class="jadwal-card">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">
                        {{ $jadwal->siswa->nama_lengkap }}
                    </div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }}</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                        <span>👤 {{ $jadwal->guru->name }}</span>
                    </div>
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-action">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($jadwalSelesai->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>🎉</span> Riwayat Selesai
                </h2>
                <span class="badge badge-completed">{{ $jadwalSelesai->count() }} Jadwal</span>
            </div>

            @foreach($jadwalSelesai as $jadwal)
            <div class="jadwal-card" style="opacity: 0.8;">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">
                        {{ $jadwal->siswa->nama_lengkap }}
                    </div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }}</span>
                        <span>👤 {{ $jadwal->guru->name }}</span>
                    </div>
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-action" style="background: #718096;">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($jadwals->isEmpty())
        <div class="jadwal-section">
            <div class="empty-state">
                <div class="empty-icon">📅</div>
                <h3 style="margin-bottom: 10px; color: #2d3748;">Belum Ada Jadwal</h3>
                <p style="color: #718096; margin-bottom: 20px;">
                    Guru akan mengirimkan jadwal belajar untuk putra/putri Anda.
                </p>
                <a href="{{ route('orangtua.home') }}" class="btn-action">
                    Kembali ke Home
                </a>
            </div>
        </div>
        @endif
    </div>
</body>
</html>