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
        'pnu',
        'polygon_coordinates',
        'characteristics_json',
        'useWFS_json',
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

    /**
     * 조감도 파일
     */
    public function birdSEyeView_files()
    {
        return $this->hasMany(Files::class, 'target_id', 'id')
            ->where('target_type', 'birdSEyeView');;
    }
    /**
     * 특장점 파일
     */
    public function features_files()
    {
        return $this->hasMany(Files::class, 'target_id', 'id')
            ->where('target_type', 'features');;
    }
    /**
     * 층별도면 파일
     */
    public function floorPlan_files()
    {
        return $this->hasMany(Files::class, 'target_id', 'id')
            ->where('target_type', 'floorPlan');
    }

    /**
     * 표지부 데이터
     */
    public function BrTitleInfo()
    {
        return $this->morphOne(BrTitleInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrRecapTitleInfo()
    {
        return $this->morphOne(BrRecapTitleInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrFlrOulnInfo()
    {
        return $this->morphOne(BrFlrOulnInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrExposInfo()
    {
        return $this->morphOne(BrExposInfo::class, 'target');
    }

    /**
     * 표지부 데이터
     */
    public function BrExposPubuseAreaInfo()
    {
        return $this->morphOne(BrExposPubuseAreaInfo::class, 'target');
    }
}
