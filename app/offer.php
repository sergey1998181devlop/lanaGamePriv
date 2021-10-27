<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class offer extends Model
{
    use SoftDeletes;
    public function linkedClub()
    {
        return $this->hasOne('App\club','id','user_link')->select('id','club_name','user_id','url','club_city')->with('city:id,en_name');
    }
    public function firstClub()
    {
        return $this->hasOne('App\club','user_id','user_id')->select('id','club_name','user_id','url','club_city')->where('draft', '0')->whereNotNull('published_at')->whereNull('unpublished_at')->with('city:id,en_name');
    }
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','phone','email');
    }
}
