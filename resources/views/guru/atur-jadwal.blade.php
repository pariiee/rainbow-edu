<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Jadwal Belajar - Rainbow Edu</title>
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
            max-width: 800px;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .info-section {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .user-header-box {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #bfdbfe;
        }

        .avatar {
            width: 56px;
            height: 56px;
            background: #3b82f6;
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }

        .user-title h2 {
            font-size: 18px;
            color: #1e3a8a;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .user-title p {
            font-size: 14px;
            color: #3b82f6;
            font-weight: 600;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
            font-size: 14px;
        }
        
        .info-row:last-child { margin-bottom: 0; }

        .info-label {
            width: 120px;
            color: #60a5fa;
            font-weight: 600;
        }

        .info-value {
            flex: 1;
            color: #1e3a8a;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #374151;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: inherit;
            color: #111827;
            background: #f9fafb;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .datetime-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar-slot { width: 100%; height: auto; position: relative; }
            .main-area { padding: 20px 16px; }
            
            .datetime-grid { grid-template-columns: 1fr; gap: 0; }
            .info-row { flex-direction: column; gap: 4px; }
            .info-label { width: 100%; }
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
        <x-sidebar.guru />
    </div>

    <div class="main-area">
        <div class="header">
            <div class="welcome">
                <h1><i class="ph-duotone ph-calendar-blank"></i> Atur Jadwal Belajar</h1>
            </div>
            <a href="{{ route('guru.paud.home') }}" class="btn-back">
                ← Batal
            </a>
        </div>

        <div class="card">
            @if(session('success'))
                <div class="alert-success">
                    <span style="font-size: 20px;"><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></span> {{ session('success') }}
                </div>
            @endif

            <div class="info-section">
                <div class="user-header-box">
                    <div class="avatar">{{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}</div>
                    <div class="user-title">
                        <h2>{{ $siswa->nama_lengkap }}</h2>
                        <p>{{ $siswa->nama_panggilan ?? 'Siswa' }} • {{ $siswa->layanan }}</p>
                    </div>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Orang Tua</span>
                    <span class="info-value">{{ $siswa->orangTua->name ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kontak</span>
                    <span class="info-value">{{ $siswa->orangTua->email ?? '-' }}</span>
                </div>
                @if($siswa->alamat_domisili)
                <div class="info-row">
                    <span class="info-label">Alamat</span>
                    <span class="info-value">{{ $siswa->alamat_domisili }}</span>
                </div>
                @endif
            </div>

            <form action="{{ route('guru.jadwal.store', $siswa->id) }}" method="POST">
                @csrf
                
                <div class="datetime-grid">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Pertemuan</label>
                        <input type="date" id="tanggal" name="tanggal" 
                               value="{{ old('tanggal', now()->format('Y-m-d')) }}" 
                               min="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="waktu">Waktu Mulai (WIB)</label>
                        <input type="time" id="waktu" name="waktu" 
                               value="{{ old('waktu', '09:00') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="durasi">Durasi Belajar</label>
                    <select id="durasi" name="durasi" required>
                        <option value="30">30 Menit</option>
                        <option value="45">45 Menit</option>
                        <option value="60" selected>60 Menit (1 Jam)</option>
                        <option value="90">90 Menit</option>
                        <option value="120">120 Menit (2 Jam)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan / Materi Terjadwal</label>
                    <textarea id="catatan" name="catatan" rows="4" 
                              placeholder="Ketik topik atau materi apa yang akan dipelajari... (Orang tua dapat melihat ini)">{{ old('catatan') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="ph-duotone ph-floppy-disk"></i> Ajukan Jadwal & Simpan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalInput = document.getElementById('tanggal');
        if (tanggalInput) {
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.min = today;
        }
    });
</script>

</body>
</html>