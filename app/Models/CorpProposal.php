<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CorpProposal extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'corp_proposal';

    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'title',
        'corp_name',
        'position',
        'is_delete'
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
     * 사용자 정보
     */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * 기업 매물 리스트
     */
    public function products()
    {
        return $this->hasMany(CorpProduct::class, 'corp_proposal_id', 'id')
        ->where('is_delete', 0);
    }
}
