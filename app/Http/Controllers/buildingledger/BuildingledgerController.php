<?php

namespace App\Http\Controllers\buildingledger;

use App\Http\Controllers\Controller;
use App\Models\BrTitleInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
/*
|--------------------------------------------------------------------------
| 건축물대장 관리자
|--------------------------------------------------------------------------
|
| - 건축물대장 업데이트
|
*/

class BuildingledgerController extends Controller
{
    /**
     * 건출대장 업데이트
     */
    public function BuildingUpdate(Request $request): RedirectResponse
    {
        Log::info('=========== 업데이트 시작 ===========');
        if ($request->BrTitleInfo != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrTitleInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            BrTitleInfo::create([
                'json_data' => $request->BrTitleInfo,
                'target_type' => $request->class,
                'target_id' => $request->id,
            ]);

            Log::info('=========== 업데이트 종료 ===========');
            return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '표지부 업데이터를 했습니다.');
        }


        return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '표지부 업데이터 실패했습니다.');
    }
}
