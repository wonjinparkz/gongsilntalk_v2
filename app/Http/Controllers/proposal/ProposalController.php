<?php

namespace App\Http\Controllers\proposal;

use App\Exports\CorpProposalExport;
use App\Exports\ProposalExport;
use App\Http\Controllers\Controller;
use App\Models\CorpProposal;
use App\Models\Proposal;
use App\Models\Reply;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| 관리자 - 매물 제안서
|--------------------------------------------------------------------------
|
| - 매물 제안서 목록 보기 (ㅁ)
| - 매물 제안서 상세 화면 보기 (ㅁ)
|
*/


class ProposalController extends Controller
{

    /**
     * 매물 제안서 목록 화면 보기
     */
    public function proposalListView(Request $request): View
    {
        $proposalList = Proposal::with('users')->select()
            ->where('is_delete', '0');

        $proposalList->whereHas('users', function ($query) use ($request) {
            if (isset($request->name)) {
                $query->where('users.name', 'like', "%{$request->name}%")
                    ->orWhere('users.company_name', 'like', "%{$request->name}%");
            }
            if (isset($request->phone)) {
                $query->where('users.phone', 'like', "%{$request->phone}%");
            }
            if (isset($request->member_type)) {
                $query->where('users.type', "$request->member_type");
            }
        });

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $proposalList->DurationDate('proposal.created_at', $request->from_created_at, $request->to_created_at);
        }

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

        return view('admin.proposal.proposal-detail', compact('result'));
    }

    /**
     * 매물 제안서 정보 다운로드
     */
    public function exportProposal(Request $request)
    {
        return Excel::download(new ProposalExport($request), '매물 제안서_' . Carbon::now() . '.xlsx');
    }

    /**
     * 기업 이전 제안서 목록 화면 보기
     */
    public function corpProposalListView(Request $request): View
    {
        $corpProposalList = CorpProposal::with('users')->select()
            ->where('is_delete', '0');

        $corpProposalList->whereHas('users', function ($query) use ($request) {
            if (isset($request->name)) {
                $query->where('users.name', 'like', "%{$request->name}%");
            }
            if (isset($request->phone)) {
                $query->where('users.phone', 'like', "%{$request->phone}%");
            }
            if (isset($request->company_name)) {
                $query->where('users.company_name', 'like', "%{$request->company_name}%");
            }
        });

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $corpProposalList->DurationDate('corp_proposal.created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $corpProposalList->orderBy('corp_proposal.created_at', 'desc')->orderBy('corp_proposal.id', 'asc');

        $result = $corpProposalList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.proposal.corp-proposal-list', compact('result'));
    }

    /**
     * 기업 이전 제안서 상세 화면 보기
     */
    public function corpProposaldetailView($id): View
    {
        $result = CorpProposal::where('id', $id)->first();

        return view('admin.proposal.corp-proposal-detail', compact('result'));
    }

    /**
     * 기업 이전 제안서 정보 다운로드
     */
    public function exportCorpProposal(Request $request)
    {
        return Excel::download(new CorpProposalExport($request), '기업 이전 제안서_' . Carbon::now() . '.xlsx');
    }
}
