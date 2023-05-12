<?php

namespace App\Services;

use App\Models\LoanRepayment;
use App\Models\UserLoan;
use App\Utility\DateUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Financial;

/**
 * Class UserLoanService
 * @package App\Services
 */
class UserLoanService
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserLoanService constructor.
     */
    public function __construct ()
    {
        $this->userService = new UserService();
    }

    /**
     * Creates loan application
     * Check if same type application is there in system or not
     * @param $request
     * @param $userId
     * @return UserLoan
     */
    public function createLoanApplicationLine ($loanType, $userId)
    {
        $userLoan = UserLoan::where('loan_type_id', $loanType->id)
            ->where('user_id', $userId)
            ->whereNull('sanctioned_at')
            ->first();

        if ( $userLoan ) {
            return redirect('/userHomePage')->with('success', 'There is already a open application for that');;
        }

        $userLoan = new UserLoan();
        $userLoan->amount = $loanType->amount;
        $userLoan->user_id = $userId;
        $userLoan->loan_status_id = APPLIED_LOAN_STATUS_ID;
        $userLoan->loan_type_id = $loanType->id;
        $userLoan->save();

        return redirect('/userHomePage')->with('success', 'Application submitted');
    }

    /**
     * Approves loan
     *
     * @param $userLoan
     * @return mixed
     */
    public function approveLoan ($userLoan)
    {
        $userLoan->sanctioned_at = Date::now();
        $this->changeLoanStatus($userLoan, OPEN_LOAN_STATUS_ID);

        return $userLoan;
    }

    /**
     * Create EMI premiums line to system with due date
     * @param $userLoan
     */
    public function createEMILine ($userLoan)
    {
        try {
            DB::beginTransaction();
            $dueDate = DateUtil::getCurrentDate();
            $repaymentArray = [];
            for ( $i = 0; $i < $userLoan->loan_type->duration; $i++ ) {
                $repaymentArray[] = [
                    'amount'            => $this->calculateEMI($userLoan->loan_type->interest_rate, $userLoan->loan_type->duration, $userLoan->amount),
                    'repayment_head_id' => EMI_HEAD_ID,
                    'due_date'          => $dueDate,
                    'user_id'           => $userLoan->user_id,
                    'loan_id'           => $userLoan->id,
                ];

                $dueDate = \date('Y-m-d', strtotime('+7 days', strtotime($dueDate)) + ( 7 * 12 * 60 ));
            }
            LoanRepayment::insert($repaymentArray);
            DB::commit();
        }catch(\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Create Arrangement fee line to repayment table
     * @param $userLoan
     */
    public function createArrangementFeeLine ($userLoan)
    {
        self::createRepaymentLine([
            'amount'            => $userLoan->loan_type->arrangement_fee,
            'repayment_head_id' => ARRANGEMENT_FEE_HEAD_ID,
            'due_date'          => DateUtil::getCurrentDate(),
            'user_id'           => $userLoan->user_id,
            'loan_id'           => $userLoan->id,
        ]);
    }

    /**
     * Create generic repayment line
     * @param $parameter
     * @return bool
     */
    public static function createRepaymentLine ($parameter)
    {
        $loanRepayment = new LoanRepayment();
        foreach ( $parameter as $key => $value ) {
            $loanRepayment->setAttribute($key, $value);
        }

        return $loanRepayment->save();

    }

    /**
     * Creates loan against user
     * @param $user
     * @param $loanType
     * @return mixed
     */
    public function createLoan ($user, $loanType)
    {
        $userLoan = new UserLoan();
        $userLoan->user_id = $user->id;
        $userLoan->loan_type_id = $loanType->id;
        $userLoan->save();

        return $this->approveLoan($userLoan);
    }

    /**
     * Captures payment against loan
     * @param $payment
     * @return mixed
     */
    public function captureLoanPayment ($payment)
    {
        $payment->paid_at = DateUtil::getCurrentTime();
        $payment->payment_type_id = CASH_PAYMENT_TYPE_ID;
        $payment->save();

        return $payment;
    }

    /**
     * Payment verified
     * @param $payment
     * @return mixed
     */
    public function paymentVerified ($payment)
    {
        if ( !$payment->paid_at ) {
            $payment->paid_at = DateUtil::getCurrentTime();
            $payment->payment_type_id = CASH_PAYMENT_TYPE_ID;
        }

        $payment->verified_at = DateUtil::getCurrentTime();
        $payment->save();

        return $payment;
    }

    /**
     * Calculate EMI amount of a loan
     * @param $interestRate
     * @param $emiTenure
     * @param $principal
     * @return float
     */
    public static function calculateEMI ($interestRate, $emiTenure, $principal)
    {
        return round(abs(Financial::PMT($interestRate / 700, $emiTenure, $principal)));
    }

    /**
     * Return upcoming premiums
     * @return mixed
     */
    public function myUpcomingPremiums ()
    {
        $currentDate = DateUtil::getCurrentDate();
        $weekLater = \date('Y-m-d', strtotime('+7 days'));

        return LoanRepayment::where('user_id', Auth::id())
            ->whereNull('paid_at')
            ->whereBetween('due_date', [$currentDate, $weekLater])
            ->distinct('loan_id')
            ->get();
    }

    /**
     * Generic loan change status method
     * @param $userLoan
     * @param $status
     * @return mixed
     */
    public function changeLoanStatus ($userLoan, $status)
    {
        $userLoan->loan_status_id = $status;
        $userLoan->save();

        return $userLoan;
    }
}
