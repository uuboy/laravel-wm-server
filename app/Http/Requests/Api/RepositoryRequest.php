<?php

namespace App\Http\Requests\Api;

class RepositoryRequest extends FormRequest
{

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [
                    'name' => 'required|string',
                ];
            break;
            case 'PUT':
                return [
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
            'name' => '仓库名称',
        ];
    }
}
