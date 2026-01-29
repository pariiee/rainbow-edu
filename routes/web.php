<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
})->name('home');

// OTP Routes
Route::get('/otp-verify', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
Route::post('/otp-verify', [OtpController::class, 'verifyOtp'])->name('otp.verify.submit');
Route::post('/otp-resend', [OtpController::class, 'resendOtp'])->name('otp.resend');

// Auth Routes
require __DIR__.'/auth.php';

// Dashboard berdasarkan role
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.home');
        }

        if ($user->hasRole('guru')) {
            switch ($user->guru_type) {
                case 'PAUD':
                    return redirect()->route('guru.paud.home');
                case 'Learn kursus':
                    return redirect()->route('guru.learn.home');
                case 'Homelearning kursus private':
                    return redirect()->route('guru.homelearning.home');
                default:
                    return view('dashboard');
            }
        }

        if ($user->hasRole('orang_tua')) {
            return redirect()->route('orangtua.home');
        }

        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');
});

// Guru Routes
Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/paud', function () {
        return view('guru.guru-paud');
    })->name('guru.paud.home');

    Route::get('/learn', function () {
        return view('guru.guru-learn');
    })->name('guru.learn.home');

    Route::get('/homelearning', function () {
        return view('guru.guru-homelearning');
    })->name('guru.homelearning.home');
});

// Orang Tua Routes
Route::prefix('orangtua')->middleware(['auth', 'role:orang_tua'])->group(function () {
    Route::get('/home', function () {
        return view('ortu.home');
    })->name('orangtua.home');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/siswa/create', [SiswaController::class, 'create']);
Route::post('/siswa', [SiswaController::class, 'store']);
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');