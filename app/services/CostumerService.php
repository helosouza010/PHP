<?php

namespace App\Services;
use App\Models\Costumer;

class CostumerService
{
    public function storeCostumer($data)
    {
        return Costumer::create($data);
    }
}