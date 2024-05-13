<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'등록자 정보'">

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 아이디 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">ID</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                            value="{{ $result->users->email }}" />
                    </div>
                </div>

                {{-- 이름 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">이름</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="이름"
                            value="{{ $result->users->name }}" />
                    </div>
                </div>

                {{-- 전화번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전화번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="전화번호"
                            value="{{ $result->users->phone }}" />
                    </div>
                </div>


            </div>
            <!--내용 END-->
        </x-screen-card>
    </div>

    @php
        $type = old('type') ?? $result->type;
    @endphp

    <form class="form" method="POST" action="{{ route('admin.product.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $result->id }}" />
        <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

        <div class="app-container container-xxl">
            <x-screen-card :title="'매물 기본 정보'">
                {{-- FORM START  --}}

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 매물종류 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">매물종류</label>
                        <div class="col-lg-10 fv-row">
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">주거용</label>
                                <div class="col-lg-10 fv-row">
                                    @for ($i = 8; $i < 14; $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input" name="type" type="radio"
                                                value="{{ $i }}"
                                                @if ($type == $i) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.product_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">상업용</label>
                                <div class="col-lg-10 fv-row">
                                    @for ($i = 0; $i < 8; $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input" name="type" type="radio"
                                                value="{{ $i }}"
                                                @if ($type == $i) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.product_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">분양권</label>
                                <div class="col-lg-10 fv-row">
                                    @for ($i = 14; $i < Count(Lang::get('commons.product_type')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input" name="type" type="radio"
                                                value="{{ $i }}"
                                                @if ($type == $i) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.product_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 주소 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                        <div class="col-lg-10 fv-row">

                            @php
                                $is_map = count(old('is_map') ?? []) > 0 ? old('is_map')[0] : $result->is_map;
                            @endphp

                            <a onclick="getAddress()" class="btn btn-outline search_address_1"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;
                                display:{{ $is_map == 0 ? '' : 'none' }};">
                                주소 검색 </a>

                            <a class="btn btn-outline search_address_2" data-bs-toggle="modal"
                                data-bs-target="#modal_address_search"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;
                                display:{{ $is_map == 0 ? 'none' : '' }};">
                                가(임시)주소 검색 </a>

                            <label class="form-check form-check-custom form-check-inline p-1">
                                <input class="form-check-input" name="is_map[]" id="is_map_1" type="checkbox"
                                    value="1" {{ $is_map == 0 ? '' : 'checked' }}>
                                <span class="fw-semibold ps-2 fs-6">가(임시)주소</span>
                            </label>
                            <input style="display:none" class="form-check-input" name="is_map[]" id="is_map_0"
                                type="checkbox" value="0" {{ $is_map == 0 ? 'checked' : '' }}>

                            <input type="text" name="address" id="address" class="form-control " readonly
                                placeholder="" value="{{ old('address') ?? $result->address }}" />


                            <div class="mb-6"
                                style="border: 1px solid #D2D1D0; border-radius: 5px; display: flex; align-items: center; color:#D2D1D0; justify-content:center; text-align: center; line-height: 1.4; height: 500px; margin-top:18px; position: relative;">
                                <div id="is_temporary_0"
                                    style="position: absolute; width: 100%; height: 100%; display:{{ $is_map == 0 ? '' : 'none' }};">
                                    <div id="mapWrap" class="mapWrap"
                                        style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                                </div>
                                <div id="is_temporary_1" style="display: {{ $is_map == 0 ? 'none' : '' }}">
                                    가(임시)주소 선택시,<br>지도 노출이 불가능합니다.
                                </div>
                            </div>

                            <div class="detail_address_1" style="display: {{ $is_map == 0 ? '' : 'none' }};">
                                <span class="fs-6">상세주소</span>
                                <input type="text" name="address_detail" id="address_detail" class="form-control"
                                    placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호"
                                    value="{{ old('address_detail') ?? $result->address_detail }}"
                                    {{ old('is_address_detail') == 1 ? 'disabled' : '' }} />
                                <label class="form-check form-check-custom form-check-inline p-1">
                                    <input class="form-check-input" name="is_address_detail" id="is_address_detail"
                                        type="checkbox" value="1"
                                        {{ old('is_address_detail') == 1 ? 'checked' : '' }}>
                                    <span class="fw-semibold ps-2 fs-6">상세주소 없음</span>
                                </label>
                            </div>

                            <div class="detail_address_2 row" style="display: {{ $is_map == 0 ? 'none' : '' }};">
                                <span class="fs-6">상세주소</span>

                                <div class="col-lg-3 fv-row">
                                    <div class="input-group">
                                        <input type="text" name="address_dong" id="address_dong"
                                            class="form-control"
                                            value="{{ old('address_dong') ?? $result->address_dong }}"
                                            {{ old('is_address_dong') == 1 ? 'disabled' : '' }} />
                                        <span class="input-group-text" id="basic-addon2">동<span>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('address_dong')" />
                                </div>

                                <div class="col-lg-3 fv-row">
                                    <div class="input-group">
                                        <input type="text" name="address_number" class="form-control"
                                            value="{{ old('address_number') ? old('address_number') : $result->address_number }}" />
                                        <span class="input-group-text" id="basic-addon2">호<span>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('address_number')" />
                                </div>
                                <label class="form-check form-check-custom form-check-inline p-1">
                                    &nbsp;
                                    <input class="form-check-input" name="is_address_dong" id="is_address_dong"
                                        type="checkbox" value="1" {{ $result->address_dong ?? 'checked' }}>
                                    <span class="fw-semibold ps-2 fs-6">동 없음</span>
                                </label>
                            </div>

                            <input type="hidden" name="region_code" id="region_code"
                                value="{{ old('region_code') ? old('region_code') : $result->region_code }}">
                            <input type="hidden" name="address_lat" id="address_lat"
                                value="{{ old('address_lat') ? old('address_lat') : $result->address_lat }}">
                            <input type="hidden" name="address_lng" id="address_lng"
                                value="{{ old('address_lng') ? old('address_lng') : $result->address_lng }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('address')" />
                        </div>

                    </div>

                    {{-- 해당층/전체층 --}}
                    <div class="row mb-6 floor_input_1"
                        style="display:{{ in_array($type, ['6', '7']) ? 'none' : '' }}">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">해당층/전체층</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="floor_number" class="form-control" placeholder="해당층"
                                    value="{{ old('floor_number') ? old('floor_number') : $result->floor_number }}" />
                                <span class="input-group-text" id="basic-addon2">층<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('floor_number')" />
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="total_floor_number" class="form-control"
                                    placeholder="전체층"
                                    value="{{ old('total_floor_number') ? old('total_floor_number') : $result->total_floor_number }}" />
                                <span class="input-group-text" id="basic-addon2">층<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_number')" />
                        </div>
                    </div>

                    {{-- 최저층/최고층 --}}
                    <div class="row mb-6 floor_input_2" style="display:{{ $type == 7 ? '' : 'none' }}">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">최저층/최고층</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="lowest_floor_number" class="form-control"
                                    placeholder="최저층"
                                    value="{{ old('lowest_floor_number') ? old('lowest_floor_number') : $result->lowest_floor_number }}" />
                                <span class="input-group-text" id="basic-addon2">층<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lowest_floor_number')" />
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="top_floor_number" class="form-control" placeholder="최고층"
                                    value="{{ old('top_floor_number') ? old('top_floor_number') : $result->top_floor_number }}" />
                                <span class="input-group-text" id="basic-addon2">층<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('top_floor_number')" />
                        </div>
                    </div>

                    {{-- 공급 면적 --}}
                    <div class="row mb-6 area_input_1">
                        <label
                            class="required col-lg-2 col-form-label fw-semibold fs-6 area_text_1">{{ in_array($type, ['6', '7']) ? '대지면적' : '공급면적' }}</label>
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
                                <input type="text" name="square" id="square" onkeyup="imsi(this)"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('square') ? old('square') : $result->square }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('square')" />
                        </div>
                    </div>

                    {{-- 연면적 --}}
                    <div class="row mb-6 area_input_2" style="display: {{ $type != 7 ? 'none' : '' }}">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">연면적</label>
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

                    {{-- 전용 면적 --}}
                    <div class="row mb-6 area_input_3" style="display: {{ $type == 6 ? 'none' : '' }}">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">전용 면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="exclusive_area" id="exclusive_area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('exclusive_area') ? old('exclusive_area') : $result->exclusive_area }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('exclusive_area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('exclusive_')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('exclusive_')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="exclusive_square" id="exclusive_square"
                                    onkeyup="imsi(this)" class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('exclusive_square') ? old('exclusive_square') : $result->exclusive_square }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('exclusive_square')" />
                        </div>
                    </div>

                    {{-- 사용승인일 --}}
                    <div class="row mb-6 no_forest approve_date_input">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">사용승인일</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="approve_date" class="form-control" placeholder="예) 20230204"
                                value="{{ old('approve_date') ? old('approve_date') : $result->approve_date }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('approve_date')" />
                        </div>
                    </div>

                    {{-- 건축물 용도 --}}
                    <div class="row mb-6 no_forest building_type_input">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">건축물 용도</label>
                        <div class="col-lg-3 fv-row">
                            <select name="building_type" class="form-select" data-control="select2"
                                data-hide-search="true">
                                <option value="">
                                    건축물 용도 선택
                                </option>
                                @for ($i = 0; $i < count(Lang::get('commons.building_type')); $i++)
                                    <option value="{{ $i }}"
                                        @if ("$result->building_type" == $i) selected @endif>
                                        {{ Lang::get('commons.building_type.' . $i) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_type')" />
                        </div>
                    </div>

                    {{-- 입주가능일 --}}
                    <div class="row mb-6 no_forest move_date_input">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">입주가능일</label>
                        <div class="col-lg-4 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="move_type" type="radio" value="0"
                                    @if ($result->move_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">즉시 입주</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="move_type" type="radio"
                                    value="1"@if ($result->move_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">날짜 협의</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="move_type" type="radio"
                                    value="2"@if ($result->move_type == 2) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">직접 입력</span>
                            </label>
                            @inject('carbon', 'Carbon\Carbon')
                            <input type="text" name="move_date" id="move_date" class="form-control"
                                placeholder="예) 20230204" value="{{ old('move_date') ?? $result->move_date }}"
                                @if ($result->move_type != 2) disabled @endif />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('move_date')" />
                        </div>
                    </div>

                    {{-- 월 관리비 --}}
                    <div class="row mb-6 no_forest service_price_input">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">월 관리비</label>
                        <div class="col-md-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="service_price" id="service_price" class="form-control"
                                    placeholder="예) 10"
                                    value="{{ old('service_price') ?? $result->service_price }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('service_price')" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-check form-check-custom form-check-inline p-1">
                                <input class="form-check-input" name="is_service" id="is_service" type="checkbox"
                                    value="1">
                                <span class="fw-semibold ps-2 fs-6">관리비 없음</span>
                            </label>
                        </div>
                    </div>

                    {{-- 융자금 --}}
                    <div class="row mb-6 no_forest">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">융자금</label>
                        <div class="col-lg-4 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="loan_type" type="radio" value="0"
                                    @if ($result->loan_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="loan_type" type="radio"
                                    value="1"@if ($result->loan_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">30% 미만</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="loan_type" type="radio"
                                    value="2"@if ($result->loan_type == 2) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">30% 이상</span>
                            </label>
                            @inject('carbon', 'Carbon\Carbon')
                            <input type="text" name="loan_price" id="loan_price" class="form-control"
                                placeholder="예) 1억 1000만"
                                value="{{ old('loan_price') ?? $result->loan_price == null ? '' : $result->loan_price->format('Y-m-d') }}"
                                @if ($result->move_type != 2) disabled @endif />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('loan_price')" />
                        </div>
                    </div>

                    {{-- 주차 가능 여부 --}}
                    <div class="row mb-6 no_forest parking_price_input">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주차 가능 여부</label>
                        <div class="col-lg-4 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="parking_type" type="radio" value="0"
                                    @if ($result->parking_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="parking_type" type="radio"
                                    value="1"@if ($result->parking_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">가능</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="parking_type" type="radio"
                                    value="2"@if ($result->parking_type == 2) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">불가능</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">월</span>
                                <input type="number" name="parking_price" id="parking_price" class="form-control"
                                    placeholder="예) 10" value="{{ old('parking_price') ?? $result->parking_price }}"
                                    {{ $result->parking_type != 1 ? 'disabled' : '' }} />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <div class="col-md-5">
                                <label class="form-check form-check-custom form-check-inline p-1">
                                    <input class="form-check-input" name="is_parking" id="is_parking"
                                        type="checkbox" value="1"
                                        {{ $result->parking_type != 2 ? 'disabled' : $result->parking_price ?? 'checked' }}>
                                    <span class="fw-semibold ps-2 fs-6">무료주차</span>
                                </label>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('parking_price')" />
                        </div>
                    </div>


                </div>
                <!--내용 END-->



            </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'가격 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 거래 유형 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">거래 유형</label>
                        <div class="col-lg-10 fv-row">
                            <div class="row mb-6">
                                <div class="col-lg-8 fv-row mb-6">

                                    @php
                                        $payment_type = old('payment_type') ?? $result->priceInfo->payment_type;
                                        $is_payment_type = [];

                                        if ($type < 8) {
                                            $is_payment_type = ['0', '1', '2'];
                                        } elseif ($type > 13) {
                                            $is_payment_type = ['4', '5'];
                                        } else {
                                            $is_payment_type = ['0', '2', '3', '4'];
                                        }
                                        if ($payment_type == '1' || $payment_type == '2' || $payment_type == '4') {
                                            $is_moth_price = '';
                                            $payment_price_text = '보증금';
                                        } else {
                                            $is_moth_price = 'none';
                                            $payment_price_text =
                                                Lang::get('commons.payment_type.' . $payment_type) . '가';
                                        }
                                    @endphp
                                    @for ($i = 0; $i < count(Lang::get('commons.payment_type')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1 "
                                            style="display: {{ in_array($i, $is_payment_type) ? '' : 'none' }}">
                                            <input class="form-check-input" name="payment_type" type="radio"
                                                value="{{ $i }}"
                                                @if ($payment_type == $i) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.payment_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-4 fv-row price_input">
                                        <span class="fs-6"
                                            id="payment_price_text">{{ $payment_price_text }}</span>
                                        <div class="input-group">
                                            <input type="number" name="price" id="price" class="form-control"
                                                placeholder="예) 100000"
                                                value="{{ old('price') ?? $result->priceInfo->price }}" />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                    </div>

                                    @php

                                    @endphp
                                    <div class="col-lg-4 fv-row month_price_input"
                                        style="display:{{ $is_moth_price }}">
                                        <span class="fs-6">월 임대료</span>
                                        <div class="input-group">
                                            <input type="number" name="month_price" id="month_price"
                                                class="form-control" placeholder="예) 100000"
                                                value="{{ old('month_price') ?? $result->priceInfo->month_price }}" />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('month_price')" />
                                    </div>
                                    <div class=" fv-row">
                                        <label class="form-check form-check-custom form-check-inline p-1">
                                            <input class="form-check-input" name="is_price_discussion"
                                                id="is_price_discussion" type="checkbox" value="1">
                                            <span class="fw-semibold ps-2 fs-6">협의가능</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 기존 임대차 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">기존 임대차 내용</label>
                        <div class="col-lg-10 fv-row">
                            <div class="row mb-6">
                                <div class="col-lg-8 fv-row">
                                    <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                        <input class="form-check-input" name="is_use" type="radio" value="0"
                                            @if ($result->priceInfo->is_use == 0) checked @endif>
                                        <span class="fw-semibold ps-2 fs-6">없음</span>
                                    </label>
                                    <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                        <input class="form-check-input" name="is_use" type="radio" value="1"
                                            @if ($result->priceInfo->is_use == 1) checked @endif>
                                        <span class="fw-semibold ps-2 fs-6">있음</span>
                                    </label>
                                </div>

                                <div class="row mb-6">
                                    <div class="col-lg-4 fv-row">
                                        <span class="fs-6">현 보증금</span>
                                        <div class="input-group mb-6">
                                            <input type="text" name="current_price" id="current_price"
                                                class="form-control" placeholder="예) 10"
                                                value="{{ old('current_price') ?? $result->priceInfo->current_price }}" />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 fv-row">
                                        <span class="fs-6">현 월임대료</span>
                                        <div class="input-group">
                                            <input type="text" name="current_month_price" id="current_month_price"
                                                class="form-control" placeholder="예) 10"
                                                value="{{ old('current_month_price') ?? $result->priceInfo->current_month_price }}" />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 권리금 --}}
                    <div class="row mb-6 preminum_price_input"
                        style="display: @if ($type == 3 || $type > 13) @else none @endif">
                        <label
                            class="required col-lg-2 col-form-label fw-semibold fs-6 is_store_text">{{ $type == 3 ? '권리금' : '프리미엄' }}</label>
                        <div class="col-lg-10 fv-row">
                            <div class="row mb-6">
                                <div class="col-lg-8 fv-row is_store"
                                    style="display: @if ($type != 3) none @endif">
                                    <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                        <input class="form-check-input" name="is_premium" type="radio"
                                            value="0" @if ($result->is_premium == 0) checked @endif>
                                        <span class="fw-semibold ps-2 fs-6">없음</span>
                                    </label>
                                    <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                        <input class="form-check-input" name="is_premium" type="radio"
                                            value="2"@if ($result->is_premium == 1) checked @endif>
                                        <span class="fw-semibold ps-2 fs-6">있음</span>
                                    </label>
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-4 fv-row">
                                        <div class="input-group">
                                            <input type="text" name="premium_price" id="premium_price"
                                                class="form-control" placeholder="예) 10"
                                                value="{{ old('premium_price') ?? $result->priceInfo->premium_price }}"
                                                @if ($result->is_premium == 0 && $type == 3) disabled @endif />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('loan_price')" />
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'추가 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 방/욕실 수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">방/욕실 수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="room_count" class="form-control" placeholder="방 수"
                                    value="{{ old('room_count') ? old('room_count') : $result->productAddInfo->room_count ?? '' }}" />
                                <span class="input-group-text" id="basic-addon2">개<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('room_count')" />
                        </div>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="text" name="bathroom_count " class="form-control" placeholder="욕실 수"
                                    value="{{ old('bathroom_count ') ? old('bathroom_count ') : $result->productAddInfo->bathroom_count ?? '' }}" />
                                <span class="input-group-text" id="basic-addon2">개<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('bathroom_count ')" />
                        </div>
                    </div>

                    {{-- 현 업종 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">현 업종</label>
                        <div class="col-lg-3 fv-row">
                            <select name="current_business_type" class="form-select" data-control="select2"
                                data-hide-search="true">
                                <option value="">
                                    현 업종 선택
                                </option>
                                @for ($i = 0; $i < count(Lang::get('commons.product_business_type')); $i++)
                                    <option value="{{ $i }}"
                                        @if ($result->productAddInfo->current_business_type ?? '' == $i) selected @endif>
                                        {{ Lang::get('commons.product_business_type.' . $i) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('current_business_type')" />
                        </div>
                    </div>

                    {{-- 추천 업종 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">추천 업종</label>
                        <div class="col-lg-3 fv-row">
                            <select name="recommend_business_type" class="form-select" data-control="select2"
                                data-hide-search="true">
                                <option value="">
                                    추천 업종 선택
                                </option>
                                @for ($i = 0; $i < count(Lang::get('commons.product_business_type')); $i++)
                                    <option value="{{ $i }}"
                                        @if ($result->productAddInfo->recommend_business_type ?? '' == $i) selected @endif>
                                        {{ Lang::get('commons.product_business_type.' . $i) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommend_business_type')" />
                        </div>
                    </div>

                    {{-- 건물 방향 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">건물 방향</label>
                        <div class="col-lg-3 fv-row">
                            <select name="direction_type" class="form-select" data-control="select2"
                                data-hide-search="true">
                                <option value="">
                                    건물 방향 선택
                                </option>
                                @for ($i = 0; $i < count(Lang::get('commons.direction_type')); $i++)
                                    <option value="{{ $i }}"
                                        @if ($result->productAddInfo->direction_type ?? '' == $i) selected @endif>
                                        {{ Lang::get('commons.direction_type.' . $i) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('direction_type')" />
                        </div>
                    </div>

                    {{-- 냉방 종류 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">냉방 종류</label>
                        <div class="col-lg-3 fv-row">
                            <select name="cooling_type" class="form-select" data-control="select2"
                                data-hide-search="true">
                                <option value="">
                                    냉방 종류 선택
                                </option>
                                @for ($i = 0; $i < count(Lang::get('commons.cooling_type')); $i++)
                                    <option value="{{ $i }}"
                                        @if ($result->productAddInfo->cooling_type ?? '' == $i) selected @endif>
                                        {{ Lang::get('commons.cooling_type.' . $i) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('cooling_type')" />
                        </div>
                    </div>

                    {{-- 난방 종류 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">난방 종류</label>
                        <div class="col-lg-3 fv-row">
                            <select name="heating_type" class="form-select" data-control="select2"
                                data-hide-search="true">
                                <option value="">
                                    난방 종류 선택
                                </option>
                                @for ($i = 0; $i < count(Lang::get('commons.heating_type')); $i++)
                                    <option value="{{ $i }}"
                                        @if ($result->productAddInfo->heating_type ?? '' == $i) selected @endif>
                                        {{ Lang::get('commons.heating_type.' . $i) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('heating_type')" />
                        </div>
                    </div>

                    {{-- 하중 (평당) --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">하중 (평당)</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="weight" class="form-control" placeholder="예) 0.8"
                                value="{{ old('weight') ? old('weight') : $result->productAddInfo->weight ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('weight')" />
                        </div>
                    </div>

                    {{-- 승상시설 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">승상시설</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_elevator" type="radio" value="0"
                                    @if ($result->productAddInfo->is_elevator ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_elevator" type="radio" value="1"
                                    @if ($result->productAddInfo->is_elevator ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_elevator')" />
                        </div>
                    </div>

                    {{-- 화물용 승상시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">화물용 승상시설</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_goods_elevator" type="radio"
                                    value="0" @if ($result->productAddInfo->is_goods_elevator ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_goods_elevator" type="radio"
                                    value="1" @if ($result->productAddInfo->is_goods_elevator ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_goods_elevator')" />
                        </div>
                    </div>

                    {{-- 구조 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">구조</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="structure_type" type="radio" value="0"
                                    @if ($result->productAddInfo->structure_type ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="structure_type" type="radio" value="1"
                                    @if ($result->productAddInfo->structure_type ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">복층</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="structure_type" type="radio" value="2"
                                    @if ($result->productAddInfo->structure_type ?? 0 == 2) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">1.5룸/주방분리형</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('structure_type')" />
                        </div>
                    </div>

                    {{-- 빌트인 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">빌트인</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="builtin_type" type="radio" value="0"
                                    @if ($result->productAddInfo->builtin_type ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="builtin_type" type="radio" value="1"
                                    @if ($result->productAddInfo->builtin_type ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="builtin_type" type="radio" value="2"
                                    @if ($result->productAddInfo->builtin_type ?? 0 == 2) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('builtin_type')" />
                        </div>
                    </div>

                    {{-- 인테리어 여부 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">인테리어 여부</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="interior_type" type="radio" value="0"
                                    @if ($result->productAddInfo->interior_type ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="interior_type" type="radio" value="1"
                                    @if ($result->productAddInfo->interior_type ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="interior_type" type="radio" value="2"
                                    @if ($result->productAddInfo->interior_type ?? 0 == 2) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('interior_type')" />
                        </div>
                    </div>

                    {{-- 도크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">도크</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_dock" type="radio" value="0"
                                    @if ($result->productAddInfo->is_dock ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_dock" type="radio" value="1"
                                    @if ($result->productAddInfo->is_dock ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_dock')" />
                        </div>
                    </div>

                    {{-- 호이스트 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">호이스트</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_hoist" type="radio" value="0"
                                    @if ($result->productAddInfo->is_hoist ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_hoist" type="radio" value="1"
                                    @if ($result->productAddInfo->is_hoist ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_hoist')" />
                        </div>
                    </div>

                    {{-- 층고 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">층고</label>
                        <div class="col-lg-10 fv-row">
                            @for ($i = 0; $i < count(Lang::get('commons.floor_height_type')); $i++)
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="floor_height_type" type="radio"
                                        value="0" @if ($result->productAddInfo->floor_height_type ?? 0 == $i) checked @endif>
                                    <span
                                        class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.floor_height_type.' . $i) }}</span>
                                </label>
                            @endfor
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('floor_height_type')" />
                        </div>
                    </div>

                    {{-- 사용전력 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">사용전력</label>
                        <div class="col-lg-10 fv-row">
                            @for ($i = 0; $i < count(Lang::get('commons.wattage_type')); $i++)
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="wattage_type" type="radio"
                                        value="0" @if ($result->productAddInfo->wattage_type ?? 0 == $i) checked @endif>
                                    <span
                                        class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.wattage_type.' . $i) }}</span>
                                </label>
                            @endfor
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('wattage_type')" />
                        </div>
                    </div>

                    {{-- 옵션 정보 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">옵션 정보</label>

                        <div class="col-lg-10 fv-row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">옵션 정보</label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_option" type="radio" value="0"
                                    @if ($result->productAddInfo->is_option ?? 0 == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">없음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="is_option" type="radio" value="1"
                                    @if ($result->productAddInfo->is_option ?? 0 == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                        </div>

                        <label class="col-lg-2 col-form-label fw-semibold fs-6"></label>

                        <div class="col-lg-10 fv-row">
                            @php
                                $option_count = 0;
                                $option_types = $result->productOptions->pluck('type')->toArray();
                            @endphp
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">시설</label>
                                <div class="col-lg-8 fv-row">
                                    @for ($i = 0; $i < count(Lang::get('commons.option_facility')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input option_type" name="option_type[]"
                                                type="checkbox" value="{{ $option_count }}"
                                                @if (in_array($option_count, $option_types)) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.option_facility.' . $option_count++) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">보안</label>
                                <div class="col-lg-8 fv-row">
                                    @for ($i = 0; $i < count(Lang::get('commons.option_security')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input option_type" name="option_type[]"
                                                type="checkbox" value="{{ $option_count }}"
                                                @if (in_array($option_count, $option_types)) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.option_security.' . $option_count++) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">주방</label>
                                <div class="col-lg-10 fv-row">
                                    @for ($i = 0; $i < count(Lang::get('commons.option_kitchen')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input option_type" name="option_type[]"
                                                type="checkbox" value="{{ $option_count }}"
                                                @if (in_array($option_count, $option_types)) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.option_kitchen.' . $option_count++) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">가전</label>
                                <div class="col-lg-10 fv-row">
                                    @for ($i = 0; $i < count(Lang::get('commons.option_home_appliances')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input option_type" name="option_type[]"
                                                type="checkbox" value="{{ $option_count }}"
                                                @if (in_array($option_count, $option_types)) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.option_home_appliances.' . $option_count++) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">가구</label>
                                <div class="col-lg-10 fv-row">
                                    @for ($i = 0; $i < count(Lang::get('commons.option_furniture')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input option_type" name="option_type[]"
                                                type="checkbox" value="{{ $option_count }}"
                                                @if (in_array($option_count, $option_types)) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.option_furniture.' . $option_count++) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">기타</label>
                                <div class="col-lg-8 fv-row">
                                    @for ($i = 0; $i < count(Lang::get('commons.option_etc')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input option_type" name="option_type[]"
                                                type="checkbox" value="{{ $option_count }}"
                                                @if (in_array($option_count, $option_types)) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.option_etc.' . $option_count++) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                        </div>
                    </div>

                    <div>
                        {{-- 국토이용 --}}
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">국토이용</label>
                            <div class="col-lg-10 fv-row">
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="land_use_type" type="radio"
                                        value="0" @if ($result->productAddInfo->land_use_type ?? 0 == 0) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="land_use_type" type="radio"
                                        value="1" @if ($result->productAddInfo->land_use_type ?? 0 == 1) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">해당</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="land_use_type" type="radio"
                                        value="2" @if ($result->productAddInfo->land_use_type ?? 0 == 2) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">미해당</span>
                                </label>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('land_use_type')" />
                            </div>
                        </div>

                        {{-- 도시계획 --}}
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">도시계획</label>
                            <div class="col-lg-10 fv-row">
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="city_plan_type" type="radio"
                                        value="0" @if ($result->productAddInfo->city_plan_type ?? 0 == 0) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="city_plan_type" type="radio"
                                        value="1" @if ($result->productAddInfo->city_plan_type ?? 0 == 1) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">단층</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="city_plan_type" type="radio"
                                        value="2" @if ($result->productAddInfo->city_plan_type ?? 0 == 2) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">복층</span>
                                </label>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('city_plan_type')" />
                            </div>
                        </div>

                        {{-- 건축허가 --}}
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">건축허가</label>
                            <div class="col-lg-10 fv-row">
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="building_permit_type" type="radio"
                                        value="0" @if ($result->productAddInfo->building_permit_type ?? 0 == 0) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="building_permit_type" type="radio"
                                        value="1" @if ($result->productAddInfo->building_permit_type ?? 0 == 1) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">발급</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="building_permit_type" type="radio"
                                        value="2" @if ($result->productAddInfo->building_permit_type ?? 0 == 2) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">미발급</span>
                                </label>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_permit_type')" />
                            </div>
                        </div>

                        {{-- 토지거래허가구역 --}}
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">토지거래허가구역</label>
                            <div class="col-lg-10 fv-row">
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="land_permit_type" type="radio"
                                        value="0" @if ($result->productAddInfo->land_permit_type ?? 0 == 0) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="land_permit_type" type="radio"
                                        value="1" @if ($result->productAddInfo->land_permit_type ?? 0 == 1) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">해당</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="land_permit_type" type="radio"
                                        value="2" @if ($result->productAddInfo->land_permit_type ?? 0 == 2) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">미해당</span>
                                </label>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('land_permit_type')" />
                            </div>
                        </div>

                        {{-- 진입도로 --}}
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">진입도로</label>
                            <div class="col-lg-10 fv-row">
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="access_load_type" type="radio"
                                        value="0" @if ($result->productAddInfo->access_load_type ?? 0 == 0) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="access_load_type" type="radio"
                                        value="1" @if ($result->productAddInfo->access_load_type ?? 0 == 1) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">있음</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="access_load_type" type="radio"
                                        value="2" @if ($result->productAddInfo->access_load_type ?? 0 == 2) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">없음</span>
                                </label>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('access_load_type')" />
                            </div>
                        </div>

                    </div>



                </div>

        </div>
        </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'사진 및 상세 설명'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지 --}}
                    <x-admin-image-picker :title="'사진등록'" :id="'product'" required="required" cnt="8"
                        :images="$result->images" />

                    {{-- 한줄요약 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">한줄요약</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" name="comments" class="form-control"
                                placeholder="예) 역에서 5분거리, 인프라 좋은 매물"
                                value="{{ old('comments') ? old('comments') : $result->comments }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comments')" />
                        </div>
                    </div>

                    {{-- 상세설명 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">상세설명</label>
                        <div class="col-lg-10 fv-row">
                            <textarea name="contents" class="form-control mb-5" rows="5" placeholder="주변 편의시설, 역세권 등의 정보를 입력해주세요.">{{ old('contents') ? old('contents') : $result->contents }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('contents')" />
                        </div>
                    </div>

                    {{-- 3D 이미지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">3D 이미지 링크</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" name="image_link" class="form-control"
                                placeholder="링크를 입력해 주세요."
                                value="{{ old('image_link') ? old('image_link') : $result->image_link }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('image_link')" />
                        </div>
                    </div>

                </div>
            </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'매물 상태'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 최종 수정자 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">최종 수정자</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="최종 수정자"
                                value="{{ $carbon::parse($result->updated_at)->format('Y.m.d H:m') . ' - ' . ($result->update_user_type == 0 ? '일반회원' : '관리자') }}" />
                        </div>
                    </div>

                    {{-- 매물상태 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">매물상태</label>
                        <div class="col-lg-8 fv-row">
                            @for ($i = 0; $i < count(Lang::get('commons.product_state')) - 1; $i++)
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="state" type="radio"
                                        value="{{ $i }}"
                                        @if ($result->state == $i) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">
                                        {{ Lang::get('commons.product_state.' . $i) }}
                                    </span>
                                </label>
                            @endfor

                        </div>
                    </div>

                </div>
            </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'중개보수'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 중개보수(부가세별도) --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">중개보수(부가세별도)</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" name="commission" class="form-control"
                                placeholder="중개보수(부가세별도)"
                                value="{{ old('commission') ? old('commission') : $result->commission }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('commission')" />
                        </div>
                    </div>

                    {{-- 상한요율(%) --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">상한요율(%)</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" name="commission_rate" class="form-control"
                                placeholder="상한요율(%)"
                                value="{{ old('commission_rate') ? old('commission_rate') : $result->commission_rate }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('commission_rate')" />
                        </div>
                    </div>

                </div>
            </x-screen-card>
        </div>

        {{-- Footer Bottom START --}}
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="submit" class="btn btn-primary">저장</button>
        </div>
        {{-- Footer END --}}

    </form>
    {{-- FORM END --}}

    <!-- modal 가(임시)주소 검색 : s-->
    <div class="modal fade" tabindex="-1" id="modal_address_search">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">가(임시) 주소 검색</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 modal_address_search_close"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1">X</span><span
                                class="path2"></span></i>
                        <!--end::Close-->
                    </div>
                </div>
                <div class="modal-body">
                    <ul class="adress_select tab_toggle_menu">
                        <select name="region_code_1" id="region_code_1" class="form-select mb-6 region_code"
                            data-control="select2" data-hide-search="true">
                            <option value="">시/도</option>
                        </select>
                        <select name="region_code_2" id="region_code_2" class="form-select mb-6 region_code"
                            data-control="select2" data-hide-search="true">
                            <option value="">시/군/구</option>
                        </select>
                        <select name="region_code_3" id="region_code_3" class="form-select mb-6 region_code"
                            data-control="select2" data-hide-search="true">
                            <option value="">읍/면/동</option>
                        </select>
                        <select name="region_code_4" id="region_code_4" class="form-select mb-6 region_code"
                            data-control="select2" data-hide-search="true">
                            <option value="">리</option>
                        </select>
                    </ul>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">닫기</button>
                        <button type="button" class="btn btn-primary" id="seach_address"
                            onclick="seach_address()" disabled>
                            검색
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal 가(임시)주소 검색 : e-->

    // 맵 api
    <script type="text/javascript"
        src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey=U01TX0FVVEgyMDI0MDUwOTE0MjYyMjExNDc1Mjk=&skinType=1">
    </script>
    <style>
        .zoomIcon {
            padding: 0px !important;
        }
    </style>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initDatepicker($('#move_date'), "{{ old('move_date') }}");
    </script>

    <script>
        $(document).ready(function() {
            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
                .remove();

            var wgs84Coords = get_coordinate_conversion1($('input[name=address_lng]').val(), $(
                'input[name=address_lat]').val())

            setTimeout(function() {
                callJusoroMapApiType1(wgs84Coords[0], wgs84Coords[1]);
            }, 1000);

            if ($('input[name="is_option"]:checked').val() == 0) {
                $('.option_type').attr('disabled', true);
            }

        });

        // type1.좌표정보(GRS80, EPSG:5179)
        function callJusoroMapApiType1(rtentX, rtentY) {
            window.postMessage({
                functionName: 'callJusoroMapApi',
                params: [rtentX, rtentY]
            }, '*');
        }


        // 건물타입에 따라 층 입력칸 변경
        $('input[name="type"]').change(function() {
            $('input[name="payment_type"]').parent().css('display', 'none');
            $('.preminum_price_input').css('display', 'none')
            $('#premium_price').val('');

            if ($(this).val() < 8) {
                if ($(this).val() == 4) {
                    $('input[name="payment_type"][value=0]').prop('checked', true);
                    $('#payment_price_text').text("매매가")
                    $('input[name="payment_type"][value=0]').parent().css('display', '');
                    $('input[name="payment_type"][value=3]').parent().css('display', '');
                    $('input[name="payment_type"][value=4]').parent().css('display', '');
                    $('input[name="payment_type"][value=2]').parent().css('display', '');
                } else {
                    $('input[name="payment_type"][value=0]').prop('checked', true);
                    $('#payment_price_text').text("매매가")
                    $('input[name="payment_type"][value=0]').parent().css('display', '');
                    $('input[name="payment_type"][value=1]').parent().css('display', '');
                    $('input[name="payment_type"][value=2]').parent().css('display', '');

                }

                $('.preminum_price_input').css('display', '')
                $('.is_store_text').text('권리금');
                $('.is_store').css('display', '')
                $('is_premium[value=0]').prop('checked', true);
                $('#premium_price').attr('disabled', true);

            } else if ($(this).val() > 13) {
                $('input[name="payment_type"][value=5]').prop('checked', true);
                $('#payment_price_text').text("전매가")
                $('input[name="payment_type"][value=4]').parent().css('display', '');
                $('input[name="payment_type"][value=5]').parent().css('display', '');

                $('.preminum_price_input').css('display', '')
                $('.is_store_text').text('프리미엄');
                $('.is_store').css('display', 'none')
                $('#premium_price').attr('disabled', false);
            } else {
                $('input[name="payment_type"][value=0]').prop('checked', true);
                $('#payment_price_text').text("매매가")
                $('input[name="payment_type"][value=0]').parent().css('display', '');
                $('input[name="payment_type"][value=3]').parent().css('display', '');
                $('input[name="payment_type"][value=4]').parent().css('display', '');
                $('input[name="payment_type"][value=2]').parent().css('display', '');
            }

            if ([6, 7].indexOf(parseInt($(this).val())) !== -1) {
                $('.area_text_1').text('대지면적');
                $('.approve_date_input').css('display', '');
                $('.building_type_input').css('display', '');
                $('.move_date_input').css('display', '');
                $('.service_price_input').css('display', '');
                $('.approve_date_input').css('display', '');
                $('.parking_price_input').css('display', '');

                if ($(this).val() == 6) {
                    $('.floor_input_1').css('display', 'none');
                    $('.floor_input_2').css('display', 'none');
                    $('.area_input_1').css('display', '');
                    $('.area_input_2').css('display', 'none');
                    $('.area_input_3').css('display', 'none');

                    //
                    $('.approve_date_input').css('display', 'none');
                    $('.building_type_input').css('display', 'none');
                    $('.move_date_input').css('display', 'none');
                    $('.service_price_input').css('display', 'none');
                    $('.approve_date_input').css('display', 'none');
                    $('.parking_price_input').css('display', 'none');

                } else {
                    $('.floor_input_1').css('display', 'none');
                    $('.floor_input_2').css('display', '');
                    $('.area_input_1').css('display', '');
                    $('.area_input_2').css('display', '');
                    $('.area_input_3').css('display', '');
                }
            } else {
                $('.floor_input_1').css('display', '');
                $('.floor_input_2').css('display', 'none');

                $('.area_text_1').text('공급면적');
                $('.area_input_1').css('display', '');
                $('.area_input_2').css('display', 'none');
                $('.area_input_3').css('display', '');
            }


            if ([0, 1, 2, 4].indexOf(parseInt($(this).val())) !== -1) {
                alert('추가 정보 1')
            } else if ($(this).val() == 3) {
                alert('추가정보 2')
            } else if ($(this).val() == 5) {
                alert('추가정보 3')
            } else if ($(this).val() == 6) {
                alert('추가정보 4')
            } else if ($(this).val() == 7) {
                alert('추가정보 5')
            } else if ([8, 10, 11, 12, 13].indexOf(parseInt($(this).val())) !== -1) {
                alert('추가정보 6')
            } else if ($(this).val() == 9) {
                alert('추가정보 7')
            } else if ($(this).val() > 13) {
                alert('추가정보 8')
            }
        });

        // 평수 제곱 변환
        function square_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();
            if (square > 0) {
                var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
                $('#' + area_name).val(convertedArea);
            }
        }

        // 평수 제곱 변환
        function area_change(name) {
            console.log('gd');

            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();
            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
            }
        }

        // 가임시 주소일 경우 동없음 체크여부
        $('input[name="is_option"]').change(function() {
            if ($(this).val() == 0) {
                $('.option_type').prop('checked', false);
                $('.option_type').attr('disabled', true);
            } else {
                $('.option_type').attr('disabled', false);
            }
        });

        // 가임시 주소일 경우 동없음 체크여부
        $('#is_service').click(function() {
            if ($(this).is(':checked')) {
                $('#service_price').val('');
                $('#service_price').attr('disabled', true);
            } else {
                $('#service_price').attr('disabled', false);
            }
        });

        // 가임시 주소일 경우 동없음 체크여부
        $('#address_no_1').click(function() {
            if ($(this).is(':checked')) {
                $('#address_dong').val('');
                $('#address_dong').attr('disabled', true);
            } else {
                $('#address_dong').attr('disabled', false);
            }
        });

        // 가임시 주소가 아닐 경우 상세없음 체크여부
        $('#address_no_2').click(function() {
            if ($(this).is(':checked')) {
                $('#address_detail').val('');
                $('#address_detail').attr('disabled', true);
            } else {
                $('#address_detail').attr('disabled', false);
            }
        });

        // 입주가능일 타입
        $('input[name="move_type"]').click(function() {
            $('input[name="move_date"]').val('');
            if ($(this).val() == 2) {
                $('input[name="move_date"]').attr('disabled', false);
            } else {
                $('input[name="move_date"]').attr('disabled', true);
            }
        });

        // 권리금 체크 없음 있음
        $('input[name="is_premium"]').change(function() {
            $('#premium_price').val('');
            if ($(this).val() == 0) {
                $('#premium_price').attr('disabled', true);
            } else {
                $('#premium_price').attr('disabled', false);
            }
        });

        var payment_type = {
            0: '매매',
            1: '임대',
            2: '단기임대',
            3: '전세',
            4: '월세',
            5: '전매'
        };

        $('input[name="payment_type"]').change(function() {
            $('#price').val('');
            $('#month_price').val('');
            if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 4) {
                $('#payment_price_text').text(payment_type[$(this).val()] + "가");
                $('.month_price_input').css('display', '');
            } else {
                $('#payment_price_text').text("보증금");
                $('.month_price_input').css('display', 'none');
            }
        });

        $('input[name="is_use"]').change(function() {
            $('#current_price').val('');
            $('#current_month_price').val('');
            if ($(this).val() == 1) {
                $('#current_price').attr('disabled', false);
                $('#current_month_price').attr('disabled', false);
            } else {
                $('#current_price').attr('disabled', true);
                $('#current_month_price').attr('disabled', true);
            }
        });



        // 가임시주소 검색
        function seach_address() {
            var sidoName = $('#region_code_1 option:selected').text();
            var sigunguName = $('#region_code_2 option:selected').text();
            var dongName = $('#region_code_3 option:selected').text();
            var riName = $('#region_code_4 option:selected').text();

            var address = sidoName + ' ' + sigunguName + ' ' + dongName + ' ' + (riName == '리' ? '' : riName);

            $('.modal_address_search_close').click();

            $('#address').val(address + ' 999-99');
            $('#address_detail').val('');
            $('#address_dong').val('');
            $('#address_number').val('');
        }


        // 지역구 가져오기
        get_region('*00000000', '1');

        $('#is_address_detail').click(function() {
            if ($(this).is(':checked')) {
                $('#address_detail').val('');
                $('#address_detail').attr('disabled', true);
            } else {
                $('#address_detail').attr('disabled', false);
            }
        });

        $('#is_address_dong').click(function() {
            if ($(this).is(':checked')) {
                $('#address_dong').val('');
                $('#address_dong').attr('disabled', true);
            } else {
                $('#address_dong').attr('disabled', false);
            }
        });

        //가(임시)주소 클릭 이벤트
        document.getElementById("is_map_1").addEventListener("change", function() {


            var address_1 = document.querySelector(".detail_address_1");
            var address_2 = document.querySelector(".detail_address_2");
            var search_1 = document.querySelector(".search_address_1");
            var search_2 = document.querySelector(".search_address_2");
            var is_temporary_0 = document.querySelector("#is_temporary_0");
            var is_temporary_1 = document.querySelector("#is_temporary_1");

            if (this.checked) {
                address_1.style.display = "none";
                address_2.style.display = "";
                search_1.style.display = "none";
                search_2.style.display = "";
                is_temporary_0.style.display = "none";
                is_temporary_1.style.display = "";
                $('#is_map_0').attr('checked', false);
            } else {
                address_1.style.display = "";
                address_2.style.display = "none";
                search_1.style.display = "";
                search_2.style.display = "none";
                is_temporary_0.style.display = "";
                is_temporary_1.style.display = "none";
                $('#is_map_0').attr('checked', true);
            }
        });

        // 지역 가져오는 api
        function get_region(regcode, region) {
            var gatewayUrl =
                "https://grpc-proxy-server-mkvo6j4wsq-du.a.run.app/v1/regcodes?regcode_pattern=" + regcode +
                "&is_ignore_zero=true";

            $.ajax({
                url: gatewayUrl,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    // Check if 'regcodes' property exists and is an array
                    if (response.regcodes && Array.isArray(response.regcodes)) {
                        var select = $("#region_code_" + region);
                        select.empty();

                        // Iterate over the 'regcodes' array
                        if (region == 1) {
                            select.append($("<option>").text('시/도').val(''));
                            response.regcodes.forEach(function(regcodeObj, index) {
                                // Assuming 'code' is the property you want to use for the option value
                                var regcode = regcodeObj.code;
                                // Assuming 'name' is the property you want to use for the option text
                                var name = regcodeObj.name;
                                select.append($("<option>").text(name).val(regcode.substring(0, 2)));
                            });
                        } else if (region != 1) {
                            if (region == 2) {
                                $('#region_code_2').append($("<option>").text('시/군/구').val(''));
                            } else if (region == 3) {
                                $('#region_code_3').append($("<option>").text('읍/면/동').val(''));
                            } else if (region == 4) {
                                $('#region_code_4').append($("<option>").text('리').val(''));
                            }
                            var options = [];
                            for (var i = 0; i < response.regcodes.length; i++) {
                                var regcodeObj = response.regcodes[i];
                                var regcode = regcodeObj.code;
                                var nameParts = regcodeObj.name.split(' ');
                                if (region == 2) {
                                    regcode = regcode.substring(4, 5) > 0 ? regcode.substring(0, 5) : regcode
                                        .substring(0, 4)
                                    var name = nameParts.length > 1 ? nameParts.slice(1).join(' ') : regcodeObj
                                        .name;
                                } else if (region == 3) {
                                    regcode = regcode.substring(0, 8)
                                    var name = nameParts.length > 2 ? nameParts.slice(2).join(' ') : regcodeObj
                                        .name;
                                } else if (region == 4) {
                                    regcode = regcode
                                    var name = nameParts.length > 3 ? nameParts.slice(3).join(' ') : regcodeObj
                                        .name;
                                }
                                options.push({
                                    name: name,
                                    value: regcode
                                });
                            }

                            // Sort options based on the 'name' property
                            options.sort(function(a, b) {
                                return a.name.localeCompare(b.name);
                            });

                            // Append sorted options to the select element
                            for (var i = 0; i < options.length; i++) {
                                select.append($("<option>").text(options[i].name).val(options[i].value));
                            }
                        }

                        $('#seach_address').attr("disabled", true);

                    } else {
                        console.error("Invalid response format. 'regcodes' array not found.", region);
                        if (region == 4) {
                            $('#seach_address').attr("disabled", false);
                        }
                    }
                },
                error: function(error) {
                    console.error("Error fetching regcodes:", error);
                }
            });
        }

        var initialTexts = ["시/도", "시/군/구", "읍/면/동", "리"];

        // 모든 라벨에 대한 클릭 이벤트 처리
        $('.region_code').on("change", function(event) {
            var clickedElement = event.target.id; // 클릭된 요소를 가져옴

            // 클릭된 요소가 라벨인 경우
            var index = clickedElement.split("_")[2]; // 인덱스 추출

            // 현재 클릭된 라벨의 인덱스
            var currentIndex = parseInt(index) + 1;

            // 상위 select가 변경될 때마다 현재 select보다 높은 인덱스를 가진 하위 select를 모두 초기화
            for (var i = currentIndex + 1; i <= 4; i++) {
                $('#region_code_' + i).empty(); // 하위 select를 초기화
                $('#region_code_' + i).append($("<option>").text(initialTexts[i - 1]).val('')); // 하위 select를 초기화
            }

            var region_code = '';
            // 주소 가져오기
            if (currentIndex < 5) {
                check_code = $('#' + clickedElement).val();
                if (currentIndex == 2) {
                    region_code = check_code + '*00000'
                } else if (currentIndex == 3) {
                    region_code = check_code + '*00'
                } else if (currentIndex == 4) {
                    region_code = check_code + '*'
                }
                get_region(region_code, currentIndex);
            } else {
                $('#seach_address').attr("disabled", false);
            }

            $('#region_code').val(check_code);

        });
    </script>



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

            $('#address').val(rtAddrPart1)

            $('#address_detail').val('');
            $('#address_dong').val('');
            $('#address_number').val('');

            if (!$("#address_detail").prop('disabled')) {
                $('#address_detail').val(rtAddrDetail);
            }

            $('#region_code').val(rtAdmCd);

            var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

            $('input[name=address_lng]').val(wgs84Coords[0]);
            $('input[name=address_lat]').val(wgs84Coords[1]);

            callJusoroMapApiType1(rtentX, rtentY);

            console.log('주소 검색 끝!');

        }
    </script>

</x-admin-layout>
