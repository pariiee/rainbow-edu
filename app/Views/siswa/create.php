<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.container-form {
    max-width: 800px;
    margin: 30px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.form-title {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 3px solid #3498db;
}

.section-title {
    color: #34495e;
    font-size: 18px;
    margin: 25px 0 15px 0;
    padding-bottom: 8px;
    border-bottom: 2px solid #ecf0f1;
}

.error-box {
    background: #ffe6e6;
    border-left: 4px solid #e74c3c;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.error-box ul {
    margin: 0;
    padding-left: 20px;
    color: #c0392b;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    color: #555;
    font-weight: 500;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    transition: border-color 0.3s;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

textarea.form-control {
    min-height: 80px;
    resize: vertical;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.checkbox-group, .radio-group {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.checkbox-group label, .radio-group label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: 400;
}

.checkbox-group input[type="checkbox"],
.radio-group input[type="radio"] {
    margin-right: 6px;
    cursor: pointer;
}

.btn-group {
    display: flex;
    gap: 12px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #ecf0f1;
}

.btn {
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s;
}

.btn-primary {
    background: #3498db;
    color: white;
}

.btn-primary:hover {
    background: #2980b9;
}

.btn-secondary {
    background: #95a5a6;
    color: white;
}

.btn-secondary:hover {
    background: #7f8c8d;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .container-form {
        padding: 20px;
        margin: 15px;
    }
}
</style>

<div class="container-form">
    <h2 class="form-title">Tambah Siswa</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="error-box">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="/siswa" method="post">
        <?= csrf_field() ?>

        <h3 class="section-title">Data Siswa</h3>
        
        <div class="form-row">
            <div class="form-group">
                <label>Nama Lengkap <span style="color:red">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?= old('nama_lengkap') ?>" required>
            </div>
            
            <div class="form-group">
                <label>Nama Panggilan</label>
                <input type="text" name="nama_panggilan" class="form-control" placeholder="Nama Panggilan" value="<?= old('nama_panggilan') ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir') ?>">
            </div>
            
            <div class="form-group">
                <label>Gender <span style="color:red">*</span></label>
                <select name="gender" class="form-control" required>
                    <option value="">-- Pilih Gender --</option>
                    <option value="Laki-laki" <?= old('gender')=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= old('gender')=='Perempuan'?'selected':'' ?>>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control" placeholder="Agama" value="<?= old('agama') ?>">
            </div>
            
            <div class="form-group">
                <label>Anak Ke</label>
                <input type="number" name="anak_ke" class="form-control" placeholder="Anak ke" value="<?= old('anak_ke') ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Alamat lengkap"><?= old('alamat') ?></textarea>
        </div>

        <div class="form-group">
            <label>Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control" placeholder="Kewarganegaraan" value="<?= old('kewarganegaraan') ?>">
        </div>

        <h3 class="section-title">Data Orang Tua / Wali</h3>
        
        <div class="form-row">
            <div class="form-group">
                <label>Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?= old('nama_ayah') ?>">
            </div>
            
            <div class="form-group">
                <label>Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" value="<?= old('pekerjaan_ayah') ?>">
            </div>
        </div>

        <div class="form-group">
            <label>No HP Ayah</label>
            <input type="text" name="nohp_ayah" class="form-control" placeholder="No HP Ayah" value="<?= old('nohp_ayah') ?>">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?= old('nama_ibu') ?>">
            </div>
            
            <div class="form-group">
                <label>Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" value="<?= old('pekerjaan_ibu') ?>">
            </div>
        </div>

        <div class="form-group">
            <label>No HP Ibu</label>
            <input type="text" name="nohp_ibu" class="form-control" placeholder="No HP Ibu" value="<?= old('nohp_ibu') ?>">
        </div>

        <div class="form-group">
            <label>Alamat Orang Tua / Wali</label>
            <textarea name="alamat_ortu_wali" class="form-control" placeholder="Alamat lengkap orang tua / wali"><?= old('alamat_ortu_wali') ?></textarea>
        </div>

        <h3 class="section-title">Data Tambahan</h3>

        <div class="form-row">
            <div class="form-group">
                <label>Jumlah Saudara Kandung</label>
                <input type="number" name="jumlah_saudara_kandung" class="form-control" placeholder="Jumlah Saudara Kandung" value="<?= old('jumlah_saudara_kandung') ?>">
            </div>
            
            <div class="form-group">
                <label>Bahasa Sehari-hari</label>
                <input type="text" name="bahasa" class="form-control" placeholder="Bahasa Sehari-hari" value="<?= old('bahasa') ?>">
            </div>
        </div>

        <h3 class="section-title">Sumber Informasi</h3>
        
        <div class="form-group">
            <div class="checkbox-group">
                <?php $oldSumber = old('sumber_informasi') ?? []; ?>
                
                <label>
                    <input type="checkbox" name="sumber_informasi[]" value="Instagram" <?= in_array('Instagram', $oldSumber) ? 'checked' : '' ?>>
                    Instagram
                </label>
                
                <label>
                    <input type="checkbox" name="sumber_informasi[]" value="Google" <?= in_array('Google', $oldSumber) ? 'checked' : '' ?>>
                    Google
                </label>
                
                <label>
                    <input type="checkbox" name="sumber_informasi[]" value="Teman" <?= in_array('Teman', $oldSumber) ? 'checked' : '' ?>>
                    Teman
                </label>
            </div>
        </div>

        <h3 class="section-title">Consent Konten</h3>
        
        <div class="form-group">
            <div class="radio-group">
                <label>
                    <input type="radio" name="consent_konten" value="Ya" <?= old('consent_konten')=='Ya'?'checked':'' ?> required>
                    Ya
                </label>
                
                <label>
                    <input type="radio" name="consent_konten" value="Tidak" <?= old('consent_konten')=='Tidak'?'checked':'' ?>>
                    Tidak
                </label>
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="/siswa" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>