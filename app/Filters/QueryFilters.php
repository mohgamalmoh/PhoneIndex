<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilters
{
    protected $request;
    protected $builder;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->request as $name => $value) {
            if ( ! method_exists($this, $name)) {
                continue;
            }
            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        return $this->builder;
    }

}