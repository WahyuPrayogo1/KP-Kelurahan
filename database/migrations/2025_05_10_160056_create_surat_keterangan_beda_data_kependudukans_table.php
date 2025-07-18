<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeteranganBedaDataKependudukansTable extends Migration
{
    public function up()
    {
        Schema::create('surat_keterangan_beda_data_kependudukans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('kewarganegaraan');
            $table->string('pekerjaan');
            $table->enum('status_perkawinan', ['BELUM KAWIN', 'KAWIN', 'CERAI HIDUP', 'CERAI MATI']);
            $table->string('agama');
            $table->text('alamat');
            $table->string('lokasi_perbedaan_nama');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Upload dokumen (opsional)
            $table->string('fc_ktp')->nullable();
            $table->string('fc_kk')->nullable();
            $table->string('surat_pernyataan_beda_data')->nullable();
            $table->string('bukti_beda_data')->nullable();
            $table->string('pengantar_rt_rw')->nullable();

            // Status dan catatan
            $table->enum('status', ['proses', 'selesai', 'revisi'])->default('proses');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_keterangan_beda_data_kependudukans');
    }
}
