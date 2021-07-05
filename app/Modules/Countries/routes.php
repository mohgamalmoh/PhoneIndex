<?php

use Illuminate\Support\Facades\Route;
use \App\Modules\Countries\Controllers\CountriesController;

Route::get('/countries-list', [CountriesController::class, 'getCountriesList']);