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
        'identification_type',
        'country_id',
        'city_id',
        'address'
    ];
    protected $dates = ['created_at','updated_at'];
}
