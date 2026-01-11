<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl shadow-lg p-6">
            <h2 class="text-3xl font-bold text-white flex items-center">
                <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Tambah Siswa Baru
            </h2>
            <p class="text-blue-100 mt-2">Lengkapi formulir di bawah ini dengan data siswa yang akurat</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-b-xl shadow-lg p-8">
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-red-800 mb-2">Terjadi kesalahan validasi:</h3>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <form action="/siswa" method="post" class="space-y-8">
                <?= csrf_field() ?>

                <!-- Section: Data Siswa -->
                <div>
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="ml-4 text-xl font-semibold text-gray-800">Data Siswa</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_lengkap" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan nama lengkap" 
                                   value="<?= old('nama_lengkap') ?>" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Panggilan</label>
                            <input type="text" name="nama_panggilan" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan nama panggilan" 
                                   value="<?= old('nama_panggilan') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="<?= old('tanggal_lahir') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select name="gender" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                                <option value="">-- Pilih Gender --</option>
                                <option value="Laki-laki" <?= old('gender')=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= old('gender')=='Perempuan'?'selected':'' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                            <input type="text" name="agama" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan agama" 
                                   value="<?= old('agama') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Anak Ke</label>
                            <input type="number" name="anak_ke" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Contoh: 1" 
                                   value="<?= old('anak_ke') ?>">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" 
                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                  placeholder="Masukkan alamat lengkap"><?= old('alamat') ?></textarea>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                               placeholder="Contoh: Indonesia" 
                               value="<?= old('kewarganegaraan') ?>">
                    </div>
                </div>

                <!-- Section: Data Orang Tua / Wali -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="ml-4 text-xl font-semibold text-gray-800">Data Orang Tua / Wali</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah</label>
                            <input type="text" name="nama_ayah" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan nama ayah" 
                                   value="<?= old('nama_ayah') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan pekerjaan ayah" 
                                   value="<?= old('pekerjaan_ayah') ?>">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">No HP Ayah</label>
                        <input type="text" name="nohp_ayah" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                               placeholder="Contoh: 081234567890" 
                               value="<?= old('nohp_ayah') ?>">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
                            <input type="text" name="nama_ibu" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan nama ibu" 
                                   value="<?= old('nama_ibu') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Masukkan pekerjaan ibu" 
                                   value="<?= old('pekerjaan_ibu') ?>">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">No HP Ibu</label>
                        <input type="text" name="nohp_ibu" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                               placeholder="Contoh: 081234567890" 
                               value="<?= old('nohp_ibu') ?>">
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Orang Tua / Wali</label>
                        <textarea name="alamat_ortu_wali" rows="3" 
                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                  placeholder="Masukkan alamat lengkap orang tua / wali"><?= old('alamat_ortu_wali') ?></textarea>
                    </div>
                </div>

                <!-- Section: Data Tambahan -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="ml-4 text-xl font-semibold text-gray-800">Data Tambahan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Saudara Kandung</label>
                            <input type="number" name="jumlah_saudara_kandung" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Contoh: 2" 
                                   value="<?= old('jumlah_saudara_kandung') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa Sehari-hari</label>
                            <input type="text" name="bahasa" 
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   placeholder="Contoh: Indonesia, Jawa" 
                                   value="<?= old('bahasa') ?>">
                        </div>
                    </div>
                </div>

                <!-- Section: Sumber Informasi -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="ml-4 text-xl font-semibold text-gray-800">Sumber Informasi</h3>
                    </div>

                    <div class="space-y-3">
                        <?php $oldSumber = old('sumber_informasi') ?? []; ?>
                        
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                            <input type="checkbox" name="sumber_informasi[]" value="Instagram" 
                                   class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                                   <?= in_array('Instagram', $oldSumber) ? 'checked' : '' ?>>
                            <span class="ml-3 text-gray-700 font-medium">Instagram</span>
                        </label>
                        
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                            <input type="checkbox" name="sumber_informasi[]" value="Google" 
                                   class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                                   <?= in_array('Google', $oldSumber) ? 'checked' : '' ?>>
                            <span class="ml-3 text-gray-700 font-medium">Google</span>
                        </label>
                        
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                            <input type="checkbox" name="sumber_informasi[]" value="Teman" 
                                   class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                                   <?= in_array('Teman', $oldSumber) ? 'checked' : '' ?>>
                            <span class="ml-3 text-gray-700 font-medium">Teman</span>
                        </label>
                    </div>
                </div>

                <!-- Section: Consent Konten -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="ml-4 text-xl font-semibold text-gray-800">Consent Konten</h3>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <p class="text-sm text-blue-800">Apakah Anda mengizinkan foto/video anak Anda digunakan untuk keperluan dokumentasi dan promosi sekolah?</p>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                            <input type="radio" name="consent_konten" value="Ya" 
                                   class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" 
                                   <?= old('consent_konten')=='Ya'?'checked':'' ?> required>
                            <span class="ml-3 text-gray-700 font-medium">Ya, saya mengizinkan</span>
                        </label>
                        
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition duration-200">
                            <input type="radio" name="consent_konten" value="Tidak" 
                                   class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" 
                                   <?= old('consent_konten')=='Tidak'?'checked':'' ?>>
                            <span class="ml-3 text-gray-700 font-medium">Tidak, saya tidak mengizinkan</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="/siswa" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-md hover:shadow-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>