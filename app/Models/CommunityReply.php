<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class CommunityReply extends BaseModel
{
    use HasFactory, Notifiable;

    /**
     * 테이블 명
     */
    protected $table = 'community_reply';

    /**
     * 모델
     */
    protected $fillable = ['community_id', 'author', 'parent_id', 'depth', 'content', 'block_count', 'like_count', 'report_count', 'state', 'delete'];


    /**
     * 직렬화에서 감출것
     */
    protected $hidden = [];

    /**
     * 캐스팅
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * 대댓글을 위한 쿼리
     */
    public function child()
    {
        $child = $this->hasMany(CommunityReply::class, 'parent_id', 'id');
        $child->select(
            'community_reply.*',
            'users.name AS author_name',
            'community_reply_like.id AS like_id',
            'community_reply_report.id AS report_id',
            'community_reply_block.id AS block_id',
        );
        $child->join('users', 'community_reply.author', '=', 'users.id');

        if (Auth::guard('api')->user() != null) {
            $child->leftJoin('community_reply_like', function ($like) {
                $like->on('community_reply.id', '=', 'community_reply_like.reply_id')
                    ->where('community_reply_like.user_id', '=', Auth::guard('api')->user()->id);
            });
            $child->leftJoin('community_reply_report', function ($report) {
                $report->on('community_reply.id', '=', 'community_reply_report.reply_id')
                    ->where('community_reply_report.user_id', '=', Auth::guard('api')->user()->id);
            });
            $child->leftJoin('community_reply_block', function ($block) {
                $block->on('community_reply.id', '=', 'community_reply_block.reply_id')
                    ->where('community_reply_block.user_id', '=', Auth::guard('api')->user()->id);
            });
        }

        $child->orderBy('community_reply.created_at', 'asc')->orderBy('id', 'asc');

        return $child;
    }

    /**
     * 대댓글을 위한 쿼리
     */
    public function children()
    {
        return $this->child()->with('children');
    }


     /**
     * 대댓글을 위한 쿼리
     */
    public function rereply()
    {
        $child = $this->hasMany(CommunityReply::class, 'parent_id', 'id');
        $child->select(
            'community_reply.*',
            'users.name AS author_name',
        );
        $child->join('users', 'community_reply.author', '=', 'users.id');
        $child->orderBy('community_reply.created_at', 'asc')->orderBy('id', 'asc');

        return $child;
    }

    /**
     * 대댓글을 위한 쿼리
     */
    public function rereplies()
    {
        return $this->rereply()->with('rereplies');
    }


}
