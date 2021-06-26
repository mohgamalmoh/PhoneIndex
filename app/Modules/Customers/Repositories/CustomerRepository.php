<?php


namespace App\Modules\Customers\Repositories;


use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Repositories\interfaces\BaseRepositoryInterface;

class CustomerRepository implements BaseRepositoryInterface
{

    public function index($filters)
    {
        return Customer::filter($filters)->paginate(5);
    }
}