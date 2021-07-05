<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    public $table = "users_verify";

    protected $fillable = [
        'user_id',
        'token',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
