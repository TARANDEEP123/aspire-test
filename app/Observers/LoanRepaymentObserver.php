<?php

namespace App\Observers;

use App\Models\LoanRepayment;
use App\Services\LoanRepaymentService;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class LoanRepaymentObserver
 * @package App\Observers
 */
class LoanRepaymentObserver
{
    /**
     * @param Eloquent $model
     */
    public function updated (Eloquent $model)
    {
        //Close loan automatically
        if ( $model->wasChanged('paid_at') ) {
            $left = LoanRepayment::where('loan_id', $model->loan_id)
                ->whereNull('paid_at')
                ->get();

            if ( !count($left) ) {
                LoanRepaymentService::closeLoan($model->loan);
            }
        }
    }
}
