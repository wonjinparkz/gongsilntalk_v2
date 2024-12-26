<?php

namespace App\Http\Controllers\interior;

use App\Http\Controllers\Controller;
use App\Models\InteriorEstimate;
use App\Models\InteriorEstimateType;
use Illuminate\Http\JsonResponse;
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
     * 인테리어 견적 등록
     */
    public function interiorEstimateCreate(Request $request): JsonResponse
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
            return response()->json(['errors' => $validator->errors()], 422);
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

        $area = $request->area;
        $redirect_url = '';
        if ($area >= 71) {
            $redirect_url = 'https://xn--s39awro00dcgl.com/landing_100';
        } else if ($area < 71 && $area >= 36) {
            $redirect_url = 'https://xn--s39awro00dcgl.com/landing_50';
        } else if ($area < 36 && $area >= 26) {
            $redirect_url = 'https://xn--s39awro00dcgl.com/landing_30';
        } else if ($area < 26 && $area >= 16) {
            $redirect_url = 'https://xn--s39awro00dcgl.com/landing_20';
        } else {
            $redirect_url = 'https://xn--s39awro00dcgl.com/landing_10';
        }

        $this->kakaoSend('121', $request->company_phone, $request->user_name);

        return response()->json(['redirect_url' => $redirect_url, 'message' => '견적서를 등록했습니다.']);
    }
}
