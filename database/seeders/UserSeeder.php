<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin user',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'roles' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password')

            ],
            [
                'name' => 'Vendor user',
                'username' => 'vendoruser',
                'email' => 'vendor@gmail.com',
                'roles' => 'vendor',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'user',
                'username' => 'vuser',
                'email' => 'user@gmail.com',
                'roles' => 'user',
                'status' => 'active',
                'password' => bcrypt('password')
            ]
        ]);
    }
}
