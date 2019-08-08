<?php

namespace App\Http\Requests\Api;

class GoodRequest extends FormRequest
{

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [
                    'name' => 'required|string',
                    'type' => 'string',
                    'sort' => 'required|integer',
                    'factory' => 'string',
                    'price' => 'numeric',
                    'unit' => 'string',
                ];
            break;
            case 'PUT':
                return [
                    'name' => 'required|string',
                    'type' => 'string',
                    'sort' => 'required|integer',
                    'factory' => 'string',
                    'price' => 'numeric',
                    'unit' => 'string',
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
            'name' => '商品名称',
            'type' => '商品规格',
            'sort' => '商品种类',
            'factory' => '商品厂家',
            'price' => '商品价格',
            'unit' => '商品计量单位',
        ];
    }
}
