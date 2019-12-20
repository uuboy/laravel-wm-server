<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class WeappAuthorizationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'code' => 'required|string',
                ];
                break;
            case 'PATCH':
                return [

                ];
                break;
            case 'PUT':
                return [

                ];
        }
    }
}
