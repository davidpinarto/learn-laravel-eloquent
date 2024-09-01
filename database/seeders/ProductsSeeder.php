<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handphoneCategory = Categories::select(['id', 'name'])->where('name', '=', 'handphone')->first();
        $laptopCategory = Categories::select(['id', 'name'])->where('name', '=', 'laptop')->first();
        // $foodCategory = Categories::select(['id', 'name'])->where('name', '=', 'food')->first();
        // $beverageCategory = Categories::select(['id', 'name'])->where('name', '=', 'beverage')->first();

        // Check if categories exist
        if (!$handphoneCategory || !$laptopCategory) {
            $this->command->info('One or more categories not found. Seeder stopped.');
            return;
        }

        $productsHandphonesPayload = [
            [
                'id' => "product-" . Str::random(16),
                'name' => "OPPO A53",
                'price' => 3800000,
                'category_id' => $handphoneCategory->id,
            ],
            [
                'id' => "product-" . Str::random(16),
                'name' => "Evercoss B75A",
                'price' => 1200000,
                'category_id' => $handphoneCategory->id,
            ],
            [
                'id' => "product-" . Str::random(16),
                'name' => "Nokia C3",
                'price' => 500000,
                'category_id' => $handphoneCategory->id,
            ]
        ];

        foreach ($productsHandphonesPayload as $productHanphoneData) {
            Products::create($productHanphoneData);
        }

        $productsLaptopsPayload = [
            [
                'id' => "product-" . Str::random(16),
                'name' => "Lenovo Thinkpad L420",
                'price' => 1500000,
                'category_id' => $laptopCategory->id,
            ],
            [
                'id' => "product-" . Str::random(16),
                'name' => "Advan Workpro Lite",
                'price' => 4800000,
                'category_id' => $laptopCategory->id,
            ],
            [
                'id' => "product-" . Str::random(16),
                'name' => "Acer Nitro",
                'price' => 8000000,
                'category_id' => $laptopCategory->id,
            ]
        ];

        foreach ($productsLaptopsPayload as $productLaptopData) {
            Products::create($productLaptopData);
        }
    }
}
