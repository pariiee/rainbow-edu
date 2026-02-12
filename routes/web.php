<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
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
        return redirect()->route('admin.home');
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
            return redirect()->route('admin.home');
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
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', fn() => view('admin.home'))->name('admin.home');
});


/*
|--------------------------------------------------------------------------
| GURU ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {

    // Dashboard
    Route::get('/paud', [GuruDashboardController::class, 'paudHome'])->name('guru.paud.home');
    Route::get('/learn', [GuruDashboardController::class, 'learnHome'])->name('guru.learn.home');
    Route::get('/homelearning', [GuruDashboardController::class, 'homelearningHome'])->name('guru.homelearning.home');

    /*
    |--------------------------------------------------------------------------
    | GURU JADWAL
    |--------------------------------------------------------------------------
    */

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('guru.jadwal.index');
    Route::get('/jadwal/{id}', [JadwalController::class, 'show'])->name('guru.jadwal.show');
    Route::post('/jadwal/{siswaId}', [JadwalController::class, 'store'])->name('guru.jadwal.store');
    Route::put('/jadwal/{id}/status', [JadwalController::class, 'updateStatus'])->name('guru.jadwal.status');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('guru.jadwal.destroy');
});


/*
|--------------------------------------------------------------------------
| ORANG TUA ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('orangtua')->middleware(['auth', 'role:orang_tua'])->group(function () {

    Route::get('/home', [OrtuHomeController::class, 'index'])->name('orangtua.home');

    Route::get('/pilih-layanan', [RegistrationFlowController::class, 'pilihLayanan'])->name('ortu.pilih.layanan');
    Route::post('/pilih-layanan', [RegistrationFlowController::class, 'storeLayanan'])->name('ortu.store.layanan');

    Route::get('/pertanyaan/{siswaId}', [RegistrationFlowController::class, 'pertanyaanMigration'])->name('ortu.pertanyaan.migration');
    Route::post('/pertanyaan/{siswaId}', [RegistrationFlowController::class, 'storePertanyaan'])->name('ortu.store.pertanyaan');

    /*
    |--------------------------------------------------------------------------
    | ORTU JADWAL
    |--------------------------------------------------------------------------
    */

    Route::get('/jadwal', [JadwalOrtuController::class, 'index'])->name('ortu.jadwal.index');
    Route::get('/jadwal/{id}', [JadwalOrtuController::class, 'show'])->name('ortu.jadwal.show');
    Route::post('/jadwal/{id}/approve', [JadwalOrtuController::class, 'approve'])->name('ortu.jadwal.approve');
    Route::post('/jadwal/{id}/reject', [JadwalOrtuController::class, 'reject'])->name('ortu.jadwal.reject');
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
});


/*
|--------------------------------------------------------------------------
| CHAT ROUTES - REALTIME
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{siswaId}/{guruId?}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/unread/count', [ChatController::class, 'unreadCount'])->name('chat.unread');
    Route::post('/chat/mark-read', [ChatController::class, 'markAsRead'])->name('chat.markread');
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
