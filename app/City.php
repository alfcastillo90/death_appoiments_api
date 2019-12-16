<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\City
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Victim[] $victims
 * @property-read int|null $victims_count
 *
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name', 'country_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function victims()
    {
        return $this->hasMany(Victim::class,'city_of_residence_id','id');
    }

}
