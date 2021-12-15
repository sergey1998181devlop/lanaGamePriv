<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(post_comment::class, 'parent_id');
    }
}
