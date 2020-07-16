<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('program_studi_id')->nullable();
            $table->foreign('program_studi_id')->references('id')->on('program_studi');
            $table->string('nim', 10)->unique()->notNullable();
            $table->string('nama', 40)->notNullable();
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('gender', 2)->nullable();
            $table->integer('semester')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota', 30)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('nomor_hp', 15)->nullable();
            $table->string('email', 50)->nullable()->unique();
            $table->integer('angkatan')->nullable();
            $table->string('status_keaktifan')->default('Aktif');
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
        Schema::dropIfExists('mahasiswa');
    }
}
