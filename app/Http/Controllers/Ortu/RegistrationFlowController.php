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
     * Step 1: Pilih layanan - 3 PILIHAN
     */
    public function pilihLayanan()
    {
        $user = Auth::user();
        
        $siswa = Siswa::where('orang_tua_id', $user->id)->first();
        
        if ($siswa && $siswa->layanan) {
            return redirect()->route('orangtua.home');
        }
        
        return view('ortu.pilih-layanan');
    }

    /**
     * Step 1: Store pilihan layanan - 3 PILIHAN
     */
    public function storeLayanan(Request $request)
    {
        $validated = $request->validate([
            'layanan' => ['required', 'in:PAUD,Learn,Home Learning'],
        ]);

        $user = Auth::user();

        DB::beginTransaction();
        try {
            // ============ FIX: MAPPING 3 LAYANAN ============
            $layananDb = match ($validated['layanan']) {
                'PAUD' => 'PAUD',                    // BUKAN 'PAUD Rainbow'
                'Learn' => 'Rainbow Course',         // SAMA
                'Home Learning' => 'Rainbow Home Learning', // SAMA
                default => null,
            };

            if (!$layananDb) {
                throw new \Exception('Layanan tidak valid');
            }

            $siswa = Siswa::where('orang_tua_id', $user->id)->first();
            
            if (!$siswa) {
                $siswa = new Siswa();
                $siswa->orang_tua_id = $user->id;
                $siswa->nama_lengkap = $user->nama_anak ?? 'Belum diisi';
                $siswa->gender = 'Laki-laki';
                $siswa->status_pendaftaran = 'Baru';
            }
            
            // SIMPAN LAYANAN - PASTI SESUAI ENUM
            $siswa->layanan = $layananDb;
            $siswa->save();

            // Assign guru
            $this->assignToGuru($siswa, $validated['layanan']);

            DB::commit();

            return redirect()->route('orangtua.home')
                           ->with('success', 'Layanan berhasil dipilih!');
                           
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }

    /**
     * Show form untuk mengisi data siswa
     */
    public function showForm()
    {
        $user = Auth::user();
        
        $siswa = Siswa::where('orang_tua_id', $user->id)->first();
        
        if (!$siswa) {
            return redirect()->route('ortu.pilih.layanan')
                ->with('error', 'Silakan pilih layanan terlebih dahulu.');
        }

        $questionnaire = SiswaQuestionnaire::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'user_id' => Auth::id()
            ]
        );

        return view('ortu.form', compact('siswa', 'questionnaire'));
    }

    /**
     * Store data dari form
     */
    public function storeForm(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'sekolah_sebelumnya' => 'nullable|string|max:255',
            'usia_anak' => 'required|integer|min:1|max:18',
            'tujuan_pendaftaran' => 'nullable|string',
            'tingkat_kemandirian' => 'required|in:Mandiri,Butuh Bantuan,Sangat Butuh Bantuan',
            'ekspektasi_ortu' => 'nullable|string',
            'minat_bakat' => 'nullable|string',
            'catatan_kesehatan' => 'nullable|string',
        ]);

        $siswa = Siswa::where('id', $request->siswa_id)
                      ->where('orang_tua_id', Auth::id())
                      ->firstOrFail();

        SiswaQuestionnaire::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'user_id' => Auth::id()
            ],
            [
                'sekolah_sebelumnya' => $request->sekolah_sebelumnya,
                'usia_anak' => $request->usia_anak,
                'tujuan_pendaftaran' => $request->tujuan_pendaftaran,
                'tingkat_kemandirian' => $request->tingkat_kemandirian,
                'ekspektasi_ortu' => $request->ekspektasi_ortu,
                'minat_bakat' => $request->minat_bakat,
                'catatan_kesehatan' => $request->catatan_kesehatan,
                'is_skipped' => false,
                'completed_at' => now(),
            ]
        );

        return redirect()->route('orangtua.home')
                       ->with('success', 'Data siswa berhasil disimpan!');
    }

    /**
     * Assign guru berdasarkan layanan - MAPPING 3 LAYANAN
     */
    private function assignToGuru(Siswa $siswa, string $layanan)
    {
        // MAPPING 3 LAYANAN KE 3 GURU
        $guruType = match ($layanan) {
            'PAUD' => 'PAUD',
            'Learn' => 'Learn kursus',
            'Home Learning' => 'Homelearning kursus private',
            default => null,
        };

        if (!$guruType) {
            Log::error('❌ Layanan tidak valid:', ['layanan' => $layanan]);
            return false;
        }

        // CARI GURU
        $guru = User::where('role_type', 'guru')
                    ->where('guru_type', $guruType)
                    ->where('is_verified', true)
                    ->first();

        if ($guru) {
            $siswa->guru_id = $guru->id;
            $siswa->status_assign = 'active';
            $siswa->save();
            
            Log::info('✅ ASSIGN SUKSES:', [
                'siswa' => $siswa->nama_lengkap,
                'layanan' => $siswa->layanan,
                'guru' => $guru->name
            ]);
            
            return true;
        }

        // BUAT GURU BARU
        return $this->createGuruOtomatis($guruType, $siswa);
    }

    /**
     * Buat guru otomatis
     */
    private function createGuruOtomatis($guruType, Siswa $siswa)
    {
        $dataGuru = match ($guruType) {
            'PAUD' => [
                'name' => 'Ibu Sarah Wijaya',
                'email' => 'sarah.paud@rainbow.edu',
            ],
            'Learn kursus' => [
                'name' => 'Bapak Budi Santoso',
                'email' => 'budi.learn@rainbow.edu',
            ],
            'Homelearning kursus private' => [
                'name' => 'Ibu Rina Andriani',
                'email' => 'rina.home@rainbow.edu',
            ],
            default => null
        };

        if ($dataGuru) {
            $guru = User::firstOrCreate(
                ['email' => $dataGuru['email']],
                [
                    'name' => $dataGuru['name'],
                    'email' => $dataGuru['email'],
                    'password' => bcrypt('password'),
                    'role_type' => 'guru',
                    'guru_type' => $guruType,
                    'is_verified' => true,
                    'verified_at' => now(),
                ]
            );

            $siswa->guru_id = $guru->id;
            $siswa->status_assign = 'active';
            $siswa->save();

            Log::info('✅ GURU BARU DIBUAT:', [
                'guru' => $guru->name,
                'email' => $guru->email,
                'type' => $guru->guru_type
            ]);

            return true;
        }

        return false;
    }
}