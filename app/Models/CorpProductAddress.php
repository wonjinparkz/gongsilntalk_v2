<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CorpProductAddress extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'corp_product_address';


    /**
     * Fillable
     */
    protected $fillable = [
        'users_id',
        'city',
        'corp_proposal_id'
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
     * 기업 매물 리스트
     */
    public function products()
    {
        return $this->hasMany(CorpProduct::class, 'corp_product_address_id', 'id')
            ->where('is_delete', 0);
    }

    /**
     * 기업 매물 리스트
     */
    public function proposal()
    {
        return $this->hasOne(CorpProposal::class, 'id', 'corp_proposal_id');
    }
}
