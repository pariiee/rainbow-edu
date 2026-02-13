<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaManagementController extends Controller
{
    /**
     * Daftar semua siswa
     */
    public function index(Request $request)
    {
        $query = Siswa::with(['guru', 'orangTua', 'profile']);
        
        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_panggilan', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter by layanan
        if ($request->filled('layanan')) {
            $query->where('layanan', $request->layanan);
        }
        
        // Filter by guru
        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }
        
        $siswas = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $gurus = User::where('role_type', 'guru')->get();
        $layananList = ['PAUD Rainbow', 'Permata Montessori', 'Rainbow Course', 'Rainbow Home Learning'];
        
        return view('admin.siswa.index', compact('siswas', 'gurus', 'layananList'));
    }

    /**
     * Detail siswa
     */
    public function show($id)
    {
        $siswa = Siswa::with(['guru', 'orangTua', 'profile', 'questionnaire', 'jadwals'])
                     ->findOrFail($id);
                     
        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Reassign guru
     */
    public function reassignGuru(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id'
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->guru_id = $request->guru_id;
        $siswa->status_assign = 'active';
        $siswa->save();

        return response()->json([
            'success' => true,
            'message' => 'Guru berhasil diubah'
        ]);
    }

    /**
     * Delete siswa
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil dihapus'
        ]);
    }

    /**
     * Export data siswa
     */
    public function export(Request $request)
    {
        $query = Siswa::with(['guru', 'orangTua', 'profile']);
        
        if ($request->filled('layanan')) {
            $query->where('layanan', $request->layanan);
        }
        
        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }
        
        $siswas = $query->get();
        
        // Generate CSV
        $filename = 'data-siswa-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://temp', 'w');
        
        // Header CSV
        fputcsv($handle, [
            'No',
            'Nama Lengkap',
            'Nama Panggilan',
            'Layanan',
            'Guru',
            'Orang Tua',
            'Tanggal Lahir',
            'Gender',
            'Status',
            'Tanggal Daftar'
        ]);
        
        // Data
        foreach ($siswas as $index => $siswa) {
            fputcsv($handle, [
                $index + 1,
                $siswa->nama_lengkap,
                $siswa->nama_panggilan ?? '-',
                $siswa->layanan ?? '-',
                $siswa->guru->name ?? 'Belum diassign',
                $siswa->orangTua->name ?? '-',
                $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d/m/Y') : '-',
                $siswa->gender ?? '-',
                $siswa->status_assign ?? '-',
                $siswa->created_at->format('d/m/Y H:i')
            ]);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Export data guru
     */
    public function exportGuru(Request $request)
    {
        $query = User::where('role_type', 'guru')
                    ->withCount('assignedSiswa');
        
        $gurus = $query->get();
        
        $filename = 'data-guru-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://temp', 'w');
        
        fputcsv($handle, [
            'No',
            'Nama',
            'Email',
            'Divisi',
            'Jumlah Siswa',
            'Status',
            'Tanggal Daftar'
        ]);
        
        foreach ($gurus as $index => $guru) {
            fputcsv($handle, [
                $index + 1,
                $guru->name,
                $guru->email,
                $guru->guru_type ?? '-',
                $guru->assigned_siswa_count ?? 0,
                $guru->is_verified ? 'Terverifikasi' : 'Belum Verifikasi',
                $guru->created_at->format('d/m/Y H:i')
            ]);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Export data orang tua
     */
    public function exportOrtu(Request $request)
    {
        $query = User::where('role_type', 'orang_tua')
                    ->withCount('siswaList');
        
        $ortus = $query->get();
        
        $filename = 'data-orang-tua-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://temp', 'w');
        
        fputcsv($handle, [
            'No',
            'Nama',
            'Email',
            'Nama Anak',
            'Jumlah Siswa',
            'Status',
            'Tanggal Daftar'
        ]);
        
        foreach ($ortus as $index => $ortu) {
            fputcsv($handle, [
                $index + 1,
                $ortu->name,
                $ortu->email,
                $ortu->nama_anak ?? '-',
                $ortu->siswa_list_count ?? 0,
                $ortu->is_verified ? 'Terverifikasi' : 'Belum Verifikasi',
                $ortu->created_at->format('d/m/Y H:i')
            ]);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}