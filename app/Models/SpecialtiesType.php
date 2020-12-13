<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialtiesType extends Model
{
    const DOCTOR = 1;

    const NURSE = 2;

    const PHARMACIST = 3;

    const DISPENSER = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'icon'
    ];
}
