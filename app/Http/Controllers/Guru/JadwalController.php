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
        $jadwalPending = $jadwals->where('status', 'pending');
        $jadwalDisetujui = $jadwals->where('status', 'disetujui');
        
        return view('guru.jadwal-index', compact(
            'jadwals',
            'jadwalHariIni',
            'jadwalMendatang',
            'jadwalSelesai',
            'jadwalPending',
            'jadwalDisetujui'
        ));
    }

    /**
     * Show form to create schedule for specific student
     * URL: /guru/jadwal/create/{siswaId}
     */
    public function create($siswaId)
    {
        $siswa = Siswa::with(['orangTua', 'guru'])->findOrFail($siswaId);
        
        // Cek akses
        if ($siswa->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        return view('guru.jadwal-create', compact('siswa'));
    }

    /**
     * Store a new schedule
     * URL: /guru/jadwal/store/{siswaId}
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

        return redirect()->route('guru.jadwal.detail', $jadwal->id)
            ->with('success', 'Jadwal berhasil dibuat dan menunggu persetujuan orang tua.');
    }

    /**
     * Show specific schedule by ID jadwal
     * URL: /guru/jadwal/detail/{id}
     */
    public function detail($id)
    {
        $jadwal = Jadwal::with(['siswa', 'guru', 'orangTua'])
                       ->findOrFail($id);
        
        // Cek akses
        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke jadwal ini.');
        }

        return view('guru.jadwal-show', compact('jadwal'));
    }

    /**
     * Show schedule by student ID - REDIRECT KE CREATE ATAU DETAIL
     * URL: /guru/jadwal/siswa/{siswaId}
     */
    public function bySiswa($siswaId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        
        // Cek akses
        if ($siswa->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        // Cek apakah sudah ada jadwal pending atau disetujui
        $jadwalAktif = Jadwal::where('siswa_id', $siswaId)
                            ->whereIn('status', ['pending', 'disetujui'])
                            ->first();

        if ($jadwalAktif) {
            // Jika ada jadwal aktif, redirect ke detail
            return redirect()->route('guru.jadwal.detail', $jadwalAktif->id);
        } else {
            // Jika belum ada, redirect ke form create
            return redirect()->route('guru.jadwal.create', $siswaId);
        }
    }

    /**
     * Update schedule status
     * URL: /guru/jadwal/{id}/status
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
        } elseif ($request->status == 'dibatalkan' && Auth::id() == $jadwal->guru_id) {
            $jadwal->status = 'dibatalkan';
            $jadwal->feedback_guru = $request->feedback ?? 'Dibatalkan oleh guru';
        } else {
            abort(403, 'Anda tidak memiliki izin untuk mengubah status ini.');
        }

        $jadwal->save();

        return back()->with('success', 'Status jadwal berhasil diperbarui.');
    }

    /**
     * Respond to replacement schedule proposal
     * URL: /guru/jadwal/{id}/respond-replacement
     */
    public function respondReplacement(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke jadwal ini.');
        }

        $request->validate([
            'action' => 'required|in:approve,reject',
            'feedback' => 'nullable|string'
        ]);

        if (!$jadwal->is_pengajuan_pengganti) {
            return back()->with('error', 'Tidak ada pengajuan penggantian untuk jadwal ini.');
        }

        if ($request->action === 'approve') {
            $jadwal->tanggal = $jadwal->tanggal_pengganti;
            $jadwal->waktu = $jadwal->waktu_pengganti;
            $jadwal->status = 'disetujui';
            $jadwal->feedback_guru = $request->feedback ?? 'Pengajuan jadwal pengganti disetujui.';
            $message = 'Jadwal pengganti berhasil disetujui.';
        } else {
            $jadwal->status = 'dibatalkan';
            $jadwal->feedback_guru = $request->feedback ?? 'Pengajuan jadwal pengganti ditolak.';
            $message = 'Jadwal pengganti ditolak, jadwal dibatalkan.';
        }

        // Reset the replacement fields
        $jadwal->is_pengajuan_pengganti = false;
        $jadwal->tanggal_pengganti = null;
        $jadwal->waktu_pengganti = null;
        $jadwal->alasan_pengganti = null;
        
        $jadwal->save();

        return redirect()->route('guru.jadwal.detail', $id)
            ->with('success', $message);
    }

    /**
     * Delete schedule
     * URL: /guru/jadwal/{id}
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus jadwal ini.');
        }

        $jadwal->delete();

        return redirect()->route('guru.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}