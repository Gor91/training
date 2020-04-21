<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Email extends Authenticatable
{
    use Notifiable;
    protected $table = 'emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'resume_id', 'subject','message','created_by'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,
            'created_by','id');
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class,
            'resume_id','id');
    }
}
