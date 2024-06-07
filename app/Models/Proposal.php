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
        'title',
        'type',
        'area',
        'square',
        'business_type',
        'move_type',
        'users_count',
        'start_move_date',
        'ended_move_date',
        'payment_type',
        'floor_type',
        'price',
        'month_price',
        'client_name',
        'client_type',
        'interior_type',
        'content',
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
     * 사용자 정보
     */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * 제안서 선호 지역
     */
    public function regions()
    {
        return $this->hasMany(ProposalRegion::class, 'proposal_id', 'id');
    }

    /**
     * 제안 받은 매물
     */
    public function products()
    {
        return $this->hasMany(ProposalProduct::class, 'proposal_id', 'id');
    }
}
