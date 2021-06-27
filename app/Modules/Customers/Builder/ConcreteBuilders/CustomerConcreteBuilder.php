<?php

namespace App\Modules\Customers\Builder\ConcreteBuilders;


use App\Modules\Customers\Builder\Interfaces\CustomerBuilderInterface;
use App\Modules\Customers\DTO\CustomerDTO;
use App\Modules\Customers\DTO\CustomerDTOInterface;
use App\Modules\Customers\Strategies\Interfaces\PhoneNumbersDetectorStrategyInterface;

class CustomerConcreteBuilder implements CustomerBuilderInterface
{
    protected $rawCustomer;
    protected $id;
    protected $country;
    protected $state;
    protected $code;
    protected $phone;
    protected $phoneDetectorLib;

    public function __construct($rawCustomer, PhoneNumbersDetectorStrategyInterface $phoneDetectorLib)
    {
        $this->rawCustomer = $rawCustomer;
        $this->phoneDetectorLib = $phoneDetectorLib;
    }

    public function buildId()
    {
        $this->id = $this->rawCustomer->id;
    }

    public function buildCountry()
    {
        $this->country = $this->phoneDetectorLib->getCountryByPhoneNumber($this->rawCustomer->phone);
    }

    public function buildState()
    {
        $this->state = $this->phoneDetectorLib->getValidityByPhoneNumber($this->rawCustomer->phone);
    }

    public function buildCode()
    {
        $this->code = substr($this->rawCustomer->phone,1, 3);
    }

    public function buildPhone()
    {
        $this->phone = substr($this->rawCustomer->phone,6);
    }

    public function getCustomer(): CustomerDTOInterface
    {
        return new CustomerDTO($this->rawCustomer->id,$this->rawCustomer->name, $this->country, $this->state, $this->code, $this->phone);
    }
}
