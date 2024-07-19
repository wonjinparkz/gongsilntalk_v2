<?php

namespace App\Http\Controllers\interior;

use App\Http\Controllers\Controller;
use App\Models\InteriorEstimate;
use App\Models\InteriorEstimateType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class InteriorEstimatePcController extends Controller
{
    /**
     * 인테리어 견적 등록 페이지
     */
    public function interiorEstimateCreateView(): View
    {
        return view('www.interior.interior_estimate_create');
    }

    /**
     * 인테리어 견적
     */
    public function interiorEstimateCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'area' => 'required',
            'users_count' => 'required',
            'place' => 'required',
            'move_date' => 'required',
            'company_name' => 'required',
            'company_phone' => 'required',
            'user_name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = InteriorEstimate::create([
            'area' => $request->area,
            'users_count' => $request->users_count,
            'place' => $request->place,
            'move_date' => $request->move_date,
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'user_name' => $request->user_name,
        ]);

        if (count($request->type) > 0) {
            foreach ($request->type as $type) {
                InteriorEstimateType::create([
                    'interior_estimate_id' => $result->id,
                    'type' => $type
                ]);
            }
        }

        return Redirect::route('www.main.main')->with('message', '견적서를 등록했습니다.');
    }
}
