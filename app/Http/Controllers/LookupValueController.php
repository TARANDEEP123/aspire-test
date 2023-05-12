<?php

namespace App\Http\Controllers;

use App\Models\LookupValue;

/**
 * Class LookupValueController
 * @package App\Http\Controllers
 */
class LookupValueController extends BaseController
{
    /**
     * LookupValueController constructor.
     */
    public function __construct ()
    {
        $this->model = LookupValue::class;
    }
}
