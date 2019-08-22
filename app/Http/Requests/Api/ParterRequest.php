<?php

namespace App\Http\Requests\Api;

class ParterRequest extends FormRequest
{

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [

                ];
            break;
            case 'PUT':
                return [

                ];
            break;

            default:
                return [

                ];
        }
    }

    public function attributes()
    {
        return [

        ];
    }
}
