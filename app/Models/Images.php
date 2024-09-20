<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Images extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'images';

    /**
     * 모델
     */
    protected $fillable = ['path', 'width', 'height', 'order'];


    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [

    ];

    /**
     * 캐스팅
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    // 다형성 함수
    public function target()
    {
        return $this->morphTo();
    }
}
