<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePersonHasPerson extends Model
{
    protected $table = 'type_person_has_person';

    protected $fillable = [
        'id_person',
        'id_type_of_people',
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/type-person-has-people/'.$this->getKey());
    }
}
