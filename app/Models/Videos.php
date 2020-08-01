<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $fillable = [
        'title',
        'path',
        'duration',
        'lectures_id'
    ];

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => 'required|unique:videos|string|min:2|max:190',
            'path' => 'required|unique:videos|string|min:2|max:190',
            'video' => 'required|mimes:mp4',
            'duration' => 'nullable|numeric',
            'lecture' => 'required|exists:accounts,id',
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lectures()
    {
        return $this->belongsTo('App\Models\Account', 'lectures_id');
    }
}
