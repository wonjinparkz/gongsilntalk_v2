<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use App\Models\SiteProduct;
use App\Models\SiteProductAlarms;
use App\Models\SiteProductSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * 분양현장 알림 설정
 * - 알림 등록 / 해제
 *
 */
class SiteProductAlarmPcController extends Controller
{
    /**
     * 알림 등록 / 해제
     *
     */
    public function alarm(Request $request)
    {
        $alarm = SiteProductAlarms::where('site_product_id', $request->site_product_id)
            ->where('users_id', Auth::guard('web')->user()->id)
            ->first();

        if ($alarm == null) { // 스크랩이 없을 경우
            $created = SiteProductAlarms::create([
                'users_id' => Auth::guard('web')->user()->id,
                'site_product_id' => $request->site_product_id,
            ]);

            return $this->sendResponse([], "알림이 등록되었습니다.");
        } else { // 스크랩이 있을경우
            $alarm->delete();

            return $this->sendResponse([], "알림이 해제되었습니다.");
        }
    }

    /**
     * 알림 보내기
     */
    public function sendSiteProductAlramDday()
    {

        $today = Carbon::today()->toDateString();
        $todayAlarmList = SiteProductSchedule::whereDate('start_date', $today)->where('is_alarm', 1)->get();
        // $todayAlarmList = SiteProductSchedule::get();

        if (isset($todayAlarmList)) {
            $siteProductIds = $todayAlarmList->pluck('site_product_id')->toArray();
            $ddayAlarmList = SiteProductAlarms::whereIn('site_product_alarms.site_product_id', $siteProductIds)
                ->join('site_product_schedule', 'site_product_alarms.site_product_id', '=', 'site_product_schedule.site_product_id')
                ->join('site_product', function ($join) {
                    $join->on('site_product_alarms.site_product_id', '=', 'site_product.id')
                        ->where('site_product.is_delete', '==', 0);
                })
                ->select('site_product_alarms.*', 'site_product_schedule.title as schedule_title', 'site_product.title as product_title')
                ->get();

            Log::info('todayAlarmList' . $ddayAlarmList);

            foreach ($ddayAlarmList as $alarm) {
                $productTitle = $alarm->product_title;
                $scheduleTitle = $alarm->schedule_title;


                Alarms::Create([
                    'users_id' => $alarm->users_id,
                    'title' => $productTitle . '의 ' . $scheduleTitle . '입니다.',
                    'target_id' => $alarm->site_product_id,
                    'index' => '101',
                    'body' => 'body',
                    'msg' => 'msg'
                ]);


                $data = [
                    'title' => env('APP_NAME'),
                    'body' => $productTitle . '의 ' . $scheduleTitle . '입니다.',
                    'index' => intval(101),
                    'id' => intval($alarm->site_product_id)
                ];

                $user = User::where('id', $alarm->users_id)->where('state', 0)->first();

                if ($user->device_type == "1") {
                    array_push($androidTokens, $user->fcm_key);
                } else if ($user->device_type == "2") {
                    array_push($iosTokens, $user->fcm_key);
                }

                $this->sendAlarm($iosTokens, $androidTokens, $data);
            }
        }
    }

    /**
     * 전날 알림 보내기
     */
    public function sendSiteProductAlramOneday()
    {
        $today = Carbon::today()->toDateString();
        $todayAlarmList = SiteProductSchedule::whereDate('start_date', $today)->where('is_alarm', 1)->get();

        if (isset($todayAlarmList)) {
            $siteProductIds = $todayAlarmList->pluck('site_product_id')->toArray();
            $ddayAlarmList = SiteProductAlarms::whereIn('site_product_alarms.site_product_id', $siteProductIds)
                ->join('site_product_schedule', 'site_product_alarms.site_product_id', '=', 'site_product_schedule.site_product_id')
                ->join('site_product', function ($join) {
                    $join->on('site_product_alarms.site_product_id', '=', 'site_product.id')
                        ->where('site_product.is_delete', '==', 0);
                })
                ->select('site_product_alarms.*', 'site_product_schedule.title as schedule_title', 'site_product.title as product_title')
                ->get();

            Log::info('todayAlarmList' . $ddayAlarmList);

            foreach ($ddayAlarmList as $alarm) {
                $productTitle = $alarm->product_title;
                $scheduleTitle = $alarm->schedule_title;

                Alarms::Create([
                    'users_id' => $alarm->users_id,
                    'title' => $productTitle . '의 ' . $scheduleTitle . '입니다.',
                    'target_id' => $alarm->site_product_id,
                    'index' => '101',
                    'body' => 'body',
                    'msg' => 'msg'
                ]);

                $data = [
                    'title' => env('APP_NAME'),
                    'body' => $productTitle . '의 ' . $scheduleTitle . '입니다.',
                    'index' => intval(101),
                    'id' => intval($alarm->site_product_id)
                ];

                $user = User::where('id', $alarm->users_id)->where('state', 0)->first();

                if ($user->device_type == "1") {
                    array_push($androidTokens, $user->fcm_key);
                } else if ($user->device_type == "2") {
                    array_push($iosTokens, $user->fcm_key);
                }

                $this->sendAlarm($iosTokens, $androidTokens, $data);
            }
        }
    }

    /**
     * 일주일전 알림 보내기
     */
    public function sendSiteProductAlramWeek()
    {
        $today = Carbon::today()->subWeek()->toDateString();
        $todayAlarmList = SiteProductSchedule::whereDate('start_date', $today)->where('is_alarm', 1)->get();

        if (isset($todayAlarmList)) {
            $siteProductIds = $todayAlarmList->pluck('site_product_id')->toArray();
            $ddayAlarmList = SiteProductAlarms::whereIn('site_product_alarms.site_product_id', $siteProductIds)
                ->join('site_product_schedule', 'site_product_alarms.site_product_id', '=', 'site_product_schedule.site_product_id')
                ->join('site_product', function ($join) {
                    $join->on('site_product_alarms.site_product_id', '=', 'site_product.id')
                        ->where('site_product.is_delete', '==', 0);
                })
                ->select('site_product_alarms.*', 'site_product_schedule.title as schedule_title', 'site_product.title as product_title')
                ->get();

            Log::info('todayAlarmList' . $ddayAlarmList);

            foreach ($ddayAlarmList as $alarm) {
                $productTitle = $alarm->product_title;
                $scheduleTitle = $alarm->schedule_title;

                Alarms::Create([
                    'users_id' => $alarm->users_id,
                    'title' => $productTitle . '의 ' . $scheduleTitle . '입니다.',
                    'target_id' => $alarm->site_product_id,
                    'index' => '101',
                    'body' => 'body',
                    'msg' => 'msg'
                ]);

                $data = [
                    'title' => env('APP_NAME'),
                    'body' => $productTitle . '의 ' . $scheduleTitle . '입니다.',
                    'index' => intval(101),
                    'id' => intval($alarm->site_product_id)
                ];

                $user = User::where('id', $alarm->users_id)->where('state', 0)->first();

                if ($user->device_type == "1") {
                    array_push($androidTokens, $user->fcm_key);
                } else if ($user->device_type == "2") {
                    array_push($iosTokens, $user->fcm_key);
                }

                $this->sendAlarm($iosTokens, $androidTokens, $data);
            }
        }
    }
}
