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
        Schema::create('surat_keterangan_akta_nikahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->enum('status_perkawinan', ['BELUM KAWIN', 'KAWIN', 'CERAI HIDUP', 'CERAI MATI']);
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->text('alamat_lengkap');
            $table->string('no_kk');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('foto_ktp');
            $table->string('foto_kartu_keluarga');
            // Tambahan kolom baru
            $table->string('foto_surat_pernyataan_nikah');
            $table->string('foto_surat_pengantar_rt_rw');
            // End tambahan kolom baru
            $table->enum('status', ['proses', 'selesai', 'revisi'])->default('proses');
            $table->text('catatan')->nullable();
            $table->date('tanggal_dikeluarkan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_akta_nikahs');
    }
};
