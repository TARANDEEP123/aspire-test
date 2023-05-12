<?php

namespace App\Http\Requests;

/**
 * Class UserCreationRequest
 * @package App\Http\Requests
 */
class UserCreationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:sys_users',
            'password' => 'required|min:4|max:8',
            'address'  => 'required',
        ];
    }
}
