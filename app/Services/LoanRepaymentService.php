<?php

namespace App\Services;

use App\Models\LoanRepayment;
use App\Utility\DateUtil;

/**
 * Class LoanRepaymentService
 * @package App\Services
 */
class LoanRepaymentService
{
    /**
     * @var UserLoanService
     */
    private $userLoanService;

    /**
     * LoanRepaymentService constructor.
     */
    public function __construct ()
    {
        $this->userLoanService = new UserLoanService();
    }

    /**
     * This will return total amount to pay
     * against a loan in present
     * @param $userLoan
     * @return mixed
     */
    public function getTotalAmountToPay ($userLoan)
    {
        $totalPaid = LoanRepayment::where('loan_id', $userLoan->id)
            ->where('repayment_head_id', EMI_HEAD_ID)
            ->whereNotNull('paid_at')
            ->sum('amount');

        //inclusive of penalties and late fee and arrangement fee
        $totalLoanAmount = LoanRepayment::where('loan_id', $userLoan->id)
            ->whereNull('paid_at')
            ->sum('amount');

        return $totalLoanAmount - $totalPaid;
    }

    /**
     * It will create loan closure line
     *
     * @param $amount
     * @param $userLoan
     */
    public function createEarlyLoanClosureLine ($amount, $userLoan)
    {
        UserLoanService::createRepaymentLine([
            'amount'            => $amount,
            'repayment_head_id' => EARLY_LOAN_CLOSURE_HEAD_ID,
            'due_date'          => DateUtil::getCurrentDate(),
            'user_id'           => $userLoan->user_id,
            'loan_id'           => $userLoan->id,
            'paid_at'           => DateUtil::getCurrentDate(),
            'payment_type_id'   => CASH_PAYMENT_TYPE_ID,
        ]);
    }

    /**
     * Close loan
     *
     * @param $userLoan
     * @return mixed
     */
    public static function closeLoan ($userLoan)
    {
        LoanRepayment::where('loan_id', $userLoan->id)
            ->whereNull('paid_at')
            ->delete();

        return ( new UserLoanService() )->changeLoanStatus($userLoan, CLOSED_LOAN_STATUS_ID);
    }
}
