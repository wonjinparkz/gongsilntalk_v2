<x-layout>
    <form class="find_form" method="POST" action="{{ route('www.corp.product.create.add.info.check') }}"
        name="create_check">
        <input type="hidden" name="type" id="type" value="{{ $result['type'] }}">
        <input type="hidden" name="payment_type" id="payment_type" value="{{ $result['payment_type'] }}">
        <input type="hidden" name="price" id="price" value="{{ $result['price'] }}">
        <input type="hidden" name="month_price" id="month_price" value="{{ $result['month_price'] ?? '' }}">
        <input type="hidden" name="is_price_discussion" id="is_price_discussion"
            value="{{ $result['is_price_discussion'] ?? '' }}">
        <input type="hidden" name="is_use" id="is_use" value="{{ $result['is_use'] ?? '' }}">
        <input type="hidden" name="current_price" id="current_price" value="{{ $result['current_price'] ?? '' }}">
        <input type="hidden" name="current_month_price" id="current_month_price"
            value="{{ $result['current_month_price'] ?? '' }}">
        <input type="hidden" name="is_premium" id="is_premium" value="{{ $result['is_premium'] ?? '' }}">
        <input type="hidden" name="premium_price" id="premium_price" value="{{ $result['premium_price'] ?? '' }}">
        <input type="hidden" name="approve_date" id="approve_date" value="{{ $result['approve_date'] ?? '' }}">

        <input type="hidden" name="is_map" id="is_map" value="{{ $result['is_map'] ?? '' }}">
        <input type="hidden" name="address_lng" id="address_lng" value="{{ $result['address_lng'] ?? '' }}">
        <input type="hidden" name="address_lat" id="address_lat" value="{{ $result['address_lat'] ?? '' }}">
        <input type="hidden" name="region_code" id="region_code" value="{{ $result['region_code'] ?? '' }}">
        <input type="hidden" name="region_address" id="region_address" value="{{ $result['region_address'] }}">
        <input type="hidden" name="address" id="address" value="{{ $result['address'] }}">
        <input type="hidden" name="address_detail" id="address_detail" value="{{ $result['address_detail'] ?? '' }}">
        <input type="hidden" name="address_dong" id="address_dong" value="{{ $result['address_dong'] ?? '' }}">
        <input type="hidden" name="address_number" id="address_number" value="{{ $result['address_number'] ?? '' }}">

        <input type="hidden" name="floor_number" id="floor_number" value="{{ $result['floor_number'] ?? '' }}">
        <input type="hidden" name="total_floor_number" id="total_floor_number"
            value="{{ $result['total_floor_number'] ?? '' }}">
        <input type="hidden" name="lowest_floor_number" id="lowest_floor_number"
            value="{{ $result['lowest_floor_number'] ?? '' }}">
        <input type="hidden" name="top_floor_number" id="top_floor_number"
            value="{{ $result['top_floor_number'] ?? '' }}">
        <input type="hidden" name="area" id="area" value="{{ $result['area'] ?? '' }}">
        <input type="hidden" name="square" id="square" value="{{ $result['square'] ?? '' }}">
        <input type="hidden" name="total_floor_area" id="total_floor_area"
            value="{{ $result['total_floor_area'] ?? '' }}">
        <input type="hidden" name="total_floor_square" id="total_floor_square"
            value="{{ $result['total_floor_square'] ?? '' }}">
        <input type="hidden" name="exclusive_area" id="exclusive_area"
            value="{{ $result['exclusive_area'] ?? '' }}">
        <input type="hidden" name="exclusive_square" id="exclusive_square"
            value="{{ $result['exclusive_square'] ?? '' }}">
        <input type="hidden" name="approve_date" id="approve_date" value="{{ $result['approve_date'] ?? '' }}">
        <input type="hidden" name="building_type" id="building_type" value="{{ $result['building_type'] ?? '' }}">
        <input type="hidden" name="move_type" id="move_type" value="{{ $result['move_type'] ?? '' }}">
        <input type="hidden" name="move_date" id="move_date" value="{{ $result['move_date'] ?? '' }}">
        <input type="hidden" name="is_service" id="is_service" value="{{ $result['is_service'] ?? '' }}">
        <input type="hidden" name="service_price" id="service_price" value="{{ $result['service_price'] ?? '' }}">
        @foreach ($result['service_type'] ?? [] as $serviceType)
            <input type="hidden" name="service_type[]" value="{{ $serviceType }}">
        @endforeach
        <input type="hidden" name="loan_type" id="loan_type" value="{{ $result['loan_type'] ?? '' }}">
        <input type="hidden" name="loan_price" id="loan_price" value="{{ $result['loan_price'] ?? '' }}">
        <input type="hidden" name="parking_type" id="parking_type" value="{{ $result['parking_type'] ?? '' }}">
        <input type="hidden" name="parking_price" id="parking_price" value="{{ $result['parking_price'] ?? '' }}">

        @php
            $type = $result['type'];
        @endphp

        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a>
            </div>
            <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">4</span>/5</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span
                            class="txt_point">4</span>/5</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>추가 정보</h4>

                        @if (in_array($type, [4, 8, 9, 10, 11, 12, 13]))
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">방/욕실 수 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" name="room_count" placeholder="방 수"
                                                inputmode="numeric" oninput="onlyNumbers(this);">
                                            <span class="gray_deep">개</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" name="bathroom_count" placeholder="욕실 수"
                                                inputmode="numeric" oninput="onlyNumbers(this);">
                                            <span class="gray_deep">개</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (in_array($type, [3]))
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <input type="hidden" name="current_business_type" value="">
                                    <label class="input_label">현 업종</label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">현 업종 선택</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('current_business_type','')">
                                                현 업종 선택
                                            </li>
                                            @foreach (Lang::get('commons.product_business_type') as $index => $business_type)
                                                <li class="optionItem"
                                                    onclick="selectType('current_business_type','{{ $index }}')">
                                                    {{ $business_type }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <input type="hidden" name="recommend_business_type" value="">
                                    <label class="input_label">추천 업종</label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">추천 업종 선택</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('recommend_business_type','')">
                                                추천 업종 선택
                                            </li>
                                            @foreach (Lang::get('commons.product_business_type') as $index => $business_type)
                                                <li class="optionItem"
                                                    onclick="selectType('recommend_business_type','{{ $index }}')">
                                                    {{ $business_type }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($type != 6)
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <input type="hidden" name="direction_type" value="">
                                    <label class="input_label">건물 방향{{ $type == 5 ? '(주 출입구 기준)' : '' }}</label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">건물 방향 선택</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('direction_type','')">
                                                건물 방향 선택
                                            </li>
                                            @foreach (Lang::get('commons.direction_type') as $index => $directionType)
                                                <li class="optionItem"
                                                    onclick="selectType('direction_type','{{ $index }}')">
                                                    {{ $directionType }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="reg_item">
                                    <input type="hidden" name="cooling_type" value="">
                                    <label class="input_label">냉방 종류</label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">냉방 종류 선택</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('cooling_type','')">
                                                냉방 종류 선택
                                            </li>
                                            @foreach (Lang::get('commons.cooling_type') as $index => $coolingType)
                                                <li class="optionItem"
                                                    onclick="selectType('cooling_type','{{ $index }}')">
                                                    {{ $coolingType }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="reg_item">
                                    <input type="hidden" name="heating_type" value="">
                                    <label class="input_label">난방 종류</label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">난방 종류 선택</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('heating_type','')">
                                                난방 종류 선택
                                            </li>
                                            @foreach (Lang::get('commons.heating_type') as $index => $heatingType)
                                                <li class="optionItem"
                                                    onclick="selectType('heating_type','{{ $index }}')">
                                                    {{ $heatingType }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="reg_mid_wrap">
                            @if (in_array($type, [0, 1, 2]) || $type > 13)
                                <div class="reg_item">
                                    <label class="input_label">하중(평당)</label>
                                    <div class="flex_1 mt10">
                                        <input type="number" name="weight" placeholder="예) 0.8"
                                            class="w_input_150">
                                        <span>톤</span>
                                    </div>
                                </div>
                            @endif

                            @if ($type != 6)
                                <div class="reg_item">
                                    <label class="input_label">승강시설 <span class="txt_point">*</span></label>
                                    <div class="btn_radioType mt18">
                                        <input type="radio" name="is_elevator" id="is_elevator_1" checked
                                            value="1">
                                        <label for="is_elevator_1">있음</label>

                                        <input type="radio" name="is_elevator" id="is_elevator_0" value="0">
                                        <label for="is_elevator_0">없음</label>

                                    </div>
                                </div>
                            @endif

                            @if (in_array($type, [0, 1, 2, 7]) || $type > 13)
                                <div class="reg_item">
                                    <label class="input_label">화물용 승강시설 </label>
                                    <div class="btn_radioType mt18">
                                        <input type="radio" name="is_goods_elevator" id="is_goods_elevator_1"
                                            checked value="1">
                                        <label for="is_goods_elevator_1">있음</label>

                                        <input type="radio" name="is_goods_elevator" id="is_goods_elevator_2"
                                            value="0">
                                        <label for="is_goods_elevator_2">없음</label>

                                    </div>
                                </div>
                            @endif

                        </div>

                        @if (in_array($type, [4, 9]))
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">구조</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="structure_type" id="structure_type_0" checked
                                            value="0">
                                        <label for="structure_type_0">선택 안함</label>

                                        <input type="radio" name="structure_type" id="structure_type_1"
                                            value="1">
                                        <label for="structure_type_1">복층</label>

                                        <input type="radio" name="structure_type" id="structure_type_2"
                                            value="2">
                                        <label for="structure_type_2">1.5룸/주방분리형</label>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <label class="input_label">빌트인</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="builtin_type" id="builtin_type_0" value="0"
                                            checked>
                                        <label for="builtin_type_0">선택 안함</label>

                                        <input type="radio" name="builtin_type" id="builtin_type_1"
                                            value="1">
                                        <label for="builtin_type_1">있음</label>

                                        <input type="radio" name="builtin_type" id="builtin_type_2"
                                            value="2">
                                        <label for="builtin_type_2">없음</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="reg_mid_wrap">
                            @if (in_array($type, [0, 1, 2]) || $type > 13)
                                <div class="reg_item">
                                    <label class="input_label">인테리어 여부</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="interior_type" id="interior_type_0"
                                            value="0" checked>
                                        <label for="interior_type_0">선택 안함</label>

                                        <input type="radio" name="interior_type" id="interior_type_1"
                                            value="1">
                                        <label for="interior_type_1">있음</label>
                                        <input type="radio" name="interior_type" id="interior_type_2"
                                            value="2">
                                        <label for="interior_type_2">없음</label>
                                    </div>
                                </div>
                            @endif

                            @if (in_array($type, [4, 9]))
                                <div class="reg_item">
                                    <label class="input_label">전입신고 가능 여부</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="declare_type" id="declare_type_0" value="0"
                                            checked>
                                        <label for="declare_type_0">선택 안함</label>
                                        <input type="radio" name="declare_type" id="declare_type_1"
                                            value="1">
                                        <label for="declare_type_1">가능</label>
                                        <input type="radio" name="declare_type" id="declare_type_2"
                                            value="2">
                                        <label for="declare_type_2">불가능</label>
                                    </div>
                                </div>
                            @endif

                        </div>

                        @if ($type == 7)
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">도크</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="is_dock" id="is_dock_1" value="1" checked>
                                        <label for="is_dock_1">있음</label>
                                        <input type="radio" name="is_dock" id="is_dock_0" value="0">
                                        <label for="is_dock_0">없음</label>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <label class="input_label">호이스트</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="is_hoist" id="is_hoist_1" value="1"
                                            checked>
                                        <label for="is_hoist_1">가능</label>
                                        <input type="radio" name="is_hoist" id="is_hoist_0" value="0">
                                        <label for="is_hoist_0">불가능</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (in_array($type, [0, 1, 2, 7]) || $type > 13)
                            <div>
                                <div class="reg_item">
                                    <label class="input_label">층고</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="floor_height_type" id="floor_height_type_"
                                            value="" checked>
                                        <label for="floor_height_type_">선택 안함</label>
                                        @foreach (Lang::get('commons.floor_height_type') as $index => $floorHeightType)
                                            <input type="radio" name="floor_height_type"
                                                id="floor_height_type_{{ $index }}"
                                                value="{{ $index }}">
                                            <label
                                                for="floor_height_type_{{ $index }}">{{ $floorHeightType }}</label>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (in_array($type, [0, 1, 2, 7]) || $type > 13)
                            <div>
                                <div class="reg_item">
                                    <label class="input_label">사용전력</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="wattage_type" id="wattage_type_" value=""
                                            checked>
                                        <label for="wattage_type_">선택 안함</label>
                                        @foreach (Lang::get('commons.wattage_type') as $index => $wattageType)
                                            <input type="radio" name="wattage_type"
                                                id="wattage_type_{{ $index }}" value="{{ $index }}">
                                            <label for="wattage_type_{{ $index }}">{{ $wattageType }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($type == 6)
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">국토이용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="land_use_type" id="land_use_type_0"
                                            value="0" checked>
                                        <label for="land_use_type_0">선택 안함</label>

                                        <input type="radio" name="land_use_type" id="land_use_type_1"
                                            value="1">
                                        <label for="land_use_type_1">해당</label>

                                        <input type="radio" name="land_use_type" id="land_use_type_2"
                                            value="2">
                                        <label for="land_use_type_2">미해당</label>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <label class="input_label">도시계획</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="city_plan_type" id="city_plan_type_0"
                                            value="0" checked>
                                        <label for="city_plan_type_0">선택 안함</label>

                                        <input type="radio" name="city_plan_type" id="city_plan_type_1"
                                            value="1">
                                        <label for="city_plan_type_1">있음</label>

                                        <input type="radio" name="city_plan_type" id="city_plan_type_2"
                                            value="2">
                                        <label for="city_plan_type_2">없음</label>
                                    </div>
                                </div>
                            </div>

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">건축허가</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="building_permit_type" id="building_permit_type_0"
                                            value="0" checked>
                                        <label for="building_permit_type_0">선택 안함</label>

                                        <input type="radio" name="building_permit_type" id="building_permit_type_1"
                                            value="1">
                                        <label for="building_permit_type_1">발급</label>

                                        <input type="radio" name="building_permit_type" id="building_permit_type_2"
                                            value="2">
                                        <label for="building_permit_type_2">미발급</label>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <label class="input_label">토지거래허가구역</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="land_permit_type" id="land_permit_type_0"
                                            value="0" checked>
                                        <label for="land_permit_type_0">선택 안함</label>

                                        <input type="radio" name="land_permit_type" id="land_permit_type_1"
                                            value="1">
                                        <label for="land_permit_type_1">해당</label>

                                        <input type="radio" name="land_permit_type" id="land_permit_type_2"
                                            value="2">
                                        <label for="land_permit_type_2">미해당</label>
                                    </div>
                                </div>
                            </div>

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">진입도로</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="access_load_type" id="access_load_type_0"
                                            value="0" checked>
                                        <label for="access_load_type_0">선택 안함</label>

                                        <input type="radio" name="access_load_type" id="access_load_type_1"
                                            value="1">
                                        <label for="access_load_type_1">있음</label>

                                        <input type="radio" name="access_load_type" id="access_load_type_2"
                                            value="2">
                                        <label for="access_load_type_2">없음</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    @php
                        $option_count = 0;
                    @endphp

                    @if ($type != 6)
                        <div class="box_01 box_reg">
                            <h4>옵션 정보</h4>
                            <div>
                                <div class="reg_item">
                                    <label class="input_label">옵션 여부 <span class="txt_point">*</span></label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="is_option" id="is_option_1" value="1"
                                            checked>
                                        <label for="is_option_1">있음</label>

                                        <input type="radio" name="is_option" id="is_option_0" value="0">
                                        <label for="is_option_0">없음</label>
                                    </div>
                                    <div class="is_option_wrap">
                                        <div class="is_option_item open_key active">

                                            <div class="option_row option_facility_row">
                                                <div class="option_tit">시설</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_facility')); $i++)
                                                        <input class="option_facility" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}">
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_facility.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="option_row option_security_row">
                                                <div class="option_tit">보안</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_security')); $i++)
                                                        <input class="option_security" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}">
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_security.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="option_row option_kitchen_row">
                                                <div class="option_tit">주방</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_kitchen')); $i++)
                                                        <input class="option_kitchen" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}">
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_kitchen.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="option_row option_home_appliances_row">
                                                <div class="option_tit">가전</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_home_appliances')); $i++)
                                                        <input class="option_home_appliances" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}">
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_home_appliances.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="option_row option_furniture_row">
                                                <div class="option_tit">가구</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_furniture')); $i++)
                                                        <input class="option_furniture" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}">
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_furniture.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="option_row option_etc_row">
                                                <div class="option_tit">기타</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_etc')); $i++)
                                                        <input class="option_etc" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}">
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_etc.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                        </div>
                                        <div class="option_info_item open_key"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif



                    <div class="step_btn_wrap">
                        <button type="button" class="btn_full_basic btn_graylight_ghost"
                            onclick="location.href='javascript:history.go(-1)'">이전</button>
                        <!-- <button type="button" class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button type="submit" class="btn_full_basic btn_point confirm" disabled>다음</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->

        </div>

    </form>

    <script>
        $(document).ready(function() {
            optionSetting($('#type').val());

            inputCheck();
        });


        $('input[type="text"]').on('keyup', function() {
            inputCheck();
        });
        $('input[type="number"]').on('keyup', function() {
            inputCheck();
        });
        $('input[type="checkbox"]').change(function() {
            inputCheck();
        });
        $('input[type="radio"]').change(function() {
            inputCheck();
        });


        function inputCheck() {
            var room_count = $('input[name="room_count"]');
            var bathroom_count = $('input[name="bathroom_count"]');
            var is_option = $('input[name="is_option"]:checked').val();
            var options_checked = $('input[name="option_type[]"]:checked').length;

            var checkConfirm = false;

            if (is_option == "1" && options_checked <= 0) {
                checkConfirm = false;
            } else if (room_count.length > 0) {
                if (room_count.val() != '' && bathroom_count.val() != '') {
                    checkConfirm = true;
                } else {
                    checkConfirm = false
                }
            } else {
                checkConfirm = true;
            }

            console.log('checkConfirm : ', checkConfirm);
            if (checkConfirm) {
                $('.confirm').attr("disabled", false);
            } else {
                $('.confirm').attr("disabled", true);
            }
        }

        function optionSetting(type) {
            $('.option_row').hide();

            if ([0, 1, 2, 4, 5, 7].indexOf(parseInt(type)) !== -1) {
                // 옵션 구성
                if (type != 7) {
                    $('.option_facility_row').show();
                }
                $('.option_security_row').show();

                var option_security_valeu = [2, 7, 8, 9, 10, 11]; // 선택 가능한 옵션 value

                $('.option_security').each(function() {
                    var value = parseInt($(this).val());

                    if (!option_security_valeu.includes(value)) {
                        $(this).hide();
                        $('label[for="option_' + value + '"]').hide();

                    }
                });
            } else if (type == 3) {
                // 옵션 구성
                $('.option_facility_row').show();
                $('.option_security_row').show();

                var option_security_valeu = [2, 7, 8, 9, 10, 12]; // 선택 가능한 옵션 value

                $('.option_security').each(function() {
                    var value = parseInt($(this).val());

                    if (!option_security_valeu.includes(value)) {
                        $(this).hide();
                        $('label[for="option_' + value + '"]').hide();

                    }
                });

            } else if ([8, 9, 10, 11, 12, 13].indexOf(parseInt(type)) !== -1) {

                // 옵션 구성
                $('.option_kitchen_row').show();
                $('.option_home_appliances_row').show();
                $('.option_furniture_row').show();
                $('.option_etc_row').show();
                $('.option_security_row').show();

                var option_security_valeu = [7, 9, 12]; // 선택 가능한 옵션 value

                $('.option_security').each(function() {
                    var value = parseInt($(this).val());

                    if (!option_security_valeu.includes(value)) {
                        $(this).hide();
                        $('label[for="option_' + value + '"]').hide();

                    }
                });

            } else if (type > 13) {
                // 옵션 구성
                $('.option_facility_row').show();
                $('.option_security_row').show();

                var option_security_valeu = [2, 7, 8, 9, 10, 11]; // 선택 가능한 옵션 value

                $('.option_security').each(function() {
                    var value = parseInt($(this).val());

                    if (!option_security_valeu.includes(value)) {
                        $(this).hide();
                        $('label[for="option_' + value + '"]').hide();

                    }
                });
            }
        }

        $('input[name="is_option"]').change(function() {
            $('input[name="option_type[]"]').prop("checked", false)
            if ($(this).val() == 1) {
                $('.is_option_wrap').show();
            } else {
                $('.is_option_wrap').hide();
            }
        });

        function selectType(name, index) {
            $('input[name="' + name + '"]').val(index);

            console.log($('input[name="' + name + '"]').val());
        }
    </script>

</x-layout>
