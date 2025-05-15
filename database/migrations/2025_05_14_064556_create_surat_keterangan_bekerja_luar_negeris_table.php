<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keterangan_bekerja_luar_negeris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('negara_tujuan')->nullable(); // opsional, bisa diisi negara kerja

            // Dokumen lampiran
            $table->string('fc_ktp'); // 1. Fotocopy KTP
            $table->string('fc_kk'); // 2. Fotocopy KK
            $table->string('surat_pernyataan_bekerja'); // 3. Surat Pernyataan bekerja di luar negeri dari suami/istri
            $table->string('pengantar_rt_rw'); // 4. Surat Pengantar dari RT/RW

            $table->enum('status', ['proses', 'selesai', 'ditolak'])->default('proses');
            $table->text('catatan')->nullable();
            $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_bekerja_luar_negeris');
    }
};
