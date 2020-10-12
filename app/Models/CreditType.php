<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditType extends Model
{
    protected $fillable = [
        'key', 'description', 'order'
    ];

    /**
     * @return array
     */
    public static function getCreditType()
    {
        return self::query()->orderBy('order')->get()->toArray();
    }
}
