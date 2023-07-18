<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KandidatController;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kandidat', [KandidatController::class, 'index'])->name('kandidat.index');
    Route::get('/kandidat/create', [KandidatController::class, 'create'])->name('kandidat.create');
    Route::post('/kandidat', [KandidatController::class, 'store'])->name('kandidat.store');
    Route::get('/pemilihan', [PemilihanController::class, 'index'])->name('pemilihan.index');
    // Rute untuk halaman sukses pemilihan
    Route::get('/pemilihan/success', [PemilihanController::class, 'success'])->name('pemilihan.success');
});

Route::middleware('admin')->group(function () {
    Route::get('/user', function () {
        return view('user');
    });
});
