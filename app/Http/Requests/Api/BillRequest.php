<?php

namespace App\Http\Requests\Api;

class BillRequest extends FormRequest
{

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [
                    'num' => 'required|integer|min:0',
                ];
            break;
            case 'PUT':
                return [
                    'num' => 'required|integer|min:0',
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
            'num' => '数量',
        ];
    }
}
