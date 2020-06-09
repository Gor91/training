<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Courses extends Model
{

    use Notifiable;


    protected $fillable = [
        'id', 'name', 'specialty_ids', 'status', 'duration_date', 'credit', 'content',
    ];
}
