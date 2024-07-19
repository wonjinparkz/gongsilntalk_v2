<?php

namespace App\Http\Controllers\interior;

use App\Http\Controllers\Controller;
use App\Models\InteriorEstimate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InteriorEstimateController extends Controller
{
    /**
     * 인테리어 견적 목록 보기
     */
    public function interiorEstimateListView(Request $request): View
    {
        $interiorList = InteriorEstimate::select()->with('types');

        // 회사명
        if (isset($request->company_name)) {
            $interiorList->where('company_name', 'like', "%{$request->company_name}%");
        }

        $interiorList->whereHas('types', function ($query) use ($request) {
            // 거래유형
            if (isset($request->type)) {
                $query->where('interior_estimate_type.type', $request->type);
            }
        });

        // 정렬
        $interiorList->orderBy('created_at', 'desc')->orderBy('id', 'asc');

        $result = $interiorList->paginate($request->per_page == null ? 10 : $request->per_page);


        return view('admin.interior.interior-estimate-list', compact('result'));
    }

    /**
     * 인테리어 견적 상세 화면 보기
     */
    public function interiorEstimateDetailView(Request $request): View
    {
        $result = InteriorEstimate::where('id', $request->id)->first();

        return view('admin.interior.interior-estimate-detail', compact('result'));
    }
}
