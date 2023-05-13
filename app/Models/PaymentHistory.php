<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
        protected $table = "payment_history";

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'loan_id',
        'payment_mode',
        'amount'
    ];

}
