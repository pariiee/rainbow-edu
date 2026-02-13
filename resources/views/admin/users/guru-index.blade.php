<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru - Rainbow Edu</title>
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

        .btn-edit {
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
                <h1>Manajemen Guru</h1>
                <div style="display: flex; gap: 15px;">
                    <a href="{{ route('admin.siswa.export-guru') }}" class="btn-export">
                        <span>📥</span> Export Excel
                    </a>
                    <a href="{{ route('admin.users.guru.create') }}" class="btn-primary">
                        <span>➕</span> Tambah Guru
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

            <!-- Filter -->
            <div class="filter-section">
                <form method="GET" action="{{ route('admin.users.guru.index') }}" class="filter-form">
                    <div class="form-group">
                        <label>Pencarian</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari nama atau email..." 
                               value="{{ request('search') }}">
                    </div>
                    
                    <div class="form-group">
                        <label>Divisi</label>
                        <select name="guru_type" class="form-control">
                            <option value="">Semua Divisi</option>
                            @foreach($guruTypes as $value => $label)
                                <option value="{{ $value }}" {{ request('guru_type') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Status</label>
                        <select name="verified" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Belum Verifikasi</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-primary" style="padding: 12px 30px;">
                            🔍 Filter
                        </button>
                    </div>
                    
                    @if(request()->has('search') || request()->has('guru_type') || request()->has('verified'))
                        <div class="form-group">
                            <a href="{{ route('admin.users.guru.index') }}" class="btn-action" style="background: #718096; color: white; padding: 12px 20px;">
                                Reset Filter
                            </a>
                        </div>
                    @endif
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
                            <th>Divisi</th>
                            <th>Jumlah Siswa</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $index => $guru)
                        <tr>
                            <td>{{ $gurus->firstItem() + $index }}</td>
                            <td>
                                <div style="font-weight: 600;">{{ $guru->name }}</div>
                            </td>
                            <td>{{ $guru->email }}</td>
                            <td>
                                <span class="badge" style="background: #e2e8f0; color: #2d3748;">
                                    {{ $guruTypes[$guru->guru_type] ?? $guru->guru_type }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-success">{{ $guru->assigned_siswa_count ?? 0 }} Siswa</span>
                            </td>
                            <td>
                                @if($guru->is_verified)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td>{{ $guru->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.guru.show', $guru->id) }}" class="btn-action btn-view">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('admin.users.guru.edit', $guru->id) }}" class="btn-action btn-edit">
                                    ✏️ Edit
                                </a>
                                <button onclick="resetPassword({{ $guru->id }}, '{{ $guru->name }}')" 
                                        class="btn-action" style="background: #ed8936; color: white;">
                                    🔑 Reset
                                </button>
                                <button onclick="deleteGuru({{ $guru->id }}, '{{ $guru->name }}')" 
                                        class="btn-action btn-delete">
                                    🗑️ Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 50px; color: #718096;">
                                <div style="font-size: 48px; margin-bottom: 15px;">🧑‍🏫</div>
                                <p style="font-size: 16px;">Belum ada data guru</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $gurus->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Reset Password
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

        // Delete Guru
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
                        location.reload();
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