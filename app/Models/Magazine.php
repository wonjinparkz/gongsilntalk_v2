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
        'magazine_category_id',
        'admins_id',
        'title',
        'content',
        'view_count',
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
}
