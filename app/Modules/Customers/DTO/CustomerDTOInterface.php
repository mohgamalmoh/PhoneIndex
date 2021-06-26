<?php
namespace App\Modules\Customers\DTO;

interface CustomerDTOInterface{
    public function getId() : string;
    public function setId(string $id) : void;
    public function getName() : string;
    public function setName(string $name) : void;
    public function getCountry() : string;
    public function setCountry(string $country) : void;
    public function getState() : string;
    public function setState(string $state) : void;
    public function getCode() : string;
    public function setCode(string $code) : void;
    public function getPhone() : string;
    public function setPhone(string $phone) : void;
}