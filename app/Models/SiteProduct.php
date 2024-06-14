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
        'matterport_link',
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

    /**
     * 3D이미지 파일 가져오기
     */
    public function files()
    {
        return $this->morphMany(Files::class, 'target');
    }

    /**
     * 동 정보 가져오기
     */
    public function dongInfo()
    {
        return $this->hasMany(SiteProductDong::class, 'site_product_id', 'id');
    }

    /**
     * 프리미엄 정보 가져오기
     */
    public function premiumInfo()
    {
        return $this->hasOne(SiteProductPremium::class, 'site_product_id', 'id');
    }

    /**
     * 분양 일정 정보 가져오기
     */
    public function scheduleInfo()
    {
        return $this->hasMany(SiteProductSchedule::class, 'site_product_id', 'id')->orderBy('start_date', 'asc');
    }

    /**
     * 교육자료 이미지 가져오기
     */
    public function edu_images()
    {
        return $this->morphMany(Images::class, 'target')->where('type', '1');
    }
}
