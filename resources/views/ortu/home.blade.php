<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>
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
            width: 260px; /* sesuaikan lebar sidebar komponen */
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

        /* Dekorasi pelangi kecil di pojok header */
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
        }

        .btn-logout:hover {
            background: #e53e3e;
            color: white;
            border-color: #e53e3e;
        }

        /* ── NOTIFIKASI FORM ── */
        .notif-banner {
            background: white;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
            border: 1px solid #ffe4cc;
        }

        .notif-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ff9f43, #ffd93d, #ff6b6b);
        }

        .notif-icon {
            font-size: 32px;
            line-height: 1;
        }

        .notif-body { flex: 1; min-width: 160px; }
        .notif-body h3 { font-size: 15px; font-weight: 700; color: #111827; margin-bottom: 2px; }
        .notif-body p  { font-size: 13px; color: #6b7280; }
        .notif-body small { font-size: 12px; color: #c2410c; }

        .btn-notif {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            background: #f59e0b;
            color: white;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
            transition: background 0.15s, transform 0.15s;
        }

        .btn-notif:hover { background: #d97706; transform: translateY(-1px); }

        /* ── GRID ── */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        /* ── CARDS ── */
        .card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            animation: fadeUp 0.4s ease both;
        }

        .card:nth-child(1) { animation-delay: 0.05s; }
        .card:nth-child(2) { animation-delay: 0.12s; }
        .card:nth-child(3) { animation-delay: 0.19s; }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 32px rgba(0,0,0,0.10);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-top-stripe { height: 4px; }
        .stripe-red    { background: linear-gradient(90deg, #ff6b6b, #ff9f43); }
        .stripe-green  { background: linear-gradient(90deg, #6bcb77, #4d96ff); }
        .stripe-violet { background: linear-gradient(90deg, #7b68ee, #c77dff); }

        .card-body { padding: 22px 24px; }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-bottom: 16px;
            margin-bottom: 16px;
            border-bottom: 1px solid #f3f4f6;
        }

        .card-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .icon-red    { background: #fff1f2; }
        .icon-green  { background: #f0fdf4; }
        .icon-violet { background: #f5f3ff; }

        .card-title small {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #9ca3af;
        }

        .card-title h2 {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        /* ── INFO ROWS ── */
        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 9px 0;
            border-bottom: 1px dashed #f3f4f6;
            font-size: 13px;
        }

        .info-row:last-of-type { border-bottom: none; }

        .info-label {
            width: 110px;
            flex-shrink: 0;
            color: #9ca3af;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            color: #111827;
            font-weight: 600;
            word-break: break-word;
        }

        /* ── BADGES ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-blue   { background: #eff6ff; color: #2563eb; }
        .badge-green  { background: #f0fdf4; color: #16a34a; }
        .badge-amber  { background: #fffbeb; color: #b45309; }

        /* ── TOMBOL ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 18px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s, transform 0.15s;
        }

        .btn-primary:hover { background: #4338ca; transform: translateY(-1px); }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 18px;
            background: transparent;
            color: #374151;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
        }

        .btn-secondary:hover { background: #f9fafb; border-color: #d1d5db; }

        .btn-block {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 11px 16px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 18px;
            cursor: pointer;
            border: none;
            background: #4f46e5;
            color: white;
            transition: background 0.15s, transform 0.15s;
        }

        .btn-block:hover { background: #4338ca; transform: translateY(-1px); }

        .btn-row {
            display: flex;
            gap: 8px;
            margin-top: 18px;
        }

        .btn-row .btn-primary,
        .btn-row .btn-secondary { flex: 1; }

        /* ── EMPTY / COMING SOON ── */
        .empty-state {
            text-align: center;
            padding: 28px 16px;
        }

        .empty-state .emo { font-size: 36px; margin-bottom: 10px; }
        .empty-state p { font-size: 13px; color: #6b7280; }

        .coming-soon {
            text-align: center;
            padding: 24px 16px;
        }

        .cs-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 99px;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .cs-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #a3e635;
            animation: blink 1.6s ease-in-out infinite;
        }

        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

        .coming-soon p { font-size: 13px; color: #6b7280; line-height: 1.6; }

        .note-text {
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
            margin-top: 8px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar-slot { width: 100%; height: auto; position: relative; }
            .main-area { padding: 20px 16px; }
            .dashboard-grid { grid-template-columns: 1fr; }
            .header { flex-direction: column; text-align: center; }
        }
    </style>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<!-- Dekorasi awan melayang -->
<div class="clouds">
    <div class="cloud cloud-1">
        <svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
            <path d="M30,60 Q10,60 10,45 Q10,30 25,28 Q22,10 40,10 Q52,10 58,20 Q65,8 80,8 Q100,8 105,25 Q118,20 130,28 Q145,25 150,38 Q160,38 160,50 Q160,62 148,62 Z"/>
        </svg>
    </div>
    <div class="cloud cloud-2">
        <svg viewBox="0 0 140 56" xmlns="http://www.w3.org/2000/svg">
            <path d="M20,42 Q6,42 6,30 Q6,18 18,17 Q15,4 30,4 Q40,4 45,12 Q52,3 65,3 Q82,3 86,17 Q96,14 104,22 Q114,20 116,30 Q122,30 122,40 Q122,48 112,48 Z"/>
        </svg>
    </div>
    <div class="cloud cloud-3">
        <svg viewBox="0 0 180 70" xmlns="http://www.w3.org/2000/svg">
            <path d="M28,54 Q8,54 8,40 Q8,26 22,24 Q18,8 36,8 Q48,8 54,18 Q62,6 78,6 Q100,6 104,22 Q116,18 126,26 Q140,22 144,36 Q154,36 154,48 Q154,58 142,60 Z"/>
        </svg>
    </div>
    <div class="cloud cloud-4">
        <svg viewBox="0 0 160 64" xmlns="http://www.w3.org/2000/svg">
            <path d="M24,50 Q6,50 6,36 Q6,22 20,20 Q16,6 34,6 Q46,6 52,16 Q58,4 74,4 Q96,4 100,20 Q110,16 120,24 Q132,20 136,34 Q146,34 146,44 Q146,56 134,56 Z"/>
        </svg>
    </div>
    <div class="cloud cloud-5">
        <svg viewBox="0 0 200 76" xmlns="http://www.w3.org/2000/svg">
            <path d="M32,58 Q10,58 10,44 Q10,30 24,28 Q20,10 40,10 Q54,10 60,20 Q68,8 84,8 Q108,8 112,26 Q122,22 134,30 Q148,26 152,40 Q164,40 164,52 Q164,62 150,64 Z"/>
        </svg>
    </div>
    <div class="cloud cloud-6">
        <svg viewBox="0 0 130 52" xmlns="http://www.w3.org/2000/svg">
            <path d="M18,40 Q4,40 4,28 Q4,16 16,15 Q12,2 28,2 Q38,2 44,10 Q50,2 62,2 Q80,2 84,16 Q94,12 100,20 Q110,18 112,28 Q118,28 118,38 Q118,46 108,46 Z"/>
        </svg>
    </div>
</div>

<div class="app-layout">

    {{-- SIDEBAR KOMPONEN ASLI --}}
    <div class="sidebar-slot">
        <x-sidebar.ortu :siswa="$siswa" />
    </div>

    {{-- HALAMAN UTAMA --}}
    <div class="main-area">

        {{-- HEADER --}}
        <div class="header">
            <div class="welcome">
                <h1>Selamat Datang, <span class="name">{{ auth()->user()->name }}</span> <i class="ph-duotone ph-hand-waving"></i></h1>
                <p>Orang Tua dari <strong>{{ $siswa->nama_lengkap ?? 'Belum diisi' }}</strong></p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>

        {{-- NOTIFIKASI FORM --}}
        @if($hasCompletedLayanan && !$hasCompletedQuestionnaire)
        <div class="notif-banner">
            <div class="notif-icon"><i class="ph-duotone ph-clipboard-text"></i></div>
            <div class="notif-body">
                <h3>Lengkapi Data Siswa</h3>
                <p>Bantu guru memahami kebutuhan, minat, dan karakter putra/putri Anda.</p>
                <small><i class="ph-duotone ph-warning-circle" style="color: #f59e0b;"></i> Formulir ini penting untuk penyesuaian program pembelajaran</small>
            </div>
            <a href="{{ route('ortu.form') }}" class="btn-notif">
                <i class="ph-duotone ph-notepad"></i> Isi Form Sekarang
            </a>
        </div>
        @endif

        {{-- GRID CARDS --}}
        <div class="dashboard-grid">

            {{-- CARD: DATA SISWA --}}
            <div class="card">
                <div class="card-top-stripe stripe-red"></div>
                <div class="card-body">
                    <div class="card-header">
                        <div class="card-icon icon-red"><i class="ph-duotone ph-user"></i></div>
                        <div class="card-title">
                            <small>Data Siswa</small>
                            <h2>{{ $siswa->nama_lengkap ?? 'Belum diisi' }}</h2>
                        </div>
                    </div>

                    @if($siswa)
                        <div class="info-row">
                            <span class="info-label">NISN</span>
                            <span class="info-value">{{ $siswa->nisn ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tgl. Lahir</span>
                            <span class="info-value">
                                {{ $siswa->tempat_lahir ?? '-' }},
                                {{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') : '-' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Layanan</span>
                            <span class="info-value">
                                <span class="badge badge-blue">{{ $siswa->layanan ?? '-' }}</span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status Form</span>
                            <span class="info-value">
                                @if($hasCompletedQuestionnaire)
                                    <span class="badge badge-green">✓ Sudah diisi</span>
                                @else
                                    <span class="badge badge-amber"><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i> Belum diisi</span>
                                @endif
                            </span>
                        </div>

                        @if(!$hasCompletedQuestionnaire && $hasCompletedLayanan)
                            <a href="{{ route('ortu.form') }}" class="btn-block">
                                <i class="ph-duotone ph-notepad"></i> Isi Form Data Siswa
                            </a>
                            <p class="note-text">Abaikan jika sudah pernah mengisi</p>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="emo"><i class="ph-duotone ph-folders"></i></div>
                            <p>Belum ada data siswa</p>
                            @if($hasCompletedLayanan && !$hasCompletedQuestionnaire)
                                <a href="{{ route('ortu.form') }}" class="btn-block">Isi Form</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- CARD: GURU PENDAMPING --}}
            <div class="card">
                <div class="card-top-stripe stripe-green"></div>
                <div class="card-body">
                    <div class="card-header">
                        <div class="card-icon icon-green"><i class="ph-duotone ph-chalkboard-teacher"></i></div>
                        <div class="card-title">
                            <small>Guru Pendamping</small>
                            <h2>{{ $siswa->guru->name ?? 'Belum ditentukan' }}</h2>
                        </div>
                    </div>

                    @if($siswa && $siswa->guru)
                        <div class="info-row">
                            <span class="info-label">Divisi</span>
                            <span class="info-value">{{ $siswa->guru->guru_type ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value" style="font-size:12px;">{{ $siswa->guru->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">No. Telepon</span>
                            <span class="info-value">{{ $siswa->guru->nomor_telepon ?? '-' }}</span>
                        </div>

                        <div class="btn-row">
                            <a href="{{ route('ortu.jadwal.index') }}" class="btn-primary"><i class="ph-duotone ph-calendar-blank"></i> Lihat Jadwal</a>
                            <a href="{{ route('chat.show', $siswa->id) }}" class="btn-secondary"><i class="ph-duotone ph-chat-teardrop-dots"></i> Chat Guru</a>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="emo"><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i></div>
                            <p>Menunggu penempatan guru</p>
                            <span class="badge badge-amber" style="margin-top:12px;">Dalam proses</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- CARD: PROGRESS BELAJAR --}}
            <div class="card">
                <div class="card-top-stripe stripe-violet"></div>
                <div class="card-body">
                    <div class="card-header">
                        <div class="card-icon icon-violet"><i class="ph-duotone ph-chart-bar"></i></div>
                        <div class="card-title">
                            <small>Perkembangan</small>
                            <h2>Progress Belajar</h2>
                        </div>
                    </div>
                    <div class="coming-soon">
                        <div class="cs-pill">
                            <span class="cs-dot"></span>
                            Dalam Pengembangan
                        </div>
                        <p>Fitur laporan perkembangan belajar putra/putri Anda akan segera tersedia.</p>
                    </div>
                </div>
            </div>

        </div>{{-- /dashboard-grid --}}

    </div>{{-- /main-area --}}

</div>{{-- /app-layout --}}

@if(session('success'))
<script>alert("{{ session('success') }}");</script>
@endif
@if(session('error'))
<script>alert("{{ session('error') }}");</script>
@endif

</body>
</html>