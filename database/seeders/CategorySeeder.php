<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Beef']);
        Category::create(['name' => 'Chicken']);
        Category::create(['name' => 'Fish']);
        Category::create(['name' => 'Main meals']);
        Category::create(['name' => 'Oriental']);
        Category::create(['name' => 'Pasta']);
        Category::create(['name' => 'Pizza']);
        Category::create(['name' => 'Pork']);
        Category::create(['name' => 'Soup']);
        Category::create(['name' => 'Sweet']);
    }
}
