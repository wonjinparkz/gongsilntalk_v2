<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 관리자 > 사용자 관리
|--------------------------------------------------------------------------
|
| - 사용자 목록 보기
| - 사용자 상세 화면 보기
| - 사용자 상태 수정
|
*/

class UserController extends Controller
{
    /**
     * 사용자 목록 보기
     */
    public function userListView(Request $request): View
    {
        $userList = User::select();

        // 사용자 이메일 검색
        if (isset($request->email)) {
            $userList->where('email', 'like', "%{$request->email}%");
        }

        if (isset($request->name)) {
            $userList->where('name', 'like', "%{$request->name}%");
        }

        // 사용자 상태
        if ($request->has('state') && $request->state > -1) {
            $userList->where('state', '=', $request->state);
        }
        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $userList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $userList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $userList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));

        return view('admin.user.user-list', compact('result'));
    }

    /**
     * 사용자 상세 화면 보기
     */
    public function userdetailView(Request $request): View
    {
        $result = User::with('images')->where('id', $request->id)->first();
        return view('admin.user.user-detail', compact('result'));
    }

    /**
     * 사용자 상태 수정
     */
    public function userStateUpdate(Request $request): RedirectResponse
    {
        $result = User::where('id', $request->id)
            ->update(['state' => $request->state == 0 ? 1 : 0]);

        return back()->with('message', '사용자 상태를 수정했습니다.');
    }
}
