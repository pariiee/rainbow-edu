<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalController extends Controller
{
    /**
     * Display all schedules for guru
     */
    public function index()
    {
        $user = Auth::user();
        
        $jadwals = Jadwal::with(['siswa', 'orangTua'])
                        ->where('guru_id', $user->id)
                        ->orderBy('tanggal', 'asc')
                        ->orderBy('waktu', 'asc')
                        ->get();
        
        $jadwalHariIni = $jadwals->where('tanggal', now()->format('Y-m-d'));
        $jadwalMendatang = $jadwals->where('tanggal', '>', now()->format('Y-m-d'));
        $jadwalSelesai = $jadwals->where('status', 'selesai');
        
        return view('guru.jadwal-index', compact(
            'jadwals',
            'jadwalHariIni',
            'jadwalMendatang',
            'jadwalSelesai'
        ));
    }

    /**
     * Store a new schedule
     */
    public function store(Request $request, $siswaId)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => 'required',
            'durasi' => 'required|integer|in:30,45,60,90,120',
            'catatan' => 'nullable|string|max:500',
        ]);

        $siswa = Siswa::with('orangTua')->findOrFail($siswaId);
        
        // Cek akses
        if ($siswa->guru_id !== Auth::id()) {
            abort(403);
        }

        $jadwal = Jadwal::create([
            'guru_id' => Auth::id(),
            'siswa_id' => $siswaId,
            'orang_tua_id' => $siswa->orang_tua_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'durasi' => $request->durasi,
            'catatan' => $request->catatan,
            'status' => 'pending'
        ]);

        Log::info('Jadwal baru dibuat', [
            'jadwal_id' => $jadwal->id,
            'guru' => Auth::user()->name,
            'siswa' => $siswa->nama_lengkap
        ]);

        return redirect()->route('guru.jadwal.show', $jadwal->id)
            ->with('success', 'Jadwal berhasil dibuat dan menunggu persetujuan orang tua.');
    }

    /**
     * Show specific schedule
     */
    public function show($id)
    {
        $jadwal = Jadwal::with(['siswa', 'guru', 'orangTua'])
                       ->findOrFail($id);
        
        // Cek akses
        if ($jadwal->guru_id !== Auth::id() && $jadwal->orang_tua_id !== Auth::id()) {
            abort(403);
        }

        return view('guru.jadwal-show', compact('jadwal'));
    }

    /**
     * Update schedule status
     */
    public function updateStatus(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:disetujui,selesai,dibatalkan',
            'feedback' => 'nullable|string'
        ]);

        if ($request->status == 'disetujui' && Auth::id() == $jadwal->orang_tua_id) {
            $jadwal->status = 'disetujui';
            $jadwal->feedback_ortu = $request->feedback;
        } elseif ($request->status == 'selesai' && Auth::id() == $jadwal->guru_id) {
            $jadwal->status = 'selesai';
            $jadwal->feedback_guru = $request->feedback;
        } elseif ($request->status == 'dibatalkan') {
            $jadwal->status = 'dibatalkan';
        } else {
            abort(403);
        }

        $jadwal->save();

        return back()->with('success', 'Status jadwal berhasil diperbarui.');
    }

    /**
     * Delete schedule
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        if ($jadwal->guru_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->delete();

        return redirect()->route('guru.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}