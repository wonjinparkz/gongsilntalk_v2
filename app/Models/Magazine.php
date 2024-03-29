<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Magazine extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'magazine';

    /**
     * Fillable
     */
    protected $fillable = [
        'admins_id',
        'type',
        'title',
        'url',
        'content',
        'view_count',
        'like_count',
        'is_blind',
    ];


    /**
     * Hidden
     */
    protected $hidden = [];

    /**
     * Cast
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 매거진 카테고리
     */
    public function category()
    {
        return $this->hasOne(MagazineCategory::class, 'id', 'magazine_category_id');
    }

    /**
     * 매거진 차단
     */
    public function block()
    {
        return $this->hasOne(MagazineBlock::class, 'magazine_id', 'id');
    }

    /**
     * 매거진 스크랩
     */
    public function scrap()
    {
        return $this->hasOne(MagazineScrap::class, 'magazine_id', 'id');
    }

    /**
     * 댓글
     */
    public function replys()
    {
        return $this->hasMany(Reply::class, 'target_id', 'id')
            ->where('target_type', Magazine::class)
            ->where('is_delete', '0');
    }
}
