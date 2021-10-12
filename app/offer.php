<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class offer extends Model
{
    use SoftDeletes;
    public function clubs()
    {
        return $this->hasMany('App\club','user_id');
    }
}
