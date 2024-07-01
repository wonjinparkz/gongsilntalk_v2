<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SiteProductAlarms extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'site_product_alarms';

    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'site_product_id',
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
