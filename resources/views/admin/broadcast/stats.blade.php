<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Broadcast - Rainbow Edu</title>
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

        .btn-back {
            padding: 12px 24px;
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
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
            font-size: 42px;
            font-weight: 700;
            color: #2d3748;
            line-height: 1;
            margin-bottom: 4px;
        }

        .chart-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .chart-container h2 {
            font-size: 20px;
            color: #2d3748;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .table-container h2 {
            font-size: 20px;
            color: #2d3748;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px 12px;
            color: #718096;
            font-weight: 600;
            font-size: 13px;
            border-bottom: 2px solid #edf2f7;
        }

        td {
            padding: 15px 12px;
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

        @media (max-width: 768px) {
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
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .table-container {
                overflow-x: auto;
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
            
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
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
            <a href="{{ route('admin.broadcast.index') }}" class="nav-item active">
                <span>📢</span>
                <span>Broadcast</span>
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
                <h1>Statistik Broadcast</h1>
                <a href="{{ route('admin.broadcast.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📢</div>
                    <div class="stat-info">
                        <h3>Total Broadcast</h3>
                        <div class="number">{{ $totalBroadcast }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📤</div>
                    <div class="stat-info">
                        <h3>Terkirim Hari Ini</h3>
                        <div class="number">{{ $sentToday }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">⏰</div>
                    <div class="stat-info">
                        <h3>Terjadwal</h3>
                        <div class="number">{{ $scheduled }}</div>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <h2>
                    <span>📊</span> Broadcast Terbanyak Dibaca
                </h2>
                
                @if($topRead->count() > 0)
                    <canvas id="readChart" style="height: 300px; width: 100%;"></canvas>
                @else
                    <div style="text-align: center; padding: 60px; color: #718096;">
                        <div style="font-size: 48px; margin-bottom: 15px;">📊</div>
                        <p>Belum ada data broadcast</p>
                    </div>
                @endif
            </div>

            <div class="table-container">
                <h2>
                    <span>🏆</span> Top 5 Broadcast Terbanyak Dibaca
                </h2>
                
                @if($topRead->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Broadcast</th>
                                <th>Target</th>
                                <th>Total Penerima</th>
                                <th>Dibaca</th>
                                <th>Dikirim</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topRead as $index => $broadcast)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div style="font-weight: 600;">{{ $broadcast->judul }}</div>
                                    <div style="font-size: 12px; color: #718096;">{{ Str::limit($broadcast->isi, 50) }}</div>
                                </td>
                                <td>
                                    @if($broadcast->target == 'semua')
                                        Semua
                                    @elseif($broadcast->target == 'guru')
                                        Guru
                                    @elseif($broadcast->target == 'orang_tua')
                                        Orang Tua
                                    @else
                                        Spesifik
                                    @endif
                                </td>
                                <td>{{ $broadcast->users_count ?? 0 }}</td>
                                <td>
                                    @php
                                        $readCount = $broadcast->users()->wherePivot('is_read', true)->count();
                                        $percentage = $broadcast->users_count > 0 ? round(($readCount / $broadcast->users_count) * 100) : 0;
                                    @endphp
                                    <span class="badge badge-success">{{ $readCount }} ({{ $percentage }}%)</span>
                                </td>
                                <td>{{ $broadcast->sent_at ? $broadcast->sent_at->format('d/m/Y') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="text-align: center; padding: 40px; color: #718096;">
                        <p>Belum ada data broadcast</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($topRead->count() > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('readChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach($topRead as $broadcast)
                            '{{ Str::limit($broadcast->judul, 20) }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah Pembaca',
                        data: [
                            @foreach($topRead as $broadcast)
                                {{ $broadcast->users()->wherePivot('is_read', true)->count() }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(102, 126, 234, 0.8)',
                            'rgba(56, 161, 105, 0.8)',
                            'rgba(237, 137, 54, 0.8)',
                            'rgba(229, 62, 62, 0.8)',
                            'rgba(128, 90, 213, 0.8)'
                        ],
                        borderColor: [
                            '#667eea',
                            '#38a169',
                            '#ed8936',
                            '#e53e3e',
                            '#805ad5'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e2e8f0'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
    @endif
</body>
</html>