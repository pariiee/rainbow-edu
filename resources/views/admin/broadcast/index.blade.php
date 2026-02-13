<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broadcast - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        .btn-stats {
            padding: 12px 24px;
            background: #38a169;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
        }

        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filter-form {
            display: flex;
            gap: 20px;
            align-items: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #4a5568;
        }

        .form-control {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-filter {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            height: 46px;
        }

        .btn-reset {
            padding: 12px 24px;
            background: #718096;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 46px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
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
            margin-bottom: 5px;
            font-weight: 500;
        }

        .stat-info .number {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
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
            display: inline-block;
        }

        .badge-success {
            background: #c6f6d5;
            color: #22543d;
        }

        .badge-warning {
            background: #feebc8;
            color: #744210;
        }

        .badge-info {
            background: #e2e8f0;
            color: #2d3748;
        }

        .badge-primary {
            background: #bee3f8;
            color: #2c5282;
        }

        .btn-action {
            padding: 6px 12px;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin: 0 2px;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-send {
            background: #38a169;
            color: white;
        }

        .btn-delete {
            background: #e53e3e;
            color: white;
        }

        .pagination {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }

        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #feb2b2;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
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
            
            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
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
                <h1>Broadcast Notifikasi</h1>
                <div>
                    <a href="{{ route('admin.broadcast.stats') }}" class="btn-stats">
                        <span>📊</span> Statistik
                    </a>
                    <a href="{{ route('admin.broadcast.create') }}" class="btn-primary">
                        <span>➕</span> Buat Broadcast
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="stats-grid">
                @php
                    $totalBroadcast = $notifications->total();
                    $draft = $notifications->where('status', 'draft')->count();
                    $scheduled = $notifications->where('status', 'terjadwal')->count();
                    $sent = $notifications->where('status', 'terkirim')->count();
                @endphp
                
                <div class="stat-card">
                    <div class="stat-icon">📢</div>
                    <div class="stat-info">
                        <h3>Total Broadcast</h3>
                        <div class="number">{{ $totalBroadcast }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📝</div>
                    <div class="stat-info">
                        <h3>Draft</h3>
                        <div class="number">{{ $draft }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">⏰</div>
                    <div class="stat-info">
                        <h3>Terjadwal</h3>
                        <div class="number">{{ $scheduled }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-info">
                        <h3>Terkirim</h3>
                        <div class="number">{{ $sent }}</div>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="filter-section">
                <form method="GET" action="{{ route('admin.broadcast.index') }}" class="filter-form">
                    <div class="form-group">
                        <label>Filter Status</label>
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="terjadwal" {{ request('status') == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                            <option value="terkirim" {{ request('status') == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                        </select>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-filter">
                            🔍 Filter
                        </button>
                        
                        @if(request()->has('status'))
                            <a href="{{ route('admin.broadcast.index') }}" class="btn-reset">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Target</th>
                            <th>Status</th>
                            <th>Dibuat Oleh</th>
                            <th>Dijadwalkan</th>
                            <th>Terkirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $index => $notification)
                        <tr>
                            <td>{{ $notifications->firstItem() + $index }}</td>
                            <td>
                                <div style="font-weight: 600;">{{ $notification->judul }}</div>
                                <div style="font-size: 12px; color: #718096;">{{ Str::limit($notification->isi, 50) }}</div>
                            </td>
                            <td>
                                @if($notification->target == 'semua')
                                    <span class="badge badge-primary">Semua</span>
                                @elseif($notification->target == 'guru')
                                    <span class="badge badge-info">Guru</span>
                                @elseif($notification->target == 'orang_tua')
                                    <span class="badge badge-success">Orang Tua</span>
                                @elseif($notification->target == 'siswa')
                                    <span class="badge badge-warning">Siswa</span>
                                @else
                                    <span class="badge">Spesifik</span>
                                @endif
                            </td>
                            <td>
                                @if($notification->status == 'draft')
                                    <span class="badge badge-warning">Draft</span>
                                @elseif($notification->status == 'terjadwal')
                                    <span class="badge badge-info">Terjadwal</span>
                                @elseif($notification->status == 'terkirim')
                                    <span class="badge badge-success">Terkirim</span>
                                @endif
                            </td>
                            <td>{{ $notification->creator->name ?? '-' }}</td>
                            <td>
                                @if($notification->scheduled_at)
                                    {{ $notification->scheduled_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($notification->sent_at)
                                    {{ $notification->sent_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.broadcast.show', $notification->id) }}" class="btn-action btn-view">
                                    👁️ Detail
                                </a>
                                @if($notification->status != 'terkirim')
                                    <button onclick="sendBroadcast({{ $notification->id }}, '{{ $notification->judul }}')" 
                                            class="btn-action btn-send">
                                        📤 Kirim
                                    </button>
                                    <button onclick="deleteBroadcast({{ $notification->id }}, '{{ $notification->judul }}')" 
                                            class="btn-action btn-delete">
                                        🗑️ Hapus
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 50px; color: #718096;">
                                <div style="font-size: 48px; margin-bottom: 15px;">📢</div>
                                <p style="font-size: 16px;">Belum ada broadcast</p>
                                <a href="{{ route('admin.broadcast.create') }}" class="btn-primary" style="margin-top: 20px; display: inline-block;">
                                    Buat Broadcast Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $notifications->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendBroadcast(id, judul) {
            if(confirm(`Kirim broadcast "${judul}" sekarang?`)) {
                fetch(`/admin/broadcast/${id}/send`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('✅ ' + data.message);
                        location.reload();
                    } else {
                        alert('❌ ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Gagal mengirim broadcast');
                });
            }
        }

        function deleteBroadcast(id, judul) {
            if(confirm(`⚠️ Hapus broadcast "${judul}"?`)) {
                fetch(`/admin/broadcast/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('✅ ' + data.message);
                        location.reload();
                    } else {
                        alert('❌ ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Gagal menghapus broadcast');
                });
            }
        }
    </script>
</body>
</html>