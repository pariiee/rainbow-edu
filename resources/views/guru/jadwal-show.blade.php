<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jadwal - Rainbow Edu</title>
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
            max-width: 900px;
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

        .btn-primary {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-success {
            background: #38a169;
        }

        .btn-danger {
            background: #e53e3e;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .status-pending {
            background: #fed7d7;
            color: #742a2a;
        }

        .status-approved {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-completed {
            background: #e2e8f0;
            color: #2d3748;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-section {
            background: #f8fafc;
            border-radius: 20px;
            padding: 25px;
        }

        .info-section h3 {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .info-label {
            width: 120px;
            color: #718096;
            font-size: 14px;
        }

        .info-value {
            flex: 1;
            color: #2d3748;
            font-weight: 500;
        }

        .detail-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 25px;
            margin-top: 30px;
        }

        .detail-card h3 {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feedback-box {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-top: 15px;
            border: 1px solid #e2e8f0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        select, textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        select:focus, textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .info-row {
                flex-direction: column;
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
                    <span>📅</span> Detail Jadwal
                </h1>
                <a href="{{ route('guru.jadwal.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @php
                $statusClass = '';
                $statusText = '';
                switch($jadwal->status) {
                    case 'pending':
                        $statusClass = 'status-pending';
                        $statusText = '⏳ Menunggu Persetujuan Orang Tua';
                        break;
                    case 'disetujui':
                        $statusClass = 'status-approved';
                        $statusText = '✅ Disetujui';
                        break;
                    case 'selesai':
                        $statusClass = 'status-completed';
                        $statusText = '🎉 Selesai';
                        break;
                    case 'dibatalkan':
                        $statusClass = 'status-pending';
                        $statusText = '❌ Dibatalkan';
                        break;
                }
            @endphp

            <div class="status-badge {{ $statusClass }}">
                {{ $statusText }}
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <h3>
                        <span>👤</span> Data Siswa
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $jadwal->siswa->nama_lengkap }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nama Panggilan</span>
                        <span class="info-value">{{ $jadwal->siswa->nama_panggilan ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Layanan</span>
                        <span class="info-value">
                            <span style="background: #667eea20; color: #667eea; padding: 4px 12px; border-radius: 50px; font-size: 13px; font-weight: 600;">
                                {{ $jadwal->siswa->layanan }}
                            </span>
                        </span>
                    </div>
                </div>

                <div class="info-section">
                    <h3>
                        <span>👪</span> Data Orang Tua
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $jadwal->orangTua->name ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $jadwal->orangTua->email ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nama Anak</span>
                        <span class="info-value">{{ $jadwal->orangTua->nama_anak ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <h3>
                    <span>📋</span> Detail Jadwal
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 25px;">
                    <div>
                        <div style="color: #718096; font-size: 13px; margin-bottom: 5px;">Tanggal</div>
                        <div style="font-size: 24px; font-weight: 700; color: #2d3748;">
                            {{ $jadwal->tanggal->format('d') }}
                            <span style="font-size: 16px; font-weight: 400; color: #718096;">
                                {{ $jadwal->tanggal->format('F Y') }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div style="color: #718096; font-size: 13px; margin-bottom: 5px;">Waktu</div>
                        <div style="font-size: 24px; font-weight: 700; color: #2d3748;">
                            {{ $jadwal->waktu->format('H:i') }} WIB
                            <span style="font-size: 16px; font-weight: 400; color: #718096;">
                                ({{ $jadwal->durasi }} menit)
                            </span>
                        </div>
                    </div>
                </div>

                @if($jadwal->catatan)
                <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e2e8f0;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <span style="font-size: 20px;">📝</span>
                        <span style="font-weight: 600; color: #2d3748;">Catatan Guru:</span>
                    </div>
                    <div style="background: white; padding: 20px; border-radius: 16px; color: #4a5568; line-height: 1.6;">
                        {{ $jadwal->catatan }}
                    </div>
                </div>
                @endif

                @if($jadwal->feedback_ortu)
                <div style="margin-top: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <span style="font-size: 20px;">💬</span>
                        <span style="font-weight: 600; color: #2d3748;">Feedback Orang Tua:</span>
                    </div>
                    <div style="background: #ebf8ff; padding: 20px; border-radius: 16px; color: #2c5282; border-left: 4px solid #4299e1;">
                        {{ $jadwal->feedback_ortu }}
                    </div>
                </div>
                @endif

                @if($jadwal->status == 'disetujui' && auth()->id() == $jadwal->guru_id)
                <div style="margin-top: 30px;">
                    <form action="{{ route('guru.jadwal.status', $jadwal->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="selesai">
                        
                        <div class="form-group">
                            <label for="feedback">Feedback setelah mengajar</label>
                            <textarea name="feedback" id="feedback" rows="4" 
                                      placeholder="Tulis catatan atau feedback tentang proses belajar hari ini..." 
                                      required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary btn-success">
                            ✅ Selesaikan Jadwal & Kirim Feedback
                        </button>
                    </form>
                </div>
                @endif

                @if($jadwal->status == 'pending' && auth()->id() == $jadwal->guru_id)
                <div style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #e2e8f0;">
                    <form action="{{ route('guru.jadwal.destroy', $jadwal->id) }}" method="POST" 
                          onsubmit="return confirm('Batalkan jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-primary btn-danger">
                            ❌ Batalkan Jadwal
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px;">
                <a href="{{ route('chat.show', $jadwal->siswa_id) }}" class="btn-primary">
                    💬 Chat dengan Orang Tua
                </a>
                <a href="{{ route('guru.jadwal.index') }}" class="btn-primary" style="background: #718096;">
                    📋 Lihat Semua Jadwal
                </a>
            </div>
        </div>
    </div>
</body>
</html>