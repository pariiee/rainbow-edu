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
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
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
            border-radius: 16px;
            padding: 20px;
        }

        .info-section h3 {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
        }

        .info-label {
            width: 100px;
            color: #718096;
            font-size: 14px;
        }

        .info-value {
            flex: 1;
            color: #2d3748;
            font-weight: 500;
        }

        .feedback-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #e2e8f0;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .btn-approve {
            flex: 1;
            padding: 14px;
            background: #38a169;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-reject {
            flex: 1;
            padding: 14px;
            background: #e53e3e;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-chat {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
        }

        @media (max-width: 640px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-group {
                flex-direction: column;
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
                <a href="{{ route('ortu.jadwal.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @php
                $statusClass = '';
                $statusText = '';
                switch($jadwal->status) {
                    case 'pending':
                        $statusClass = 'status-pending';
                        $statusText = '⏳ Menunggu Persetujuan';
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
            @endif

            <div class="status-badge {{ $statusClass }}">
                {{ $statusText }}
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <h3>
                        <span>👤</span> Data Siswa
                    </h3>
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
                        <span class="info-value">{{ $jadwal->siswa->layanan }}</span>
                    </div>
                </div>

                <div class="info-section">
                    <h3>
                        <span>🧑‍🏫</span> Data Guru
                    </h3>
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

            <div class="info-section">
                <h3>
                    <span>📋</span> Detail Jadwal
                </h3>
                <div class="info-row">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ $jadwal->tanggal->format('d F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Waktu</span>
                    <span class="info-value">{{ $jadwal->waktu->format('H:i') }} WIB</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Durasi</span>
                    <span class="info-value">{{ $jadwal->durasi }} Menit</span>
                </div>
                @if($jadwal->catatan)
                <div class="feedback-box">
                    <div style="font-weight: 600; margin-bottom: 8px; color: #4a5568;">
                        📝 Catatan Guru:
                    </div>
                    <p style="color: #2d3748;">{{ $jadwal->catatan }}</p>
                </div>
                @endif
            </div>

            @if($jadwal->feedback_ortu)
            <div class="feedback-box">
                <div style="font-weight: 600; margin-bottom: 8px; color: #4a5568;">
                    💬 Feedback Orang Tua:
                </div>
                <p style="color: #2d3748;">{{ $jadwal->feedback_ortu }}</p>
            </div>
            @endif

            @if($jadwal->feedback_guru)
            <div class="feedback-box">
                <div style="font-weight: 600; margin-bottom: 8px; color: #4a5568;">
                    💬 Feedback Guru:
                </div>
                <p style="color: #2d3748;">{{ $jadwal->feedback_guru }}</p>
            </div>
            @endif

            @if($jadwal->status == 'pending')
            <div style="margin-top: 30px;">
                <form action="{{ route('ortu.jadwal.approve', $jadwal->id) }}" method="POST" style="display: inline-block; width: 100%;">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                            Feedback (opsional)
                        </label>
                        <textarea name="feedback" rows="3" 
                                  style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: 12px;"
                                  placeholder="Tulis pesan atau konfirmasi untuk guru..."></textarea>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn-approve">
                            ✅ Setujui Jadwal
                        </button>
                        <button type="button" class="btn-reject" onclick="showRejectForm()">
                            ❌ Tolak Jadwal
                        </button>
                    </div>
                </form>

                <form id="rejectForm" action="{{ route('ortu.jadwal.reject', $jadwal->id) }}" method="POST" style="display: none; margin-top: 20px;">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                            Alasan Penolakan <span style="color: #e53e3e;">*</span>
                        </label>
                        <textarea name="alasan" rows="3" required
                                  style="width: 100%; padding: 14px; border: 2px solid #e53e3e; border-radius: 12px;"
                                  placeholder="Tulis alasan mengapa jadwal ini ditolak..."></textarea>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn-reject">
                            ✅ Konfirmasi Penolakan
                        </button>
                        <button type="button" class="btn-back" onclick="hideRejectForm()" style="background: #f0f0f0; color: #666;">
                            Batal
                        </button>
                    </div>
                </form>
            </div>

            <script>
                function showRejectForm() {
                    document.querySelector('form[action*="approve"]').style.display = 'none';
                    document.getElementById('rejectForm').style.display = 'block';
                }
                
                function hideRejectForm() {
                    document.querySelector('form[action*="approve"]').style.display = 'block';
                    document.getElementById('rejectForm').style.display = 'none';
                }
            </script>
            @endif

            <div style="margin-top: 30px; text-align: center;">
                <a href="{{ route('chat.show', $jadwal->siswa_id) }}" class="btn-chat">
                    💬 Chat dengan {{ $jadwal->guru->name }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>