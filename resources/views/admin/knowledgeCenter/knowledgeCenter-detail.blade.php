<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'지식산업센터 등록'">
        </x-screen-card>
        {{-- FORM START  --}}

        @inject('carbon', 'Carbon\Carbon')
        <form class="form" method="POST" action="{{ route('admin.knowledgeCenter.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $result->id }}" />
            <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

            <x-screen-card :title="'기본 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 주소 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6"
                            onclick="loadingStart()">주소</label>
                        <div class="col-lg-9 fv-row">
                            <a onclick="getAddress()" class="btn btn-outline mb-md-5"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>
                            <input type="text" name="address" id="address" class="form-control form-control-solid "
                                readonly placeholder=""
                                value="{{ old('address') ? old('address') : $result->address }}" />
                            <input type="hidden" name="pnu" id="pnu" class="form-control form-control-solid "
                                readonly placeholder="" value="{{ old('pnu') ? old('pnu') : $result->pnu }}" />
                            <input type="hidden" name="address_lat" id="address_lat"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('address_lat') ? old('address_lat') : $result->address_lat }} }}" />
                            <input type="hidden" name="address_lng" id="address_lng"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('address_lng') ? old('address_lng') : $result->address_lng }} }}" />
                            <input type="hidden" name="polygon_coordinates" id="polygon_coordinates"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('polygon_coordinates') ? old('polygon_coordinates') : $result->polygon_coordinates }} }}" />
                            <input type="hidden" name="characteristics_json" id="characteristics_json"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('characteristics_json') ? old('characteristics_json') : $result->characteristics_json }} }}" />
                            <input type="hidden" name="useWFS_json" id="useWFS_json"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('useWFS_json') ? old('useWFS_json') : $result->useWFS_json }} }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    {{-- 건물명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">건물명</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="product_name" class="form-control form-control-solid"
                                placeholder="건물명 입력"
                                value="{{ old('product_name') ? old('product_name') : $result->product_name }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />
                        </div>
                    </div>

                    {{-- 지하철 정보 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">지하철 정보</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="subway_name" class="form-control form-control-solid"
                                placeholder="역명"
                                value="{{ old('subway_name') ? old('subway_name') : $result->subway_name }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('subway_name')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="subway_distance" class="form-control form-control-solid"
                                placeholder="거리"
                                value="{{ old('subway_distance') ? old('subway_distance') : $result->subway_distance }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('subway_distance')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="subway_time" class="form-control form-control-solid"
                                placeholder="시간 (분)"
                                value="{{ old('subway_time') ? old('subway_time') : $result->subway_time }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('subway_time')" />
                        </div>
                    </div>

                    {{-- 준공일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">준공일</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="completion_date" class="form-control form-control-solid"
                                placeholder="예) 20230204"
                                value="{{ old('completion_date') ? old('completion_date') : $result->completion_date }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('completion_date')" />
                        </div>
                    </div>

                    {{-- 매매호가 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">매매호가</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="sale_min_price" class="form-control" placeholder="최저가"
                                    value="{{ old('sale_min_price') ? old('sale_min_price') : $result->sale_min_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('sale_min_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="sale_mid_price" class="form-control" placeholder="평균가"
                                    value="{{ old('sale_mid_price') ? old('sale_mid_price') : $result->sale_mid_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('sale_mid_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="sale_max_price" class="form-control" placeholder="최고가"
                                    value="{{ old('sale_max_price') ? old('sale_max_price') : $result->sale_max_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('sale_max_price')" />
                        </div>
                    </div>

                    {{-- 임대호가 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">임대호가</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="lease_min_price" class="form-control" placeholder="최저가"
                                    value="{{ old('lease_min_price') ? old('lease_min_price') : $result->lease_min_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lease_min_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="lease_mid_price" class="form-control" placeholder="평균가"
                                    value="{{ old('lease_mid_price') ? old('lease_mid_price') : $result->lease_mid_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lease_mid_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="lease_max_price" class="form-control" placeholder="최고가"
                                    value="{{ old('lease_max_price') ? old('lease_max_price') : $result->lease_max_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lease_max_price')" />
                        </div>
                    </div>

                    {{-- 조감도 --}}
                    <x-admin-file-picker :title="'조감도'" required="required" cnt='1' id="birdSEyeView"
                        label_col='3' div_col='9' :files="$result->birdSEyeView_files" />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('birdSEyeView_file_ids')" />

                    {{-- 특장점 --}}
                    <x-admin-file-picker :title="'특장점'" required="" cnt='1' id="features"
                        label_col='3' div_col='9' :files="$result->features_files" />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('features_file_ids')" />

                    {{-- 층별도면 --}}
                    <x-admin-file-picker :title="'층별도면'" required="" cnt='1' id="floorPlan"
                        label_col='3' div_col='9' :files="$result->floorPlan_files" />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('floorPlan_file_ids')" />

                </div>

            </x-screen-card>
            <x-screen-card :title="'상세 정보'">
                {{-- FORM START  --}}
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 대지면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">대지면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="area" id="area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('area') ? old('area') : $result->area }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="square" id="square" class="form-control"
                                    onkeyup="imsi(this)" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('square') ? old('square') : $result->square }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('square')" />
                        </div>
                    </div>

                    {{-- 건축면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">건축면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="building_area" id="building_area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('building_area') ? old('building_area') : $result->building_area }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('building_')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('building_')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="building_square" id="building_square"
                                    onkeyup="imsi(this)" class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('building_square') ? old('building_square') : $result->building_square }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_square')" />
                        </div>
                    </div>
                    {{-- 연면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">연면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="total_floor_area" id="total_floor_area"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_area') ? old('total_floor_area') : $result->total_floor_area }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('total_floor_')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('total_floor_')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="total_floor_square" id="total_floor_square"
                                    onkeyup="imsi(this)" class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_square') ? old('total_floor_square') : $result->total_floor_square }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_square')" />
                        </div>
                    </div>

                    {{-- 총 층 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">총 층</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="min_floor" class="form-control" placeholder="최저층"
                                    value="{{ old('min_floor') ? old('min_floor') : $result->min_floor }}" />
                                <span class="input-group-text" id="basic-addon2">층<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('min_floor')" />
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="max_floor" class="form-control" placeholder="최고층"
                                    value="{{ old('max_floor') ? old('max_floor') : $result->max_floor }}" />
                                <span class="input-group-text" id="basic-addon2">층<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('max_floor')" />
                        </div>
                    </div>

                    {{-- 총 주차대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">총 주차대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="parking_count" class="form-control"
                                    placeholder="예) 1234"
                                    value="{{ old('parking_count') ? old('parking_count') : $result->parking_count }}" />
                                <span class="input-group-text" id="basic-addon2">대<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('parking_count')" />
                        </div>
                    </div>

                    {{-- 총 세대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">총 세대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="generation_count" class="form-control"
                                    placeholder="예) 1234"
                                    value="{{ old('generation_count') ? old('generation_count') : $result->generation_count }}" />
                                <span class="input-group-text" id="basic-addon2">실<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('generation_count')" />
                        </div>
                    </div>

                    {{-- 시행사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">시행사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="developer" class="form-control form-control-solid"
                                placeholder="시행사명 입력"
                                value="{{ old('developer') ? old('developer') : $result->developer }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('developer')" />
                        </div>
                    </div>

                    {{-- 시공사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">시공사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comstruction_company" class="form-control form-control-solid"
                                placeholder="시공사명 입력"
                                value="{{ old('comstruction_company') ? old('comstruction_company') : $result->comstruction_company }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comstruction_company')" />
                        </div>
                    </div>

                    {{-- 교통정보 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">교통정보</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="traffic_info" class="form-control form-control-solid mb-5" rows="5"
                                placeholder="주변 교통관련 정보를 입력해주세요.">{{ old('traffic_info') ? old('traffic_info') : $result->traffic_info }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('traffic_info')" />
                        </div>
                    </div>

                    {{-- 현장설명 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">현장설명</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="site_contents" class="form-control form-control-solid mb-5" rows="5"
                                placeholder="주변 편의시설, 역세권 등의 정보를 입력해주세요.">{{ old('site_contents') ? old('site_contents') : $result->site_contents }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('site_contents')" />
                        </div>
                    </div>

                    {{-- 한줄 요약 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">한줄 요약</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comments" class="form-control form-control-solid"
                                placeholder="40자 내로 한줄 요약을 입력해주세요."
                                value="{{ old('comments') ? old('comments') : $result->comments }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comments')" />
                        </div>
                    </div>

                    {{-- 버스 정류장 거리 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">버스 정류장 거리</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="bus_stop_contents" class="form-control form-control-solid mb-5" rows="5"
                                placeholder="버스 정류장과의 거리를 입력하세요.">{{ old('bus_stop_contents') ? old('bus_stop_contents') : $result->bus_stop_contents }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('bus_stop_contents')" />
                        </div>
                    </div>

                    {{-- 편의 시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">편의 시설</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="facilities_contents" class="form-control form-control-solid mb-5" rows="5"
                                placeholder="주변 편의 시설을 입력하세요.">{{ old('facilities_contents') ? old('facilities_contents') : $result->facilities_contents }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('facilities_contents')" />
                        </div>
                    </div>

                    {{-- 교육시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">교육시설</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="education_contents" class="form-control form-control-solid mb-5" rows="5"
                                placeholder="주변 교 시설을 입력하세요.">{{ old('education_contents') ? old('education_contents') : $result->education_contents }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('education_contents')" />
                        </div>
                    </div>



                    {{-- Footer Bottom START --}}
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary">수정</button>
                    </div>
                    {{-- Footer END --}}
                </div>
            </x-screen-card>

        </form>
        {{-- FORM END --}}
        <x-screen-card :title="'건축물 대장'">
            {{-- FORM START  --}}
            @csrf
            {{-- 내용 START --}}
            <div class="card-body border-top p-9">
                <form action="{{ route('admin.buildingledger.brtitleinfo.update') }}" id="BrTitleInfo_submit" method="POST">
                    <input type="hidden" name="id" id="id" value="{{ $result->id }}">
                    <input type="hidden" name="class" id="class" value="AppModelsKnowledgeCenter">
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">표지부</label>
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                            {{ $result->BrTitleInfo ? $carbon::parse($result->BrTitleInfo->created_at)->format('Y.m.d') : '-' }}</label>
                        <input type="hidden" name="BrTitleInfo" id="BrTitleInfo"
                            class="form-control form-control-solid " readonly placeholder=""
                            value="{{ old('BrTitleInfo') ? old('BrTitleInfo') : $result->BrTitleInfo->json_data ?? '' }}" />
                        <div class="col-lg-4 fv-row">
                            <a onclick="get_buildingledger('{{ $result->pnu }}', 'BrTitleInfo')"
                                class="btn btn-secondary">업데이트</a>
                        </div>
                    </div>
                </form>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">총괄표제부</label>
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                        {{ $result->BrRecapTitleInfo ? $carbon::parse($result->BrRecapTitleInfo->created_at)->format('Y.m.d') : '-' }}</label>
                    <input type="hidden" name="BrRecapTitleInfo" id="BrRecapTitleInfo"
                        class="form-control form-control-solid " readonly placeholder=""
                        value="{{ old('BrRecapTitleInfo') ? old('BrRecapTitleInfo') : $result->BrRecapTitleInfo->json_data ?? '' }}" />
                    <div class="col-lg-4 fv-row">
                        <button
                            onclick="get_buildingledger('{{ $result->pnu }}', 'BrRecapTitleInfo', 'App\\Models\\KnowledgeCenter')"
                            class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">층별개요</label>
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                        {{ $result->BrFlrOulnInfo ? $carbon::parse($result->BrFlrOulnInfo->created_at)->format('Y.m.d') : '-' }}</label>
                    <input type="hidden" name="BrFlrOulnInfo" id="BrFlrOulnInfo"
                        class="form-control form-control-solid " readonly placeholder=""
                        value="{{ old('BrFlrOulnInfo') ? old('BrFlrOulnInfo') : $result->BrFlrOulnInfo->json_data ?? '' }}" />
                    <div class="col-lg-4 fv-row">
                        <button
                            onclick="get_buildingledger('{{ $result->pnu }}', 'BrFlrOulnInfo', 'App\\Models\\KnowledgeCenter')"
                            class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전유부</label>
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                        {{ $result->BrExposInfo ? $carbon::parse($result->BrExposInfo->created_at)->format('Y.m.d') : '-' }}</label>
                    <input type="hidden" name="BrExposInfo" id="BrExposInfo"
                        class="form-control form-control-solid " readonly placeholder=""
                        value="{{ old('BrExposInfo') ? old('BrExposInfo') : $result->BrExposInfo->json_data ?? '' }}" />
                    <div class="col-lg-4 fv-row">
                        <button
                            onclick="get_buildingledger('{{ $result->pnu }}', 'BrExposInfo', 'App\\Models\\KnowledgeCenter')"
                            class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전유공용면적</label>
                    <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                        {{ $result->BrExposPubuseAreaInfo ? $carbon::parse($result->BrExposPubuseAreaInfo->created_at)->format('Y.m.d') : '-' }}</label>
                    <input type="hidden" name="BrExposPubuseAreaInfo" id="BrExposPubuseAreaInfo"
                        class="form-control form-control-solid " readonly placeholder=""
                        value="{{ old('BrExposPubuseAreaInfo') ? old('BrExposPubuseAreaInfo') : $result->BrExposPubuseAreaInfo->json_data ?? '' }}" />
                    <div class="col-lg-4 fv-row">
                        <button
                            onclick="get_buildingledger('{{ $result->pnu }}', 'BrExposPubuseAreaInfo', 'App\\Models\\KnowledgeCenter')"
                            class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
            </div>

        </x-screen-card>
    </div>

    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var prev = "";
        var regexp = /^\d*(\.\d{0,2})?$/;

        function imsi(obj) {
            if (obj.value.search(regexp) == -1) {
                obj.value = prev;
            } else {
                prev = obj.value;
            }
        }


        function square_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();
            if (square > 0) {
                var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
                $('#' + area_name).val(convertedArea);
            }

        }

        function area_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();
            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
            }

        }
        // 생성된 태그 삭제
        function add_delete(element) {
            // 클릭한 <a> 태그의 부모 <li> 요소 가져오기
            var listItem = element.parentNode;

            // 부모 <li> 요소 제거
            listItem.parentNode.removeChild(listItem);
        }
    </script>
</x-admin-layout>

<script language="javascript">
    // opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
    // document.domain = "{{ env('APP_URL') }}";

    function getAddress() {
        //IE에서 opener관련 오류가 발생하는 경우, window에 이름을 명시해줍니다.
        window.name = "jusoPopup";

        //주소검색을 수행할 팝업 페이지를 호출합니다.
        //호출된 페이지(jusoPopup.jsp)에서 실제 주소검색URL(https://business.juso.go.kr/addrlink/addrLinkUrlJsonp.do)를 호출하게 됩니다.
        var pop = window.open("{{ route('api.popupOpen.getAddress') }}", "pop",
            "width=570,height=420, scrollbars=yes, resizable=yes");
    }


    function jusoCallBack(rtRoadFullAddr, rtAddrPart1, rtAddrDetail, rtAddrPart2, rtEngAddr, rtJibunAddr, rtZipNo,
        rtAdmCd, rtRnMgtSn, rtBdMgtSn, rtDetBdNmList, rtBdNm, rtBdKdcd, rtSiNm, rtSggNm, rtEmdNm, rtLiNm, rtRn,
        rtUdrtYn, rtBuldMnnm, rtBuldSlno, rtMtYn, rtLnbrMnnm, rtLnbrSlno, rtEmdNo, relJibun, rtentX, rtentY) {
        // 팝업페이지에서 주소입력한 정보를 받아서, 현 페이지에 정보를 등록합니다.
        $('input[name=address]').val(rtRoadFullAddr);

        // console.log('RoadFullAddr:', rtRoadFullAddr);
        // console.log('AddrPart1:', rtAddrPart1);
        // console.log('AddrDetail:', rtAddrDetail);
        // console.log('AddrPart2:', rtAddrPart2);
        // console.log('EngAddr:', rtEngAddr);
        // console.log('JibunAddr:', rtJibunAddr);
        // console.log('ZipNo:', rtZipNo);
        // console.log('AdmCd:', rtAdmCd);
        // console.log('RnMgtSn:', rtRnMgtSn);
        // console.log('BdMgtSn:', rtBdMgtSn);
        // console.log('DetBdNmList:', rtDetBdNmList);
        // console.log('BdNm:', rtBdNm);
        // console.log('BdKdcd:', rtBdKdcd);
        // console.log('SiNm:', rtSiNm);
        // console.log('SggNm:', rtSggNm);
        // console.log('EmdNm:', rtEmdNm);
        // console.log('LiNm:', rtLiNm);
        // console.log('Rn:', rtRn);
        // console.log('UdrtYn:', rtUdrtYn);
        // console.log('BuldMnnm:', rtBuldMnnm);
        // console.log('BuldSlno:', rtBuldSlno);
        // console.log('MtYn:', rtMtYn);
        // console.log('LnbrMnnm:', rtLnbrMnnm);
        // console.log('LnbrSlno:', rtLnbrSlno);
        // console.log('EmdNo:', rtEmdNo);
        // console.log('lJibun:', relJibun);
        // console.log('entX:', rtentX);
        // console.log('entY:', rtentY);

        var AdmCd = String(rtAdmCd);
        var MtYn = rtMtYn == '0' ? '1' : '2';
        var LnbrMnnm = String(rtLnbrMnnm).padStart(4, '0');
        var LnbrSlno = String(rtLnbrSlno).padStart(4, '0');

        var pnu = AdmCd + MtYn + LnbrMnnm + LnbrSlno;

        $('input[name=pnu]').val(pnu);

        gte_useWFS(pnu);
        get_coordinates(pnu);
        get_characteristics(pnu);

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

    }

    function json_check() {
        var characteristics = $('#useWFS_json').val();
        var parsedData = JSON.parse(characteristics);

        for (var key in parsedData) {
            if (parsedData.hasOwnProperty(key)) {
                var value = parsedData[key];
                console.log("키:", key, ", 값:", value);
            }
        }
    }

    function buildingledgerUpdate() {
        var data = {};
        data.pageNo = "1"; /* 페이지 번호 */

        $.ajax({
            type: "get",
            dataType: "jsonp",
            data: data,
            async: true,
            success: function(data) {

            },
            error: function(xhr, stat, err) {}
        });
    }
</script>
