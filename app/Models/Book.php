<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'path'
    ];

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => 'required|unique:books|string|min:2|max:190',
            'book' => 'required|file|mimes:pdf'
        ];
    }
}
