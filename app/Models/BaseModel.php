<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;

class BaseModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * JSON 으로 만들 때 날짜 형식
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * 날짜 범위 검색
     */
    public function scopeDurationDate($query, $column, $from_date, $to_date)
    {
        return $query
            ->whereDate($column, '>=', date($from_date))
            ->whereDate($column, '<=', date($to_date));
    }


    /**
     * Report 테이블 조인
     */
    public function scopeReport($query, $on, $class, $id)
    {
        Log::info($on);
        // 신고 ID
        $query->leftJoin('community_report', function ($report) use ($on, $class, $id) {
            $report->on($on . '.id', '=', 'community_report.target_id')
                ->where('community_report.users_id', '=', $id)
                ->where('community_report.target_type', '=', $class);
        });

        $query->addSelect(
            'community_report.id AS report_id'
        );
    }

    /**
     * Like 테이블 조인
     */
    public function scopeLike($query, $on, $class, $id)
    {
        // 좋아요
        $query->leftJoin('like', function ($like) use ($on, $class, $id) {
            $like->on($on . '.id', '=', 'like.target_id')
                ->where('like.users_id', '=', $id)
                ->where('like.target_type', '=', $class);
        });
        $query->addSelect(
            'like.id AS like_id'
        );
    }

    /**
     * Block 테이블 조인
     */
    public function scopeBlock($query, $on, $id)
    {
        //  차단 ID
        $query->leftJoin('community_block', function ($block)  use ($on, $id) {
            $block->on($on . '.id', '=', 'community_block.community_id')
                ->where('community_block.users_id', '=', $id);
        });

        $query->addSelect(
            'community_block.id AS block_id'
        );
    }


    /**
     * 이미지 가져오기
     */
    public function images()
    {
        return $this->morphMany(Images::class, 'target');
    }
}
