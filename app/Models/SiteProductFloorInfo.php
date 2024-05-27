<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class SiteProductFloorInfo extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'site_product_floor_info';

    /**
     * Fillable
     */
    protected $fillable = [
        'site_product_dong_id',
        'floor_name',
        'is_neighborhood_life',
        'is_industry_center',
        'is_warehouse',
        'is_dormitory',
        'is_business_support',
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
     * 도면 가져오기
     */
    public function images()
    {
        return $this->morphOne(Images::class, 'target');
    }
}
