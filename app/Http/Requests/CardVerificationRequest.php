<?php

namespace App\Http\Requests;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

use App\Http\Requests\BaseFormRequest;


class CardVerificationRequest extends BaseFormRequest
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
            'card_number' => ['required', new CardNumber],
            'card_exp_year' => ['required', new CardExpirationYear($this->get('card_exp_month'))],
            'card_exp_month' => ['required', new CardExpirationMonth($this->get('card_exp_year'))],
            'cvc' => ['required', new CardCvc($this->get('card_number'))]
        ];
    }

    public function messages()
    {
        return [
            'card_number.required' => 'The card number is compulsory'
        ];
    }
}
