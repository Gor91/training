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
}
