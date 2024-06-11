<?php

namespace App\Http\Controllers\buildingledger;

use App\Exports\KnowledgeCenterExport;
use App\Http\Controllers\Controller;
use App\Models\BrExposInfo;
use App\Models\BrExposPubuseAreaInfo;
use App\Models\BrFlrOulnInfo;
use App\Models\BrRecapTitleInfo;
use App\Models\BrTitleInfo;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| 건축물대장 관리자
|--------------------------------------------------------------------------
|
| - 건축물대장 표제부 업데이트 (0)
| - 건축물대장 총괄표제부 업데이트 ()
| - 건축물대장 층별개요 업데이트 ()
| - 건축물대장 전유부 업데이트 ()
| - 건축물대장 전유공용면적 업데이트 ()
|
*/

class BuildingledgerController extends Controller
{
    /**
     * 건출대장 업데이트
     */
    public function BrTitleInfoUpdate(Request $request): RedirectResponse
    {
        Log::info($request->BrTitleInfo);

        if ($request->BrTitleInfo) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrTitleInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            foreach ($request->BrTitleInfo as $key => $BrTitleInfo) {
                BrTitleInfo::create([
                    'json_data' => $BrTitleInfo,
                    'target_type' => $request->class,
                    'target_id' => $request->id,
                ]);
            }

            return back()->with('message', '표제부 업데이터를 했습니다.');
        }

        return back()->with('message', '표제부 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrRecapTitleInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrRecapTitleInfo) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrRecapTitleInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            foreach ($request->BrRecapTitleInfo as $key => $BrRecapTitleInfo) {
                BrRecapTitleInfo::create([
                    'json_data' => $BrRecapTitleInfo,
                    'target_type' => $request->class,
                    'target_id' => $request->id,
                ]);
            }

            return back()->with('message', '총괄표제부 업데이터를 했습니다.');
        }

        return back()->with('message', '총괄표제부 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrFlrOulnInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrFlrOulnInfo) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrFlrOulnInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            foreach ($request->BrFlrOulnInfo as $key => $BrFlrOulnInfo) {
                BrFlrOulnInfo::create([
                    'json_data' => $BrFlrOulnInfo,
                    'target_type' => $request->class,
                    'target_id' => $request->id,
                ]);
            }

            return back()->with('message', '층별개요 업데이터를 했습니다.');
        }


        return back()->with('message', '층별개요 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrExposInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrExposInfo) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrExposInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);
            foreach ($request->BrExposInfo as $key => $BrExposInfo) {
                BrExposInfo::create([
                    'json_data' => $BrExposInfo,
                    'target_type' => $request->class,
                    'target_id' => $request->id,
                ]);
            }
            return back()->with('message', '전유부 업데이터를 했습니다.');
        }


        return back()->with('message', '전유부 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrExposPubuseAreaInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrExposPubuseAreaInfo) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrExposPubuseAreaInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            foreach ($request->BrExposPubuseAreaInfo as $key => $BrExposPubuseAreaInfo) {
                BrExposPubuseAreaInfo::create([
                    'json_data' => $BrExposPubuseAreaInfo,
                    'target_type' => $request->class,
                    'target_id' => $request->id,
                ]);
            }
            return back()->with('message', '전유공용면적 업데이터를 했습니다.');
        }


        return back()->with('message', '전유공용면적 업데이터 실패했습니다.');
    }
}
