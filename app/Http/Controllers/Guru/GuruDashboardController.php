<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class GuruDashboardController extends Controller
{
    /**
     * Dashboard Guru PAUD
     */
    public function paudHome()
    {
        $user = Auth::user();
        
        // CEK USER ROLE
        if ($user->role_type !== 'guru' || $user->guru_type !== 'PAUD') {
            abort(403, 'Unauthorized access');
        }

        // CEK APAKAH KOLOM LAYANAN ADA
        $hasLayananColumn = Schema::hasColumn('siswa', 'layanan');
        
        $query = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                     ->where('guru_id', $user->id);
        
        // HANYA FILTER JIKA KOLOM LAYANAN ADA
        if ($hasLayananColumn) {
            $query->whereIn('layanan', ['PAUD Rainbow', 'Permata Montessori']);
        }
        
        $siswaList = $query->orderBy('created_at', 'desc')->get();

        $totalSiswa = $siswaList->count();
        
        // HITUNG MANUAL
        $siswaPaud = 0;
        $siswaMontessori = 0;
        
        foreach ($siswaList as $siswa) {
            if ($siswa->layanan == 'PAUD Rainbow') $siswaPaud++;
            if ($siswa->layanan == 'Permata Montessori') $siswaMontessori++;
        }
        
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
        
        if ($user->role_type !== 'guru' || $user->guru_type !== 'Learn kursus') {
            abort(403, 'Unauthorized access');
        }

        $hasLayananColumn = Schema::hasColumn('siswa', 'layanan');
        
        $query = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                     ->where('guru_id', $user->id);
        
        if ($hasLayananColumn) {
            $query->where('layanan', 'Rainbow Course');
        }
        
        $siswaList = $query->orderBy('created_at', 'desc')->get();

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
        
        if ($user->role_type !== 'guru' || $user->guru_type !== 'Homelearning kursus private') {
            abort(403, 'Unauthorized access');
        }

        $hasLayananColumn = Schema::hasColumn('siswa', 'layanan');
        
        $query = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                     ->where('guru_id', $user->id);
        
        if ($hasLayananColumn) {
            $query->where('layanan', 'Rainbow Home Learning');
        }
        
        $siswaList = $query->orderBy('created_at', 'desc')->get();

        $totalSiswa = $siswaList->count();
        $lokasiMengajar = $siswaList->pluck('alamat_domisili')->filter()->unique()->count();

        return view('guru.guru-homelearning', compact(
            'siswaList',
            'totalSiswa',
            'lokasiMengajar'
        ));
    }

    /**
     * Atur Jadwal - KOMPATIBILITAS
     */
    public function aturJadwal($siswaId)
    {
        $siswa = Siswa::with(['orangTua', 'guru'])->findOrFail($siswaId);

        if ($siswa->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        return redirect()->route('guru.jadwal.siswa', $siswaId);
    }
}