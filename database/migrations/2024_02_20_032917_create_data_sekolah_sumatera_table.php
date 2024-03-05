<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSekolahSumateraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('data_sekolah_sumatera', function (Blueprint $table) {
        //     // Tidak perlu id(), karena kita menggunakan NPSN sebagai primary key
        //     $table->string('NPSN', 8)->primary();
        //     $table->string('NAMA_SEKOLAH', 80)->nullable();
        //     $table->string('PROVINSI', 25)->nullable();
        //     $table->string('KAB_KOTA', 26)->nullable();
        //     $table->string('KECAMATAN', 27)->nullable();
        //     $table->string('KELURAHAN', 39)->nullable();
        //     $table->string('STATUS_SEKOLAH', 6)->nullable();
        //     $table->string('JENJANG', 14)->nullable();
        //     $table->string('KATEGORI_JENJANG', 7)->nullable();
        //     $table->string('REGIONAL', 10)->nullable();
        //     $table->string('BRANCH', 16)->nullable();
        //     $table->string('CLUSTER', 23)->nullable();
        //     $table->string('LATITUDE', 21)->nullable();
        //     $table->string('LONGITUDE', 18)->nullable();
        //     $table->string('PJP', 7)->nullable();
        //     $table->string('FREKUENSI', 5)->nullable();
        //     $table->string('TELP', 13)->nullable();
        //     $table->string('ALAMAT', 50)->nullable();
        //     $table->string('CITY', 26)->nullable();
        //     $table->string('jlh_siswa', 5)->nullable();
        //     $table->timestamps();
        // });

        // // Baca dan olah file CSV
        // $csvFile = public_path('Data_Sekolah_Sumatera.csv');
        // $csv = array_map('str_getcsv', file($csvFile));
        // foreach ($csv as $row) {
        //     // Tambahkan data ke dalam tabel atau perbarui jika sudah ada
        //     DB::table('data_sekolah_sumatera')->updateOrInsert(
        //         ['NPSN' => $row[0]],
        //         [
        //             'NAMA_SEKOLAH' => $row[1],
        //             'PROVINSI' => $row[2],
        //             'KAB_KOTA' => $row[3],
        //             'KECAMATAN' => $row[4],
        //             'KELURAHAN' => $row[5],
        //             'STATUS_SEKOLAH' => $row[6],
        //             'JENJANG' => $row[7],
        //             'KATEGORI_JENJANG' => $row[8],
        //             'REGIONAL' => $row[9],
        //             'BRANCH' => $row[10],
        //             'CLUSTER' => $row[11],
        //             'LATITUDE' => $row[12],
        //             'LONGITUDE' => $row[13],
        //             'PJP' => $row[14],
        //             'FREKUENSI' => $row[15],
        //             'TELP' => $row[16],
        //             'ALAMAT' => $row[17],
        //             'CITY' => $row[18],
        //             'jlh_siswa' => $row[19],
        //         ]
        //     );
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('data_sekolah_sumatera');
    }
}
