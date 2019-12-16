<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Victim
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property int $identity_number
 * @property int $identification_type_id
 * @property int $country_of_birth_id
 * @property int $city_of_residence_id
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Appointment[] $appoiments
 * @property-read int|null $appoiments_count
 * @property-read \App\City $city_of_residence
 * @property-read \App\Country $country_of_birth
 * @property-read \App\IdentificationType $identification_type
 *
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */

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
        'address',
        'telephone'
    ];
    protected $dates = ['created_at','updated_at'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class,'victim_id','id');
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
