<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratKeteranganPindahDomisiliController;
use App\Http\Controllers\SuratKeteranganUsahaController;
use App\Http\Controllers\SuratKeteranganAktaNikahController;
use App\Http\Controllers\SaranController;
use App\Models\Artikel;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratSayaController;
use App\Http\Controllers\SuratPengantarIjinKeramaianController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratPindahDomisiliPerusahaanController;



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
    $artikels = Artikel::latest()->take(5)->get(); // Ambil 5 artikel terbaru
    return view('welcome', compact('artikels'));
});

// Berita
Route::get('/berita/{id}', [ArtikelController::class, 'detail'])->name('berita.detail');
Route::get('/berita', [ArtikelController::class, 'list'])->name('berita.list');

// Saran
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

// Persyaratan
Route::get('/persyaratan', function () {
    return view('pages.persyaratan.index');
})->name('persyaratan');



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('/dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin
    Route::resource('keterangan_domisili', SuratKeteranganPindahDomisiliController::class);
    Route::resource('keterangan_usaha', SuratKeteranganUsahaController::class);
    Route::resource('keterangan_akta_nikah', SuratKeteranganAktaNikahController::class);
    Route::resource('surat_pengantar_ijin_keramaian', SuratPengantarIjinKeramaianController::class);
    Route::resource('surat-pindah-perusahaan', SuratPindahDomisiliPerusahaanController::class);


    Route::get('/penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::resource('penduduk', PendudukController::class);



    // Surat Saya
    Route::get('/surat-saya', [SuratSayaController::class, 'index'])->name('surat.saya');

    // Artikel
    Route::resource('artikel', ArtikelController::class);

    // Saran
    Route::get('/saran', [SaranController::class, 'index'])->name('saran.index');
    Route::delete('/saran/{id}', [SaranController::class, 'destroy'])->name('saran.destroy');

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

    // // User
    // Route::get('/surat-keterangan-pindah/create', [SuratKeteranganPindahDomisiliController::class, 'createUser'])->name('surat-keterangan-pindah.create');
    // Route::post('/surat-keterangan-pindah/store', [SuratKeteranganPindahDomisiliController::class, 'storeUser'])->name('surat-keterangan-pindah.store');

    // Route::get('/surat-keterangan-akta-nikah/create', [SuratKeteranganAktaNikahController::class, 'createUser'])->name('surat-keterangan-akta-nikah.create');
    // Route::post('/surat-keterangan-akta-nikah/store', [SuratKeteranganAktaNikahController::class, 'storeUser'])->name('surat-keterangan-akta-nikah.store');
require __DIR__.'/auth.php';
