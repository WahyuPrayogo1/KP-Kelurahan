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
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');
            $table->string('foto_ktp');
            $table->string('foto_kartu_keluarga');
            $table->string('foto_akta_kelahiran');
            $table->string('foto_ijazah');
            $table->string('surat_pengantar_na');
            $table->string('surat_pengantar_rt_rw');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
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
