<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public function club()
    {
        return $this->belongsTo(club::class,'club_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
