<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru PAUD - Rainbow Edu</title>
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

        /* warna-warni subtle pada tiap awan */
        .cloud-1 svg path { fill: #ffd6d6; }
        .cloud-2 svg path { fill: #ffe4cc; }
        .cloud-3 svg path { fill: #d6f5d6; }
        .cloud-4 svg path { fill: #cce5ff; }
        .cloud-5 svg path { fill: #e0d6ff; }
        .cloud-6 svg path { fill: #ffd6f5; }

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
                rgba(255,107,107,0.08) 0%,
                rgba(255,159,67,0.06) 25%,
                rgba(107,203,119,0.05) 50%,
                rgba(77,150,255,0.04) 75%,
                transparent 100%
            );
            pointer-events: none;
        }

        .welcome h1 {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.3px;
        }

        .welcome h1 .name {
            background: linear-gradient(90deg, #ff6b6b, #ff9f43, #ffd93d, #6bcb77, #4d96ff, #7b68ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn-logout {
            padding: 10px 20px;
            background: #fff1f2;
            color: #e53e3e;
            border: 1.5px solid #fecaca;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            z-index: 2;
        }

        .btn-logout:hover {
            background: #e53e3e;
            color: white;
            border-color: #e53e3e;
        }

        /* ── STATS GRID (Top Stats) ── */
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

        .icon-blue { background: #eff6ff; color: #2563eb; }
        .icon-green { background: #f0fdf4; color: #16a34a; }
        .icon-amber { background: #fffbeb; color: #d97706; }
        .icon-purple { background: #f5f3ff; color: #9333ea; }

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

        /* ── DAFTAR SISWA SECTION ── */
        .card-list {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            overflow: hidden;
            animation: fadeUp 0.5s ease both;
            animation-delay: 0.3s;
        }

        .card-list-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-list-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            padding: 6px 14px;
            border: 1px solid #e5e7eb;
            background: white;
            border-radius: 8px;
            color: #4b5563;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn.active {
            background: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }

        .siswa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            padding: 24px;
            background: #f9fafb;
        }

        .siswa-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #f3f4f6;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }

        .siswa-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.06);
        }

        /* Stripe warna per card anak */
        .siswa-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6bcb77, #4d96ff);
        }
        
        .siswa-card[data-status="pending"]::before {
            background: linear-gradient(90deg, #ffd93d, #ff9f43);
        }

        .siswa-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .siswa-avatar {
            width: 48px;
            height: 48px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
        }

        .siswa-info {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .siswa-name {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .siswa-nickname {
            color: #6b7280;
            font-size: 12px;
        }

        .siswa-detail {
            border-top: 1px dashed #e5e7eb;
            padding-top: 14px;
            margin-top: 10px;
        }

        .detail-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 8px;
        }

        .status-badge {
            display: inline-flex;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-active { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef9c3; color: #854d0e; }

        .btn-action-group {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .btn-action {
            flex: 1;
            padding: 8px;
            text-align: center;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-jadwal {
            background: #4f46e5;
            color: white;
        }

        .btn-jadwal:hover { background: #4338ca; }

        .btn-chat {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #e5e7eb;
        }

        .btn-chat:hover { background: #e5e7eb; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar-slot { width: 100%; height: auto; position: relative; }
            .main-area { padding: 20px 16px; }
            .stats-grid { grid-template-columns: 1fr; }
            .header { flex-direction: column; text-align: center; }
            .btn-action-group { flex-direction: column; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .empty-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .empty-desc {
            font-size: 13px;
            color: #6b7280;
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

        {{-- HEADER --}}
        <div class="header">
            <div class="welcome">
                <h1>Selamat Datang, <span class="name">{{ auth()->user()->name }}</span> <i class="ph-duotone ph-hand-waving"></i></h1>
                <p><i class="ph-duotone ph-chalkboard-teacher"></i> Guru PAUD Rainbow Edu & Permata Montessori | <strong>{{ now()->format('l, d F Y') }}</strong></p>
            </div>
            <!-- Menggunakan custom logout di atas jika diperlukan khusus di area card, namun karena di sidebar sudah ada, di sini bisa menjadi cadangan -->
        </div>

        {{-- STATS GRID --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-blue"><i class="ph-duotone ph-baby"></i></div>
                <div class="stat-info">
                    <h3>Total Siswa</h3>
                    <div class="number">{{ $totalSiswa ?? 0 }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green"><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></div>
                <div class="stat-info">
                    <h3>Siswa Aktif</h3>
                    <div class="number">{{ $siswaAktif ?? 0 }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-amber"><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i></div>
                <div class="stat-info">
                    <h3>Pending</h3>
                    <div class="number">{{ $siswaPending ?? 0 }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-purple"><i class="ph-duotone ph-calendar-blank"></i></div>
                <div class="stat-info">
                    <h3>Jadwal Hari Ini</h3>
                    <div class="number">{{ $jadwalHariIni ?? 0 }}</div>
                </div>
            </div>
        </div>

        {{-- DAFTAR SISWA SECTION --}}
        <div class="card-list">
            <div class="card-list-header">
                <h2><i class="ph-duotone ph-clipboard-text"></i> Daftar Siswa PAUD</h2>
                <div class="filter-group">
                    <button class="filter-btn active" onclick="filterSiswa('all')">Semua</button>
                    <button class="filter-btn" onclick="filterSiswa('active')">Aktif</button>
                    <button class="filter-btn" onclick="filterSiswa('pending')">Pending</button>
                </div>
            </div>

            @if(isset($siswaList) && $siswaList->count() > 0)
                <div class="siswa-grid">
                    @foreach($siswaList as $siswa)
                    <div class="siswa-card" data-status="{{ $siswa->status_assign ?? 'pending' }}">
                        
                        <div class="siswa-header">
                            <div class="siswa-avatar">
                                {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                            </div>
                            <div class="siswa-info">
                                <div class="siswa-name">{{ $siswa->nama_lengkap }}</div>
                                <div class="siswa-nickname"><i class="ph-duotone ph-user"></i> {{ $siswa->nama_panggilan ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="siswa-detail">
                            <div class="detail-row">
                                <span style="font-size: 14px; margin-right: 4px;"><i class="ph-duotone ph-users-three"></i></span> 
                                <span>Orang Tua: <strong>{{ $siswa->orangTua->name ?? '-' }}</strong></span>
                            </div>
                            <div class="detail-row">
                                <span style="font-size: 14px; margin-right: 4px;"><i class="ph-duotone ph-books"></i></span> 
                                <span>Layanan: <strong>{{ $siswa->layanan ?? 'PAUD' }}</strong></span>
                            </div>
                            <div class="detail-row">
                                <span style="font-size: 14px; margin-right: 4px;"><i class="ph-duotone ph-chart-bar"></i></span> 
                                <span>Status: 
                                    @if(isset($siswa->status_assign) && $siswa->status_assign == 'active')
                                        <span class="status-badge status-active">Aktif</span>
                                    @else
                                        <span class="status-badge status-pending">Pending</span>
                                    @endif
                                </span>
                            </div>
                            @if(isset($siswa->questionnaire) && $siswa->questionnaire && !$siswa->questionnaire->is_skipped)
                            <div class="detail-row">
                                <span style="font-size: 14px; margin-right: 4px;"><i class="ph-duotone ph-notepad"></i></span> 
                                <span style="color: #166534; font-weight: 600;">Questionnaire Terisi ✓</span>
                            </div>
                            @endif
                        </div>

                        <div class="btn-action-group">
                            <a href="{{ route('guru.jadwal.siswa', $siswa->id) }}" class="btn-action btn-jadwal">
                                <i class="ph-duotone ph-calendar-blank"></i> Atur Jadwal
                            </a>
                            <a href="{{ route('chat.show', $siswa->id) }}" class="btn-action btn-chat">
                                <i class="ph-duotone ph-chat-teardrop-dots"></i> Chat Ortu
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="ph-duotone ph-folder-open"></i></div>
                    <div class="empty-title">Belum Ada Siswa</div>
                    <div class="empty-desc">Siswa yang mendaftar layanan PAUD akan muncul di sini. <br> Saat ini belum ada siswa yang terdaftar.</div>
                </div>
            @endif
        </div>

    </div>{{-- /main-area --}}
</div>{{-- /app-layout --}}

<script>
    function filterSiswa(status) {
        // Update active class on buttons
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Filter cards
        document.querySelectorAll('.siswa-card').forEach(card => {
            if (status === 'all') {
                card.style.display = 'block';
            } else {
                if (card.getAttribute('data-status') === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }
</script>

</body>
</html>