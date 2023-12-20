<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CommunityReplyLike extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'community_reply_like';

    /**
     * 모델
     */
    protected $fillable = ['user_id', 'reply_id'];

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
