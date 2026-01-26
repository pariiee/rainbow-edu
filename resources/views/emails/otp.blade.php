<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .otp-box { 
            background: #f4f4f4; 
            padding: 20px; 
            text-align: center; 
            font-size: 24px; 
            font-weight: bold; 
            letter-spacing: 10px;
            margin: 20px 0;
        }
        .warning { color: #ff0000; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verifikasi Email Anda</h2>
        <p>Terima kasih telah mendaftar di RainbowEdu. Gunakan kode OTP berikut untuk verifikasi akun Anda:</p>
        
        <div class="otp-box">
            {{ $otp }}
        </div>
        
        <p>Kode ini akan kadaluwarsa dalam 10 menit.</p>
        
        <p class="warning">JANGAN BERIKAN kode ini kepada siapa pun, termasuk pihak RainbowEdu.</p>
        
        <p>Jika Anda tidak merasa mendaftar, abaikan email ini.</p>
        
        <hr>
        <footer>
            <p>© {{ date('Y') }} RainbowEdu. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>