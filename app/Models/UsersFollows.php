<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class UsersFollows extends BaseModel
{
    use HasFactory, Notifiable;


    protected $table = 'users_follows';

    protected $fillable = [
        'users_id',
        'follow_id'
    ];

    protected $hidden = [];

    protected $casts = [
        'users_id' => 'integer',
        'follow_id' => 'integer',
        'phone' => 'encrypted',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 사용자 정보 - 팔로잉
     */
    public function following()
    {
        return $this->hasOne(User::class, 'id', 'follow_id')->with('images');
    }

    /**
     * 사용자 정보 - 팔로워
     */
    public function follower()
    {
        return $this->hasOne(User::class, 'id', 'users_id')->with('images');
    }
}
