<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'category 1',
            'description' => 'category 1 description',
        ]);
        DB::table('categories')->insert([
            'name' => 'category 2',
            'description' => 'category 2 description',
        ]);
        DB::table('categories')->insert([
            'name' => 'category 3',
            'description' => 'category 3 description',
        ]);
        DB::table('categories')->insert([
            'name' => 'category 4',
            'description' => 'category 4 description',
        ]);
        DB::table('categories')->insert([
            'name' => 'category 5',
            'description' => 'category 5 description',
        ]);
    }
}
