<?php

namespace App\Modules\Customers\Builder;

use App\Modules\Customers\Builder\Interfaces\CustomerBuilderInterface;
use App\Modules\Customers\DTO\Interfaces\CustomerDTOInterface;

class CustomerDTOCreationDirector
{

    protected CustomerBuilderInterface $customerBuilder;
    public function __construct(CustomerBuilderInterface $customerBuilder)
    {
        $this->customerBuilder = $customerBuilder;
    }

    public function buildCustomer(){
        $this->customerBuilder->buildId();
        $this->customerBuilder->buildCountry();
        $this->customerBuilder->buildState();
        $this->customerBuilder->buildCode();
        $this->customerBuilder->buildPhone();
    }

    public function getCustomer(): CustomerDTOInterface{
        $this->buildCustomer();
        return $this->customerBuilder->getCustomer();
    }
}
