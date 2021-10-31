<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    public function ScopeWithoutSpam($query){
        $blocked_ips = [
            '54.39.29.64'
        ];
        return $query->whereNotIn('REMOTE_ADDR',$blocked_ips)->OrWhereNull('REMOTE_ADDR');
    }
}
