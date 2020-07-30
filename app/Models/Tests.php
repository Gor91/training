<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Tests extends Model
{
    use Notifiable;


    protected $fillable = [
        'id', 'courses_id', 'question', 'answers', 'question_paths', 'answers_icons_paths', 'created_at','updated_at',
    ];

    public function courses()
    {
        return $this->belongsTo('App\Models\Courses','courses_id');
    }
}
