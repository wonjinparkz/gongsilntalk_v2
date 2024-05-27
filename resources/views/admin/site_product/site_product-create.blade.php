<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'분양현장 매물 등록'">
        </x-screen-card>
        {{-- FORM START  --}}
        <form class="form" method="POST" action="{{ route('admin.site.product.create') }}">
            @csrf
            <x-screen-card :title="'기본 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 지역 선택 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">지역
                            선택{{ old('region_type') }}</label>
                        <div class="col-lg-9 fv-row">
                            @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                                <label class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                    <input class="form-check-input" name="region_type" type="radio"
                                        value="{{ $i }}" @if (old('region_type') == $i) checked @endif>
                                    <span
                                        class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.site_product_region_type.' . $i) }}</span>
                                </label>
                            @endfor
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('region_type')" />
                        </div>
                    </div>

                    {{-- 주소 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                        <div class="col-lg-9 fv-row">
                            <a onclick="getAddress()" class="btn btn-outline mb-md-5"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>
                            <input type="text" name="address" id="address" class="form-control form-control-solid"
                                readonly placeholder="" value="{{ old('address') }}" />
                            <input type="hidden" name="region_code" id="region_code" class="form-control " readonly
                                placeholder="" value="{{ old('region_code') }}" />
                            <input type="hidden" name="region_address" id="region_address" class="form-control "
                                readonly placeholder="" value="{{ old('region_address') }}" />
                            <input type="hidden" name="address_lat" id="address_lat" class="form-control " readonly
                                placeholder="" value="{{ old('address_lat') }}" />
                            <input type="hidden" name="address_lng" id="address_lng" class="form-control " readonly
                                placeholder="" value="{{ old('address_lng') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    {{-- 건물명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">건물명</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="product_name" class="form-control" placeholder="건물명 입력"
                                value="{{ old('product_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />
                        </div>
                    </div>

                    {{-- 대표 이미지 --}}
                    <x-admin-image-picker :title="'대표 이미지'" required="required" cnt='1' id="siteProductMain"
                        label_col='2' div_col='9' />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('siteProductMain_image_ids')" />

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">제목</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title" class="form-control" placeholder="제목 입력"
                                value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />
                        </div>
                    </div>

                    {{-- 세부 내용 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">세부 내용</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="contents" class="form-control mb-5" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('contents')" />
                        </div>
                    </div>

                    {{-- 한줄 요약 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">한줄 요약</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comments" class="form-control" placeholder="한줄 요약을 입력해주세요."
                                value="{{ old('comments') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comments')" />
                        </div>
                    </div>


                    {{-- 규모 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">규모</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="number" name="min_floor" class="form-control" placeholder="최저"
                                    value="{{ old('min_floor') }}" />
                                <span class="input-group-text" id="basic-addon2">층</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('min_floor')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="number" name="max_floor" class="form-control" placeholder="최고"
                                    value="{{ old('max_floor') }}" />
                                <span class="input-group-text" id="basic-addon2">층</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('max_floor')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="number" name="dong_count" class="form-control" placeholder="총 동수"
                                    value="{{ old('dong_count') }}" />
                                <span class="input-group-text" id="basic-addon2">개동</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('dong_count')" />
                        </div>
                    </div>


                    {{-- 주차대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주차대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="parking_count" class="form-control" placeholder=""
                                    value="{{ old('parking_count') }}" />
                                <span class="input-group-text" id="basic-addon2">대</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('parking_count')" />
                        </div>
                    </div>

                    {{-- 총 세대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">총 세대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="generation_count" class="form-control" placeholder=""
                                    value="{{ old('generation_count') }}" />
                                <span class="input-group-text" id="basic-addon2">대</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('generation_count')" />
                        </div>
                    </div>

                    {{-- 대지면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">대지면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="area" id="area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('area') }}" />
                                <span class="input-group-text" id="basic-addon2">평</span>
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
                                    onkeyup="imsi(this)" placeholder="변환 버튼을 눌러주세요." value="{{ old('square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('square')" />
                        </div>
                    </div>

                    {{-- 건축면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">건축면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="building_area" id="building_area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('building_area') }}" />
                                <span class="input-group-text" id="basic-addon2">평</span>
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
                                    value="{{ old('building_square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_square')" />
                        </div>
                    </div>

                    {{-- 연면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">연면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="total_floor_area" id="total_floor_area"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_area') }}" />
                                <span class="input-group-text" id="basic-addon2">평</span>
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
                                    value="{{ old('total_floor_square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_square')" />
                        </div>
                    </div>

                    {{-- 용적률/건폐율 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">용적률/건폐율</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="floor_area_ratio" class="form-control"
                                    onkeyup="imsi(this)" placeholder="용적률" value="{{ old('floor_area_ratio') }}" />
                                <span class="input-group-text" id="basic-addon2">만원</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('floor_area_ratio')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="builging_ratio" class="form-control"
                                    onkeyup="imsi(this)" placeholder="건폐율" value="{{ old('builging_ratio') }}" />
                                <span class="input-group-text" id="basic-addon2">만원</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('builging_ratio')" />
                        </div>
                    </div>

                    {{-- 준공일 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">준공일</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="completion_date" class="form-control" maxlength="8"
                                placeholder="예) 20230204" value="{{ old('completion_date') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('completion_date')" />
                        </div>
                    </div>

                    {{-- 입주예정 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">입주예정</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="expected_move_date" class="form-control" maxlength="6"
                                placeholder="예) 202302" value="{{ old('expected_move_date') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('expected_move_date')" />
                        </div>
                    </div>

                    {{-- 시행사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">시행사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="developer" class="form-control" placeholder="시행사"
                                value="{{ old('developer') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('developer')" />
                        </div>
                    </div>

                    {{-- 시공사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">시공사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comstruction_company" class="form-control" placeholder="시공사"
                                value="{{ old('comstruction_company') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comstruction_company')" />
                        </div>
                    </div>

                    {{-- 3D 이미지 (1장) --}}
                    <x-admin-file-picker :title="'3D 이미지 (1장)'" required="" cnt='1' id="dimension"
                        label_col='2' div_col='9' />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('dimension_file_ids')" />

                </div>

            </x-screen-card>
            <x-screen-card :title="'층별 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    <div class="dong-container">

                        @foreach (old('dong_info', []) as $dongIndex => $dongInfo)
                            <div class="row mb-6 dong_row" data-index="{{ $dongIndex }}">
                                <div class="col-lg-12 row mb-6">
                                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">동이름</label>
                                    <div class="col-lg-6 fv-row">
                                        <input type="text" name="dong_info[{{ $dongIndex }}][dong_name]"
                                            class="form-control" placeholder="동이름"
                                            value="{{ $dongInfo['dong_name'] }}" />
                                    </div>
                                    <div class="col-lg-4 fv-row">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary dong-delete">동 삭제</button>
                                        </div>
                                    </div>
                                </div>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('dong_info.' . $dongIndex . '.dong_name')" />

                                <div class="col-lg-12 row mb-6">
                                    <div class="col-lg-2 fv-row d-flex flex-column justify-content-center">
                                        <label class="required col-form-label fw-semibold fs-6 align-self-start">층
                                            정보</label>
                                        <button type="button" class="btn btn-warning btn-sm add-floor"
                                            data-dong-index="{{ $dongIndex }}">층 정보 추가</button>
                                    </div>
                                    <div class="col-lg-10 fv-row floor-container"
                                        data-floor-container-index="{{ $dongIndex }}">
                                        @foreach (old('dong_info')[$dongIndex]['floor_info'] ?? [] as $floorIndex => $floorInfo)
                                            <div class="row floor_row col-lg-12 mb-1"
                                                data-floor-index="{{ $floorIndex }}">
                                                <div class="row col-lg-10">
                                                    <div class="row mb-5">
                                                        <label
                                                            class="required col-lg-2 col-form-label fw-semibold fs-6">층
                                                            명</label>
                                                        <div class="col-lg-5 fv-row">
                                                            <input type="text"
                                                                name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][floor_name]"
                                                                class="form-control" placeholder="층 명"
                                                                value="{{ $floorInfo['floor_name'] }}" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-5">
                                                        <label
                                                            class="required col-lg-2 col-form-label fw-semibold fs-6">용도구분</label>
                                                        <div class="col-lg-10 fv-row">
                                                            <label
                                                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                                                <input class="form-check-input"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][is_neighborhood_life]"
                                                                    type="checkbox" value="1"
                                                                    @if ($floorInfo['is_neighborhood_life'] ?? 0) checked @endif>
                                                                <span class="fw-semibold ps-2">근생지원시설</span>
                                                            </label>
                                                            <label
                                                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                                                <input class="form-check-input"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][is_industry_center]"
                                                                    type="checkbox" value="1"
                                                                    @if ($floorInfo['is_industry_center'] ?? 0) checked @endif>
                                                                <span class="fw-semibold ps-2">지식산업센터</span>
                                                            </label>
                                                            <label
                                                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                                                <input class="form-check-input"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][is_warehouse]"
                                                                    type="checkbox" value="1"
                                                                    @if ($floorInfo['is_warehouse'] ?? 0) checked @endif>
                                                                <span class="fw-semibold ps-2">공동창고</span>
                                                            </label>
                                                            <label
                                                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                                                <input class="form-check-input"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][is_dormitory]"
                                                                    type="checkbox" value="1"
                                                                    @if ($floorInfo['is_dormitory'] ?? 0) checked @endif>
                                                                <span class="fw-semibold ps-2">기숙사,유치원</span>
                                                            </label>
                                                            <label
                                                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                                                <input class="form-check-input"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][is_business_support]"
                                                                    type="checkbox" value="1"
                                                                    @if ($floorInfo['is_business_support'] ?? 0) checked @endif>
                                                                <span class="fw-semibold ps-2">업무지원시설</span>
                                                            </label>
                                                        </div>
                                                        <div class="row mb-6">
                                                            <label
                                                                class="required col-lg-2 col-form-label fw-semibold fs-6">도면</label>
                                                            <div class="col-lg-9 file-upload-container">
                                                                <label class="custom-file-label"
                                                                    for="fileInput_{{ $dongIndex }}_{{ $floorIndex }}">파일
                                                                    선택</label>
                                                                <input type="file" accept="image/*"
                                                                    id="fileInput_{{ $dongIndex }}_{{ $floorIndex }}"
                                                                    style="display:none" name=""
                                                                    value="" onchange="uploadFloorFile(this)">
                                                                <span id="fileName"
                                                                    class="file-name">{{ $floorInfo['floor_image_text'] }}</span>
                                                                <input type="hidden"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][floor_image_idxs][]"
                                                                    value="{{ $floorInfo['floor_image_idxs'] }}">
                                                                <input type="hidden" class="file-nameValue"
                                                                    name="dong_info[{{ $dongIndex }}][floor_info][{{ $floorIndex }}][floor_image_text]"
                                                                    value="{{ $floorInfo['floor_image_text'] }}">
                                                            </div>
                                                            <x-input-error class="mt-2 text-danger"
                                                                :messages="$errors->get(
                                                                    'dong_info.' .
                                                                        $dongIndex .
                                                                        '.floor_info.' .
                                                                        $floorIndex .
                                                                        '.floor_name',
                                                                )" />
                                                            <x-input-error class="mt-2 text-danger"
                                                                :messages="$errors->get(
                                                                    'dong_info.' .
                                                                        $dongIndex .
                                                                        '.floor_info.' .
                                                                        $floorIndex .
                                                                        '.floor_image_idxs',
                                                                )" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 fv-row">
                                                    <div class="d-flex justify-content-end" style="height: 100%;">
                                                        <button type="button" class="btn btn-primary floor-delete">층
                                                            삭제</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mb-6">
                        <button type="button" class="btn btn-secondary" onclick="dong_add();">동 추가</button>
                    </div>
                </div>

            </x-screen-card>

            <x-screen-card :title="'상세 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 프리미엄1 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">프리미엄1</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title_1" class="form-control mb-1" placeholder="프리미엄 제목 입력"
                                value="{{ old('title_1') }}" />
                            <textarea name="contents_1" class="form-control" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents_1') }}</textarea>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="count($errors->get('title_1')) > 0
                            ? $errors->get('title_1')
                            : $errors->get('contents_1')" />
                    </div>

                    {{-- 프리미엄2 --}}
                    <div class="row">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">프리미엄2</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title_2" class="form-control mb-1" placeholder="프리미엄 제목 입력"
                                value="{{ old('title_2') }}" />
                            <textarea name="contents_2" class="form-control" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents_2') }}</textarea>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="count($errors->get('title_2')) > 0
                            ? $errors->get('title_2')
                            : $errors->get('contents_2')" />
                    </div>

                    {{-- 프리미엄3,4 노출여부 --}}
                    <div class="row">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">프리미엄3,4<br>노출여부</label>
                        <div class="col-lg-9 fv-row d-flex align-items-center">
                            <label class="form-check form-check-custom form-check-inline p-1">
                                <input class="form-check-input" name="is_blind_1" id="is_blind_1" type="checkbox"
                                    value="1" @if (old('is_blind_1')) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">노출안함</span>
                            </label>
                        </div>
                    </div>

                    {{-- 프리미엄3 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">프리미엄3</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title_3" class="form-control mb-1" placeholder="프리미엄 제목 입력"
                                value="{{ old('title_3') }}" />
                            <textarea name="contents_3" class="form-control" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents_3') }}</textarea>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="count($errors->get('title_3')) > 0
                            ? $errors->get('title_3')
                            : $errors->get('contents_3')" />
                    </div>

                    {{-- 프리미엄4 --}}
                    <div class="row">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">프리미엄4</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title_4" class="form-control mb-1" placeholder="프리미엄 제목 입력"
                                value="{{ old('title_4') }}" />
                            <textarea name="contents_4" class="form-control" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents_4') }}</textarea>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="count($errors->get('title_4')) > 0
                            ? $errors->get('title_4')
                            : $errors->get('contents_4')" />
                    </div>

                    {{-- 프리미엄5,6 노출여부 --}}
                    <div class="row">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">프리미엄5,6<br>노출여부</label>
                        <div class="col-lg-9 fv-row d-flex align-items-center">
                            <label class="form-check form-check-custom form-check-inline p-1">
                                <input class="form-check-input" name="is_blind_2" id="is_blind_2" type="checkbox"
                                    value="1" @if (old('is_blind_2')) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">노출안함</span>
                            </label>
                        </div>
                    </div>

                    {{-- 프리미엄5 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">프리미엄5</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title_5" class="form-control mb-1" placeholder="프리미엄 제목 입력"
                                value="{{ old('title_5') }}" />
                            <textarea name="contents_5" class="form-control" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents_5') }}</textarea>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="count($errors->get('title_5')) > 0
                            ? $errors->get('title_5')
                            : $errors->get('contents_5')" />
                    </div>

                    {{-- 프리미엄6 --}}
                    <div class="row">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">프리미엄6</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title_6" class="form-control mb-1" placeholder="프리미엄 제목 입력"
                                value="{{ old('title_6') }}" />
                            <textarea name="contents_6" class="form-control" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents_6') }}</textarea>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="count($errors->get('title_6')) > 0
                            ? $errors->get('title_6')
                            : $errors->get('contents_6')" />
                    </div>



                </div>



            </x-screen-card>

            <x-screen-card :title="'분양 일정'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 일정 정보 --}}
                    <div id="schedule_info">

                        @php
                            $schedule_title = old('schedule_title') ?? [];
                            $start_date = old('start_date') ?? [];
                            $ended_date = old('ended_date') ?? [];
                            $is_ended = old('is_ended') ?? [];
                        @endphp

                        @if (count($schedule_title) > 0)
                            @foreach ($schedule_title as $index => $schedule)
                                {{-- 일정 정보 START --}}
                                <div class="row">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">일정 정보</label>
                                    <div class="col-lg-3 fv-row">
                                        <input type="text" name="schedule_title[]" class="form-control mb-1"
                                            placeholder="일정 제목" value="{{ $schedule }}" />
                                    </div>
                                    <div class="col-lg-6 fv-row row">
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">시작일</span>
                                                <input type="text" name="start_date[]" class="form-control"
                                                    onfocus="initDatepickerCustom($(this))" readonly placeholder=""
                                                    value="{{ $start_date[$index] }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">마감일</span>
                                                <input type="text" name="ended_date[]"
                                                    class="form-control ended-date"
                                                    onfocus="initDatepickerCustom($(this))" readonly
                                                    @if (($is_ended[$index] ?? ($ended_date[$index] ?? 0)) == 0) disabled @endif placeholder=""
                                                    value="{{ $ended_date[$index] }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-flex align-items-center">
                                            <label class="form-check form-check-custom form-check-inline">
                                                <input class="form-check-input is-ended" name="is_ended[]"
                                                    type="checkbox" value="1"
                                                    @if (($is_ended[$index] ?? ($ended_date[$index] ?? 0)) == 1) checked @endif>
                                                <span class="fw-semibold ps-2 fs-6">마감일</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-primary"
                                            onclick="schedule_delete(this)">삭제</button>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('schedule_title.' . $index)" />
                                </div>
                                {{-- 일정 정보 END --}}
                            @endforeach
                        @else
                            <div class="row">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">일정 정보</label>
                                <div class="col-lg-3 fv-row">
                                    <input type="text" name="schedule_title[]" class="form-control mb-1"
                                        placeholder="일정 제목" value="" />
                                </div>
                                <div class="col-lg-6 fv-row row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">시작일</span>
                                            <input type="text" name="start_date[]" class="form-control"
                                                onfocus="initDatepickerCustom($(this))" readonly placeholder=""
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">마감일</span>
                                            <input type="text" name="ended_date[]" class="form-control ended-date"
                                                onfocus="initDatepickerCustom($(this))" readonly disabled
                                                placeholder="" value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-inline">
                                            <input class="form-check-input is-ended" name="is_ended[]"
                                                type="checkbox" value="1">
                                            <span class="fw-semibold ps-2 fs-6">마감일</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-primary"
                                        onclick="schedule_delete(this)">삭제</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class=" d-flex justify-content-start py-6">
                        <button type="button" class="btn btn-warning" onclick="schedule_add();">항목추가</button>
                    </div>

                </div>

    </div>

    </x-screen-card>
    {{-- Footer Bottom START --}}
    <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="buttion" class="btn btn-primary" onclick="formSubmit();">등록</button>
    </div>
    {{-- Footer END --}}

    </form>
    {{-- FORM END --}}

    </div>

    <style>
        .custom-file-label {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>

    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        $(document).ready(function() {

            // 페이지 로드 시 실행
            toggleSolid();


        });


        function uploadFloorFile(input) {
            console.log('이미지 업로드');
            const data = new FormData(); // Create a new FormData object to store the file data
            let file = input.files[0]; // Get the selected file from the input element
            data.append('image', file); // Append the selected file to the FormData object with key 'image'

            $.ajax({
                url: "{{ route('api.imageupload') }}", // URL to the image upload API route
                method: "POST",
                data: data, // Data to be sent in the request (the FormData object containing the file)
                contentType: false, // Set contentType to false to prevent jQuery from automatically setting the content type
                processData: false, // Set processData to false to prevent jQuery from automatically processing the data
                success: function(response) {
                    console.log(response.result);
                    const container = input.closest('.file-upload-container');
                    const hiddenInput = container.querySelector('input[type="hidden"]');
                    const fileNameValue = container.querySelector('.file-nameValue');
                    const fileName = container.querySelector('.file-name');
                    fileNameValue.value = input.files[0] ? input.files[0].name : '선택된 파일이 없음';
                    fileName.textContent = input.files[0] ? input.files[0].name : '선택된 파일이 없음';
                    hiddenInput.value = response.result.id;
                },
                error: function() {
                    alert(
                        "파일 업로드 중 오류가 발생하였습니다."
                    ); // Display an alert if an error occurs during file upload
                }
            });
        }

        function formSubmit() {
            $('input:disabled').prop('disabled', false);

            $('.is-ended').each(function(index, item) {
                if ($(this).is(":checked")) {
                    $(this).val('1');
                } else {
                    $(this).val('0');
                }
                $(this).prop("checked", true);
            });

            $('form').submit();
        }

        // 이벤트 델리게이션을 사용하여 동적으로 추가된 요소에도 이벤트를 바인딩
        $('#schedule_info').on('change', '.is-ended', function() {
            var $row = $(this).closest('.row');
            var $endedDateInput = $row.find('.ended-date');
            if ($(this).is(':checked')) {
                $endedDateInput.prop('disabled', false);
            } else {
                $endedDateInput.val('');
                $endedDateInput.prop('disabled', true);
            }
        });

        function toggleSolid() {
            if ($('#is_blind_1').is(':checked')) {
                $('input[name="title_3"], textarea[name="contents_3"], input[name="title_4"], textarea[name="contents_4"]')
                    .addClass('form-control-solid');
            } else {
                $('input[name="title_3"], textarea[name="contents_3"], input[name="title_4"], textarea[name="contents_4"]')
                    .removeClass('form-control-solid');
            }

            if ($('#is_blind_2').is(':checked')) {
                $('input[name="title_5"], textarea[name="contents_5"], input[name="title_6"], textarea[name="contents_6"]')
                    .addClass('form-control-solid');
            } else {
                $('input[name="title_5"], textarea[name="contents_5"], input[name="title_6"], textarea[name="contents_6"]')
                    .removeClass('form-control-solid');
            }
        }
        // 체크박스 상태 변경 시 실행
        $('#is_blind_1').change(function() {
            toggleSolid();
        });
        $('#is_blind_2').change(function() {
            toggleSolid();
        });

        function schedule_add() {
            var schedule = `<div class="row">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">일정 정보</label>
                                <div class="col-lg-3 fv-row">
                                    <input type="text" name="schedule_title[]" class="form-control mb-1"
                                        placeholder="일정 제목" value="" />
                                </div>
                                <div class="col-lg-6 fv-row row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">시작일</span>
                                            <input type="text" name="start_date[]" class="form-control"
                                                onfocus="initDatepickerCustom($(this))" readonly placeholder=""
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">마감일</span>
                                            <input type="text" name="ended_date[]" class="form-control ended-date"
                                                onfocus="initDatepickerCustom($(this))" readonly disabled
                                                placeholder="" value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-inline">
                                            <input class="form-check-input is-ended" name="is_ended[]"
                                                type="checkbox" value="1">
                                            <span class="fw-semibold ps-2 fs-6">마감일</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-primary"
                                        onclick="schedule_delete(this)">삭제</button>
                                </div>
                            </div>`

            $('#schedule_info').append(schedule);
        }

        function schedule_delete(element) {
            $(element).closest('.row').remove();
        }

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


        // 동 추가 함수
        function dong_add() {
            var index = $('.dong_row').length;
            var template = `
            <div class="row mb-6 dong_row" data-index="${index}">
                <div class="col-lg-12 row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">동이름</label>
                    <div class="col-lg-6 fv-row">
                        <input type="text" name="dong_info[${index}][dong_name]" class="form-control"
                            placeholder="동이름" value="" />
                    </div>
                    <div class="col-lg-4 fv-row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary dong-delete">동 삭제</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 row mb-6">
                    <div class="col-lg-2 fv-row d-flex flex-column justify-content-center">
                        <label class="required col-form-label fw-semibold fs-6 align-self-start">층 정보</label>
                        <button type="button" class="btn btn-warning btn-sm add-floor" data-dong-index="${index}">층 정보 추가</button>
                    </div>
                    <div class="col-lg-10 fv-row floor-container" data-floor-container-index="${index}">
                        <!-- 층 정보는 여기에 추가됩니다. -->
                    </div>
                </div>
            </div>`;
            $('.dong-container').append(template);
        }

        // 층 추가 버튼 클릭 이벤트
        $(document).on('click', '.add-floor', function() {
            var dongIndex = $(this).data('dong-index');
            var container = $('.floor-container[data-floor-container-index="' + dongIndex + '"]');
            var floorIndex = container.find('.floor_row').length;
            var template = `
            <div class="row floor_row col-lg-12 mb-1" data-floor-index="${dongIndex}">
                <div class="row col-lg-10">
                    <div class="row mb-5">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">층
                            명</label>
                        <div class="col-lg-5 fv-row">
                            <input type="text"
                                name="dong_info[${dongIndex}][floor_info][${floorIndex}][floor_name]"
                                class="form-control" placeholder="층 명" value="" />
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label
                            class="required col-lg-2 col-form-label fw-semibold fs-6">용도구분</label>
                        <div class="col-lg-10 fv-row">
                            <label
                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                <input class="form-check-input"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][is_neighborhood_life]"
                                    type="checkbox" value="1">
                                <span class="fw-semibold ps-2">근생지원시설</span>
                            </label>
                            <label
                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                <input class="form-check-input"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][is_industry_center]"
                                    type="checkbox" value="1">
                                <span class="fw-semibold ps-2">지식산업센터</span>
                            </label>
                            <label
                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                <input class="form-check-input"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][is_warehouse]"
                                    type="checkbox" value="1">
                                <span class="fw-semibold ps-2">공동창고</span>
                            </label>
                            <label
                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                <input class="form-check-input"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][is_dormitory]"
                                    type="checkbox" value="1">
                                <span class="fw-semibold ps-2">기숙사,유치원</span>
                            </label>
                            <label
                                class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                <input class="form-check-input"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][is_business_support]"
                                    type="checkbox" value="1">
                                <span class="fw-semibold ps-2">업무지원시설</span>
                            </label>
                        </div>
                        <div class="row mb-6">
                            <label class="required col-lg-2 col-form-label fw-semibold fs-6">도면</label>
                            <div class="col-lg-9 file-upload-container">
                                <label class="custom-file-label" for="fileInput_${dongIndex}_${floorIndex}">파일 선택</label>
                                <input type="file" accept="image/*" id="fileInput_${dongIndex}_${floorIndex}" style="display:none"
                                name="" value="" onchange="uploadFloorFile(this)">
                                <span class="file-name">선택된 파일이 없음</span>
                                <input type="hidden"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][floor_image_idxs][]"
                                    value="">
                                <input type="hidden" class="file-nameValue"
                                    name="dong_info[${dongIndex}][floor_info][${floorIndex}][floor_image_text]"
                                    value="선택된 파일이 없음">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 fv-row">
                    <div class="d-flex justify-content-end" style="height: 100%;">
                        <button type="button" class="btn btn-primary floor-delete">층
                            삭제</button>
                    </div>
                </div>
            </div>`;
            container.append(template);
        });

        // 동 삭제 버튼 클릭 이벤트
        $(document).on('click', '.dong-delete', function() {
            $(this).closest('.dong_row').remove();
        });

        // 층 삭제 버튼 클릭 이벤트
        $(document).on('click', '.floor-delete', function() {
            $(this).closest('.floor_row').remove();
        });
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

        console.log('RoadFullAddr:', rtRoadFullAddr);
        console.log('AddrPart1:', rtAddrPart1);
        console.log('AddrDetail:', rtAddrDetail);
        console.log('AddrPart2:', rtAddrPart2);
        console.log('EngAddr:', rtEngAddr);
        console.log('JibunAddr:', rtJibunAddr);
        console.log('ZipNo:', rtZipNo);
        console.log('AdmCd:', rtAdmCd);
        console.log('RnMgtSn:', rtRnMgtSn);
        console.log('BdMgtSn:', rtBdMgtSn);
        console.log('DetBdNmList:', rtDetBdNmList);
        console.log('BdNm:', rtBdNm);
        console.log('BdKdcd:', rtBdKdcd);
        console.log('SiNm:', rtSiNm);
        console.log('SggNm:', rtSggNm);
        console.log('EmdNm:', rtEmdNm);
        console.log('LiNm:', rtLiNm);
        console.log('Rn:', rtRn);
        console.log('UdrtYn:', rtUdrtYn);
        console.log('BuldMnnm:', rtBuldMnnm);
        console.log('BuldSlno:', rtBuldSlno);
        console.log('MtYn:', rtMtYn);
        console.log('LnbrMnnm:', rtLnbrMnnm);
        console.log('LnbrSlno:', rtLnbrSlno);
        console.log('EmdNo:', rtEmdNo);
        console.log('lJibun:', relJibun);
        console.log('entX:', rtentX);
        console.log('entY:', rtentY);

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY);

        $('#address').val(rtAddrPart1 + ' ' + rtAddrDetail)
        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

        $('#region_code').val(rtAdmCd);
        $('#region_address').val(rtSiNm + ' ' + rtSggNm + ' ' + rtEmdNm + ' ' + rtLiNm);

        console.log('주소 검색 끝!');
    }
</script>
