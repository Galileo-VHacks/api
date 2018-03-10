<?php

namespace Api\Http\Requests\Transaction;

use Dingo\Api\Http\FormRequest;

class Execute extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'to' => 'required|string',
            // 'amount' => 'required|integer',
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