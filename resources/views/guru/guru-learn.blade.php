<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru Learn - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
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
            flex-wrap: wrap;
        }

        .badge {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
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
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
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
            color: #e53e3e;
            border: 2px solid #e53e3e;
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
            background: #e53e3e;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(229, 62, 62, 0.3);
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
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
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

        /* Course Card */
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

        /* Course Grid */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .course-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(56, 161, 105, 0.15);
            border-color: #38a169;
        }

        .course-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .course-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .course-info {
            flex: 1;
        }

        .course-name {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .course-level {
            display: inline-block;
            padding: 4px 12px;
            background: #e6fffa;
            color: #234e52;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .course-detail {
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

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .btn-action {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
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
            box-shadow: 0 10px 20px rgba(56, 161, 105, 0.3);
        }

        .btn-chat {
            background: #38a169 !important;
        }

        .btn-chat:hover {
            background: #2f855a !important;
            box-shadow: 0 10px 20px rgba(56, 161, 105, 0.3) !important;
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
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
            font-weight: 600;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(56, 161, 105, 0.3);
        }

        .profile-name {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .profile-role {
            color: #38a169;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 6px 16px;
            background: #f0fff4;
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
            background: #f0fff4;
            padding: 8px 12px;
            border-radius: 12px;
            color: #38a169;
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

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .action-buttons .btn-action {
            flex: 1;
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

            .course-grid {
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
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2f855a 0%, #38a169 100%);
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
                        <span>📚</span> Guru Learn - Rainbow Course
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

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">📖</div>
                <div class="stat-info">
                    <h3>Siswa Aktif</h3>
                    <div class="number">{{ $siswaAktif ?? $siswaList->where('status_assign', 'active')->count() ?? 0 }}</div>
                    <div class="sub">Sedang belajar</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">⏳</div>
                <div class="stat-info">
                    <h3>Menunggu</h3>
                    <div class="number">{{ $siswaPending ?? $siswaList->where('status_assign', 'pending')->count() ?? 0 }}</div>
                    <div class="sub">Konfirmasi jadwal</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <h3>Selesai</h3>
                    <div class="number">{{ $siswaCompleted ?? 0 }}</div>
                    <div class="sub">Program selesai</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Daftar Course -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <span>📚</span> Daftar Siswa Rainbow Course
                    </h2>
                    <span style="color: #38a169; font-weight: 600; background: #f0fff4; padding: 8px 16px; border-radius: 50px; font-size: 14px;">
                        {{ $siswaList->count() ?? 0 }} Siswa
                    </span>
                </div>

                @if(isset($siswaList) && $siswaList->count() > 0)
                    <div class="course-grid">
                        @foreach($siswaList as $siswa)
                        <div class="course-card">
                            <div class="course-header">
                                <div class="course-icon">
                                    {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                                </div>
                                <div class="course-info">
                                    <div class="course-name">{{ $siswa->nama_lengkap }}</div>
                                    <span class="course-level">{{ $siswa->nama_panggilan ?? 'Siswa' }}</span>
                                </div>
                            </div>
                            
                            <div class="course-detail">
                                <div class="detail-row">
                                    <span>👤</span> Orang Tua: {{ $siswa->orangTua->name ?? '-' }}
                                </div>
                                <div class="detail-row">
                                    <span>📱</span> Kontak: {{ $siswa->orangTua->email ?? '-' }}
                                </div>
                                <div class="detail-row">
                                    <span>📊</span> Status: 
                                    @if($siswa->status_assign == 'active')
                                        <span style="color: #38a169; font-weight: 600;">Aktif</span>
                                    @else
                                        <span style="color: #e53e3e; font-weight: 600;">Pending</span>
                                    @endif
                                </div>
                                <div class="detail-row">
                                    <span>📈</span> Progress Belajar:
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 12px; color: #718096;">
                                    <span>Materi: 6/8</span>
                                    <span>75%</span>
                                </div>
                            </div>

                            <!-- Action Buttons - Updated sesuai permintaan -->
                            <div class="action-buttons">
                                <a href="{{ route('guru.jadwal.siswa', $siswa->id) }}" class="btn-action">
                                    <span>📅</span> Atur Jadwal
                                </a>
                                <a href="{{ route('chat.show', $siswa->id) }}" class="btn-action btn-chat">
                                    <span>💬</span> Chat
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">📚</div>
                        <div class="empty-title">Belum Ada Siswa Kursus</div>
                        <div class="empty-desc">
                            Siswa yang mendaftar Rainbow Course akan muncul di sini.<br>
                            Saat ini belum ada siswa yang terdaftar.
                        </div>
                        <div style="color: #38a169; font-size: 14px;">
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
                    <div class="profile-role">📚 Guru Learn</div>
                    
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="value">{{ $totalSiswa ?? 0 }}</div>
                            <div class="label">Total Siswa</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $siswaAktif ?? $siswaList->where('status_assign', 'active')->count() ?? 0 }}</div>
                            <div class="label">Aktif</div>
                        </div>
                        <div class="profile-stat">
                            <div class="value">{{ $siswaPending ?? $siswaList->where('status_assign', 'pending')->count() ?? 0 }}</div>
                            <div class="label">Pending</div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Mengajar -->
                <div class="schedule-card">
                    <div class="schedule-header">
                        <h3>
                            <span>⏰</span> Jadwal Mengajar
                        </h3>
                        <span style="color: #38a169; font-size: 13px;">{{ now()->format('d M Y') }}</span>
                    </div>

                    @php
                        $hasSchedule = false;
                    @endphp

                    @if($hasSchedule)
                        <div class="schedule-item">
                            <div class="schedule-time">09:00</div>
                            <div class="schedule-info">
                                <div class="schedule-title">Matematika Dasar</div>
                                <div class="schedule-sub">Budi - Kelas 1</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-time">11:00</div>
                            <div class="schedule-info">
                                <div class="schedule-title">Bahasa Inggris</div>
                                <div class="schedule-sub">Ani - Kelas 2</div>
                            </div>
                        </div>
                    @else
                        <div style="text-align: center; padding: 30px 0;">
                            <div style="font-size: 40px; margin-bottom: 15px;">📆</div>
                            <div style="color: #718096; margin-bottom: 10px;">Tidak ada jadwal mengajar hari ini</div>
                            <div style="font-size: 13px; color: #a0aec0;">Gunakan fitur "Atur Jadwal" untuk membuat jadwal belajar</div>
                        </div>
                    @endif

                    <a href="#" style="display: block; text-align: center; margin-top: 20px; padding-top: 20px; border-top: 2px solid #f0f0f0; color: #38a169; text-decoration: none; font-weight: 600; font-size: 14px;">
                        Lihat Semua Jadwal →
                    </a>
                </div>

                <!-- Catatan Penting -->
                <div class="schedule-card" style="background: linear-gradient(135deg, #38a169 0%, #2f855a 100%); color: white;">
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
        // Any additional JavaScript functionality can go here
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>