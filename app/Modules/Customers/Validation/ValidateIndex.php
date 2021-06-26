<?php

namespace App\Modules\Customers\Validation;

use App\Modules\Customers\Countries\Countries;
use App\Modules\Customers\Validation\Interfaces\ValidateIndexRequest;
use App\Modules\Customers\Validation\Interfaces\ValidationInterface;
use Illuminate\Support\Facades\Validator;

class ValidateIndex implements ValidationInterface
{

    private array $messages = [];
    private array $request;
    protected array $rules = [];

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->buildRules();
    }

    private function buildRules()
    {
        $countries = new Countries();
        $this->rules = [
            'country' => 'nullable|in:'.implode(',',$countries->getList()),
            'state' => 'nullable|in:valid,invalid'
        ];
    }

    public function validate(): bool
    {
        $validator = Validator::make($this->request, $this->rules);
        if ($validator->fails()) {
            $this->messages = $validator->messages()->all();
            return false;
        }
        return true;
    }

    public function getMessages(): string
    {
        return implode(', ',$this->messages);
    }

}
