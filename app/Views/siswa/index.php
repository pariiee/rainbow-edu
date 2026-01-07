<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Siswa</h2>

<a href="/siswa/create">+ Tambah Siswa</a>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Nama Panggilan</th>
        <th>Gender</th>
        <th>Tanggal Lahir</th>
        <th>Agama</th>
        <th>Aksi</th>
    </tr>

<?php if (empty($siswa)) : ?>
    <tr>
        <td colspan="7" style="text-align:center">
            Data siswa belum tersedia
        </td>
    </tr>
<?php else : ?>
    <?php foreach ($siswa as $i => $row) : ?>
    <tr>
        <td><?= $i + 1 ?></td>
        <td><?= esc($row['nama_lengkap']) ?></td>
        <td><?= esc($row['nama_panggilan'] ?? '-') ?></td>
        <td><?= esc($row['gender']) ?></td>
        <td><?= esc($row['tanggal_lahir'] ?? '-') ?></td>
        <td><?= esc($row['agama'] ?? '-') ?></td>
        <td>
            <a href="/siswa/<?= $row['id_siswa'] ?>">Detail</a> |
            <a href="/siswa/<?= $row['id_siswa'] ?>/edit">Edit</a>

            <form action="/siswa/<?= $row['id_siswa'] ?>/delete"
                  method="post"
                  style="display:inline">
                <?= csrf_field() ?>
                <button type="submit"
                        onclick="return confirm('Hapus data?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    <?php endforeach ?>
<?php endif ?>
</table>

<?= $this->endSection() ?>
