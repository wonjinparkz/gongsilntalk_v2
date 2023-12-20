<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Terms extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'terms';

    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'title',
        'content',
        'kind',
        'type'
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'admins_id'
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
