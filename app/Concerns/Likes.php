<?php
namespace App\Concerns;

use App\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likes
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')->where('type','like');
    }
    public function unlikes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')->where('type','unlike');
    }
}
?>