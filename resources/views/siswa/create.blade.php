<!DOCTYPE html>
<html>
<head>
    <title>Form Siswa</title>
</head>
<body>

<h2>Form Intake Siswa (Sementara)</h2>

<form method="POST" action="/siswa" enctype="multipart/form-data">
    @csrf
    
    <hr>
<h3>Berkas Siswa</h3>

<input type="text" name="nama_berkas" placeholder="Nama Berkas (contoh: Akta Kelahiran)"><br><br>

<input type="file" name="file_berkas"><br><br>

<textarea name="keterangan" placeholder="Keterangan Berkas"></textarea><br><br>


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

    <input type="text" name="asal_cabang" placeholder="Asal Cabang"><br><br>

    <select name="status_pendaftaran">
        <option value="">-- Status Pendaftaran --</option>
        <option value="Baru">Baru</option>
        <option value="Trial">Trial</option>
        <option value="Aktif">Aktif</option>
    </select><br><br>

    <h3>Profil Belajar</h3>
    <select name="gaya_belajar">
        <option value="">-- Gaya Belajar --</option>
        <option value="Visual">Visual</option>
        <option value="Auditori">Auditori</option>
        <option value="Kinestetik">Kinestetik</option>
    </select><br><br>

    <textarea name="minat_khusus" placeholder="Minat Khusus"></textarea><br><br>
    <textarea name="temperamen" placeholder="Temperamen Anak"></textarea><br><br>
    <textarea name="trigger_emosi" placeholder="Trigger Emosi"></textarea><br><br>
    <textarea name="strategi_menenangkan" placeholder="Strategi Menenangkan Anak"></textarea><br><br>

    <h3>Data Orang Tua</h3>

    <input type="text" name="nama_ayah" placeholder="Nama Ayah"><br><br>
    <input type="text" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah"><br><br>
    <input type="text" name="alamat_kantor_ayah" placeholder="Alamat Kantor Ayah"><br><br>
    <input type="text" name="nohp_ayah" placeholder="No HP Ayah"><br><br>

    <input type="text" name="nama_ibu" placeholder="Nama Ibu"><br><br>
    <input type="text" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu"><br><br>
    <input type="text" name="alamat_kantor_ibu" placeholder="Alamat Kantor Ibu"><br><br>
    <input type="text" name="nohp_ibu" placeholder="No HP Ibu"><br><br>

    <select name="decision_maker">
        <option value="">-- Pengambil Keputusan --</option>
        <option value="Ayah">Ayah</option>
        <option value="Ibu">Ibu</option>
        <option value="Bersama">Bersama</option>
    </select><br><br>

    <input type="number" name="saudara_kandung" placeholder="Jumlah Saudara Kandung"><br><br>

    <textarea name="harapan_ortu" placeholder="Harapan Orang Tua"></textarea><br><br>

    <h3>Kesehatan & Darurat</h3>
    <textarea name="riwayat_alergi" placeholder="Riwayat Alergi"></textarea><br><br>
    <textarea name="kondisi_khusus" placeholder="Kondisi Khusus"></textarea><br><br>
    <input type="text" name="kontak_darurat" placeholder="Kontak Darurat"><br><br>

    <h3>Informasi Tambahan</h3>
    <input type="text" name="sumber_informasi" placeholder="Sumber Informasi"><br><br>

    <h3>Consent Konten</h3>
    <select name="consent_konten">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
