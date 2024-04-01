<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\CommunityBlock;
use App\Models\CommunityCategory;
use App\Models\Reply;
use App\Models\ReplyBlock;
use App\Models\ReplyLike;
use App\Models\ReplyReport;
use App\Models\CommunityReport;
use App\Models\Images;
use App\Models\Like;
use App\Models\UsersBlocks;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 커뮤니티 API
|--------------------------------------------------------------------------
|
| - 커뮤니티 카테고리 목록 (O)
| - 커뮤니티 글 등록 (O)
| - 커뮤니티 글 수정 (O)
| - 커뮤니티 글 삭제 (O)
| - 커뮤니티 글 목록 (O)
| - 커뮤니티 글 상세보기 (O)
| - 커뮤니티 글 좋아요 (O)
| - 커뮤니티 글 신고 (O)
| - 커뮤니티 글 차단 (O)
| -------------------------------------------------------------------------
| - 커뮤니티 댓글 등록 (O)
| - 커뮤니티 댓글 수정 (O)
| - 커뮤니티 댓글 삭제 (O)
| - 커뮤니티 댓글 목록 (O)
| - 커뮤니티 댓글 좋아요 (O)
| - 커뮤니티 댓글 신고 (O)
| - 커뮤니티 댓글 차단 (O)
|
*/

class CommunityAPIController extends Controller
{
    /**
     * 커뮤니티 카테고리 목록
     */
    public function categoryList(Request $request)
    {
        $categoryList = CommunityCategory::select();

        // 상태
        $categoryList->where('state', '=', 0);

        // 정렬
        $categoryList->orderBy('id', 'asc');

        $result = $this->toResult($categoryList);
        return $this->sendResponse($result, '커뮤니티 카테고리 목록입니다.');
    }

    /**
     * 커뮤니티 등록
     */
    public function communityCreate(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:community_category,id',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);


        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        // DB 추가
        $success = Community::create([
            'author' => Auth::guard('api')->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'state' => 0, // 등록 시에는 0
            'delete' => 0,  // 삭제는 0
            'view_count' => 0, // 등록 시에는 0 조회 할 때 증가
            'block_count' => 0, // 등록 시에는 0
            'like_count' => 0, // 등록 시에는 0
            'report_count' => 0, // 등록 시에는 0
        ]);


        // 이미지 업데이트
        Images::whereIn('id', $request->image_ids)
            ->update([
                'target_type' => Community::class,
                'target_id' => $success->id,
            ]);

        return $this->sendResponse($success, "게시글이 등록되었습니다.");
    }

    /**
     * 커뮤니티 수정
     */
    public function communityUpdate(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:community_category,id',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);


        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $community = Community::where('id', $request->id)->first();

        if ($community->author == Auth::guard('api')->user()->id) {
            $community->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,
            ]);

            // 기존 데이터 초기화 하고 이미지 업데이트
            Images::where('target_id', '=', $request->id)
                ->where('target_type', '=', Community::class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            Images::whereIn('id', $request->image_ids)
                ->update([
                    'target_type' => Community::class,
                    'target_id' => $request->id,
                ]);


            $success = $community->refresh();
            return $this->sendResponse($success, "게시글이 수정되었습니다.");
        } else {
            return $this->sendError("수정 권한이 없습니다.", $validator->errors(), Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * 커뮤니티 글 목록
     */
    public function communityList(Request $request)
    {

        // 오류 체크
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'category' => 'exists:community_category,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }
        // 커뮤니티 선택
        $communityList = Community::with('images')->select(
            'community.*',
            'users.name AS author_name',
            'community_category.title AS category_title',
            'community_like.id AS like_id',
            'community_report.id AS report_id',
            'community_block.id AS block_id',
        );

        // 작성자
        $communityList->join('users', 'community.author', '=', 'users.id');
        // 카테고리
        $communityList->join('community_category', 'community.category_id', '=', 'community_category.id');

        // 커뮤니티 좋아요
        $communityList->leftJoin('community_like', function ($like) {
            $like->on('community.id', '=', 'community_like.community_id')
                ->where('community_like.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 커뮤니티 신고 ID
        $communityList->leftJoin('community_report', function ($report) {
            $report->on('community.id', '=', 'community_report.community_id')
                ->where('community_report.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 커뮤니티 차단 ID
        $communityList->leftJoin('community_block', function ($block) {
            $block->on('community.id', '=', 'community_block.community_id')
                ->where('community_block.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 카테고리 상태가 공개 일 때만
        $communityList->where('community_category.state', '=', '0');
        // 커뮤니티 삭제 안된 것만 검색
        $communityList->where('community.delete', '=', '0');
        // 차단한 회원의 글이 아닌 것만 검색
        $communityList->whereNotIn(
            'users.id',
            UsersBlocks::select('block_id')->where('user_id', '=', Auth::guard('api')->user()->id)->get()
        );

        // 검색어
        if (isset($request->title)) {
            $communityList
                ->where('community.title', 'like', "%{$request->title}%")
                ->orWhere('community.content', 'like', "%{$request->title}%");
        }

        // 카테고리
        if (isset($request->category)) {
            $communityList->where('community.category_id', '=', $request->category);
        }

        // 작성일 from-date
        if (isset($request->from_created_at)) {
            $communityList->whereDate('community.created_at', '>=', date($request->from_created_at));
        }

        // 작성일 to-date
        if (isset($request->to_created_at)) {
            $communityList->whereDate('community.created_at', '<=', date($request->to_created_at));
        }

        // 특정 작성자 글만 보기
        if (isset($request->author)) {
            if ($request->author > 0) {
                $communityList->where('community.author', '=', $request->author);
            } else {
                $communityList->where('community.author', '=',  Auth::guard('api')->user()->id);
            }
        }

        // 정렬
        $communityList->orderBy('community.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징 처리
        $result = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));

        return $this->sendResponse($result, '커뮤니티 목록입니다.');
    }

    /**
     * 커뮤니티 상세
     */
    public function communityDetail(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:community,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        // 커뮤니티 선택
        $community = Community::select(
            'community.*',
            'users.name AS author_name',
            'community_category.title AS category_title',
            'community_like.id AS like_id',
            'community_report.id AS report_id',
            'community_block.id AS block_id',
        );

        // 작성자
        $community->join('users', 'community.author', '=', 'users.id');
        // 카테고리
        $community->join('community_category', 'community.category_id', '=', 'community_category.id');

        // 커뮤니티 좋아요
        $community->leftJoin('community_like', function ($like) {
            $like->on('community.id', '=', 'community_like.community_id')
                ->where('community_like.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 커뮤니티 신고 ID
        $community->leftJoin('community_report', function ($report) {
            $report->on('community.id', '=', 'community_report.community_id')
                ->where('community_report.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 커뮤니티 차단 ID
        $community->leftJoin('community_block', function ($block) {
            $block->on('community.id', '=', 'community_block.community_id')
                ->where('community_block.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 해당 ID 만 검색
        $community->where('community.id', '=', $request->id);

        $result = $community->first();

        // 삭제된 게시물일 경우
        if ($result->delete == 1) {
            $errors["type"] = "delete";
            return $this->sendError("삭제된 게시물입니다.", $errors, Response::HTTP_NOT_ACCEPTABLE);
        }

        if ($result->block_id != null) {
            $errors["type"] = "block";
            return $this->sendError("차단한 게시물입니다.", $errors, Response::HTTP_NOT_ACCEPTABLE);
        }
        // 조회수 증가
        $result->increment('view_count', '1');
        return $this->sendResponse($result, '커뮤니티 상세화면입니다.');
    }

    /**
     * 커뮤니티 삭제 상태 수정
     */
    public function communityDelete(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $community = Community::where('id', $request->id)->first();

        if ($community->author == Auth::guard('api')->user()->id) {
            $community->update(['delete' => 1]);
            $success = $community->refresh();
            return $this->sendResponse($success, "게시글이 삭제되었습니다.");
        } else {
            return $this->sendError("삭제 권한이 없습니다.", $validator->errors()->all(), Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * 커뮤니티 좋아요
     */
    public function communityLike(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $communityLike = Like::where('community_id', $request->id)
            ->where('user_id', Auth::guard('api')->user()->id)
            ->first();

        if ($communityLike == null) {
            $created = Like::create([
                'user_id' => Auth::guard('api')->user()->id,
                'community_id' => $request->id,
            ]);
            Community::where('id', $request->id)
                ->increment('like_count', 1);

            $success = $created;
            return $this->sendResponse($success, "좋아요가 등록되었습니다.");
        } else {
            $communityLike->delete();
            Community::where('id', $request->id)
                ->decrement('like_count', 1);

            $success["id"] = $request->id;
            return $this->sendResponse($success, "좋아요가 해제되었습니다.");
        }
    }

    /**
     * 커뮤니티 차단
     */
    public function communityBlock(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $communityBlock = CommunityBlock::where('community_id', $request->id)
            ->where('user_id', Auth::guard('api')->user()->id)
            ->first();

        if ($communityBlock == null) {
            $created = CommunityBlock::create([
                'user_id' => Auth::guard('api')->user()->id,
                'community_id' => $request->id,
            ]);
            Community::where('id', $request->id)
                ->increment('block_count', 1);

            $success = $created;
            return $this->sendResponse($success, "게시글이 차단되었습니다.");
        } else {
            $communityBlock->delete();
            Community::where('id', $request->id)
                ->decrement('block_count', 1);

            $success["id"] = $request->id;
            return $this->sendResponse($success, "게시글 차단이 해제되었습니다.");
        }
    }

    /**
     * 커뮤니티 신고
     */
    public function communityReport(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'report_type' => 'required|numeric',
            'report_reason' => 'required|min:1|max:30',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $communityReport = CommunityReport::create([
            'user_id' => Auth::guard('api')->user()->id,
            'community_id' => $request->id,
            'report_type' => $request->report_type,
            'report_reason' => $request->report_reason
        ]);

        Community::where('id', $request->id)
            ->increment('report_count', 1);

        $success = $communityReport;
        return $this->sendResponse($success, "게시글 신고가 접수되었습니다.");
    }

    /**
     * ------------------------------------------------------------------------------------------------------------------------
     */


    /**
     * 커뮤니티 댓글 목록
     */
    public function ReplyList(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required||exists:community,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        // 커뮤니티 댓글 선택
        $ReplyList = Reply::with('children')->select(
            'reply.*',
            'users.name AS author_name',
            'reply_like.id AS like_id',
            'reply_report.id AS report_id',
            'reply_block.id AS block_id',
        );

        // 작성자
        $ReplyList->join('users', 'reply.author', '=', 'users.id');

        // 커뮤니티 좋아요
        $ReplyList->leftJoin('reply_like', function ($like) {
            $like->on('reply.id', '=', 'reply_like.reply_id')
                ->where('reply_like.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 커뮤니티 신고 ID
        $ReplyList->leftJoin('reply_report', function ($report) {
            $report->on('reply.id', '=', 'reply_report.reply_id')
                ->where('reply_report.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 커뮤니티 차단 ID
        $ReplyList->leftJoin('reply_block', function ($block) {
            $block->on('reply.id', '=', 'reply_block.reply_id')
                ->where('reply_block.user_id', '=', Auth::guard('api')->user()->id);
        });

        // 해당 커뮤니티
        $ReplyList->where('reply.target_id', '=', $request->id);

        // 댓글일 경우만
        $ReplyList->whereNull('reply.parent_id');

        // 정렬
        $ReplyList->orderBy('reply.created_at', 'asc')->orderBy('id', 'asc');


        // 페이징 처리
        $result = $ReplyList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));



        return $this->sendResponse($result, '커뮤니티 댓글 목록입니다.');
    }

    /**
     * 커뮤니티 댓글 등록
     */
    public function ReplyCreate(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required||exists:community,id',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $Reply = Reply::create([
            'author' => Auth::guard('api')->user()->id,
            'community_id' => $request->id,
            'parent_id' => $request->parent_id,
            'depth' => $request->depth,
            'content' => $request->content,
            'state' => 0, // 등록 시에는 0
            'delete' => 0,  // 삭제는 0
            'block_count' => 0, // 등록 시에는 0
            'like_count' => 0, // 등록 시에는 0
            'report_count' => 0, // 등록 시에는 0
        ]);

        $success = $Reply;
        return $this->sendResponse($success, "댓글이 등록되었습니다.");
    }

    /**
     * 커뮤니티 댓글 수정
     */
    public function ReplyUpdate(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:reply,id',
            'content' => 'required|min:1|max:255',
        ]);


        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $community = Reply::where('id', $request->id)->first();

        if ($community->author == Auth::guard('api')->user()->id) {
            $community->update([
                'content' => $request->content,
            ]);
            $success = $community->refresh();
            return $this->sendResponse($success, "댓글이 수정되었습니다.");
        } else {
            return $this->sendError("수정 권한이 없습니다.", null, Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * 커뮤니티 댓글 삭제 상태 수정
     */
    public function ReplyDelete(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $Reply = Reply::where('id', $request->id)->first();

        if ($Reply->author == Auth::guard('api')->user()->id) {
            $Reply->update(['delete' => 1]);
            $success = $Reply->refresh();
            return $this->sendResponse($success, "댓글이 삭제되었습니다.");
        } else {
            return $this->sendError("삭제 권한이 없습니다.", $validator->errors()->all(), Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
     * 커뮤니티 댓글 좋아요
     */
    public function ReplyLike(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $Reply = ReplyLike::where('reply_id', $request->id)
            ->where('user_id', Auth::guard('api')->user()->id)
            ->first();

        if ($Reply == null) {
            $created = ReplyLike::create([
                'user_id' => Auth::guard('api')->user()->id,
                'reply_id' => $request->id,
            ]);

            Reply::where('id', $request->id)
                ->increment('like_count', 1);

            $success = $created;
            return $this->sendResponse($success, "좋아요가 등록되었습니다.");
        } else {
            $Reply->delete();
            Reply::where('id', $request->id)
                ->decrement('like_count', 1);

            $success["id"] = $request->id;
            return $this->sendResponse($success, "좋아요가 해제되었습니다.");
        }
    }

    /**
     * 커뮤니티 댓글 차단
     */
    public function ReplyBlock(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $communityBlock = ReplyBlock::where('reply_id', $request->id)
            ->where('user_id', Auth::guard('api')->user()->id)
            ->first();

        if ($communityBlock == null) {
            $created = ReplyBlock::create([
                'user_id' => Auth::guard('api')->user()->id,
                'reply_id' => $request->id,
            ]);
            Reply::where('id', $request->id)
                ->increment('block_count', 1);

            $success = $created;
            return $this->sendResponse($success, "댓글이 차단되었습니다.");
        } else {
            $communityBlock->delete();
            Reply::where('id', $request->id)
                ->decrement('block_count', 1);

            $success["id"] = $request->id;
            return $this->sendResponse($success, "댓글 차단이 해제되었습니다.");
        }
    }

    /**
     * 커뮤니티 댓글 신고
     */
    public function ReplyReport(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'report_type' => 'required|numeric',
            'report_reason' => 'required|min:1|max:30',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $communityReport = ReplyReport::create([
            'user_id' => Auth::guard('api')->user()->id,
            'reply_id' => $request->id,
            'report_type' => $request->report_type,
            'report_reason' => $request->report_reason
        ]);

        Reply::where('id', $request->id)
            ->increment('report_count', 1);

        $success = $communityReport;
        return $this->sendResponse($success, "게시글 신고가 접수되었습니다.");
    }
}
