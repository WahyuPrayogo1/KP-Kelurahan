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
        Schema::create('surat_pengantar_ijin_keramaians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('jabatan_pemohon')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->string('nama_organisasi');
            $table->string('alamat_organisasi')->nullable();


            $table->string('mengadakan_keramain');
            $table->string('hiburan')->nullable();
            $table->string('waktu');
            $table->string('tempat');

            // Dokumen lampiran
            $table->string('foto_ktp'); // Fotocopy KTP
            $table->string('foto_kartu_keluarga'); // Fotocopy KK
            $table->string('foto_pernyataan_tetangga'); // Surat pernyataan + FC KTP tetangga
            $table->string('foto_pengantar_rt_rw'); // Surat Pengantar RT/RW

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
        Schema::dropIfExists('surat_pengantar_ijin_keramaians');
    }
};
