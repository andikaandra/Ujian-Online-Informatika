<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePacketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcexam_packet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('peserta_ujian_id')->unsigned();
            $table->unsignedBigInteger('ujian_id');
            $table->bigInteger('soal_id')->unsigned();
            $table->text("jawaban_soal");
            $table->integer("status")->default(0);
            $table->text("jawaban")->nullable();
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
        Schema::dropIfExists('packet');
    }
}