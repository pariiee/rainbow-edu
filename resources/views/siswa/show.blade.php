<!DOCTYPE html>
<html>
<head>
    <title>Detail Siswa</title>
</head>
<body>

<h2>Profil Siswa</h2>

<p><strong>Nama:</strong> {{ $siswa->nama_lengkap }}</p>
<p><strong>Gender:</strong> {{ $siswa->gender }}</p>
<p><strong>Layanan:</strong> {{ $siswa->layanan ?? '-' }}</p>


<hr>

<h3>Profil Belajar</h3>
<p><strong>Gaya Belajar:</strong> {{ $siswa->profile->gaya_belajar ?? '-' }}</p>
<p><strong>Minat:</strong> {{ $siswa->profile->minat_khusus ?? '-' }}</p>

<hr>

<h3>Orang Tua</h3>
<p><strong>Ayah:</strong> {{ $siswa->profile->nama_ayah ?? '-' }}</p>
<p><strong>HP Ayah:</strong> {{ $siswa->profile->nohp_ayah ?? '-' }}</p>

<p><strong>Ibu:</strong> {{ $siswa->profile->nama_ibu ?? '-' }}</p>
<p><strong>HP Ibu:</strong> {{ $siswa->profile->nohp_ibu ?? '-' }}</p>

<hr>

<p><strong>Consent Konten:</strong> {{ $siswa->profile->consent_konten }}</p>

</body>
</html>
