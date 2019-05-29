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
            $table->string("pilihan_a");
            $table->string("pilihan_b");
            $table->string("pilihan_c");
            $table->string("pilihan_d");
            $table->string("pilihan_e")->nullable();
            $table->string("status")->nullable();
            $table->string("jawaban");
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