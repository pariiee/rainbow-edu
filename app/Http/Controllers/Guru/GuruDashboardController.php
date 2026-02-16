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
        
        // CEK USER
        if ($user->role_type !== 'guru' || $user->guru_type !== 'PAUD') {
            abort(403, 'Unauthorized access');
        }

        // AMBIL SISWA - FILTER LAYANAN 'PAUD' (KARENA PAKAI 3 LAYANAN)
        $siswaList = Siswa::with(['orangTua', 'guru', 'questionnaire'])
                         ->where('guru_id', $user->id)
                         ->where('layanan', 'PAUD') // LANGSUNG 'PAUD'
                         ->orderBy('created_at', 'desc')
                         ->get();

        // DEBUG LOG
        Log::info('Guru PAUD Dashboard:', [
            'guru_id' => $user->id,
            'guru_name' => $user->name,
            'total_siswa' => $siswaList->count(),
            'siswa_data' => $siswaList->map(function($s) {
                return [
                    'id' => $s->id,
                    'nama' => $s->nama_lengkap,
                    'layanan' => $s->layanan,
                    'status' => $s->status_assign
                ];
            })->toArray()
        ]);

        // HITUNG STATISTIK
        $totalSiswa = $siswaList->count();
        $siswaAktif = $siswaList->where('status_assign', 'active')->count();
        $siswaPending = $siswaList->where('status_assign', 'pending')->count();
        
        // UNTUK VIEW (BISA 0 KARENA PAKAI 3 LAYANAN)
        $siswaPaud = $totalSiswa; // SEMUA SISWA ADALAH PAUD
        $siswaMontessori = 0; // TIDAK ADA KARENA SUDAH DIGABUNG
        $jadwalHariIni = 0; // NANTI DIISI
        $pendingKonfirmasi = $siswaPending;

        return view('guru.guru-paud', compact(
            'siswaList',
            'totalSiswa',
            'siswaPaud',
            'siswaMontessori',
            'siswaAktif',
            'siswaPending',
            'pendingKonfirmasi',
            'jadwalHariIni'
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
        
        if ($user->role_type !== 'guru' || $user->guru_type !== 'Homelearning kursus private') {
            abort(403, 'Unauthorized access');
        }

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

    public function aturJadwal($siswaId)
    {
        $siswa = Siswa::with(['orangTua', 'guru'])->findOrFail($siswaId);

        if ($siswa->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        return redirect()->route('guru.jadwal.siswa', $siswaId);
    }
}