<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratKeteranganPindahDomisiliController;
use App\Http\Controllers\SuratKeteranganUsahaController;

use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
    Route::resource('keterangan_usaha', SuratKeteranganUsahaController::class);


    Route::get('/file-preview', function (Request $request) {
        $path = $request->query('path');

        // Validasi path tidak kosong dan file ada
        if (!$path || !Storage::disk('private')->exists($path)) {
            abort(404);
        }

        // Opsional: batasi hanya user tertentu (misal admin) yang boleh akses
        if (!auth()->check()) {
            abort(403); // Forbidden
        }

        // Return file dari storage private
        return response()->file(Storage::disk('private')->path($path));
    })->name('file.preview')->middleware('auth');



});

    // User
    Route::get('/surat-keterangan-pindah/create', [SuratKeteranganPindahDomisiliController::class, 'createUser'])->name('surat-keterangan-pindah.create');
    Route::post('/surat-keterangan-pindah/store', [SuratKeteranganPindahDomisiliController::class, 'storeUser'])->name('surat-keterangan-pindah.store');
require __DIR__.'/auth.php';
