<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\Users;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\OrdersItemsSeeder;
use Database\Seeders\OrdersSeeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\UsersSeeder;
use Tests\TestCase;

class ComplexJoinTest extends TestCase
{
    public function testGetOrdersForUserDavid()
    {
        $this->seed([
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            OrdersSeeder::class,
            OrdersItemsSeeder::class,
        ]);

        $columnList = [
            'orders_items.id',
            'orders_items.order_id as orders_id',
            'orders_items.quantity',
            'products.id as product_id',
            'products.name',
            'products.price',
            'products.category_id',
        ];

        $result = Users::select($columnList)
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->join('orders_items', 'orders.id', '=', 'orders_items.order_id')
            ->join('products', 'orders_items.product_id', '=', 'products.id')
            ->where('users.full_name', '=', 'david pinarto')
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($orderItem) {
            // var_dump($orderItem);
            self::assertNotNull($orderItem->id);
            self::assertNotNull($orderItem->orders_id);
            self::assertNotNull($orderItem->quantity);
            self::assertNotNull($orderItem->product_id);
            self::assertNotNull($orderItem->name);
            self::assertNotNull($orderItem->price);
            self::assertNotNull($orderItem->category_id);
        });
    }

    public function testGetLaptopsProductsWithPriceBetween15MillionTo25Million()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        $columnList = [
            'products.*',
            'categories.name as category_name',
        ];

        $result = Products::select($columnList)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereBetween('products.price', [15000000, 25000000])
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetLaptopsProductsWithPriceAbove15Million()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        $columnList = [
            'products.*',
            'categories.name as category_name',
        ];

        $result = Products::select($columnList)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.price', '>', 15000000)
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetProductsWithInOperators()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        $columnList = [
            'products.*',
            'categories.name as category_name',
        ];

        $result = Products::select($columnList)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereIn('categories.name', ['laptop'])
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetProductsWithNotInOperators()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        $columnList = [
            'products.*',
            'categories.name as category_name',
        ];

        $result = Products::select($columnList)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereNotIn('categories.name', ['laptop'])
            ->get();  // collection that contain object of the Models

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetProductsWithNotInOperatorsButWithAlias()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        /**
         * alias tables summary:
         *   - p = products
         *   - c = categories
         */
        $columnList = [
            'p.*',
            'c.name as category_name',
        ];

        $result = Products::select($columnList)
            ->from('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->whereNotIn('c.name', ['laptop'])
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetProductsOrderByName()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        /**
         * alias tables summary:
         *   - p = products
         *   - c = categories
         */
        $columnList = [
            'p.*',
            'c.name as category_name',
        ];

        $result = Products::select($columnList)
            ->from('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->orderBy('p.name', 'asc')
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetProductsOrderByPrice()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        /**
         * alias tables summary:
         *   - p = products
         *   - c = categories
         */
        $columnList = [
            'p.*',
            'c.name as category_name',
        ];

        $result = Products::select($columnList)
            ->from('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->orderBy('p.price', 'asc')
            ->get();

        // var_dump(json_encode($result));
        $result->each(function ($productItem) {
            // var_dump($orderItem);
            self::assertNotNull($productItem->id);
            self::assertNotNull($productItem->name);
            self::assertNotNull($productItem->price);
            self::assertNotNull($productItem->category_id);
            self::assertNotNull($productItem->category_name);
        });
    }

    public function testGetProductsTotalWithCount()
    {
        $this->seed([CategoriesSeeder::class, ProductsSeeder::class]);

        /**
         * alias tables summary:
         *   - p = products
         *   - c = categories
         */
        $columnList = [
            'p.*',
            'c.name as category_name',
        ];

        $result = Products::select($columnList)
            ->from('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->count();

        // var_dump(json_encode($result));
        // self::assertEquals('100', $result);  // tidak error karena assertEquals tidak cek type datanya
        self::assertSame(100, $result);  // gunakan assertSame untuk validasi type datanya juga '100' !== 100
    }

    public function testGetTotalOrdersWithSum()
    {

        $this->seed([
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            OrdersSeeder::class,
            OrdersItemsSeeder::class,
        ]);

        /**
         * alias tables summary:
         *   - o = orders
         *   - oi = orders_items
         *   - p = products
         *   - u = users
         */
        $columnList = [
            'oi.id',
            'oi.order_id as orders_id',
            'oi.quantity',
            'p.id as product_id',
            'p.name',
            'p.price',
            'p.category_id',
        ];

        $result = Users::select($columnList)
            ->from('users as u')
            ->join('orders as o', 'u.id', '=', 'o.user_id')
            ->join('orders_items as oi', 'o.id', '=', 'oi.order_id')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->where('u.full_name', '=', 'david pinarto')
            ->sum('p.price');  // string

        // var_dump(json_encode($result));
        // var_dump($result);
        self::assertNotNull($result);
    }
}
