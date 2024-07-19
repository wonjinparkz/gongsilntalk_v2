<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class InteriorEstimate extends BaseModel
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'area',
        'users_count',
        'place',
        'move_date',
        'company_name',
        'company_phone',
        'user_name'
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'company_phone' => 'encrypted',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
