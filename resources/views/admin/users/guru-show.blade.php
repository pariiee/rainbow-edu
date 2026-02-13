<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Guru - Rainbow Edu</title>
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

        .btn-warning {
            background: #ed8936;
        }

        .btn-danger {
            background: #e53e3e;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            font-weight: 600;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .profile-email {
            color: #718096;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge {
            display: inline-block;
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

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 20px;
            color: #2d3748;
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
            padding: 12px;
            color: #718096;
            font-weight: 600;
            font-size: 13px;
            border-bottom: 2px solid #edf2f7;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
        }

        .action-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
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
            
            .profile-card {
                flex-direction: column;
                text-align: center;
            }
            
            .stats-grid {
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
            
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.guru.index') }}" class="nav-item active">
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
                <h1>Detail Guru</h1>
                <a href="{{ route('admin.users.guru.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @if(session('success'))
                <div style="background: #c6f6d5; color: #22543d; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar">
                    {{ strtoupper(substr($guru->name, 0, 1)) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $guru->name }}</div>
                    <div class="profile-email">
                        <span>📧 {{ $guru->email }}</span>
                        @if($guru->phone)
                            <span>📱 {{ $guru->phone }}</span>
                        @endif
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <span class="badge badge-info">🧑‍🏫 {{ $guru->guru_type }}</span>
                        @if($guru->is_verified)
                            <span class="badge badge-success">✅ Terverifikasi</span>
                        @else
                            <span class="badge badge-warning">⏳ Belum Verifikasi</span>
                        @endif
                        <span class="badge badge-info">📅 {{ $guru->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $guru->assignedSiswa->count() }}</div>
                    <div class="stat-label">Total Siswa</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        {{ $guru->assignedSiswa->where('status_assign', 'active')->count() }}
                    </div>
                    <div class="stat-label">Siswa Aktif</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $jadwals->count() }}</div>
                    <div class="stat-label">Total Jadwal</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-group">
                <a href="{{ route('admin.users.guru.edit', $guru->id) }}" class="btn-primary">
                    ✏️ Edit Data
                </a>
                <button onclick="resetPassword({{ $guru->id }}, '{{ $guru->name }}')" 
                        class="btn-primary btn-warning">
                    🔑 Reset Password
                </button>
                <button onclick="deleteGuru({{ $guru->id }}, '{{ $guru->name }}')" 
                        class="btn-primary btn-danger">
                    🗑️ Hapus Guru
                </button>
            </div>

            <!-- Daftar Siswa -->
            <div class="table-container">
                <div class="table-header">
                    <h2>
                        <span>📋</span> Daftar Siswa Bimbingan
                    </h2>
                    <span style="color: #718096;">{{ $guru->assignedSiswa->count() }} Siswa</span>
                </div>

                @if($guru->assignedSiswa->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Orang Tua</th>
                                <th>Layanan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guru->assignedSiswa as $siswa)
                            <tr>
                                <td>{{ $siswa->nama_lengkap }}</td>
                                <td>{{ $siswa->orangTua->name ?? '-' }}</td>
                                <td>{{ $siswa->layanan ?? '-' }}</td>
                                <td>
                                    @if($siswa->status_assign == 'active')
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif($siswa->status_assign == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-info">{{ $siswa->status_assign }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="text-align: center; padding: 40px; color: #718096;">
                        <div style="font-size: 48px; margin-bottom: 15px;">👨‍🏫</div>
                        <p>Belum ada siswa yang dibimbing</p>
                    </div>
                @endif
            </div>

            <!-- Jadwal Terakhir -->
            <div class="table-container">
                <div class="table-header">
                    <h2>
                        <span>📅</span> Jadwal Terakhir
                    </h2>
                    <a href="#" style="color: #667eea; text-decoration: none; font-weight: 600;">Lihat Semua →</a>
                </div>

                @if($jadwals->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $jadwal->siswa->nama_lengkap ?? '-' }}</td>
                                <td>{{ $jadwal->waktu->format('H:i') }}</td>
                                <td>
                                    @if($jadwal->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($jadwal->status == 'disetujui')
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif($jadwal->status == 'selesai')
                                        <span class="badge badge-info">Selesai</span>
                                    @else
                                        <span class="badge">{{ $jadwal->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="text-align: center; padding: 30px; color: #718096;">
                        <p>Belum ada jadwal mengajar</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function resetPassword(id, name) {
            if(confirm(`Reset password untuk guru "${name}"?\nPassword baru akan digenerate secara acak.`)) {
                fetch(`/admin/users/guru/${id}/reset-password`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert(`✅ Password berhasil direset!\nPassword baru: ${data.password}\n\nCatat password ini!`);
                        location.reload();
                    } else {
                        alert('❌ ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Gagal mereset password');
                });
            }
        }

        function deleteGuru(id, name) {
            if(confirm(`⚠️ Hapus guru "${name}"?\nData guru akan dihapus permanen.`)) {
                fetch(`/admin/users/guru/${id}`, {
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
                        window.location.href = '{{ route("admin.users.guru.index") }}';
                    } else {
                        alert('❌ ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Gagal menghapus guru');
                });
            }
        }
    </script>
</body>
</html>