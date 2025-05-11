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
        Schema::create('surat_keterangan_beda_data_kependudukans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');

            // Dokumen lampiran sesuai permintaan terbaru
            $table->string('fc_ktp'); // 1. Fotocopy KTP
            $table->string('fc_kk'); // 2. Fotocopy KK
            $table->string('surat_pernyataan_beda_data'); // 3. Surat Pernyataan beda data kependudukan
            $table->string('bukti_beda_data'); // 4. Bukti beda data dilampirkan
            $table->string('pengantar_rt_rw'); // 5. Surat Pengantar dari RT/RW setempat

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
        Schema::dropIfExists('surat_keterangan_beda_data_kependudukans');
    }
};
