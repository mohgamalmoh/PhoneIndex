<?php

namespace App\Modules\Countries\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Countries\Services\CountriesService;
use App\Modules\Countries\Services\Interfaces\CountriesInterface;

class CountriesController extends Controller
{
    private CountriesInterface $countriesService;
    public function __construct(CountriesInterface $countriesService){
        $this->countriesService = $countriesService;
    }

    public function getCountriesList(){
        return response()->json($this->countriesService->getList(), 200);
    }

}