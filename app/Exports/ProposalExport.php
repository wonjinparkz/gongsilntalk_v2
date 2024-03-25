<?php

namespace App\Exports;

use App\Models\Proposal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ProposalExport implements FromView
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
        $proposalList->orderBy('proposal.created_at', 'desc')->orderBy('proposal.id', 'asc');

        return view('exports.proposal', [
            'result' => $proposalList->get()
        ]);
    }
}
