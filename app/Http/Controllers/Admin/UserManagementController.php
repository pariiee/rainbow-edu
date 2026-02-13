<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Daftar semua guru
     */
    public function guruIndex(Request $request)
    {
        $query = User::where('role_type', 'guru')
                    ->withCount('assignedSiswa');
        
        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter by guru type
        if ($request->filled('guru_type')) {
            $query->where('guru_type', $request->guru_type);
        }
        
        // Filter by verification status
        if ($request->filled('verified')) {
            $query->where('is_verified', $request->verified);
        }
        
        $gurus = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $guruTypes = [
            'PAUD' => 'PAUD',
            'Learn kursus' => 'Learn Kursus',
            'Homelearning kursus private' => 'Home Learning'
        ];
        
        return view('admin.users.guru-index', compact('gurus', 'guruTypes'));
    }

    /**
     * Detail guru
     */
    public function guruShow($id)
    {
        $guru = User::where('role_type', 'guru')
                   ->with(['assignedSiswa' => function($q) {
                       $q->with('orangTua');
                   }])
                   ->findOrFail($id);
                   
        $jadwals = $guru->jadwalGuru()
                       ->with('siswa')
                       ->orderBy('tanggal', 'desc')
                       ->limit(10)
                       ->get();
                       
        return view('admin.users.guru-show', compact('guru', 'jadwals'));
    }

    /**
     * Tambah guru baru
     */
    public function guruCreate()
    {
        return view('admin.users.guru-create');
    }

    /**
     * Store guru baru
     */
    public function guruStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'guru_type' => 'required|in:PAUD,Learn kursus,Homelearning kursus private',
            'password' => 'nullable|string|min:8',
        ]);

        DB::beginTransaction();
        try {
            $password = $request->password ?? Str::random(10);
            
            $guru = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($password),
                'role_type' => 'guru',
                'guru_type' => $request->guru_type,
                'is_verified' => true,
                'verified_at' => now(),
                'created_by' => auth()->id()
            ]);

            // Assign role
            $role = Role::firstOrCreate(['name' => 'guru', 'guard_name' => 'web']);
            $guru->assignRole($role);

            DB::commit();

            return redirect()->route('admin.users.guru.show', $guru->id)
                ->with('success', 'Guru berhasil ditambahkan. Password: ' . $password);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan guru: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Edit guru
     */
    public function guruEdit($id)
    {
        $guru = User::where('role_type', 'guru')->findOrFail($id);
        return view('admin.users.guru-edit', compact('guru'));
    }

    /**
     * Update guru
     */
    public function guruUpdate(Request $request, $id)
    {
        $guru = User::where('role_type', 'guru')->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'guru_type' => 'required|in:PAUD,Learn kursus,Homelearning kursus private',
            'is_verified' => 'boolean'
        ]);

        $guru->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'guru_type' => $request->guru_type,
            'is_verified' => $request->is_verified ?? $guru->is_verified
        ]);

        return redirect()->route('admin.users.guru.show', $guru->id)
            ->with('success', 'Data guru berhasil diperbarui');
    }

    /**
     * Reset password guru
     */
    public function guruResetPassword($id)
    {
        $guru = User::where('role_type', 'guru')->findOrFail($id);
        
        $newPassword = Str::random(10);
        $guru->password = Hash::make($newPassword);
        $guru->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset',
            'password' => $newPassword
        ]);
    }

    /**
     * Delete guru
     */
    public function guruDestroy($id)
    {
        $guru = User::where('role_type', 'guru')->findOrFail($id);
        
        // Cek apakah masih punya siswa
        if ($guru->assignedSiswa()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Guru masih memiliki siswa. Pindahkan siswa terlebih dahulu.'
            ], 400);
        }

        $guru->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guru berhasil dihapus'
        ]);
    }

    /**
     * Daftar semua orang tua
     */
    public function ortuIndex(Request $request)
    {
        $query = User::where('role_type', 'orang_tua')
                    ->withCount('siswaList');
        
        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_anak', 'like', '%' . $request->search . '%');
            });
        }
        
        $ortus = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.users.ortu-index', compact('ortus'));
    }

    /**
     * Detail orang tua
     */
    public function ortuShow($id)
    {
        $ortu = User::where('role_type', 'orang_tua')
                   ->with(['siswaList' => function($q) {
                       $q->with('guru');
                   }])
                   ->findOrFail($id);
                   
        return view('admin.users.ortu-show', compact('ortu'));
    }

    /**
     * Reset password orang tua
     */
    public function ortuResetPassword($id)
    {
        $ortu = User::where('role_type', 'orang_tua')->findOrFail($id);
        
        $newPassword = Str::random(10);
        $ortu->password = Hash::make($newPassword);
        $ortu->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil direset',
            'password' => $newPassword
        ]);
    }

    /**
     * Delete orang tua
     */
    public function ortuDestroy($id)
    {
        $ortu = User::where('role_type', 'orang_tua')->findOrFail($id);
        
        // Cek apakah masih punya siswa
        if ($ortu->siswaList()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Orang tua masih memiliki data siswa. Hapus siswa terlebih dahulu.'
            ], 400);
        }

        $ortu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Orang tua berhasil dihapus'
        ]);
    }
}