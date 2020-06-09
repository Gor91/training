<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends Model implements JWTSubject
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

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function prof()
    {
        return $this->hasOne('App\Models\Profession');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
//

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

