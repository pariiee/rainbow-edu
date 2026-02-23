<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalOrtuController extends Controller
{
    /**
     * Display all schedules for orang tua
     */
    public function index()
    {
        $user = Auth::user();
        
        $jadwals = Jadwal::with(['siswa', 'guru'])
                        ->where('orang_tua_id', $user->id)
                        ->orderBy('tanggal', 'desc')
                        ->orderBy('waktu', 'desc')
                        ->get();

        $jadwalPending = $jadwals->where('status', 'pending');
        $jadwalDisetujui = $jadwals->where('status', 'disetujui');
        $jadwalSelesai = $jadwals->where('status', 'selesai');
        $jadwalDibatalkan = $jadwals->where('status', 'dibatalkan');
        
        $jadwalHariIni = $jadwals->where('tanggal', now()->format('Y-m-d'));
        $jadwalMendatang = $jadwals->where('tanggal', '>', now()->format('Y-m-d'));

        $siswa = Siswa::where('orang_tua_id', $user->id)->first();

        return view('ortu.jadwal-index', compact(
            'jadwals',
            'jadwalPending',
            'jadwalDisetujui',
            'jadwalSelesai',
            'jadwalDibatalkan',
            'jadwalHariIni',
            'jadwalMendatang',
            'siswa'
        ));
    }

    /**
     * Show specific schedule
     */
    public function show($id)
    {
        $jadwal = Jadwal::with(['siswa', 'guru'])
                       ->where('orang_tua_id', Auth::id())
                       ->findOrFail($id);

        $siswa = Siswa::where('orang_tua_id', Auth::id())->first();

        return view('ortu.jadwal-show', compact('jadwal', 'siswa'));
    }

    /**
     * Approve schedule
     */
    public function approve(Request $request, $id)
    {
        $jadwal = Jadwal::where('orang_tua_id', Auth::id())
                       ->where('status', 'pending')
                       ->findOrFail($id);

        $request->validate([
            'feedback' => 'nullable|string|max:500'
        ]);

        $jadwal->status = 'disetujui';
        $jadwal->feedback_ortu = $request->feedback;
        $jadwal->save();

        Log::info('Jadwal disetujui oleh orang tua', [
            'jadwal_id' => $jadwal->id,
            'ortu_id' => Auth::id(),
            'guru_id' => $jadwal->guru_id,
            'siswa_id' => $jadwal->siswa_id
        ]);

        return redirect()->route('ortu.jadwal.show', $id)
            ->with('success', 'Jadwal telah disetujui. Terima kasih!');
    }

    /**
     * Reject schedule
     */
    public function reject(Request $request, $id)
    {
        $jadwal = Jadwal::where('orang_tua_id', Auth::id())
                       ->where('status', 'pending')
                       ->findOrFail($id);

        $request->validate([
            'alasan' => 'required|string|max:500'
        ]);

        $jadwal->status = 'dibatalkan';
        $jadwal->feedback_ortu = 'Dibatalkan: ' . $request->alasan;
        $jadwal->save();

        Log::info('Jadwal ditolak oleh orang tua', [
            'jadwal_id' => $jadwal->id,
            'ortu_id' => Auth::id(),
            'alasan' => $request->alasan
        ]);

        return redirect()->route('ortu.jadwal.index')
            ->with('success', 'Jadwal telah dibatalkan.');
    }

    /**
     * Propose a replacement schedule
     */
    public function proposeReplacement(Request $request, $id)
    {
        $jadwal = Jadwal::where('orang_tua_id', Auth::id())
                       ->where('status', 'pending')
                       ->findOrFail($id);

        $request->validate([
            'tanggal_pengganti' => 'required|date|after_or_equal:today',
            'waktu_pengganti' => 'required',
            'alasan_pengganti' => 'required|string|max:500'
        ]);

        $jadwal->is_pengajuan_pengganti = true;
        $jadwal->tanggal_pengganti = $request->tanggal_pengganti;
        $jadwal->waktu_pengganti = $request->waktu_pengganti;
        $jadwal->alasan_pengganti = $request->alasan_pengganti;
        $jadwal->status = 'pending'; // remain pending
        $jadwal->save();

        Log::info('Pengajuan jadwal pengganti oleh orang tua', [
            'jadwal_id' => $jadwal->id,
            'ortu_id' => Auth::id(),
            'tanggal_pengganti' => $request->tanggal_pengganti,
            'waktu_pengganti' => $request->waktu_pengganti,
            'alasan' => $request->alasan_pengganti
        ]);

        return redirect()->route('ortu.jadwal.show', $id)
            ->with('success', 'Pengajuan jadwal pengganti telah dikirim dan menunggu persetujuan guru.');
    }

    /**
     * Get unread schedules count
     */
    public function unreadCount()
    {
        $count = Jadwal::where('orang_tua_id', Auth::id())
                      ->where('status', 'pending')
                      ->where('created_at', '>', now()->subDays(7))
                      ->count();

        return response()->json(['count' => $count]);
    }
}