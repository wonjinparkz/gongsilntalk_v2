<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Qa extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'qas';

    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'title',
        'content',
        'category',
        'reply_content',
        'reply_date',
        'is_reply'
    ];


    /**
     * Hidden
     */
    protected $hidden = [

    ];

    /**
     * Cast
     */
    protected $casts = [
        'reply_date' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 사용자 정보
     */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
