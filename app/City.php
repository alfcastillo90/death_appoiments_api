<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name','country_id'];
    protected $dates = ['created_at','updated_at'];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

}
