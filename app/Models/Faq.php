<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Faq extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'faqs';


    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'title',
        'content',
        'type',
        'is_blind'
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'admins_id'
    ];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 관리자 정보
     */
    public function admins()
    {
        return $this->hasOne(Admin::class, 'id', 'admins_id');
    }
}
