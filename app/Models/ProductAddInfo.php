<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductAddInfo extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'product_add_info';

    /**
     * Fillable
     */
    protected $fillable = [
        'product_id',
        'direction_type',
        'cooling_type',
        'heating_type',
        'weight',
        'is_elevator',
        'is_dock',
        'is_hoist',
        'is_goods_elevator',
        'interior_type',
        'floor_height_type',
        'wattage_type',
        'current_business_type',
        'recommend_business_type',
        'land_use_type',
        'city_plan_type',
        'building_permit_type',
        'land_permit_type',
        'access_load_type',
        'room_count',
        'bathroom_count',
        'structure_type',
        'builtin_type',
        'declare_type',
        'is_option',
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
