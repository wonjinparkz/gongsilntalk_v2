<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'admin_id',
        'name',
        'password',
        'phone',
        'state'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'update_at' => 'datetime',
        'create_at' => 'datetime',
        'phone' => 'encrypted',
    ];
}
