<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Appointment
 *
 * @property int $id
 * @property int $victim_id
 * @property int $is_dead
 * @property \Illuminate\Support\Carbon $appointed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 *
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class Appointment extends Model
{
    protected $table = 'appointments';
    protected $fillable = ['victim_id','appointed_at'];
    protected $dates = ['created_at','updated_at'];

    public function victim()
    {
        return $this->belongsTo(Victim::class,'victim_id','id');
    }

}
