<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class SiteProduct extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'site_product';

    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'region_type',
        'address_lat',
        'address_lng',
        'region_code',
        'region_address',
        'address',
        'product_name',
        'title',
        'contents',
        'min_floor',
        'max_floor',
        'dong_count',
        'parking_count',
        'generation_count',
        'comments',
        'area',
        'square',
        'building_area',
        'building_square',
        'total_floor_area',
        'total_floor_square',
        'floor_area_ratio',
        'builging_ratio',
        'completion_date',
        'expected_move_date',
        'developer',
        'comstruction_company',
        'is_sale',
        'is_delete',
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'author' // 운영자 아이디
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
