<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'region_id', 'status',
    ];
    public function residence()
    {
        return $this->hasMany(self::class, 'region_id');
    }

    public function territory()
    {
        return $this->belongsTo(self::class, 'region_id');
    }
}
