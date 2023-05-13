<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanApplicationRequest;
use App\Http\Requests\LoanRepayment as RequestsLoanRepayment;
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
    public function applyForLoan ($loanTypeId)
    {
        $loanType = LoanType::find($loanTypeId);
        $userId = auth()->id();
        if ( empty($loanType) || empty($userId)) {
            return failure("No Data Found");
        }

        return $this->service->createLoanApplicationLine($loanType, $userId);

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
            return failure('No such loan found and only applied loan can be rejected');
        }

        if ( ( is_null($userLoan->sanctioned_at) ) ) {
            $this->service->approveLoan($userLoan);

            return success($userLoan->user->email . ' loan is approved!');
        }

        return failure('Loan already approved/rejected');
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
            return failure ('No such loan');
        }

        if ( $userLoan->loan_status_id === APPLIED_LOAN_STATUS_ID ) {
            $this->service->changeLoanStatus($userLoan, REJECT_LOAN_STATUS_ID);

            return success('Rejected loan for ' . $userLoan->user->email);
        }

        return failure('Only applied loan can be rejected');
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
    public function premiumPayment (RequestsLoanRepayment $request)
    {

        $loan = UserLoan::find($request->loan_id);

        if ( !$loan ) {
            failure('Loan Payment not found');
        }

        if ( $loan->user_id != auth()->id() ) { //can be removed
            return failure('Unauthorised');
        }

        if($loan->loan_status_id != OPEN_LOAN_STATUS_ID) {
            return failure('Loan is already paid or yet to be approved');
        }

        return $this->service->captureLoanPayment($loan, $request);

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
        $data = UserLoan::with(['loan_type', 'loan_status', 'loan_repayments','payment_history'])->where('user_id', auth()->id())->get();

        return success($data);
    }


    public function loanDetail ($loanId)
    {

        $dues = UserLoan::with('loan_type', 'loan_status', 'loan_repayments.payment_type', 'user')
            ->find($loanId);

        if(auth()->id() == $dues['user_id']){
           return success($dues);
        }

        return failure('Unauthorized to See Loan Details');

    }
}
