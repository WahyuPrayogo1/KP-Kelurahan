<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keterangan_bekerja_luar_negeris', function (Blueprint $table) {
            $table->id();

            // Data Pemohon
            $table->string('nama_pemohon');
            $table->string('nik_pemohon')->unique();
            $table->string('tempat_lahir_pemohon');
            $table->date('tanggal_lahir_pemohon');
            $table->string('pekerjaan_pemohon');
            $table->string('status_perkawinan_pemohon');
            $table->string('agama_pemohon');
            $table->text('alamat_pemohon');

            // Data Pekerja
            $table->enum('hubungan_dengan_pekerja', ['orang tua', 'suami', 'istri', 'anak', 'saudara']);
            $table->string('nama_pekerja');
            $table->string('nik_pekerja');
            $table->string('tempat_lahir_pekerja');
            $table->date('tanggal_lahir_pekerja');
            $table->enum('jenis_kelamin_pekerja', ['L', 'P']);
            $table->string('kewarganegaraan_pekerja');
            $table->string('agama_pekerja');
            $table->text('alamat_pekerja');
            $table->string('negara_tujuan');

            // Dokumen
            $table->string('fc_ktp');
            $table->string('fc_kk');
            $table->string('surat_pernyataan_bekerja');
            $table->string('pengantar_rt_rw');

            // Metadata
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['proses', 'selesai', 'ditolak'])->default('proses');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_bekerja_luar_negeris');
    }
};
