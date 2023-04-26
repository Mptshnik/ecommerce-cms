<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Корневая категория',
            'category_id' => null,
            'slug' => 'root',
            'description_and_images' => [],
            'filterable_attributes' => [],
            'visible_in_menu' => false
        ]);
    }
}
