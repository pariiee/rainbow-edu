<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMB - Sistem Penerimaan Mahasiswa Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-3xl text-indigo-600 mr-3"></i>
                    <span class="text-2xl font-bold text-gray-800">SPMB Portal</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#tentang" class="text-gray-700 hover:text-indigo-600 transition">Tentang</a>
                    <a href="#fitur" class="text-gray-700 hover:text-indigo-600 transition">Fitur</a>
                    <a href="#kontak" class="text-gray-700 hover:text-indigo-600 transition">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="py-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
                Selamat Datang di <span class="text-indigo-600">SPMB Portal</span>
            </h1>
            <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto">
                Sistem Penerimaan Mahasiswa Baru yang terintegrasi untuk memudahkan proses pendaftaran dan seleksi
            </p>
        </div>
    </section>

    <section class="py-16 px-4" id="fitur">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Pilih Portal Anda</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-105 hover:shadow-2xl">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 p-8 text-white">
                        <i class="fas fa-user-shield text-6xl mb-4"></i>
                        <h3 class="text-3xl font-bold">Admin</h3>
                    </div>
                    <div class="p-8">
                        <p class="text-gray-600 mb-6">Kelola seluruh sistem SPMB, pengaturan, dan monitoring</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Manajemen pengguna</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Konfigurasi sistem</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Laporan dan analitik</span>
                            </li>
                        </ul>
                        <a href="{{ route('admin.dashboard') }}" class="block w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                            Portal Admin
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-105 hover:shadow-2xl">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-8 text-white">
                        <i class="fas fa-chalkboard-teacher text-6xl mb-4"></i>
                        <h3 class="text-3xl font-bold">Guru</h3>
                    </div>
                    <div class="p-8">
                        <p class="text-gray-600 mb-6">Evaluasi dan seleksi calon mahasiswa baru</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Review pendaftaran</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Penilaian berkas</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Input nilai seleksi</span>
                            </li>
                        </ul>
                        <a href="{{ route('guru.dashboard') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                            Portal Guru
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-105 hover:shadow-2xl">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-8 text-white">
                        <i class="fas fa-user-graduate text-6xl mb-4"></i>
                        <h3 class="text-3xl font-bold">Siswa</h3>
                    </div>
                    <div class="p-8">
                        <p class="text-gray-600 mb-6">Daftar dan ikuti proses seleksi mahasiswa baru</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Pendaftaran online</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Upload dokumen</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Tracking status</span>
                            </li>
                        </ul>
                        <a href="{{ route('siswa.dashboard') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                            Portal Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12 px-4 mt-16">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2024 SPMB Portal. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>