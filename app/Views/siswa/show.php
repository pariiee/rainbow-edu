<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-t-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-md">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h2 class="text-3xl font-bold text-white"><?= esc($siswa['nama_lengkap']) ?></h2>
                        <p class="text-indigo-100 mt-1">
                            <?= esc($siswa['nama_panggilan'] ?? 'Siswa') ?> • 
                            <?= esc($siswa['gender']) ?>
                        </p>
                    </div>
                </div>
                <div class="hidden md:block">
                    <span class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm text-white rounded-full text-sm font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Detail Lengkap
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-b-xl shadow-lg">
            <!-- Data Siswa Section -->
            <div class="p-8 border-b border-gray-200">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-xl font-semibold text-gray-800">Data Siswa</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Nama Lengkap</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['nama_lengkap']) ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Nama Panggilan</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['nama_panggilan'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Tanggal Lahir</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['tanggal_lahir'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Gender</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                            <?= $siswa['gender'] === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' ?>">
                            <?= esc($siswa['gender']) ?>
                        </span>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Agama</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['agama'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Kewarganegaraan</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['kewarganegaraan'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Anak Ke</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['anak_ke'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 md:col-span-2">
                        <p class="text-sm text-gray-600 mb-1">Alamat</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($siswa['alamat'] ?? '-') ?></p>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua / Wali Section -->
            <div class="p-8 border-b border-gray-200">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-xl font-semibold text-gray-800">Data Orang Tua / Wali</h3>
                </div>

                <!-- Data Ayah -->
                <div class="mb-6">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-gray-700">Data Ayah</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">Nama Ayah</p>
                            <p class="text-base font-semibold text-gray-900"><?= esc($detail['nama_ayah'] ?? '-') ?></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">Pekerjaan Ayah</p>
                            <p class="text-base font-semibold text-gray-900"><?= esc($detail['pekerjaan_ayah'] ?? '-') ?></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">No HP Ayah</p>
                            <p class="text-base font-semibold text-gray-900"><?= esc($detail['nohp_ayah'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Data Ibu -->
                <div class="mb-6">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-gray-700">Data Ibu</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">Nama Ibu</p>
                            <p class="text-base font-semibold text-gray-900"><?= esc($detail['nama_ibu'] ?? '-') ?></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">Pekerjaan Ibu</p>
                            <p class="text-base font-semibold text-gray-900"><?= esc($detail['pekerjaan_ibu'] ?? '-') ?></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <p class="text-sm text-gray-600 mb-1">No HP Ibu</p>
                            <p class="text-base font-semibold text-gray-900"><?= esc($detail['nohp_ibu'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Alamat Orang Tua -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <p class="text-sm text-gray-600 mb-1">Alamat Orang Tua / Wali</p>
                    <p class="text-base font-semibold text-gray-900"><?= esc($detail['alamat_ortu_wali'] ?? '-') ?></p>
                </div>
            </div>

            <!-- Data Tambahan Section -->
            <div class="p-8">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-xl font-semibold text-gray-800">Data Tambahan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Jumlah Saudara Kandung</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($detail['jumlah_saudara_kandung'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Bahasa Sehari-hari</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($detail['bahasa'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Sumber Informasi</p>
                        <p class="text-base font-semibold text-gray-900"><?= esc($detail['sumber_informasi'] ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Consent Konten</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                            <?= ($detail['consent_konten'] ?? '') === 'Ya' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                            <?= esc($detail['consent_konten'] ?? '-') ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 rounded-b-xl">
                <div class="flex items-center justify-between">
                    <a href="/siswa" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-white transition duration-200 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <a href="/siswa/<?= $siswa['id_siswa'] ?>/edit" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>