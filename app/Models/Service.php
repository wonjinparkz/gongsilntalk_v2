<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Service extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'service';


    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'order',
        'type',
        'name',
        'title',
        'content',
        'url',
        'is_blind',
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'admins_id',
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
