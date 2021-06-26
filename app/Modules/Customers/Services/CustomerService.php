<?php
namespace App\Modules\Customers\Services;

use App\Filters\CustomerFilters;
use App\Modules\Customers\Builder\ConcreteBuilders\CustomerConcreteBuilder;
use App\Modules\Customers\Builder\CustomerDTOCreationDirector;
use App\Modules\Customers\Countries\Countries;
use App\Modules\Customers\Exceptions\CustomersInputException;
use App\Modules\Customers\Repositories\CustomerRepository;
use App\Modules\Customers\Services\Interfaces\BaseServiceInterface;
use App\Modules\Customers\Strategies\PhoneNumberDetectorFactory;
use App\Modules\Customers\Validation\ValidateIndex;

class CustomerService implements BaseServiceInterface
{
    private string $errors;
    private $customerRepository;
    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }
    public function index($request){
        $this->validateIndexRequest($request);
        $customers = $this->customerRepository->index(new CustomerFilters($request));
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

    public function validateIndexRequest(array $request){
        $validation = new ValidateIndex($request);
        $validationResult = $validation->validate();
        if(!$validationResult){
           throw new CustomersInputException($validation->getMessages());
        }
    }

    public function getCountriesList(){
        $countriesData = new Countries();
        return ['data'=>$countriesData->getList()];
    }
}