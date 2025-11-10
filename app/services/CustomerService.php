<?php

namespace App\Services;
use App\Models\Customer;

class CustomerService
{
    public function storeCostumer($data)
    {
        return Customer::create($data);
    }
}