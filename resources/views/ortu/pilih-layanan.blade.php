<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Layanan - Parent Portal</title>
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
            max-width: 1000px;
            width: 100%;
        }

        .card {
            background: white;
            border-radius: 24px;
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

        h1 {
            font-size: 32px;
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

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .layanan-card {
            position: relative;
            cursor: pointer;
        }

        .layanan-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .layanan-content {
            border: 2px solid #e0e0e0;
            border-radius: 20px;
            padding: 32px 24px;
            transition: all 0.3s ease;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .layanan-card input[type="radio"]:checked + .layanan-content {
            border-color: #667eea;
            background: #f0f4ff;
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2);
        }

        .layanan-icon {
            font-size: 56px;
            margin-bottom: 20px;
        }

        .layanan-title {
            font-size: 22px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
        }

        .layanan-desc {
            font-size: 14px;
            color: #718096;
            line-height: 1.6;
            margin-bottom: 20px;
            flex: 1;
        }

        .guru-badge {
            display: inline-block;
            padding: 8px 16px;
            background: #e2e8f0;
            color: #4a5568;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-top: auto;
        }

        .layanan-card input[type="radio"]:checked + .layanan-content .guru-badge {
            background: #667eea;
            color: white;
        }

        .btn-next {
            width: 100%;
            padding: 18px;
            border: none;
            border-radius: 16px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            background: #ccc;
            cursor: not-allowed;
            transition: all 0.3s ease;
            margin-top: 16px;
        }

        .btn-next.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-next.active:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
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

        .alert-success {
            background: #e3fcef;
            color: #0a6e4d;
            border: 1px solid #b8f0d7;
        }

        @media (max-width: 768px) {
            .layanan-grid {
                grid-template-columns: 1fr;
            }
            
            .card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🌈 Pilih Layanan Pendidikan</h1>
            <p class="subtitle">Pilih salah satu layanan untuk putra/putri Anda</p>

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('ortu.store.layanan') }}" method="POST" id="layananForm">
                @csrf
                
                <div class="layanan-grid">
                    <!-- PAUD - Gabungan PAUD Rainbow & Permata Montessori -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="PAUD" required>
                        <div class="layanan-content">
                            <div class="layanan-icon">🎨</div>
                            <div class="layanan-title">PAUD</div>
                            <div class="layanan-desc">
                                Pendidikan Anak Usia Dini dengan metode Montessori 
                                dan bermain sambil belajar. Tersedia program reguler dan montessori.
                            </div>
                            <span class="guru-badge">🧑‍🏫 Guru PAUD</span>
                        </div>
                    </label>

                    <!-- Learn / Kursus -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="Learn">
                        <div class="layanan-content">
                            <div class="layanan-icon">📚</div>
                            <div class="layanan-title">Rainbow Course</div>
                            <div class="layanan-desc">
                                Program kursus akademik (Matematika, Sains, Bahasa) 
                                dan pengembangan bakat (Musik, Seni, Olahraga).
                            </div>
                            <span class="guru-badge">📖 Guru Learn</span>
                        </div>
                    </label>

                    <!-- Home Learning -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="Home Learning">
                        <div class="layanan-content">
                            <div class="layanan-icon">🏠</div>
                            <div class="layanan-title">Rainbow Home Learning</div>
                            <div class="layanan-desc">
                                Program belajar privat di rumah dengan guru berkualitas, 
                                jadwal fleksibel, materi disesuaikan dengan kebutuhan.
                            </div>
                            <span class="guru-badge">🏠 Guru Home Learning</span>
                        </div>
                    </label>
                </div>

                <button type="submit" class="btn-next" id="btnNext" disabled>
                    Selanjutnya →
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="layanan"]');
            const btnNext = document.getElementById('btnNext');

            function updateButtonState() {
                const isChecked = Array.from(radioButtons).some(radio => radio.checked);
                
                if (isChecked) {
                    btnNext.classList.add('active');
                    btnNext.disabled = false;
                } else {
                    btnNext.classList.remove('active');
                    btnNext.disabled = true;
                }
            }

            radioButtons.forEach(radio => {
                radio.addEventListener('change', updateButtonState);
            });

            updateButtonState();
        });
    </script>
</body>
</html>