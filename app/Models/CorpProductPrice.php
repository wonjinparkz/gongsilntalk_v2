<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CorpProductPrice extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'corp_product_price';


    /**
     * Fillable
     */
    protected $fillable = [
        'corp_product_id',
        'payment_type',
        'price',
        'month_price',
        'premium_price',
        'acquisition_tax',
        'support_price',
        'etc_price',
        'loan_rate_one',
        'loan_rate_two',
        'loan_interest',
        'is_invest',
        'invest_price',
        'invest_month_price',
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
