<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Community extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'community';

    /**
     * 모델
     */
    protected $fillable = ['category_id', 'author', 'title', 'content', 'state', 'delete', 'view_count', 'block_count', 'like_count', 'report_count'];


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

    /**
     * 이미지 가져오기
     */
    public function images()
    {
        return $this->morphMany(Images::class, 'target');
    }
}
