<?php

namespace App\Modules\Customers\Requests;

use App\Http\Requests\APIRequest;
use App\Modules\Countries\Services\Interfaces\CountriesInterface;
use App\Modules\Customers\Countries\Countries;

class CustomersIndexRequest extends APIRequest
{
    private $countriesService;
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null, CountriesInterface $countriesService)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->countriesService = $countriesService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country' => 'nullable|in:'.implode(',',$this->countriesService->getList()),
            'state' => 'nullable|in:valid,invalid'
        ];
    }

    public function messages()
    {
        return [
            'country.in' => 'invalid country',
            'state.in'  => 'invalid state'
        ];
    }

}
