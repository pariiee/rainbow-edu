<!DOCTYPE html>
<html>
<head>
    <title>Form Siswa</title>
</head>
<body>

<h2>Form Intake Siswa (Sementara)</h2>

<form method="POST" action="/siswa">
    @csrf

    <h3>Identitas Siswa</h3>
    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required><br><br>
    <input type="text" name="nama_panggilan" placeholder="Nama Panggilan"><br><br>

    <input type="text" name="tempat_lahir" placeholder="Tempat Lahir"><br><br>
    <input type="date" name="tanggal_lahir"><br><br>

    <select name="gender" required>
        <option value="">-- Jenis Kelamin --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select><br><br>

    <input type="text" name="agama" placeholder="Agama"><br><br>
    <input type="text" name="bahasa_sehari_hari" placeholder="Bahasa Sehari-hari"><br><br>

    <textarea name="alamat_domisili" placeholder="Alamat Domisili"></textarea><br><br>

    <h3>Layanan</h3>
    <label><input type="checkbox" name="layanan[]" value="PAUD Rainbow"> PAUD Rainbow</label><br>
    <label><input type="checkbox" name="layanan[]" value="Rainbow Course"> Rainbow Course</label><br>
    <label><input type="checkbox" name="layanan[]" value="Rainbow Home Learning"> Home Learning</label><br><br>

    <h3>Profil Belajar</h3>
    <select name="gaya_belajar">
        <option value="">-- Gaya Belajar --</option>
        <option value="Visual">Visual</option>
        <option value="Auditori">Auditori</option>
        <option value="Kinestetik">Kinestetik</option>
    </select><br><br>

    <textarea name="minat_khusus" placeholder="Minat Khusus"></textarea><br><br>

    <h3>Orang Tua</h3>
    <input type="text" name="nama_ayah" placeholder="Nama Ayah"><br><br>
    <input type="text" name="nohp_ayah" placeholder="No HP Ayah"><br><br>

    <input type="text" name="nama_ibu" placeholder="Nama Ibu"><br><br>
    <input type="text" name="nohp_ibu" placeholder="No HP Ibu"><br><br>

    <h3>Consent</h3>
    <select name="consent_konten">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
