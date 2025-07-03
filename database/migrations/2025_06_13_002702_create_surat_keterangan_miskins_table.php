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
        Schema::create('surat_keterangan_miskins', function (Blueprint $table) {
            $table->id();
              // Data Pemohon
            $table->string('nama');
            $table->string('nik');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kewarganegaraan');
            $table->string('pekerjaan');
            $table->string('status_perkawinan');
            $table->string('agama');
            $table->text('alamat');

            // Dokumen
            $table->string('foto_ktp');
            $table->string('foto_kk');
            $table->string('foto_pengantar_rt_rw');

            // Status
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
        Schema::dropIfExists('surat_keterangan_miskins');
    }
};
