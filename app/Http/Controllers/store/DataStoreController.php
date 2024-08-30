<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\DataStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class DataStoreController extends Controller
{
    /**
     * 상가 목록 보기
     */
    public function storeListView(Request $request): View
    {
        $storeList = DataStore::select();

        // 검색어
        if (isset($request->kstoreName)) {
            $storeList->where('data_store.kstoreName', 'like', "%{$request->kstoreName}%");
        }

        // 정렬
        $storeList->orderBy('data_store.created_at', 'desc')->orderBy('id', 'desc');

        $result = $storeList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.store.store-list', compact('result'));
    }

    /**
     * 상가 등록 보기
     */
    public function storeCreateView(): View
    {
        return view('admin.store.store-create');
    }

    /**
     * 상가 상세 보기
     */
    public function storeDetailView($id): View
    {
        $result = DataStore::where('id', $id)->first();

        return view('admin.store.store-detail', compact('result'));
    }

    /**
     * 상가 등록
     */
    public function storeCreate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'kstoreName' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = DataStore::create([
            'kstoreAddr' => $request->address,
            'pnu' => $request->pnu,
            'x' => $request->address_lng,
            'y' => $request->address_lat,
            'bjdCode' => $request->region_code,
            'as1' => $request->as1,
            'as2' => $request->as2,
            'as3' => $request->as3,
            'as4' => $request->as4,
            'kstoreName' => $request->kstoreName,
            'subwayStation' => $request->subwayStation,
            'subwayLine' => $request->subwayLine,
            'kstoredWtimesub' => $request->kstoredWtimesub,
            'kstoredWtimebus' => $request->kstoredWtimebus,
            'convenientFacility' => $request->convenientFacility,
            'educationFacility' => $request->educationFacility,
            'polygon_coordinates' => $request->polygon_coordinates,
            'characteristics_json' => $request->characteristics_json,
            'useWFS_json' => $request->useWFS_json,
        ]);

        return Redirect::route('admin.store.list.view')->with('message', '상가를 등록했습니다');
    }

    /**
     * 상가 수정
     */
    public function storeUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'kstoreName' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = DataStore::where('id', $request->id)->first();

        $result->update([
            'kstoreAddr' => $request->address,
            'pnu' => $request->pnu,
            'x' => $request->address_lng,
            'y' => $request->address_lat,
            'bjdCode' => $request->region_code,
            'as1' => $request->as1,
            'as2' => $request->as2,
            'as3' => $request->as3,
            'as4' => $request->as4,
            'kstoreName' => $request->kstoreName,
            'subwayStation' => $request->subwayStation,
            'subwayLine' => $request->subwayLine,
            'kstoredWtimesub' => $request->kstoredWtimesub,
            'kstoredWtimebus' => $request->kstoredWtimebus,
            'convenientFacility' => $request->convenientFacility,
            'educationFacility' => $request->educationFacility,
            'polygon_coordinates' => $request->polygon_coordinates,
            'characteristics_json' => $request->characteristics_json,
            'useWFS_json' => $request->useWFS_json,
        ]);

        return redirect()->to($request->lasturl)->with('message', '상가를 수정했습니다');
    }


    /**
     * 상가 상태 수정
     */
    public function storeStateUpdate(Request $request): RedirectResponse
    {
        $result = DataStore::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '상가 게시상태를 수정했습니다.');
    }


    /**
     * 상가 단지 삭제
     */
    public function storeDelete(Request $request): RedirectResponse
    {
        $result = DataStore::where('id', $request->id)->first()
            ->delete();

        return back()->with('message', '상가를 삭제했습니다.');
    }
}
