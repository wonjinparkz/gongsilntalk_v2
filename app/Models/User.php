<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'provider',
        'email',
        'password',
        'token',
        'state',
        'name',
        'nickname',
        'phone',
        'gender',
        'birth',
        'unique_key',
        'leave_reason',
        'leaved_at',
        'device_type',
        'fcm_key',
        'is_alarm',
        'last_used_at',
    ];

    protected $hidden = [
        'password',
        'device_type',
        'unique_key',
    ];

    protected $casts = [
        'phone' => 'encrypted',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * 사용자 팔로우
     */
    public function user_follow()
    {
        return $this->hasMany(UsersFollows::class, 'users_id', 'id')->with('following')->whereHas('following', function ($query) {
            $query->where('state', 0);
        });
    }

    /**
     * 사용자 팔료잉
     */
    public function user_following()
    {
        return $this->hasMany(UsersFollows::class, 'follow_id', 'id')->with('following')->whereHas('following', function ($query) {
            $query->where('state', 0);
        });
    }

    /**
     * 사용자 차단
     */
    public function block() {
        return $this->hasOne(UsersBlocks::class, 'block_id', 'id');
    }
}
