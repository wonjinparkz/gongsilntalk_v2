<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductPrice extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'product_price';

    /**
     * Fillable
     */
    protected $fillable = [
        'product_id',
        'payment_type',
        'price',
        'month_price',
        'is_price_discussion',
        'is_use',
        'current_price',
        'current_month_price',
        'is_premium',
        'premium_price',
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
