<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use SoftDeletes;
    //
    /**
     * Get the user info's image.
     */
    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
}
