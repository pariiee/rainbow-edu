<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Orang Tua - Rainbow Edu</title>
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

        .btn-export {
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
            transition: all 0.3s ease;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(56, 161, 105, 0.3);
        }

        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            align-items: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
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

        .btn-reset-pw {
            background: #ed8936;
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
            
            .filter-form {
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
            <a href="{{ route('admin.users.ortu.index') }}" class="nav-item active">
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
                <h1>Manajemen Orang Tua</h1>
                <a href="{{ route('admin.siswa.export-ortu') }}" class="btn-export">
                    <span>📥</span> Export Excel
                </a>
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

            <!-- Filter -->
            <div class="filter-section">
                <form method="GET" action="{{ route('admin.users.ortu.index') }}" class="filter-form">
                    <div class="form-group">
                        <label>Pencarian</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari nama, email, atau nama anak..." 
                               value="{{ request('search') }}">
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-filter">
                            🔍 Cari
                        </button>
                        
                        @if(request()->has('search'))
                            <a href="{{ route('admin.users.ortu.index') }}" class="btn-reset">
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nama Anak</th>
                            <th>Jumlah Siswa</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ortus as $index => $ortu)
                        <tr>
                            <td>{{ $ortus->firstItem() + $index }}</td>
                            <td>
                                <div style="font-weight: 600;">{{ $ortu->name }}</div>
                                @if($ortu->phone)
                                    <div style="font-size: 12px; color: #718096;">{{ $ortu->phone }}</div>
                                @endif
                            </td>
                            <td>{{ $ortu->email }}</td>
                            <td>
                                <span class="badge badge-info">{{ $ortu->nama_anak ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="badge badge-success">{{ $ortu->siswa_list_count ?? 0 }} Siswa</span>
                            </td>
                            <td>
                                @if($ortu->is_verified)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td>{{ $ortu->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.ortu.show', $ortu->id) }}" class="btn-action btn-view">
                                    👁️ Detail
                                </a>
                                <button onclick="resetPassword({{ $ortu->id }}, '{{ $ortu->name }}')" 
                                        class="btn-action btn-reset-pw">
                                    🔑 Reset
                                </button>
                                <button onclick="deleteOrtu({{ $ortu->id }}, '{{ $ortu->name }}')" 
                                        class="btn-action btn-delete">
                                    🗑️ Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 50px; color: #718096;">
                                <div style="font-size: 48px; margin-bottom: 15px;">👪</div>
                                <p style="font-size: 16px;">Belum ada data orang tua</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $ortus->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function resetPassword(id, name) {
            if(confirm(`Reset password untuk "${name}"?\nPassword baru akan digenerate secara acak.`)) {
                fetch(`/admin/users/ortu/${id}/reset-password`, {
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

        function deleteOrtu(id, name) {
            if(confirm(`⚠️ Hapus akun "${name}"?\nSemua data terkait akan dihapus.`)) {
                fetch(`/admin/users/ortu/${id}`, {
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
                    alert('❌ Gagal menghapus akun');
                });
            }
        }
    </script>
</body>
</html>