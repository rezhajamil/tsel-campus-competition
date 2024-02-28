<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKodePrefixOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kode_prefix_operator', function (Blueprint $table) {
            $table->text('kode_prefix'); // Mengubah tipe data menjadi TEXT dengan panjang 15 karakter dan menetapkannya sebagai primary key
            $table->text('operator')->nullable();
            $table->timestamps();
        });

        // Insert data
        DB::table('kode_prefix_operator')->insert([
            ['kode_prefix' => '0811', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0812', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0813', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0821', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0822', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0823', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0851', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0852', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0853', 'operator' => 'Telkomsel'],
            ['kode_prefix' => '0819', 'operator' => 'XL'],
            ['kode_prefix' => '0818', 'operator' => 'XL'],
            ['kode_prefix' => '0817', 'operator' => 'XL'],
            ['kode_prefix' => '0859', 'operator' => 'XL'],
            ['kode_prefix' => '0877', 'operator' => 'XL'],
            ['kode_prefix' => '0878', 'operator' => 'XL'],
            ['kode_prefix' => '0816', 'operator' => 'Indosat'],
            ['kode_prefix' => '0815', 'operator' => 'Indosat'],
            ['kode_prefix' => '0814', 'operator' => 'Indosat'],
            ['kode_prefix' => '0858', 'operator' => 'Indosat'],
            ['kode_prefix' => '0857', 'operator' => 'Indosat'],
            ['kode_prefix' => '0856', 'operator' => 'Indosat'],
            ['kode_prefix' => '0855', 'operator' => 'Indosat'],
            ['kode_prefix' => '0831', 'operator' => 'Axis'],
            ['kode_prefix' => '0832', 'operator' => 'Axis'],
            ['kode_prefix' => '0833', 'operator' => 'Axis'],
            ['kode_prefix' => '0838', 'operator' => 'Axis'],
            ['kode_prefix' => '0896', 'operator' => 'Tri'],
            ['kode_prefix' => '0895', 'operator' => 'Tri'],
            ['kode_prefix' => '0897', 'operator' => 'Tri'],
            ['kode_prefix' => '0898', 'operator' => 'Tri'],
            ['kode_prefix' => '0899', 'operator' => 'Tri'],
            ['kode_prefix' => '0881', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0882', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0883', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0884', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0885', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0886', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0887', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0888', 'operator' => 'Smartfren'],
            ['kode_prefix' => '0889', 'operator' => 'Smartfren']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
