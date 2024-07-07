<?php

namespace App\Http\Controllers\notice;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use App\Models\Images;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 공자사항 관리자
|--------------------------------------------------------------------------
|
| - 공지사항 목록 보기 (O)
| - 공지사항 상세 화면 보기 (O)
| - 공지사항 등록 화면 조회 (O)
| - 공지사항 등록 (O)
| - 공지사항 수정 (O)
| - 공지사항 상태 수정 (O)
| - 공지사항 삭제 (O)
|
*/

class NoticeController extends Controller
{
    /**
     * 공지사항 목록 보기
     */
    public function noticeListView(Request $request): View
    {
        $noticeList = Notice::with('images')->select();

        // 검색어
        if (isset($request->title)) {
            $noticeList
                ->where('notices.title', 'like', "%{$request->title}%");
        }

        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $noticeList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $noticeList->orderBy('notices.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징
        $result = $noticeList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.notice.notice-list', compact('result'));
    }

    /**
     * 공지사항 상세 화면 보기
     */
    public function noticeDetailView(Request $request): View
    {
        $result = Notice::with('images')->where('id', $request->id)->first();
        return view('admin.notice.notice-detail', compact('result'));
    }

    /**
     * 공지사항 등록 화면 조회
     */
    public function noticeCreateView(): View
    {
        return view('admin.notice.notice-create');
    }

    /**
     * 공지사항 등록
     */
    public function noticeCreate(Request $request): RedirectResponse
    {

        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:2550',
            'notice_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Notice::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'view_count' => 0, // 등록 시에는 0 조회 할 때 증가
        ]);

        $this->imageWithCreate($request->notice_image_ids, Notice::class, $result->id);

        $userList = User::where('state', 0)->get();

        foreach ($userList as $user) {
            $androidTokens = [];
            $iosTokens = [];

            $data = [
                'title' => env('APP_NAME'),
                'body' => '새로운 공지사항이 작성 되었습니다.',
                'index' => intval(106),
                'id' => intval($result->id)
            ];

            Alarms::Create([
                'users_id' => $user->id,
                'title' => $data['body'],
                'index' => '106',
                'target_id' => $data['id'],
                'body' => 'body',
                'msg' => 'msg'
            ]);

            Log::info($user->name . '의 디바이스 타입' . $user->device_type);
            if ($user->device_type == "1") {
                array_push($androidTokens, $user->fcm_key);
            } else if ($user->device_type == "2") {
                array_push($iosTokens, $user->fcm_key);
            }

            $this->sendAlarm($iosTokens, $androidTokens, $data);
        }


        return Redirect::route('admin.notice.list.view')->with('message', '공지사항을 등록했습니다.');
    }

    /**
     * 공지사항 수정
     */
    public function noticeUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:2550',
            'notice_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Notice::where('id', $request->id)->first()
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
            ]);

        $this->imageWithEdit($request->notice_image_ids, Notice::class, $request->id);

        return redirect()->to($request->last_url)->with('message', '공지사항을 수정했습니다.');
    }

    /**
     * 공지사항 상태 수정
     */
    public function noticeStateUpdate(Request $request): RedirectResponse
    {
        $result = Notice::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);
        return back()->with('message', '공지사항 게시상태를 수정했습니다.');
    }

    /**
     * 공지사항 삭제
     */
    public function noticeDelete(Request $request): RedirectResponse
    {
        $result = Notice::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '공지사항을 삭제했습니다.');
    }
}
