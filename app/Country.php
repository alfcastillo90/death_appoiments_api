<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Country
 *
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\City[] $cities
 * @property-read int|null $cities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Victim[] $victims
 * @property-read int|null $victims_count
 *
 *
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name'];
    protected $dates = ['created_at','updated_at'];

    public function cities()
    {
        return $this->hasMany(City::class,'country_id','id');
    }

    public function victims()
    {
        return $this->hasMany(Victim::class,'country_of_birth_id','id');
    }
}
