<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcexam_ujian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->bigInteger('id_dosen')->unsigned();
            $table->integer("test_time")->nullable();
            $table->integer("jumlah_soal");
            $table->integer("status")->default('0');
            $table->integer("true_answer")->nullable();
            $table->integer("false_answer");
            $table->string("result_to_user");
            $table->string("report_to_user");
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
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
        Schema::dropIfExists('ujian');
    }
}