<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        // (opsional tapi sangat disarankan)
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable|string',
        ]);

        $siswa = Siswa::create($request->only([
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
            'layanan'
        ]));

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
            'consent_konten'
        ]));

        return redirect()
            ->route('siswa.show', $siswa->id)
            ->with('success', 'Data siswa berhasil disimpan');
    }

    public function show($id)
    {
        $siswa = Siswa::with('profile')->findOrFail($id);

        return view('siswa.show', compact('siswa'));
    }
}
