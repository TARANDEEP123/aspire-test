<?php

namespace App\Http\Controllers;

use App\Models\LookupType;

/**
 * Class LookupTypeController
 * @package App\Http\Controllers
 */
class LookupTypeController extends BaseController
{
    /**
     * LookupTypeController constructor.
     */
    public function __construct ()
    {
        $this->model = LookupType::class;
    }
}
