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
class Models extends Model
{
    use SoftDeletes;

    const TypeCPU = 0;
    const TypeVIDEOCARD = 1;

    protected $fillable
        = [
            'title',
            'firms_id',
            'type_model'
        ];
    //принадлежит фирме
    public function firm(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Firms::class);
    }
}
