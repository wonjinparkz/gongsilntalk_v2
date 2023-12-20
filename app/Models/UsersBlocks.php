<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class UsersBlocks extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'users_blocks';

    /**
     * 모델
     */
    protected $fillable = [
        'users_id',
        'block_id'
    ];


    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [
        'password'
    ];

    /**
     * 캐스팅
     */
    protected $casts = [
        'id' => 'integer',
        'users_id' => 'integer',
        'block_id' => 'integer',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 사용자 정보
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'block_id')->with('images');
    }
}
