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
        Schema::table('tcexam_ujian', function (Blueprint $table) {
            $table->foreign('id_dosen')->references('kode')->on('users');
        });
        Schema::table('tcexam_peserta_ujian', function (Blueprint $table) {
            $table->foreign('ujian_id')->references('id')->on('tcexam_ujian');
            $table->foreign('user_id')->references('kode')->on('users');
        });
        Schema::table('tcexam_soal', function (Blueprint $table) {
            $table->foreign('ujian_id')->references('id')->on('tcexam_ujian');
        });
        Schema::table('tcexam_packet', function (Blueprint $table) {
            $table->foreign('peserta_ujian_id')->references('id')->on('tcexam_peserta_ujian');
            $table->foreign('ujian_id')->references('id')->on('tcexam_ujian');
            $table->foreign('soal_id')->references('id')->on('tcexam_soal');
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