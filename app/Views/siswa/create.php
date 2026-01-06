<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
</head>
<body>

<h2>Form Data Siswa</h2>

<form action="/siswa/store" method="post">

    <h3>Data Siswa</h3>
    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required><br>
    <input type="text" name="nama_panggilan" placeholder="Nama Panggilan"><br>
    <input type="date" name="tanggal_lahir"><br>

    <select name="gender">
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select><br>

    <input type="text" name="agama" placeholder="Agama"><br>
    <input type="number" name="anak_ke" placeholder="Anak ke"><br>
    <textarea name="alamat" placeholder="Alamat"></textarea><br>
    <input type="text" name="kewarganegaraan" placeholder="Kewarganegaraan"><br>

    <h3>Data Orang Tua</h3>
    <input type="text" name="nama_ayah" placeholder="Nama Ayah"><br>
    <input type="text" name="nama_ibu" placeholder="Nama Ibu"><br>

    <h3>Sumber Informasi</h3>
    <input type="checkbox" name="sumber_informasi[]" value="Instagram"> Instagram
    <input type="checkbox" name="sumber_informasi[]" value="Google"> Google
    <input type="checkbox" name="sumber_informasi[]" value="Teman"> Teman<br>

    <h3>Consent Konten</h3>
    <input type="radio" name="consent_konten" value="Ya" required> Ya
    <input type="radio" name="consent_konten" value="Tidak"> Tidak<br><br>

    <button type="submit">Simpan</button>

</form>

</body>
</html>
