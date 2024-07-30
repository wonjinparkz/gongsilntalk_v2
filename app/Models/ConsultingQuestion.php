<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ConsultingQuestion extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'consulting_question';

    /**
     * 모델
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'content',
        'state',
        'is_delete'
    ];


    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [];

    /**
     * 캐스팅
     */
    protected $casts = [
        'phone' => 'encrypted',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
