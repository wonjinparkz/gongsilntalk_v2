<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class SiteProductPremium extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'site_proudct_premium';

    /**
     * Fillable
     */
    protected $fillable = [
        'site_product_id',
        'title_1',
        'title_2',
        'title_3',
        'title_4',
        'title_5',
        'title_6',
        'contents_1',
        'contents_2',
        'contents_3',
        'contents_4',
        'contents_5',
        'contents_6',
        'is_blind_1',
        'is_blind_2',
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
