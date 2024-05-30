<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Asset extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'asset';

    /**
     * 모델
     */
    protected $fillable =
    [
        'asset_address_id',
        'type',
        'type_detail',
        'address_dong',
        'address_detail',
        'area',
        'square',
        'exclusive_area',
        'exclusive_square',
        'total_floor_area',
        'total_floor_square',
        'name_type',
        'business_type',
        'tran_type',
        'price',
        'contracted_at',
        'registered_at',
        'acquisition_tax_rate',
        'etc_price',
        'tax_price',
        'estate_price',
        'loan_price',
        'loan_rate',
        'loan_period',
        'loaned_at',
        'loan_type',
        'is_vacancy',
        'tenant_name',
        'tenant_phone',
        'pay_type',
        'check_price',
        'month_price',
        'deposit_day',
        'started_at',
        'ended_at'
    ];


    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [];

    /**
     * 캐스팅
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'contracted_at' => 'datetime',
        'registered_at' => 'datetime',
        'loaned_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime'
    ];

    /**
     * 자산 주소
     */
    public function asset_address()
    {
        return $this->hasOne(AssetAddress::class, 'id', 'asset_address_id');
    }

    /**
     * 매매 계약서 이미지 가져오기
     */
    public function sale_images()
    {
        return $this->morphOne(Images::class, 'target')->where('type', 0);
    }
    /**
     * 사업자등록증 이미지 가져오기
     */
    public function entre_images()
    {
        return $this->morphOne(Images::class, 'target')->where('type', 1);
    }
    /**
     * 임대차 계약서 이미지 가져오기
     */
    public function rental_images()
    {
        return $this->morphOne(Images::class, 'target')->where('type', 2);
    }
    /**
     * 기타서류 이미지 가져오기
     */
    public function etc_images()
    {
        return $this->morphOne(Images::class, 'target')->where('type', 3);
    }
}
