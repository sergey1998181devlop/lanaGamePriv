<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class metro extends Model
{
    protected $table = 'metro';
    public $timestamps = false;
    public function city()
    {
        return $this->belongsTo(city::class);
    }
}
