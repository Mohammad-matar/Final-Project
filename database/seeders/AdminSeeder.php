<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('admins')->insert([
            'username' => 'admin1',
            'password' => '12345678'
        ]);
        DB::table('admins')->insert([
            'username' => 'admin2',
            'password' => '12345678'
        ]);
        DB::table('admins')->insert([
            'username' => 'admin3',
            'password' => '12345678'
        ]);
        DB::table('admins')->insert([
            'username' => 'admin4',
            'password' => '12345678'
        ]);
        DB::table('admins')->insert([
            'username' => 'admin5',
            'password' => '12345678'
        ]);
    }
}
