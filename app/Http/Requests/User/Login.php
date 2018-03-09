<?php

namespace Api\Http\Requests\User;

use Dingo\Api\Http\FormRequest;

class Login extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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