<?php

namespace App\Http\Controllers\user;

use App\Exports\CompanyExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Exports\CorpExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $userList = User::select()->where('type', '=', '0');

        // 사용자 이름
        if (isset($request->name)) {
            $userList->where('name', 'like', "%{$request->name}%");
        }

        // 사용자 상태
        if ($request->has('state') && $request->state > -1) {
            $userList->where('state', '=', $request->state);
        }

        // 사용자 상태
        if ($request->has('provider') && $request->provider > -1) {
            $userList->where('provider', '=', $request->provider);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $userList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        $userList->orderBy('created_at', 'desc')->orderBy('id', 'desc');
        $result = $userList->get(); // 페이지네이션 적용 전 전체 데이터 조회

        // phone 필터링을 후처리로 적용
        if (isset($request->phone)) {
            $result = $result->filter(function ($user) use ($request) {
                return decrypt($user->phone) === $request->phone;
            });
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
     * 중개사 목록 보기
     */
    public function corpListView(Request $request): View
    {
        $userList = User::select()->where('type', '=', '1')->where('company_state', '=', '1');

        // 담당자 이름
        if (isset($request->name)) {
            $userList->where('name', 'like', "%{$request->name}%");
        }

        // 담당자 전화번호
        if (isset($request->phone)) {
            $userList->where('phone', 'like', "%{$request->phone}%");
        }

        // 중개사무소명
        if (isset($request->company_name)) {
            $userList->where('company_name', 'like', "%{$request->company_name}%");
        }

        // 중개사 상태
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

        return view('admin.user.corp-list', compact('result'));
    }

    /**
     * 중개사 목록 보기
     */
    public function companyListView(Request $request): View
    {
        $userList = User::select()->where('type', '=', '1')->whereNot('company_state', '=', '1');

        // 담당자 이름
        if (isset($request->name)) {
            $userList->where('name', 'like', "%{$request->name}%");
        }

        // 담당자 전화번호
        if (isset($request->phone)) {
            $userList->where('phone', 'like', "%{$request->phone}%");
        }

        // 중개사무소명
        if (isset($request->company_name)) {
            $userList->where('company_name', 'like', "%{$request->company_name}%");
        }

        // 중개사 상태
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

        return view('admin.user.company-list', compact('result'));
    }

    /**
     * 중개사 상세 화면 보기
     */
    public function companydetailView(Request $request): View
    {
        $result = User::with('images', 'companyImages')->where('id', $request->id)->first();
        return view('admin.user.company-detail', compact('result'));
    }

    /**
     * 사용자 상태 수정
     */
    public function userStateUpdate(Request $request): RedirectResponse
    {
        if ($request->state == 2) {
            $result = User::where('id', $request->id)
                ->update([
                    'leaved_at' => Carbon::now(),
                    'state' => 2,
                    'fcm_key' => null
                ]);

            return back()->with('message', '사용자를 회원탈퇴 하였습니다.');
        } else {
            $result = User::where('id', $request->id)
                ->update([
                    'state' => $request->state,
                    'contract_cancell_at' => $request->state == 3 ? Carbon::now() : null,
                ]);

            return back()->with('message', '사용자 상태를 수정했습니다.');
        }
    }

    /**
     * 중개사 승인 반려
     */
    public function companyStateUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required',
            'refuse_coment' => 'required_if:state,2',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.corp.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = User::select()
            ->where('id', $request->id)
            ->first();

        $result->update([
            'company_state' => $request->state,
            'refuse_at' => $request->state == 2 ? Carbon::now() : null,
            'refuse_coment' => $request->refuse_coment
        ]);

        $result->refresh();

        $text = $request->state == 1 ? '승인' : '반려';

        if ($request->state == 1) {
            $this->kakaoSend('115', $result->name, $result->phone);
        }

        return redirect(route('admin.corp.detail.view', [$request->id]))->with('message', '중개사 회원을 ' . $text . '했습니다.');
    }

    /**
     * 회원 메모 업데이트
     */
    public function userMemoUpdate(Request $request)
    {
        $result = User::select()
            ->where('id', $request->id)
            ->first();

        $result->update([
            'memo' => $request->memo
        ]);
        if ($result->type == 1) {
            return redirect(route('admin.corp.detail.view', [$request->id]))->with('message', '메모를 수정했습니다.');
        } else {
            return redirect(route('admin.user.detail.view', [$request->id]))->with('message', '메모를 수정했습니다.');
        }
    }

    /**
     * 사용자 정보 다운로드
     */
    public function exportUser(Request $request)
    {
        return Excel::download(new UserExport($request), '사용자_' . Carbon::now() . '.xlsx');
    }

    /**
     * 중개사 정보 다운로드
     */
    public function exportCorp(Request $request)
    {
        return Excel::download(new CorpExport($request), '중개사_' . Carbon::now() . '.xlsx');
    }

    /**
     * 중개사 정보 다운로드
     */
    public function exportCompany(Request $request)
    {
        return Excel::download(new CompanyExport($request), '승인_요청_중개사_' . Carbon::now() . '.xlsx');
    }
}
