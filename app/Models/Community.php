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
    protected $fillable = ['category', 'author', 'title', 'content', 'is_blind', 'is_delete', 'view_count', 'block_count', 'like_count', 'report_count'];


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

    /** 작성자 */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    /**
     * 이미지 가져오기
     */
    public function images()
    {
        return $this->hasMany(Images::class, 'target_id', 'id')
            ->where('target_type', '=', Community::class . '\main');
    }
    /**
     * 이미지 가져오기
     */
    public function images_detail()
    {
        return $this->hasMany(Images::class, 'target_id', 'id')
            ->where('target_type', '=', Community::class . '\detail');
    }

    /**
     * 댓글
     */
    public function replys()
    {
        return $this->hasMany(Reply::class, 'target_id', 'id')
            ->where('target_type', Community::class)
            ->where('is_delete', '0');
    }
}
