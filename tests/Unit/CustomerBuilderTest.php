<?php

namespace Tests\Unit;

use App\Modules\Customers\Builder\ConcreteBuilders\CustomerConcreteBuilder;
use App\Modules\Customers\Builder\CustomerDTOCreationDirector;
use App\Modules\Customers\DTO\Interfaces\CustomerDTOInterface;
use App\Modules\Customers\Strategies\Interfaces\PhoneNumbersDetectorStrategyInterface;
use PHPUnit\Framework\TestCase;

class CustomerBuilderTest extends TestCase
{
    private \stdClass $rawCustomer;

    private function setupRawCustomer($id,$name,$phone){
        $this->rawCustomer = new \stdClass();
        $this->rawCustomer->id = $id;
        $this->rawCustomer->name = $name;
        $this->rawCustomer->phone = $phone;
    }

    private function setUpBuilderAndGetDTO($country,$phoneValidity) : CustomerDTOInterface{
        $mockedPhoneDetectionStrategy = $this->getMockBuilder(PhoneNumbersDetectorStrategyInterface::class)->getMock();
        $mockedPhoneDetectionStrategy->method('getCountryByPhoneNumber')->willReturn($country);
        $mockedPhoneDetectionStrategy->method('getValidityByPhoneNumber')->willReturn($phoneValidity);
        $concreteBuilder = new CustomerConcreteBuilder($this->rawCustomer,$mockedPhoneDetectionStrategy);
        $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);
        return $customerCreationDirector->getCustomer();
    }

    public function testCustomerValidPhone()
    {
        $this->setupRawCustomer(1,'jimmi doe','(212) 698054317');
        $customerDTO = $this->setUpBuilderAndGetDTO('Morocco',true);

        $this->assertEquals('OK',$customerDTO->getState());
    }

    public function testCustomerInvalidPhone()
    {

        $this->setupRawCustomer(1,'jimmi doe','(212) 6007989253');
        $customerDTO = $this->setUpBuilderAndGetDTO('Morocco',false);

        $this->assertEquals('NOK',$customerDTO->getState());
    }

    public function testCustomerCountry()
    {
        $this->setupRawCustomer(1,'jimmi doe','(212) 698054317');
        $customerDTO = $this->setUpBuilderAndGetDTO('Morocco',true);

        $this->assertEquals('Morocco',$customerDTO->getCountry());
    }

    public function testCustomerPhone()
    {
        $this->setupRawCustomer(1,'jimmi doe','(212) 698054317');
        $customerDTO = $this->setUpBuilderAndGetDTO('Morocco',true);

        $this->assertEquals('698054317',$customerDTO->getPhone());
    }

    public function testCustomerCountryCode()
    {
        $this->setupRawCustomer(1,'jimmi doe','(212) 698054317');
        $customerDTO = $this->setUpBuilderAndGetDTO('Morocco',true);

        $this->assertEquals('+212',$customerDTO->getCode());
    }
}
