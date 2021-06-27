<?php

namespace App\Modules\Customers\Controllers;


use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Modules\Customers\Exceptions\CustomersInputException;
use App\Modules\Customers\Requests\CustomersIndexRequest;
use App\Modules\Customers\Services\CustomerService;

class CustomersController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function index(CustomersIndexRequest $request)
    {
        return response()->json($this->customerService->index($request->all()), 200);
    }

    public function getCountriesList(){
        return response()->json($this->customerService->getCountriesList(), 200);
    }

}