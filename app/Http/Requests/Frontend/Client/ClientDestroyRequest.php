<?php

namespace App\Http\Requests\Frontend\Client;

use App\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @var Client $client
         */
        $client = $this->route()->parameter('client');

        return $client->canBeDeletedByUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
