<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CorpProduct extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'corp_product';


    /**
     * Fillable
     */
    protected $fillable = [
        'corp_proposal_id',
        'corp_product_address_id',
        'product_type',
        'type',
        'address_lat',
        'address_lng',
        'address',
        'address_detail',
        'product_name',
        'exclusive_area',
        'exclusive_square',
        'floor_number',
        'total_floor_number',
        'move_type',
        'move_date',
        'is_service',
        'service_price',
        'heating_type',
        'parking_count',
        'product_content',
        'content',
        'is_delete'
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
     * 기업 매물 리스트
     */
    public function price()
    {
        return $this->hasOne(CorpProductPrice::class, 'corp_product_id', 'id');
    }
    /**
     * 기업 매물 리스트
     */
    public function facility()
    {
        return $this->hasMany(CorpProductFacility::class, 'corp_product_id', 'id');
    }

    /**
     * 건물 외관 이미지
     */
    public function main_images()
    {
        return $this->morphOne(Images::class, 'target')->where('type', 0);
    }

    /**
     * 건물 내부 이미지
     */
    public function detail_images()
    {
        return $this->morphMany(Images::class, 'target')->where('type', 1);
    }
}
