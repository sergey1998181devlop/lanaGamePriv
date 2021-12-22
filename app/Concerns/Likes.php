<?php
namespace App\Concerns;

use App\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likes
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')->where('type','like')->has('user')->select('id','user_id');
    }
    public function unLikes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')->where('type','unlike')->has('user')->select('id','user_id');
    }
}
?>