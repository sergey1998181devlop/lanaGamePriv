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
class MonitorHertz extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'title',
        ];
    protected $table = 'monitor_hertz';
    public function getMonitorHertz(){
        $result = $this->select('id' , 'title')->get();
        return $result;
    }
}
