<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class SiteProductSchedule extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'site_product_schedule';

    /**
     * Fillable
     */
    protected $fillable = [
        'site_product_id',
        'title',
        'start_date',
        'ended_date',
        'is_ended'
    ];

    /**
     * Hidden
     */
    protected $hidden = [
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
