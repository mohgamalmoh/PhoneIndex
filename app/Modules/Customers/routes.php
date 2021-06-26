<?php

use Illuminate\Support\Facades\Route;
use \App\Modules\Customers\Controllers\CustomersController;

Route::get('/index', [CustomersController::class, 'index']);
Route::get('/countries-list', [CustomersController::class, 'getCountriesList']);