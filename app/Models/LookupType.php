<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LookupType
 * @package App\Models
 */
class LookupType extends Model
{
    use HasFactory;

    /**
     * Table name
     * @var string
     */
    protected $table = 'utl_lookup_types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description'
    ];
}
