<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonselingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konseling', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Mahasiswa
            $table->unsignedBigInteger('mhs_id')->nullable();
            $table->foreign('mhs_id')->references('id')->on('mahasiswa');
            // Konselor
            $table->unsignedBigInteger('konselor_id')->nullable();
            $table->foreign('konselor_id')->references('id')->on('konselor');
            // Tujuan Konseling
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('tempat', 30)->nullable();
            $table->text('keterangan')->nullable();
            // Status
            $table->enum('status',['created','approved','canceled','rescheduled','succeed'])->default('created');
            // Laporan
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori_masalah');
            $table->text('laporan_teks')->nullable();
            $table->text('laporan_gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konseling');
    }
}
