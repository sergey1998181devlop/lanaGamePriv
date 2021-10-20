<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class liked_club extends Model
{
    protected  $fillable = ['user_id','club_id'];
}
