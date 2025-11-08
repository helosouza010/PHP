<?php

namespace App\Services;
use App\Models\Costumer;

class OrderService
{
    public function storeOrder($data)
    {
        return Order::create($data);
    }
}