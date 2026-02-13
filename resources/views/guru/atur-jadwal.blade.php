<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Jadwal Belajar - Rainbow Edu</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back {
            padding: 10px 20px;
            background: #f0f0f0;
            color: #666;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .info-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            margin-bottom: 30px;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: center;
        }

        .info-label {
            width: 120px;
            opacity: 0.9;
            font-size: 14px;
        }

        .info-value {
            font-weight: 600;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 14px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .datetime-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .schedule-list {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .schedule-list h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f8fafc;
            border-radius: 14px;
            margin-bottom: 12px;
            border-left: 4px solid #667eea;
        }

        .schedule-date {
            min-width: 100px;
            font-weight: 600;
            color: #667eea;
        }

        .schedule-time {
            min-width: 80px;
            color: #666;
        }

        .schedule-notes {
            flex: 1;
            color: #333;
        }

        .btn-delete {
            padding: 8px 16px;
            background: #fee;
            color: #e53e3e;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #e53e3e;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #f8fafc;
            border-radius: 16px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
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

        @media (max-width: 640px) {
            .container {
                padding: 10px;
            }
            
            .card {
                padding: 25px;
            }
            
            .datetime-grid {
                grid-template-columns: 1fr;
            }
            
            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .info-label {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>
                    <span>📅</span> Atur Jadwal
                </h1>
                <a href="javascript:history.back()" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Info Siswa -->
            <div class="info-section">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 600;">
                        {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <h2 style="color: white; margin-bottom: 5px;">{{ $siswa->nama_lengkap }}</h2>
                        <p style="opacity: 0.9; font-size: 14px;">{{ $siswa->nama_panggilan ?? 'Siswa' }} • {{ $siswa->layanan }}</p>
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

            <!-- Form Atur Jadwal -->
            <form action="{{ route('guru.jadwal.store', $siswa->id) }}" method="POST">
                @csrf
                
                <div class="datetime-grid">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" 
                               value="{{ old('tanggal', now()->format('Y-m-d')) }}" 
                               min="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="waktu">Waktu</label>
                        <input type="time" id="waktu" name="waktu" 
                               value="{{ old('waktu', '09:00') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="durasi">Durasi (menit)</label>
                    <select id="durasi" name="durasi" required>
                        <option value="30">30 Menit</option>
                        <option value="45">45 Menit</option>
                        <option value="60" selected>60 Menit</option>
                        <option value="90">90 Menit</option>
                        <option value="120">120 Menit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan / Materi</label>
                    <textarea id="catatan" name="catatan" rows="3" 
                              placeholder="Contoh: Belajar membaca, matematika dasar, dll">{{ old('catatan') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    💾 Simpan Jadwal
                </button>
            </form>

            <!-- Daftar Jadwal yang Sudah Ada -->
            <div class="schedule-list">
                <h3>
                    <span>📋</span> Jadwal yang Telah Diatur
                </h3>

                @php
                    // SAMPLE DATA - Nanti diganti dengan query real
                    $jadwals = [];
                @endphp

                @if(count($jadwals) > 0)
                    @foreach($jadwals as $jadwal)
                        <div class="schedule-item">
                            <div class="schedule-date">{{ $jadwal['tanggal'] }}</div>
                            <div class="schedule-time">{{ $jadwal['waktu'] }}</div>
                            <div class="schedule-notes">{{ $jadwal['catatan'] }}</div>
                            <form action="{{ route('guru.jadwal.destroy', $jadwal['id']) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">📆</div>
                        <h4 style="margin-bottom: 8px; color: #333;">Belum Ada Jadwal</h4>
                        <p style="color: #666; font-size: 14px;">Atur jadwal belajar pertama untuk {{ $siswa->nama_lengkap }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Set minimal date ke hari ini
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