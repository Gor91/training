<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Courses extends Model
{

    use Notifiable;

    protected $fillable = [
        'id', 'name', 'specialty_ids', 'status', 'duration_date', 'credit', 'credit_type', 'content',
    ];

    /**
     * @return array
     */
    public static function getCreditType()
    {
        return [
            'economic' => 'Տնտեսական',
            'practical' => 'Գործնական',
            'unknown' => 'Անորոշ'
        ];
    }

    /**
     * @return array
     */
    public static function getStatus()
    {
        return [
            'active' => __('messages.course_status_active'),
            'delete' => __('messages.course_status_delete'),
            'archive' => __('messages.course_status_archive')
        ];
    }
}
