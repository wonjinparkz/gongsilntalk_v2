<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MagazineScrap extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'magazine_scrap';

    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'magazine_id',
    ];


    /**
     * Hidden
     */
    protected $hidden = [];

    /**
     * Cast
     */
    protected $casts = [
        'magazine_id' => 'integer',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 매거진 정보
     */
    public function magazine()
    {
        return $this->hasMany(Magazine::class, 'id', 'magazine_id')->with(['images', 'category']);
    }
}
