<?php

namespace App\Http\Controllers\magazine;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Magazine;
use App\Models\MagazineCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 매거진 관리자
|--------------------------------------------------------------------------
|
| - 매거진 목록 관리
|       - 매거진 목록 보기
|       - 매거진 상세 보기
            - 댓글 보기
|       - 매거진 등록 화면
|       - 매거진 등록
|       - 매거진 수정
|       - 매거진 상태 수정
|
*/

class MagazineController extends Controller
{
    /**
     * 매거진 목록 보기
     */
    public function magazineListView(Request $request): View
    {
        $type = $request->type;
        $magazineList = Magazine::with('images')->with('category')->select()
            ->where('type', '=', $request->type);


        // 검색어
        if (isset($request->title)) {
            $magazineList->where('title', 'like', "%{$request->title}%");
        }

        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $magazineList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $magazineList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        // 페이징
        $result = $magazineList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.magazine.magazine-list', compact('result', 'type'));
    }

    /**
     * 매거진 상세 화면 보기
     */
    public function magazineDetailView(Request $request): View
    {
        $result = Magazine::with('images')->where('id', $request->id)->first();

        // 커뮤니티 댓글 선택
        $ReplyList = Reply::with('rereplies')->select(
            'reply.*',
            'users.nickname AS author_name',
            'users.type AS author_type',
        );

        // 작성자
        $ReplyList->join('users', 'reply.author', '=', 'users.id');

        // 해당 댓글만
        $ReplyList->where('reply.target_id', '=', $request->id);
        $ReplyList->where('reply.target_type', '=', Magazine::class);

        // 작성자 닉네임
        if (isset($request->author_nickname)) {
            $ReplyList->where('users.nickname', 'like', "%{$request->author_nickname}%");
        }

        // 작성자 타입
        if ($request->has('member_type') && $request->member_type > -1) {
            $ReplyList->where('users.type', '=', "$request->member_type");
        }


        // 댓글일 경우만
        $ReplyList->whereNull('parent_id');

        // 정렬
        if ($request->has('orderBy') && $request->orderBy == 1) {
            $ReplyList->orderBy('reply.report_count', 'DESC')->orderBy('id', 'DESC');
        } else {
            $ReplyList->orderBy('reply.created_at', 'DESC')->orderBy('id', 'DESC');
        }

        // 페이징 처리
        $replys = $ReplyList->paginate($request->per_page == null ? 10 : $request->per_page);
        $replys->appends(request()->except('page'));

        return view('admin.magazine.magazine-detail', compact('result', 'replys'));
    }

    /**
     * 매거진 등록 화면 보기
     */
    public function magazineCreateView(Request $request): View
    {
        $type = $request->type;
        return view('admin.magazine.magazine-create', compact('type'));
    }

    /**
     * 매거진 등록
     */
    public function magazineCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'title' => 'required|min:1|max:50',
            'content' => 'required',
            'url' => 'required_if:type,0',
            'magazine_image_ids' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Magazine::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => $request->type,
            'title' => $request->title,
            'content' => $request->content,
            'url' => $request->url ?? '',
            'is_blind' => 0, // 등록 시에는 0
            'view_count' => 0, // 등록 시에는 0 조회 할 때 증가,
            'like_count' => 0, // 등록 시에는 0 좋아요 할 때 증가,
        ]);

        $this->imageWithCreate($request->magazine_image_ids, Magazine::class, $result->id);

        $title = '';

        switch ($request->type) {
            case '0':
                $title = '공톡 유튜브';
                break;
            case '1':
                $title = '공톡 매거진';
                break;
            case '2':
                $title = '공톡 뉴스';
                break;
            default:
                $title = '매거진';
                break;
        }

        return Redirect::route('admin.magazine.list.view', ['type' => $request->type])->with('message', $title . '을 등록했습니다.');
    }

    /**
     * 매거진 수정
     */
    public function magazineUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'title' => 'required|min:1|max:50',
            'content' => 'required',
            'url' => 'required_if:type,0',
            'magazine_image_ids' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Magazine::where('id', $request->id)->first()
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'type' => $request->type,
                'title' => $request->title,
                'content' => $request->content,
                'url' => $request->url ?? '',
            ]);

        $this->imageWithEdit($request->magazine_image_ids, Magazine::class, $request->id);

        $title = '';
        switch ($request->type) {
            case '0':
                $title = '공톡 유튜브';
                break;
            case '1':
                $title = '공톡 매거진';
                break;
            case '2':
                $title = '공톡 뉴스';
                break;
            default:
                $title = '매거진';
                break;
        }


        return redirect()->to($request->last_url)->with('message', $title . '을 수정했습니다.');
    }

    /**
     * 매거진 상태 수정
     */
    public function magazineStateUpdate(Request $request): RedirectResponse
    {
        $result = Magazine::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);
        return back()->with('message', '매거진 게시상태를 수정했습니다.');
    }

    /**
     * 매거진 삭제
     */
    public function magazineDelete(Request $request): RedirectResponse
    {
        $result = Magazine::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '매거진을 삭제했습니다.');
    }
}
