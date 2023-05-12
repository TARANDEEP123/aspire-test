<?php

namespace App\Models;

use App\Observers\LoanRepaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoanRepayment
 * @package App\Models
 */
class LoanRepayment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table name
     * @var string
     */
    protected $table = 'utl_loan_repayments';

    /**
     * Loan mapped to the re-payments
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loan ()
    {
        return $this->belongsTo(UserLoan::class);
    }

    /**
     * Payment type
     * such as cash, cc, online
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Payment type
     * such as cash, cc, online
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new LoanRepaymentObserver());
    }
}
