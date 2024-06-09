<?php

namespace App\Http\Controllers\qa;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use App\Models\Qa;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| 1:1 문의
|--------------------------------------------------------------------------
|
| - 1:1 문의 목록 보기 (O)
| - 1:1 문의 상세 화면 보기 (O)
| - 1:1 문의 답변 등록 (O)
| - 1:1 문의 답변 삭제 (O)
| - 1:1 문의 게시 상태 수정 (O)
|
*/

class QaController extends Controller
{
    /**
     * 1:1 문의 목록 보기
     */
    public function qaListView(Request $request): View
    {

        $qaList =  Qa::select()->with('users');

        // 검색어
        if (isset($request->title)) {
            $qaList
                ->where('title', 'like', "%{$request->title}%")
                ->orWhere('content', 'like', "%{$request->title}%");
        }

        // 1:1 답변 상태
        if (isset($request->is_reply)) {
            $qaList->where('is_reply', $request->is_reply);
        }

        // 1:1 카테고리
        if (isset($request->category)) {
            $qaList->where('category', $request->category);
        }

        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $qaList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $qaList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $qaList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.qa.qa-list', compact('result'));
    }

    /**
     * 1:1 문의 상세 화면 보기
     */
    public function qaDetailView(Request $request): View
    {
        $result = Qa::select()->with('users')->where('id', $request->id)->first();

        return view('admin.qa.qa-detail', compact('result'));
    }

    /**
     * qa 답변 등록
     */
    public function qaReplyUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'reply_content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Qa::where('id', $request->id)->first();
        $result->update([
                'reply_content' => $request->reply_content,
                'reply_date' => now(),
                'is_reply' => 1,
            ]);

        $qa = $result->refresh();

        Alarms::Create([
            'users_id' => $qa->users_id,
            'title' => '1:1 문의에 답변이 있습니다.',
            'body' => 'body',
            'msg' => 'msg'
        ]);

        return redirect()->to($request->last_url)->with('message', '답변을 등록 했습니다.');
    }

    /**
     * qa 답변 삭제
     */
    public function qaReplyDelete(Request $request): RedirectResponse
    {
        $result = Qa::where('id', $request->id)->first()
            ->update([
                'reply_content' => NULL,
                'reply_date' => NULL,
                'is_reply' => 0,
            ]);

        return redirect()->to($request->last_url)->with('message', '답변을 삭제 했습니다.');
    }
}
