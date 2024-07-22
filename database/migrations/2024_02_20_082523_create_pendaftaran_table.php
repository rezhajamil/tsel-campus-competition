<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->bigIncrements('id_pendaftaran');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelompok_id');
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('penilaian_id')->nullable();
            $table->string('komentar')->nullable();
            $table->string('status');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('kelompok_id')->references('kelompok_id')->on('kelompok');
            $table->foreign('proposal_id')->references('proposal_id')->on('proposal');
            $table->foreign('penilaian_id')->references('penilaian_id')->on('penilaian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
