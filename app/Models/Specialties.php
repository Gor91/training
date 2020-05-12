<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
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
}
