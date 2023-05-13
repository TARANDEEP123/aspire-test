<?php

namespace App\Models;

use App\Observers\UserLoanObserver;
use App\Utility\DateUtil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserLoan
 * @package App\Models
 */
class UserLoan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'utl_user_loans';

    /**
     * Related to LoanType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $guarded = [];
    public function loan_type ()
    {
        return $this->belongsTo(LoanType::class);
    }

    /**
     * Related to Loan status to LookupValues
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loan_status ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Related to Loan repayments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loan_repayments ()
    {
        return $this->hasMany(LoanRepayment::class, 'loan_id')->where('due_date', '<=', DateUtil::getCurrentDate());
    }

    /**
     * Related to Loan repayments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment_history()
    {
        return $this->hasMany(PaymentHistory::class, 'loan_id');
    }

    /**
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
        self::observe(new UserLoanObserver());
    }
}
