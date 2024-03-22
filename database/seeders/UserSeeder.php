<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'npsn' => null,
            'nim' => null,
            'telp' => '081122334455',
            'email' => 'Admin@admin.com',
            'password' => Hash::make('admin123'),
            'role'=> 'admin',
        ]);
    }
}
