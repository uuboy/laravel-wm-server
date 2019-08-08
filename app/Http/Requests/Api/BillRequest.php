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
                    'sort' => 'required|integer',
                    'num' => 'required|integer',
                ];
            break;
            case 'PUT':
                return [
                    'sort' => 'required|integer',
                    'num' => 'required|integer',
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
            'sort' => '单据类型',
            'num' => '单据数量',
        ];
    }
}
