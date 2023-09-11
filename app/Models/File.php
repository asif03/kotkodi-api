<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use SoftDeletes;
    protected $guarded = false;
    public function fileable()
    {
        return $this->morphTo();
    }
}
