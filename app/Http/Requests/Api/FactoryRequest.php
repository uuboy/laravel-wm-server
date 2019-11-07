<?php

namespace App\Http\Requests\Api;


class FactoryRequest extends FormRequest
{

     public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                   'name' => 'required|string',
                   'code' => 'string',
                   'tel' => 'string',
                   'bank' => 'string',
                   'account' => 'string',
                   'address' => 'string',
                ];
            }
            break;
            // UPDATE
            case 'PUT':
            {
                return [
                   'name' => 'required|string',
                   'code' => 'string',
                   'tel' => 'string',
                   'bank' => 'string',
                   'account' => 'string',
                   'address' => 'string',
                ];
            }
            break;
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
