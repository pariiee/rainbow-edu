<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar - Rainbow Edu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f0f4ff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── DEKORASI AWAN BACKGROUND ── */
        .clouds {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .cloud {
            position: absolute;
            opacity: 0.55;
            animation: drift linear infinite;
        }

        .cloud svg path {
            fill: white;
        }


        .cloud-1  { top: 4%;  left: -120px; width: 220px; animation-duration: 60s; animation-delay: 0s; }
        .cloud-2  { top: 12%; left: -80px;  width: 140px; animation-duration: 75s; animation-delay: -20s; opacity: 0.35; }
        .cloud-3  { top: 28%; left: -160px; width: 180px; animation-duration: 55s; animation-delay: -10s; }
        .cloud-4  { top: 55%; left: -100px; width: 160px; animation-duration: 80s; animation-delay: -35s; opacity: 0.3; }
        .cloud-5  { top: 72%; left: -140px; width: 200px; animation-duration: 65s; animation-delay: -5s; }
        .cloud-6  { top: 88%; left: -90px;  width: 130px; animation-duration: 70s; animation-delay: -45s; opacity: 0.35; }

        @keyframes drift {
            from { transform: translateX(0); }
            to   { transform: translateX(calc(100vw + 300px)); }
        }

        /* warna-warni subtle pada tiap awan */
        .cloud-1 svg path { fill: #ffd6d6; }
        .cloud-2 svg path { fill: #ffe4cc; }
        .cloud-3 svg path { fill: #d6f5d6; }
        .cloud-4 svg path { fill: #cce5ff; }
        .cloud-5 svg path { fill: #e0d6ff; }
        .cloud-6 svg path { fill: #ffd6f5; }

            to   { transform: translateX(calc(100vw + 300px)); }
        }

        /* ── RAINBOW TOP STRIPE ── */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #ff9f43, #ffd93d, #6bcb77, #4d96ff, #7b68ee, #c77dff);
            z-index: 9999;
        }

        /* ── LAYOUT: SIDEBAR + HALAMAN ── */
        .app-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .sidebar-slot {
            flex-shrink: 0;
            width: 260px; 
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .main-area {
            flex: 1;
            min-width: 0;
            padding: 36px 32px;
        }

        /* ── HEADER CARD ── */
        .header {
            background: white;
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle at top right,
                rgba(59,130,246,0.08) 0%,
                rgba(96,165,250,0.06) 25%,
                rgba(147,197,253,0.05) 50%,
                rgba(191,219,254,0.04) 75%,
                transparent 100%
            );
            pointer-events: none;
        }

        .welcome h1 {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn-back {
            padding: 10px 20px;
            background: #f3f4f6;
            color: #4b5563;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back:hover {
            background: #e5e7eb;
            color: #1f2937;
            transform: translateY(-2px);
        }

        /* ── STATS GRID ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 18px;
            padding: 20px 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
            animation: fadeUp 0.4s ease both;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 32px rgba(0,0,0,0.10);
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.12s; }
        .stat-card:nth-child(3) { animation-delay: 0.19s; }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            background: #f3f4f6;
        }

        .icon-amber { background: #fffbeb; color: #d97706; }
        .icon-green { background: #f0fdf4; color: #16a34a; }
        .icon-blue { background: #eff6ff; color: #2563eb; }

        .stat-info h3 {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-info .number {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
        }

        /* ── SECTION CARDS ── */
        .jadwal-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            padding: 24px;
            margin-bottom: 24px;
            animation: fadeUp 0.5s ease both;
            animation-delay: 0.3s;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f3f4f6;
        }

        .section-title h2 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .jadwal-card {
            display: flex;
            align-items: center;
            padding: 20px;
            background: #f9fafb;
            border-radius: 16px;
            margin-bottom: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .jadwal-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: #3b82f6; /* Default Blue */
        }
        
        .jadwal-card.pending::before { background: #f59e0b; }
        .jadwal-card.approved::before { background: #10b981; }
        .jadwal-card.completed::before { background: #6b7280; }

        .jadwal-card:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .jadwal-date {
            min-width: 80px;
            text-align: center;
            padding-right: 20px;
            border-right: 1px dashed #d1d5db;
        }

        .jadwal-date .day {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            line-height: 1;
        }

        .jadwal-date .month {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            margin-top: 4px;
            text-transform: uppercase;
        }

        .jadwal-info {
            flex: 1;
            padding: 0 20px;
        }

        .jadwal-siswa {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .jadwal-time {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #6b7280;
            font-size: 13px;
        }
        
        .jadwal-time span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-completed { background: #f3f4f6; color: #374151; }

        .btn-view {
            padding: 8px 16px;
            background: white;
            color: #3b82f6;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid #bfdbfe;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-view:hover {
            background: #eff6ff;
            border-color: #3b82f6;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #6b7280;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar-slot { width: 100%; height: auto; position: relative; }
            .main-area { padding: 20px 16px; }
            .stats-grid { grid-template-columns: 1fr; }
            
            .jadwal-card {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .jadwal-date {
                border-right: none;
                border-bottom: 1px dashed #d1d5db;
                padding-bottom: 12px;
                margin-bottom: 12px;
                width: 100%;
                text-align: left;
                display: flex;
                align-items: baseline;
                gap: 8px;
            }
            
            .jadwal-info { padding: 0; margin-bottom: 16px; }
            .btn-view { width: 100%; text-align: center; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<!-- Dekorasi awan melayang -->
<!-- Dekorasi awan -->
<div class="clouds">
    <div class="cloud cloud-1">
        <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg"><path d="M30,60 Q10,60 10,45 Q10,30 25,28 Q22,10 40,10 Q52,10 58,20 Q65,8 80,8 Q100,8 105,25 Q118,20 130,28 Q145,25 150,38 Q160,38 160,50 Q160,62 148,62 Z"/></svg>
    </div>
    <div class="cloud cloud-2">
        <svg viewBox="0 0 140 56" xmlns="http://www.w3.org/2000/svg"><path d="M20,42 Q6,42 6,30 Q6,18 18,17 Q15,4 30,4 Q40,4 45,12 Q52,3 65,3 Q82,3 86,17 Q96,14 104,22 Q114,20 116,30 Q122,30 122,40 Q122,48 112,48 Z"/></svg>
    </div>
    <div class="cloud cloud-3">
        <svg viewBox="0 0 180 70" xmlns="http://www.w3.org/2000/svg"><path d="M28,54 Q8,54 8,40 Q8,26 22,24 Q18,8 36,8 Q48,8 54,18 Q62,6 78,6 Q100,6 104,22 Q116,18 126,26 Q140,22 144,36 Q154,36 154,48 Q154,58 142,60 Z"/></svg>
    </div>
    <div class="cloud cloud-4">
        <svg viewBox="0 0 160 64" xmlns="http://www.w3.org/2000/svg"><path d="M24,50 Q6,50 6,36 Q6,22 20,20 Q16,6 34,6 Q46,6 52,16 Q58,4 74,4 Q96,4 100,20 Q110,16 120,24 Q132,20 136,34 Q146,34 146,44 Q146,56 134,56 Z"/></svg>
    </div>
    <div class="cloud cloud-5">
        <svg viewBox="0 0 200 76" xmlns="http://www.w3.org/2000/svg"><path d="M32,58 Q10,58 10,44 Q10,30 24,28 Q20,10 40,10 Q54,10 60,20 Q68,8 84,8 Q108,8 112,26 Q122,22 134,30 Q148,26 152,40 Q164,40 164,52 Q164,62 150,64 Z"/></svg>
    </div>
    <div class="cloud cloud-6">
        <svg viewBox="0 0 130 52" xmlns="http://www.w3.org/2000/svg"><path d="M18,40 Q4,40 4,28 Q4,16 16,15 Q12,2 28,2 Q38,2 44,10 Q50,2 62,2 Q80,2 84,16 Q94,12 100,20 Q110,18 112,28 Q118,28 118,38 Q118,46 108,46 Z"/></svg>
    </div>
</div>

<div class="app-layout">

    {{-- SIDEBAR GURU --}}
    <div class="sidebar-slot">
        <x-sidebar.guru />
    </div>

    {{-- HALAMAN UTAMA --}}
    <div class="main-area">

        <div class="header">
            <div class="welcome">
                <h1><i class="ph-duotone ph-calendar-blank"></i> Jadwal Mengajar</h1>
            </div>
            <a href="javascript:history.back()" class="btn-back">
                ← Kembali
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-amber"><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i></div>
                <div class="stat-info">
                    <h3>Menunggu Persetujuan</h3>
                    <div class="number">{{ $jadwals->where('status', 'pending')->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green"><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></div>
                <div class="stat-info">
                    <h3>Jadwal Disetujui</h3>
                    <div class="number">{{ $jadwals->where('status', 'disetujui')->count() }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-blue"><i class="ph-duotone ph-confetti" style="color: #f59e0b;"></i></div>
                <div class="stat-info">
                    <h3>Jadwal Selesai</h3>
                    <div class="number">{{ $jadwals->where('status', 'selesai')->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        @if($jadwalHariIni->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2><i class="ph-duotone ph-push-pin"></i> Jadwal Hari Ini</h2>
                <span style="color: #3b82f6; font-weight: 700; font-size: 14px;">{{ now()->format('d M Y') }}</span>
            </div>

            @foreach($jadwalHariIni as $jadwal)
            <div class="jadwal-card {{ $jadwal->status == 'pending' ? 'pending' : ($jadwal->status == 'disetujui' ? 'approved' : 'completed') }}">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span title="Waktu"><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }}</span>
                        <span title="Durasi"><i class="ph-duotone ph-timer"></i> {{ $jadwal->durasi }} menit</span>
                        <span>
                            @if($jadwal->status == 'pending')
                                <span class="badge badge-pending">Menunggu Ortu</span>
                            @elseif($jadwal->status == 'disetujui')
                                <span class="badge badge-approved">Disetujui</span>
                            @elseif($jadwal->status == 'selesai')
                                <span class="badge badge-completed">Selesai</span>
                            @endif
                        </span>
                    </div>
                </div>
                <a href="{{ route('guru.jadwal.detail', $jadwal->id) }}" class="btn-view">Lihat Detail</a>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Mendatang -->
        @if($jadwalMendatang->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2><i class="ph-duotone ph-calendar-check"></i> Jadwal Mendatang</h2>
                <span style="color: #6b7280; font-weight: 600; font-size: 13px;">{{ $jadwalMendatang->count() }} Jadwal</span>
            </div>

            @foreach($jadwalMendatang as $jadwal)
            <div class="jadwal-card {{ $jadwal->status == 'pending' ? 'pending' : ($jadwal->status == 'disetujui' ? 'approved' : 'completed') }}">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }}</span>
                        <span><i class="ph-duotone ph-timer"></i> {{ $jadwal->durasi }} menit</span>
                        <span>
                            @if($jadwal->status == 'pending')
                                <span class="badge badge-pending">Menunggu Ortu</span>
                            @elseif($jadwal->status == 'disetujui')
                                <span class="badge badge-approved">Disetujui</span>
                            @endif
                        </span>
                    </div>
                </div>
                <a href="{{ route('guru.jadwal.detail', $jadwal->id) }}" class="btn-view">Lihat Detail</a>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Selesai -->
        @if($jadwalSelesai->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2><i class="ph-duotone ph-confetti" style="color: #f59e0b;"></i> Riwayat Selesai</h2>
                <span style="color: #6b7280; font-weight: 600; font-size: 13px;">{{ $jadwalSelesai->count() }} Jadwal</span>
            </div>

            @foreach($jadwalSelesai as $jadwal)
            <div class="jadwal-card completed" style="opacity: 0.85;">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }}</span>
                        <span><span class="badge badge-completed"><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i> Selesai</span></span>
                    </div>
                </div>
                <a href="{{ route('guru.jadwal.detail', $jadwal->id) }}" class="btn-view" style="color:#6b7280; border-color:#d1d5db;">Lihat Feedback</a>
            </div>
            @endforeach
        </div>
        @endif

        @if($jadwals->isEmpty())
        <div class="jadwal-section">
            <div class="empty-state">
                <div class="empty-icon"><i class="ph-duotone ph-calendar-blank"></i></div>
                <h3>Belum Ada Jadwal</h3>
                <p>Anda belum membuat jadwal mengajar untuk siswa.</p>
            </div>
        </div>
        @endif

    </div>{{-- /main-area --}}
</div>{{-- /app-layout --}}

</body>
</html>