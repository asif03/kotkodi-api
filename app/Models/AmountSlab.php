<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmountSlab extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_id',
        'start_amount',
        'end_amount',
        'backer_fixed_gain',
        'backer_percent_gain'
    ];
}
