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
                    'sort' => 'required|integer',
                    'name' => 'required|string',
                ];
            break;
            case 'PUT':
                return [
                    'sort' => 'required|integer',
                    'name' => 'required|string',
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
            'name' => '名称',
            'sort' => '类型',
        ];
    }
}
