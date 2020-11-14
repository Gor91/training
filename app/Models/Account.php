<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends Model implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'father_name',
        'bday',
        'phone',
        'passport',
        'date_of_issue',
        'date_of_expiry',
        'home_address',
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

    public function course()
    {
        return $this->hasMany('App\Models\Courses');
    }
    public function account_course()
    {
        return $this->hasMany('App\Models\AccountCourse');
    }

    public function email()
    {
        return $this->hasMany(Email::class);
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

