<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSekolahSumatraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sekolah_sumatra', function (Blueprint $table) {
            // Tidak perlu id(), karena kita menggunakan NPSN sebagai primary key
            $table->string('NPSN', 8)->primary();
            $table->string('NAMA_SEKOLAH', 80)->nullable();
            $table->string('PROVINSI', 25)->nullable();
            $table->string('KAB_KOTA', 26)->nullable();
            $table->string('KECAMATAN', 27)->nullable();
            $table->string('KELURAHAN', 39)->nullable();
            $table->string('STATUS_SEKOLAH', 6)->nullable();
            $table->string('JENJANG', 14)->nullable();
            $table->string('KATEGORI_JENJANG', 7)->nullable();
            $table->string('REGIONAL', 10)->nullable();
            $table->string('BRANCH', 16)->nullable();
            $table->string('CLUSTER', 23)->nullable();
            $table->string('LATITUDE', 21)->nullable();
            $table->string('LONGITUDE', 18)->nullable();
            $table->string('PJP', 7)->nullable();
            $table->string('FREKUENSI', 2)->nullable();
            $table->string('TELP', 13)->nullable();
            $table->string('ALAMAT', 50)->nullable();
            $table->string('CITY', 26)->nullable();
            $table->string('jlh_siswa', 5)->nullable();
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
        Schema::dropIfExists('data_sekolah_sumatra');
    }
}
