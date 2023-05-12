<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoanType
 * @package App\Models
 */
class LoanType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table name
     * @var string
     */
    protected $table = 'utl_loan_types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'amount',
        'description',
        'arrangement_fee',
        'repayment_frequency_type_id',
        'active',
        'duration',
        'interest_rate',
    ];

    /**
     * Frequency of loan repayment related to lookup values
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repayment_frequency_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
