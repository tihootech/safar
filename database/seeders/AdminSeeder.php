<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'type' => 'ADMIN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
