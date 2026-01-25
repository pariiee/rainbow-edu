<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SPMB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-3xl text-blue-600 mr-3"></i>
                    <span class="text-xl font-bold text-gray-800">Portal Siswa SPMB</span>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
                    </button>
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Siswa&background=2563eb&color=fff" class="w-10 h-10 rounded-full" alt="Siswa">
                        <div>
                            <p class="font-semibold text-gray-800">Budi Prasetyo</p>
                            <p class="text-sm text-gray-500">PMB2024123</p>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, Budi!</h1>
                    <p class="text-blue-100">Pantau proses pendaftaran Anda dan lengkapi data yang diperlukan</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-user-graduate text-8xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Progress Status -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Status Pendaftaran</h2>
            
            <div class="relative">
                <div class="overflow-hidden h-2 mb-8 text-xs flex rounded-full bg-blue-100">
                    <div style="width:60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600 transition-all duration-500"></div>
                </div>
                
                <div class="grid grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-blue-600 rounded-full flex items-center justify-center text-white mb-2">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">Registrasi</p>
                        <p class="text-xs text-green-600">Selesai</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-blue-600 rounded-full flex items-center justify-center text-white mb-2">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">Data Diri</p>
                        <p class="text-xs text-green-600">Selesai</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-blue-600 rounded-full flex items-center justify-center text-white mb-2 animate-pulse">
                            <i class="fas fa-upload"></i>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">Upload Berkas</p>
                        <p class="text-xs text-yellow-600">Proses</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto bg-gray-300 rounded-full flex items-center justify-center text-white mb-2">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">Verifikasi</p>
                        <p class="text-xs text-gray-500">Menunggu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Info Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <!-- Quick Actions -->
            <div class="md:col-span-2 bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button class="bg-blue-50 hover:bg-blue-100 p-4 rounded-xl text-left transition group">
                        <i class="fas fa-edit text-2xl text-blue-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="font-semibold text-gray-800">Lengkapi Data</p>
                        <p class="text-xs text-gray-500">Update informasi pribadi</p>
                    </button>
                    <button class="bg-green-50 hover:bg-green-100 p-4 rounded-xl text-left transition group">
                        <i class="fas fa-cloud-upload-alt text-2xl text-green-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="font-semibold text-gray-800">Upload Dokumen</p>
                        <p class="text-xs text-gray-500">Unggah berkas pendukung</p>
                    </button>
                    <button class="bg-purple-50 hover:bg-purple-100 p-4 rounded-xl text-left transition group">
                        <i class="fas fa-file-download text-2xl text-purple-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="font-semibold text-gray-800">Cetak Kartu</p>
                        <p class="text-xs text-gray-500">Download kartu pendaftaran</p>
                    </button>
                    <button class="bg-orange-50 hover:bg-orange-100 p-4 rounded-xl text-left transition group">
                        <i class="fas fa-question-circle text-2xl text-orange-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <p class="font-semibold text-gray-800">Bantuan</p>
                        <p class="text-xs text-gray-500">FAQ & Panduan</p>
                    </button>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-md p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Informasi Penting</h3>
                <div class="space-y-4">
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <p class="text-sm font-semibold mb-1">Batas Pendaftaran</p>
                        <p class="text-xs">31 Desember 2024</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <p class="text-sm font-semibold mb-1">Pengumuman</p>
                        <p class="text-xs">15 Januari 2025</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <p class="text-sm font-semibold mb-1">Contact Center</p>
                        <p class="text-xs">(021) 1234-5678</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Upload Status -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Status Dokumen</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 text-2xl mr-4"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Foto 4x6</p>
                            <p class="text-sm text-gray-500">Diupload 2 hari yang lalu</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Disetujui</span>
                </div>
                
                <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 text-2xl mr-4"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Ijazah SMA</p>
                            <p class="text-sm text-gray-500">Diupload 2 hari yang lalu</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Disetujui</span>
                </div>
                
                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-yellow-600 text-2xl mr-4"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Transkrip Nilai</p>
                            <p class="text-sm text-gray-500">Menunggu verifikasi</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Review</span>
                </div>
                
                <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-600 text-2xl mr-4"></i>
                        <div>
                            <p class="font-semibold text-gray-800">KTP/Kartu Pelajar</p>
                            <p class="text-sm text-gray-500">Belum diupload</p>
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition">
                        Upload
                    </button>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Timeline Aktivitas</h3>
            <div class="space-y-4">
                <div class="flex">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                        <div class="w-0.5 h-full bg-blue-200"></div>
                    </div>
                    <div class="pb-8">
                        <p class="font-semibold text-gray-800">Berkas diupload</p>
                        <p class="text-sm text-gray-500">Transkrip nilai berhasil diupload</p>
                        <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                        <div class="w-0.5 h-full bg-blue-200"></div>
                    </div>
                    <div class="pb-8">
                        <p class="font-semibold text-gray-800">Dokumen diverifikasi</p>
                        <p class="text-sm text-gray-500">Ijazah SMA telah disetujui</p>
                        <p class="text-xs text-gray-400 mt-1">2 hari yang lalu</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex flex-col items-center mr-4">
                        <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Data diri dilengkapi</p>
                        <p class="text-sm text-gray-500">Informasi pribadi berhasil disimpan</p>
                        <p class="text-xs text-gray-400 mt-1">3 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
                                