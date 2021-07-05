<?php


namespace App\Modules\Customers\Strategies;


use App\Modules\Customers\Strategies\Interfaces\PhoneNumbersDetectorStrategyInterface;

class PhoneNumberDetectorFactory
{

    public static function generate(): PhoneNumbersDetectorStrategyInterface
    {
        return new PhoneNumberDetectorStrategy();
    }

}