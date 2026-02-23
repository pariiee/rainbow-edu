<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jadwal - Rainbow Edu</title>
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

        .cloud svg path { fill: white; }


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
            animation: slideDown 0.4s ease both;
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
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back:hover {
            background: #e5e7eb;
            color: #1f2937;
            transform: translateY(-2px);
        }

        /* MAIN CARD */
        .card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            animation: slideUp 0.4s ease both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-approved { background: #d1fae5; color: #065f46; }
        .status-completed { background: #f3f4f6; color: #374151; }
        .status-cancelled { background: #fee2e2; color: #b91c1c; }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .info-section {
            background: #f9fafb;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #f3f4f6;
        }

        .info-section h3 {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e5e7eb;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
            font-size: 14px;
        }
        
        .info-row:last-child { margin-bottom: 0; }

        .info-label {
            width: 100px;
            color: #6b7280;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            color: #111827;
            font-weight: 600;
        }

        .layanan-badge {
            background: #eff6ff; 
            color: #2563eb; 
            padding: 4px 12px; 
            border-radius: 50px; 
            font-size: 12px; 
            font-weight: 700;
        }

        .detail-card {
            background: #f9fafb;
            border-radius: 16px;
            padding: 24px;
            margin-top: 24px;
            border: 1px solid #f3f4f6;
        }

        .detail-card h3 {
            font-size: 16px;
            color: #111827;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }

        .time-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .time-box .title {
            color: #6b7280; 
            font-size: 13px; 
            margin-bottom: 4px;
            font-weight: 600;
        }

        .time-box .value {
            font-size: 24px; 
            font-weight: 800; 
            color: #111827;
        }

        .time-box .sub {
            font-size: 14px; 
            font-weight: 500; 
            color: #6b7280;
        }

        .note-box {
            background: white; 
            padding: 20px; 
            border-radius: 12px; 
            color: #4b5563; 
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid #e5e7eb;
        }

        .feedback-box {
            background: #f0fdf4; 
            padding: 20px; 
            border-radius: 12px; 
            color: #065f46; 
            border-left: 4px solid #10b981;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #374151;
            font-size: 14px;
        }

        textarea, input[type="date"], input[type="time"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: inherit;
        }

        textarea:focus, input[type="date"]:focus, input[type="time"]:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            padding: 12px 24px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
        }

        .btn-success { background: #10b981; }
        .btn-success:hover { background: #059669; box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2); }
        
        .btn-warning { background: #f59e0b; }
        .btn-warning:hover { background: #d97706; box-shadow: 0 8px 16px rgba(245, 158, 11, 0.2); }

        .btn-danger { background: #ef4444; }
        .btn-danger:hover { background: #dc2626; box-shadow: 0 8px 16px rgba(239, 68, 68, 0.2); }
        
        .btn-secondary {
            background: white; color: #4b5563; border: 1px solid #d1d5db;
        }
        .btn-secondary:hover {
            background: #f9fafb; color: #111827; transform: none; box-shadow: none;
        }

        .btn-group {
            display: flex;
            gap: 12px;
        }

        /* Forms Panel */
        .action-panel {
            margin-top: 24px;
            background: #f8fafc;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            animation: slideDown 0.3s ease;
        }

        .action-title {
            font-size: 16px; color: #1e293b; font-weight: 700; margin-bottom: 16px;
            display: flex; align-items: center; gap: 8px;
        }

        .alert-orange {
            background: #fffbeb;
            padding: 20px;
            border-radius: 16px;
            border: 1px solid #fde68a;
            margin-bottom: 24px;
            text-align: center;
        }

        .alert-orange h4 {
            color: #92400e; 
            margin-bottom: 12px; 
            font-size: 15px; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            gap: 8px;
        }

        .replacement-info {
            background: white; 
            padding: 16px; 
            border-radius: 12px;
            font-size: 14px;
            border: 1px dashed #fcd34d;
            display: inline-block;
            text-align: left;
            margin-bottom: 12px;
        }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar-slot { width: 100%; height: auto; position: relative; }
            .main-area { padding: 20px 16px; }
            
            .info-grid { grid-template-columns: 1fr; }
            .time-box { grid-template-columns: 1fr; gap: 16px; }
            .btn-group { flex-direction: column; }
            .info-row { flex-direction: column; gap: 4px; }
            .btn-group .btn-primary { width: 100%; }
        }
    </style>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

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
    <div class="sidebar-slot">
        <x-sidebar.ortu :siswa="$siswa" />
    </div>

    <div class="main-area">
        <div class="header">
            <div class="welcome">
                <h1><i class="ph-duotone ph-calendar-blank"></i> Detail Jadwal</h1>
            </div>
            <a href="{{ route('ortu.jadwal.index') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        <div class="card">
            @php
                $statusClass = '';
                $statusText = '';
                switch($jadwal->status) {
                    case 'pending':
                        $statusClass = 'status-pending';
                        $statusText = '<i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i> Menunggu Persetujuan Anda';
                        break;
                    case 'disetujui':
                        $statusClass = 'status-approved';
                        $statusText = '<i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i> Disetujui';
                        break;
                    case 'selesai':
                        $statusClass = 'status-completed';
                        $statusText = '<i class="ph-duotone ph-confetti" style="color: #f59e0b;"></i> Selesai';
                        break;
                    case 'dibatalkan':
                        $statusClass = 'status-cancelled';
                        $statusText = '<i class="ph-duotone ph-x-circle" style="color: #ef4444;"></i> Dibatalkan';
                        break;
                }
            @endphp

            <div class="status-badge {{ $statusClass }}">
                {{ $statusText }}
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <h3><span><i class="ph-duotone ph-user"></i></span> Data Siswa</h3>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $jadwal->siswa->nama_lengkap }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Panggilan</span>
                        <span class="info-value">{{ $jadwal->siswa->nama_panggilan ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Layanan</span>
                        <span class="info-value">
                            <span class="layanan-badge">{{ $jadwal->siswa->layanan }}</span>
                        </span>
                    </div>
                </div>

                <div class="info-section">
                    <h3><span><i class="ph-duotone ph-chalkboard-teacher"></i></span> Data Guru</h3>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $jadwal->guru->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $jadwal->guru->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Divisi</span>
                        <span class="info-value">{{ $jadwal->guru->guru_type }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <h3><span><i class="ph-duotone ph-clipboard-text"></i></span> Detail Rencana Belajar</h3>
                
                <div class="time-box">
                    <div>
                        <div class="title">Tanggal</div>
                        <div class="value">
                            {{ $jadwal->tanggal->format('d') }}
                            <span class="sub">{{ $jadwal->tanggal->format('F Y') }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="title">Waktu</div>
                        <div class="value">
                            {{ $jadwal->waktu->format('H:i') }} WIB
                            <span class="sub">({{ $jadwal->durasi }} menit)</span>
                        </div>
                    </div>
                </div>

                @if($jadwal->catatan)
                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px dashed #e5e7eb;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; font-weight: 700; color: #111827;">
                        <span style="font-size: 18px;"><i class="ph-duotone ph-notepad"></i></span> Catatan / Materi Guru:
                    </div>
                    <div class="note-box">
                        {{ $jadwal->catatan }}
                    </div>
                </div>
                @endif

                @if($jadwal->feedback_guru)
                <div style="margin-top: 24px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; font-weight: 700; color: #111827;">
                        <span style="font-size: 18px;"><i class="ph-duotone ph-chat-teardrop-dots"></i></span> Feedback Guru (Setelah Selesai):
                    </div>
                    <div class="feedback-box">
                        {{ $jadwal->feedback_guru }}
                    </div>
                </div>
                @endif
            </div>

            {{-- 1. AKSI PENDING UNTUK ORANG TUA --}}
            @if($jadwal->status == 'pending')
                @if($jadwal->is_pengajuan_pengganti)
                    <div class="alert-orange" style="margin-top: 32px;">
                        <h4><span><i class="ph-duotone ph-hourglass-medium" style="color: #d97706;"></i></span> Anda telah mengajukan jadwal pengganti</h4>
                        <div class="replacement-info">
                            <div style="margin-bottom: 8px;"><strong>Tanggal:</strong> {{ $jadwal->tanggal_pengganti->format('d F Y') }}</div>
                            <div style="margin-bottom: 8px;"><strong>Waktu:</strong> {{ $jadwal->waktu_pengganti->format('H:i') }} WIB</div>
                            <div><strong>Alasan:</strong> {{ $jadwal->alasan_pengganti }}</div>
                        </div>
                        <p style="color: #92400e; font-size: 14px; font-weight: 600;">Menunggu konfirmasi dari guru bersangkutan.</p>
                    </div>
                @else
                    <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                        {{-- FORM: APPROVE --}}
                        <form action="{{ route('ortu.jadwal.approve', $jadwal->id) }}" method="POST" id="approveForm">
                            @csrf
                            <div class="form-group">
                                <label for="feedback">Kirim Balasan Singkat ke Guru (opsional)</label>
                                <textarea name="feedback" id="feedback" rows="2" 
                                          placeholder="Tulis pesan kesiapan anak... (Pesan ini hanya terlihat oleh guru)">{{ old('feedback') }}</textarea>
                            </div>
                            
                            <div class="btn-group">
                                <button type="submit" class="btn-primary btn-success" style="flex: 2;">
                                    <i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i> Setujui Jadwal Ini
                                </button>
                                <button type="button" class="btn-primary btn-warning" style="flex: 1;" onclick="showReplaceForm()">
                                    <i class="ph-duotone ph-arrows-clockwise"></i> Pengganti
                                </button>
                                <button type="button" class="btn-primary btn-danger" style="flex: 1;" onclick="showRejectForm()">
                                    <i class="ph-duotone ph-x-circle" style="color: #ef4444;"></i> Tolak
                                </button>
                            </div>
                        </form>

                        {{-- FORM: REJECT --}}
                        <form action="{{ route('ortu.jadwal.reject', $jadwal->id) }}" method="POST" id="rejectForm" style="display: none;" class="action-panel">
                            @csrf
                            <div class="action-title"><span><i class="ph-duotone ph-x-circle" style="color: #ef4444;"></i></span> Tolak Jadwal</div>
                            <div class="form-group">
                                <label for="alasan">Alasan Penolakan <span style="color: #ef4444;">*</span></label>
                                <textarea name="alasan" id="alasan" rows="3" 
                                          placeholder="Jelaskan alasan mengapa Anda tidak menyetujui jadwal ini..." required></textarea>
                            </div>
                            
                            <div class="btn-group">
                                <button type="submit" class="btn-primary btn-danger" style="flex: 2;">
                                    Kirim Penolakan
                                </button>
                                <button type="button" class="btn-primary btn-secondary" style="flex: 1;" onclick="hideForms()">
                                    Batal
                                </button>
                            </div>
                        </form>

                        {{-- FORM: LAKUKAN PENGGANTIAN --}}
                        <form action="{{ route('ortu.jadwal.proposeReplacement', $jadwal->id) }}" method="POST" id="replaceForm" style="display: none;" class="action-panel">
                            @csrf
                            <div class="action-title"><span><i class="ph-duotone ph-arrows-clockwise"></i></span> Ajukan Jadwal Pengganti</div>
                            
                            <div class="time-box" style="margin-bottom: 20px;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="tanggal_pengganti">Tgl Pengganti <span style="color: #ef4444;">*</span></label>
                                    <input type="date" name="tanggal_pengganti" id="tanggal_pengganti" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="waktu_pengganti">Waktu <span style="color: #ef4444;">*</span></label>
                                    <input type="time" name="waktu_pengganti" id="waktu_pengganti" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="alasan_pengganti">Alasan Pindah Jadwal <span style="color: #ef4444;">*</span></label>
                                <textarea name="alasan_pengganti" id="alasan_pengganti" rows="3" 
                                          placeholder="Jelaskan alasannya pada guru..." required></textarea>
                            </div>
                            
                            <div class="btn-group">
                                <button type="submit" class="btn-primary btn-warning" style="flex: 2;">
                                    Kirim Pengajuan
                                </button>
                                <button type="button" class="btn-primary btn-secondary" style="flex: 1;" onclick="hideForms()">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    <script>
                        function showRejectForm() {
                            document.getElementById('approveForm').style.display = 'none';
                            document.getElementById('replaceForm').style.display = 'none';
                            document.getElementById('rejectForm').style.display = 'block';
                        }
                        
                        function showReplaceForm() {
                            document.getElementById('approveForm').style.display = 'none';
                            document.getElementById('rejectForm').style.display = 'none';
                            document.getElementById('replaceForm').style.display = 'block';
                        }

                        function hideForms() {
                            document.getElementById('rejectForm').style.display = 'none';
                            document.getElementById('replaceForm').style.display = 'none';
                            document.getElementById('approveForm').style.display = 'block';
                        }
                    </script>
                @endif
            @endif

            {{-- 2. TAMPILAN BALASAN FEEDBACK DARI ORTU JIKA ADA --}}
            @if($jadwal->feedback_ortu)
            <div style="margin-top: 32px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; font-weight: 700; color: #111827;">
                    <span style="font-size: 18px;"><i class="ph-duotone ph-chat-teardrop-dots"></i></span> Anda Menjawab:
                </div>
                <div style="background: white; padding: 20px; border-radius: 12px; color: #4b5563; border: 1px solid #e5e7eb; font-size: 14px;">
                    {{ $jadwal->feedback_ortu }}
                </div>
            </div>
            @endif

            {{-- 3. JIKA SUDAH DISETUJUI, BISA DIRECT CHAT --}}
            @if($jadwal->status == 'disetujui' || $jadwal->status == 'selesai')
            <div style="margin-top: 32px; display: flex; justify-content: center;">
                <a href="{{ route('chat.show', $jadwal->guru_id) }}" class="btn-primary" style="padding: 14px 32px;">
                    <i class="ph-duotone ph-chat-teardrop-dots"></i> Live Chat dengan Guru
                </a>
            </div>
            @endif

        </div>
    </div>
</div>

</body>
</html>