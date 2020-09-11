<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountVideo extends Model
{
    protected $table = 'accounts_videos';

    protected $fillable = [
        'id', 'video_id', 'account_id', 'point', 'status'
    ];
}
