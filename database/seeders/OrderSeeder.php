<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'username' => 'category 1',
            'email' => 'catedgorwydf1 ',
            'phone_number' => 133728733,
            'location' => 2,
            'text' => 'category 1 description',
        ]);
    }
}
