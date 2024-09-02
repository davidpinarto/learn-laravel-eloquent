<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\OrdersItems;
use App\Models\Users;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusEnum = [
            'pending',
            'shipped',
            'delivered',
            'cancelled',
        ];

        $user1 = Users::select(['id'])->where('full_name', '=', 'david pinarto')->first();
        $user2 = Users::select(['id'])->where('full_name', '=', 'testing')->first();

        $allOrderItemUser1 = Users::select(['*'])
            ->from('orders')
            ->rightJoin('orders_items', 'orders_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', '=', $user1->id)
            ->get();
        $allOrderItemUser2 = Users::select(['*'])
            ->from('orders')
            ->rightJoin('orders_items', 'orders_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', '=', $user2->id)
            ->get();

        $ordersPayload = [
            [
                'id' => "orders-" . Str::random(16),
                'user_id' => $user1->id,
                'total_amount' => $this->_calculateTotalAmount($allOrderItemUser1),
                'status' => $statusEnum[0],
            ],
            [
                'id' => "orders-" . Str::random(16),
                'user_id' => $user2->id,
                'total_amount' => $this->_calculateTotalAmount($allOrderItemUser2),
                'status' => $statusEnum[0],
            ],
        ];

        foreach ($ordersPayload as $orderData) {
            Orders::create($orderData);
        }
    }

    private function _calculateTotalAmount(Collection $allOrdersItems): int
    {
        $totalAmount = 0;
        foreach ($allOrdersItems as $orderItem) {
            $totalAmount += $orderItem->price;
        }
        return $totalAmount;
    }
}
