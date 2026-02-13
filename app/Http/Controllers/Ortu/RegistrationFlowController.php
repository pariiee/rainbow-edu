<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\SiswaQuestionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegistrationFlowController extends Controller
{
    /**
     * Step 1: Pilih layanan
     */
    public function pilihLayanan()
    {
        $user = Auth::user();
        
        // Cek apakah sudah ada siswa
        $siswa = Siswa::where('orang_tua_id', $user->id)->first();
        
        if ($siswa && $siswa->layanan) {
            return redirect()->route('ortu.pertanyaan.migration', $siswa->id);
        }
        
        return view('ortu.pilih-layanan');
    }

    /**
     * Step 1: Store pilihan layanan - FIX AUTO ASSIGN
     */
    public function storeLayanan(Request $request)
    {
        $validated = $request->validate([
            'layanan' => ['required', 'in:PAUD Rainbow,Permata Montessori,Rainbow Course,Rainbow Home Learning'],
        ]);

        $user = Auth::user();

        DB::beginTransaction();
        try {
            // Cari atau buat siswa untuk orang tua ini
            $siswa = Siswa::where('orang_tua_id', $user->id)->first();
            
            if (!$siswa) {
                $siswa = new Siswa();
                $siswa->orang_tua_id = $user->id;
                $siswa->nama_lengkap = $user->nama_anak ?? 'Belum diisi';
                $siswa->gender = 'Laki-laki';
                $siswa->status_pendaftaran = 'Baru';
            }
            
            $siswa->layanan = $validated['layanan'];
            $siswa->save();

            // FIX: ASSIGN GURU OTOMATIS - PASTIKAN BERHASIL
            $this->assignToGuru($siswa, $validated['layanan']);

            DB::commit();
            
            Log::info('✅ REGISTRASI BERHASIL:', [
                'siswa' => $siswa->nama_lengkap,
                'layanan' => $siswa->layanan,
                'guru_id' => $siswa->guru_id,
                'guru_nama' => $siswa->guru->name ?? 'TIDAK DITEMUKAN'
            ]);

            return redirect()->route('ortu.pertanyaan.migration', $siswa->id)
                           ->with('success', 'Layanan berhasil dipilih! Guru telah ditugaskan.');
                           
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ ERROR: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }

    /**
     * Step 2: Form pertanyaan migration
     */
    public function pertanyaanMigration($siswaId)
    {
        $siswa = Siswa::where('id', $siswaId)
                      ->where('orang_tua_id', Auth::id())
                      ->with('guru')
                      ->firstOrFail();

        $questionnaire = SiswaQuestionnaire::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'user_id' => Auth::id()
            ]
        );

        return view('ortu.pertanyaan-migration', compact('siswa', 'questionnaire'));
    }

    /**
     * Step 2: Store atau skip pertanyaan migration
     */
    public function storePertanyaan(Request $request, $siswaId)
    {
        $siswa = Siswa::where('id', $siswaId)
                      ->where('orang_tua_id', Auth::id())
                      ->firstOrFail();

        if ($request->has('skip')) {
            SiswaQuestionnaire::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'user_id' => Auth::id()
                ],
                [
                    'is_skipped' => true,
                    'skipped_at' => now(),
                ]
            );

            return redirect()->route('orangtua.home')
                           ->with('success', 'Pertanyaan bisa diisi nanti.');
        }

        $validated = $request->validate([
            'sekolah_sebelumnya' => 'nullable|string|max:255',
            'usia_anak' => 'nullable|integer|min:1|max:18',
            'tujuan_pendaftaran' => 'nullable|string',
            'tingkat_kemandirian' => 'nullable|in:Mandiri,Butuh Bantuan,Sangat Butuh Bantuan',
            'ekspektasi_ortu' => 'nullable|string',
        ]);

        SiswaQuestionnaire::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'user_id' => Auth::id()
            ],
            array_merge($validated, [
                'is_skipped' => false,
                'completed_at' => now(),
            ])
        );

        return redirect()->route('orangtua.home')
                       ->with('success', 'Data berhasil disimpan!');
    }

    /**
     * FIX: ASSIGN GURU KE SISWA - VERSI PALING STABIL
     */
    private function assignToGuru(Siswa $siswa, string $layanan)
    {
        // Mapping layanan ke tipe guru
        $guruType = match ($layanan) {
            'PAUD Rainbow', 'Permata Montessori' => 'PAUD',
            'Rainbow Course' => 'Learn kursus',
            'Rainbow Home Learning' => 'Homelearning kursus private',
            default => null,
        };

        if (!$guruType) {
            Log::error('Layanan tidak valid: ' . $layanan);
            return false;
        }

        // CARI GURU - PRIORITAS YANG PALING SEDIKIT SISWA
        $guru = User::where('role_type', 'guru')
                    ->where('guru_type', $guruType)
                    ->where('is_verified', true)
                    ->get()
                    ->sortBy(function($g) {
                        return Siswa::where('guru_id', $g->id)->count();
                    })
                    ->first();

        if ($guru) {
            // ASSIGN GURU KE SISWA
            $siswa->guru_id = $guru->id;
            $siswa->status_assign = 'active';
            $siswa->save();
            
            Log::info('✅ ASSIGN SUKSES:', [
                'siswa' => $siswa->nama_lengkap,
                'guru' => $guru->name,
                'tipe' => $guru->guru_type
            ]);
            
            return true;
        } else {
            Log::error('❌ TIDAK ADA GURU TERSEDIA:', [
                'tipe' => $guruType,
                'layanan' => $layanan
            ]);
            
            // FIX: BUAT GURU OTOMATIS JIKA BELUM ADA
            return $this->createGuruOtomatis($guruType, $siswa);
        }
    }

    /**
     * FIX: BUAT GURU OTOMATIS JIKA BELUM ADA
     */
    private function createGuruOtomatis($guruType, Siswa $siswa)
    {
        $namaGuru = match ($guruType) {
            'PAUD' => 'Ibu Sarah Wijaya',
            'Learn kursus' => 'Bapak Budi Santoso',
            'Homelearning kursus private' => 'Ibu Rina Andriani',
            default => 'Guru ' . $guruType
        };

        $email = match ($guruType) {
            'PAUD' => 'sarah.paud@rainbow.edu',
            'Learn kursus' => 'budi.learn@rainbow.edu',
            'Homelearning kursus private' => 'rina.home@rainbow.edu',
            default => strtolower(str_replace(' ', '.', $namaGuru)) . '@rainbow.edu'
        };

        // Cek apakah email sudah digunakan
        $existingGuru = User::where('email', $email)->first();
        
        if ($existingGuru) {
            $guru = $existingGuru;
        } else {
            // Buat guru baru
            $guru = User::create([
                'name' => $namaGuru,
                'email' => $email,
                'password' => bcrypt('password'),
                'role_type' => 'guru',
                'guru_type' => $guruType,
                'is_verified' => true,
                'verified_at' => now(),
            ]);

            // Assign role
            if (method_exists($guru, 'assignRole')) {
                $guru->assignRole('guru');
            }
            
            Log::info('✅ GURU BARU DIBUAT:', [
                'nama' => $guru->name,
                'email' => $guru->email,
                'tipe' => $guru->guru_type
            ]);
        }

        // Assign ke siswa
        if ($guru) {
            $siswa->guru_id = $guru->id;
            $siswa->status_assign = 'active';
            $siswa->save();
            
            Log::info('✅ ASSIGN KE GURU BARU:', [
                'siswa' => $siswa->nama_lengkap,
                'guru' => $guru->name
            ]);
            
            return true;
        }

        return false;
    }
}