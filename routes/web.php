<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratKeteranganPindahDomisiliController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('/dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin
    Route::resource('keterangan_domisili', SuratKeteranganPindahDomisiliController::class);


});

    // User
    Route::get('/surat-keterangan-pindah/create', [SuratKeteranganPindahDomisiliController::class, 'createUser'])->name('surat-keterangan-pindah.create');
    Route::post('/surat-keterangan-pindah/store', [SuratKeteranganPindahDomisiliController::class, 'storeUser'])->name('surat-keterangan-pindah.store');
require __DIR__.'/auth.php';
