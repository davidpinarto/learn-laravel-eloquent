<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\OrdersItems;
use App\Models\Products;
use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrdersItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = Users::select('id')->where('full_name', '=', 'david pinarto')->first();
        $user2 = Users::select('id')->where('full_name', '=', 'testing')->first();

        $ordersUser1 = Orders::select(['id'])->where('user_id', '=', $user1->id)->first();
        $ordersUser2 = Orders::select(['id'])->where('user_id', '=', $user2->id)->first();

        $handphoneCategory = Categories::select(['id'])->where('name', '=', 'handphone')->first();
        $laptopCategory = Categories::select(['id'])->where('name', '=', 'laptop')->first();

        $productsHandphones = Products::select(['*'])->where('category_id', '=', $handphoneCategory->id)->get();
        $productsLaptops = Products::select(['*'])->where('category_id', '=', $laptopCategory->id)->get();

        $ordersItemsUser1Payload = [
            [
                'id' => "orders-items-" . Str::random(16),
                'order_id' => $ordersUser1->id,
                'product_id' => $productsHandphones[0]->id,
                'quantity' => 1,
                'price' => $productsHandphones[0]->price,
            ],
            [
                'id' => "orders-items-" . Str::random(16),
                'order_id' => $ordersUser1->id,
                'product_id' => $productsHandphones[1]->id,
                'quantity' => 1,
                'price' => $productsHandphones[1]->price,
            ],
            [
                'id' => "orders-items-" . Str::random(16),
                'order_id' => $ordersUser1->id,
                'product_id' => $productsLaptops[0]->id,
                'quantity' => 1,
                'price' => $productsLaptops[0]->price,
            ],
        ];

        $ordersItemsUser2Payload = [
            [
                'id' => "orders-items-" . Str::random(16),
                'order_id' => $ordersUser2->id,
                'product_id' => $productsHandphones[2]->id,
                'quantity' => 1,
                'price' => $productsHandphones[2]->price,
            ],
            [
                'id' => "orders-items-" . Str::random(16),
                'order_id' => $ordersUser2->id,
                'product_id' => $productsLaptops[1]->id,
                'quantity' => 1,
                'price' => $productsLaptops[1]->price,
            ],
            [
                'id' => "orders-items-" . Str::random(16),
                'order_id' => $ordersUser2->id,
                'product_id' => $productsLaptops[0]->id,
                'quantity' => 1,
                'price' => $productsLaptops[0]->price,
            ],
        ];

        foreach ($ordersItemsUser1Payload as $orderItemData) {
            OrdersItems::create($orderItemData);
        }

        foreach ($ordersItemsUser2Payload as $orderItemData) {
            OrdersItems::create($orderItemData);
        }
    }
}
