<?php

namespace App\Http\Requests\Api;

class InventoryRequest extends FormRequest
{

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [
                    'mark' => 'string'
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
            'mark' => '备注'
        ];
    }
}
