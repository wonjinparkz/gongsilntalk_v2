<?php

namespace App\Http\Controllers\apt;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 아파트 관리자
|--------------------------------------------------------------------------
|
| - 아파트 단지 목록 보기 (o)
| - 아파트 단지 상세 화면 보기 (o)
| - 아파트 삭제 (o)
| - 아파트 수정 (o)
|
| - 아파트 단지명 목록 보기 (o)
| - 아파트 단지명 상세 화면 보기 (o)
| - 아파트 단지명 삭제 (o)
| - 아파트 단지명 등록 (o)
| - 아파트 단지명 수정 (o)
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
     * 아파트 단지 관리 상세 화면 보기
     */
    public function aptNameDetailView($id): View
    {
        $aptList = DataApt::select('id', 'kaptName')->whereNull('complex_name')->get();

        $result = DataApt::select('id', 'kaptName', 'complex_name')->where('id', $id)->first();

        return view('admin.apt.apt-name-detail', compact('aptList', 'result'));
    }


    /**
     * 아파트 단지명 등록 화면
     */
    public function aptNameCreateView(): View
    {
        $aptList = DataApt::select('id', 'kaptName')->whereNull('complex_name')->get();
        return view('admin.apt.apt-name-create', compact('aptList'));
    }

    /**
     * 아파트 단지명 등록
     */
    public function aptNameCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'apt_id' => 'required|exists:data_apt,id',
            'complex_name' => 'required',
            'complex_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $complex_name = implode(',', $request->complex_name);

        $result = DataApt::where('id', $request->apt_id)->update([
            'id' => $request->apt_id,
            'complex_name' => $complex_name,
        ]);

        return Redirect::route('admin.apt.name.list.view')->with('message', '아파트 유사 단지명을 등록했습니다.');
    }

    public function aptNameDelete(Request $request): RedirectResponse
    {
        $result = DataApt::where('id', $request->id)->first()
            ->update(['complex_name' => Null]);

        return back()->with('message', '아파트 유사 단지명을 삭제했습니다.');
    }
}
