<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GuruDashboardController extends Controller
{
    /**
     * Dashboard Guru PAUD
     */
    public function paudHome()
    {
        $user = Auth::user();
        
        $siswaList = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                         ->where('guru_id', $user->id)
                         ->whereIn('layanan', ['PAUD Rainbow', 'Permata Montessori'])
                         ->orderBy('created_at', 'desc')
                         ->get();

        $totalSiswa = $siswaList->count();
        $siswaPaud = $siswaList->where('layanan', 'PAUD Rainbow')->count();
        $siswaMontessori = $siswaList->where('layanan', 'Permata Montessori')->count();
        $siswaAktif = $siswaList->where('status_assign', 'active')->count();
        $siswaPending = $siswaList->where('status_assign', 'pending')->count();

        return view('guru.guru-paud', compact(
            'siswaList',
            'totalSiswa',
            'siswaPaud',
            'siswaMontessori',
            'siswaAktif',
            'siswaPending'
        ));
    }

    /**
     * Dashboard Guru Learn
     */
    public function learnHome()
    {
        $user = Auth::user();
        
        $siswaList = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                         ->where('guru_id', $user->id)
                         ->where('layanan', 'Rainbow Course')
                         ->orderBy('created_at', 'desc')
                         ->get();

        $totalSiswa = $siswaList->count();
        $siswaAktif = $siswaList->where('status_assign', 'active')->count();
        $siswaPending = $siswaList->where('status_assign', 'pending')->count();

        return view('guru.guru-learn', compact(
            'siswaList',
            'totalSiswa',
            'siswaAktif',
            'siswaPending'
        ));
    }

    /**
     * Dashboard Guru Homelearning
     */
    public function homelearningHome()
    {
        $user = Auth::user();
        
        $siswaList = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                         ->where('guru_id', $user->id)
                         ->where('layanan', 'Rainbow Home Learning')
                         ->orderBy('created_at', 'desc')
                         ->get();

        $totalSiswa = $siswaList->count();
        $lokasiMengajar = $siswaList->pluck('alamat_domisili')->filter()->unique()->count();

        return view('guru.guru-homelearning', compact(
            'siswaList',
            'totalSiswa',
            'lokasiMengajar'
        ));
    }

    /**
     * Atur Jadwal - KOMPATIBILITAS UNTUK VIEW LAMA
     * Redirect ke route baru guru.jadwal.show
     */
    public function aturJadwal($siswaId)
    {
        $siswa = Siswa::with(['orangTua', 'guru'])->findOrFail($siswaId);

        if ($siswa->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        return redirect()->route('guru.jadwal.show', $siswaId);
    }
}