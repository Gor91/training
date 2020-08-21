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
    public function course()
    {
        return $this->hasOne('App\Models\Courses');
    }

    //tdo stugel ogg e
    public function parent()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function specialty()
    {
        return $this->hasMany(self::class, 'parent_id','id' );
    }
    public function type()
    {
        return $this->belongsTo(SpecialtiesType::class, 'type_id');
    }

}
