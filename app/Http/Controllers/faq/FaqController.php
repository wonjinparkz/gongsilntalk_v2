<?php

namespace App\Http\Controllers\faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 관리자 - FAQ
|--------------------------------------------------------------------------
|
| - FAQ 목록 보기 (O)
| - FAQ 상세 화면 보기 (O)
| - FAQ 등록 화면 조회 (O)
| - FAQ 등록 (O)
| - FAQ 수정 (O)
| - FAQ 상태 수정 (O)
| - FAQ 삭제 (O)
|
*/

class FaqController extends Controller
{
    /**
     * FAQ 목록 보기
     */
    public function faqListView(Request $request): View
    {
        $faqList = Faq::select();

        // 검색어
        if (isset($request->title)) {
            $faqList
                ->where('faqs.title', 'like', "%{$request->title}%")
                ->orWhere('faqs.content', 'like', "%{$request->title}%");
        }

        // FAQ 상태
        if (isset($request->is_blind)) {
            $faqList->where('faqs.is_blind', $request->is_blind);
        }

        // 타겟 유형
        if (isset($request->type)) {
            $faqList->where('faqs.type', $request->type);
        }

        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $faqList->DurationDate('faqs.created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $faqList->orderBy('faqs.created_at', 'desc')->orderBy('id', 'asc');

        $result = $faqList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.faq.faq-list', compact('result'));
    }

    /**
     * FAQ 상세 화면 보기
     */
    public function faqDetailView(Request $request): View
    {
        $result = Faq::where('id', $request->id)->first();
        return view('admin.faq.faq-detail', compact('result'));
    }

    /**
     * FAQ 등록 화면 조회
     */
    public function faqCreateView(): View
    {
        return view('admin.faq.faq-create');
    }

    /**
     * FAQ 등록
     */
    public function faqCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Faq::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'is_blind' => $request->is_blind
        ]);

        return Redirect::route('admin.faq.list.view')->with('message', 'FAQ를 등록했습니다.');
    }

    /**
     * FAQ 수정
     */
    public function faqUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Faq::where('id', $request->id)->first()
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'is_blind' => $request->is_blind,
            ]);

        return redirect()->to($request->last_url)->with('message', 'FAQ를 수정했습니다.');
    }

    /**
     * FAQ 상태 수정
     */
    public function faqStateUpdate(Request $request): RedirectResponse
    {
        $result = Faq::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', 'FAQ 게시상태를 수정했습니다.');
    }

    /**
     * FAQ 삭제
     */
    public function faqDelete(Request $request): RedirectResponse
    {
        $result = Faq::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', 'FAQ를 삭제했습니다.');
    }
}
