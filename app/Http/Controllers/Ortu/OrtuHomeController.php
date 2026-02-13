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
        
        // Ambil data siswa
        $siswa = Siswa::with(['guru', 'questionnaire'])
                     ->where('orang_tua_id', $user->id)
                     ->first();

        // Cek status
        $hasCompletedLayanan = $siswa && !empty($siswa->layanan);
        $hasCompletedQuestionnaire = $siswa && $siswa->questionnaire && 
                                    ($siswa->questionnaire->completed_at || $siswa->questionnaire->is_skipped);

        return view('ortu.home', compact(
            'siswa', 
            'hasCompletedLayanan', 
            'hasCompletedQuestionnaire'
        ));
    }
}