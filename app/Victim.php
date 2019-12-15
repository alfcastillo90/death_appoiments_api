<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    protected $table = 'victims';
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'identity_number',
        'identification_type_id',
        'country_of_birth_id',
        'city_of_residence_id',
        'address'
    ];
    protected $dates = ['created_at','updated_at'];

    public function appoiments()
    {
        return $this->hasMany(Appoiment::class,'victim_id','id');
    }

    public function city_of_residence()
    {
        return $this->belongsTo(City::class,'city_of_residence_id','id');
    }
    //Nationality
    public function country_of_birth()
    {
        return $this->belongsTo(Country::class,'country_of_birth_id','id');
    }

    public function identification_type()
    {
        return $this->belongsTo(IdentificationType::class,'identification_type_id','id');
    }

}
