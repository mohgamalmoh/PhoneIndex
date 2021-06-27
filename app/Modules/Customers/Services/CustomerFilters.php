<?php
namespace App\Filters;
use App\Modules\Customers\Utils\CountryCodesMapUtil;
use App\Modules\Customers\Utils\CountryPhonesRegexpMapUtil;
use App\User;
use Illuminate\Support\Facades\DB;

class CustomerFilters extends QueryFilters
{
    protected $request;
    public function __construct(array $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function country($term = '') {
        $code = array_search($term, CountryCodesMapUtil::COUNTRY_CODE_MAP);
        if($code){
            return $this->builder->where('phone', 'LIKE', "($code)%");
        }
        return $this->builder;
    }

    public function state($term = '') {

        if($term == 'valid'){
            $regex = $this->prepareStateRegex();
            return $this->builder->whereRaw("phone REGEXP \"/".$regex."/\"");
        }elseif ($term == 'invalid'){
            $regex = $this->prepareStateRegex();
            return $this->builder->whereRaw("phone not REGEXP \"/".$regex."/\"");
        }else{
            return $this->builder;
        }

    }

    /**
     * @return string
     */
    public function prepareStateRegex(): string
    {
        $regex = implode('|', array_values(CountryPhonesRegexpMapUtil::COUNTRY_PHONES_REGEXP_MAP));
        DB::connection()->getPdo()->sqliteCreateFunction("REGEXP", "preg_match", 2);
        return $regex;
    }

}