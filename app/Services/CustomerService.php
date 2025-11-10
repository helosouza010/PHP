<?php

namespace App\Services;
use App\Models\Customer;

class CustomerService
{
    public function storeCustomer($data)
    {
        return Customer::create($data);
    }
}