<?php

namespace App\Http\Requests\Api;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'name' => 'required'
                ];
                break;
            case 'PATCH':
                $userId = \Auth::guard('api')->id();
                return [
                    'name' => 'required',
                    'email' => 'email|unique:users,email,' .$userId,
                ];
                break;
            case 'PUT':
                $userId = \Auth::guard('api')->id();
                return [
                    'name' => 'required',
                    'email' => 'email|unique:users,email,' .$userId,
                ];
                break;
        }

    }

}
