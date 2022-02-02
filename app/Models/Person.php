<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
        'firt_name',
        'last_name',
        'identification',
        'email',
        'telephone',
        'address',
        'birthday',
        'gender',
        'id_cities',
        // 'specialties',
        // 'typesOfPeople'
    ];
    
    
    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/people/'.$this->getKey());
    }

    public function city() {
        return $this->belongsTo(City::class, 'id_cities');
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class,'specialists', 'id_person', 'id_specialities');
    }

    public function typeOfPeople()
    {
        return $this->belongsToMany(TypesOfPerson::class, 'type_person_has_person','id_person','id_type_of_people');
    }
}
