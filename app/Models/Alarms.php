<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Alarms extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'alarms';

    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'index',
        'title',
        'body',
        'msg',
        'target_id',
        'tour_users_id',
        'readed_at'
    ];

    /**
     * Hidden
     */
    protected $hidden = [];

    /**
     * Cast
     */
    protected $casts = [
        'msg' => 'array',
        'readed_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 사용자 정보
     */
    public function tour_users()
    {
        return $this->hasOne(User::class, 'id', 'tour_users_id');
    }

    /**
     * 매물 정보
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    /**
     * 분양매물 정보
     */
    public function siteProduct()
    {
        return $this->hasOne(SiteProduct::class, 'id', 'target_id');
    }
}
