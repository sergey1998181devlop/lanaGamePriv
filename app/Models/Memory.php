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
class Memory extends Model
{
    use SoftDeletes;
    protected $table = 'memory';

    protected $fillable
        = [
            'title',
        ];
    public function getMemory(){
        $result = $this->select('id' , 'title')->get();
        return $result;
    }
    public function typeMemory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TypeMenory::class );
    }

}
