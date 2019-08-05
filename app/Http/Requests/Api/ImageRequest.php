<?php

namespace App\Http\Requests\Api;


class ImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'required'
        ];
    }
}
