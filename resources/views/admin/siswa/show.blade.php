<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - Rainbow Edu</title>
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

        .badge-primary {
            background: #bee3f8;
            color: #2c5282;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .info-card h3 {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 2px solid #edf2f7;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
        }

        .info-label {
            width: 140px;
            color: #718096;
            font-size: 14px;
        }

        .info-value {
            flex: 1;
            color: #4a5568;
            font-weight: 500;
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
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .info-row {
                flex-direction: column;
                gap: 5px;
            }
            
            .info-label {
                width: 100%;
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
            <a href="{{ route('admin.siswa.index') }}" class="nav-item active">
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
                <h1>Detail Siswa</h1>
                <a href="{{ route('admin.siswa.index') }}" class="btn-back">
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
                    {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $siswa->nama_lengkap }}</div>
                    <div class="profile-email">
                        @if($siswa->nama_panggilan)
                            <span>📝 Panggilan: {{ $siswa->nama_panggilan }}</span>
                        @endif
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        @if($siswa->layanan)
                            <span class="badge badge-primary">{{ $siswa->layanan }}</span>
                        @endif
                        @if($siswa->status_assign == 'active')
                            <span class="badge badge-success">✅ Aktif</span>
                        @elseif($siswa->status_assign == 'pending')
                            <span class="badge badge-warning">⏳ Pending</span>
                        @endif
                        <span class="badge badge-info">📅 {{ $siswa->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-group">
                <button onclick="reassignGuru({{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')" 
                        class="btn-primary btn-warning">
                    🔄 Assign/Change Guru
                </button>
                <button onclick="deleteSiswa({{ $siswa->id }}, '{{ $siswa->nama_lengkap }}')" 
                        class="btn-primary btn-danger">
                    🗑️ Hapus Siswa
                </button>
            </div>

            <!-- Info Grid -->
            <div class="info-grid">
                <!-- Data Pribadi -->
                <div class="info-card">
                    <h3>
                        <span>👤</span> Data Pribadi
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $siswa->nama_lengkap }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nama Panggilan</span>
                        <span class="info-value">{{ $siswa->nama_panggilan ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tempat Lahir</span>
                        <span class="info-value">{{ $siswa->tempat_lahir ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d/m/Y') : '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Gender</span>
                        <span class="info-value">{{ $siswa->gender ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Agama</span>
                        <span class="info-value">{{ $siswa->agama ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Bahasa</span>
                        <span class="info-value">{{ $siswa->bahasa_sehari_hari ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat</span>
                        <span class="info-value">{{ $siswa->alamat_domisili ?? '-' }}</span>
                    </div>
                </div>

                <!-- Data Akademik -->
                <div class="info-card">
                    <h3>
                        <span>📚</span> Data Akademik
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Status Pendaftaran</span>
                        <span class="info-value">{{ $siswa->status_pendaftaran ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Asal Cabang</span>
                        <span class="info-value">{{ $siswa->asal_cabang ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Layanan</span>
                        <span class="info-value">
                            @if($siswa->layanan)
                                <span class="badge badge-primary">{{ $siswa->layanan }}</span>
                            @else
                                -
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Guru</span>
                        <span class="info-value">
                            @if($siswa->guru)
                                {{ $siswa->guru->name }}<br>
                                <span style="font-size: 12px; color: #718096;">{{ $siswa->guru->guru_type ?? '' }}</span>
                            @else
                                <span style="color: #e53e3e;">Belum diassign</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Orang Tua</span>
                        <span class="info-value">
                            @if($siswa->orangTua)
                                {{ $siswa->orangTua->name }}<br>
                                <span style="font-size: 12px; color: #718096;">{{ $siswa->orangTua->email }}</span>
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Questionnaire -->
            @if($siswa->questionnaire)
            <div class="info-grid">
                <div class="info-card">
                    <h3>
                        <span>📋</span> Informasi Tambahan
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Sekolah Sebelumnya</span>
                        <span class="info-value">{{ $siswa->questionnaire->sekolah_sebelumnya ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Usia Anak</span>
                        <span class="info-value">{{ $siswa->questionnaire->usia_anak ?? '-' }} tahun</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tujuan Pendaftaran</span>
                        <span class="info-value">{{ $siswa->questionnaire->tujuan_pendaftaran ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tingkat Kemandirian</span>
                        <span class="info-value">{{ $siswa->questionnaire->tingkat_kemandirian ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Ekspektasi Ortu</span>
                        <span class="info-value">{{ $siswa->questionnaire->ekspektasi_ortu ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Minat Bakat</span>
                        <span class="info-value">{{ $siswa->questionnaire->minat_bakat ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Catatan Kesehatan</span>
                        <span class="info-value">{{ $siswa->questionnaire->catatan_kesehatan ?? '-' }}</span>
                    </div>
                </div>

                <!-- Profile Siswa -->
                @if($siswa->profile)
                <div class="info-card">
                    <h3>
                        <span>📊</span> Profil Belajar
                    </h3>
                    <div class="info-row">
                        <span class="info-label">Gaya Belajar</span>
                        <span class="info-value">{{ $siswa->profile->gaya_belajar ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Minat Khusus</span>
                        <span class="info-value">{{ $siswa->profile->minat_khusus ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Temperamen</span>
                        <span class="info-value">{{ $siswa->profile->temperamen ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Trigger Emosi</span>
                        <span class="info-value">{{ $siswa->profile->trigger_emosi ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Strategi Menenangkan</span>
                        <span class="info-value">{{ $siswa->profile->strategi_menenangkan ?? '-' }}</span>
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Jadwal -->
            <div class="table-container">
                <div class="table-header">
                    <h2>
                        <span>📅</span> Riwayat Jadwal
                    </h2>
                </div>

                @if($siswa->jadwals && $siswa->jadwals->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Guru</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa->jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $jadwal->waktu->format('H:i') }}</td>
                                <td>{{ $jadwal->guru->name ?? '-' }}</td>
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
                                <td>{{ Str::limit($jadwal->catatan, 50) ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="text-align: center; padding: 40px; color: #718096;">
                        <div style="font-size: 48px; margin-bottom: 15px;">📆</div>
                        <p>Belum ada jadwal belajar</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Reassign Guru -->
    <div id="reassignModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 20px; padding: 30px; width: 90%; max-width: 500px;">
            <h3 style="margin-bottom: 20px; color: #2d3748;">Assign Guru ke Siswa</h3>
            <p id="siswaName" style="margin-bottom: 20px; color: #4a5568;"></p>
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label for="guru_select">Pilih Guru</label>
                <select id="guru_select" class="form-control">
                    <option value="">-- Pilih Guru --</option>
                    @foreach(App\Models\User::where('role_type', 'guru')->get() as $guru)
                        <option value="{{ $guru->id }}" {{ $siswa->guru_id == $guru->id ? 'selected' : '' }}>
                            {{ $guru->name }} ({{ $guru->guru_type ?? '-' }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div style="display: flex; gap: 15px;">
                <button onclick="submitReassign()" class="btn-primary" style="flex: 1;">
                    Simpan
                </button>
                <button onclick="closeModal()" class="btn-back" style="flex: 1; background: #718096; color: white;">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentSiswaId = {{ $siswa->id }};

        function reassignGuru(id, nama) {
            currentSiswaId = id;
            document.getElementById('siswaName').innerHTML = `<strong>${nama}</strong>`;
            document.getElementById('reassignModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('reassignModal').style.display = 'none';
        }

        function submitReassign() {
            const guruId = document.getElementById('guru_select').value;
            
            if (!guruId) {
                alert('Pilih guru terlebih dahulu!');
                return;
            }

            fetch(`/admin/siswa/${currentSiswaId}/reassign-guru`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ guru_id: guruId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ ' + data.message);
                    location.reload();
                } else {
                    alert('❌ ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Gagal mengassign guru');
            });
        }

        function deleteSiswa(id, nama) {
            if (confirm(`⚠️ Hapus data siswa "${nama}"?\nSemua data terkait akan dihapus permanen.`)) {
                fetch(`/admin/siswa/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ ' + data.message);
                        window.location.href = '{{ route("admin.siswa.index") }}';
                    } else {
                        alert('❌ ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Gagal menghapus data siswa');
                });
            }
        }
    </script>
</body>
</html>