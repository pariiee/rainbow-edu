<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaBerkasController;

use App\Http\Controllers\Ortu\RegistrationFlowController;
use App\Http\Controllers\Ortu\OrtuHomeController;
use App\Http\Controllers\Ortu\JadwalOrtuController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Guru\JadwalController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| OTP ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/otp-verify', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
Route::post('/otp-verify', [OtpController::class, 'verifyOtp'])->name('otp.verify.submit');
Route::post('/otp-resend', [OtpController::class, 'resendOtp'])->name('otp.resend');


/*
|--------------------------------------------------------------------------
| Redirect After Verify
|--------------------------------------------------------------------------
*/

Route::get('/after-verify', function () {
    $user = auth()->user();

    if (!$user) return redirect()->route('login');

    if ($user->role_type === 'orang_tua') {
        $siswa = Siswa::where('orang_tua_id', $user->id)->first();

        if ($siswa && $siswa->layanan) {
            return redirect()->route('orangtua.home');
        }
        return redirect()->route('ortu.pilih.layanan');
    }

    if ($user->role_type === 'guru') {
        switch ($user->guru_type) {
            case 'PAUD': return redirect()->route('guru.paud.home');
            case 'Learn kursus': return redirect()->route('guru.learn.home');
            case 'Homelearning kursus private': return redirect()->route('guru.homelearning.home');
        }
    }

    if ($user->role_type === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('dashboard');
})->middleware('auth')->name('after.verify');


require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role_type === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role_type === 'guru') {
            switch ($user->guru_type) {
                case 'PAUD': return redirect()->route('guru.paud.home');
                case 'Learn kursus': return redirect()->route('guru.learn.home');
                case 'Homelearning kursus private': return redirect()->route('guru.homelearning.home');
            }
        }

        if ($user->role_type === 'orang_tua') {
            return redirect()->route('orangtua.home');
        }

        return view('dashboard');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES - COMPLETE
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/home', function () {
        return redirect()->route('admin.dashboard');
    })->name('admin.home');
    
    // User Management - Guru
    Route::prefix('users/guru')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserManagementController::class, 'guruIndex'])->name('admin.users.guru.index');
        Route::get('/create', [App\Http\Controllers\Admin\UserManagementController::class, 'guruCreate'])->name('admin.users.guru.create');
        Route::post('/', [App\Http\Controllers\Admin\UserManagementController::class, 'guruStore'])->name('admin.users.guru.store');
        Route::get('/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'guruShow'])->name('admin.users.guru.show');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\UserManagementController::class, 'guruEdit'])->name('admin.users.guru.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'guruUpdate'])->name('admin.users.guru.update');
        Route::post('/{id}/reset-password', [App\Http\Controllers\Admin\UserManagementController::class, 'guruResetPassword'])->name('admin.users.guru.reset');
        Route::delete('/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'guruDestroy'])->name('admin.users.guru.destroy');
    });
    
    // User Management - Orang Tua
    Route::prefix('users/ortu')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserManagementController::class, 'ortuIndex'])->name('admin.users.ortu.index');
        Route::get('/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'ortuShow'])->name('admin.users.ortu.show');
        Route::post('/{id}/reset-password', [App\Http\Controllers\Admin\UserManagementController::class, 'ortuResetPassword'])->name('admin.users.ortu.reset');
        Route::delete('/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'ortuDestroy'])->name('admin.users.ortu.destroy');
    });
    
    // Siswa Management
    Route::prefix('siswa')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SiswaManagementController::class, 'index'])->name('admin.siswa.index');
        Route::get('/{id}', [App\Http\Controllers\Admin\SiswaManagementController::class, 'show'])->name('admin.siswa.show');
        Route::post('/{id}/reassign-guru', [App\Http\Controllers\Admin\SiswaManagementController::class, 'reassignGuru'])->name('admin.siswa.reassign');
        Route::delete('/{id}', [App\Http\Controllers\Admin\SiswaManagementController::class, 'destroy'])->name('admin.siswa.destroy');
        
        // Export
        Route::get('/export/siswa', [App\Http\Controllers\Admin\SiswaManagementController::class, 'export'])->name('admin.siswa.export');
        Route::get('/export/guru', [App\Http\Controllers\Admin\SiswaManagementController::class, 'exportGuru'])->name('admin.siswa.export-guru');
        Route::get('/export/ortu', [App\Http\Controllers\Admin\SiswaManagementController::class, 'exportOrtu'])->name('admin.siswa.export-ortu');
    });
    
    // Broadcast
    Route::prefix('broadcast')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BroadcastController::class, 'index'])->name('admin.broadcast.index');
        Route::get('/create', [App\Http\Controllers\Admin\BroadcastController::class, 'create'])->name('admin.broadcast.create');
        Route::post('/', [App\Http\Controllers\Admin\BroadcastController::class, 'store'])->name('admin.broadcast.store');
        Route::get('/{id}', [App\Http\Controllers\Admin\BroadcastController::class, 'show'])->name('admin.broadcast.show');
        Route::post('/{id}/send', [App\Http\Controllers\Admin\BroadcastController::class, 'send'])->name('admin.broadcast.send');
        Route::delete('/{id}', [App\Http\Controllers\Admin\BroadcastController::class, 'destroy'])->name('admin.broadcast.destroy');
        Route::get('/stats/overview', [App\Http\Controllers\Admin\BroadcastController::class, 'stats'])->name('admin.broadcast.stats');
    });
});


/*
|--------------------------------------------------------------------------
| GURU ROUTES - FIX: SEPARATE ROUTES FOR DIFFERENT PARAMETERS
|--------------------------------------------------------------------------
*/

Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {

    // ============ DASHBOARD ============
    Route::get('/paud', [GuruDashboardController::class, 'paudHome'])->name('guru.paud.home');
    Route::get('/learn', [GuruDashboardController::class, 'learnHome'])->name('guru.learn.home');
    Route::get('/homelearning', [GuruDashboardController::class, 'homelearningHome'])->name('guru.homelearning.home');

    // ============ ROUTE KOMPATIBILITAS ============
    Route::get('/atur-jadwal/{siswaId}', [GuruDashboardController::class, 'aturJadwal'])->name('guru.atur.jadwal');

    // ============ JADWAL MANAGEMENT ============
    // Index - list semua jadwal
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('guru.jadwal.index');
    
    // Create jadwal untuk siswa tertentu
    Route::get('/jadwal/create/{siswaId}', [JadwalController::class, 'create'])->name('guru.jadwal.create');
    
    // Store jadwal baru
    Route::post('/jadwal/store/{siswaId}', [JadwalController::class, 'store'])->name('guru.jadwal.store');
    
    // Lihat jadwal berdasarkan siswa (redirect ke create atau detail)
    Route::get('/jadwal/siswa/{siswaId}', [JadwalController::class, 'bySiswa'])->name('guru.jadwal.siswa');
    
    // Detail jadwal berdasarkan ID jadwal
    Route::get('/jadwal/detail/{id}', [JadwalController::class, 'detail'])->name('guru.jadwal.detail');
    
    // Update status jadwal
    Route::put('/jadwal/{id}/status', [JadwalController::class, 'updateStatus'])->name('guru.jadwal.status');
    
    // Respond to replacement proposal
    Route::post('/jadwal/{id}/respond-replacement', [JadwalController::class, 'respondReplacement'])->name('guru.jadwal.respondReplacement');
    
    // Delete jadwal
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('guru.jadwal.destroy');
});


/*
|--------------------------------------------------------------------------
| ORANG TUA ROUTES - UPDATED WITH FORM ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('orangtua')->middleware(['auth', 'role:orang_tua'])->group(function () {

    // ============ DASHBOARD/HOME ============
    Route::get('/home', [OrtuHomeController::class, 'index'])->name('orangtua.home');

    // ============ REGISTRATION FLOW - PILIH LAYANAN ============
    // Pilih Layanan - 3 PILIHAN (PAUD, Learn, Homelearning)
    Route::get('/pilih-layanan', [RegistrationFlowController::class, 'pilihLayanan'])->name('ortu.pilih.layanan');
    Route::post('/pilih-layanan', [RegistrationFlowController::class, 'storeLayanan'])->name('ortu.store.layanan');

    // ============ FORM DATA SISWA - REPLACES PERTANYAAN MIGRATION ============
    // Form untuk mengisi data lengkap siswa (setelah pilih layanan)
    Route::get('/form', [RegistrationFlowController::class, 'showForm'])->name('ortu.form');
    Route::post('/form', [RegistrationFlowController::class, 'storeForm'])->name('ortu.store.form');
    
    // Optional: Form dengan parameter siswaId (jika ingin mengedit data siswa tertentu)
    Route::get('/form/{siswaId}', [RegistrationFlowController::class, 'showForm'])->name('ortu.form.edit');
    Route::put('/form/{siswaId}', [RegistrationFlowController::class, 'updateForm'])->name('ortu.form.update');

    // ============ FORM SUBMISSION SUCCESS ============
    Route::get('/form-sukses', function () {
        return view('ortu.form-success');
    })->name('ortu.form.success');

    // ============ JADWAL ORANG TUA ============
    Route::get('/jadwal', [JadwalOrtuController::class, 'index'])->name('ortu.jadwal.index');
    Route::get('/jadwal/{id}', [JadwalOrtuController::class, 'show'])->name('ortu.jadwal.show');
    Route::post('/jadwal/{id}/approve', [JadwalOrtuController::class, 'approve'])->name('ortu.jadwal.approve');
    Route::post('/jadwal/{id}/reject', [JadwalOrtuController::class, 'reject'])->name('ortu.jadwal.reject');
    Route::post('/jadwal/{id}/propose-replacement', [JadwalOrtuController::class, 'proposeReplacement'])->name('ortu.jadwal.proposeReplacement');

    // ============ CHAT DARI ORANG TUA ============
    Route::get('/chat/{siswaId}', [ChatController::class, 'show'])->name('ortu.chat.show');

    // ============ STATUS DAN PROGRESS ============
    Route::get('/status', [OrtuHomeController::class, 'status'])->name('ortu.status');
    Route::get('/progress/{siswaId}', [OrtuHomeController::class, 'progress'])->name('ortu.progress');
});


/*
|--------------------------------------------------------------------------
| SISWA ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::delete('/siswa/berkas/{id}', [SiswaBerkasController::class, 'destroy'])->name('siswa.berkas.destroy');
});


/*
|--------------------------------------------------------------------------
| CHAT ROUTES - REALTIME
|--------------------------------------------------------------------------
| PENTING: Route spesifik (tanpa parameter) harus di atas route
| dengan wildcard parameter {siswaId} agar tidak salah tangkap.
*/

Route::middleware(['auth'])->group(function () {

    // ── Static routes dulu (SEBELUM wildcard) ──────────────────────────

    // Polling pesan baru (tanpa reload halaman)
    Route::get('/chat/poll', [ChatController::class, 'poll'])->name('chat.poll');

    // Kirim pesan
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

    // Jumlah pesan belum dibaca
    Route::get('/chat/unread/count', [ChatController::class, 'unreadCount'])->name('chat.unread');

    // Tandai pesan sebagai sudah dibaca
    Route::post('/chat/mark-read', [ChatController::class, 'markAsRead'])->name('chat.markread');

    // ── Wildcard routes setelah ini ────────────────────────────────────

    // Chat history (AJAX)
    Route::get('/chat/history/{siswaId}/{guruId}', [ChatController::class, 'history'])->name('chat.history');

    // Chat utama — parameter guruId opsional
    Route::get('/chat/{siswaId}/{guruId?}', [ChatController::class, 'show'])->name('chat.show');
});



/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| DEBUG ROUTE (HAPUS DI PRODUCTION)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/debug/assign-siswa', function () {
        $user = Auth::user();

        if ($user->role_type !== 'guru') {
            return 'Hanya untuk guru';
        }

        $siswa = Siswa::with('orangTua')
            ->where('guru_id', $user->id)
            ->get();

        return response()->json([
            'guru' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'guru_type' => $user->guru_type,
            ],
            'total_siswa' => $siswa->count(),
            'siswa_list' => $siswa->map(function ($s) {
                return [
                    'id' => $s->id,
                    'nama' => $s->nama_lengkap,
                    'layanan' => $s->layanan,
                    'status' => $s->status_assign,
                    'orang_tua' => $s->orangTua->name ?? '-',
                ];
            }),
        ]);
    })->name('debug.assign');
    
    // Debug route untuk cek status form
    Route::get('/debug/form-status', function () {
        $user = Auth::user();
        
        if ($user->role_type !== 'orang_tua') {
            return 'Hanya untuk orang tua';
        }
        
        $siswa = Siswa::where('orang_tua_id', $user->id)->first();
        
        return response()->json([
            'user' => $user->name,
            'siswa' => $siswa ? [
                'id' => $siswa->id,
                'nama' => $siswa->nama_lengkap,
                'layanan' => $siswa->layanan,
                'has_completed_layanan' => !is_null($siswa->layanan),
                'has_completed_questionnaire' => !is_null($siswa->tempat_lahir) && 
                                                !is_null($siswa->tanggal_lahir) && 
                                                !is_null($siswa->alamat),
                'questionnaire_fields' => [
                    'tempat_lahir' => $siswa->tempat_lahir,
                    'tanggal_lahir' => $siswa->tanggal_lahir,
                    'alamat' => $siswa->alamat,
                    'nama_ayah' => $siswa->nama_ayah,
                    'nama_ibu' => $siswa->nama_ibu,
                    'no_telepon_ortu' => $siswa->no_telepon_ortu,
                ]
            ] : null
        ]);
    })->name('debug.form-status');
});