<!DOCTYPE html>
<html>
<head>
    <title>Detail Siswa</title>
</head>
<body>

<h2>Profil Siswa</h2>

<p><strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap }}</p>
<p><strong>Nama Panggilan:</strong> {{ $siswa->nama_panggilan ?? '-' }}</p>
<p><strong>Tempat, Tanggal Lahir:</strong>
    {{ $siswa->tempat_lahir ?? '-' }},
    {{ $siswa->tanggal_lahir ?? '-' }}
</p>
<p><strong>Gender:</strong> {{ $siswa->gender ?? '-' }}</p>
<p><strong>Agama:</strong> {{ $siswa->agama ?? '-' }}</p>
<p><strong>Bahasa Sehari-hari:</strong> {{ $siswa->bahasa_sehari_hari ?? '-' }}</p>
<p><strong>Alamat Domisili:</strong> {{ $siswa->alamat_domisili ?? '-' }}</p>
<p><strong>Asal Cabang:</strong> {{ $siswa->asal_cabang ?? '-' }}</p>
<p><strong>Status Pendaftaran:</strong> {{ $siswa->status_pendaftaran ?? '-' }}</p>

<p><strong>Layanan:</strong>
    {{ implode(', ', $siswa->layanan ?? []) ?: '-' }}
</p>

<hr>

<h3>Profil Belajar</h3>
<p><strong>Gaya Belajar:</strong> {{ $siswa->profile->gaya_belajar ?? '-' }}</p>
<p><strong>Minat Khusus:</strong> {{ $siswa->profile->minat_khusus ?? '-' }}</p>
<p><strong>Temperamen:</strong> {{ $siswa->profile->temperamen ?? '-' }}</p>
<p><strong>Trigger Emosi:</strong> {{ $siswa->profile->trigger_emosi ?? '-' }}</p>
<p><strong>Strategi Menenangkan:</strong> {{ $siswa->profile->strategi_menenangkan ?? '-' }}</p>

<hr>

<h3>Data Orang Tua</h3>

<h4>Ayah</h4>
<p><strong>Nama:</strong> {{ $siswa->profile->nama_ayah ?? '-' }}</p>
<p><strong>Pekerjaan:</strong> {{ $siswa->profile->pekerjaan_ayah ?? '-' }}</p>
<p><strong>Alamat Kantor:</strong> {{ $siswa->profile->alamat_kantor_ayah ?? '-' }}</p>
<p><strong>No HP:</strong> {{ $siswa->profile->nohp_ayah ?? '-' }}</p>

<h4>Ibu</h4>
<p><strong>Nama:</strong> {{ $siswa->profile->nama_ibu ?? '-' }}</p>
<p><strong>Pekerjaan:</strong> {{ $siswa->profile->pekerjaan_ibu ?? '-' }}</p>
<p><strong>Alamat Kantor:</strong> {{ $siswa->profile->alamat_kantor_ibu ?? '-' }}</p>
<p><strong>No HP:</strong> {{ $siswa->profile->nohp_ibu ?? '-' }}</p>

<p><strong>Pengambil Keputusan:</strong> {{ $siswa->profile->decision_maker ?? '-' }}</p>
<p><strong>Jumlah Saudara Kandung:</strong> {{ $siswa->profile->saudara_kandung ?? '-' }}</p>
<p><strong>Harapan Orang Tua:</strong> {{ $siswa->profile->harapan_ortu ?? '-' }}</p>

<hr>

<h3>Kesehatan & Darurat</h3>
<p><strong>Riwayat Alergi:</strong> {{ $siswa->profile->riwayat_alergi ?? '-' }}</p>
<p><strong>Kondisi Khusus:</strong> {{ $siswa->profile->kondisi_khusus ?? '-' }}</p>
<p><strong>Kontak Darurat:</strong> {{ $siswa->profile->kontak_darurat ?? '-' }}</p>

<hr>

<h3>Informasi Tambahan</h3>
<p><strong>Sumber Informasi:</strong> {{ $siswa->profile->sumber_informasi ?? '-' }}</p>
<p><strong>Consent Konten:</strong> {{ $siswa->profile->consent_konten ?? '-' }}</p>

</body>
</html>
