<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanApplicationRequest;
use App\Models\LoanRepayment;
use App\Models\LoanType;
use App\Models\User;
use App\Models\UserLoan;
use App\Services\UserLoanService;
use App\Utility\DateUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class UserLoanController
 * @package App\Http\Controllers
 */
class UserLoanController extends BaseController
{
    /**
     * @var UserLoanService
     */
    protected $service;
    /**
     * @var string
     */
    protected $model = UserLoan::class;

    /**
     * UserLoanController constructor.
     */
    public function __construct ()
    {
        $this->service = new UserLoanService();
    }

    /**
     * User applies for loan
     * User can be existing user
     * or new user
     *
     * @param LoanApplicationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyForLoan (LoanApplicationRequest $request, $loanTypeId)
    {
        $loanType = LoanType::find($loanTypeId);

        if ( !$loanType || !Auth::id() ) {
            return redirect('/userHomePage')->with('failure', 'Sorry you cant apply this loan');
        }

        return $this->service->createLoanApplicationLine($loanType, Auth::id());

    }

    /**
     * Admin approves loan
     *
     * @param $loanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveLoan ($loanId)
    {
        $userLoan = $this->model::find($loanId);

        if ( $userLoan && $userLoan->loan_status_id != APPLIED_LOAN_STATUS_ID ) {
            return redirect('/adminHomePage')->with('failure', 'No such loan found and only applied loan can be rejected');
        }

        if ( ( is_null($userLoan->sanctioned_at) ) ) {
            $this->service->approveLoan($userLoan);

            return redirect('/adminHomePage')->with('success', $userLoan->user->email . ' loan is approved!');
        }

        return redirect('/adminHomePage')->with('failure', 'Loan already approved/rejected');
    }

    /**
     * Admin reject loans
     * Only Applied loan status can be rejected
     *
     * @param $loanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectLoan ($loanId)
    {
        $userLoan = $this->model::find($loanId);

        if ( !$userLoan ) {
            return redirect('/adminHomePage')->with('failure', 'No such loan');
        }

        if ( $userLoan->loan_status_id === APPLIED_LOAN_STATUS_ID ) {
            $this->service->changeLoanStatus($userLoan, REJECT_LOAN_STATUS_ID);

            return redirect('/adminHomePage')->with('success', 'Rejected loan for ' . $userLoan->user->email);
        }

        return redirect('/adminHomePage')->with('failure', 'Only applied loan can be rejected');
    }

    /**
     * Admin makes loan as defaulted
     * Only open loan can be defaulted
     *
     * @param $loanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function defaultedLoan ($loanId)
    {
        $userLoan = $this->model::find($loanId);

        if ( !$userLoan ) {
            return redirect('/adminHomePage')->with('failure', 'No such loan');
        }

        if ( $userLoan->loan_status_id === OPEN_LOAN_STATUS_ID ) {
            $this->service->changeLoanStatus($userLoan, DEFAULT_LOAN_STATUS_ID);

            return redirect('/adminHomePage')->with('success', 'Defaulted loan for ' . $userLoan->user->email);
        }

        return redirect('/adminHomePage')->with('failure', 'Only open loan status can be defaulted');
    }

    /**
     * Admin can create loan offline for user.
     *
     * @param $userId
     * @param $loanTypeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createLoan ($userId, $loanTypeId)
    {
        $user = User::find($userId);

        if ( $user ) {
            return failure('User Not found');
        }

        $loanType = LoanType::find($loanTypeId);

        if ( $loanType ) {
            return failure('Loan Not found');
        }

        return success($this->service->createLoan($user, $loanType));
    }

    /**
     * Captures loan premium amount from user side
     *
     * @param $loanRepaymentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function premiumPayment (Request $request, $loanRepaymentId)
    {
        $payment = LoanRepayment::find($loanRepaymentId);

        if ( !$payment ) {
            return redirect($request->url)->with('failure', 'Loan Payment not found');
        }

        if ( $payment->user_id != Auth::id() ) { //can be removed
            return redirect($request->url)->with('failure', 'Unauthorised');
        }

        $this->service->captureLoanPayment($payment);

        return redirect($request->url)->with('success', 'Payment completed');
    }

    /**
     * Admin verify payment once it is marked as paid
     *
     * @param $loanRepaymentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyPayment (Request $request, $loanRepaymentId)
    {
        $payment = LoanRepayment::find($loanRepaymentId);

        if ( !$payment ) {
            return redirect($request->url)->with('failure', 'Loan Payment not found');
        }

        if ( $payment->verified_at ) {
            return redirect($request->url)->with('failure', 'Loan payment is already verified');
        }

        $this->service->paymentVerified($payment);

        return redirect($request->url)->with('success', 'Payment verified');
    }

    /**
     * This wil return all upcoming premium and backlog as well
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function myUpcomingPremiums ()
    {
        return success($this->service->myUpcomingPremiums());
    }

    /**
     * This will return all loans against a user
     *
     * @return view
     */
    public function myLoans ()
    {
        $data = UserLoan::with(['loan_type', 'loan_status', 'loan_repayments'])->where('user_id', Auth::id())->get();

        return view('user.myloan')->with('data', $data);
    }

    /**
     * This is for Admin to check all due payment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allPaymentPending ()
    {
        $dues = UserLoan::with(['loan_type', 'loan_status', 'loan_repayments', 'user'])
            ->whereHas('loan_repayments', function ($q) {
                $q->where('due_date', '<=', DateUtil::getCurrentDate());
                $q->whereNull('paid_at');
            })->get();

        return view('admin.due')->with('data', $dues);
    }

    public function loanDetail ($loanId)
    {
        $dues = UserLoan::with('loan_type', 'loan_status', 'loan_repayments.payment_type', 'user')
            ->find($loanId);

        return view('user.loanDetail')->with('data', $dues);
    }

    public function allPayment ()
    {
        $dues = LoanRepayment::with('user', 'loan.loan_type', 'payment_type')
            ->whereNull('verified_at')
            ->where('due_date', '<=', DateUtil::getCurrentDate())
            ->whereNull('paid_at')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.allPayment')->with('data', $dues);
    }
}
