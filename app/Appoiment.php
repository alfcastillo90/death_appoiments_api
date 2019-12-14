<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appoiment extends Model
{
    protected $table = 'appoiments';
    protected $fillable = ['victim_id','is_dead'];
    protected $dates = ['appointed_at','created_at','updated_at'];
}
