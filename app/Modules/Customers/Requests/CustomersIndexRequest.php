<?php

namespace App\Modules\Customers\Requests;

use App\Http\Requests\APIRequest;
use App\Modules\Customers\Countries\Countries;

class CustomersIndexRequest extends APIRequest
{
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
        $countries = new Countries();
        return [
            'country' => 'nullable|in:'.implode(',',$countries->getList()),
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
