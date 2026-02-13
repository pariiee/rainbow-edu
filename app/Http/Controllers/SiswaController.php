<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'gender'         => 'nullable|string',
            'layanan'        => 'nullable|array',
            'file_berkas'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // ===============================
        // SIMPAN DATA SISWA (FIX ERROR)
        // ===============================
        $dataSiswa = $request->only([
            'nama_lengkap',
            'nama_panggilan',
            'tempat_lahir',
            'tanggal_lahir',
            'gender',
            'agama',
            'bahasa_sehari_hari',
            'alamat_domisili',
            'status_pendaftaran',
            'asal_cabang',
        ]);

        $siswa = Siswa::create($dataSiswa);

        // ===============================
        // SIMPAN PROFIL SISWA
        // ===============================
        $siswa->profile()->create($request->only([
            'gaya_belajar',
            'minat_khusus',
            'temperamen',
            'trigger_emosi',
            'strategi_menenangkan',
            'nama_ayah',
            'pekerjaan_ayah',
            'alamat_kantor_ayah',
            'nohp_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'alamat_kantor_ibu',
            'nohp_ibu',
            'decision_maker',
            'saudara_kandung',
            'harapan_ortu',
            'riwayat_alergi',
            'kondisi_khusus',
            'kontak_darurat',
            'sumber_informasi',
            'consent_konten',
        ]));

        // ===============================
        // SIMPAN BERKAS (JIKA ADA)
        // ===============================
        if ($request->hasFile('file_berkas')) {

            $path = $request->file('file_berkas')
                ->store('berkas_siswa', 'public');

            SiswaBerkas::create([
                'id_siswa'    => $siswa->id,
                'nama_berkas' => $request->nama_berkas ?? 'Berkas Awal',
                'file_path'   => $path,
                'keterangan'  => $request->keterangan,
                'uploaded_at' => now(),
            ]);
        }

        return redirect()
            ->route('siswa.show', $siswa->id)
            ->with('success', 'Data siswa berhasil disimpan');
    }

    public function show($id)
    {
        $siswa = Siswa::with(['profile', 'berkas'])->findOrFail($id);

        return view('siswa.show', compact('siswa'));
    }
}
