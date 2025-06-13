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
        Schema::create('surat_keterangan_usahas', function (Blueprint $table) {
            $table->id();
            // Atas
            $table->string('nama');
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('kewarganegaraan');
            $table->string('pekerjaan');
            $table->string('status_perkawinan');
            $table->string('agama');

            // Bawah
            $table->string('nama_usaha');
            $table->string('jenis_usaha');
            $table->string('alamat_usaha');
            $table->string('status_bangunan');
            $table->string('no_sppt');
            $table->string('akta_pendirian_usaha');
            $table->string('jumlah_karyawan');
            $table->string('pimpinan_usaha');

            $table->string('foto_ktp');
            $table->string('foto_kartu_keluarga');
            $table->string('foto_surat_pernyataan_tetangga');
            $table->string('foto_surat_pernyataan_usaha');
            $table->string('foto_usaha');
            $table->string('foto_pengantar_rt_rw');
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
        Schema::dropIfExists('surat_keterangan_usahas');
    }
};
