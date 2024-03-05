<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KnowledgeCenter extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'knowledge_center';


    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'address_lat',
        'address_lng',
        'address',
        'product_name',
        'subway_name',
        'subway_distance',
        'subway_time',
        'completion_date',
        'sale_min_price',
        'sale_mid_price',
        'sale_max_price',
        'lease_min_price',
        'lease_mid_price',
        'lease_max_price',
        'area',
        'square',
        'building_area',
        'building_square',
        'total_floor_area',
        'total_floor_square',
        'min_floor',
        'max_floor',
        'parking_count',
        'generation_count',
        'developer',
        'comstruction_company',
        'traffic_info',
        'site_contents',
        'comments',
        'bus_stop_contents',
        'facilities_contents',
        'education_contents',
        'is_blind',
        'is_delete'
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'admins_id'
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 관리자 정보
     */
    public function admins()
    {
        return $this->hasOne(Admin::class, 'id', 'admins_id');
    }
}
