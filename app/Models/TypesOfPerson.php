<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypesOfPerson extends Model
{
    protected $fillable = [
        'name',
        'description',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/types-of-people/'.$this->getKey());
    }
}
