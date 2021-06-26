<?php

namespace App\Modules\Customers\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Filterable;

    protected $table = 'customer';
}