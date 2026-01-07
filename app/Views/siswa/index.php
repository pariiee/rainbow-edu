<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Siswa</h2>

<a href="/siswa/create">+ Tambah Siswa</a>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Gender</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($siswa as $i => $row) : ?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= esc($row['nama_lengkap']) ?></td>
        <td><?= esc($row['gender']) ?></td>
<td>
    <a href="/siswa/<?= $row['id_siswa'] ?>">Detail</a>
    <a href="/siswa/<?= $row['id_siswa'] ?>/edit">Edit</a>

    <form action="/siswa/<?= $row['id_siswa'] ?>/delete" method="post" style="display:inline">
        <?= csrf_field() ?>
        <button type="submit" onclick="return confirm('Hapus data?')">
            Hapus
        </button>
    </form>
</td>

    </tr>
    <?php endforeach ?>
</table>

<?= $this->endSection() ?>
