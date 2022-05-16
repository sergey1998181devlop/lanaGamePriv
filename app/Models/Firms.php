<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @package App\Models
 *
 * $property-read BlogCategory $parentCategory
 * @parenty-read string $parentTitle
 */
class Firms extends Model
{

    use SoftDeletes;


    protected $fillable
        = [
            'id',
            'title',
            'slug',
        ];

    public function typeDevices()
    {
        return $this->belongsToMany(TypeDevices::class);

    }
    public function models()
    {
        return $this->hasMany(Models::class);
    }
}
