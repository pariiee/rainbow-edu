<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar - Rainbow Edu</title>
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
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
            margin-bottom: 5px;
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

        .badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
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

        .btn-view {
            padding: 8px 16px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <span>📅</span> Jadwal Mengajar
            </h1>
            <a href="javascript:history.back()" class="btn-back">
                ← Kembali
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-info">
                    <h3>Menunggu</h3>
                    <div class="number">{{ $jadwals->where('status', 'pending')->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <h3>Disetujui</h3>
                    <div class="number">{{ $jadwals->where('status', 'disetujui')->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎉</div>
                <div class="stat-info">
                    <h3>Selesai</h3>
                    <div class="number">{{ $jadwals->where('status', 'selesai')->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        @if($jadwalHariIni->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>📌</span> Hari Ini
                </h2>
                <span style="color: #667eea; font-weight: 600;">{{ now()->format('d F Y') }}</span>
            </div>

            @foreach($jadwalHariIni as $jadwal)
            <div class="jadwal-card">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }}</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                        <span>
                            @if($jadwal->status == 'pending')
                                <span class="badge badge-pending">Menunggu</span>
                            @elseif($jadwal->status == 'disetujui')
                                <span class="badge badge-approved">Disetujui</span>
                            @elseif($jadwal->status == 'selesai')
                                <span class="badge badge-completed">Selesai</span>
                            @endif
                        </span>
                    </div>
                </div>
                <a href="{{ route('guru.jadwal.show', $jadwal->id) }}" class="btn-view">
                    Detail →
                </a>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Mendatang -->
        @if($jadwalMendatang->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>📆</span> Jadwal Mendatang
                </h2>
                <span style="color: #718096;">{{ $jadwalMendatang->count() }} Jadwal</span>
            </div>

            @foreach($jadwalMendatang as $jadwal)
            <div class="jadwal-card">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }}</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                        <span>
                            @if($jadwal->status == 'pending')
                                <span class="badge badge-pending">Menunggu</span>
                            @elseif($jadwal->status == 'disetujui')
                                <span class="badge badge-approved">Disetujui</span>
                            @endif
                        </span>
                    </div>
                </div>
                <a href="{{ route('guru.jadwal.detail', $jadwal->id) }}" class="btn-view">

                    Detail →
                </a>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Selesai -->
        @if($jadwalSelesai->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>🎉</span> Riwayat Selesai
                </h2>
                <span style="color: #718096;">{{ $jadwalSelesai->count() }} Jadwal</span>
            </div>

            @foreach($jadwalSelesai as $jadwal)
            <div class="jadwal-card" style="opacity: 0.8;">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }}</span>
                        <span>✅ Selesai</span>
                    </div>
                </div>
                <a href="{{ route('guru.jadwal.show', $jadwal->id) }}" class="btn-view" style="background: #718096;">
                    Detail →
                </a>
            </div>
            @endforeach
        </div>
        @endif

        @if($jadwals->isEmpty())
        <div class="jadwal-section">
            <div class="empty-state">
                <div class="empty-icon">📅</div>
                <h3 style="margin-bottom: 10px; color: #2d3748;">Belum Ada Jadwal</h3>
                <p style="color: #718096;">Anda belum membuat jadwal belajar.</p>
            </div>
        </div>
        @endif
    </div>
</body>
</html>