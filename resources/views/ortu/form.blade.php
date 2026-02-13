<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Siswa - Rainbow Edu</title>
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

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back {
            padding: 10px 20px;
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

        .progress {
            margin-bottom: 32px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-fill {
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .progress-text {
            text-align: right;
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .info-box {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 32px;
        }

        .info-box p {
            color: #2d3748;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .required {
            color: #e53e3e;
            margin-left: 4px;
        }

        input, select, textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 14px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn-primary {
            flex: 1;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            padding: 16px 32px;
            border: 2px solid #e0e0e0;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            background: white;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background: #f5f5f5;
            border-color: #999;
        }

        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .alert-success {
            background: #e3fcef;
            color: #0a6e4d;
            border: 1px solid #b8f0d7;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        @media (max-width: 640px) {
            .card {
                padding: 30px 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>
                    <span>📝</span> Form Data Siswa
                </h1>
                <a href="{{ route('orangtua.home') }}" class="btn-back">
                    ← Kembali
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

            <div class="progress">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="progress-text">Lengkapi data untuk membantu guru</div>
            </div>

            <div class="info-box">
                <p>
                    <strong>✨ Informasi tambahan membantu guru:</strong><br>
                    Data yang Anda isi akan membantu guru memahami karakteristik dan kebutuhan 
                    putra/putri Anda sehingga proses belajar menjadi lebih efektif.
                </p>
            </div>

            <form action="{{ route('ortu.store.form') }}" method="POST">
                @csrf
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                <div class="form-row">
                    <div class="form-group">
                        <label for="sekolah_sebelumnya">
                            Sekolah Sebelumnya
                        </label>
                        <input type="text" id="sekolah_sebelumnya" name="sekolah_sebelumnya" 
                               placeholder="Contoh: TK Harapan Bangsa" 
                               value="{{ old('sekolah_sebelumnya', $questionnaire->sekolah_sebelumnya ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="usia_anak">
                            Usia Anak <span class="required">*</span>
                        </label>
                        <input type="number" id="usia_anak" name="usia_anak" 
                               placeholder="Contoh: 5" min="1" max="18"
                               value="{{ old('usia_anak', $questionnaire->usia_anak ?? '') }}"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tujuan_pendaftaran">
                        Tujuan Pendaftaran
                    </label>
                    <textarea id="tujuan_pendaftaran" name="tujuan_pendaftaran" 
                              rows="3" placeholder="Apa yang ingin dicapai putra/putri Anda?">{{ old('tujuan_pendaftaran', $questionnaire->tujuan_pendaftaran ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tingkat_kemandirian">
                        Tingkat Kemandirian Anak <span class="required">*</span>
                    </label>
                    <select id="tingkat_kemandirian" name="tingkat_kemandirian" required>
                        <option value="">-- Pilih Tingkat Kemandirian --</option>
                        <option value="Mandiri" {{ (old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? '') == 'Mandiri') ? 'selected' : '' }}>
                            🟢 Mandiri - Bisa melakukan aktivitas sendiri
                        </option>
                        <option value="Butuh Bantuan" {{ (old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? '') == 'Butuh Bantuan') ? 'selected' : '' }}>
                            🟡 Butuh Bantuan - Masih perlu dibantu beberapa hal
                        </option>
                        <option value="Sangat Butuh Bantuan" {{ (old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? '') == 'Sangat Butuh Bantuan') ? 'selected' : '' }}>
                            🔴 Sangat Butuh Bantuan - Membutuhkan pendampingan penuh
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ekspektasi_ortu">
                        Harapan / Ekspektasi Orang Tua
                    </label>
                    <textarea id="ekspektasi_ortu" name="ekspektasi_ortu" 
                              rows="3" placeholder="Apa harapan Bapak/Ibu terhadap perkembangan anak?">{{ old('ekspektasi_ortu', $questionnaire->ekspektasi_ortu ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="minat_bakat">
                        Minat & Bakat Khusus
                    </label>
                    <textarea id="minat_bakat" name="minat_bakat" 
                              rows="2" placeholder="Contoh: suka menggambar, musik, olahraga, dll">{{ old('minat_bakat', $questionnaire->minat_bakat ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="catatan_kesehatan">
                        Catatan Kesehatan (Alergi, Kondisi Khusus, dll)
                    </label>
                    <textarea id="catatan_kesehatan" name="catatan_kesehatan" 
                              rows="2" placeholder="Contoh: alergi seafood, asma, dll">{{ old('catatan_kesehatan', $questionnaire->catatan_kesehatan ?? '') }}</textarea>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        💾 Simpan Data
                    </button>
                    <a href="{{ route('orangtua.home') }}" class="btn-secondary">
                        Nanti Saja
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>