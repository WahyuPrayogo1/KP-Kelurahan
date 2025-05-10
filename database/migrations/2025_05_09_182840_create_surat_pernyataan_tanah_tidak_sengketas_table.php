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
       Schema::create('surat_pernyataan_tanah_tidak_sengketas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');

            // Dokumen lampiran
            $table->string('foto_ktp'); // 1. Fotocopy KTP
            $table->string('foto_kartu_keluarga'); // 2. Fotocopy KK
            $table->string('foto_pernyataan_tanah'); // 3. Surat pernyataan tanah tidak sengketa
            $table->string('foto_sppt'); // 4. Fotocopy SPPT
            $table->string('foto_ajb_sertifikat'); // 5. Fotocopy AJB/Sertifikat
            $table->string('foto_pengantar_rt_rw'); // 6. Surat Pengantar dari RT/RW setempat

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
        Schema::dropIfExists('surat_pernyataan_tanah_tidak_sengketas');
    }
};
