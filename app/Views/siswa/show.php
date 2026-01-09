<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Siswa</h2>

<h3>Data Siswa</h3>
<p><strong>Nama Lengkap:</strong> <?= esc($siswa['nama_lengkap']) ?></p>
<p><strong>Nama Panggilan:</strong> <?= esc($siswa['nama_panggilan'] ?? '-') ?></p>
<p><strong>Tanggal Lahir:</strong> <?= esc($siswa['tanggal_lahir'] ?? '-') ?></p>
<p><strong>Gender:</strong> <?= esc($siswa['gender']) ?></p>
<p><strong>Agama:</strong> <?= esc($siswa['agama'] ?? '-') ?></p>
<p><strong>Kewarganegaraan:</strong> <?= esc($siswa['kewarganegaraan'] ?? '-') ?></p>
<p><strong>Anak Ke:</strong> <?= esc($siswa['anak_ke'] ?? '-') ?></p>
<p><strong>Alamat:</strong> <?= esc($siswa['alamat'] ?? '-') ?></p>

<hr>

<h3>Data Orang Tua / Wali</h3>
<p><strong>Nama Ayah:</strong> <?= esc($detail['nama_ayah'] ?? '-') ?></p>
<p><strong>Pekerjaan Ayah:</strong> <?= esc($detail['pekerjaan_ayah'] ?? '-') ?></p>
<p><strong>No HP Ayah:</strong> <?= esc($detail['nohp_ayah'] ?? '-') ?></p>

<p><strong>Nama Ibu:</strong> <?= esc($detail['nama_ibu'] ?? '-') ?></p>
<p><strong>Pekerjaan Ibu:</strong> <?= esc($detail['pekerjaan_ibu'] ?? '-') ?></p>
<p><strong>No HP Ibu:</strong> <?= esc($detail['nohp_ibu'] ?? '-') ?></p>

<p><strong>Alamat Orang Tua / Wali:</strong><br>
<?= esc($detail['alamat_ortu_wali'] ?? '-') ?></p>

<hr>

<h3>Data Tambahan</h3>
<p><strong>Jumlah Saudara Kandung:</strong>
    <?= esc($detail['jumlah_saudara_kandung'] ?? '-') ?></p>

<p><strong>Bahasa Sehari-hari:</strong>
    <?= esc($detail['bahasa'] ?? '-') ?></p>

<p><strong>Sumber Informasi:</strong>
    <?= esc($detail['sumber_informasi'] ?? '-') ?></p>

<p><strong>Consent Konten:</strong>
    <?= esc($detail['consent_konten'] ?? '-') ?></p>

<hr>

<a href="/siswa">Kembali</a> |
<a href="/siswa/<?= $siswa['id_siswa'] ?>/edit">Edit</a>

<?= $this->endSection() ?>
