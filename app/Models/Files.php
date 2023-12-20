<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Files extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'files';

    /**
     * 모델
     */
    protected $fillable = ['path', 'name'];


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

    // 다형성 함수
    public function target()
    {
        return $this->morphTo();
    }
}
