<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Zcode extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'zcode';

    /**
     * 모델
     */
    protected $fillable = ['region_code', 'zone'];

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
}
