<?php

namespace App\Observers;

use App\Services\UserLoanService;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class UserLoanObserver
 * @package App\Observers
 */
class UserLoanObserver
{
    /**
     * Handle the utl_user_loan "created" event.
     *
     * @param \App\Models\utl_user_loan $utl_user_loan
     * @return void
     */
    public function created (Eloquent $model)
    {
    }

    /**
     * @param Eloquent $model
     */
    public function updated (Eloquent $model)
    {
        //creating automatic premium lines for further payment of premium
        if ( $model->getOriginal('loan_status_id') === APPLIED_LOAN_STATUS_ID && $model->loan_status_id === OPEN_LOAN_STATUS_ID ) {
            $userLoanService = new UserLoanService();

            $userLoanService->createEMILine($model);
            $userLoanService->createArrangementFeeLine($model);
        }
    }

    /**
     * Handle the utl_user_loan "deleted" event.
     *
     * @param \App\Models\utl_user_loan $utl_user_loan
     * @return void
     */
    public function deleted (Eloquent $model)
    {
    }

    /**
     * Handle the utl_user_loan "restored" event.
     *
     * @param \App\Models\utl_user_loan $utl_user_loan
     * @return void
     */
    public function restored (Eloquent $model)
    {
    }

    /**
     * Handle the utl_user_loan "force deleted" event.
     *
     * @param \App\Models\utl_user_loan $utl_user_loan
     * @return void
     */
    public function forceDeleted (Eloquent $model)
    {
    }
}
