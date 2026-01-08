<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Tambah Siswa</h2>

<?php if (session()->getFlashdata('errors')) : ?>
    <ul style="color:red">
        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<form action="/siswa" method="post">
<?= csrf_field() ?>

<h3>Data Siswa</h3>
<input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap') ?>" required><br>
<input type="text" name="nama_panggilan" placeholder="Nama Panggilan" value="<?= old('nama_panggilan') ?>"><br>
<input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>"><br>

<select name="gender" required>
    <option value="">-- Pilih Gender --</option>
    <option value="Laki-laki" <?= old('gender')=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
    <option value="Perempuan" <?= old('gender')=='Perempuan'?'selected':'' ?>>Perempuan</option>
</select><br>

<input type="text" name="agama" placeholder="Agama" value="<?= old('agama') ?>"><br>
<input type="number" name="anak_ke" placeholder="Anak ke" value="<?= old('anak_ke') ?>"><br>
<textarea name="alamat" placeholder="Alamat"><?= old('alamat') ?></textarea><br>
<input type="text" name="kewarganegaraan" placeholder="Kewarganegaraan" value="<?= old('kewarganegaraan') ?>"><br>

<hr>

<h3>Data Orang Tua / Wali</h3>
<input type="text" name="nama_ayah" placeholder="Nama Ayah" value="<?= old('nama_ayah') ?>"><br>
<input type="text" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="<?= old('pekerjaan_ayah') ?>"><br>
<input type="text" name="nohp_ayah" placeholder="No HP Ayah" value="<?= old('nohp_ayah') ?>"><br><br>

<input type="text" name="nama_ibu" placeholder="Nama Ibu" value="<?= old('nama_ibu') ?>"><br>
<input type="text" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="<?= old('pekerjaan_ibu') ?>"><br>
<input type="text" name="nohp_ibu" placeholder="No HP Ibu" value="<?= old('nohp_ibu') ?>"><br><br>

<textarea name="alamat_ortu_wali" placeholder="Alamat Orang Tua / Wali"><?= old('alamat_ortu_wali') ?></textarea><br>

<hr>

<h3>Data Tambahan</h3>
<input type="number" name="jumlah_saudara_kandung"
       placeholder="Jumlah Saudara Kandung"
       value="<?= old('jumlah_saudara_kandung') ?>"><br>

<input type="text" name="bahasa"
       placeholder="Bahasa Sehari-hari"
       value="<?= old('bahasa') ?>"><br>

<hr>

<h3>Sumber Informasi</h3>
<?php $oldSumber = old('sumber_informasi') ?? []; ?>

<label>
    <input type="checkbox" name="sumber_informasi[]" value="Instagram"
        <?= in_array('Instagram', $oldSumber) ? 'checked' : '' ?>>
    Instagram
</label>

<label>
    <input type="checkbox" name="sumber_informasi[]" value="Google"
        <?= in_array('Google', $oldSumber) ? 'checked' : '' ?>>
    Google
</label>

<label>
    <input type="checkbox" name="sumber_informasi[]" value="Teman"
        <?= in_array('Teman', $oldSumber) ? 'checked' : '' ?>>
    Teman
</label>

<hr>

<h3>Consent Konten</h3>
<label>
    <input type="radio" name="consent_konten" value="Ya"
        <?= old('consent_konten')=='Ya'?'checked':'' ?> required>
    Ya
</label>

<label>
    <input type="radio" name="consent_konten" value="Tidak"
        <?= old('consent_konten')=='Tidak'?'checked':'' ?>>
    Tidak
</label>

<br><br>
<button type="submit">Simpan</button>
<a href="/siswa">Kembali</a>

</form>

<?= $this->endSection() ?>
