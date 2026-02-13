<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru Home Learning - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
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
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
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
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
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
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
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

        /* Private Student Grid */
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

        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .student-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .student-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(128, 90, 213, 0.15);
            border-color: #805ad5;
        }

        .student-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .student-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .student-info {
            flex: 1;
        }

        .student-name {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .student-address {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #718096;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .student-detail {
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

        .schedule-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #faf5ff;
            color: #6b46c1;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-action {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
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
            box-shadow: 0 10px 20px rgba(128, 90, 213, 0.3);
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            background: white;
            color: #805ad5;
            border: 2px solid #805ad5;
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

        .btn-secondary:hover {
            background: #805ad5;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(128, 90, 213, 0.3);
        }

        .btn-chat {
            border-color: #38a169;
            color: #38a169;
        }

        .btn-chat:hover {
            background: #38a169;
            border-color: #38a169;
            color: white;
            box-shadow: 0 10px 20px rgba(56, 161, 105, 0.3);
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .action-buttons .btn-action,
        .action-buttons .btn-secondary {
            flex: 1;
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
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
            font-weight: 600;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(128, 90, 213, 0.3);
        }

        .profile-name {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 6px;
        }

        .profile-role {
            color: #805ad5;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 6px 16px;
            background: #faf5ff;
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

        /* Today Schedule */
        .today-schedule {
            background: white;
            border-radius: 24px;
            padding: 30px;
        }

        .today-schedule h3 {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #faf5ff;
            border-radius: 16px;
            margin-bottom: 12px;
        }

        .schedule-time {
            background: white;
            padding: 8px 12px;
            border-radius: 12px;
            color: #805ad5;
            font-weight: 700;
            font-size: 14px;
            min-width: 80px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .schedule-location {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #718096;
            font-size: 12px;
            margin-top: 4px;
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

            .student-grid {
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
            background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #6b46c1 0%, #805ad5 100%);
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
                        <span>🏠</span> Guru Home Learning - Private Course
                    </span>
                    <span style="color: #718096;">| {{ now()->format('l, d F Y') }}</span>
                </p>
            </div>
            
            <div class="stats-wrapper">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalSiswa ?? 0 }}</div>
                    <div class="stat-label">
                        <span>🏠</span> Total Siswa Private
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
                <div class="stat-icon">🏠</div>
                <div class="stat-info">
                    <h3>Siswa Home Learning</h3>
                    <div class="number">{{ $siswaHomelearning ?? $siswaList->count() ?? 0 }}</div>
                    <div class="sub">Private di rumah</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">📍</div>
                <div class="stat-info">
                    <h3>Lokasi Mengajar</h3>
                    <div class="number">{{ $lokasiMengajar ?? $siswaList->count() ?? 0 }}</div>
                    <div class="sub">Alamat berbeda</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">⏰</div>
                <div class="stat-info">
                    <h3>Jam Mengajar</h3>
                    <div class="number">{{ $totalJam ?? '0' }}</div>
                    <div class="sub">Jam/minggu</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Daftar Siswa Private -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <span>🏠</span> Daftar Siswa Home Learning
                    </h2>
                    <div style="display: flex; gap: 10px;">
                        <span class="schedule-badge">
                            {{ $siswaList->where('status_assign', 'active')->count() ?? 0 }} Aktif
                        </span>
                        <span class="schedule-badge" style="background: #fed7d7; color: #742a2a;">
                            {{ $siswaList->where('status_assign', 'pending')->count() ?? 0 }} Pending
                        </span>
                    </div>
                </div>

                @if(isset($siswaList) && $siswaList->count() > 0)
                    <div class="student-grid">
                        @foreach($siswaList as $siswa)
                        <div class="student-card">
                            <div class="student-header">
                                <div class="student-avatar">
                                    {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                                </div>
                                <div class="student-info">
                                    <div class="student-name">{{ $siswa->nama_lengkap }}</div>
                                    <div class="student-address">
                                        <span>📍</span> {{ $siswa->alamat_domisili ?? 'Alamat belum diisi' }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="student-detail">
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
                                    <span>📅</span> Jadwal: 
                                    <span style="color: #805ad5; font-weight: 600;">Belum diatur</span>
                                </div>
                                @if($siswa->questionnaire && $siswa->questionnaire->tingkat_kemandirian)
                                <div class="detail-row">
                                    <span>🎯</span> Kemandirian: {{ $siswa->questionnaire->tingkat_kemandirian }}
                                </div>
                                @endif
                            </div>

                            <!-- Action Buttons - Updated sesuai permintaan -->
                            <div class="action-buttons">
                                <a href="{{ route('guru.jadwal.siswa', $siswa->id) }}" class="btn-action">
                                    <span>📅</span> Atur Jadwal Kunjungan
                                </a>
                                <a href="{{ route('chat.show', $siswa->id) }}" class="btn-secondary btn-chat">
                                    <span>💬</span> Chat
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">🏠</div>
                        <div class="empty-title">Belum Ada Siswa Private</div>
                        <div class="empty-desc">
                            Siswa yang mendaftar Rainbow Home Learning akan muncul di sini.<br>
                            Saat ini belum ada siswa yang terdaftar.
                        </div>
                        <div style="color: #805ad5; font-size: 14px;">
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
                    <div class="profile-role">🏠 Guru Home Learning</div>
                    
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

                <!-- Jadwal Kunjungan Hari Ini -->
                <div class="today-schedule">
                    <div class="schedule-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3>
                            <span>📅</span> Jadwal Kunjungan Hari Ini
                        </h3>
                        <span style="color: #805ad5; font-size: 13px;">{{ now()->format('d M Y') }}</span>
                    </div>

                    @php
                        $hasSchedule = false;
                    @endphp

                    @if($hasSchedule)
                        <div class="schedule-item">
                            <div class="schedule-time">09:00</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2d3748;">Budi Santoso</div>
                                <div class="schedule-location">
                                    <span>📍</span> Jl. Merdeka No. 45
                                </div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-time">13:00</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2d3748;">Ani Wijaya</div>
                                <div class="schedule-location">
                                    <span>📍</span> Jl. Sudirman No. 12
                                </div>
                            </div>
                        </div>
                    @else
                        <div style="text-align: center; padding: 30px 0;">
                            <div style="font-size: 48px; margin-bottom: 15px;">🗓️</div>
                            <div style="color: #718096; margin-bottom: 10px;">Tidak ada jadwal kunjungan hari ini</div>
                            <div style="font-size: 13px; color: #a0aec0;">Gunakan fitur "Atur Jadwal" untuk membuat jadwal</div>
                        </div>
                    @endif

                    <a href="#" style="display: block; text-align: center; margin-top: 20px; padding: 12px; background: #faf5ff; color: #805ad5; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 14px;">
                        Kelola Semua Jadwal →
                    </a>
                </div>

                <!-- Rute Perjalanan -->
                <div class="today-schedule" style="background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%); color: white;">
                    <h3 style="color: white; margin-bottom: 20px;">
                        <span>🗺️</span> Rute Perjalanan
                    </h3>
                    
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                            <div style="width: 30px; height: 30px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                1
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600;">Titik Mulai</div>
                                <div style="font-size: 12px; opacity: 0.9;">Cabang Rainbow Edu</div>
                            </div>
                        </div>
                        
                        <div style="width: 2px; height: 30px; background: rgba(255,255,255,0.3); margin-left: 14px;"></div>
                        
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 30px; height: 30px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                2
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600;">Siswa 1</div>
                                <div style="font-size: 12px; opacity: 0.9;">Belum ada jadwal</div>
                            </div>
                        </div>
                    </div>
                    
                    <p style="font-size: 13px; opacity: 0.9; text-align: center;">
                        Atur jadwal untuk melihat rute perjalanan optimal
                    </p>
                </div>

                <!-- Catatan Penting -->
                <div class="today-schedule" style="background: white;">
                    <h3 style="color: #2d3748; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <span>📌</span> Catatan Penting
                    </h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 15px; display: flex; gap: 10px; color: #4a5568; font-size: 14px;">
                            <span>•</span>
                            <span>Konfirmasi jadwal kunjungan H-1 dengan orang tua</span>
                        </li>
                        <li style="margin-bottom: 15px; display: flex; gap: 10px; color: #4a5568; font-size: 14px;">
                            <span>•</span>
                            <span>Pastikan alamat dan rute perjalanan sudah dicek</span>
                        </li>
                        <li style="display: flex; gap: 10px; color: #4a5568; font-size: 14px;">
                            <span>•</span>
                            <span>Laporkan progress belajar setiap sesi selesai</span>
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