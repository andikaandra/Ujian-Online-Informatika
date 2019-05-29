<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcexam_soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ujian_id')->unsigned();
            $table->text("deskripsi");
            $table->text("file_path")->nullable();
            $table->text("pilihan_a");
            $table->text("pilihan_b");
            $table->text("pilihan_c");
            $table->text("pilihan_d");
            $table->text("pilihan_e")->nullable();
            $table->string("status")->nullable();
            $table->text("jawaban");
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
        Schema::dropIfExists('soal');
    }
}