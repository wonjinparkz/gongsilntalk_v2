<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * 매물 상세
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->select('product.*')
            ->leftJoin('like', function ($like) {
                $like->on('product.id', '=', 'like.target_id')
                    ->where('like.users_id', '=', Auth::guard('web')->user()->id ?? 0)
                    ->where('like.target_type', '=', 'product');
            })->addSelect(
                DB::raw('ifnull(like.id, "") AS like_id')
            )->where('is_delete', 0);
    }
    /**
     * 이미지 가져오기
     */
    public function images()
    {
        return $this->morphOne(Images::class, 'target');
    }
}
