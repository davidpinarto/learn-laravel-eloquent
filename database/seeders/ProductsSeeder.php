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
        $foodCategory = Categories::select(['id', 'name'])->where('name', '=', 'food')->first();
        $beveragesCategory = Categories::select(['id', 'name'])->where('name', '=', 'beverages')->first();

        $this->_generateProductsHandphones(25, $handphoneCategory->id);
        $this->_generateProductsLaptops(25, $laptopCategory->id);
        $this->_generateProductsFoods(25, $foodCategory->id);
        $this->_generateProductsBeverages(25, $beveragesCategory->id);
    }

    private function _generateProductsLaptops(int $total, string $categoryId): void
    {
        $laptopBrands = [
            'Apple',
            'Dell',
            'HP',
            'Lenovo',
            'Asus',
            'Acer',
            'MSI',
            'Razer',
            'Samsung',
            'Microsoft',
            'LG',
            'Alienware',
            'Google',
            'Toshiba',
            'Huawei',
            'Xiaomi',
            'Rugged',
            'Vaio',
            'Fujitsu',
            'Panasonic',
            'Clevo',
            'Sager',
            'Gigabyte',
            'System76',
            'Chuwi'
        ];
        for ($i = 0; $i < $total; $i++) {
            $randomIndex = rand(0, 24);
            $minPrice = 1000000;
            $maxPrice = 25000000;
            $product = [
                'id' => "product-" . Str::random(16),
                'name' => $laptopBrands[$randomIndex],
                'price' => rand($minPrice, $maxPrice),
                'category_id' => $categoryId,
            ];
            Products::create($product);
        }
    }

    private function _generateProductsHandphones(int $total, string $categoryId): void
    {
        $handphoneBrands = [
            'Apple',
            'Samsung',
            'Xiaomi',
            'Huawei',
            'OnePlus',
            'Oppo',
            'Vivo',
            'Sony',
            'Nokia',
            'LG',
            'Motorola',
            'Google',
            'Asus',
            'Lenovo',
            'Realme',
            'ZTE',
            'TCL',
            'Honor',
            'Alcatel',
            'Meizu',
            'Panasonic',
            'Sharp',
            'BlackBerry',
            'HTC',
            'Nubia',
            'Tecno',
            'Infinix',
            'iQOO',
            'Microsoft',
            'Lava'
        ];
        for ($i = 0; $i < $total; $i++) {
            $randomIndex = rand(0, 24);
            $minPrice = 300000;
            $maxPrice = 15000000;
            $product = [
                'id' => "product-" . Str::random(16),
                'name' => $handphoneBrands[$randomIndex],
                'price' => rand($minPrice, $maxPrice),
                'category_id' => $categoryId,
            ];
            Products::create($product);
        }
    }

    private function _generateProductsFoods(int $total, string $categoryId): void
    {
        $foodNames = [
            'Pizza',
            'Burger',
            'Pasta',
            'Sushi',
            'Tacos',
            'Fried Rice',
            'Burger',
            'Hot Dog',
            'Salad',
            'Chicken Wings',
            'Steak',
            'Sandwich',
            'Noodles',
            'Burrito',
            'Samosa',
            'Spring Rolls',
            'Falafel',
            'Kebab',
            'Sushi',
            'Ramen',
            'Dumplings',
            'Shawarma',
            'Paella',
            'Curry',
            'Chow Mein'
        ];
        for ($i = 0; $i < $total; $i++) {
            $randomIndex = rand(0, 24);
            $minPrice = 50000;
            $maxPrice = 2000000;
            $product = [
                'id' => "product-" . Str::random(16),
                'name' => $foodNames[$randomIndex],
                'price' => rand($minPrice, $maxPrice),
                'category_id' => $categoryId,
            ];
            Products::create($product);
        }
    }

    private function _generateProductsBeverages(int $total, string $categoryId): void
    {
        $beverageNames = [
            'Coffee',
            'Tea',
            'Orange Juice',
            'Soda',
            'Water',
            'Lemonade',
            'Milk',
            'Smoothie',
            'Hot Chocolate',
            'Iced Tea',
            'Energy Drink',
            'Beer',
            'Wine',
            'Whiskey',
            'Cocktail',
            'Sparkling Water',
            'Coconut Water',
            'Herbal Tea',
            'Latte',
            'Espresso',
            'Fruit Punch',
            'Milkshake',
            'Iced Coffee',
            'Green Tea',
            'Apple Juice'
        ];

        for ($i = 0; $i < $total; $i++) {
            $randomIndex = rand(0, 24);
            $minPrice = 25000;
            $maxPrice = 500000;
            $product = [
                'id' => "product-" . Str::random(16),
                'name' => $beverageNames[$randomIndex],
                'price' => rand($minPrice, $maxPrice),
                'category_id' => $categoryId,
            ];
            Products::create($product);
        }
    }
}
