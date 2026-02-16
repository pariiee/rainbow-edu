<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru PAUD - Rainbow Edu</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styles */
        .header {
            background: white;
            border-radius: 24px;
            padding: 30px 40px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome h1 {
            font-size: 32px;
            color: #2d3748;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .welcome p {
            color: #718096;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .stats-wrapper {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 30px;
            border-radius: 20px;
            color: white;
            min-width: 180px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .stat-number {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 4px;
            position: relative;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout {
            padding: 12px 28px;
            background: #fff;
            color: #ff4757;
            border: 2px solid #ff4757;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: #ff4757;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 71, 87, 0.3);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-item {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            animation: fadeIn 0.5s ease;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
        }

        .stat-info h3 {
            font-size: 14px;
            color: #718096;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .stat-info .number {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .stat-info .sub {
            font-size: 13px;
            color: #a0aec0;
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
            margin-bottom: 30px;
        }

        /* Daftar Siswa */
        .card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            animation: fadeIn 0.6s ease;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h2 {
            font-size: 20px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 12px;
            color: #4a5568;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .siswa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .siswa-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .siswa-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .siswa-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .siswa-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .siswa-info {
            flex: 1;
        }

        .siswa-name {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .siswa-nickname {
            color: #718096;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .siswa-detail {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            color: #4a5568;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-pending {
            background: #fed7d7;
            color: #742a2a;
        }

        .btn-action {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .profile-card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            text-align: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
            font-weight: 600;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .profile-name {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .profile-role {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 6px 16px;
            background: #ebf4ff;
            display: inline-block;
            border-radius: 50px;
            font-size: 13px;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .profile-stat {
            text-align: center;
        }

        .profile-stat .value {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .profile-stat .label {
            font-size: 12px;
            color: #718096;
        }

        /* Schedule Card */
        .schedule-card {
            background: white;
            border-radius: 24px;
            padding: 30px;
        }

        .schedule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .schedule-header h3 {
            font-size: 18px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .schedule-time {
            background: #ebf4ff;
            padding: 8px 12px;
            border-radius: 12px;
            color: #667eea;
            font-weight: 600;
            font-size: 13px;
            min-width: 80px;
            text-align: center;
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .schedule-sub {
            font-size: 12px;
            color: #718096;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .empty-desc {
            color: #718096;
            margin-bottom: 24px;
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .action-buttons .btn-action {
            flex: 1;
        }

        .btn-chat {
            background: #38a169;
        }

        .btn-chat:hover {
            background: #2f855a;
            box-shadow: 0 10px 20px rgba(56, 161, 105, 0.3);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                text-align: center;
                padding: 25px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .siswa-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="welcome">
                <h1>Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                <p>
                    <span class="badge">
                        <span>🎓</span> Guru PAUD Rainbow & Permata Montessori
                    </span>
                    <span style="color: #718096;">| {{ now()->format('l, d F Y') }}</span>
                </p>
            </div>
            
            <div class="stats-wrapper">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalSiswa ?? 0 }}</div>
                    <div class="stat-label">
                        <span>📚</span> Total Siswa Aktif
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <span>🚪</span> Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Stats Grid - UPDATED -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">👶</div>
                <div class="stat-info">
                    <h3>Total Siswa PAUD</h3>
                    <div class="number">{{ $totalSiswa ?? 0 }}</div>
                    <div class="sub">Semua program PAUD</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">📅</div>
                <div class="stat-info">
                    <h3>Jadwal Hari Ini</h3>
                    <div class="number">{{ $jadwalHariIni ?? 0 }}</div>
                    <div class="sub">Pertemuan terjadwal</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <h3>Siswa Aktif</h3>
                    <div class="number">{{ $siswaAktif ?? 0 }}</div>
                    <div class="sub">Status active</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">⏳</div>
                <div class="stat-info">
                    <h3>Menunggu</h3>
                    <div class="number">{{ $siswaPending ?? 0 }}</div>
                    <div class="sub">Perlu direspon</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Daftar Siswa -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <span>📋</span> Daftar Siswa PAUD
                    </h2>
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
                                    <div class="siswa-nickname">
                                        <span>👤</span> {{ $siswa->nama_panggilan ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="siswa-detail">
                                <div class="detail-row">
                                    <span>📱</span> Orang Tua: {{ $siswa->orangTua->name ?? '-' }}
                                </div>
                                <div class="detail-row">
                                    <span>🎯</span> Layanan: 
                                    <span style="color: #667eea; font-weight: 500;">
                                        @if(isset($siswa->layanan) && $siswa->layanan == 'PAUD')
                                            PAUD
                                        @else
                                            {{ $siswa->layanan ?? 'PAUD' }}
                                        @endif
                                    </span>
                                </div>
                                <div class="detail-row">
                                    <span>📊</span> Status: 
                                    @if(isset($siswa->status_assign) && $siswa->status_assign == 'active')
                                        <span class="status-badge status-active">✅ Aktif</span>
                                    @else
                                        <span class="status-badge status-pending">⏳ Pending</span>
                                    @endif
                                </div>
                                @if(isset($siswa->questionnaire) && $siswa->questionnaire && !$siswa->questionnaire->is_skipped)
                                <div class="detail-row">
                                    <span>📝</span> Questionnaire: 
                                    <span style="color: #38a169;">✓ Terisi</span>
                                </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{ route('guru.jadwal.siswa', $siswa->id) }}" class="btn-action">
                                    📅 Atur Jadwal
                                </a>
                                <a href="{{ route('chat.show', $siswa->id) }}" class="btn-action btn-chat">
                                    💬 Chat
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">👋</div>
                        <div class="empty-title">Belum Ada Siswa</div>
                        <div class="empty-desc">
                            Siswa yang mendaftar layanan PAUD akan muncul di sini.<br>
                            Saat ini belum ada siswa yang terdaftar.
                        </div>
                        <div style="color: #667eea; font-size: 14px;">
                            <span>⏳</span> Menunggu pendaftaran baru...
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Profile Card -->
                <div class="profile-card">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-role">🎓 Guru PAUD</div>
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="value">{{ $totalSiswa ?? 0 }}</div>
                            <div class="label">Total Siswa</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $siswaAktif ?? 0 }}</div>
                            <div class="label">Aktif</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $siswaPending ?? 0 }}</div>
                            <div class="label">Pending</div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Hari Ini -->
                <div class="schedule-card">
                    <div class="schedule-header">
                        <h3>
                            <span>📅</span> Jadwal Hari Ini
                        </h3>
                        <span style="color: #667eea; font-size: 13px;">{{ now()->format('d M Y') }}</span>
                    </div>

                    @php
                        $hasSchedule = false;
                    @endphp

                    @if($hasSchedule)
                        <div class="schedule-item">
                            <div class="schedule-time">08:00</div>
                            <div class="schedule-info">
                                <div class="schedule-title">Bermain Sambil Belajar</div>
                                <div class="schedule-sub">Budi - PAUD</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-time">10:00</div>
                            <div class="schedule-info">
                                <div class="schedule-title">Sensory Play</div>
                                <div class="schedule-sub">Ani - PAUD</div>
                            </div>
                        </div>
                    @else
                        <div style="text-align: center; padding: 30px 0;">
                            <div style="font-size: 40px; margin-bottom: 15px;">📆</div>
                            <div style="color: #718096; margin-bottom: 10px;">Tidak ada jadwal hari ini</div>
                            <div style="font-size: 13px; color: #a0aec0;">Gunakan fitur "Atur Jadwal" untuk membuat jadwal belajar</div>
                        </div>
                    @endif

                    <a href="#" style="display: block; text-align: center; margin-top: 20px; padding-top: 20px; border-top: 2px solid #f0f0f0; color: #667eea; text-decoration: none; font-weight: 600; font-size: 14px;">
                        Lihat Semua Jadwal →
                    </a>
                </div>

                <!-- Catatan Penting -->
                <div class="schedule-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h3 style="color: white; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <span>📌</span> Catatan Penting
                    </h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 15px; display: flex; gap: 10px;">
                            <span>•</span>
                            <span style="font-size: 14px;">Lakukan absensi siswa setiap kali selesai sesi belajar</span>
                        </li>
                        <li style="margin-bottom: 15px; display: flex; gap: 10px;">
                            <span>•</span>
                            <span style="font-size: 14px;">Update progress belajar minimal 1x seminggu</span>
                        </li>
                        <li style="display: flex; gap: 10px;">
                            <span>•</span>
                            <span style="font-size: 14px;">Konfirmasi jadwal dengan orang tua H-1</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterSiswa(status) {
            const cards = document.querySelectorAll('.siswa-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            cards.forEach(card => {
                if (status === 'all') {
                    card.style.display = 'block';
                } else {
                    const cardStatus = card.dataset.status;
                    if (cardStatus === status) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }

        // Mobile menu handling if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Add any additional JavaScript functionality here
        });
    </script>
</body>
</html>