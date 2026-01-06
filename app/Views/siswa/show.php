<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Siswa</h2>

<p><strong>Nama:</strong> <?= esc($siswa['nama_lengkap']) ?></p>
<p><strong>Gender:</strong> <?= esc($siswa['gender']) ?></p>

<a href="/siswa">Kembali</a>

<?= $this->endSection() ?>
