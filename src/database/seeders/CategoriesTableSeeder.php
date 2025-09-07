<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['content' => '1.商品のお届けについて']);
        Category::create(['content' => '2.商品の交換について']);
        Category::create(['content' => '3.商品トラブル']);
        Category::create(['content' => '4.ショップへのお問い合わせ']);
        Category::create(['content' => '5.その他']);
    }
}
