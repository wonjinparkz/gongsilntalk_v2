<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Popups extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'popups';

    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'title',
        'content',
        'type',
        'is_blind',
        'started_at',
        'ended_at'
    ];


    /**
     * Hidden
     */
    protected $hidden = [
        'author',
    ];

    /**
     * Cast
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',

        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

}
