<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guru - Rainbow Edu</title>
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

        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
        }

        .required {
            color: #e53e3e;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-active {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-inactive {
            background: #fed7d7;
            color: #742a2a;
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
            
            .form-row {
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
                <h1>Edit Data Guru</h1>
                <a href="{{ route('admin.users.guru.show', $guru->id) }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @if(session('error'))
                <div class="alert alert-error" style="background: #fee; color: #c33; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <form action="{{ route('admin.users.guru.update', $guru->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <input type="text" id="name" name="name" 
                                   class="form-control" 
                                   value="{{ old('name', $guru->name) }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                Email <span class="required">*</span>
                            </label>
                            <input type="email" id="email" name="email" 
                                   class="form-control" 
                                   value="{{ old('email', $guru->email) }}"
                                   required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">
                                Nomor Telepon
                            </label>
                            <input type="text" id="phone" name="phone" 
                                   class="form-control" 
                                   value="{{ old('phone', $guru->phone) }}">
                        </div>

                        <div class="form-group">
                            <label for="guru_type">
                                Divisi <span class="required">*</span>
                            </label>
                            <select id="guru_type" name="guru_type" class="form-control" required>
                                <option value="PAUD" {{ ($guru->guru_type == 'PAUD') ? 'selected' : '' }}>PAUD</option>
                                <option value="Learn kursus" {{ ($guru->guru_type == 'Learn kursus') ? 'selected' : '' }}>Learn Kursus</option>
                                <option value="Homelearning kursus private" {{ ($guru->guru_type == 'Homelearning kursus private') ? 'selected' : '' }}>Home Learning</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="is_verified">
                            Status Verifikasi
                        </label>
                        <div style="display: flex; align-items: center; gap: 20px; padding: 10px 0;">
                            <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                <input type="radio" name="is_verified" value="1" {{ $guru->is_verified ? 'checked' : '' }}>
                                <span class="status-badge status-active">Terverifikasi</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                                <input type="radio" name="is_verified" value="0" {{ !$guru->is_verified ? 'checked' : '' }}>
                                <span class="status-badge status-inactive">Belum Verifikasi</span>
                            </label>
                        </div>
                    </div>

                    <div style="background: #ebf8ff; border-left: 4px solid #4299e1; padding: 16px; margin-bottom: 25px; border-radius: 8px;">
                        <p style="color: #2c5282; font-size: 14px;">
                            <strong>📌 Informasi:</strong><br>
                            - Untuk reset password, gunakan tombol "Reset Password" di halaman detail<br>
                            - Email harus unik dan belum digunakan akun lain
                        </p>
                    </div>

                    <button type="submit" class="btn-submit">
                        💾 Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>