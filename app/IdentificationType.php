<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    protected $table = 'identification_types';
    protected $fillable = ['name'];
    protected $dates = ['created_at','updated_at'];
}
