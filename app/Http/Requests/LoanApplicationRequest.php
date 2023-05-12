<?php

namespace App\Http\Requests;

/**
 * Class LoanApplicationRequest
 * @package App\Http\Requests
 */
class LoanApplicationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
//            "name"         => "string",
//            "email"        => "email|unique:sys_users",
//            "password"     => "min:4|max:8",
//            "address"      => "string",
//            "loan_type_id" => "required|numeric",
//            "note"         => "string",
        ];
    }
}
