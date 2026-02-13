<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f7fafc;
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            min-height: 100vh;
            padding: 30px;
            position: fixed;
            color: white;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 8px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px 30px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
        }

        .stat-info h3 {
            font-size: 16px;
            color: #718096;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-info .number {
            font-size: 36px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .chart-container {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .chart-container h2 {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h3 {
            font-size: 18px;
            color: #2d3748;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px;
            color: #718096;
            font-weight: 500;
            font-size: 13px;
            border-bottom: 2px solid #edf2f7;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #c6f6d5;
            color: #22543d;
        }

        .badge-warning {
            background: #feebc8;
            color: #744210;
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 20px 10px;
            }
            
            .sidebar h2 span, .nav-item span:last-child {
                display: none;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>
                <span>🌈</span>
                <span>Admin Panel</span>
            </h2>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.guru.index') }}" class="nav-item">
                <span>🧑‍🏫</span>
                <span>Manajemen Guru</span>
            </a>
            <a href="{{ route('admin.users.ortu.index') }}" class="nav-item">
                <span>👪</span>
                <span>Manajemen Orang Tua</span>
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="nav-item">
                <span>👤</span>
                <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.broadcast.index') }}" class="nav-item">
                <span>📢</span>
                <span>Broadcast</span>
            </a>
            <a href="{{ route('admin.broadcast.stats') }}" class="nav-item">
                <span>📈</span>
                <span>Statistik</span>
            </a>
            
            <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1);">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: rgba(255,255,255,0.8); width: 100%; text-align: left; padding: 12px 16px; cursor: pointer; display: flex; align-items: center; gap: 12px;">
                        <span>🚪</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <span style="color: #718096;">{{ now()->format('l, d F Y') }}</span>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 40px; height: 40px; background: #667eea; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight: 600;">{{ auth()->user()->name }}</div>
                            <div style="font-size: 12px; color: #718096;">Administrator</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">🧑‍🏫</div>
                    <div class="stat-info">
                        <h3>Total Guru</h3>
                        <div class="number">{{ $totalGuru }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">👪</div>
                    <div class="stat-info">
                        <h3>Total Orang Tua</h3>
                        <div class="number">{{ $totalOrtu }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">👤</div>
                    <div class="stat-info">
                        <h3>Total Siswa</h3>
                        <div class="number">{{ $totalSiswa }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📅</div>
                    <div class="stat-info">
                        <h3>Jadwal Hari Ini</h3>
                        <div class="number">{{ $jadwalHariIni->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="grid-2">
                <!-- Chart Pendaftaran -->
                <div class="chart-container">
                    <h2>
                        <span>📈</span>
                        Pendaftaran 7 Hari Terakhir
                    </h2>
                    <canvas id="registrationChart" style="height: 250px;"></canvas>
                </div>

                <!-- Top Guru -->
                <div class="table-container">
                    <div class="table-header">
                        <h3>🏆 Top 5 Guru dengan Siswa Terbanyak</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Guru</th>
                                <th>Divisi</th>
                                <th>Jumlah Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topGuru as $guru)
                            <tr>
                                <td>{{ $guru->name }}</td>
                                <td>{{ $guru->guru_type ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $guru->assigned_siswa_count ?? 0 }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Jadwal Hari Ini -->
            <div class="table-container" style="margin-top: 25px;">
                <div class="table-header">
                    <h3>📋 Jadwal Belajar Hari Ini ({{ now()->format('d F Y') }})</h3>
                    <a href="#" style="color: #667eea; text-decoration: none; font-weight: 600;">Lihat Semua →</a>
                </div>
                
                @if($jadwalHariIni->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Siswa</th>
                            <th>Guru</th>
                            <th>Layanan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalHariIni as $jadwal)
                        <tr>
                            <td>{{ $jadwal->waktu->format('H:i') }}</td>
                            <td>{{ $jadwal->siswa->nama_lengkap }}</td>
                            <td>{{ $jadwal->guru->name }}</td>
                            <td>{{ $jadwal->siswa->layanan }}</td>
                            <td>
                                @if($jadwal->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($jadwal->status == 'disetujui')
                                    <span class="badge badge-success">Disetujui</span>
                                @else
                                    <span class="badge">{{ $jadwal->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div style="text-align: center; padding: 40px; color: #718096;">
                    <div style="font-size: 48px; margin-bottom: 15px;">📅</div>
                    <p>Tidak ada jadwal belajar hari ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Registration Chart
        const ctx = document.getElementById('registrationChart').getContext('2d');
        
        @php
            $dates = $registrations->pluck('date')->map(function($date) {
                return Carbon\Carbon::parse($date)->format('d/m');
            });
            $totals = $registrations->pluck('total');
        @endphp
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                    label: 'Jumlah Pendaftaran',
                    data: {!! json_encode($totals) !!},
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: '#edf2f7'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>