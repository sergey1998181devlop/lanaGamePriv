<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function clubs()
    {
        return $this->hasMany('App\club','user_id');
    }
}
