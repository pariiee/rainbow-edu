<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Broadcast - Rainbow Edu</title>
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

        textarea.form-control {
            resize: vertical;
            min-height: 150px;
        }

        .radio-group {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            padding: 10px 0;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .user-list {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-top: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-primary {
            flex: 1;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-success {
            background: #38a169;
        }

        .btn-save {
            background: #718096;
        }

        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
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
            
            .btn-group {
                flex-direction: column;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 15px;
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
                <h1>Buat Broadcast Baru</h1>
                <a href="{{ route('admin.broadcast.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @if(session('error'))
                <div class="alert alert-error">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <form action="{{ route('admin.broadcast.store') }}" method="POST" id="broadcastForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="judul">
                            Judul Broadcast <span class="required">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" class="form-control" 
                               value="{{ old('judul') }}"
                               placeholder="Contoh: Pengumuman Libur, Info Kegiatan, dll"
                               required>
                        @error('judul')
                            <p style="color: #e53e3e; font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="isi">
                            Isi Broadcast <span class="required">*</span>
                        </label>
                        <textarea id="isi" name="isi" class="form-control" 
                                  placeholder="Tulis pesan broadcast di sini..."
                                  required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <p style="color: #e53e3e; font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            Target Penerima <span class="required">*</span>
                        </label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="target" value="semua" 
                                       {{ old('target') == 'semua' ? 'checked' : '' }} checked>
                                <span>📢 Semua (Guru & Orang Tua)</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="target" value="guru"
                                       {{ old('target') == 'guru' ? 'checked' : '' }}>
                                <span>🧑‍🏫 Guru</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="target" value="orang_tua"
                                       {{ old('target') == 'orang_tua' ? 'checked' : '' }}>
                                <span>👪 Orang Tua</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="target" value="spesifik" id="targetSpesifik"
                                       {{ old('target') == 'spesifik' ? 'checked' : '' }}>
                                <span>🎯 Spesifik</span>
                            </label>
                        </div>
                    </div>

                    <!-- Spesifik Users -->
                    <div id="spesifikSection" style="display: {{ old('target') == 'spesifik' ? 'block' : 'none' }};">
                        <div class="form-group">
                            <label>Pilih Penerima <span class="required">*</span></label>
                            
                            <div style="margin-bottom: 15px;">
                                <button type="button" onclick="selectAll('guru')" class="btn-filter" style="padding: 8px 16px; font-size: 13px; margin-right: 10px;">
                                    Pilih Semua Guru
                                </button>
                                <button type="button" onclick="selectAll('ortu')" class="btn-filter" style="padding: 8px 16px; font-size: 13px; background: #38a169;">
                                    Pilih Semua Orang Tua
                                </button>
                                <button type="button" onclick="deselectAll()" class="btn-filter" style="padding: 8px 16px; font-size: 13px; background: #718096;">
                                    Hapus Semua
                                </button>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <!-- Guru -->
                                <div>
                                    <h4 style="margin-bottom: 15px; color: #2d3748;">🧑‍🏫 Guru</h4>
                                    <div class="user-list">
                                        @forelse($gurus as $guru)
                                        <div class="user-item">
                                            <input type="checkbox" name="target_ids[]" value="{{ $guru->id }}" 
                                                   class="user-checkbox guru-checkbox"
                                                   {{ is_array(old('target_ids')) && in_array($guru->id, old('target_ids')) ? 'checked' : '' }}>
                                            <div>
                                                <div style="font-weight: 600;">{{ $guru->name }}</div>
                                                <div style="font-size: 12px; color: #718096;">{{ $guru->email }}</div>
                                                <div style="font-size: 11px; color: #667eea;">{{ $guru->guru_type ?? '-' }}</div>
                                            </div>
                                        </div>
                                        @empty
                                        <p style="color: #718096; text-align: center; padding: 20px;">Tidak ada guru</p>
                                        @endforelse
                                    </div>
                                </div>
                                
                                <!-- Orang Tua -->
                                <div>
                                    <h4 style="margin-bottom: 15px; color: #2d3748;">👪 Orang Tua</h4>
                                    <div class="user-list">
                                        @forelse($ortus as $ortu)
                                        <div class="user-item">
                                            <input type="checkbox" name="target_ids[]" value="{{ $ortu->id }}" 
                                                   class="user-checkbox ortu-checkbox"
                                                   {{ is_array(old('target_ids')) && in_array($ortu->id, old('target_ids')) ? 'checked' : '' }}>
                                            <div>
                                                <div style="font-weight: 600;">{{ $ortu->name }}</div>
                                                <div style="font-size: 12px; color: #718096;">{{ $ortu->email }}</div>
                                                <div style="font-size: 11px; color: #38a169;">Anak: {{ $ortu->nama_anak ?? '-' }}</div>
                                            </div>
                                        </div>
                                        @empty
                                        <p style="color: #718096; text-align: center; padding: 20px;">Tidak ada orang tua</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @error('target_ids')
                                <p style="color: #e53e3e; font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="scheduled_at">
                            Jadwalkan Pengiriman (Opsional)
                        </label>
                        <input type="datetime-local" id="scheduled_at" name="scheduled_at" 
                               class="form-control" 
                               value="{{ old('scheduled_at') }}"
                               min="{{ now()->format('Y-m-d\TH:i') }}">
                        <p style="color: #718096; font-size: 13px; margin-top: 5px;">
                            ⏰ Kosongkan jika ingin kirim sekarang atau simpan sebagai draft
                        </p>
                    </div>

                    <div class="btn-group">
                        <button type="submit" name="send_now" value="1" class="btn-primary btn-success">
                            📤 Kirim Sekarang
                        </button>
                        <button type="submit" class="btn-primary btn-save">
                            💾 Simpan Draft
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle spesifik section
        const targetSpesifik = document.getElementById('targetSpesifik');
        const spesifikSection = document.getElementById('spesifikSection');
        
        document.querySelectorAll('input[name="target"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'spesifik') {
                    spesifikSection.style.display = 'block';
                } else {
                    spesifikSection.style.display = 'none';
                }
            });
        });

        // Select all functions
        function selectAll(type) {
            const checkboxes = type === 'guru' 
                ? document.querySelectorAll('.guru-checkbox')
                : document.querySelectorAll('.ortu-checkbox');
            
            checkboxes.forEach(cb => cb.checked = true);
        }

        function deselectAll() {
            document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
        }
    </script>
</body>
</html>