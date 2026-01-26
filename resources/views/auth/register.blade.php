<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role_type" :value="__('Daftar Sebagai')" />
            <select id="role_type" name="role_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required onchange="toggleFields()">
                <option value="orang_tua" {{ old('role_type', 'orang_tua') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                <option value="guru" {{ old('role_type') == 'guru' ? 'selected' : '' }}>Guru</option>
            </select>
            <x-input-error :messages="$errors->get('role_type')" class="mt-2" />
        </div>

        <!-- Nama Anak (hanya untuk orang tua) -->
        <div id="nama_anak_field" class="mt-4">
            <x-input-label for="nama_anak" :value="__('Nama Anak')" class="required-field" />
            <x-text-input id="nama_anak" class="block mt-1 w-full" type="text" name="nama_anak" :value="old('nama_anak')" />
            <x-input-error :messages="$errors->get('nama_anak')" class="mt-2" />
        </div>

        <!-- Divisi Guru (hanya untuk guru) -->
        <div id="guru_type_field" class="mt-4" style="display: none;">
            <x-input-label for="guru_type" :value="__('Divisi Guru')" class="required-field" />
            <select id="guru_type" name="guru_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Pilih Divisi</option>
                <option value="PAUD" {{ old('guru_type') == 'PAUD' ? 'selected' : '' }}>PAUD</option>
                <option value="Learn kursus" {{ old('guru_type') == 'Learn kursus' ? 'selected' : '' }}>Learn kursus</option>
                <option value="Homelearning kursus private" {{ old('guru_type') == 'Homelearning kursus private' ? 'selected' : '' }}>Homelearning kursus private</option>
            </select>
            <x-input-error :messages="$errors->get('guru_type')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Fungsi untuk menampilkan/menyembunyikan field berdasarkan role
        function toggleFields() {
            const roleType = document.getElementById('role_type').value;
            const namaAnakField = document.getElementById('nama_anak_field');
            const guruTypeField = document.getElementById('guru_type_field');
            const namaAnakInput = document.getElementById('nama_anak');
            const guruTypeInput = document.getElementById('guru_type');

            if (roleType === 'orang_tua') {
                // Tampilkan nama anak, sembunyikan divisi guru
                namaAnakField.style.display = 'block';
                guruTypeField.style.display = 'none';
                
                // Set required
                namaAnakInput.required = true;
                guruTypeInput.required = false;
                
                // Clear divisi guru jika ada
                guruTypeInput.value = '';
            } else {
                // Tampilkan divisi guru, sembunyikan nama anak
                namaAnakField.style.display = 'none';
                guruTypeField.style.display = 'block';
                
                // Set required
                namaAnakInput.required = false;
                guruTypeInput.required = true;
                
                // Clear nama anak jika ada
                namaAnakInput.value = '';
            }
        }

        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi field berdasarkan role yang dipilih
            toggleFields();
            
            // Validasi Nama Anak hanya huruf dan simbol
            document.getElementById('nama_anak').addEventListener('input', function(e) {
                // Hanya memperbolehkan huruf, spasi, titik, koma, tanda kutip, dan tanda hubung
                this.value = this.value.replace(/[^a-zA-Z\s.,'"-]/g, '');
            });
            
            // Validasi form sebelum submit
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                const roleType = document.getElementById('role_type').value;
                const guruType = document.getElementById('guru_type').value;
                const namaAnak = document.getElementById('nama_anak').value;
                
                if (roleType === 'orang_tua') {
                    // Validasi Nama Anak harus diisi
                    if (!namaAnak.trim()) {
                        e.preventDefault();
                        alert('Nama Anak harus diisi untuk pendaftaran sebagai Orang Tua');
                        document.getElementById('nama_anak').focus();
                        return false;
                    }
                } else if (roleType === 'guru') {
                    // Validasi Divisi Guru harus dipilih
                    if (!guruType) {
                        e.preventDefault();
                        alert('Divisi Guru harus dipilih');
                        document.getElementById('guru_type').focus();
                        return false;
                    }
                }
            });
        });

        // Fungsi untuk menampilkan pesan error dari server
        window.onload = function() {
            @if($errors->has('guru_type'))
                // Jika ada error di divisi guru, tampilkan field divisi guru
                document.getElementById('guru_type_field').style.display = 'block';
                document.getElementById('nama_anak_field').style.display = 'none';
            @endif
            
            @if($errors->has('nama_anak'))
                // Jika ada error di nama anak, tampilkan field nama anak
                document.getElementById('nama_anak_field').style.display = 'block';
                document.getElementById('guru_type_field').style.display = 'none';
            @endif
        };
    </script>

    <style>
        /* Styling untuk validasi */
        .required-field::after {
            content: " *";
            color: #ef4444;
        }
        
        /* Smooth transition untuk field */
        #nama_anak_field, #guru_type_field {
            transition: all 0.3s ease;
        }
    </style>
</x-guest-layout>