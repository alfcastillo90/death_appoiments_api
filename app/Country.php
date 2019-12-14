<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name'];
    protected $dates = ['created_at','updated_at'];

    public function cities()
    {
        return $this->hasMany(City::class,'country_id','id');
    }

}
