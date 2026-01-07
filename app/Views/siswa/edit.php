<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Siswa</h2>

<form action="/siswa/<?= $siswa['id_siswa'] ?>" method="post">
    <?= csrf_field() ?>

    <h3>Data Siswa</h3>
    <input type="text" name="nama_lengkap"
           placeholder="Nama Lengkap"
           value="<?= esc($siswa['nama_lengkap']) ?>" required><br>

    <input type="text" name="nama_panggilan"
           placeholder="Nama Panggilan"
           value="<?= esc($siswa['nama_panggilan'] ?? '') ?>"><br>

    <input type="date" name="tanggal_lahir"
           value="<?= esc($siswa['tanggal_lahir'] ?? '') ?>"><br>

    <select name="gender" required>
        <option value="">-- Pilih Gender --</option>
        <option value="Laki-laki" <?= $siswa['gender']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
        <option value="Perempuan" <?= $siswa['gender']=='Perempuan'?'selected':'' ?>>Perempuan</option>
    </select><br>

    <input type="text" name="agama"
           placeholder="Agama"
           value="<?= esc($siswa['agama'] ?? '') ?>"><br>

    <input type="number" name="anak_ke"
           placeholder="Anak ke"
           value="<?= esc($siswa['anak_ke'] ?? '') ?>"><br>

    <textarea name="alamat"
              placeholder="Alamat"><?= esc($siswa['alamat'] ?? '') ?></textarea><br>

    <input type="text" name="kewarganegaraan"
           placeholder="Kewarganegaraan"
           value="<?= esc($siswa['kewarganegaraan'] ?? '') ?>"><br>

    <hr>

    <h3>Data Orang Tua / Wali</h3>
    <input type="text" name="nama_ayah"
           placeholder="Nama Ayah"
           value="<?= esc($detail['nama_ayah'] ?? '') ?>"><br>

    <input type="text" name="pekerjaan_ayah"
           placeholder="Pekerjaan Ayah"
           value="<?= esc($detail['pekerjaan_ayah'] ?? '') ?>"><br>

    <input type="text" name="nohp_ayah"
           placeholder="No HP Ayah"
           value="<?= esc($detail['nohp_ayah'] ?? '') ?>"><br><br>

    <input type="text" name="nama_ibu"
           placeholder="Nama Ibu"
           value="<?= esc($detail['nama_ibu'] ?? '') ?>"><br>

    <input type="text" name="pekerjaan_ibu"
           placeholder="Pekerjaan Ibu"
           value="<?= esc($detail['pekerjaan_ibu'] ?? '') ?>"><br>

    <input type="text" name="nohp_ibu"
           placeholder="No HP Ibu"
           value="<?= esc($detail['nohp_ibu'] ?? '') ?>"><br><br>

    <textarea name="alamat_ortu_wali"
              placeholder="Alamat Orang Tua / Wali"><?= esc($detail['alamat_ortu_wali'] ?? '') ?></textarea><br>

    <hr>

    <h3>Data Tambahan</h3>
    <input type="number" name="jumlah_saudara_kandung"
           placeholder="Jumlah Saudara Kandung"
           value="<?= esc($detail['jumlah_saudara_kandung'] ?? '') ?>"><br>

    <input type="text" name="bahasa"
           placeholder="Bahasa Sehari-hari"
           value="<?= esc($detail['bahasa'] ?? '') ?>"><br>

    <hr>

    <h3>Sumber Informasi</h3>
    <?php
        $sumber = isset($detail['sumber_informasi'])
            ? explode(',', $detail['sumber_informasi'])
            : [];
    ?>

    <label>
        <input type="checkbox" name="sumber_informasi[]" value="Instagram"
            <?= in_array('Instagram', $sumber) ? 'checked' : '' ?>>
        Instagram
    </label>

    <label>
        <input type="checkbox" name="sumber_informasi[]" value="Google"
            <?= in_array('Google', $sumber) ? 'checked' : '' ?>>
        Google
    </label>

    <label>
        <input type="checkbox" name="sumber_informasi[]" value="Teman"
            <?= in_array('Teman', $sumber) ? 'checked' : '' ?>>
        Teman
    </label>

    <hr>

    <h3>Consent Konten</h3>
    <label>
        <input type="radio" name="consent_konten" value="Ya"
            <?= ($detail['consent_konten'] ?? '')=='Ya'?'checked':'' ?> required>
        Ya
    </label>

    <label>
        <input type="radio" name="consent_konten" value="Tidak"
            <?= ($detail['consent_konten'] ?? '')=='Tidak'?'checked':'' ?>>
        Tidak
    </label>

    <br><br>
    <button type="submit">Update</button>
    <a href="/siswa">Batal</a>
</form>

<?= $this->endSection() ?>
