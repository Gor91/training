<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'type_id',
        'name',
        'icon'
    ];
    public function prof()
    {
        return $this->hasOne('App\Models\Profession');
    }
    public function parent()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function specialty()
    {
        return $this->belongsToMany(self::class, 'parent_id');
    }
}
