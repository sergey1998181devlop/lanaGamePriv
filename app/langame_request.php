<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class langame_request extends Model
{
    public function city_name()
    {
        return $this->belongsTo('App\city','city');
    }
}
