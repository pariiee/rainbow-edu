<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrtuHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        Log::info('Orang Tua accessing home', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'nama_anak' => $user->nama_anak
        ]);

        // Ambil data siswa milik orang tua ini
        $siswa = Siswa::with(['guru', 'questionnaire'])
                     ->where('orang_tua_id', $user->id)
                     ->first();

        // Cek status kelengkapan
        $hasCompletedLayanan = $siswa && !empty($siswa->layanan);
        $hasCompletedQuestionnaire = $siswa && $siswa->questionnaire && 
                                    ($siswa->questionnaire->completed_at || $siswa->questionnaire->is_skipped);

        // Debug log
        if ($siswa) {
            Log::info('Siswa data found', [
                'siswa_id' => $siswa->id,
                'nama' => $siswa->nama_lengkap,
                'layanan' => $siswa->layanan,
                'guru_id' => $siswa->guru_id,
                'guru_nama' => $siswa->guru->name ?? 'Belum diassign'
            ]);
        }

        return view('ortu.home', compact(
            'siswa', 
            'hasCompletedLayanan', 
            'hasCompletedQuestionnaire'
        ));
    }
}