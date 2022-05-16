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
class TypeMemory extends Model
{
    use SoftDeletes;
    protected $table = 'type_memory';
    const TypeRAM = 0;
    const TypeHDD = 1;

    protected $fillable
        = [
            'title',
            'type_memory',
        ];
    public function getTypeMemory(){
        $result = TypeMemory::select('id' , 'title' , 'type_memory')->get();;
        return $result;
    }
    public function memory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Memory::class);
    }
}
