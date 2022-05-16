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
class InternetSpeedLists extends Model
{

    use SoftDeletes;

    protected $fillable
        = [
            'id',
            'title',
        ];
    public function getInternetSpeeds(){
        $result = $this->select('id' , 'title')->get();
        return $result;
    }
}
