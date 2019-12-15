<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\IdentificationType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Victim[] $victims
 * @property-read int|null $victims_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IdentificationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
