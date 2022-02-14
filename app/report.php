<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    public function ScopeWithoutSpam($query){
        $blocked_ips = [
            '54.39.29.64',
            '85.143.106.77',
            '185.193.52.180',
            '5.189.239.157',
            '176.196.199.19',
            '158.46.99.43',
            '146.70.52.14',
            '176.213.153.210',
            '178.69.61.117',
            '185.154.15.155',
            '91.122.80.236'
        ];
        return $query->where(function($query) use($blocked_ips) {
            $query->whereNotIn('REMOTE_ADDR',$blocked_ips)->OrWhereNull('REMOTE_ADDR');
        })->where('is_spam',0);
    }
}
