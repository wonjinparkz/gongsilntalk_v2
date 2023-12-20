<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MagazineCategory extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'magazine_category';

    /**
     * Fillable
     */
    protected $fillable = [
        'title',
        'order',
        'is_blind'
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
}
