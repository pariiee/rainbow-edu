<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SPMB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <aside class="w-64 bg-gradient-to-b from-red-600 to-red-700 text-white">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <i class="fas fa-user-shield text-3xl mr-3"></i>
                    <div>
                        <h2 class="text-xl font-bold">Admin Panel</h2>
                        <p class="text-sm text-red-200">SPMB Portal</p>
                    </div>
                </div>
                
                <nav class="space-y-2">
                    <a href="#" class="flex items-center px-4 py-3 bg-red-800 rounded-lg">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-red-800 rounded-lg transition">
                        <i class="fas fa-users mr-3"></i>
                        Manajemen User
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-red-800 rounded-lg transition">
                        <i class="fas fa-file-alt mr-3"></i>
                        Data Pendaftar
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-red-800 rounded-lg transition">
                        <i class="fas fa-cog mr-3"></i>
                        Pengaturan
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-red-800 rounded-lg transition">
                        <i class="fas fa-chart-bar mr-3"></i>
                        Laporan
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-3 hover:bg-red-800 rounded-lg transition">
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
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Administrator</h1>
                    <div class="flex items-center space-x-4">
                        <button class="relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=dc2626&color=fff" class="w-10 h-10 rounded-full" alt="Admin">
                            <div>
                                <p class="font-semibold text-gray-800">Admin User</p>
                                <p class="text-sm text-gray-500">Administrator</p>
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
                                <p class="text-3xl font-bold text-gray-800 mt-2">1,234</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-lg">
                                <i class="fas fa-users text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-green-600 text-sm mt-4">
                            <i class="fas fa-arrow-up"></i> +12% dari bulan lalu
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Menunggu Verifikasi</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">89</p>
                            </div>
                            <div class="bg-yellow-100 p-4 rounded-lg">
                                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-yellow-600 text-sm mt-4">
                            <i class="fas fa-exclamation-circle"></i> Perlu perhatian
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Diterima</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">456</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg">
                                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-green-600 text-sm mt-4">
                            <i class="fas fa-arrow-up"></i> 37% dari target
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Guru</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">24</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <i class="fas fa-chalkboard-teacher text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mt-4">
                            <i class="fas fa-users"></i> Penilai aktif
                        </p>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Pendaftaran</h3>
                        <div class="h-64 flex items-center justify-center text-gray-400">
                            <i class="fas fa-chart-line text-6xl"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Verifikasi</h3>
                        <div class="h-64 flex items-center justify-center text-gray-400">
                            <i class="fas fa-chart-pie text-6xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-user-plus text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Pendaftar baru</p>
                                    <p class="text-sm text-gray-500">Ahmad Fauzi mendaftar program Teknik Informatika</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-400">2 menit yang lalu</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Verifikasi selesai</p>
                                    <p class="text-sm text-gray-500">Siti Nurhaliza telah diverifikasi oleh Dr. Budi</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-400">15 menit yang lalu</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-file-upload text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Dokumen baru</p>
                                    <p class="text-sm text-gray-500">Rudi Hermawan mengupload transkrip nilai</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-400">1 jam yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>