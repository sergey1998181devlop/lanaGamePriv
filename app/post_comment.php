<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Likeable;
use App\Concerns\Likes;
use Illuminate\Database\Eloquent\SoftDeletes;
class post_comment extends Model implements Likeable
{
    use Likes;use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','type');
    }
    public function replies()
    {
        return $this->hasMany(post_comment::class, 'parent_id')->has('user')->select('id','user_id','body','image','image_thumbnail','created_at');
    }
}
