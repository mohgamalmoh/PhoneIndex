<?php
namespace App\Modules\Customers\Validation\Interfaces;

interface ValidationInterface
{
    public function validate():bool;
    public  function getMessages():string;


}
