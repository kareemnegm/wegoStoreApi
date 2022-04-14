<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class ShippingFormRequest extends BaseFormRequest
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
        return [
                'shipping_method'=>'required|in:,product wise,flat rate,weight wise,area wise'
        ];
    }
}

