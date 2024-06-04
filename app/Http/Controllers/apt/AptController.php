<?php

namespace App\Http\Controllers\apt;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 아파트 관리자
|--------------------------------------------------------------------------
|
| - 아파트 단지 목록 보기 (X)
| - 아파트 단지 상세 화면 보기 (X)
| - 아파트 삭제 (X)
|
*/

class AptController extends Controller
{
    /**
     * 아파트 단지 목록 보기
     */
    public function aptComplexListView(Request $request): View
    {
        $aptList = DataApt::select();

        // 검색어
        if (isset($request->kaptName)) {
            $aptList->where('data_apt.kaptName', 'like', "%{$request->kaptName}%");
        }

        // 검색어
        if (isset($request->kaptCode)) {
            $aptList->where('data_apt.kaptCode', 'like', "%{$request->kaptCode}%");
        }

        // 정렬
        $aptList->orderBy('data_apt.created_at', 'desc')->orderBy('id', 'desc');

        $result = $aptList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.apt.apt-complex-list', compact('result'));
    }


    /**
     * 아파트 단지 관리 상세 화면 보기
     */
    public function aptComplexDetailView($id): View
    {
        $result = DataApt::where('id', $id)->first();

        return view('admin.apt.apt-complex-detail', compact('result'));
    }

    /**
     * 아파트 단지 수정
     */
    public function aptComplexUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'kaptName' => 'required|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = DataApt::where('id', $request->id)
            ->update([
                'kaptName' => $request->kaptName,
                'subwayStation' => $request->subwayStation,
                'subwayLine' => $request->subwayLine,
                'kaptdWtimesub' => $request->kaptdWtimesub,
                'kaptdWtimebus' => $request->kaptdWtimebus,
                'convenientFacility' => $request->convenientFacility,
                'educationFacility' => $request->educationFacility,
            ]);

        return redirect()->to($request->lasturl)->with('message', '아파트 단지를 수정했습니다.');
    }

    /**
     * 아파트 단지 삭제
     */
    public function aptComplexDelete(Request $request): RedirectResponse
    {
        $result = DataApt::where('id', $request->id)->first()
            ->delete();

        return back()->with('message', '아파트 단지를 삭제했습니다.');
    }

    /**
     * 아파트 단지 목록 보기
     */
    public function aptNameListView(Request $request): View
    {
        $aptList = DataApt::select()
            ->whereNotNull('complex_name');

        // 검색어
        if (isset($request->kaptName)) {
            $aptList->where('data_apt.kaptName', 'like', "%{$request->kaptName}%");
        }

        // 검색어
        if (isset($request->kaptCode)) {
            $aptList->where('data_apt.kaptCode', 'like', "%{$request->kaptCode}%");
        }

        // 정렬
        $aptList->orderBy('data_apt.created_at', 'desc')->orderBy('id', 'desc');

        $result = $aptList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.apt.apt-name-list', compact('result'));
    }

    /**
     * 아파트 단지명 등록
     */
    public function aptNameCreateView(): View
    {
        $aptList = DataApt::select('id','kaptName')->whereNull('complex_name')->get();
        return view('admin.apt.apt-name-create', compact('aptList'));
    }
}
