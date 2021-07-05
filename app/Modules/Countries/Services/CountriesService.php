<?php

namespace App\Modules\Countries\Services;


use App\Modules\Countries\Services\Interfaces\CountriesInterface;
use App\Utils\CountryPhonesRegexpMapUtil;

class CountriesService implements CountriesInterface
{
    public function getList(): array
    {
        return array_keys(CountryPhonesRegexpMapUtil::COUNTRY_PHONES_REGEXP_MAP);
    }
}