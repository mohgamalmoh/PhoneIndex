<?php


namespace App\Modules\Customers\Strategies;


use App\Modules\Customers\Strategies\Interfaces\PhoneNumbersDetectorStrategyInterface;
use App\Utils\CountryCodesMapUtil;
use App\Utils\CountryPhonesRegexpMapUtil;

class PhoneNumberDetectorStrategy implements PhoneNumbersDetectorStrategyInterface
{
    private string $country;

    public function getCountryByPhoneNumber(string $phoneNumber): string
    {
        $countriesMap = CountryCodesMapUtil::COUNTRY_CODE_MAP;
        $extractedCountryCode = substr($phoneNumber,1,3);
        if (isset($countriesMap[$extractedCountryCode])){
            $this->country = $countriesMap[$extractedCountryCode];
            return $this->country;
        }else{
            return '';
        }
    }

    public function getValidityByPhoneNumber(string $phoneNumber): bool
    {
        $countriesRegEx = CountryPhonesRegexpMapUtil::COUNTRY_PHONES_REGEXP_MAP;
        if(!isset($this->country)){
            $this->getCountryByPhoneNumber($phoneNumber);
        }
        if (isset($countriesRegEx[$this->country])){
            return preg_match('/'.$countriesRegEx[$this->country].'/' , $phoneNumber) == 1;
        }else{
            return '';
        }
    }
}