<?php
namespace App\Modules\Customers\Services;

use App\Filters\CustomerFilters;
use App\Modules\Customers\Builder\ConcreteBuilders\CustomerConcreteBuilder;
use App\Modules\Customers\Builder\CustomerDTOCreationDirector;
use App\Modules\Customers\Countries\Countries;
use App\Modules\Customers\Exceptions\CustomersInputException;
use App\Modules\Customers\Repositories\CustomerRepository;
use App\Modules\Customers\Strategies\PhoneNumberDetectorFactory;
use App\Modules\Customers\Validation\ValidateIndex;
use App\Services\Interfaces\BaseServiceInterface;

class CustomerService implements BaseServiceInterface
{
    private $customerRepository;
    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }
    public function getPaginatedList($request){
        $customers = $this->customerRepository->getPaginatedList($request);
        $phoneDetectionLib = PhoneNumberDetectorFactory::generate();
        $result = [];
        foreach ($customers as $value){
            $concreteBuilder = new CustomerConcreteBuilder($value,$phoneDetectionLib);
            $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);
            $result[] = $customerCreationDirector->getCustomer();
        }
        $jsonDecodedCustomers = json_decode($customers->toJson(),true);
        $jsonDecodedCustomers['data'] = $result;
        return $jsonDecodedCustomers;
    }

    public function getCountriesList(){
        $countriesData = new Countries();
        return ['data'=>$countriesData->getList()];
    }
}