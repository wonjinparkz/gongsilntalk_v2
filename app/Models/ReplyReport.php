<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ReplyReport extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'reply_report';

    /**
     * 모델
     */
    protected $fillable = ['users_id', 'reply_id', 'type', 'reason'];


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
     * 커뮤니티
     */
    public function reply()
    {
        return $this->hasOne(Reply::class, 'id', 'reply_id');
    }
}
