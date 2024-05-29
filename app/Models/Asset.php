<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Asset extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'asset';

    /**
     * 모델
     */
    protected $fillable =
    [
        'asset_address_id',
        'type',
        'type_detail',
        'address_dong',
        'address_detail',
        'area',
        'square',
        'exclusive_area',
        'exclusive_square',
        'total_floor_area',
        'total_floor_square',
        'name_type',
        'business_type',
        'price',
        'contracted_at',
        'registered_at',
        'acquisition_tax_rate',
        'etc_price',
        'tax_price',
        'estate_price',
        'loan_price',
        'loan_rate',
        'loan_period',
        'loaned_at',
        'loan_type',
        'is_vacancy',
        'tenant_name',
        'tenant_phone',
        'pay_type',
        'check_price',
        'month_price',
        'deposit_day',
        'started_at',
        'ended_at'
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
        'contracted_at' => 'datetime',
        'registered_at' => 'datetime',
        'loaned_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime'
    ];
}
