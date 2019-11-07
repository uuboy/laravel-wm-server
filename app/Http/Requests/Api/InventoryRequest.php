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
                    'deal_date' => 'required',
                    'factory_id' => 'required|integer',
                ];
            break;
            case 'PUT':
                return [
                    'sort' => 'required|integer',
                    'name' => 'required|string',
                    'deal_date' => 'required',
                    'factory_id' => 'required|integer',
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
            'deal_date' => '交易日期',
            'factory_id' => '往来单位',
        ];
    }
}
