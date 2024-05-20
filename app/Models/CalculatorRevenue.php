<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CalculatorRevenue extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'calculator_revenue';

    /**
     * 모델
     */
    protected $fillable = [
        'users_id',
        'sale_price',
        'acquisition_tax',
        'tax_price',
        'commission',
        'etc_price',
        'price',
        'month_price',
        'loan_ratio',
        'loan_interest',
    ];

    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [];

    /**
     * 캐스팅
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
