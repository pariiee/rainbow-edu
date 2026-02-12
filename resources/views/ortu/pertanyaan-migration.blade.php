<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanyaan Migration - Parent Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            width: 100%;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
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

        h1 {
            font-size: 28px;
            color: #1a1a1a;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn-primary {
            flex: 1;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-skip {
            padding: 16px 32px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            background: white;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-skip:hover {
            background: #f5f5f5;
            border-color: #999;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 32px;
        }

        .info-box p {
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 640px) {
            .card {
                padding: 30px 20px;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .btn-skip {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="progress">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="progress-text">Pertanyaan 2/2</div>
            </div>

            <h1>Informasi Tambahan</h1>
            <p class="subtitle">Bantu kami lebih memahami kebutuhan putra/putri Anda (dapat diisi nanti)</p>

            <div class="info-box">
                <p>✨ Anda dapat melewati pertanyaan ini dan mengisinya nanti melalui menu profil. Data ini membantu guru dalam memberikan pembelajaran yang lebih personal.</p>
            </div>

            <form action="{{ route('ortu.store.pertanyaan', $siswa->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="sekolah_sebelumnya">Sekolah Sebelumnya (jika ada)</label>
                    <input type="text" id="sekolah_sebelumnya" name="sekolah_sebelumnya" 
                           placeholder="Contoh: TK Harapan Bangsa" 
                           value="{{ old('sekolah_sebelumnya', $questionnaire->sekolah_sebelumnya ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="usia_anak">Usia Anak (tahun)</label>
                    <input type="number" id="usia_anak" name="usia_anak" 
                           placeholder="Contoh: 5" min="1" max="18"
                           value="{{ old('usia_anak', $questionnaire->usia_anak ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="tujuan_pendaftaran">Tujuan Pendaftaran</label>
                    <textarea id="tujuan_pendaftaran" name="tujuan_pendaftaran" 
                              rows="3" placeholder="Apa yang ingin dicapai putra/putri Anda?">{{ old('tujuan_pendaftaran', $questionnaire->tujuan_pendaftaran ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tingkat_kemandirian">Tingkat Kemandirian Anak</label>
                    <select id="tingkat_kemandirian" name="tingkat_kemandirian">
                        <option value="">-- Pilih --</option>
                        <option value="Mandiri" {{ (old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? '') == 'Mandiri') ? 'selected' : '' }}>Mandiri - Bisa melakukan aktivitas sendiri</option>
                        <option value="Butuh Bantuan" {{ (old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? '') == 'Butuh Bantuan') ? 'selected' : '' }}>Butuh Bantuan - Masih perlu dibantu beberapa hal</option>
                        <option value="Sangat Butuh Bantuan" {{ (old('tingkat_kemandirian', $questionnaire->tingkat_kemandirian ?? '') == 'Sangat Butuh Bantuan') ? 'selected' : '' }}>Sangat Butuh Bantuan - Membutuhkan pendampingan penuh</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ekspektasi_ortu">Harapan/Ekspektasi Orang Tua</label>
                    <textarea id="ekspektasi_ortu" name="ekspektasi_ortu" 
                              rows="3" placeholder="Apa harapan Bapak/Ibu terhadap perkembangan anak?">{{ old('ekspektasi_ortu', $questionnaire->ekspektasi_ortu ?? '') }}</textarea>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        Simpan & Lanjutkan →
                    </button>
                    
                    <button type="submit" name="skip" value="1" class="btn-skip">
                        ⏭️ Nanti saja
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>