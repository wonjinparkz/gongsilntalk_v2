<?php

namespace App\Http\Controllers\consulting;

use App\Http\Controllers\Controller;
use App\Models\ConsultingQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultingController extends Controller
{
    /**
     * 컨설팅 목록 보기
     */
    public function consultingListView(Request $request): View
    {
        $consultingList = ConsultingQuestion::select()->where('is_delete', 0);

        // 검색어
        if (isset($request->name)) {
            $consultingList
                ->where('name', 'like', "%{$request->name}%");
        }

        if (isset($request->state)) {
            $consultingList->where('state', $request->state);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $consultingList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $consultingList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        // 페이징
        $result = $consultingList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.consulting.consulting-list', compact('result'));
    }

    /**
     * 컨설팅 상세 화면 보기
     */
    public function consultingDetailView(Request $request): View
    {
        $result = ConsultingQuestion::where('id', $request->id)->first();

        return view('admin.consulting.consulting-detail', compact('result'));
    }

    /**
     * 컨설팅 상담완료 처리
     */
    public function consultingStateUpdate(Request $request): RedirectResponse
    {
        $result = ConsultingQuestion::where('id', $request->id)->first()
            ->update(['state' => '1']);
        return redirect()->to($request->last_url)->with('message', '상담을 완료 처리했습니다.');
    }

    /**
     * 컨설팅 삭제
     */
    public function consultingDelete(Request $request): RedirectResponse
    {
        $result = ConsultingQuestion::where('id', $request->id)->first()
            ->update(['is_delete' => '1']);
        return back()->with('message', '컨설팅을 삭제했습니다.');
    }
}
