<?php

namespace App\Exports;

use App\Models\KnowledgeCenter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class KnowledgeCenterForUpdateExport implements FromView
{
    use Exportable;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {

        $konwledgeCenterList = KnowledgeCenter::with('floorPlan_files')->select()
            ->where('knowledge_center.is_delete', '=', '0');

        // 건물명
        if (isset($this->request->product_name)) {
            $konwledgeCenterList
                ->where('knowledge_center.product_name', 'like', "%{$this->request->product_name}%");
        }

        // 건물명
        if (isset($this->request->address)) {
            $konwledgeCenterList
                ->where('knowledge_center.address', 'like', "%{$this->request->address}%");
        }

        // 한줄요약
        if (isset($this->request->comments)) {
            $konwledgeCenterList
                ->where('knowledge_center.comments', 'like', "%{$this->request->comments}%");
        }

        // 게시 시작일 from ~ to
        if (isset($this->request->from_created_at) && isset($this->request->to_created_at)) {
            $konwledgeCenterList->DurationDate('created_at', $this->request->from_created_at, $this->request->to_created_at);
        }

        // 정렬
        $konwledgeCenterList->orderBy('knowledge_center.created_at', 'desc')->orderBy('knowledge_center.id', 'asc');

        return view('exports.KnowledgeCenterForUpdate', [
            'result' => $konwledgeCenterList->get()
        ]);
    }

}
