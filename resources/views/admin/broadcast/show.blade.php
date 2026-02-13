<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Broadcast - Rainbow Edu</title>
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

        .btn-send {
            background: #38a169;
        }

        .btn-delete {
            background: #e53e3e;
        }

        .broadcast-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .broadcast-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #edf2f7;
        }

        .broadcast-title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
        }

        .badge {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
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

        .badge-info {
            background: #e2e8f0;
            color: #2d3748;
        }

        .badge-primary {
            background: #bee3f8;
            color: #2c5282;
        }

        .broadcast-content {
            background: #f8fafc;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.8;
            color: #4a5568;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
        }

        .info-label {
            font-size: 13px;
            color: #718096;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #718096;
            font-size: 14px;
        }

        .action-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #edf2f7;
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
            
            .info-grid, .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-group {
                flex-direction: column;
            }
            
            .broadcast-title {
                font-size: 22px;
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
                <h1>Detail Broadcast</h1>
                <a href="{{ route('admin.broadcast.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @if(session('success'))
                <div style="background: #c6f6d5; color: #22543d; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="broadcast-card">
                <div class="broadcast-header">
                    <div class="broadcast-title">{{ $notification->judul }}</div>
                    <div>
                        @if($notification->status == 'draft')
                            <span class="badge badge-warning">Draft</span>
                        @elseif($notification->status == 'terjadwal')
                            <span class="badge badge-info">Terjadwal</span>
                        @elseif($notification->status == 'terkirim')
                            <span class="badge badge-success">Terkirim</span>
                        @endif
                    </div>
                </div>

                <div class="broadcast-content">
                    {!! nl2br(e($notification->isi)) !!}
                </div>

                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Target</div>
                        <div class="info-value">
                            @if($notification->target == 'semua')
                                📢 Semua (Guru & Orang Tua)
                            @elseif($notification->target == 'guru')
                                🧑‍🏫 Guru
                            @elseif($notification->target == 'orang_tua')
                                👪 Orang Tua
                            @elseif($notification->target == 'spesifik')
                                🎯 Spesifik ({{ count($notification->target_ids ?? []) }} orang)
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-label">Dibuat Oleh</div>
                        <div class="info-value">{{ $notification->creator->name ?? '-' }}</div>
                        <div style="font-size: 12px; color: #718096;">{{ $notification->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    
                    @if($notification->scheduled_at)
                    <div class="info-card">
                        <div class="info-label">Dijadwalkan</div>
                        <div class="info-value">{{ $notification->scheduled_at->format('d/m/Y H:i') }}</div>
                    </div>
                    @endif
                    
                    @if($notification->sent_at)
                    <div class="info-card">
                        <div class="info-label">Terkirim</div>
                        <div class="info-value">{{ $notification->sent_at->format('d/m/Y H:i') }}</div>
                    </div>
                    @endif
                </div>

                @if($notification->status == 'terkirim')
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['total'] }}</div>
                        <div class="stat-label">Total Penerima</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['read'] }}</div>
                        <div class="stat-label">Sudah Dibaca</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['unread'] }}</div>
                        <div class="stat-label">Belum Dibaca</div>
                    </div>
                </div>
                @endif

                @if($notification->status != 'terkirim')
                <div class="action-group">
                    <button onclick="sendBroadcast({{ $notification->id }}, '{{ $notification->judul }}')" 
                            class="btn-primary btn-send">
                        📤 Kirim Sekarang
                    </button>
                    <button onclick="deleteBroadcast({{ $notification->id }}, '{{ $notification->judul }}')" 
                            class="btn-primary btn-delete">
                        🗑️ Hapus Broadcast
                    </button>
                </div>
                @endif
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
                        window.location.href = '{{ route("admin.broadcast.index") }}';
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