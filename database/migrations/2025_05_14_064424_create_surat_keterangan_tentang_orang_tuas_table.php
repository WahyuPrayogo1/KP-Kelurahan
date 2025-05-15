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
        Schema::create('surat_keterangan_tentang_orang_tuas', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nik')->unique();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('no_hp');
                $table->enum('jenis_kelamin', ['L', 'P']);
                $table->text('alamat_lengkap');
                $table->string('tempat_lahir');

                // Dokumen lampiran
                $table->string('fc_ktp');
                $table->string('fc_kk');
                $table->string('fc_akte_lahir');
                $table->string('fc_buku_nikah_ortu');
                $table->string('surat_pernyataan_ahli_waris');
                $table->string('pengantar_rt_rw');

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
        Schema::dropIfExists('surat_keterangan_tentang_orang_tuas');
    }
};
