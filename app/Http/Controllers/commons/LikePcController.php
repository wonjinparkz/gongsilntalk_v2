<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Like;
use App\Models\Magazine;
use App\Models\Used;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| PC 좋아요
|--------------------------------------------------------------------------
|
| - 좋아요 등록 / 해제
| - 좋아요 목록 보기
|
| # target_type
|   * 커뮤니티 게시글 - community
|   * 매거진 - magazine
|   * 댓글 - reply (스크랩에서는 사용안함)
|   * 일반 매물 - product
| -------------------------------------------------------------------------
|
*/

class LikePcController extends Controller
{
    /**
     * 좋아요 / 좋아요 해제
     */
    public function like(Request $request)
    {

        $like = Like::where('target_id', $request->target_id)
            ->where('target_type', $request->target_type)
            ->where('users_id', Auth::guard('web')->user()->id)
            ->first();

        if ($like == null) { // 스크랩이 없을 경우
            $created = Like::create([
                'users_id' => Auth::guard('web')->user()->id,
                'target_type' => $request->target_type,
                'target_id' => $request->target_id,
            ]);

            $likeCount = Like::where('target_type', $request->target_type)
                ->where('target_id', $request->target_id)->count();

            $success = $created;
            $success['like_count'] = $likeCount;


            // 커뮤니티 좋아요 수 추가
            if ($request->target_type == 'community') {
                $community = Community::where('id', $request->target_id)->first();
                $community->increment('like_count', 1);
            } else if ($request->target_type == 'magazine') {
                $magazine = Magazine::where('id', $request->target_id)->first();
                $magazine->increment('like_count', 1);
            }

            return $this->sendResponse($success, "좋아요 등록되었습니다.");
        } else { // 스크랩이 있을경우
            $like->delete();

            $success["target_type"] = $like->target_type;
            $success["target_id"] = $like->target_id;

            $likeCount = Like::where('target_type', $request->target_type)
                ->where('target_id', $request->target_id)->count();
            $success['like_count'] = $likeCount;

            // 커뮤니티 좋아요 수 감소
            if ($request->target_type == 'community') {
                $community = Community::where('id', $request->target_id)->first();
                $community->decrement('like_count', 1);
            } else if ($request->target_type == 'magazine') {
                $magazine = Magazine::where('id', $request->target_id)->first();
                $magazine->decrement('like_count', 1);
            }

            return $this->sendResponse($success, "좋아요 해제되었습니다.");
        }
    }

    /**
     * 스크랩 목록 보기
     */
    public function list(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'target_type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $target_type = $request->target_type;

        $likeList = Like::select(
            'like.id',
            'like.target_id',
            'like.target_type',
        );

        $likeList->where('target_type', '=', $target_type);

        $id = Auth::guard('web')->user()->id;
        $likeList->with([$target_type => function ($query) use ($target_type, $id) {
            $query->like($target_type, $id);
            $query->report($target_type, $id);
            $query->block($target_type, $id);
            $query->scrap($target_type, $id);
            $query->zone('users','zone');
        }]);

        $likeList->orderBy('like.created_at', 'desc')->orderBy('like.id', 'desc');

        // 페이징 처리
        $result = $likeList->paginate($request->per_page == null ? 30 : $request->per_page);
        $result->appends(request()->except('page'));

        return $this->sendResponse($result, '좋아요 목록입니다.');
    }
}
