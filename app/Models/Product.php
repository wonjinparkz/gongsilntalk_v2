<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'product';

    /**
     * Fillable
     */
    protected $fillable = [
        'product_number',
        'users_id',
        'user_type',
        'state',
        'type',
        'is_map',
        'address_lat',
        'address_lng',
        'region_code',
        'region_address',
        'address',
        'address_detail',
        'address_dong',
        'address_number',
        'floor_number',
        'total_floor_number',
        'area',
        'square',
        'exclusive_area',
        'exclusive_square',
        'total_floor_area',
        'total_floor_square',
        'approve_date',
        'building_type',
        'move_type',
        'move_date',
        'is_service',
        'service_price',
        'loan_type',
        'loan_price',
        'parking_type',
        'parking_price',
        'comments',
        'contents',
        'image_link',
        'update_user_type',
        'commission',
        'commission_rate',
        'non_memo',
        'is_blind',
        'is_delete',
        'expires_at'
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

    /**
     * 사용자 정보
     */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id')->with('product','images');
    }

    /**
     * 매물 가격 정보
     */
    public function priceInfo()
    {
        return $this->hasOne(ProductPrice::class, 'product_id', 'id');
    }
    /**
     * 매물 추가 정보
     */
    public function productAddInfo()
    {
        return $this->hasOne(ProductAddInfo::class, 'product_id', 'id');
    }
    /**
     * 매물 옵션 정보
     */
    public function productOptions()
    {
        return $this->hasMany(ProductOptions::class, 'product_id', 'id');
    }
    /**
     * 매물 관리비 항목
     */
    public function productServices()
    {
        return $this->hasMany(ProductServices::class, 'product_id', 'id');
    }
}
