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
| - 건축물대장 표지부 업데이트 (0)
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

            return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '표지부 업데이터를 했습니다.');
        }


        return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '표지부 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrRecapTitleInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrRecapTitleInfo != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrRecapTitleInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

                BrRecapTitleInfo::create([
                'json_data' => $request->BrRecapTitleInfo,
                'target_type' => $request->class,
                'target_id' => $request->id,
            ]);

            return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '총괄표제부 업데이터를 했습니다.');
        }


        return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '총괄표제부 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrFlrOulnInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrFlrOulnInfo != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrFlrOulnInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            BrFlrOulnInfo::create([
                'json_data' => $request->BrFlrOulnInfo,
                'target_type' => $request->class,
                'target_id' => $request->id,
            ]);

            return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '층별개요 업데이터를 했습니다.');
        }


        return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '층별개요 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrExposInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrExposInfo != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrExposInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            BrExposInfo::create([
                'json_data' => $request->BrExposInfo,
                'target_type' => $request->class,
                'target_id' => $request->id,
            ]);

            return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '전유부 업데이터를 했습니다.');
        }


        return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '전유부 업데이터 실패했습니다.');
    }
    /**
     * 건출대장 업데이트
     */
    public function BrExposPubuseAreaInfoUpdate(Request $request): RedirectResponse
    {

        if ($request->BrExposPubuseAreaInfo != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            BrExposPubuseAreaInfo::where('target_id', '=', $request->id)
                ->where('target_type', '=', $request->class)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            BrExposPubuseAreaInfo::create([
                'json_data' => $request->BrExposPubuseAreaInfo,
                'target_type' => $request->class,
                'target_id' => $request->id,
            ]);

            return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '전유공용면적 업데이터를 했습니다.');
        }


        return Redirect::route('admin.knowledgeCenter.detail.view', [$request->id])->with('message', '전유공용면적 업데이터 실패했습니다.');
    }


}
