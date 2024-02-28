<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal', function (Blueprint $table) {
            $table->bigIncrements('id_proposal');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelompok_id');
            $table->string('[judul_proposal]')->nullable();
            $table->longText('ide_bisnis')->nullable();
            $table->string('model_bisnis_canvas')->nullable();
            $table->longText('deskripsi_laba_rugi')->nullable();
            $table->string('file_laba_rugi')->nullable();
            $table->string('file_pemasaran')->nullable();
            $table->longText('deskripsi_pemasaran')->nullable();
            $table->longText('deskripsi_maintenance')->nullable();
            $table->string('file_maintenance')->nullable();
            $table->string('status');
            $table->timestamps();


            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('kelompok_id')->references('id')->on('kelompok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal');
    }
}
