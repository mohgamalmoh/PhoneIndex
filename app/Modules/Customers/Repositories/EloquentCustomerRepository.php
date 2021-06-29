<?php


namespace App\Modules\Customers\Repositories;



use App\Modules\Customers\Filters\CustomerFilters;
use App\Modules\Customers\Models\Customer;

class EloquentCustomerRepository extends CustomerRepository
{
    public function getPaginatedList(array $params)
    {
        $filtrationObj = new CustomerFilters($params);
        return Customer::filter($filtrationObj)->paginate(5);
    }
}