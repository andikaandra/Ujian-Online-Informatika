<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujian', function (Blueprint $table) {
            $table->foreign('id_dosen')->references('idUser')->on('users');
        });

        Schema::table('peserta_ujian', function (Blueprint $table) {
            $table->foreign('ujian_id')->references('id')->on('ujian');
            $table->foreign('user_id')->references('idUser')->on('users');
        });

        Schema::table('soal', function (Blueprint $table) {
            $table->foreign('ujian_id')->references('id')->on('ujian');
        });

        Schema::table('packet', function (Blueprint $table) {
            $table->foreign('peserta_ujian_id')->references('id')->on('peserta_ujian');
            $table->foreign('soal_id')->references('id')->on('soal');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign');
    }
}
