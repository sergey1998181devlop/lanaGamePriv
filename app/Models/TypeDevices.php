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
class TypeDevices extends Model
{
    use SoftDeletes;


    protected $fillable
        = [
            'title_device',
            'slug',
        ];



    public function getTypeDevicesFirms()
    {
        $result = $this->with('firms:id,title,slug')->get();
//        $result = $this->models()->get();
        return $result;
    }


    public function firms()
    {
        return $this->belongsToMany(Firms::class);

    }


    /**
     * Get all of the attachments for the applicant.
     */
    public function models()
    {
        return $this->hasManyThrough(
            Firms::class,
            Models::class,
                    'id',
            'id'
        );
    }
}
