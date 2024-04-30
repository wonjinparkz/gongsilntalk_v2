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
        'is_blind',
        'is_delete',
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
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
