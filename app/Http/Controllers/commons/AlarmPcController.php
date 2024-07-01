<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 알림 읽기
 */
class AlarmPcController extends Controller
{
    // 분양매물 알림 읽기
    public function alarmRead(Request $request)
    {
        $alarm = Alarms::where('id', $request->id)->first();

        Alarms::where('id', $request->id)->update(['readed_at' => Carbon::now()]);

        if ($alarm->index == "106") {
            return redirect(route('www.notice.detail.view', $alarm->target_id));
        }
    }

    // 분양매물 알림 읽기
    public function alarmReadSiteProduct(Request $request)
    {
        $alarm = Alarms::select('target_id')->where('id', $request->id)->first();

        Alarms::where('id', $request->id)->update(['readed_at' => Carbon::now()]);

        return redirect(route('www.site.product.detail.view', $alarm->target_id));
    }
}
