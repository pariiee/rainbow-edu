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

<h3>Data Orang Tua</h3>
<input type="text" name="nama_ayah" placeholder="Nama Ayah" value="<?= old('nama_ayah') ?>"><br>
<input type="text" name="nama_ibu" placeholder="Nama Ibu" value="<?= old('nama_ibu') ?>"><br>

<h3>Sumber Informasi</h3>
<label><input type="checkbox" name="sumber_informasi[]" value="Instagram"> Instagram</label>
<label><input type="checkbox" name="sumber_informasi[]" value="Google"> Google</label>
<label><input type="checkbox" name="sumber_informasi[]" value="Teman"> Teman</label>

<h3>Consent Konten</h3>
<label><input type="radio" name="consent_konten" value="Ya" <?= old('consent_konten')=='Ya'?'checked':'' ?> required> Ya</label>
<label><input type="radio" name="consent_konten" value="Tidak" <?= old('consent_konten')=='Tidak'?'checked':'' ?>> Tidak</label>

<br><br>
<button type="submit">Simpan</button>
<a href="/siswa">Kembali</a>

</form>

<?= $this->endSection() ?>
