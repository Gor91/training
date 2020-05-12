<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'father_name',
        'gender',
        'bday',
        'married_status',
        'phone',
        'passport',
        'date_of_issue',
        'date_of_expiry',
        'work_address',
        'workplace_name',
        'image_name',
    ];
}
