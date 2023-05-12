<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'login',
        'signUp',
        'createUser',

        'applyForLoan',
        'premiumPayment',

        'approveLoan/*',
        'verifyPayment',

        'lookupTypes',
        'lookupTypes/*',

        'lookupValues',
        'lookupValues/*',

        'loanTypes',
        'loanTypes/*',
    ];
}
