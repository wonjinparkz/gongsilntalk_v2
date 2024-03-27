<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ProposalProduct extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * Table Name
     */
    protected $table = 'proposal_product';


    /**
     * Fillable
     */
    protected $fillable = [
        'proposal_id',
        'product_id',
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
     * 이미지 가져오기
     */
    public function images()
    {
        return $this->morphOne(Images::class, 'target');
    }
}
