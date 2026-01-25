<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SPMB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-green-600 to-green-700 text-white">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <i class="fas fa-chalkboard-teacher text-3xl mr-3"></i>
                    <div>
                        <h2 class="text-xl font-bold">Portal Guru</h2>
                        <p class="text-sm text-green-200">SPMB Portal</p>
                    </div>
                </div>
                
                <nav class="space-y-2">
                    <a href="#" class="flex items-center px-4 py-3 bg-green-800 rounded-lg">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-green-800 rounded-lg transition">
                        <i class="fas fa-clipboard-list mr-3"></i>
                        Daftar Pendaftar
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-green-800 rounded-lg transition">
                        <i class="fas fa-tasks mr-3"></i>
                        Penilaian
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-green-800 rounded-lg transition">
                        <i class="fas fa-file-alt mr-3"></i>
                        Review Berkas
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-green-800 rounded-lg transition">
                        <i class="fas fa-calendar mr-3"></i>
                        Jadwal
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-3 hover:bg-green-800 rounded-lg transition">
                        <i class="fas fa-arrow-left mr-3"></i>
                        Kembali ke Home
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center px-8 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Penilai</h1>
                    <div class="flex items-center space-x-4">
                        <button class="relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">5</span>
                        </button>
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Guru&background=16a34a&color=fff" class="w-10 h-10 rounded-full" alt="Guru">
                            <div>
                                <p class="font-semibold text-gray-800">Dr. Budi Santoso</p>
                                <p class="text-sm text-gray-500">Penilai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Pendaftar</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">156</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-lg">
                                <i class="fas fa-users text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mt-4">
                            <i class="fas fa-info-circle"></i> Di bawah review Anda
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Belum Dinilai</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">32</p>
                            </div>
                            <div class="bg-orange-100 p-4 rounded-lg">
                                <i class="fas fa-hourglass-half text-orange-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-orange-600 text-sm mt-4">
                            <i class="fas fa-exclamation-triangle"></i> Segera tindak lanjut
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Sudah Dinilai</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">124</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg">
                                <i class="fas fa-check-double text-green-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-green-600 text-sm mt-4">
                            <i class="fas fa-chart-line"></i> 79% selesai
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Rata-rata Nilai</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">82.5</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <i class="fas fa-star text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-purple-600 text-sm mt-4">
                            <i class="fas fa-trophy"></i> Kualitas baik
                        </p>
                    </div>
                </div>

                <!-- Pending Reviews -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Menunggu Penilaian</h3>
                        <a href="#" class="text-green-600 hover:text-green-700 text-sm font-semibold">Lihat Semua →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pendaftaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program Studi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Berkas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">PMB2024001</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi" class="w-8 h-8 rounded-full mr-3" alt="">
                                            <span class="text-sm font-medium text-gray-900">Ahmad Fauzi</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Teknik Informatika</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Lengkap</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-edit mr-1"></i> Nilai
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">PMB2024002</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza" class="w-8 h-8 rounded-full mr-3" alt="">
                                            <span class="text-sm font-medium text-gray-900">Siti Nurhaliza</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Sistem Informasi</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Review</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-edit mr-1"></i> Nilai
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">PMB2024003</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="https://ui-avatars.com/api/?name=Rudi+Hermawan" class="w-8 h-8 rounded-full mr-3" alt="">
                                            <span class="text-sm font-medium text-gray-900">Rudi Hermawan</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Teknik Elektro</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Lengkap</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-edit mr-1"></i> Nilai
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>