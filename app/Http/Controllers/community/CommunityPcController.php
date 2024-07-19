<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use App\Models\Community;
use App\Models\CommunityBlock;
use App\Models\CommunityReport;
use App\Models\Magazine;
use App\Models\Notice;
use App\Models\Reply;
use App\Models\ReplyBlock;
use App\Models\ReplyReport;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

/*
|--------------------------------------------------------------------------
| 커뮤니티 관리자
|--------------------------------------------------------------------------
|
| - 커뮤니티 목록 관리
|       - 커뮤니티 목록 보기 (O)
|       - 커뮤니티 상세 보기 (O)
|       - 댓글 보기 (O)
|       - 커뮤니티 상태 수정 (O)
|
*/

class CommunityPcController extends Controller
{

    public function communityListView(Request $request): View
    {
        $is_community = $request->community ?? 0;
        $tableName = $is_community == 0 ? "magazine" : "community";

        if ($is_community == 0) {

            // 매거진
            $communityList = Magazine::withCount('replys')
                ->select(
                    'magazine.*',
                    DB::raw("(SELECT count(*) FROM reply WHERE target_id = magazine.id AND target_type = 'magazine' AND is_delete = 0) AS replys_count")
                )
                ->where('magazine.type', '=', $request->type ?? 0)
                ->where('magazine.is_blind', '0');
        } else if ($is_community == 1) {
            // 커뮤니티
            $communityList = Community::withCount('replys')
                ->select(
                    "community.*",
                    DB::raw("(SELECT count(*) FROM reply WHERE target_id = community.id AND target_type = 'community' AND is_delete = 0) AS replys_count")
                )
                ->where('community.category', '=', $request->type ?? 0)
                ->where('community.is_blind', '0')
                ->where('community.is_delete', '0');
        }
        if (Auth::guard('web')->user() != null) {
            if ($is_community == 1) {
                $communityList->report($tableName, Auth::guard('web')->user()->id ?? "");
                $communityList->block($tableName, Auth::guard('web')->user()->id ?? "");
            }
        }

        // 정렬
        if ($request->order == 1) {
            $communityList->orderBy($tableName . '.like_count', 'desc')->orderBy($tableName . '.id', 'desc');
        } else if ($request->order == 2) {
            $communityList->orderBy('replys_count', 'desc')->orderBy($tableName . '.id', 'desc');
        } else {
            $communityList->orderBy($tableName . '.created_at', 'desc')->orderBy($tableName . '.id', 'desc');
        }

        // 페이징
        $result = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        $noticeList = Notice::select()->where('is_blind', '0')->orderBy('created_at', 'desc')->take(2)->get();

        return view('www.community.community_list', compact('result', 'noticeList'));
    }

    /**
     * 커뮤니티 상세 화면 조회
     */
    public function communityDetailView(Request $request): View
    {
        $is_community = $request->community ?? 0;
        $tableName = $is_community == 0 ? "magazine" : "community";

        if ($is_community == 0) {

            // 매거진
            $community = Magazine::withCount('replys');

            // 해당 ID 만 검색
            $community->where('magazine.id', '=', $request->id);
        } else if ($is_community == 1) {
            // 커뮤니티
            $community = Community::withCount('replys');

            // 해당 ID 만 검색
            $community->where('community.id', '=', $request->id);
        }

        if (Auth::guard('web')->user() != null) {
            if ($is_community == 0) {
                $community->like($tableName, Auth::guard('web')->user()->id ?? "");
            } else {
                $community->like($tableName, Auth::guard('web')->user()->id ?? "");
            }
        }

        $result = $community->first();

        // 조회수 증가
        $result->increment('view_count', '1');

        // 커뮤니티 댓글 선택
        $ReplyList = Reply::with('rereplies')->select(
            'reply.*',
            'users.nickname AS author_name',
            'users.type AS author_type',
            'reply_block.id AS block_id'
        )
            ->leftJoin('reply_block', function ($block) {
                $block->on('reply.id', '=', 'reply_block.reply_id')
                    ->where('reply_block.users_id', '=', Auth::guard('web')->user()->id ?? "");
            });

        // 작성자
        $ReplyList->join('users', 'reply.author', '=', 'users.id');

        // 해당 댓글만
        $ReplyList->where('reply.target_id', '=', $request->id);
        $ReplyList->where('reply.is_delete', '=', 0);
        $ReplyList->where('reply.is_blind', '=', 0);

        if ($is_community == 0) {
            $ReplyList->where('reply.target_type', '=', 'magazine');
        } else {
            $ReplyList->where('reply.target_type', '=', 'community');
        }

        // 댓글일 경우만
        $ReplyList->whereNull('parent_id');

        // 페이징 처리
        $replys = $ReplyList->paginate(10);
        $replys->appends(request()->except('page'));

        $replyCount = Reply::select()->where('target_id', $request->id)->where('target_type', $is_community == 0 ? 'magazine' : 'community')
            ->where('is_delete', 0)
            ->where('is_blind', 0)
            ->count();

        return view('www.community.community_detail', compact('result', 'replys', 'replyCount'));
    }


    /**
     * 커뮤니티 검색 화면 조회
     */
    public function communitySearchView(): View
    {
        return view('www.community.community_search');
    }

    /**
     * 커뮤니티 검색 리스트 화면 조회
     */
    public function communitySearchListView(Request $request): View
    {
        $searchInput = $request->searchInput;

        $is_community = $request->community ?? 0;
        $tableName = $is_community == 0 ? "magazine" : "community";

        if ($is_community == 0) {

            // 매거진
            $communityList = Magazine::withCount('replys')
                ->select(
                    'magazine.*',
                    DB::raw("(SELECT count(*) FROM reply WHERE target_id = magazine.id AND target_type = 'magazine' AND is_delete = 0) AS replys_count")
                )
                ->where('magazine.type', '=', $request->type ?? 0)
                ->where('magazine.is_blind', '0');
        } else if ($is_community == 1) {
            // 커뮤니티
            $communityList = Community::withCount('replys')
                ->select(
                    "community.*",
                    DB::raw("(SELECT count(*) FROM reply WHERE target_id = community.id AND target_type = 'community' AND is_delete = 0) AS replys_count")
                )
                ->where('community.category', '=', $request->type ?? 0)
                ->where('community.is_blind', '0')
                ->where('community.is_delete', '0');
        }

        // 검색어
        if (isset($request->searchInput)) {
            $communityList
                ->where($tableName . '.title', 'like', "%{$request->searchInput}%")
                ->orWhere($tableName . '.content', 'like', "%{$request->searchInput}%");
        }

        if (Auth::guard('web')->user() != null) {
            if ($is_community == 1) {
                $communityList->report($tableName, Auth::guard('web')->user()->id ?? "");
                $communityList->block($tableName, Auth::guard('web')->user()->id ?? "");
            }
        }

        // 정렬
        if ($request->order == 1) {
            $communityList->orderBy($tableName . '.like_count', 'desc')->orderBy($tableName . '.id', 'desc');
        } else if ($request->order == 2) {
            $communityList->orderBy('replys_count', 'desc')->orderBy($tableName . '.id', 'desc');
        } else {
            $communityList->orderBy($tableName . '.created_at', 'desc')->orderBy($tableName . '.id', 'desc');
        }

        // 페이징
        $result = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));


        return view('www.community.community_search_list', compact('result', 'searchInput'));
    }

    /**
     * 커뮤니티 삭제
     */
    public function communityDelete(Request $request): RedirectResponse
    {

        Community::where('id', $request->id)->update([
            'is_delete' => 1
        ]);

        return Redirect::route('www.community.list.view', ['is_community' => '1'])->with('message', '게시글을 삭제했습니다.');
    }

    /**
     * 커뮤니티 등록 화면 조회
     */
    public function communityCreateView(): View
    {
        return view('www.community.community_create');
    }

    /**
     * 커뮤니티 등록
     */
    public function communityCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required|min:1|max:50',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Community::create([
            'author' => Auth::guard('web')->user()->id,
            'category' => $request->category,
            'title' => $request->title,
            'content' => $request->content,
            'is_blind' => 0, // 등록 시에는 0
            'view_count' => 0, // 등록 시에는 0 조회 할 때 증가,
            'like_count' => 0, // 등록 시에는 0 좋아요 할 때 증가,
            'is_delete' => 0,
        ]);

        $this->imageWithCreate($request->community_image_ids, Community::class, $result->id);


        return Redirect::route('www.community.detail.view', ['id' => $result->id, 'community' => '1'])->with('message', '게시글을 등록했습니다.');
    }

    /**
     * 커뮤니티 수정 화면 조회
     */
    public function communityUpdateView($id)
    {
        // 커뮤니티
        $community = Community::withCount('replys');

        // 해당 ID 만 검색
        $community->where('community.id', '=', $id);
        $community->where('author', '=', Auth::guard('web')->user()->id);

        $result = $community->first();

        if ($result) {
            return view('www.community.community_update', compact('result'));
        } else {
            return Redirect::route('www.community.detail.view', ['id' => $id, 'community' => '1'])->with('error', '해당 커뮤니티를 찾을 수 없습니다.');
        }
    }

    /**
     * 커뮤니티 등록
     */
    public function communityUpdate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required|min:1|max:50',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Community::where('id', $request->id)
            ->where('author', '=', Auth::guard('web')->user()->id)
            ->first();

        if ($result) {

            $result->update([
                'category' => $request->category,
                'title' => $request->title,
                'content' => $request->content,
            ]);

            $this->imageWithEdit($request->community_image_ids, Community::class, $result->id);


            return redirect()->to($request->last_url)->with('message', '커뮤니티를 수정했습니다.');
        } else {
            return Redirect::route('www.community.detail.view', ['id' => $result->id, 'community' => '1'])->with('error', '해당 커뮤니티를 찾을 수 없습니다.');
        }
    }

    /**
     * 댓글 등록
     */
    public function replyCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'reply_comment' => 'required',
            'community_id' => 'required',
            'community_type' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Reply::create([
            'target_id' => $request->community_id,
            'target_type' => $request->community_type,
            'author' => Auth::guard('web')->user()->id,
            'parent_id' => $request->parent_id,
            'depth' => ($request->parent_id != '') ? 1 : 0,
            'content' => $request->reply_comment,
            'block_count' => 0,
            'like_count' => 0,
            'report_count' => 0,
            'is_blind' => 0,
            'is_delete' => 0
        ]);


        $community_type = $request->community_type == 'magazine' ? 0 : 1;

        $users_id = null;
        $title = null;
        $index = null;
        $target_id = $request->community_id;

        if ($community_type == 0 && $request->parent_id > 0) {
            $users_id = $request->parent_id;
            $title = '공톡컨텐츠 댓글에 답글이 작성되었습니다.';
            $index = '105';
            Alarms::Create([
                'users_id' => $users_id,
                'title' => $title,
                'target_id' => $target_id,
                'index' => $index,
                'body' => 'body',
                'msg' => 'msg'
            ]);
        } else if ($community_type == 1) {
            $reply = Reply::where('id', $request->community_id)->first();
            $community = Community::where('id', $request->community_id)->first();
            if ($request->parent_id > 0) {
                $title = '커뮤니티 댓글에 답글이 작성되었습니다.';
                $users_id = $reply->author;
                $index = '104';
                Alarms::Create([
                    'users_id' => $users_id,
                    'title' => $title,
                    'target_id' => $target_id,
                    'index' => $index,
                    'body' => 'body',
                    'msg' => 'msg'
                ]);
            }

            if ($community->author != $reply->author) {
                $title = '내 글에 댓글이 작성되었습니다.';
                $users_id = $community->author;
                $index = '103';
                Alarms::Create([
                    'users_id' => $users_id,
                    'title' => $title,
                    'target_id' => $target_id,
                    'index' => $index,
                    'body' => 'body',
                    'msg' => 'msg'
                ]);
            }
        }

        $androidTokens = [];
        $iosTokens = [];

        $data = [
            'title' => env('APP_NAME'),
            'body' => $title,
            'index' => intval($index),
            'id' => intval($target_id)
        ];

        if ($users_id > 0) {
            $user = User::where('id', $users_id)->where('state', 0)->first();
            Log::info($user->getAttribute('device_type') . '|' . $user->getAttribute('fcm_key'));
            if ($user->getAttribute('device_type') == "1") {
                Log::info('안드로이드');
                array_push($androidTokens, $user->getAttribute('fcm_key'));
            } else if ($user->getAttribute('device_type') == "2") {
                Log::info('아이폰');
                array_push($iosTokens, $user->getAttribute('fcm_key'));
            }
            $this->sendAlarm($iosTokens, $androidTokens, $data);
        }

        return Redirect::back();
    }

    /**
     * 게시글 신고
     */
    public function communityReport(Request $request): RedirectResponse
    {

        // 유효성 검사
        $ArrayData =  [
            'target_id' => "required",
            'target_type' => "required",
            'community_report_type' => "required",
            'community_report_reason' => "required",
        ];

        $validator = Validator::make($request->all(), $ArrayData);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = CommunityReport::create([
            'users_id' => Auth::guard('web')->user()->id ?? 0,
            'target_id' => $request->target_id,
            'target_type' => ($request->target_type == 0) ? Magazine::class : Community::class,
            'type' => $request->community_report_type,
            'reason' => $request->community_report_reason,
        ]);

        return Redirect::back()->with('message', '신고가 등록 되었습니다.');
    }

    /**
     * 게시글 차단
     */
    public function communityBlock(Request $request): RedirectResponse
    {

        // 유효성 검사
        $ArrayData =  [
            'block_community_id' => "required"
        ];

        $validator = Validator::make($request->all(), $ArrayData);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = CommunityBlock::create([
            'users_id' => Auth::guard('web')->user()->id ?? 0,
            'community_id' => $request->block_community_id
        ]);

        return Redirect::route('www.community.list.view')->with('message', '게시글을 차단했습니다.');
    }


    /**
     * 댓글 신고
     */
    public function replyReport(Request $request): RedirectResponse
    {

        // 유효성 검사
        $ArrayData =  [
            'report_reply_id' => "required",
            'report_type' => "required",
            'report_reason' => "required",
        ];

        $validator = Validator::make($request->all(), $ArrayData);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = ReplyReport::create([
            'users_id' => Auth::guard('web')->user()->id ?? 0,
            'reply_id' => $request->report_reply_id,
            'type' => $request->report_type,
            'reason' => $request->report_reason,
        ]);

        return Redirect::back()->with('message', '신고가 등록 되었습니다.');
    }

    /**
     * 댓글 차단
     */
    public function replyBlock(Request $request): RedirectResponse
    {

        // 유효성 검사
        $ArrayData =  [
            'block_reply_id' => "required"
        ];

        $validator = Validator::make($request->all(), $ArrayData);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = ReplyBlock::create([
            'users_id' => Auth::guard('web')->user()->id ?? 0,
            'reply_id' => $request->block_reply_id
        ]);

        return Redirect::back()->with('message', '차단 되었습니다.');
    }

    /**
     * 댓글 삭제
     */
    public function replyDelete(Request $request): RedirectResponse
    {

        Reply::where('id', $request->id)->update([
            'is_delete' => 1
        ]);

        return Redirect::back()->with('message', '삭제 되었습니다.');
    }

    /**
     * 공지사항
     */
    public function noticeDetailView($id): View
    {
        $result = Notice::where('id', $id)->where('is_blind', 0)->first();

        // 조회수 증가
        $result->increment('view_count', '1');

        return view('www.community.notice_detail', compact('result'));
    }
}
