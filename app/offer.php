<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class offer extends Model
{
    use SoftDeletes;
    // public function clubs()
    // {
    //     return $this->hasMany('App\club','user_id','user_id');
    // }
    public function firstClub()
    {
        return $this->hasMany('App\club','user_id','user_id')->where('draft', '0')->whereNotNull('published_at')->whereNull('unpublished_at')->oldest()->limit(1);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
