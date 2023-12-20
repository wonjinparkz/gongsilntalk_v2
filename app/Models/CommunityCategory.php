<?php

namespace App\Models;

use DateTimeInterface;
use Defuse\Crypto\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommunityCategory extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'community_category';

    /**
     * 모델
     */
    protected $fillable = ['title', 'content', 'state'];


    /**
     * 직력화에서 감출것
     */
    protected $hidden = [
        'state'
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

    /**
     * 파일 가져오기
     */
    public function files()
    {
        return $this->morphMany(Files::class, 'target');
    }
}
