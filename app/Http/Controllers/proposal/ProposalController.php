<?php

namespace App\Http\Controllers\proposal;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Reply;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| 관리자 - 매물 제안서
|--------------------------------------------------------------------------
|
| - 매물 제안서 목록 보기 (X)
| - 매물 제안서 상세 화면 보기 (X)
| - 매물 제안서 등록 화면 조회 (X)
| - 매물 제안서 수정 (X)
| - 매물 제안서 상태 수정 (X)
| - 매물 제안서 삭제 (X)
|
*/


class ProposalController extends Controller
{

    /**
     * 매물 제안서 상세 화면 보기
     */
    public function proposalListView(Request $request): View
    {
        $proposalList = Proposal::with('users')->select();

        // 정렬
        $proposalList->orderBy('proposal.created_at', 'desc')->orderBy('id', 'asc');

        $result = $proposalList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.proposal.proposal-list', compact('result'));
    }

    /**
     * 매물 제안서 상세 화면 보기
     */
    public function proposaldetailView($id): View
    {
        $result = Proposal::where('id', $id)->first();

        // 커뮤니티 댓글 선택
        $ReplyList = Reply::with('rereplies')->select();

        $replys = $ReplyList->paginate(10);
        $replys->appends(request()->except('page'));

        return view('admin.proposal.proposal-detail', compact('result', 'replys'));
    }
}
