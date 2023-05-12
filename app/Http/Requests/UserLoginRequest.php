<?php

namespace App\Http\Requests;

/**
 * Class UserLoginRequest
 * @package App\Http\Requests
 */
class UserLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string',
        ];
    }
}
