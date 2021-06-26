<?php

namespace App\Modules\Customers\Controllers;


use App\Filters\CustomerFilters;
use App\Http\Controllers\Controller;
use App\Modules\Customers\Builder\ConcreteBuilders\CustomerConcreteBuilder;
use App\Modules\Customers\Builder\CustomerDTOCreationDirector;
use App\Modules\Customers\Exceptions\CustomersInputException;
use \App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Services\CustomerService;
use App\Modules\Customers\Validation\ValidateIndex;
use \Illuminate\Http\Request ;

class CustomersController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        try{
            $request = $request->all();
            return response()->json($this->customerService->index($request), 200);
        }catch (CustomersInputException $ex){
            return response()->json(['message'=>$ex->getMessage()], 401);
        }catch (\Exception $ex){
            //some logging
            return response()->json(['message'=>'unknown error'], 400);
        }
    }

    public function getCountriesList(){
        return response()->json($this->customerService->getCountriesList(), 200);
    }

}