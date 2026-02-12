<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Rainbow Edu</title>
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
            max-width: 500px;
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

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 28px;
            color: #667eea;
            font-weight: 700;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 12px;
            text-align: center;
        }

        .subtitle {
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
            text-align: center;
            line-height: 1.6;
        }

        .email-highlight {
            background: #f0f4ff;
            padding: 12px 20px;
            border-radius: 12px;
            color: #667eea;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            word-break: break-all;
        }

        .otp-input {
            width: 100%;
            padding: 18px 20px;
            font-size: 32px;
            letter-spacing: 12px;
            text-align: center;
            border: 2px solid #e0e0e0;
            border-radius: 16px;
            margin-bottom: 20px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-verify {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-verify:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .resend-section {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .timer {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .btn-resend {
            background: none;
            border: none;
            color: #667eea;
            font-weight: 600;
            cursor: pointer;
            font-size: 15px;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-resend:hover:not(:disabled) {
            background: #f0f4ff;
        }

        .btn-resend:disabled {
            color: #999;
            cursor: not-allowed;
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

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="logo">
                <h1>🌈 Rainbow Edu</h1>
            </div>

            <h2>Verifikasi OTP</h2>
            <p class="subtitle">
                Kami telah mengirimkan kode verifikasi ke email Anda
            </p>

            <div class="email-highlight">
                📧 {{ $email ?? session('email', 'email@anda.com') }}
            </div>

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

            <form id="otpForm" action="{{ route('otp.verify.submit') }}" method="POST">
                @csrf
                <input 
                    type="text" 
                    name="otp" 
                    class="otp-input" 
                    placeholder="000000"
                    maxlength="6"
                    pattern="\d{6}"
                    inputmode="numeric"
                    autocomplete="off"
                    autofocus
                    required
                >
                
                <button type="submit" class="btn-verify" id="btnVerify">
                    Verifikasi & Login →
                </button>
            </form>

            <div class="resend-section">
                <div class="timer" id="timer"></div>
                <button class="btn-resend" id="btnResend" disabled>
                    Kirim Ulang OTP
                </button>
            </div>

            <a href="{{ route('register') }}" class="back-link">
                ← Kembali ke Pendaftaran
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpInput = document.querySelector('.otp-input');
            const btnResend = document.getElementById('btnResend');
            const timerEl = document.getElementById('timer');
            
            // Auto submit when 6 digits entered
            otpInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length === 6) {
                    document.getElementById('otpForm').submit();
                }
            });

            // Resend OTP functionality
            let cooldown = 60; // 60 seconds cooldown
            let timer = null;

            function startTimer(seconds) {
                if (timer) clearInterval(timer);
                
                btnResend.disabled = true;
                
                timer = setInterval(function() {
                    if (seconds <= 0) {
                        clearInterval(timer);
                        btnResend.disabled = false;
                        timerEl.textContent = 'Sudah bisa kirim ulang';
                    } else {
                        timerEl.textContent = `Kirim ulang dalam ${seconds} detik`;
                        seconds--;
                    }
                }, 1000);
            }

            // Start timer on page load
            startTimer(cooldown);

            // Handle resend button click
            btnResend.addEventListener('click', function() {
                if (btnResend.disabled) return;

                btnResend.disabled = true;
                btnResend.textContent = 'Mengirim...';

                fetch('{{ route("otp.resend") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Kode OTP baru telah dikirim ke email Anda');
                        startTimer(60);
                    } else {
                        alert(data.message || 'Gagal mengirim OTP');
                        btnResend.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    btnResend.disabled = false;
                })
                .finally(() => {
                    btnResend.textContent = 'Kirim Ulang OTP';
                });
            });
        });
    </script>
</body>
</html>