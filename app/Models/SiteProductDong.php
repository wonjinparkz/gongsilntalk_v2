<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class SiteProductDong extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'site_product_dong';

    /**
     * Fillable
     */
    protected $fillable = [
        'site_product_id',
        'dong_name'
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
     * 층 정보 가져오기
     */
    public function floorInfo()
    {
        return $this->hasMany(SiteProductFloorInfo::class, 'site_product_dong_id', 'id')->with('images');
    }
}
