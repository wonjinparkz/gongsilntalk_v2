<?php

namespace App\Http\Controllers\proposal;

use App\Exports\CorpProposalExport;
use App\Exports\ProposalExport;
use App\Http\Controllers\Controller;
use App\Models\CorpProductAddress;
use App\Models\CorpProposal;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Reply;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;

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

        $result->appends(request()->except('page'));

        return view('admin.proposal.proposal-list', compact('result'));
    }

    /**
     * 매물 제안서 상세 화면 보기
     */
    public function proposaldetailView($id): View
    {
        $result = Proposal::where('id', $id)->first();

        $proposalCount = Proposal::where('users_id', $result->users->id)->count();
        $productCount = Product::where('users_id', $result->users->id)->count();

        return view('admin.proposal.proposal-detail', compact('result', 'proposalCount', 'productCount'));
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
        // 초기 쿼리 작성
        $corpProposalList = CorpProposal::with('users')
            ->select()
            ->where('is_delete', '0');

        // 사용자 필터링
        if ($request->has('phone') || $request->has('name')) {
            $corpProposalList->whereHas('users', function ($query) use ($request) {
                if (isset($request->name)) {
                    $query->where('users.company_name', 'like', "%{$request->name}%");
                }
            });
        }

        // 게시 시작일 필터링
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $corpProposalList->DurationDate('corp_proposal.created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $corpProposalList->orderBy('corp_proposal.created_at', 'desc')
            ->orderBy('corp_proposal.id', 'asc');

        // 쿼리 실행 후 결과 가져오기
        $result = $corpProposalList->get();

        // phone 필드에 대한 후처리 필터링 적용
        if (isset($request->phone)) {
            $result = $result->filter(function ($proposal) use ($request) {
                // 단일 users 관계에서 phone 값을 확인
                return strpos($proposal->users->phone, $request->phone) !== false;
            });
        }

        // 필터링된 결과를 수동으로 페이지네이션 처리
        $perPage = $request->per_page ?? 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedResult = new LengthAwarePaginator(
            $result->forPage($currentPage, $perPage), // 현재 페이지의 데이터
            $result->count(),                         // 전체 데이터 수
            $perPage,                                 // 페이지당 표시할 항목 수
            $currentPage,                             // 현재 페이지 번호
            ['path' => request()->url(), 'query' => request()->query()] // 페이지네이션 URL과 쿼리 파라미터
        );

        return view('admin.proposal.corp-proposal-list', ['result' => $paginatedResult]);
    }

    /**
     * 기업 이전 제안서 상세 화면 보기
     */
    public function corpProposaldetailView($id): View
    {
        $result = CorpProposal::where('id', $id)->first();

        $proposal = CorpProductAddress::select()->where('corp_proposal_id', $id)->get();

        $CorpProposalCount = CorpProposal::where('users_id', $result->users->id)->count();
        $productCount = Product::where('users_id', $result->users->id)->count();
        return view('admin.proposal.corp-proposal-detail', compact('result', 'proposal', 'CorpProposalCount', 'productCount'));
    }

    /**
     * 기업 이전 제안서 정보 다운로드
     */
    public function exportCorpProposal(Request $request)
    {
        return Excel::download(new CorpProposalExport($request), '기업 이전 제안서_' . Carbon::now() . '.xlsx');
    }
}
