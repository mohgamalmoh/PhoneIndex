<?php

namespace App\Modules\Customers\Builder\Interfaces;

use App\Modules\Customers\DTO\CustomerDTOInterface;

interface CustomerBuilderInterface
{
    public function buildId();
    public function buildCountry();
    public function buildState();
    public function buildCode();
    public function buildPhone();
    public function getCustomer(): CustomerDTOInterface;
}
