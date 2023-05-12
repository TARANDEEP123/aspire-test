<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class BaseRequest
 * @package App\Http\Requests
 */
class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return true;
    }

    /**
     * @param Validator $validator
     * formatting the response as per our requirement
     */
    protected function failedValidation (Validator $validator)
    {
//        throw new failure(Response("Validation failure  " . $validator->errors(), 443));
    }
}
