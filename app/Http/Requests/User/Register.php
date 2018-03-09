<?php

namespace Api\Http\Requests\User;

use Dingo\Api\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'surname' => 'string',
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function authorize()
    {
        return true;
    }

}