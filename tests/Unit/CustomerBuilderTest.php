<?php

namespace Tests\Unit;

use App\Modules\Customers\Builder\ConcreteBuilders\CustomerConcreteBuilder;
use App\Modules\Customers\Builder\CustomerDTOCreationDirector;
use App\Modules\Customers\Strategies\Interfaces\PhoneNumbersDetectorStrategyInterface;
use PHPUnit\Framework\TestCase;

class CustomerBuilderTest extends TestCase
{

    public function testCustomerValidPhone()
    {
        $rawCustomer = new \stdClass();
        $rawCustomer->id = 1;
        $rawCustomer->name = 'john duck';
        $rawCustomer->phone = '(212) 698054317';

        $mockedPhoneDetectionStrategy = $this->getMockBuilder(PhoneNumbersDetectorStrategyInterface::class)->getMock();
        $mockedPhoneDetectionStrategy->method('getCountryByPhoneNumber')->willReturn('Morocco');
        $mockedPhoneDetectionStrategy->method('getValidityByPhoneNumber')->willReturn(true);

        $concreteBuilder = new CustomerConcreteBuilder($rawCustomer,$mockedPhoneDetectionStrategy);
        $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);

        $this->assertEquals('OK',$customerCreationDirector->getCustomer()->getState());

    }

    public function testCustomerInvalidPhone()
    {
        $rawCustomer = new \stdClass();
        $rawCustomer->id = 1;
        $rawCustomer->name = 'john wick';
        $rawCustomer->phone = '(212) 6007989253';

        $mockedPhoneDetectionStrategy = $this->getMockBuilder(PhoneNumbersDetectorStrategyInterface::class)->getMock();
        $mockedPhoneDetectionStrategy->method('getCountryByPhoneNumber')->willReturn('Morocco');
        $mockedPhoneDetectionStrategy->method('getValidityByPhoneNumber')->willReturn(false);

        $concreteBuilder = new CustomerConcreteBuilder($rawCustomer,$mockedPhoneDetectionStrategy);
        $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);

        $this->assertEquals('NOK',$customerCreationDirector->getCustomer()->getState());

    }

    public function testCustomerCountry()
    {
        $rawCustomer = new \stdClass();
        $rawCustomer->id = 1;
        $rawCustomer->name = 'john duck';
        $rawCustomer->phone = '(212) 698054317';

        $mockedPhoneDetectionStrategy = $this->getMockBuilder(PhoneNumbersDetectorStrategyInterface::class)->getMock();
        $mockedPhoneDetectionStrategy->method('getCountryByPhoneNumber')->willReturn('Morocco');
        $mockedPhoneDetectionStrategy->method('getValidityByPhoneNumber')->willReturn(true);

        $concreteBuilder = new CustomerConcreteBuilder($rawCustomer,$mockedPhoneDetectionStrategy);
        $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);

        $this->assertEquals('Morocco',$customerCreationDirector->getCustomer()->getCountry());

    }

    public function testCustomerPhone()
    {
        $rawCustomer = new \stdClass();
        $rawCustomer->id = 1;
        $rawCustomer->name = 'john duck';
        $rawCustomer->phone = '(212) 698054317';

        $mockedPhoneDetectionStrategy = $this->getMockBuilder(PhoneNumbersDetectorStrategyInterface::class)->getMock();
        $mockedPhoneDetectionStrategy->method('getCountryByPhoneNumber')->willReturn('Morocco');
        $mockedPhoneDetectionStrategy->method('getValidityByPhoneNumber')->willReturn(true);

        $concreteBuilder = new CustomerConcreteBuilder($rawCustomer,$mockedPhoneDetectionStrategy);
        $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);

        $this->assertEquals('698054317',$customerCreationDirector->getCustomer()->getPhone());

    }

    public function testCustomerCountryCode()
    {
        $rawCustomer = new \stdClass();
        $rawCustomer->id = 1;
        $rawCustomer->name = 'john duck';
        $rawCustomer->phone = '(212) 698054317';

        $mockedPhoneDetectionStrategy = $this->getMockBuilder(PhoneNumbersDetectorStrategyInterface::class)->getMock();
        $mockedPhoneDetectionStrategy->method('getCountryByPhoneNumber')->willReturn('Morocco');
        $mockedPhoneDetectionStrategy->method('getValidityByPhoneNumber')->willReturn(true);

        $concreteBuilder = new CustomerConcreteBuilder($rawCustomer,$mockedPhoneDetectionStrategy);
        $customerCreationDirector = new CustomerDTOCreationDirector($concreteBuilder);

        $this->assertEquals('+212',$customerCreationDirector->getCustomer()->getCode());

    }
}
