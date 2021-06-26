<?php


namespace App\Modules\Customers\Countries;

use App\Modules\Customers\Countries\Interfaces\CountriesInterface;
use App\Modules\Customers\Utils\CountryPhonesRegexpMapUtil;

class Countries implements CountriesInterface
{

    public function getList(): array
    {
        return array_keys(CountryPhonesRegexpMapUtil::COUNTRY_PHONES_REGEXP_MAP);
    }
}