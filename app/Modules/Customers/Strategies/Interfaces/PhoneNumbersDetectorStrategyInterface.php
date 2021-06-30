<?php
namespace App\Modules\Customers\Strategies\Interfaces;

interface PhoneNumbersDetectorStrategyInterface{
    public function getCountryByPhoneNumber(string $phoneNumber) : string;
    public function getValidityByPhoneNumber(string $phoneNumber) : bool;
}