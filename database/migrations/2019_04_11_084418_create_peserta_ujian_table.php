<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePesertaUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcexam_peserta_ujian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ujian_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer("status")->default('0');
            $table->text("soal")->nullable();
            // $table->text("jawaban")->nullable();
            $table->integer("total_true_answer")->nullable();
            $table->integer("total_false_answer")->nullable();
            $table->float("nilai", 8, 2)->nullable();
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
        Schema::dropIfExists('peserta_ujian');
    }
}