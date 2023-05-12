<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    /**
     * Just to test some part of code
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function test (Request $request)
    {
        return success('Server is working fine you take rest!');
    }
}
