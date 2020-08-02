<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'specialty_id',
        'education_id',
        'profession',
        'member_of_palace',
        'diplomas'
    ];

    /**
     * Get the user that owns the account.
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    /**
     * Get the spec that owns the specialties.
     */
    public function spec()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

   }
