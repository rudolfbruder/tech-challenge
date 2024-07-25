<?php

namespace App\Http\Requests\Frontend\Client;

use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:190',
            'email' => 'required_without_all:phone|nullable|email:rfc,dns|unique:users',
            'phone' => ['required_without_all:email,null|nullable', new PhoneNumberRule($this->email)],
            'city' => 'string|nullable',
            'address' => 'string|nullable',
            'postcode' => 'string|nullable',
        ];
    }
}
