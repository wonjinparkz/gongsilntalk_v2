<?php

namespace App\Http\Controllers\apt;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $aptList = DataApt::with([
            'BrTitleInfo',
            'BrRecapTitleInfo',
            'BrFlrOulnInfo',
            'BrExposInfo',
            'BrExposPubuseAreaInfo',
        ]);

        // 검색어
        if (isset($request->kaptName)) {
            $aptList->where('data_apt.kaptName', 'like', "%{$request->kaptName}%");
        }

        // 검색어
        if (isset($request->kaptCode)) {
            $aptList->where('data_apt.kaptCode', 'like', "%{$request->kaptCode}%");
        }

        // 정렬
        $aptList->orderBy('data_apt.created_at', 'desc')->orderBy('data_apt.id', 'desc');

        $result = $aptList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        foreach ($result as $apt) {
            $transactions = $apt->transactions();
            $apt->transactions_count = $transactions->count();
            $latestTransactions = $transactions->orderByRaw('year DESC, month DESC, day DESC')->first();
            $apt->latest_transactionsDate = $latestTransactions ? $latestTransactions->year . '.' . str_pad($latestTransactions->month, 2, '0', STR_PAD_LEFT) . '.' . str_pad($latestTransactions->day, 2, '0', STR_PAD_LEFT) : '-';

            $transactionsRent = $apt->transactionsRent();
            $apt->transactionsRent_count = $transactionsRent->count();
            $latestTransactionsRent = $transactionsRent->orderByRaw('year DESC, month DESC, day DESC')->first();
            $apt->latest_transactionsRentDate = $latestTransactionsRent ? $latestTransactionsRent->year . '.' . str_pad($latestTransactionsRent->month, 2, '0', STR_PAD_LEFT) . '.' . str_pad($latestTransactionsRent->day, 2, '0', STR_PAD_LEFT) : '-';


            $latestInfo = collect([
                optional($apt->BrTitleInfo)->first(),
                optional($apt->BrRecapTitleInfo)->first(),
                optional($apt->BrFlrOulnInfo)->first(),
                optional($apt->BrExposInfo)->first(),
                optional($apt->BrExposPubuseAreaInfo)->first(),
            ])->filter()->sortByDesc('created_at')->first();

            $apt->latestInfo = $latestInfo;
        }

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
                'is_pnu' => $request->pnu > 0 ? 1 : 0,
                'pnu' => $request->pnu,
                'is_polygon_coordinates' => $request->polygon_coordinates != '' ? 1 : 0,
                'polygon_coordinates' => $request->polygon_coordinates,
                'is_characteristics' => $request->characteristics_json != '' ? 1 : 0,
                'characteristics_json' => $request->characteristics_json,
                'is_useWFS' => $request->useWFS_json != '' ? 1 : 0,
                'useWFS_json' => $request->useWFS_json,
                'x' => $request->address_lng,
                'y' => $request->address_lat,
                'kaptName' => $request->kaptName,
                'bjdCode' => $request->region_code,
                'as1' => $request->as1,
                'as2' => $request->as2,
                'as3' => $request->as3,
                'as4' => $request->as4,
                'kaptAddr' => $request->address,
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

        $result->appends(request()->except('page'));

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
