<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function storeOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Cria o pedido
            $order = Order::create([
                'customer_id' => $data['customer_id'],
                'order_date' => now()->toDateString(),
                'status' => 'Pendente',
            ]);

            // Cria os itens
            $items = [];
            foreach ($data['items'] as $item) {
                $items[] = new OrderItem([
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }

            $order->items()->saveMany($items);
            return $order;
        });
    }

    public function updateOrder($order, array $data)
    {
        return DB::transaction(function () use ($order, $data) {
            $order->update([
                'customer_id' => $data['customer_id'],
            ]);

            $order->items()->delete();

            $items = [];
            foreach ($data['items'] as $item) {
                $items[] = new OrderItem([
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }

            $order->items()->saveMany($items);
            return $order;
        });
    }
}
