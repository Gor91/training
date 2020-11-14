<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AccountCourse extends Model
{

    use Notifiable;
    protected $table = 'accounts_courses';

    protected $fillable = [
        'id', 'course_id', 'account_id', 'count', 'status', 'percent','test', 'rating','comment','panding'
    ];
    public function course()
    {
        return $this->belongsTo('App\Models\Courses');
    }
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }
}
