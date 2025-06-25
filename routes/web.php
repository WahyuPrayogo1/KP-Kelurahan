<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratKeteranganPindahDomisiliController;
use App\Http\Controllers\SuratKeteranganUsahaController;
use App\Http\Controllers\SuratKeteranganTidakMampuController;
use App\Http\Controllers\SuratKeteranganMiskinController;
use App\Http\Controllers\SuratKeteranganAktaNikahController;
use App\Http\Controllers\SaranController;
use App\Models\Artikel;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratSayaController;
use App\Http\Controllers\SuratPengantarIjinKeramaianController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratPindahDomisiliPerusahaanController;
use App\Http\Controllers\SuratKeteranganBedaDataKependudukanController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\SektorPekerjaanController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\SuratKeteranganBekerjaLuarNegeriController;
use App\Http\Controllers\SuratKeteranganKematianController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\RekapSuratController;



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
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    $artikels = Artikel::latest()->take(5)->get(); // Ambil 5 artikel terbaru
    return view('welcome', compact('artikels'));
});

Route::get('/test-wa', function () {
    $phone = '6281212823970'; // ganti dengan nomor WA kamu
    $message = "Halo Wahyu!\n\nIni adalah tes kirim WhatsApp dari Laravel pakai Wablas.";

    $response = Http::withHeaders([
        'Authorization' => env('WABLAS_TOKEN') . '.' . env('WABLAS_SECRET_KEY'),
        'Content-Type' => 'application/x-www-form-urlencoded',
    ])->asForm()->post(env('WABLAS_URL') . '/api/send-message', [
        'phone' => $phone,
        'message' => $message,
    ]);

    return $response->body();
});

// Reset Password Routes
Route::get('/lupa-password', [ForgotPasswordController::class, 'showForm'])
     ->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])
     ->name('password.send');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])
     ->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])
     ->name('password.update');

// Berita
Route::get('/berita/{id}', [ArtikelController::class, 'detail'])->name('berita.detail');
Route::get('/berita', [ArtikelController::class, 'list'])->name('berita.list');

//Tentang Kami
Route::get('/tentang-kami', [TentangKamiController::class, 'tentangKami'])->name('tentangKami.list');

// Saran
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

// Persyaratan
Route::get('/persyaratan', function () {
    return view('pages.persyaratan.index');
})->name('persyaratan');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('/dashboard');

    // Start Lupa Password
        Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.send');
    // END


Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin
    Route::resource('keterangan_domisili', SuratKeteranganPindahDomisiliController::class);
    Route::resource('surat_keterangan_usahas', SuratKeteranganUsahaController::class);

    // Start beda-data-kependudukan
    Route::resource('beda-data-kependudukan', SuratKeteranganBedaDataKependudukanController::class);
    Route::get('/beda-data-kependudukan/{id}/preview-pdf', [SuratKeteranganBedaDataKependudukanController::class, 'previewPdf'])->name('beda-data-kependudukan.preview-pdf');
    Route::post('/beda-data-kependudukan/{id}/generate-pdf', [SuratKeteranganBedaDataKependudukanController::class, 'generatePdf'])->name('beda-data-kependudukan.generate-pdf');
    // END

    // Start Ketarangan Tidak Mampu
        Route::resource('surat_keterangan_tidak_mampu', SuratKeteranganTidakMampuController::class);
        Route::prefix('sktm')->group(function () {
            // ... existing routes ...
            Route::get('/{id}/preview-pdf', [SuratKeteranganTidakMampuController::class, 'previewPdf'])->name('sktm.preview-pdf');
            Route::post('/{id}/generate-pdf', [SuratKeteranganTidakMampuController::class, 'generatePdf'])->name('sktm.generate-pdf');
        });
    //END

    // Start Keterangan Miskin
        Route::resource('surat_keterangan_miskin', SuratKeteranganMiskinController::class);
          Route::prefix('miskin')->group(function () {
            // ... existing routes ...
            Route::get('/{id}/preview-pdf', [SuratKeteranganMiskinController::class, 'previewPdf'])->name('miskin.preview-pdf');
            Route::post('/{id}/generate-pdf', [SuratKeteranganMiskinController::class, 'generatePdf'])->name('miskin.generate-pdf');
        });
    // END

    //start akta nikah
        Route::resource('keterangan_akta_nikah', SuratKeteranganAktaNikahController::class);
        Route::get('/keterangan-akta-nikah/{id}/preview-pdf', [SuratKeteranganAktaNikahController::class, 'previewPdf'])->name('keterangan_akta_nikah.preview-pdf');
        Route::post('/keterangan-akta-nikah/{id}/generate-pdf', [SuratKeteranganAktaNikahController::class, 'generatePdf'])->name('keterangan_akta_nikah.generate-pdf');
     // End akta nikah

    // Start Bekerja luar negeri
        Route::resource('surat-bekerja-luar-negeri', SuratKeteranganBekerjaLuarNegeriController::class);
        Route::get('/surat-bekerja-luar-negeri/{id}/preview-pdf', [SuratKeteranganBekerjaLuarNegeriController::class, 'previewPdf'])->name('surat-bekerja-luar-negeri.preview-pdf');
        Route::post('/surat-bekerja-luar-negeri/{id}/generate-pdf', [SuratKeteranganBekerjaLuarNegeriController::class, 'generatePdf'])->name('surat-bekerja-luar-negeri.generate-pdf');
    // end Bekerja luar negeri

    //start surat keterangan kematian
        Route::resource('surat_keterangan_kematian', \App\Http\Controllers\SuratKeteranganKematianController::class);
        Route::get('/surat-keterangan-kematian/{id}/preview-pdf', [\App\Http\Controllers\SuratKeteranganKematianController::class, 'previewPdf'])->name('surat_keterangan_kematian.preview-pdf');
        Route::post('/surat-keterangan-kematian/{id}/generate-pdf', [\App\Http\Controllers\SuratKeteranganKematianController::class, 'generatePdf'])->name('surat_keterangan_kematian.generate-pdf');
    //end surat keterangan kematian

    // Start Ijin Keramain
        Route::resource('surat_pengantar_ijin_keramaian', SuratPengantarIjinKeramaianController::class);
        Route::get('/surat-pengantar-ijin-keramaian/{id}/preview-pdf', [SuratPengantarIjinKeramaianController::class, 'previewPdf'])->name('surat.preview-pdf');
        Route::post('/surat-pengantar-ijin-keramaian/{id}/generate-pdf', [SuratPengantarIjinKeramaianController::class, 'generatePdf'])->name('surat.generate-pdf');
    // End Ijin Keramain

    // Start Surat Pindah Perusahaan
    Route::resource('surat-pindah-perusahaan', SuratPindahDomisiliPerusahaanController::class);
    Route::get('/surat-pindah-perusahaan/{id}/preview-pdf', [SuratPindahDomisiliPerusahaanController::class, 'previewPdf'])->name('surat-pindah-perusahaan.preview-pdf');

    Route::post('/surat-pindah-perusahaan/{id}/generate-pdf', [SuratPindahDomisiliPerusahaanController::class, 'generatePdf'])->name('surat-pindah-perusahaan.generate-pdf');
    // End Surat Pindah Perusahaan

    Route::get('/penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::resource('penduduk', PendudukController::class);
    Route::resource('sektor-pekerjaan', SektorPekerjaanController::class);
    Route::resource('pekerjaan', PekerjaanController::class);

    // Surat Saya
    Route::get('/surat-saya', [SuratSayaController::class, 'index'])->name('surat.saya');

    //rekap surat
    Route::get('/rekap', [RekapSuratController::class, 'index'])->name('rekap');
    Route::get('/rekap/export', [RekapSuratController::class, 'export'])->name('rekap.export');

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
    })
        ->name('file.preview')
        ->middleware('auth');
});

// // User
// Route::get('/surat-keterangan-pindah/create', [SuratKeteranganPindahDomisiliController::class, 'createUser'])->name('surat-keterangan-pindah.create');
// Route::post('/surat-keterangan-pindah/store', [SuratKeteranganPindahDomisiliController::class, 'storeUser'])->name('surat-keterangan-pindah.store');

// Route::get('/surat-keterangan-akta-nikah/create', [SuratKeteranganAktaNikahController::class, 'createUser'])->name('surat-keterangan-akta-nikah.create');
// Route::post('/surat-keterangan-akta-nikah/store', [SuratKeteranganAktaNikahController::class, 'storeUser'])->name('surat-keterangan-akta-nikah.store');
require __DIR__ . '/auth.php';
