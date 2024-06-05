<?php

namespace App\Http\Controllers\building;

use App\Http\Controllers\Controller;
use App\Models\DataBuilding;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class DataBuildingController extends Controller
{
    /**
     * 건물 목록 보기
     */
    public function buildingListView(Request $request): View
    {
        $buildingList = DataBuilding::select();

        // 검색어
        if (isset($request->kbuildingName)) {
            $buildingList->where('data_building.kbuildingName', 'like', "%{$request->kbuildingName}%");
        }

        // 정렬
        $buildingList->orderBy('data_building.created_at', 'desc')->orderBy('id', 'desc');

        $result = $buildingList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.building.building-list', compact('result'));
    }

    /**
     * 건물 등록 보기
     */
    public function buildingCreateView(): View
    {
        return view('admin.building.building-create');
    }

    /**
     * 건물 상세 보기
     */
    public function buildingDetailView($id): View
    {
        $result = DataBuilding::where('id', $id)->first();

        return view('admin.building.building-detail', compact('result'));
    }

    /**
     * 건물 등록
     */
    public function buildingCreate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'kbuildingName' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = DataBuilding::create([
            'kbuildingAddr' => $request->address,
            'pnu' => $request->pnu,
            'x' => $request->address_lng,
            'y' => $request->address_lat,
            'bjdCode' => $request->bjdCode,
            'as1' => $request->as1,
            'as2' => $request->as2,
            'as3' => $request->as3,
            'as4' => $request->as4,
            'kbuildingName' => $request->kbuildingName,
            'subwayStation' => $request->subwayStation,
            'subwayLine' => $request->subwayLine,
            'kbuildingdWtimesub' => $request->kbuildingdWtimesub,
            'kbuildingdWtimebus' => $request->kbuildingdWtimebus,
            'convenientFacility' => $request->convenientFacility,
            'educationFacility' => $request->educationFacility,
            'polygon_coordinates' => $request->polygon_coordinates,
            'characteristics_json' => $request->characteristics_json,
            'useWFS_json' => $request->useWFS_json,
        ]);

        return Redirect::route('admin.building.list.view')->with('message', '건물을 등록했습니다');
    }


    /**
     * 건물 상태 수정
     */
    public function buildingStateUpdate(Request $request): RedirectResponse
    {
        $result = DataBuilding::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '건물 게시상태를 수정했습니다.');
    }


    /**
     * 건물 삭제
     */
    public function buildingDelete(Request $request): RedirectResponse
    {
        $result = DataBuilding::where('id', $request->id)->first()
            ->delete();

        return back()->with('message', '건물을 삭제했습니다.');
    }
}
