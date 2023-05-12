<?php

namespace App\Http\Controllers;

use App\Models\LoanRepayment;
use App\Models\UserLoan;
use App\Services\LoanRepaymentService;
use App\Utility\DateUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class LoanRepaymentController
 * @package App\Http\Controllers
 */
class LoanRepaymentController extends BaseController
{
    /**
     * @var LoanRepaymentService
     */
    private $loanService;

    /**
     * LoanRepaymentController constructor.
     */
    public function __construct ()
    {
        $this->loanService = new LoanRepaymentService();
        $this->model = LoanRepayment::class;
    }

    /**
     * Give premiums history of all loans for a particular user
     *
     * @return View
     */
    public function repaymentHistory ()
    {
        $loanRepayment = LoanRepayment::with(['loan', 'payment_type'])
            ->where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('due_date', '<=', DateUtil::getCurrentDate());
                $query->orWhereNotNull('paid_at');
            })
            ->get();

        return view('user.myrepayment')->with('data', $loanRepayment);
    }


    /**
     * This Close loan early with all necessary action
     *
     * @param Request $request
     * @param $loanId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function closeLoanEarly (Request $request, $loanId)
    {
        $userLoan = UserLoan::find($loanId);

        if ( !$userLoan ) {
            return redirect($request->url)->with('failure', 'No such loans');
        }

        $amountToPayNow = $this->loanService->getTotalAmountToPay($userLoan);

        if ( $amountToPayNow <= 0 ) {
            return redirect($request->url)->with('failure', 'Loan already paid');
        }

        $this->loanService->createEarlyLoanClosureLine($amountToPayNow, $userLoan);
        $this->loanService->closeLoan($userLoan);

        return redirect($request->url)->with('success', 'Hurray Loan is closed');
    }

    /**
     * @param $repaymentId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function repaymentDetail ($repaymentId)
    {
        $repayment = LoanRepayment::find($repaymentId);

        if ( !$repayment ) {
            return redirect('/loanHistory')->with('failure', 'No such loans');
        }

        return view('user.repaymentDetail')->with('data', $repayment);
    }
}
