<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 관리자 관리 메뉴
|--------------------------------------------------------------------------
|
| - 관리자 목록 보기 (O)
| - 관리자 상세 보기 (O)
| - 관리자 등록 (O)
| - 관리자 상태 수정 (O)
| - 관리자 정보 수정 (O)
| - 관리자 비밀번호 수정 (O)
| - 관리자 삭제 (O)
|
*/

class AdminController extends Controller
{

    /**
     * 관리자 목록 보기
     */
    public function adminListView(Request $request): View
    {
        $adminList = Admin::select();

        // 관리자 상태
        if ($request->has('state') && $request->state > -1) {
            $adminList->where('state', '=', $request->state);
        }

        // 관리자 이름
        if (isset($request->name)) {
            $adminList->where('name', 'like', "%{$request->name}%");
        }


        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $adminList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $adminList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        // 페이징
        $result = $adminList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.admin.admin-list', compact('result'));
    }

    /**
     * 관리자 상세 화면 보기
     */
    public function adminDetailView($id): View
    {
        $result = Admin::where('id', $id)->first();
        return view('admin.admin.admin-detail', compact('result'));
    }

    /**
     * 관리자 등록 화면 조회
     */
    public function adminCreateView(): View
    {
        return view('admin.admin.admin-create');
    }

    /**
     * 관리자 등록
     */
    public function adminCreate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => "required|unique:admins|max:30|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
            'name' => 'required|min:1',
            'phone' => 'required|min:11',
            'permissions' => 'required|array'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Admin::create([
            'admin_id' => $request->admin_id,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'phone' => $request->phone,
            'permissions' => implode(',', $request->permissions),
            'state' => $request->state
        ]);

        return Redirect::route('admins.list.view')->with('message', '관리자를 등록했습니다.');
    }

    /**
     * 관리자 정보 수정
     */
    public function adminUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'phone' => 'required|min:11',
            'permissions' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect(route('admins.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = Admin::where('id', $request->id)->first()
            ->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'permissions' => implode(',', $request->permissions),
                'state' => $request->state
            ]);


        return back()->with('message', '관리자 정보를 수정했습니다.');
    }

    /**
     * 관리자 상태 수정
     */
    public function adminStateUpdate(Request $request): RedirectResponse
    {
        $result = Admin::where('id', $request->id)
            ->update(['state' => $request->state == 0 ? 1 : 0]);

        return back()->with('message', '관리자 상태를 수정했습니다.');
    }

    /**
     * 관리자 비밀번호 변경
     */
    public function adminPasswordUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Admin::where('id', $request->id)
            ->update(['password' => Hash::make($request->password)]);

        return back()->with('message', '관리자 비밀번호를 수정했습니다.');
    }

    /**
     * 관리자 삭제
     */
    public function adminDelete(Request $request): RedirectResponse
    {
        $result = Admin::where('id', $request->id)->delete();
        return back()->with("message", "관리자를 삭제했습니다.");
    }

    /**
     * 관리자 계정 설정
     */
    public function me($id)
    {

        if ($id != Auth::guard('admin')->user()->id) {
            return back()->with("message", "권한이 없습니다.");
        }


        $result = Admin::where('id', $id)->first();
        return view('admin.admin.admin-me', compact('result'));
    }

    /**
     * 관리자 계정 설정 업데이트
     */
    public function updateMe(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'phone' => 'required|min:11',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Admin::where('id', $request->id)->first()
            ->update([
                'name' => $request->name,
                'phone' => Crypt::encryptString($request->phone),
            ]);


        return back()->with('message', '관리자 정보를 수정했습니다.');
    }
}
