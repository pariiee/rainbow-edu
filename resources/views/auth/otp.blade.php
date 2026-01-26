<x-guest-layout>
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
</x-guest-layout>
