<?php

namespace App\Models;

use App\Observers\UserLoanObserver;
use App\Utility\DateUtil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserType
 * @package App\Models
 */
class UserType extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_type';

}
