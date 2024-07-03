<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subway extends BaseModel
{
    use HasFactory, Notifiable;


    /**
     * Table Name
     */
    protected $table = 'subway';

    /**
     * Fillable
     */
    protected $fillable = [
        'subway_name',
        'subway_zone',
        'x',
        'y',
        'line',
    ];

    /**
     * Hidden
     */
    protected $hidden = [];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
