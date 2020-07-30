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
       'account_id', 'subject','message','created_by'
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class,
            'created_by','id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class,
            'account_id','id');
    }
}
