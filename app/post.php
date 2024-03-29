<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class post extends Model
{
    use SoftDeletes;
    public function clubs()
    {
        return $this->hasMany('App\club','user_id');
    }
    public function comments()
    {
        return $this->morphMany(post_comment::class, 'commentable')->whereNull('parent_id')->has('user')->select('id','user_id','body','image','image_thumbnail','created_at');
    }
    public function commentsTotal()
    {
        return $this->hasMany(post_comment::class, 'commentable_id')->has('user');
    }
}
