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
                                                value="{{ $i }}">
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
                                                value="{{ $i }}">
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
                                                value="{{ $i }}">
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

                            <a onclick="getAddress()" class="btn btn-outline search_address_1"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>

                            <a class="btn btn-outline search_address_2" data-bs-toggle="modal"
                                data-bs-target="#modal_address_search"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                가(임시)주소 검색 </a>

                            <label class="form-check form-check-custom form-check-inline p-1">
                                <input class="form-check-input" name="temporary_address" id="temporary_address"
                                    type="checkbox" value="1">
                                <span class="fw-semibold ps-2 fs-6">가(임시)주소</span>
                            </label>

                            <input type="text" name="address" id="address" class="form-control " readonly
                                placeholder="" value="{{ old('address') ? old('address') : $result->address }}" />

                            <div class="mb-6"
                                style="border: 1px solid #D2D1D0; border-radius: 5px; display: flex; align-items: center; color:#D2D1D0; justify-content:center; text-align: center; line-height: 1.4; height: 400px; margin-top:18px;">
                                <div id="is_temporary_0">
                                    주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                                </div>
                                <div id="is_temporary_1" style="display: none">
                                    가(임시)주소 선택시,<br>지도 노출이 불가능합니다.
                                </div>
                            </div>

                            <div class="detail_address_1">
                                <span class="fs-6">상세주소</span>
                                <input type="text" name="address_detail" id="address_detail" class="form-control"
                                    placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호"
                                    value="{{ old('address_detail') ? old('address_detail') : $result->address_detail }}">
                                <label class="form-check form-check-custom form-check-inline p-1">
                                    <input class="form-check-input" name="is_address_detail" id="is_address_detail"
                                        type="checkbox" value="1">
                                    <span class="fw-semibold ps-2 fs-6">상세주소 없음</span>
                                </label>
                            </div>

                            <div class="detail_address_2 row">
                                <span class="fs-6">상세주소</span>

                                <div class="col-lg-3 fv-row">
                                    <div class="input-group mb-5">
                                        <input type="text" name="address_dong" id="address_dong"
                                            class="form-control"
                                            value="{{ old('address_dong') ? old('address_dong') : $result->address_dong }}" />
                                        <span class="input-group-text" id="basic-addon2">동<span>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('address_dong')" />
                                </div>

                                <div class="col-lg-3 fv-row">
                                    <div class="input-group mb-5">
                                        <input type="text" name="address_number" class="form-control"
                                            value="{{ old('address_number') ? old('address_number') : $result->address_number }}" />
                                        <span class="input-group-text" id="basic-addon2">호<span>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('address_number')" />
                                </div>

                                <label class="form-check form-check-custom form-check-inline p-1">
                                    <input class="form-check-input" name="is_address_dong" id="is_address_dong"
                                        type="checkbox" value="1">
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
                    <div class="row mb-6">
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

                    {{-- 공급 면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">공급 면적</label>
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

                    {{-- 전용 면적 --}}
                    <div class="row mb-6">
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
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">사용승인일</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="approve_date" class="form-control" placeholder="예) 20230204"
                                value="{{ old('approve_date') ? old('approve_date') : $result->approve_date }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('approve_date')" />
                        </div>
                    </div>

                    {{-- 건축물 용도 --}}
                    <div class="row mb-6">
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
                    <div class="row mb-6">
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
                                placeholder="예) 20230204"
                                value="{{ old('move_date') ?? $result->move_date == null ? '' : $result->move_date->format('Y-m-d') }}"
                                @if ($result->move_type != 2) disabled @endif />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('move_date')" />
                        </div>
                    </div>

                    {{-- 월 관리비 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">월 관리비</label>
                        <div class="col-md-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="service_price" id="service_price" class="form-control"
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
                                    @for ($i = 0; $i < count(Lang::get('commons.payment_type')); $i++)
                                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                            <input class="form-check-input" name="payment_type" type="radio"
                                                value="{{ $i }}"
                                                @if ($result->priceInfo->payment_type == $i) checked @endif>
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.payment_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-4 fv-row price_input">
                                        <span class="fs-6">매매가</span>
                                        <div class="input-group mb-6">
                                            <input type="text" name="price" id="price" class="form-control"
                                                placeholder="예) 10"
                                                value="{{ old('price') ?? $result->priceInfo->price }}" />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 fv-row month_price_input">
                                        <span class="fs-6">월 임대료</span>
                                        <div class="input-group">
                                            <input type="text" name="month_price" id="month_price"
                                                class="form-control" placeholder="예) 10"
                                                value="{{ old('month_price') ?? $result->priceInfo->month_price }}" />
                                            <span class="input-group-text" id="basic-addon2">원<span>
                                        </div>
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('month_price')" />
                                    </div>
                                    <div class=" fv-row">
                                        <label class="form-check form-check-custom form-check-inline p-1">
                                            <input class="form-check-input" name="is_price_discussion"
                                                id="is_price_discussion" type="checkbox" value="1">
                                            <span class="fw-semibold ps-2 fs-6">관리비 없음</span>
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
                                <div class="col-lg-8 fv-row mb-6">
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

                                    <div class="col-lg-4 fv-row month_price_input">
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
                                value="{{ old('weight') ? old('weight') : $result->productAddInfoweight ?? '' }}" />
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
                </div>
            </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'매물 상태'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                </div>
            </x-screen-card>
        </div>

        <div class="app-container container-xxl">
            <x-screen-card :title="'중개보수'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
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
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
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
                        <button type="button" class="btn btn-primary" id="seach_address" onclick="seach_address()"
                            disabled>
                            검색
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal 가(임시)주소 검색 : e-->

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initDatepicker($('#move_date'), "{{ old('move_date') }}");

        initDaterangepicker();

        // 이미지 드롭 존 있을 경우
        initImageDropzone();
    </script>

    <script>
        $(document).ready(function() {
            if ($('input[name="is_option"]:checked').val() == 0) {
                $('.option_type').attr('disabled', true);
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


        // 가임시주소 검색
        function seach_address() {
            var sidoName = $('#region_code_1 option:selected').text();
            var sigunguName = $('#region_code_2 option:selected').text();
            var dongName = $('#region_code_3 option:selected').text();
            var riName = $('#region_code_4 option:selected').text();

            var address = sidoName + ' ' + sigunguName + ' ' + dongName + ' ' + (riName == '리' ? '' : riName);

            $('#modal_address_search').modal('hide');

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
        document.getElementById("temporary_address").addEventListener("change", function() {
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
            } else {
                address_1.style.display = "";
                address_2.style.display = "none";
                search_1.style.display = "";
                search_2.style.display = "none";
                is_temporary_0.style.display = "";
                is_temporary_1.style.display = "none";
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

            console.log('주소 검색 끝!');

        }
    </script>

</x-admin-layout>
