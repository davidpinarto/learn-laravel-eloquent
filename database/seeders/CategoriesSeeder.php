<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesPayload = [
            [
                'id' => "category-" . Str::random(16),
                'name' => 'handphone'
            ],
            [
                'id' => "category-" . Str::random(16),
                'name' => 'laptop'
            ],
            [
                'id' => "category-" . Str::random(16),
                'name' => 'food'
            ],
            [
                'id' => "category-" . Str::random(16),
                'name' => 'beverages'
            ],
        ];

        foreach ($categoriesPayload as $categoryData) {
            Categories::create($categoryData);
        }
    }
}
