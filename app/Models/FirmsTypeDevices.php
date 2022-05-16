<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FirmsTypeDevices extends Pivot
{
    protected $table = 'firms_type_devices';
    public function typeDevices()
    {
        return $this->belongsTo(TypeDevices::class);
    }

    public function modal()
    {
        return $this->belongsTo(Models::class);
    }

    public function modelsItems()
    {
        return $this->hasManyThrough(Models::class, Firms::class);
    }
}
