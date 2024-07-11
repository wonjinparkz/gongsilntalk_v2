<?php

namespace App\Http\Controllers\knowledgecenter;

use App\Exports\KnowledgeCenterExport;
use App\Exports\KnowledgeCenterForUpdateExport;
use App\Http\Controllers\Controller;
use App\Models\KnowledgeCenter;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

/*
|--------------------------------------------------------------------------
| 관리자 - 지식산업 센터
|--------------------------------------------------------------------------
|
| - 지식산업센터 목록 보기 (0)
| - 지식산업센터 상세 화면 보기 (0)
| - 지식산업센터 등록 화면 조회 (0)
| - 지식산업센터 등록 (0)
| - 지식산업센터 수정 (0)
| - 지식산업센터 상태 수정 (0)
| - 지식산업센터 삭제 (0)
|
*/


class KnowledgeCneter_Controller extends Controller
{
    /**
     * 지식산업센터 목록 보기
     */
    public function knowledgeCenterListView(Request $request): View
    {
        $konwledgeCenterList = KnowledgeCenter::with('floorPlan_files')->select()
            ->where('knowledge_center.is_delete', '=', '0');

        // 건물명
        if (isset($request->product_name)) {
            $konwledgeCenterList
                ->where('knowledge_center.product_name', 'like', "%{$request->product_name}%");
        }

        // 건물명
        if (isset($request->address)) {
            $konwledgeCenterList
                ->where('knowledge_center.address', 'like', "%{$request->address}%");
        }

        // 한줄요약
        if (isset($request->comments)) {
            $konwledgeCenterList
                ->where('knowledge_center.comments', 'like', "%{$request->comments}%");
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $konwledgeCenterList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }


        // 정렬
        $konwledgeCenterList->orderBy('knowledge_center.created_at', 'desc')->orderBy('id', 'asc');

        $result = $konwledgeCenterList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.knowledgeCenter.knowledgeCenter-list', compact('result'));
    }

    /**
     * 지식산업센터 상세 화면 보기
     */
    public function knowledgeCenterDetailView($id): View
    {
        $result = KnowledgeCenter::where('id', $id)->first();

        return view('admin.knowledgeCenter.knowledgeCenter-detail', compact('result'));
    }


    /**
     * 지식산업센터 등록 화면 조회
     */
    public function knowledgeCenterCreateView(): View
    {
        return view('admin.knowledgeCenter.knowledgeCenter-create');
    }

    /**
     * 지식산업센터 등록
     */
    public function knowledgeCentercreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'address_lat' => 'required',
            'address_lng' => 'required',
            'address' => 'required',
            'pnu' => 'required',
            'polygon_coordinates' => 'required',
            'product_name' => 'required|min:1|max:50',
            'subway_name' => 'required',
            'subway_distance' => 'required',
            'completion_date' => 'required|regex:/^\d{4}\d{2}\d{2}$/',
            'sale_min_price' => 'required',
            'sale_mid_price' => 'required',
            'sale_max_price' => 'required',
            'lease_min_price' => 'required',
            'lease_mid_price' => 'required',
            'lease_max_price' => 'required',
            'birdSEyeView_file_ids' => 'required',
            'area' => 'required',
            'square' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'building_area' => 'required',
            'building_square' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'total_floor_area' => 'required',
            'total_floor_square' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'min_floor' => 'required',
            'max_floor' => 'required',
            'parking_count' => 'required',
            'generation_count' => 'required',
            'comments' => 'max:40',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.knowledgeCenter.create.view'))
                ->withErrors($validator)
                ->withInput();
        }

        $result = KnowledgeCenter::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'address_lat' => $request->address_lat,
            'address_lng' => $request->address_lng,
            'address' => $request->address,
            'pnu' => $request->pnu,
            'polygon_coordinates' => $request->polygon_coordinates,
            'characteristics_json' => $request->characteristics_json,
            'useWFS_json' => $request->useWFS_json,
            'product_name' => $request->product_name,
            'subway_name' => $request->subway_name,
            'subway_distance' => $request->subway_distance,
            'subway_time' => $request->subway_time,
            'completion_date' => $request->completion_date,
            'sale_min_price' => $request->sale_min_price,
            'sale_mid_price' => $request->sale_mid_price,
            'sale_max_price' => $request->sale_max_price,
            'lease_min_price' => $request->lease_min_price,
            'lease_mid_price' => $request->lease_mid_price,
            'lease_max_price' => $request->lease_max_price,
            'area' => $request->area,
            'square' => $request->square,
            'building_area' => $request->building_area,
            'building_square' => $request->building_square,
            'total_floor_area' => $request->total_floor_area,
            'total_floor_square' => $request->total_floor_square,
            'min_floor' => $request->min_floor,
            'max_floor' => $request->max_floor,
            'parking_count' => $request->parking_count,
            'generation_count' => $request->generation_count,
            'developer' => $request->developer,
            'comstruction_company' => $request->comstruction_company,
            'traffic_info' => $request->traffic_info,
            'site_contents' => $request->site_contents,
            'comments' => $request->comments,
            'bus_stop_contents' => $request->bus_stop_contents,
            'facilities_contents' => $request->facilities_contents,
            'education_contents' => $request->education_contents,
        ]);

        $this->fileWithCreate($request->birdSEyeView_file_ids, 'birdSEyeView', $result->id);
        $this->fileWithCreate($request->features_file_ids, 'features', $result->id);
        $this->fileWithCreate($request->floorPlan_file_ids, 'floorPlan', $result->id);


        return Redirect::route('admin.knowledgeCenter.list.view')->with('message', '지식산업센터를 등록했습니다.');
    }

    /**
     * 지식산업센터 수정
     */
    public function knowledgeCenterupdate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'address_lat' => 'required',
            'address_lng' => 'required',
            'address' => 'required',
            'pnu' => 'required',
            'polygon_coordinates' => 'required',
            'product_name' => 'required|min:1|max:50',
            'subway_name' => 'required',
            'subway_distance' => 'required',
            'completion_date' => 'required|regex:/^\d{4}\d{2}\d{2}$/',
            'sale_min_price' => 'required',
            'sale_mid_price' => 'required',
            'sale_max_price' => 'required',
            'lease_min_price' => 'required',
            'lease_mid_price' => 'required',
            'lease_max_price' => 'required',
            'birdSEyeView_file_ids' => 'required',
            'area' => 'required',
            'square' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'building_area' => 'required',
            'building_square' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'total_floor_area' => 'required',
            'total_floor_square' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'min_floor' => 'required',
            'max_floor' => 'required',
            'parking_count' => 'required',
            'generation_count' => 'required',
            'comments' => 'max:40',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.knowledgeCenter.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = KnowledgeCenter::where('id', $request->id)
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'address_lat' => $request->address_lat,
                'address_lng' => $request->address_lng,
                'address' => $request->address,
                'pnu' => $request->pnu,
                'polygon_coordinates' => $request->polygon_coordinates,
                'characteristics_json' => $request->characteristics_json,
                'useWFS_json' => $request->useWFS_json,
                'product_name' => $request->product_name,
                'subway_name' => $request->subway_name,
                'subway_distance' => $request->subway_distance,
                'subway_time' => $request->subway_time,
                'completion_date' => $request->completion_date,
                'sale_min_price' => $request->sale_min_price,
                'sale_mid_price' => $request->sale_mid_price,
                'sale_max_price' => $request->sale_max_price,
                'lease_min_price' => $request->lease_min_price,
                'lease_mid_price' => $request->lease_mid_price,
                'lease_max_price' => $request->lease_max_price,
                'area' => $request->area,
                'square' => $request->square,
                'building_area' => $request->building_area,
                'building_square' => $request->building_square,
                'total_floor_area' => $request->total_floor_area,
                'total_floor_square' => $request->total_floor_square,
                'min_floor' => $request->min_floor,
                'max_floor' => $request->max_floor,
                'parking_count' => $request->parking_count,
                'generation_count' => $request->generation_count,
                'developer' => $request->developer,
                'comstruction_company' => $request->comstruction_company,
                'traffic_info' => $request->traffic_info,
                'site_contents' => $request->site_contents,
                'comments' => $request->comments,
                'bus_stop_contents' => $request->bus_stop_contents,
                'facilities_contents' => $request->facilities_contents,
                'education_contents' => $request->education_contents,
            ]);

        $this->fileWithEdit($request->birdSEyeView_file_ids, 'birdSEyeView', $request->id);
        $this->fileWithEdit($request->features_file_ids, 'features', $request->id);
        $this->fileWithEdit($request->floorPlan_file_ids, 'floorPlan', $request->id);


        return Redirect::route('admin.knowledgeCenter.list.view')->with('message', '지식산업센터를 수정했습니다.');
    }

    /**
     * 지식산업센터 상태수정
     */
    public function knowledgeCenterStateUpdate(Request $request): RedirectResponse
    {
        $result = KnowledgeCenter::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '지식산업센터 게시상태를 수정했습니다.');
    }
    /**
     * 지식산업센터 삭제
     */
    public function knowledgeCenterDelete(Request $request): RedirectResponse
    {
        $result = KnowledgeCenter::where('id', $request->id)->first()
            ->update(['is_delete' => $request->is_delete == 0 ? 1 : 0]);

        return back()->with('message', '지식산업센터를 삭제했습니다.');
    }

    /**
     * 지식산업센터 정보 다운로드
     */
    public function exportKnowledgeCenter(Request $request)
    {
        return Excel::download(new KnowledgeCenterExport($request), '지식산업센터_' . Carbon::now() . '.xlsx');
    }
    /**
     * 지식산업센터 업로드 정보 다운로드
     */
    public function exportKnowledgeCenterForUpdate(Request $request)
    {
        return Excel::download(new KnowledgeCenterForUpdateExport($request), '지식산업센터_업데이터용_' . Carbon::now() . '.xlsx');
    }

    public function exportKnowledgeCenterUpdateExcel(Request $request): RedirectResponse
    {
        $file = $request->file('excel_file');

        if ($file) {
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            Log::info("업로드된 파일 이름: $fileName, 파일 크기: $fileSize bytes");
        }

        // Excel 파일을 PhpSpreadsheet 라이브러리를 사용하여 읽기
        $spreadsheet = IOFactory::load($file);

        /// 첫 번째 시트 가져오기
        $sheet = $spreadsheet->getActiveSheet();

        // 첫 번째 행은 헤더로 간주하여 건너뛰기
        $rowIterator = $sheet->getRowIterator();
        $rowIterator->next();

        $startReading = false; // 두 번째 행부터 데이터를 읽기 위한 플래그
        // 각 행을 반복하여 로그에 출력
        foreach ($rowIterator as $row) {
            if ($startReading) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                // 배열에서 각 열의 데이터를 추출
                $id = $rowData[0]; // Id
                $product_name = $rowData[1]; // address
                $address = $rowData[2]; // address
                $sale_min_price = $rowData[3]; // sale_min_price
                $sale_mid_price = $rowData[4]; // sale_mid_price
                $sale_max_price = $rowData[5]; // sale_max_price
                $lease_min_price = $rowData[6]; // lease_min_price
                $lease_mid_price = $rowData[7]; // lease_mid_price
                $lease_max_price = $rowData[8]; // lease_max_price

                // 데이터베이스 업데이트
                KnowledgeCenter::where('id', $id)->update([
                    'sale_min_price' => $sale_min_price,
                    'sale_mid_price' => $sale_mid_price,
                    'sale_max_price' => $sale_max_price,
                    'lease_min_price' => $lease_min_price,
                    'lease_mid_price' => $lease_mid_price,
                    'lease_max_price' => $lease_max_price,
                ]);

            } else {
                $startReading = true;
            }
        }

        // Excel::import($file, function ($rows) {
        //     foreach ($rows as $row) {
        //         Log::info($row);
        // $model = KnowledgeCenter::where('id', $row->id)->first();
        // if ($model) {
        //     $model->name = $row->name;
        //     $model->age = $row->age;
        //     // 필요한 열들을 모두 업데이트합니다.
        //     $model->save();
        // }
        //     }
        // });

        return back()->with('success', '데이터가 업데이트되었습니다.');
    }
}
