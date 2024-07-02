<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssetAddress extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'asset_address';

    /**
     * 모델
     */
    protected $fillable =
    [
        'users_id',
        'is_temporary',
        'is_unregistered',
        'region_code',
        'address_lat',
        'address_lng',
        'region_address',
        'address',
        'old_address'
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
    ];


    /**
     * 등록한 유저
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * 상세 자산
     */
    public function asset()
    {
        return $this->hasMany(Asset::class, 'asset_address_id', 'id');
    }
}
