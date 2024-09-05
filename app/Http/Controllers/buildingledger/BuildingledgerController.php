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
use Illuminate\Support\Facades\DB;
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
     * 건출대장 표제부 업데이트
     */
    public function BrTitleInfoUpdate(Request $request)
    {
        return $this->updateBuildingLedger(
            $request->data,
            BrTitleInfo::class,
            $request->id,
            $request->class,
            '표제부'
        );
    }

    /**
     * 건출대장 총괄표제부 업데이트
     */
    public function BrRecapTitleInfoUpdate(Request $request)
    {
        return $this->updateBuildingLedger(
            $request->data,
            BrRecapTitleInfo::class,
            $request->id,
            $request->class,
            '총괄표제부'
        );
    }

    /**
     * 건출대장 층별개요 업데이트
     */
    public function BrFlrOulnInfoUpdate(Request $request)
    {
        return $this->updateBuildingLedger(
            $request->data,
            BrFlrOulnInfo::class,
            $request->id,
            $request->class,
            '층별개요'
        );
    }

    /**
     * 건출대장 전유부 업데이트
     */
    public function BrExposInfoUpdate(Request $request)
    {
        // 서버로 전달된 데이터 확인을 위한 로그
        Log::info('전송된 BrExposInfo 데이터:', [$request->data]);

        return $this->updateBuildingLedger(
            $request->data,
            BrExposInfo::class,
            $request->id,
            $request->class,
            '전유부'
        );
    }

    /**
     * 건출대장 전유공용면적 업데이트
     */
    public function BrExposPubuseAreaInfoUpdate(Request $request)
    {
        return $this->updateBuildingLedger(
            $request->data,
            BrExposPubuseAreaInfo::class,
            $request->id,
            $request->class,
            '전유공용면적'
        );
    }

    /**
     * 공통 업데이트 처리 메소드
     */
    private function updateBuildingLedger($data, $model, $targetId, $targetType, $message)
    {
        if ($data) {
            DB::beginTransaction();
            try {
                // 기존 데이터 초기화 로그
                Log::info("기존 데이터 초기화 중: target_id={$targetId}, target_type={$targetType}");

                $data = json_decode($data, true);

                // 기존 데이터 초기화
                $model::where('target_id', '=', $targetId)
                    ->where('target_type', '=', $targetType)
                    ->update([
                        'target_type' => null,
                        'target_id' => null,
                    ]);

                // 새로운 데이터 저장
                foreach ($data as $item) {
                    $model::create([
                        'json_data'   => json_encode($item),
                        'target_type' => $targetType,
                        'target_id'   => $targetId,
                    ]);
                }

                DB::commit();
                Log::info("{$message} 업데이트 성공");
                return back()->with('message', "{$message} 업데이트를 완료했습니다.");
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("{$message} 업데이트 실패: " . $e->getMessage());
                return back()->with('error', "{$message} 업데이트에 실패했습니다. 오류: " . $e->getMessage());
            }
        }

        Log::error("{$message} 데이터가 없습니다.");
        return back()->with('error', "{$message} 데이터가 없습니다.");
    }
}
