<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    protected $table = 'identification_types';
    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];

    public function victims()
    {
        return $this->hasMany(Victim::class,'identification_type_id','id');
    }
}
