<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Likeable;
use App\Concerns\Likes;
class post_comment extends Model implements Likeable
{
    use Likes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(post_comment::class, 'parent_id');
    }
}
