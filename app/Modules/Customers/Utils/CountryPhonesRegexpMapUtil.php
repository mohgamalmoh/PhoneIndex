<?php

namespace App\Modules\Customers\Utils;

class CountryPhonesRegexpMapUtil
{

     const COUNTRY_PHONES_REGEXP_MAP = [
         'Cameroon'=> '\(237\)\ ?[2368]\d{7,8}$',
         'Ethiopia'=> '\(251\)\ ?[1-59]\d{8}$',
         'Morocco'=> '\(212\)\ ?[5-9]\d{8}$',
         'Mozambique'=> '\(258\)\ ?[28]\d{7,8}$',
         'Uganda'=> '\(256\)\ ?\d{9}$',
     ];

}
