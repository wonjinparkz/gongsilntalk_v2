<?php

namespace App\Http\Controllers\terms;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 이용약관 관리자
|--------------------------------------------------------------------------
|
| - 이용약관 목록 보기
| - 이용약관 실제 미리 보기
| - 이용약관 상세 화면 보기
| - 이용약관 등록 화면 조회
| - 이용약관 등록
| - 이용약관 수정
| - 이용약관 상태 수정
| - 이용약관 삭제
|
*/

class TermsController extends Controller
{
    /**
     * 이용약관 목록 보기
     */
    public function termsListView(Request $request): View
    {

        $termsList = Terms::select();

        // 검색어
        if (isset($request->title)) {
            $termsList->where('terms.title', 'like', "%{$request->title}%");
        }

        // 종류
        if (isset($request->kind)) {
            $termsList->where('terms.kind', $request->kind);
        }

        // 타겟 유형
        if (isset($request->type)) {
            $termsList->where('terms.type', $request->type);
        }

        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $termsList->DurationDate('terms.created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $termsList->orderBy('terms.created_at', 'desc')->orderBy('terms.id', 'desc');

        $result = $termsList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.terms.terms-list', compact('result'));
    }

    /**
     * 약관 상세 화면 보기
     */
    public function termsDetailView($id): View
    {
        $result = Terms::where('id', $id)->first();
        return view('admin.terms.terms-detail', compact('result'));
    }

    /**
     * 약관 등록 화면 조회
     */
    public function termsCreateView(): View
    {
        return view('admin.terms.terms-create');
    }

    /**
     * 약관 등록
     */
    public function termsCreate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required'

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Terms::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'kind' => $request->kind
        ]);

        return Redirect::route('admin.terms.list.view')->with('message', '약관을 등록했습니다.');
    }


    /**
     * 약관 수정
     */
    public function termsUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Terms::where('id', $request->id)->first()
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'kind' => $request->kind
            ]);

        return redirect()->to($request->last_url)->with('message', '약관을 수정했습니다.');
    }

    /**
     * 약관 삭제
     */
    public function termsDelete(Request $request): RedirectResponse
    {
        $result = Terms::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '약관을 삭제했습니다.');
    }

    /**
     * 이용약관 미리보기
     */
    public function termsPreview(Request $request): View
    {
        $list = Terms::where('kind', $request->kind)
            ->where('type', $request->type)
            ->orderBy('created_at', 'desc');

        $result = $list->get();
        if (isset($request->id)) {
            $term = $list->where('id', $request->id)->first();
        } else {
            $term = $list->orderBy('created_at', 'desc')->first();
        }



        return view('commons.terms', compact('result', 'term'));
    }
}
