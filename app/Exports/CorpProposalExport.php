<?php

namespace App\Exports;

use App\Models\CorpProposal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class CorpProposalExport implements FromView
{
    use Exportable;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $request = $this->request;

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


        return view('exports.corpProposal', [
            'result' => $result
        ]);
    }
}
