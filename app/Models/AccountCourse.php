<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountCourse extends Model
{

    use Notifiable;
    protected $table = 'accounts_courses';

    protected $fillable = [
        'id', 'course_id', 'account_id', 'count	', 'status', 'percent', 'rating','comment','panding'
    ];
}
