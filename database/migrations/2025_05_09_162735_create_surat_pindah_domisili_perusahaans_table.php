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
        Schema::create('surat_pindah_domisili_perusahaans', function (Blueprint $table) {
            $table->id();
             // Data pengaju (perorangan)
            $table->string('nama');
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');

            // Dokumen lampiran
            $table->string('foto_ktp'); // Fotocopy KTP
            $table->string('foto_kk'); // Fotocopy KK
            $table->string('foto_pernyataan_pindah'); // Surat pernyataan pindah domisili perusahaan/yayasan
            $table->string('foto_akte_notaris'); // Akte notaris peralihan
            $table->string('foto_pengantar_rt_rw'); // Surat Pengantar RT/RW

            // Status permohonan
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
        Schema::dropIfExists('surat_pindah_domisili_perusahaans');
    }
};
