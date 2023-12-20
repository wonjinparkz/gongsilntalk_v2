<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Alarms extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'alarms';

    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'title',
        'body',
        'msg',
        'readed_at'
    ];

    /**
     * Hidden
     */
    protected $hidden = [];

    /**
     * Cast
     */
    protected $casts = [
        'msg' => 'array',
        'readed_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
