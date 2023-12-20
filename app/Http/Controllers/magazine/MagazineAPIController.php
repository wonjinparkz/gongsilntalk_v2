<?php

namespace App\Http\Controllers\magazine;


use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\MagazineBlock;
use App\Models\MagazineCategory;
use App\Models\MagazineScrap;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 매거진 API
|--------------------------------------------------------------------------
|
| - 매거진 목록 보기 (O)
| - 매거진 상세보기 (O)
|
*/

class MagazineAPIController extends Controller
{

    /**
     * 매거진 카테고리 목록 보기
     */
    public function magazineCategoryList(Request $request)
    {
        $result = MagazineCategory::where('is_blind', 0)->orderBy('order', 'asc')->get();
        return $this->sendResponse($result, '매거진 카테고리 목록입니다.');
    }


    /**
     * 매거진 목록 보기
     */
    public function magazineList(Request $request)
    {
        $magazineList = Magazine::with(['images', 'category'])->select();

        // 매거진 상태
        $magazineList->where('is_blind', 0);

        // 매거진 카테고리
        if (isset($request->magazine_category_id)) {
            $magazineList->where('magazine_category_id', $request->magazine_category_id);
        }

        // 사용자 설정에 따라 보여지기
        if (Auth::guard('api')->user() != null) {
            $magazineList->with(['block' => function ($query) {
                $query->where('users_id', Auth::guard('api')->user()->id);
            }]);

            $magazineList->with(['scrap' => function ($query) {
                $query->where('users_id', Auth::guard('api')->user()->id);
            }]);

        }

        // 정렬
        $magazineList->orderBy('created_at', 'desc')->orderBy('id', 'desc');


        $result = $magazineList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, '매거진 목록입니다.');
    }

    /**
     * 매거진 상세 보기
     */
    public function magazineDetail(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $magazine = Magazine::with(['images', 'category'])->where('id', $request->id);

        // 사용자 설정에 따라 보여지기
        if (Auth::guard('api')->user() != null) {
            $magazine->with(['block' => function ($query) {
                $query->where('users_id', Auth::guard('api')->user()->id);
            }]);

            $magazine->with(['scrap' => function ($query) {
                $query->where('users_id', Auth::guard('api')->user()->id);
            }]);

        }

        $magazine->increment('view_count', 1); // 조회수 증가
        $result = $magazine->first();

        return $this->sendResponse($result, '매거진 상세입니다.');
    }
    /**
     * 매거진 상세 웹뷰 보기
     */
    public function magazineDetailContent(Request $request): View
    {
        $magazine = Magazine::where('id', $request->id)->first();
        return view('commons.magazine', compact('magazine'));
    }

    /**
     * 매거진 차단 & 차단 해제
     */
    public function magazineBlock(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:magazine,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }


        $magazineBlock = MagazineBlock::where('magazine_id', $request->id)
            ->where('users_id', Auth::guard('api')->user()->id)
            ->first();

        if ($magazineBlock) {
            $magazineBlock->delete();
            $success["magazine_id"] = $magazineBlock->magazine_id;
            return $this->sendResponse($success, "매거진 차단이 해제되었습니다.");
        } else {
            $created = MagazineBlock::create([
                'users_id' => Auth::guard('api')->user()->id,
                'magazine_id' => $request->id,
            ]);
            return $this->sendResponse($created, "매거진이 차단되었습니다.");
        }
    }

    /**
     * 매거진 차단 목록
     */
    public function magazineBlockList(Request $request)
    {

        $magazineBlockList = MagazineBlock::with('magazine')
            ->where('users_id', Auth::guard('api')->user()->id);

        // 정렬
        $magazineBlockList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $magazineBlockList->paginate($request->per_page == null ? 10 : $request->per_page);
        return $this->sendResponse($result, '매거진 차단 목록입니다.');
    }

    /**
     * 매거진 스크랩 & 스크랩 해제
     */
    public function magazineScrap(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:magazine,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }


        $magazineScrap = MagazineScrap::where('magazine_id', $request->id)
            ->where('users_id', Auth::guard('api')->user()->id)
            ->first();

        if ($magazineScrap) {
            $magazineScrap->delete();
            $success["magazine_id"] = $magazineScrap->magazine_id;
            return $this->sendResponse($success, "매거진 스크랩 해제되었습니다.");
        } else {
            $created = MagazineScrap::create([
                'users_id' => Auth::guard('api')->user()->id,
                'magazine_id' => $request->id,
            ]);
            return $this->sendResponse($created, "매거진이 스크랩되었습니다.");
        }
    }

    /**
     * 매거진 스크랩 목록
     */
    public function magazineScrapList(Request $request)
    {

        $magazineScrapList = MagazineScrap::with('magazine')
            ->where('users_id', Auth::guard('api')->user()->id);

        // 정렬
        $magazineScrapList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $magazineScrapList->paginate($request->per_page == null ? 10 : $request->per_page);
        return $this->sendResponse($result, '매거진 스크랩 목록입니다.');
    }
}
