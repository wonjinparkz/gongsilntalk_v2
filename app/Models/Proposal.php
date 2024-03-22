<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proposal extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'proposal';


    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'type',
        'area',
        'square',
        'business_type',
        'move_type',
        'users_count',
        'start_move_date',
        'ended_move_date',
        'payment_type',
        'price',
        'month_price',
        'client_name',
        'interior_type',
        'contents',
        'is_delete'
    ];

    /**
     * Hidden
     */
    protected $hidden = [
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
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
