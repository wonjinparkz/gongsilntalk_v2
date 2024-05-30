<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'등록자 정보'">
            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 프로필 사진 --}}
                <div class="row-lg-12 mb-10">
                    <div class="symbol symbol-100px symbol-circle mb-5">
                        @if ($result->users->images != null)
                            @foreach ($result->users->images as $image)
                                <img src="{{ Storage::url('image/' . $image->path) }}" />
                            @endforeach
                        @else
                            <img src="{{ asset('assets/media/default_user.png') }}" />
                        @endif
                    </div>
                </div>

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

                {{-- 중개사무소명 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">중개사무소명</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="중개사무소명"
                            value="{{ $result->users->company_name }}" />
                    </div>
                </div>

                {{-- 대표자명 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">대표자명</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="대표자명"
                            value="{{ $result->users->company_ceo }}" />
                    </div>
                </div>

                {{-- 주소 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="주소"
                            value="{{ $result->users->company_address . ' ' . $result->users->company_address_detail }}" />
                    </div>
                </div>

                {{-- 대표 전화번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">대표 전화번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="대표 전화번호"
                            value="{{ $result->users->company_phone }}" />
                    </div>
                </div>

                {{-- 대표 전화번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">대표 전화번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="대표 전화번호"
                            value="{{ $result->users->company_phone }}" />
                    </div>
                </div>

                {{-- 중개등록번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">중개등록번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="중개등록번호"
                            value="{{ $result->users->brokerage_number }}" />
                    </div>
                </div>

                {{-- 사업자 등록번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">사업자 등록번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="사업자 등록번호"
                            value="{{ $result->users->company_number }}" />
                    </div>
                </div>

                {{-- 등록매물 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">등록매물</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="등록매물"
                            value="{{ $productCount }}" />
                    </div>
                </div>


            </div>
            <!--내용 END-->
        </x-screen-card>
    </div>

    @php
        $type = $result->type;
    @endphp

    <div class="app-container container-xxl">
        <x-screen-card :title="'매물 기본 정보'">
            {{-- FORM START  --}}

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 매물종류 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">매물종류</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            @php
                                $typeText = '';
                                if ($type < 8) {
                                    $typeText = '산업용 > ';
                                } elseif ($type > 7 && $type < 14) {
                                    $typeText = '주거용 > ';
                                } elseif ($type > 13) {
                                    $typeText = '분양권 > ';
                                }

                                echo $typeText . Lang::get('commons.product_type.' . $type);
                            @endphp
                        </label>
                    </div>
                </div>

                {{-- 주소 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ $result->is_map == 0 ? '가(임시)주소 ' : '' }}<span
                                class="fw-bolder">{{ $result->address }}</span>
                        </label>


                        <div class="mb-6"
                            style="border: 1px solid #D2D1D0; border-radius: 5px; display: flex; align-items: center; color:#D2D1D0; justify-content:center; text-align: center; line-height: 1.4; height: 500px; margin-top:18px; position: relative;">
                            <div id="is_temporary_0" style="position: absolute; width: 100%; height: 100%; display:;">
                                <div id="mapWrap" class="mapWrap"
                                    style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                            </div>
                            <div id="is_temporary_1" style="display: ">
                                가(임시)주소 선택시,<br>지도 노출이 불가능합니다.
                            </div>
                        </div>

                        <div class="detail_address_1">
                            <span class="fs-6">
                                상세주소&nbsp;&nbsp;
                                <span class="fs-5 fw-normal">
                                    @if ($result->is_map == 0)
                                        {{ $result->address_dong ? $result->address_dong . '동 ' : '' }}
                                        {{ $result->address_number ? $result->address_number . '호' : '' }}
                                        {{ !$result->address_dong ? '동정보 없음' : '' }}
                                    @else
                                        {{ $result->address_detail ? $result->address_detail : '상세주소 정보 없음' }}
                                    @endif
                                </span>
                            </span>
                            <input type="hidden" name="address_lat" id="address_lat"
                                value="{{ $result->address_lat }}">
                            <input type="hidden" name="address_lng" id="address_lng"
                                value="{{ $result->address_lng }}">
                        </div>
                    </div>

                </div>

                {{-- 해당층/전체층 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">해당층/전체층</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ $result->floor_number . '층 / ' . $result->total_floor_number . '층' }}
                        </label>
                    </div>
                </div>

                {{-- 최저층/최고층 --}}
                <div class="row mb-6" style="display:{{ $type == 7 ? '' : 'none' }}">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">최저층/최고층</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ $result->lowest_floor_number . '층 / ' . $result->top_floor_number . '층' }}
                        </label>
                    </div>
                </div>

                {{-- 공급 면적 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                        {{ in_array($type, ['6', '7']) ? '대지면적' : '공급면적' }}
                    </label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ $result->area . '평 / ' . $result->square . '㎡' }}
                        </label>
                    </div>

                </div>

                {{-- 연면적 --}}
                <div class="row mb-6" style="display: {{ $type != 7 ? 'none' : '' }}">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                        연면적
                    </label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ $result->total_floor_area . '평 / ' . $result->total_floor_square . '㎡' }}
                        </label>
                    </div>

                </div>

                {{-- 전용 면적 --}}
                <div class="row mb-6" style="display: {{ $type == 6 ? 'none' : '' }}">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                        전용 면적
                    </label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ $result->exclusive_area . '평 / ' . $result->exclusive_square . '㎡' }}
                        </label>
                    </div>
                </div>

                {{-- 사용승인일 --}}
                <div class="row mb-6 no_forest">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6 approve_date_text">
                        {{ $type > 13 ? '준공예정일' : '사용승인일' }}
                    </label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            @inject('carbon', 'Carbon\Carbon')
                            {{ $carbon::parse($result->approve_date)->format('Y.m.d') }}
                        </label>
                    </div>
                </div>

                {{-- 건축물 용도 --}}
                <div class="row mb-6">
                    <label
                        class="col-lg-2 col-form-label fw-semibold fs-6">{{ $type != 6 ? '건축물 용도' : '주용도' }}</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            {{ Lang::get('commons.building_type.' . $result->building_type) }}
                        </label>
                    </div>
                </div>

                {{-- 입주가능일 --}}
                <div class="row mb-6 no_forest">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">입주가능일</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            @if ($result->move_type == 0)
                                즉시입주
                            @elseif($result->move_type == 1)
                                날짜협의
                            @else
                                직접입력<br>{{ $carbon::parse($result->move_date)->format('Y.m.d') }}
                            @endif

                        </label>
                    </div>
                </div>

                {{-- 월 관리비 --}}
                <div class="row mb-6 no_forest">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">월 관리비</label>
                    <div class="col-lg-10 fv-row">
                        <div clas="row">
                            <label class="col-form-label fw-semibold fs-6">
                                @if ($result->is_service != 0)
                                    관리비 없음
                                @else
                                    {{ number_format($result->parking_price / 10000) . '만원' }}
                                @endif
                            </label>
                        </div>
                        @php
                            $service_type = $result->productServices->pluck('type')->toArray();
                        @endphp
                        <div class="row">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">관리비 항목</label>
                            <div class="col-lg-10 fv-row">
                                @foreach ($service_type as $index => $serviceType)
                                    <label class="col-form-label fw-semibold fs-6">
                                        {{ Lang::get('commons.service_type.' . $serviceType) }}{{ $index < count($service_type) - 1 ? ',' : '' }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 융자금 --}}
                @php
                    $loan_type = $result->loan_type;
                @endphp
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">융자금</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            @if ($result->loan_type == 1)
                                30%미만 {{ number_format($result->loan_price) }}원
                            @elseif($result->loan_type == 2)
                                30%이상 {{ number_format($result->loan_price) }}원
                            @else
                                융자없음
                            @endif
                        </label>
                    </div>
                </div>

                {{-- 주차 가능 여부 --}}
                <div class="row mb-6 no_forest">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">주차 가능 여부</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-form-label fw-semibold fs-6">
                            @if ($result->parking_type == 1)
                                가능&nbsp;&nbsp;
                                {{ $result->parking_price > 0 ? '주차비 월' . number_format($result->parking_price) . '원' : '무료주차' }}
                            @elseif($result->parking_type == 2)
                                불가능
                            @else
                                선택안함
                            @endif
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
                @php
                    $payment_type = $result->priceInfo->payment_type;
                    if ($payment_type == '1' || $payment_type == '2' || $payment_type == '4') {
                        $payment_price_text = '보증금';
                    } else {
                        $payment_price_text = Lang::get('commons.payment_type.' . $payment_type) . '가';
                    }

                    $monthText = $payment_type == 4 ? '월세' : '월 임대료';
                @endphp
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">거래 유형</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-lg-1 col-form-label fw-semibold fs-6 fw-bolder">
                            {{ Lang::get('commons.payment_type.' . $payment_type) }}
                        </label>
                        <label class="col-lg-1 col-form-label fw-semibold fs-6">
                            {{ $payment_price_text }}
                        </label>
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">
                            {{ number_format($result->priceInfo->price) . '원' }}
                        </label>
                        @if (in_array($payment_type, [1, 2, 4]))
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                {{ '/ ' . $monthText . ' ' . number_format($result->priceInfo->month_price) . '원' }}
                            </label>
                        @endif
                        @if ($result->priceInfo->is_price_discussion == 1)
                            <label class="col-lg-1 col-form-label fw-semibold fs-6">
                                협의 가능
                            </label>
                        @endif

                    </div>
                </div>

                {{-- 기존 임대차 내용 --}}
                <div class="row mb-6" style="display: @if ($type > 13) none @endif">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">기존 임대차 내용</label>
                    <div class="col-lg-10 fv-row">
                        <label class="col-lg-1 col-form-label fw-semibold fs-6 fw-bolder">
                            {{ $result->priceInfo->is_use == 0 ? '없음' : '있음' }}
                        </label>
                        @if ($result->priceInfo->is_use == 1)
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                {{ '현 보증금 ' . number_format($result->priceInfo->current_price) . '원' }}
                            </label>
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                / {{ ' 현 월임대료 ' . number_format($result->priceInfo->current_month_price) . '원' }}
                            </label>
                        @endif
                    </div>
                </div>

                {{-- 권리금 --}}
                <div class="row mb-6" style="{{ $type == 3 || $type > 13 ? '' : 'display: none;' }}">
                    <label
                        class="col-lg-2 col-form-label fw-semibold fs-6 is_store_text">{{ $type == 3 ? '권리금' : '프리미엄' }}</label>
                    <div class="col-lg-10 fv-row">
                        <div class="row mb-6">
                            <div class="col-lg-8 fv-row is_store"
                                style="display: @if ($type != 3) none @endif">
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="is_premium" type="radio" value="0"
                                        @if ($result->is_premium == 0) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">없음</span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                    <input class="form-check-input" name="is_premium" type="radio"
                                        value="1"@if ($result->is_premium == 1) checked @endif>
                                    <span class="fw-semibold ps-2 fs-6">있음</span>
                                </label>
                            </div>
                            <div class="row mb-6">
                                <div class="col-lg-4 fv-row">
                                    <div class="input-group">
                                        <input type="text" name="premium_price" id="premium_price"
                                            class="form-control" placeholder="예) 10"
                                            value="{{ $result->priceInfo->premium_price }}"
                                            @if ($result->is_premium == 0 && $type == 3) disabled @endif />
                                        <span class="input-group-text" id="basic-addon2">원</span>
                                    </div>
                                </div>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('premium_price')" />
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
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">방/욕실 수</label>
                    <div class="col-lg-10 fv-row row">
                        <div class="col-lg-4 align-items-center ">
                            <div class="input-group">
                                <input type="text" name="room_count" class="form-control" placeholder="방 수"
                                    value="{{ $result->productAddInfo->room_count }}" />
                                <span class="input-group-text" id="basic-addon2">개</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('room_count')" />
                        </div>
                        <div class="col-lg-4 align-items-center ">
                            <div class="input-group">
                                <input type="text" name="bathroom_count" class="form-control" placeholder="욕실 수"
                                    value="{{ $result->productAddInfo->bathroom_count }}" />
                                <span class="input-group-text" id="basic-addon2">개</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('bathroom_count')" />
                        </div>
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
                                    @if ($result->productAddInfo->current_business_type == "$i") selected @endif>
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
                                    @if ($result->productAddInfo->recommend_business_type == "$i") selected @endif>
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
                                    @if ($result->productAddInfo->direction_type == "$i") selected @endif>
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
                                    @if ($result->productAddInfo->cooling_type == $i) selected @endif>
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
                                    @if ($result->productAddInfo->heating_type == $i) selected @endif>
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
                        <div class="input-group">
                            <input type="text" name="weight" class="form-control" placeholder="예) 0.8"
                                value="{{ $result->productAddInfo->weight }}" />
                            <span class="input-group-text" id="basic-addon2">톤</span>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('weight')" />
                    </div>
                </div>

                {{-- 승강시설 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">승강시설</label>
                    <div class="col-lg-10 fv-row">
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_elevator" type="radio" value="0"
                                @if ($result->productAddInfo->is_elevator == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">없음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_elevator" type="radio" value="1"
                                @if ($result->productAddInfo->is_elevator == 1) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">있음</span>
                        </label>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_elevator')" />
                    </div>
                </div>

                {{-- 화물용 승강시설 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">화물용 승강시설</label>
                    <div class="col-lg-10 fv-row">
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_goods_elevator" type="radio" value="0"
                                @if ($result->productAddInfo->is_goods_elevator == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">없음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_goods_elevator" type="radio" value="1"
                                @if ($result->productAddInfo->is_goods_elevator == 1) checked @endif>
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
                                @if ($result->productAddInfo->structure_type == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="structure_type" type="radio" value="1"
                                @if ($result->productAddInfo->structure_type == 1) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">복층</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="structure_type" type="radio" value="2"
                                @if ($result->productAddInfo->structure_type == 2) checked @endif>
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
                                @if ($result->productAddInfo->builtin_type == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="builtin_type" type="radio" value="1"
                                @if ($result->productAddInfo->builtin_type == 1) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">있음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="builtin_type" type="radio" value="2"
                                @if ($result->productAddInfo->builtin_type == 2) checked @endif>
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
                                @if ($result->productAddInfo->interior_type == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="interior_type" type="radio" value="1"
                                @if ($result->productAddInfo->interior_type == 1) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">있음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="interior_type" type="radio" value="2"
                                @if ($result->productAddInfo->interior_type == 2) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">없음</span>
                        </label>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('interior_type')" />
                    </div>
                </div>

                {{-- 전입신고 가능 여부 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전입신고 가능 여부</label>
                    <div class="col-lg-10 fv-row">
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="declare_type" type="radio" value="0"
                                @if ($result->productAddInfo->declare_type == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="declare_type" type="radio" value="1"
                                @if ($result->productAddInfo->declare_type == 1) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">가능</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="declare_type" type="radio" value="2"
                                @if ($result->productAddInfo->declare_type == 2) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">불가능</span>
                        </label>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('declare_type')" />
                    </div>
                </div>

                {{-- 도크 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도크</label>
                    <div class="col-lg-10 fv-row">
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_dock" type="radio" value="0"
                                @if ($result->productAddInfo->is_dock == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">없음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_dock" type="radio" value="1"
                                @if ($result->productAddInfo->is_dock == 1) checked @endif>
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
                                @if ($result->productAddInfo->is_hoist == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">없음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_hoist" type="radio" value="1"
                                @if ($result->productAddInfo->is_hoist == 1) checked @endif>
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
                                    value="0" @if ($result->productAddInfo->floor_height_type == "$i") checked @endif>
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
                                <input class="form-check-input" name="wattage_type" type="radio" value="0"
                                    @if ($result->productAddInfo->wattage_type == "$i") checked @endif>
                                <span
                                    class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.wattage_type.' . $i) }}</span>
                            </label>
                        @endfor
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('wattage_type')" />
                    </div>
                </div>

                {{-- 옵션 정보 --}}
                <div class="row mb-6 is">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">옵션 정보</label>

                    <div class="col-lg-10 fv-row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">옵션 정보</label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_option" type="radio" value="0"
                                @if ($result->productAddInfo->is_option == 0) checked @endif>
                            <span class="fw-semibold ps-2 fs-6">없음</span>
                        </label>
                        <label class="form-check form-check-custom form-check-inline me-5 p-1">
                            <input class="form-check-input" name="is_option" type="radio" value="1"
                                @if ($result->productAddInfo->is_option == 1) checked @endif>
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
                                        <input class="form-check-input option_type option_facility"
                                            name="option_type[]" type="checkbox" value="{{ $option_count }}"
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
                                        <input class="form-check-input option_type option_security"
                                            name="option_type[]" type="checkbox" value="{{ $option_count }}"
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
                                        <input class="form-check-input option_type option_kitchen"
                                            name="option_type[]" type="checkbox" value="{{ $option_count }}"
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
                                        <input class="form-check-input option_type option_home_appliances"
                                            name="option_type[]" type="checkbox" value="{{ $option_count }}"
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
                                        <input class="form-check-input option_type option_furniture"
                                            name="option_type[]" type="checkbox" value="{{ $option_count }}"
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
                                        <input class="form-check-input option_type option_etc" name="option_type[]"
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

                <div class="yes_forest">
                    {{-- 국토이용 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">국토이용</label>
                        <div class="col-lg-10 fv-row">
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="land_use_type" type="radio" value="0"
                                    @if ($result->productAddInfo->land_use_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="land_use_type" type="radio" value="1"
                                    @if ($result->productAddInfo->land_use_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">해당</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="land_use_type" type="radio" value="2"
                                    @if ($result->productAddInfo->land_use_type == 2) checked @endif>
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
                                <input class="form-check-input" name="city_plan_type" type="radio" value="0"
                                    @if ($result->productAddInfo->city_plan_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="city_plan_type" type="radio" value="1"
                                    @if ($result->productAddInfo->city_plan_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">단층</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="city_plan_type" type="radio" value="2"
                                    @if ($result->productAddInfo->city_plan_type == 2) checked @endif>
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
                                    value="0" @if ($result->productAddInfo->building_permit_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="building_permit_type" type="radio"
                                    value="1" @if ($result->productAddInfo->building_permit_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">발급</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="building_permit_type" type="radio"
                                    value="2" @if ($result->productAddInfo->building_permit_type == 2) checked @endif>
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
                                    value="0" @if ($result->productAddInfo->land_permit_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="land_permit_type" type="radio"
                                    value="1" @if ($result->productAddInfo->land_permit_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">해당</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="land_permit_type" type="radio"
                                    value="2" @if ($result->productAddInfo->land_permit_type == 2) checked @endif>
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
                                    value="0" @if ($result->productAddInfo->access_load_type == 0) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">선택 안함</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="access_load_type" type="radio"
                                    value="1" @if ($result->productAddInfo->access_load_type == 1) checked @endif>
                                <span class="fw-semibold ps-2 fs-6">있음</span>
                            </label>
                            <label class="form-check form-check-custom form-check-inline me-5 p-1">
                                <input class="form-check-input" name="access_load_type" type="radio"
                                    value="2" @if ($result->productAddInfo->access_load_type == 2) checked @endif>
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
                            placeholder="예) 역에서 5분거리, 인프라 좋은 매물" value="{{ $result->comments }}" />
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('comments')" />
                    </div>
                </div>

                {{-- 상세설명 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">상세설명</label>
                    <div class="col-lg-10 fv-row">
                        <textarea name="contents" class="form-control mb-5" rows="5" placeholder="주변 편의시설, 역세권 등의 정보를 입력해주세요.">{{ $result->contents }}</textarea>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('contents')" />
                    </div>
                </div>

                {{-- 3D 이미지 링크 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">3D 이미지 링크</label>
                    <div class="col-lg-10 fv-row">
                        <input type="text" name="image_link" class="form-control" placeholder="링크를 입력해 주세요."
                            value="{{ $result->image_link }}" />
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
                        <input type="text" disabled class="form-control form-control-solid" placeholder="최종 수정자"
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
                                    value="{{ $i }}" @if ($result->state == "$i") checked @endif>
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
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">중개보수(부가세별도)</label>
                    <div class="col-lg-10 fv-row">
                        <input type="text" name="commission" class="form-control" placeholder="중개보수(부가세별도)"
                            value="{{ $result->commission }}" />
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('commission')" />
                    </div>
                </div>

                {{-- 상한요율(%) --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">상한요율(%)</label>
                    <div class="col-lg-10 fv-row">
                        <input type="text" name="commission_rate" class="form-control" placeholder="상한요율(%)"
                            value="{{ $result->commission_rate }}" />
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('commission_rate')" />
                    </div>
                </div>

            </div>
        </x-screen-card>
    </div>


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

    {{-- 지도 맵 api js --}}
    <script type="text/javascript"
        src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey={{ env('CONFM_MAP_KEY') }}&skinType=1">
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
    </script>

    <script>
        $(document).ready(function() {

            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
                .remove();

            var wgs84Coords = get_coordinate_conversion1($('input[name=address_lng]').val(), $(
                'input[name=address_lat]').val())

            if ({{ $result->is_map ?? 1 }} == 1) {
                setTimeout(function() {
                    callJusoroMapApiType1(wgs84Coords[0], wgs84Coords[1]);
                }, 2000);
            } else {
                setTimeout(function() {
                    $('#is_temporary_0').hide()
                }, 2000);
            }

        });


        // type1.좌표정보(GRS80, EPSG:5179)
        function callJusoroMapApiType1(rtentX, rtentY) {
            window.postMessage({
                functionName: 'callJusoroMapApi',
                params: [rtentX, rtentY]
            }, '*');
        }
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
    </script>

</x-admin-layout>
