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
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
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
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
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
            font-weight: 500;
        }

        .stat-info .number {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-info .label {
            font-size: 12px;
            color: #a0aec0;
        }

        .jadwal-section {
            background: white;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            font-weight: 700;
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

        .badge-cancelled {
            background: #e2e8f0;
            color: #718096;
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
            font-size: 16px;
        }

        .jadwal-time {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #718096;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .jadwal-guru {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #4a5568;
            font-size: 13px;
        }

        .jadwal-notes {
            margin-top: 10px;
            background: white;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            color: #4a5568;
            border-left: 3px solid #667eea;
        }

        .jadwal-action {
            min-width: 150px;
            text-align: right;
        }

        .btn-view {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-approve {
            background: #38a169;
            margin-right: 8px;
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

        .empty-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .empty-desc {
            color: #718096;
            margin-bottom: 24px;
        }

        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .alert-success {
            background: #e3fcef;
            color: #0a6e4d;
            border: 1px solid #b8f0d7;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
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
                text-align: left;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .jadwal-date .day {
                font-size: 24px;
            }
            
            .jadwal-info {
                padding: 0;
                width: 100%;
            }
            
            .jadwal-action {
                text-align: left;
                margin-top: 15px;
                width: 100%;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
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
                ← Kembali ke Home
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-info">
                    <h3>Menunggu Persetujuan</h3>
                    <div class="number">{{ $jadwalPending->count() }}</div>
                    <div class="label">Perlu direspon</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <h3>Disetujui</h3>
                    <div class="number">{{ $jadwalDisetujui->count() }}</div>
                    <div class="label">Jadwal aktif</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎉</div>
                <div class="stat-info">
                    <h3>Selesai</h3>
                    <div class="number">{{ $jadwalSelesai->count() }}</div>
                    <div class="label">Riwayat belajar</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📆</div>
                <div class="stat-info">
                    <h3>Jadwal Hari Ini</h3>
                    <div class="number">{{ $jadwalHariIni->count() }}</div>
                    <div class="label">{{ now()->format('d F Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Jadwal Perlu Persetujuan -->
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
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }} WIB</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                    </div>
                    <div class="jadwal-guru">
                        <span>🧑‍🏫 Guru: {{ $jadwal->guru->name }}</span>
                        <span style="background: #e2e8f0; padding: 2px 8px; border-radius: 50px; font-size: 11px;">
                            {{ $jadwal->guru->guru_type }}
                        </span>
                    </div>
                    @if($jadwal->catatan)
                    <div class="jadwal-notes">
                        📝 {{ $jadwal->catatan }}
                    </div>
                    @endif
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view" style="margin-bottom: 5px;">
                        Lihat & Setujui
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Hari Ini -->
        @if($jadwalHariIni->count() > 0 && $jadwalPending->count() == 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2>
                    <span>📌</span> Jadwal Hari Ini
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
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }} WIB</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                    </div>
                    <div class="jadwal-guru">
                        <span>🧑‍🏫 Guru: {{ $jadwal->guru->name }}</span>
                    </div>
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view">
                        Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Disetujui -->
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
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }} WIB</span>
                        <span>⏱️ {{ $jadwal->durasi }} menit</span>
                    </div>
                    <div class="jadwal-guru">
                        <span>🧑‍🏫 Guru: {{ $jadwal->guru->name }}</span>
                    </div>
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view">
                        Detail
                    </a>
                </div>
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
                <span class="badge badge-completed">{{ $jadwalSelesai->count() }} Jadwal</span>
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
                        <span>⏰ {{ $jadwal->waktu->format('H:i') }} WIB</span>
                    </div>
                    <div class="jadwal-guru">
                        <span>🧑‍🏫 Guru: {{ $jadwal->guru->name }}</span>
                    </div>
                    @if($jadwal->feedback_guru)
                    <div class="jadwal-notes" style="border-left-color: #38a169;">
                        💬 Feedback Guru: {{ $jadwal->feedback_guru }}
                    </div>
                    @endif
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view" style="background: #718096;">
                        Detail
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
                <div class="empty-title">Belum Ada Jadwal</div>
                <div class="empty-desc">
                    Guru akan mengirimkan jadwal belajar untuk putra/putri Anda.
                </div>
                <a href="{{ route('orangtua.home') }}" class="btn-view">
                    Kembali ke Home
                </a>
            </div>
        </div>
        @endif
    </div>
</body>
</html>