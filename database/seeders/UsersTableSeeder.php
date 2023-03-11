<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'full_name' => 'yassine admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
            ],

            [
                'full_name' => 'yassine seller',
                'username' => 'seller',
                'email' => 'seller@gmail.com',
                'password' => Hash::make('seller123'),
                'role' => 'seller',
                'status' => 'active',
            ],
            [
                'full_name' => 'yassine customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'status' => 'active',
            ],
        ]);
    }
}
