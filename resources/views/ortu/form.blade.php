<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Siswa - Rainbow Edu</title>
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
        .clouds { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .cloud { position: absolute; opacity: 0.55; animation: drift linear infinite; }
        .cloud svg path { fill: white; }
        .cloud-1  { top: 4%;  left: -120px; width: 220px; animation-duration: 60s; animation-delay: 0s; }
        .cloud-2  { top: 12%; left: -80px;  width: 140px; animation-duration: 75s; animation-delay: -20s; opacity: 0.35; }
        .cloud-3  { top: 28%; left: -160px; width: 180px; animation-duration: 55s; animation-delay: -10s; }
        .cloud-4  { top: 55%; left: -100px; width: 160px; animation-duration: 80s; animation-delay: -35s; opacity: 0.3; }
        .cloud-5  { top: 72%; left: -140px; width: 200px; animation-duration: 65s; animation-delay: -5s; }
        .cloud-6  { top: 88%; left: -90px;  width: 130px; animation-duration: 70s; animation-delay: -45s; opacity: 0.35; }
        @keyframes drift { from { transform: translateX(0); } to { transform: translateX(calc(100vw + 300px)); } }
        /* warna-warni */
        .cloud-1 svg path { fill: #ffd6d6; } .cloud-2 svg path { fill: #ffe4cc; } .cloud-3 svg path { fill: #d6f5d6; }
        .cloud-4 svg path { fill: #cce5ff; } .cloud-5 svg path { fill: #e0d6ff; } .cloud-6 svg path { fill: #ffd6f5; }

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

        .welcome h1 .name {
            background: linear-gradient(90deg, #ff6b6b, #ff9f43, #ffd93d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
            position: relative; z-index: 2;
        }

        .btn-back:hover {
            background: #e5e7eb;
            color: #1f2937;
            transform: translateY(-2px);
        }

        .form-container {
            max-width: 820px;
        }

        .progress {
            margin-bottom: 24px;
            animation: slideUp 0.4s ease both;
        }

        .progress-bar {
            width: 100%; height: 8px; background: #e5e7eb;
            border-radius: 4px; overflow: hidden; margin-bottom: 8px;
        }

        .progress-fill {
            width: 50%; height: 100%; background: linear-gradient(90deg, #4d96ff, #7b68ee);
            border-radius: 4px; transition: width 0.3s ease;
        }

        .progress-text {
            text-align: right; color: #6b7280; font-size: 13px; font-weight: 600;
        }

        .info-box {
            background: #eff6ff; border: 1px solid #bfdbfe;
            padding: 20px 24px; border-radius: 18px; margin-bottom: 28px;
            animation: slideUp 0.4s ease both; animation-delay: 0.1s;
            display: flex; gap: 16px; align-items: flex-start;
        }

        .info-box .icon {
            font-size: 28px; line-height: 1;
            background: white; padding: 12px; border-radius: 14px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .info-box p {
            color: #1e3a8a; line-height: 1.6; font-size: 14px; margin-top: 4px;
        }

        .info-box strong { font-size: 16px; display: block; margin-bottom: 4px; }

        /* MULTI-CARD FORM SECTIONS */
        .form-section {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            margin-bottom: 24px;
            animation: slideUp 0.4s ease both;
            border: 1px solid #f3f4f6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .form-section:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        .form-section:nth-child(1) { animation-delay: 0.1s; }
        .form-section:nth-child(2) { animation-delay: 0.2s; }
        .form-section:nth-child(3) { animation-delay: 0.3s; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-top-stripe { height: 4px; }
        .stripe-blue   { background: linear-gradient(90deg, #4d96ff, #7b68ee); }
        .stripe-amber  { background: linear-gradient(90deg, #ff9f43, #ffd93d); }
        .stripe-green  { background: linear-gradient(90deg, #6bcb77, #4d96ff); }
        .stripe-purple { background: linear-gradient(90deg, #7b68ee, #c77dff); }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 24px 28px 16px;
            border-bottom: 1px dashed #e5e7eb;
        }

        .card-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; flex-shrink: 0;
        }

        .icon-blue   { background: #eff6ff; color: #2563eb; }
        .icon-amber  { background: #fffbeb; color: #d97706; }
        .icon-green  { background: #f0fdf4; color: #16a34a; }
        .icon-purple { background: #f5f3ff; color: #7c3aed; }

        .card-title h2 { font-size: 18px; font-weight: 800; color: #111827; }
        .card-title p  { font-size: 13px; color: #6b7280; margin-top: 2px; }

        .card-body { padding: 24px 28px; }

        .form-group { margin-bottom: 24px; }
        .form-group:last-child { margin-bottom: 0; }

        label {
            display: block; margin-bottom: 8px; font-weight: 700;
            color: #374151; font-size: 14.5px;
        }

        .required { color: #ef4444; margin-left: 4px; }

        .hint {
            font-size: 12.5px; color: #9ca3af; margin-bottom: 8px; display: block; font-weight: 500;
        }

        input, select, textarea {
            width: 100%; padding: 15px 18px;
            border: 2px solid #e5e7eb; border-radius: 12px;
            font-size: 14.5px; transition: all 0.2s;
            background: #f9fafb; font-family: inherit; color: #111827;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #3b82f6; outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12); background: white;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .radio-chips {
            display: flex; gap: 12px; flex-wrap: wrap; margin-top: 8px;
        }

        .chip-label {
            position: relative;
            cursor: pointer;
        }

        .chip-label input { position: absolute; opacity: 0; cursor: pointer; }

        .chip-box {
            padding: 12px 20px; background: white; border: 2px solid #e5e7eb;
            border-radius: 12px; font-size: 14px; font-weight: 600; color: #4b5563;
            transition: all 0.2s; display: flex; align-items: center; gap: 8px;
        }

        .chip-label:hover .chip-box { background: #f9fafb; border-color: #d1d5db; }

        .chip-label input:checked ~ .chip-box {
            background: #eff6ff; border-color: #3b82f6; color: #1e3a8a;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        /* ── STICKY FOOTER BUTTON ── */
        .bottom-action {
            background: white; border-radius: 20px; padding: 24px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06); margin-top: 32px;
            display: flex; justify-content: flex-end; gap: 16px;
            position: sticky; bottom: 32px; z-index: 10;
            border: 1px solid #f3f4f6;
            animation: slideUp 0.4s ease both; animation-delay: 0.4s;
        }

        .btn-primary {
            min-width: 200px; padding: 16px 24px;
            background: linear-gradient(135deg, #4d96ff, #7b68ee);
            color: white; border: none; border-radius: 14px;
            font-size: 16px; font-weight: 800; cursor: pointer;
            transition: all 0.2s; box-shadow: 0 8px 20px rgba(123, 104, 238, 0.3);
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px); box-shadow: 0 12px 24px rgba(123, 104, 238, 0.4);
        }

        .btn-secondary {
            padding: 16px 28px; border: 2px solid #e5e7eb; border-radius: 14px;
            font-size: 15px; font-weight: 700; background: white; color: #4b5563;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
            display: flex; align-items: center; justify-content: center;
        }

        .btn-secondary:hover { background: #f9fafb; color: #111827; border-color: #d1d5db; }

        .alert-success, .alert-error {
            padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;
            font-weight: 600; display: flex; align-items: center; gap: 12px; font-size: 14px;
        }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar-slot { width: 100%; height: auto; position: relative; }
            .main-area { padding: 20px 16px; }
            
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .bottom-action { flex-direction: column; position: static; box-shadow: none; background: transparent; padding: 0; border: none; margin-bottom: 30px; }
            .btn-primary, .btn-secondary { width: 100%; }
            .radio-chips { flex-direction: column; }
        }
    </style>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<div class="clouds">
    <div class="cloud cloud-1"><svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg"><path d="M30,60 Q10,60 10,45 Q10,30 25,28 Q22,10 40,10 Q52,10 58,20 Q65,8 80,8 Q100,8 105,25 Q118,20 130,28 Q145,25 150,38 Q160,38 160,50 Q160,62 148,62 Z"/></svg></div>
    <div class="cloud cloud-2"><svg viewBox="0 0 140 56" xmlns="http://www.w3.org/2000/svg"><path d="M20,42 Q6,42 6,30 Q6,18 18,17 Q15,4 30,4 Q40,4 45,12 Q52,3 65,3 Q82,3 86,17 Q96,14 104,22 Q114,20 116,30 Q122,30 122,40 Q122,48 112,48 Z"/></svg></div>
    <div class="cloud cloud-3"><svg viewBox="0 0 180 70" xmlns="http://www.w3.org/2000/svg"><path d="M28,54 Q8,54 8,40 Q8,26 22,24 Q18,8 36,8 Q48,8 54,18 Q62,6 78,6 Q100,6 104,22 Q116,18 126,26 Q140,22 144,36 Q154,36 154,48 Q154,58 142,60 Z"/></svg></div>
    <div class="cloud cloud-4"><svg viewBox="0 0 160 64" xmlns="http://www.w3.org/2000/svg"><path d="M24,50 Q6,50 6,36 Q6,22 20,20 Q16,6 34,6 Q46,6 52,16 Q58,4 74,4 Q96,4 100,20 Q110,16 120,24 Q132,20 136,34 Q146,34 146,44 Q146,56 134,56 Z"/></svg></div>
    <div class="cloud cloud-5"><svg viewBox="0 0 200 76" xmlns="http://www.w3.org/2000/svg"><path d="M32,58 Q10,58 10,44 Q10,30 24,28 Q20,10 40,10 Q54,10 60,20 Q68,8 84,8 Q108,8 112,26 Q122,22 134,30 Q148,26 152,40 Q164,40 164,52 Q164,62 150,64 Z"/></svg></div>
    <div class="cloud cloud-6"><svg viewBox="0 0 130 52" xmlns="http://www.w3.org/2000/svg"><path d="M18,40 Q4,40 4,28 Q4,16 16,15 Q12,2 28,2 Q38,2 44,10 Q50,2 62,2 Q80,2 84,16 Q94,12 100,20 Q110,18 112,28 Q118,28 118,38 Q118,46 108,46 Z"/></svg></div>
</div>

<div class="app-layout">
    <div class="sidebar-slot">
        <x-sidebar.ortu :siswa="$siswa" />
    </div>

    <div class="main-area">
        <div class="header">
            <div class="welcome">
                <h1><i class="ph-duotone ph-notepad"></i> Edit Data <span class="name">{{ $siswa->nama_lengkap ?? 'Siswa' }}</span></h1>
            </div>
            <a href="{{ route('orangtua.home') }}" class="btn-back">
                ← Kembali ke Home
            </a>
        </div>

        <div class="form-container">
            @if(session('success'))
                <div class="alert-success"><span><i class="ph-duotone ph-check-circle" style="color: #22c55e;"></i></span> {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error"><span><i class="ph-duotone ph-x-circle" style="color: #ef4444;"></i></span> {{ session('error') }}</div>
            @endif

            <div class="progress">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="progress-text">Bantu guru mengenal anak Anda lebih dekat</div>
            </div>

            <div class="info-box">
                <div class="icon"><i class="ph-duotone ph-lightbulb"></i></div>
                <div>
                    <strong>Kenapa data ini penting?</strong>
                    <p>Semua informasi yang Anda berikan akan sangat berguna bagi para guru Rainbow Edu untuk menentukan metode pendekatan dan materi belajar yang paling sesuai dan nyaman untuk anak Anda.</p>
                </div>
            </div>

            <form action="{{ route('ortu.store.form') }}" method="POST">
                @csrf
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                <!-- CARD 1: Info Dasar -->
                <div class="form-section">
                    <div class="card-top-stripe stripe-blue"></div>
                    <div class="card-header">
                        <div class="card-icon icon-blue"><i class="ph-duotone ph-user"></i></div>
                        <div class="card-title">
                            <h2>Informasi Dasar & Pendaftaran</h2>
                            <p>Data umum mengenai pendidikan anak sejauh ini</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="usia_anak">Usia Anak <span class="required">*</span></label>
                                <input type="number" id="usia_anak" name="usia_anak" 
                                       placeholder="Cth: 5" min="1" max="18"
                                       value="{{ old('usia_anak', $questionnaire->usia_anak ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sekolah_sebelumnya">Sekolah Sebelumnya</label>
                                <input type="text" id="sekolah_sebelumnya" name="sekolah_sebelumnya" 
                                       placeholder="Cth: TK Harapan Bangsa" 
                                       value="{{ old('sekolah_sebelumnya', $questionnaire->sekolah_sebelumnya ?? '') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tujuan_pendaftaran">Tujuan / Ekspektasi Bergabung di Rainbow Edu</label>
                            <span class="hint">Apa yang Bapak/Ibu harapkan agar dicapai oleh anak setelah belajar di sini?</span>
                            <textarea id="tujuan_pendaftaran" name="tujuan_pendaftaran" rows="3" 
                                      placeholder="Cth: Ingin anak lebih siap masuk SD dan lancar membaca...">{{ old('tujuan_pendaftaran', $questionnaire->tujuan_pendaftaran ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Profil Karakter -->
                <div class="form-section">
                    <div class="card-top-stripe stripe-amber"></div>
                    <div class="card-header">
                        <div class="card-icon icon-amber"><i class="ph-duotone ph-star" style="color: #eab308;"></i></div>
                        <div class="card-title">
                            <h2>Karakter & Minat</h2>
                            <p>Bantu kami mengetahui kebiasaan dan tingkat kemandirian anak</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tingkat Kemandirian Anak Saat Ini <span class="required">*</span></label>
                            <span class="hint">Pilih salah satu kondisi anak secara umum dalam kesehariannya</span>
                            
                            @php $kemandirian = old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? ''); @endphp
                            <div class="radio-chips">
                                <label class="chip-label">
                                    <input type="radio" name="tingkat_kemandirian" value="Mandiri" {{ $kemandirian == 'Mandiri' ? 'checked' : '' }} required>
                                    <div class="chip-box"><i class="ph-fill ph-circle" style="color: #22c55e;"></i> Mandiri (Aman)</div>
                                </label>
                                <label class="chip-label">
                                    <input type="radio" name="tingkat_kemandirian" value="Butuh Bantuan" {{ $kemandirian == 'Butuh Bantuan' ? 'checked' : '' }} required>
                                    <div class="chip-box"><i class="ph-fill ph-circle" style="color: #eab308;"></i> Butuh Sesekali Dibantu</div>
                                </label>
                                <label class="chip-label">
                                    <input type="radio" name="tingkat_kemandirian" value="Sangat Butuh Bantuan" {{ $kemandirian == 'Sangat Butuh Bantuan' ? 'checked' : '' }} required>
                                    <div class="chip-box"><i class="ph-fill ph-circle" style="color: #ef4444;"></i> Perlu Pendampingan Penuh</div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="minat_bakat">Minat, Hobi, & Hal yang Disukai</label>
                            <span class="hint">Misalnya: Anak sangat suka mainan mobil-mobilan, puzzle, mewarnai, dll.</span>
                            <textarea id="minat_bakat" name="minat_bakat" rows="2" 
                                      placeholder="Bercerita singkat tentang minat mereka agar guru bisa menggunakan pendekatan yang relavan...">{{ old('minat_bakat', $questionnaire->minat_bakat ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: Kesehatan & Tambahan -->
                <div class="form-section">
                    <div class="card-top-stripe stripe-green"></div>
                    <div class="card-header">
                        <div class="card-icon icon-green"><i class="ph-duotone ph-stethoscope"></i></div>
                        <div class="card-title">
                            <h2>Kesehatan & Fokus Spesifik</h2>
                            <p>Informasikan jika ada hal-hal krusial mengenai kesehatan anak</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="catatan_kesehatan">Kondisi Kesehatan / Alergi Tertentu</label>
                            <span class="hint">Penting jika pembelajaran dilakukan tatap muka secara langsung</span>
                            <textarea id="catatan_kesehatan" name="catatan_kesehatan" rows="2" 
                                      placeholder="Kosongkan jika tidak ada, atau sampaikan alergi/kondisi kesehatan spesifik (Cth: Alergi cokelat, asma, dsb)">{{ old('catatan_kesehatan', $questionnaire->catatan_kesehatan ?? '') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="ekspektasi_ortu">Fokus Belajar / Catatan Bebas Lainnya</label>
                            <textarea id="ekspektasi_ortu" name="ekspektasi_ortu" rows="2" 
                                      placeholder="Ada pesan khusus lainnya untuk guru?">{{ old('ekspektasi_ortu', $questionnaire->ekspektasi_ortu ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bottom-action">
                    <a href="{{ route('orangtua.home') }}" class="btn-secondary">Isi Nanti Saja</a>
                    <button type="submit" class="btn-primary">
                        <i class="ph-duotone ph-floppy-disk"></i> Simpan & Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>