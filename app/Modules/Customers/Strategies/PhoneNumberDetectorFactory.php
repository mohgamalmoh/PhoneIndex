<?php


namespace App\Modules\Customers\Strategies;


use App\Modules\Customers\Strategies\Interfaces\PhoneNumbersDetectorStrategyInterface;
use App\Modules\Customers\Utils\CountryCodesMapUtil;
use App\Modules\Customers\Utils\CountryPhonesRegexpMapUtil;

class PhoneNumberDetectorFactory
{

    public static function generate(): PhoneNumbersDetectorStrategyInterface
    {
        return new PhoneNumberDetectorStrategy();
    }

}