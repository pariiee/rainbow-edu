<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $totalGuru = User::where('role_type', 'guru')->count();
        $totalOrtu = User::where('role_type', 'orang_tua')->count();
        $totalSiswa = Siswa::count();
        $totalJadwal = Jadwal::count();
        
        // Statistik pendaftaran 7 hari terakhir
        $registrations = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        // 5 Guru dengan siswa terbanyak
        $topGuru = User::where('role_type', 'guru')
            ->withCount('assignedSiswa')
            ->orderBy('assigned_siswa_count', 'desc')
            ->limit(5)
            ->get();
            
        // Jadwal hari ini
        $jadwalHariIni = Jadwal::with(['siswa', 'guru'])
            ->whereDate('tanggal', Carbon::today())
            ->orderBy('waktu')
            ->get();
            
        return view('admin.dashboard', compact(
            'totalGuru',
            'totalOrtu',
            'totalSiswa',
            'totalJadwal',
            'registrations',
            'topGuru',
            'jadwalHariIni'
        ));
    }
}