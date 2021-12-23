<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;
class loginFormRequestAdmin extends BaseFormRequest
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
            'email'=>'required|string|exists:admins,email',
            'password'=>'required'
        ];
    }
}
