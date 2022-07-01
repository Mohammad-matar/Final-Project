<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'product 1',
            'description' => 'product 1 description',
            'image' => 'image.png',
            'price' => 23,
            'category_id' => 1
        ]);
        DB::table('products')->insert([
            'name' => 'product 2',
            'description' => 'product 2 description',
            'image' => 'image.png',
            'price' => 23,
            'category_id' => 2
        ]);
        DB::table('products')->insert([
            'name' => 'product 3',
            'description' => 'product 3 description',
            'image' => 'image.png',
            'price' => 23,
            'category_id' => 3
        ]);
        DB::table('products')->insert([
            'name' => 'product 4',
            'description' => 'product 4 description',
            'image' => 'image.png',
            'price' => 23,
            'category_id' => 4
        ]);
        DB::table('products')->insert([
            'name' => 'product 5',
            'description' => 'product 5 description',
            'image' => 'image.png',
            'price' => 23,
            'category_id' => 5
        ]);
    }
}
