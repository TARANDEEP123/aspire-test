<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LookupValue
 * @package App\Models
 */
class LookupValue extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "utl_lookup_values";

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'value',
        'lookup_type_id',
    ];

    /**
     * Related to LookupType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lookup_type ()
    {
        return $this->belongsTo(LookupType::class);
    }
}
