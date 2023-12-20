<?php

namespace App\Http\Controllers\banner;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\SettingBanner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API - banner
|--------------------------------------------------------------------------
|
| - 배너 목록 보기 (O)
| - 배너 상세보기 ()
|
*/

class BannerAPIController extends Controller
{
    /**
     * 배너 목록 보기
     */
    public function bannerList(Request $request)
    {
        $bannerList = Banners::with('images')->select();

        // 타겟 유형
        if (isset($request->type)) {
            $bannerList->where('type', $request->type);
        }
        $bannerList->where('is_blind', 0);

        // 정렬
        $bannerList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $bannerList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, '배너 목록입니다.');
    }
}
