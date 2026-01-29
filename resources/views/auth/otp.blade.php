<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <form method="POST" action="{{ route('otp.verify.post') }}">
        @csrf

        <div>
            <x-input-label value="Masukkan Kode OTP" />
            <x-text-input name="otp" type="text" maxlength="6" required autofocus />
            <x-input-error :messages="$errors->get('otp')" />
        </div>

        <x-primary-button class="mt-4">
            Verifikasi
        </x-primary-button>
    </form>
</body>
</html>
