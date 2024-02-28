<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing users table if exists
        Schema::dropIfExists('users');

        // Create the users table with updated structure
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id'); // Mengubah nama kolom id menjadi user_id dan menetapkannya sebagai primary key
            $table->string('name');
            $table->string('npsn')->nullable();
            $table->string('nim')->unique()->nullable();
            $table->string('telp', 15)->unique(); // Menetapkan panjang maksimum 15 karakter dan menetapkan sebagai unik
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('peserta'); // Menambahkan kolom role dengan default 'peserta'
            $table->rememberToken();
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
        // Drop the users table if exists
        Schema::dropIfExists('users');
    }
}
