<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class LoanTypeController
 * @package App\Http\Controllers
 */
class LoanTypeController extends BaseController
{
    /**
     * LoanTypeController constructor.
     */
    public function __construct ()
    {
        $this->model = LoanType::class;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function returnUserHomePage ()
    {
        return View('user.home')->with(['data' => LoanType::get()]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function returnLoanTypes ()
    {
        return View('admin.loanType')->with(['data' => LoanType::get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store (Request $request)
    {
        $record = parent::store($request);

        if ( $record->errors ) {
            return redirect()->with('failure', $record->errors);
        }

        return redirect('/loanType')->with('success', 'Record created');
    }
}
