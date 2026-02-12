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
            max-width: 800px;
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

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
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
            border-radius: 16px;
            padding: 24px 20px;
            transition: all 0.3s ease;
            background: white;
        }

        .layanan-card input[type="radio"]:checked + .layanan-content {
            border-color: #667eea;
            background: #f0f4ff;
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .layanan-icon {
            font-size: 40px;
            margin-bottom: 16px;
        }

        .layanan-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .layanan-desc {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .btn-next {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Pilih Layanan Pendidikan</h1>
            <p class="subtitle">Silakan pilih salah satu layanan yang sesuai dengan kebutuhan putra/putri Anda</p>

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
                    <!-- PAUD Rainbow -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="PAUD Rainbow" required>
                        <div class="layanan-content">
                            <div class="layanan-icon">🎨</div>
                            <div class="layanan-title">PAUD Rainbow</div>
                            <div class="layanan-desc">Program PAUD dengan pendekatan Montessori & bermain sambil belajar</div>
                        </div>
                    </label>

                    <!-- Permata Montessori -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="Permata Montessori">
                        <div class="layanan-content">
                            <div class="layanan-icon">🏫</div>
                            <div class="layanan-title">Permata Montessori</div>
                            <div class="layanan-desc">Metode Montessori penuh untuk perkembangan optimal anak</div>
                        </div>
                    </label>

                    <!-- Rainbow Course -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="Rainbow Course">
                        <div class="layanan-content">
                            <div class="layanan-icon">📚</div>
                            <div class="layanan-title">Rainbow Course</div>
                            <div class="layanan-desc">Program kursus akademik dan pengembangan bakat</div>
                        </div>
                    </label>

                    <!-- Rainbow Home Learning -->
                    <label class="layanan-card">
                        <input type="radio" name="layanan" value="Rainbow Home Learning">
                        <div class="layanan-content">
                            <div class="layanan-icon">🏠</div>
                            <div class="layanan-title">Rainbow Home Learning</div>
                            <div class="layanan-desc">Program belajar privat di rumah</div>
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

            // Initial state
            updateButtonState();
        });
    </script>
</body>
</html>