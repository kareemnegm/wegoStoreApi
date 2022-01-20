<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFormRequest;

class SignupFormRequest extends BaseFormRequest
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
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'role'=> 'required|in:storeOwner,customer',
                'plan_id'=> 'exists:plans,id',
                'country'=> 'required|exists:countries,id',
                'city'=> 'required|exists:cities,id'
                            ];

    }
}
