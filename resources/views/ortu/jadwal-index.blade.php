<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Belajar - Rainbow Edu</title>
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
            animation: slideDown 0.4s ease both;
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

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .welcome h1 {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 10px;
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
            grid-template-columns: repeat(4, 1fr);
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
        .stat-card:nth-child(4) { animation-delay: 0.26s; }

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
        .icon-purple { background: #f5f3ff; color: #7c3aed; }

        .stat-info h3 {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .stat-info .number {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            line-height: 1;
            margin-bottom: 2px;
        }

        .stat-info .label {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 500;
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
            background: #3b82f6;
        }
        
        .jadwal-card.pending::before { background: #f59e0b; }
        .jadwal-card.approved::before { background: #10b981; }
        .jadwal-card.completed::before { background: #9ca3af; }

        .jadwal-card:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .jadwal-date {
            min-width: 90px;
            text-align: center;
            padding-right: 20px;
            border-right: 1px dashed #d1d5db;
        }

        .jadwal-date .day {
            font-size: 28px;
            font-weight: 800;
            color: #3b82f6;
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .layanan-badge {
            background:#eff6ff; 
            color:#2563eb; 
            padding: 2px 8px; 
            border-radius: 6px; 
            font-size: 11px; 
            font-weight: 700;
        }

        .jadwal-time {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #4b5563;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .jadwal-guru {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            font-size: 13px;
        }

        .guru-type {
            background: #f3f4f6;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 11px;
            color: #4b5563;
        }

        .jadwal-notes {
            margin-top: 12px;
            background: white;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            color: #4b5563;
            border: 1px dashed #d1d5db;
        }

        .jade-card-notes span { font-size: 16px; margin-right: 6px; }

        .btn-view {
            padding: 10px 18px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s;
            white-space: nowrap;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
        }

        .btn-view:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }

        .btn-pending {
            background: white;
            color: #d97706;
            border: 1px solid #fcd34d;
            box-shadow: none;
        }
        .btn-pending:hover {
            background: #fffbeb;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-completed { background: #f3f4f6; color: #4b5563; }

        .empty-state { text-align: center; padding: 48px 20px; }
        .empty-icon { font-size: 48px; margin-bottom: 16px; }
        .empty-title { font-size: 16px; font-weight: 700; color: #111827; margin-bottom: 8px; }
        .empty-desc { font-size: 14px; color: #6b7280; margin-bottom: 24px; }
        
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideDown 0.3s ease;
        }
        
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
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
            
            .jadwal-info { padding: 0; margin-bottom: 16px; width: 100%; }
            .jadwal-action { width: 100%; }
            .btn-view { width: 100%; text-align: center; display: block; }
        }
    </style>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<!-- Dekorasi awan -->
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
    {{-- SIDEBAR ORTU --}}
    <div class="sidebar-slot">
        <x-sidebar.ortu :siswa="$siswa" />
    </div>

    {{-- HALAMAN UTAMA --}}
    <div class="main-area">

        <div class="header">
            <div class="welcome">
                <h1><i class="ph-duotone ph-calendar-blank"></i> Jadwal Belajar</h1>
            </div>
            <a href="{{ route('orangtua.home') }}" class="btn-back">
                ← Kembali ke Home
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success"><span><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></span> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><span><i class="ph-duotone ph-x-circle" style="color: #ef4444;"></i></span> {{ session('error') }}</div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-amber"><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i></div>
                <div class="stat-info">
                    <h3>Menunggu Persetujuan</h3>
                    <div class="number">{{ $jadwalPending->count() }}</div>
                    <div class="label">Perlu direspon</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green"><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></div>
                <div class="stat-info">
                    <h3>Disetujui</h3>
                    <div class="number">{{ $jadwalDisetujui->count() }}</div>
                    <div class="label">Jadwal aktif</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-blue"><i class="ph-duotone ph-confetti" style="color: #f59e0b;"></i></div>
                <div class="stat-info">
                    <h3>Selesai</h3>
                    <div class="number">{{ $jadwalSelesai->count() }}</div>
                    <div class="label">Riwayat belajar</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-purple"><i class="ph-duotone ph-calendar-check"></i></div>
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
                <h2><span><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i></span> Perlu Persetujuan</h2>
                <span class="badge badge-pending">{{ $jadwalPending->count() }} Jadwal</span>
            </div>

            @foreach($jadwalPending as $jadwal)
            <div class="jadwal-card pending">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">
                        {{ $jadwal->siswa->nama_lengkap }}
                        <span class="layanan-badge">{{ $jadwal->siswa->layanan }}</span>
                    </div>
                    <div class="jadwal-time">
                        <span title="Waktu"><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }} WIB</span>
                        <span title="Durasi"><i class="ph-duotone ph-timer"></i> {{ $jadwal->durasi }} mnt</span>
                    </div>
                    <div class="jadwal-guru">
                        <span><i class="ph-duotone ph-chalkboard-teacher"></i> Guru: <span style="font-weight:600; color:#111827;">{{ $jadwal->guru->name }}</span></span>
                        <span class="guru-type">{{ $jadwal->guru->guru_type }}</span>
                    </div>
                    @if($jadwal->catatan)
                    <div class="jadwal-notes">
                        <span style="font-size: 16px;"><i class="ph-duotone ph-notepad"></i></span> {{ $jadwal->catatan }}
                    </div>
                    @endif
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view btn-pending">
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
                <h2><span><i class="ph-duotone ph-push-pin"></i></span> Jadwal Hari Ini</h2>
                <span style="color: #3b82f6; font-weight: 700;">{{ now()->format('d M Y') }}</span>
            </div>

            @foreach($jadwalHariIni as $jadwal)
            <div class="jadwal-card approved">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }} WIB</span>
                        <span><i class="ph-duotone ph-timer"></i> {{ $jadwal->durasi }} mnt</span>
                    </div>
                    <div class="jadwal-guru">
                        <span><i class="ph-duotone ph-chalkboard-teacher"></i> Guru: {{ $jadwal->guru->name }}</span>
                    </div>
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view">Detail Jadwal</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Disetujui -->
        @if($jadwalDisetujui->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2><span><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></span> Jadwal Disetujui</h2>
                <span class="badge badge-approved">{{ $jadwalDisetujui->count() }} Jadwal</span>
            </div>

            @foreach($jadwalDisetujui as $jadwal)
            <div class="jadwal-card approved">
                <div class="jadwal-date">
                    <div class="day">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }} WIB</span>
                        <span><i class="ph-duotone ph-timer"></i> {{ $jadwal->durasi }} mnt</span>
                    </div>
                    <div class="jadwal-guru">
                        <span><i class="ph-duotone ph-chalkboard-teacher"></i> Guru: {{ $jadwal->guru->name }}</span>
                    </div>
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view">Detail</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Jadwal Selesai -->
        @if($jadwalSelesai->count() > 0)
        <div class="jadwal-section">
            <div class="section-title">
                <h2><span><i class="ph-duotone ph-confetti" style="color: #f59e0b;"></i></span> Riwayat Selesai</h2>
                <span class="badge badge-completed">{{ $jadwalSelesai->count() }} Jadwal</span>
            </div>

            @foreach($jadwalSelesai as $jadwal)
            <div class="jadwal-card completed" style="opacity: 0.85;">
                <div class="jadwal-date">
                    <div class="day" style="color:#6b7280;">{{ $jadwal->tanggal->format('d') }}</div>
                    <div class="month">{{ $jadwal->tanggal->format('M Y') }}</div>
                </div>
                <div class="jadwal-info">
                    <div class="jadwal-siswa">{{ $jadwal->siswa->nama_lengkap }}</div>
                    <div class="jadwal-time">
                        <span><i class="ph-duotone ph-alarm"></i> {{ $jadwal->waktu->format('H:i') }} WIB</span>
                    </div>
                    <div class="jadwal-guru">
                        <span><i class="ph-duotone ph-chalkboard-teacher"></i> Guru: {{ $jadwal->guru->name }}</span>
                    </div>
                    @if($jadwal->feedback_guru)
                    <div class="jadwal-notes" style="border-left: 2px solid #10b981;">
                        <i class="ph-duotone ph-chat-teardrop-dots"></i> <strong>Feedback Guru:</strong> {{ $jadwal->feedback_guru }}
                    </div>
                    @endif
                </div>
                <div class="jadwal-action">
                    <a href="{{ route('ortu.jadwal.show', $jadwal->id) }}" class="btn-view" style="background: white; color: #4b5563; border: 1px solid #d1d5db; box-shadow: none;">Detail</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($jadwals->isEmpty())
        <div class="jadwal-section">
            <div class="empty-state">
                <div class="empty-icon"><i class="ph-duotone ph-calendar-blank"></i></div>
                <div class="empty-title">Belum Ada Jadwal</div>
                <div class="empty-desc">Guru akan mengirimkan jadwal belajar untuk putra/putri Anda.</div>
                <a href="{{ route('orangtua.home') }}" class="btn-view" style="display:inline-block; margin-top: 8px;">← Kembali ke Home</a>
            </div>
        </div>
        @endif

    </div>{{-- /main-area --}}
</div>{{-- /app-layout --}}

</body>
</html>