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
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');
            $table->string('foto_ktp');
            $table->string('foto_kartu_keluarga');
            $table->string('foto_akta_kelahiran');
            $table->string('foto_ijazah');
            $table->string('foto_pengantar_na_rt_rw');
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
        Schema::dropIfExists('surat_keterangan_akta_nikahs');
    }
};
