<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaProfile;
use App\Models\SiswaBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:20',
            'bahasa_sehari_hari' => 'nullable|string|max:50',
            'alamat_domisili' => 'nullable|string',
            'status_pendaftaran' => 'nullable|in:Baru,Pindahan',
            'asal_cabang' => 'nullable|string|max:50',
            'layanan' => 'nullable|array',

            // 🔥 TAMBAHAN FILE BERKAS
            'file_berkas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nama_berkas' => 'nullable|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // ===============================
            // SIMPAN SISWA
            // ===============================
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

            // ===============================
            // SIMPAN PROFILE
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
                'consent_konten'
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

            DB::commit();

            Log::info('Siswa baru ditambahkan', [
                'siswa_id' => $siswa->id,
                'nama' => $siswa->nama_lengkap
            ]);

            return redirect()
                ->route('siswa.show', $siswa->id)
                ->with('success', 'Data siswa berhasil disimpan');

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error create siswa: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data siswa: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // 🔥 FIX: jangan query 2x
        $siswa = Siswa::with(['profile', 'berkas'])->findOrFail($id);

        return view('siswa.show', compact('siswa'));
    }
}
