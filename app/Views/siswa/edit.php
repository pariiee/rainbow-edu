<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Siswa</h2>

<form action="/siswa/<?= $siswa['id_siswa'] ?>" method="post">
    <?= csrf_field() ?>

    <input type="text" name="nama_lengkap"
           value="<?= esc($siswa['nama_lengkap']) ?>" required><br>

    <select name="gender">
        <option value="Laki-laki" <?= $siswa['gender']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
        <option value="Perempuan" <?= $siswa['gender']=='Perempuan'?'selected':'' ?>>Perempuan</option>
    </select><br>

    <button type="submit">Update</button>
    <a href="/siswa">Batal</a>
</form>

<?= $this->endSection() ?>
