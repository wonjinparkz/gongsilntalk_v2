<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    @php
        $payment_type = $product->priceInfo->payment_type;
        $price = $product->priceInfo->price;
        $month_price = $product->priceInfo->month_price;
        $is_price_discussion = $product->priceInfo->is_price_discussion;
        $is_use = $product->priceInfo->is_use;
        $current_price = $product->priceInfo->current_price;
        $current_month_price = $product->priceInfo->current_month_price;
        $is_premium = $product->priceInfo->is_premium;
        $premium_price = $product->priceInfo->premium_price;

        if ($product->type < 8) {
            $type = 0;
        } elseif ($product->type > 7 && $product->type < 14) {
            $type = 1;
        } elseif ($product->type > 13) {
            $type = 2;
        } else {
            $type = 0;
        }
    @endphp

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 수정</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="body">
        <form method="post" id="updateForm" action="{{ route('www.mypage.corp.product.magagement.update') }}">

            <input hidden name="id" id="id" value="{{ $product->id }}">
            <input hidden name="type" id="type" value="{{ $product->type }}">
            <input hidden name="price" id="price" value="{{ $price }}">
            <input hidden name="month_price" id="month_price" value="{{ $month_price }}">
            <input hidden name="is_price_discussion" id="is_price_discussion" value="{{ $is_price_discussion }}">
            <input hidden name="approve_date" id="approve_date" value="{{ $product->approve_date }}">
            <input hidden name="move_date" id="move_date" value="{{ $product->move_date }}">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 수정</h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>매물 유형 <span class="txt_point">*</span></h4>

                        <div class="estate_type_txt">{{ Lang::get('commons.management_product_type.' . $type) }} >
                            {{ Lang::get('commons.product_type.' . $product->type) }}
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <div class="category_wrap">
                            @if ($type == 0)
                                <!-- 상업용 : s -->
                                <div class="input_item_grid">
                                    <h4>상업용 거래 정보 <span class="txt_point">*</span></h4>
                                    <div class="btn_radioType">
                                        <input type="radio" name="payment_type" id="payment_type_1" value="0"
                                            {{ $payment_type == 0 ? 'checked' : '' }}>
                                        <label for="payment_type_1" onclick="showDiv('type', 0)">매매</label>

                                        <input type="radio" name="payment_type" id="payment_type_2" value="1"
                                            {{ $payment_type == 1 ? 'checked' : '' }}>
                                        <label for="payment_type_2" onclick="showDiv('type', 1)">임대</label>

                                        <input type="radio" name="payment_type" id="payment_type_3" value="2"
                                            {{ $payment_type == 2 ? 'checked' : '' }}>
                                        <label for="payment_type_3" onclick="showDiv('type', 1)">단기임대</label>
                                    </div>

                                    <div class="type_wrap">
                                        <!-- 매매 -->
                                        <div class="type_item open_key {{ $payment_type == 0 ? 'active' : '' }}">
                                            <div class="input_item_grid">
                                                <div>
                                                    <label class="input_label">매매가</label>
                                                    <div class="input_area_1">
                                                        <input type="text" name="input_price" id="price_1"
                                                            inputmode="numeric" value="{{ number_format($price) }}"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                        <span class="gray_deep">원</span>
                                                        <input type="checkbox" name="input_is_price_discussion"
                                                            id="is_price_discussion_1" value="Y"
                                                            {{ $is_price_discussion ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_1"
                                                            class="gray_deep"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                    <div class="txt_item_2 mt20">
                                                        {{-- <span name="price_conversion" class="price"></span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 임대, 단기임대 -->
                                        <div class="type_item open_key {{ $payment_type != 0 ? 'active' : '' }}">
                                            <div class="input_item_grid">
                                                <div class="input_area_2">
                                                    <div class="flex_between">
                                                        <div class="item">
                                                            <label class="input_label">보증금</label>
                                                            <div class="flex_1">
                                                                <input type="text" class="w_input_150"
                                                                    inputmode="numeric"
                                                                    value="{{ number_format($price) }}"
                                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                                    name="input_price" id="price_2"><span>/</span>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <label class="input_label">월임대료</label>
                                                            <div class="flex_1">
                                                                <input type="text" class="w_input_150"
                                                                    inputmode="numeric"
                                                                    value="{{ $month_price != '' ? number_format($month_price) : '' }}"
                                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                                    name="input_month_price"
                                                                    id="month_price_1"><span>원</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item_check_add">
                                                        <input type="checkbox" name="input_is_price_discussion"
                                                            id="is_price_discussion_2" value="Y"
                                                            {{ $is_price_discussion ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_2"
                                                            class="gray_deep mt18"><span></span>
                                                            협의가능</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="input_label">기존 임대차 내용</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="is_use" id="is_use_1" value="1"
                                                {{ $is_use == 1 ? 'checked' : '' }}>
                                            <label for="is_use_1" onclick="showDiv('lease', 0)">있음</label>

                                            <input type="radio" name="is_use" id="is_use_2" value="0"
                                                {{ $is_use != 1 ? 'checked' : '' }}>
                                            <label for="is_use_2" onclick="showDiv('lease', 1)">없음</label>
                                        </div>

                                    </div>

                                    <div class="lease_wrap">
                                        <div class="lease_item open_key {{ $is_use == 1 ? 'active' : '' }}">
                                            <div class="flex_between w_30">
                                                <div class="item">
                                                    <label class="input_label">현 보증금</label>
                                                    <div class="flex_1">
                                                        <input type="text" class="w_input_150" inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                            value="{{ $current_price != '' ? number_format($current_price) : '' }}"
                                                            name="current_price" id="current_price"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">현 월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="text" class="w_input_150"
                                                            name="current_month_price" inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                            value="{{ $current_month_price != '' ? number_format($current_month_price) : '' }}"
                                                            id="current_month_price"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lease_item open_key {{ $is_use != 1 ? 'active' : '' }}"></div>
                                    </div>

                                    <div style="display:{{ $product->type == 3 ? '' : 'none' }}">
                                        <label class="input_label">권리금</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="is_premium" id="is_premium_1" value="1"
                                                {{ $is_premium == 1 ? 'checked' : '' }}>
                                            <label for="is_premium_1" onclick="showDiv('keymoney', 0)">있음</label>

                                            <input type="radio" name="is_premium" id="is_premium_2" value="0"
                                                {{ $is_premium != 1 ? 'checked' : '' }}>
                                            <label for="is_premium_2" onclick="showDiv('keymoney', 1)">없음</label>
                                        </div>
                                    </div>

                                    <div class="keymoney_wrap w_30">
                                        <div class="keymoney_item open_key {{ $is_premium == 1 ? 'active' : '' }}">
                                            <div class="flex_1 flex_between">
                                                <input type="text" name="premium_price" inputmode="numeric"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                    value="{{ $premium_price != '' ? number_format($premium_price) : '' }}"
                                                    id="premium_price">
                                                <span>원</span>
                                            </div>
                                        </div>
                                        <div class="keymoney_item open_key {{ $is_premium != 1 ? 'active' : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- 상업용 : e -->
                            @elseif($type == 1)
                                <!-- 주거용 : s -->
                                <div class="input_item_grid">
                                    <h4>주거용 거래 정보 <span class="txt_point">*</span></h4>
                                    <div class="btn_radioType">
                                        <input type="radio" name="payment_type" id="payment_type_4" value="0"
                                            {{ $payment_type == 0 ? 'checked' : '' }}>
                                        <label for="payment_type_4" onclick="showDiv('type_2', 0)">매매</label>

                                        <input type="radio" name="payment_type" id="payment_type_5" value="3"
                                            {{ $payment_type == 3 ? 'checked' : '' }}>
                                        <label for="payment_type_5" onclick="showDiv('type_2', 1)">전세</label>

                                        <input type="radio" name="payment_type" id="payment_type_6" value="4"
                                            {{ $payment_type == 4 ? 'checked' : '' }}>
                                        <label for="payment_type_6" onclick="showDiv('type_2', 2)">월세</label>

                                        <input type="radio" name="payment_type" id="payment_type_7" value="2"
                                            {{ $payment_type == 2 ? 'checked' : '' }}>
                                        <label for="payment_type_7" onclick="showDiv('type_2', 2)">단기임대</label>
                                    </div>

                                    <div class="type_2_wrap">
                                        <!-- 매매 -->
                                        <div class="type_2_item open_key {{ $payment_type == 0 ? 'active' : '' }}">
                                            <div>
                                                <label class="input_label">매매가</label>
                                                <div class="input_area_1">
                                                    <input type="text" name="input_price" id="price_3"
                                                        inputmode="numeric" value="{{ number_format($price) }}"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                    <span class="gray_deep">원</span>
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_3" value="Y">
                                                    <label for="is_price_discussion_3" class="gray_deep"><span></span>
                                                        협의가능</label>
                                                </div>
                                                <div class="txt_item_2 mt20">
                                                    {{-- <span name="price_conversion" class="price"></span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 전세 -->
                                        <div class="type_2_item open_key {{ $payment_type == 3 ? 'active' : '' }}">
                                            <div>
                                                <label class="input_label">전세가</label>
                                                <div class="input_area_1">
                                                    <input type="text" name="input_price" id="price_4"
                                                        inputmode="numeric" value="{{ number_format($price) }}"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                    <span class="gray_deep">원</span>
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_4" value="Y">
                                                    <label for="is_price_discussion_4" class="gray_deep"><span></span>
                                                        협의가능</label>
                                                </div>
                                                <div class="txt_item_2 mt20">
                                                    {{-- <span name="price_conversion" class="price"></span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 월세, 단기임대 -->
                                        <div
                                            class="type_2_item open_key {{ in_array($payment_type, [1, 2, 4]) ? 'active' : '' }}">
                                            <div class="input_area_2">
                                                <div class="flex_between">
                                                    <div class="item">
                                                        <label class="input_label">보증금</label>
                                                        <div class="flex_1">
                                                            <input type="text" name="input_price" id="price_5"
                                                                class="w_input_150" inputmode="numeric"
                                                                value="{{ number_format($price) }}"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="text" name="input_month_price"
                                                                id="month_price_2" class="w_input_150"
                                                                inputmode="numeric"
                                                                value="{{ $month_price != '' ? number_format($month_price) : '' }}"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item_check_add">
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_5" value="Y">
                                                    <label for="is_price_discussion_5"
                                                        class="gray_deep mt18"><span></span>
                                                        협의가능</label>
                                                </div>
                                            </div>
                                            <div class="txt_item_2 mt20">
                                                {{-- <span name="price_conversion" class="price"></span> --}}
                                                {{-- <span name="month_price_conversion" class="price"></span> --}}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 기존 임대차 내용 STRAT --}}
                                    <div>
                                        <label class="input_label">기존 임대차 내용</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="is_use" id="is_use_1" value="1"
                                                {{ $is_use == 1 ? 'checked' : '' }}>
                                            <label for="is_use_1" onclick="showDiv('lease', 0)">있음</label>

                                            <input type="radio" name="is_use" id="is_use_2" value="0"
                                                {{ $is_use != 1 ? 'checked' : '' }}>
                                            <label for="is_use_2" onclick="showDiv('lease', 1)">없음</label>
                                        </div>

                                    </div>

                                    <div class="lease_wrap">
                                        <div class="lease_item open_key {{ $is_use == 1 ? 'active' : '' }}">
                                            <div class="flex_between w_30">
                                                <div class="item">
                                                    <label class="input_label">현 보증금</label>
                                                    <div class="flex_1">
                                                        <input type="text" class="w_input_150" inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                            value="{{ $current_price != '' ? number_format($current_price) : '' }}"
                                                            name="current_price" id="current_price"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">현 월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="text" class="w_input_150"
                                                            name="current_month_price" inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                            value="{{ $current_month_price != '' ? number_format($current_month_price) : '' }}"
                                                            id="current_month_price"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lease_item open_key {{ $is_use != 1 ? 'active' : '' }}"></div>
                                    </div>
                                    {{-- 기존 임대차 내용 END --}}

                                </div>
                                <!-- 주거용 : e -->
                            @elseif($type == 2)
                                <!-- 분양권 : s -->
                                <div class="input_item_grid">
                                    <h4>분양권 거래 정보 <span class="txt_point">*</span></h4>
                                    <div class="btn_radioType">
                                        <input type="radio" name="payment_type" id="payment_type_8" value="5"
                                            {{ $payment_type == 5 ? 'checked' : '' }}>
                                        <label for="payment_type_8" onclick="showDiv('type_3', 0)">전매</label>

                                        <input type="radio" name="payment_type" id="payment_type_9" value="3"
                                            {{ $payment_type == 3 ? 'checked' : '' }}>
                                        <label for="payment_type_9" onclick="showDiv('type_3', 1)">전세</label>

                                        <input type="radio" name="payment_type" id="payment_type_10"
                                            value="4" {{ $payment_type == 4 ? 'checked' : '' }}>
                                        <label for="payment_type_10"onclick="showDiv('type_3', 2)">월세</label>
                                    </div>

                                    <div class="type_3_wrap">
                                        <!-- 전매 -->
                                        <div class="type_3_item open_key active">
                                            <div>
                                                <label class="input_label">전매가</label>
                                                <div class="input_area_1">
                                                    <input type="text" name="input_price" id="price_6"
                                                        inputmode="numeric" value="{{ number_format($price) }}"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                    <span class="gray_deep">원</span>
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_6" value="Y">
                                                    <label for="is_price_discussion_6" class="gray_deep"><span></span>
                                                        협의가능</label>
                                                </div>
                                                <div class="txt_item_2 mt20">
                                                    {{-- <span name="price_conversion" class="price"></span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 전세 -->
                                        <div class="type_3_item open_key">
                                            <div>
                                                <label class="input_label">전세가</label>
                                                <div class="input_area_1">
                                                    <input type="text" name="input_price" id="price_7"
                                                        inputmode="numeric" value="{{ number_format($price) }}"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                    <span class="gray_deep">원</span>
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_7" value="Y">
                                                    <label for="is_price_discussion_7" class="gray_deep"><span></span>
                                                        협의가능</label>
                                                </div>
                                                <div class="txt_item_2 mt20">
                                                    {{-- <span name="price_conversion" class="price"></span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 월세 -->
                                        <div class="type_3_item open_key">
                                            <div class="input_area_2">
                                                <div class="flex_between">
                                                    <div class="item">
                                                        <label class="input_label">보증금</label>
                                                        <div class="flex_1">
                                                            <input type="text" class="w_input_150"
                                                                name="input_price" id="price_8" inputmode="numeric"
                                                                value="{{ number_format($price) }}"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="text" name="input_month_price"
                                                                id="month_price_3" class="w_input_150"
                                                                inputmode="numeric"
                                                                value="{{ $month_price != '' ? number_format($month_price) : '' }}"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item_check_add">
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_8" value="Y"
                                                        {{ $is_price_discussion ? 'checked' : '' }}>
                                                    <label for="is_price_discussion_8"
                                                        class="gray_deep mt18"><span></span>
                                                        협의가능</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 분양권 : e -->
                            @endif
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>위치 및 주소 <span class="txt_point">*</span></h4>

                        <input type="hidden" name="address_lng" id="address_lng"
                            value="{{ $product->address_lng }}">
                        <input type="hidden" name="address_lat" id="address_lat"
                            value="{{ $product->address_lat }}">
                        <input type="hidden" name="region_code" id="region_code"
                            value="{{ $product->region_code }}">
                        <input type="hidden" name="region_address" id="region_address"
                            value="{{ $product->region_address }}">
                        <input type="hidden" name="address" id="address" value="{{ $product->address }}">
                        <input type="hidden" name="old_address" id="old_address"
                            value="{{ $product->old_address }}">

                        <div class="address_reg_wrap">
                            <div class="inner_item">
                                <div class="search_address_1 active">
                                    <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                        onclick="getAddress()">주소
                                        검색</button>
                                </div>
                                <div class="search_address_2">
                                    <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                        onclick="modal_open('address_search')">(구)주소 검색</button>
                                </div>
                                <div class="mt8 gap_14">
                                    <input type="checkbox" name="is_map" id="is_map" value="1"
                                        {{ $product->is_map == 1 ? 'checked' : '' }}>
                                    <label for="is_map" class="gray_deep"><span></span> (구)주소</label>
                                </div>
                                <!----------------- M:: map : s ----------------->
                                <div class="inner_item inner_map only_m mapOnlyMobile">
                                    <div id="mapWrap" class="mapWrap"
                                        style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                                </div>
                                {{-- 주소 검색 시,<br>해당 위치가 지도에 표시됩니다. --}}
                                <!----------------- M:: map : e ----------------->
                                <div class="inner_address">
                                    <div class="address_row" id="roadName">
                                        <span>도로명</span>{{ $product->address }}
                                    </div>
                                    <div class="address_row" id="jibunName">
                                        @if ($product->old_address != '')
                                            <span>
                                                지번
                                            </span>
                                            {{ $product->old_address }}
                                        @endif
                                    </div>
                                </div>

                                <div class="detail_address_2 mt18 active">
                                    <div>
                                        <input type="text" id="address_detail" name="address_detail"
                                            value="{{ $product->address_detail }}"
                                            {{ $product->address_detail == '' ? 'disabled' : '' }}
                                            placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
                                    </div>
                                    <div class="mt8">
                                        <input type="checkbox" name="is_address_detail" id="is_address_detail"
                                            value="Y" {{ $product->address_detail == '' ? 'checked' : '' }}>
                                        <label for="is_address_detail" class="gray_deep"><span></span> 상세주소 없음</label>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_item inner_map only_pc mapOnlyPc">
                                <div id="is_temporary_1" style="display: none">
                                    (구)주소 선택시,<br>지도 노출이 불가능합니다.
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript"
                        src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey={{ env('CONFM_MAP_KEY') }}&skinType=1">
                    </script>
                    <div class="box_01 box_reg">
                        <h4>기본 정보</h4>



                        @if ($product->type == 7 || $product->type == 6)
                            {{-- 단독공장 해당 : s --}}
                            <div class="reg_mid_wrap">
                                @if ($product->type != 6)
                                    <div class="reg_item">
                                        <label class="input_label">최저/최고층 <span class="txt_point">*</span></label>
                                        <div class="input_pyeong_area">
                                            <div><input type="text" id="lowest_floor_number"
                                                    name="lowest_floor_number"
                                                    value="{{ $product->lowest_floor_number }}" placeholder="최저">
                                                <span class="gray_deep">층</span>
                                            </div>
                                            <span class="gray_deep">/</span>
                                            <div><input type="text" id="top_floor_number" name="top_floor_number"
                                                    value="{{ $product->top_floor_number }}" placeholder="최고"> <span
                                                    class="gray_deep">층</span></div>
                                        </div>
                                        <span class="gray_basic">※ 지하의 경우 B1으로 표시</span>
                                    </div>
                                @endif
                                <div class="reg_item">
                                    <label class="input_label">대지면적 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" id="area" name="area" inputmode="numeric"
                                                value="{{ $product->area }}" placeholder="대지면적"
                                                oninput="onlyNumbers(this);area_change('');">
                                            <span class="gray_deep">평</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" id="square" name="square"
                                                value="{{ $product->square }}" inputmode="numeric"
                                                oninput="imsi(this); square_change('');" placeholder="평 입력시 자동">
                                            <span class="gray_deep">㎡</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 단독공장 해당 : e  --}}
                        @else
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">해당층/전체층 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" id="floor_number" name="floor_number"
                                                value="{{ $product->floor_number }}" placeholder="해당층"> <span
                                                class="gray_deep">층</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" id="total_floor_number" name="total_floor_number"
                                                value="{{ $product->total_floor_number }}" placeholder="전체층"> <span
                                                class="gray_deep">층</span>
                                        </div>
                                    </div>
                                    <span class="gray_basic">※ 지하의 경우 B1으로 표시</span>
                                </div>
                            </div>
                        @endif

                        @if ($product->type != 6)

                            <div class="reg_mid_wrap">

                                @if ($product->type == 7)
                                    <div class="reg_item">
                                        <label class="input_label">연면적 <span class="txt_point">*</span></label>
                                        <div class="input_pyeong_area">
                                            <div>
                                                <input type="text" id="total_floor_area" name="total_floor_area"
                                                    value="{{ $product->total_floor_area }}" placeholder="연면적"
                                                    inputmode="numeric"
                                                    oninput="onlyNumbers(this);area_change('total_floor_');">
                                                <span class="gray_deep">평</span>
                                            </div>
                                            <span class="gray_deep">/</span>
                                            <div>
                                                <input type="text" id="total_floor_square"
                                                    name="total_floor_square"
                                                    value="{{ $product->total_floor_square }}" placeholder="평 입력시 자동"
                                                    inputmode="numeric"
                                                    oninput="imsi(this); square_change('total_floor_');">
                                                <span class="gray_deep">㎡</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="reg_item">
                                        <label class="input_label">공급 면적 <span class="txt_point">*</span></label>
                                        <div class="input_pyeong_area">
                                            <div>
                                                <input type="text" id="area" name="area"
                                                    value="{{ $product->area }}" placeholder="공급면적"
                                                    inputmode="numeric" oninput="onlyNumbers(this);area_change('');">
                                                <span class="gray_deep">평</span>
                                            </div>
                                            <span class="gray_deep">/</span>
                                            <div><input type="text"id="square" name="square"
                                                    value="{{ $product->square }}" placeholder="평 입력시 자동"
                                                    inputmode="numeric" oninput="imsi(this); square_change('');">
                                                <span class="gray_deep">㎡</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="reg_item">
                                    <label class="input_label">전용 면적 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" id="exclusive_area" name="exclusive_area"
                                                value="{{ $product->exclusive_area }}" placeholder="전용면적"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this);area_change('exclusive_');">
                                            <span class="gray_deep">평</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" id="exclusive_square" name="exclusive_square"
                                                value="{{ $product->exclusive_square }}" placeholder="평 입력시 자동"
                                                nputmode="numeric" oninput="imsi(this); square_change('exclusive_');">
                                            <span class="gray_deep">㎡</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                        <div class="reg_mid_wrap">
                            @if ($product->type != 6)
                                <div class="reg_item">
                                    <label class="input_label">{{ $product->type < 14 ? '사용승인일' : '준공예정일' }} <span
                                            class="txt_point">*</span></label>
                                    <input type="text" id="approve_date_1" name="approve_date_1"
                                        autocomplete="off"
                                        value="{{ $carbon::parse($product->approve_date)->format('Y.m.d') }}"
                                        placeholder="예) 20230101" inputmode="numeric"
                                        oninput="onlyNumbers(this); onDateChangeEvent('approve_date', 1);">
                                </div>
                            @endif

                            @php
                                $buildingTypeText = $product->type == 6 ? '현용도' : '주용도';
                            @endphp
                            <input type="hidden" name="building_type" id="building_type"
                                value="{{ $product->building_type }}">
                            <div class="reg_item">
                                <label class="input_label">{{ $buildingTypeText }} <span
                                        class="txt_point">*</span></label>
                                <div class="dropdown_box">
                                    <button type="button"
                                        class="dropdown_label">{{ $product->building_type != '' ? Lang::get('commons.building_type.' . $product->building_type) : $buildingTypeText . ' 선택' }}</button>
                                    <ul class="optionList">
                                        @for ($i = 0; $i < 15; $i++)
                                            <li class="optionItem"
                                                onclick="buildingTypeSelect('{{ $i }}')">
                                                {{ Lang::get('commons.building_type.' . $i) }}
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @if ($product->type == 7)

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">추천 용도</label>
                                    <div class="dropdown_box">
                                        <button type="button"
                                            class="dropdown_label">{{ $product->building_type != '' ? Lang::get('commons.building_type.' . $product->building_type) : '추천용도 선택' }}</button>
                                        <ul class="optionList">
                                            @for ($i = 0; $i < 15; $i++)
                                                <li class="optionItem" onclick="">
                                                    {{ Lang::get('commons.building_type.' . $i) }}
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($product->type != 6)
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">입주가능일 <span class="txt_point">*</span></label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="move_type" id="move_type_1" value="0"
                                            {{ $product->move_type == 0 ? 'checked' : '' }}>
                                        <label for="move_type_1" onclick="showDiv('m_day', 0)">즉시 입주</label>

                                        <input type="radio" name="move_type" id="move_type_2" value="1"
                                            {{ $product->move_type == 1 ? 'checked' : '' }}>
                                        <label for="move_type_2" onclick="showDiv('m_day', 0)">날짜 협의</label>

                                        <input type="radio" name="move_type" id="move_type_3" value="2"
                                            {{ $product->move_type == 2 ? 'checked' : '' }}>
                                        <label for="move_type_3" onclick="showDiv('m_day', 1)">직접 입력</label>
                                    </div>
                                    <div class="m_day_wrap mt8">
                                        <div class="m_day_item open_key"></div>
                                        <div
                                            class="m_day_item open_key {{ $product->move_type == 2 ? 'active' : '' }}">
                                            <input type="text" id="move_date_0" name="move_date_0"
                                                value="{{ $product->move_type == 2 ? $carbon::parse($product->move_date)->format('Y.m.d') : '' }}"
                                                placeholder="예) 20230101" inputmode="numeric"
                                                oninput="onlyNumbers(this); onDateChangeEvent('move_date', 0);">
                                        </div>
                                    </div>
                                </div>
                                <div class="reg_item only_pc"></div>
                            </div>

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">월 관리비 <span class="txt_point">*</span></label>
                                    <div class="input_area_1">
                                        <input type="text" id="service_price" name="service_price"
                                            value="{{ $product->service_price != '' ? number_format($product->service_price) : '' }}"
                                            inputmode="numeric" oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                        <span class="gray_deep">원</span>

                                        @if ($type != 6)
                                            <input type="checkbox" name="is_service" id="is_service_4"
                                                value="1" {{ $product->is_service == 1 ? 'checked' : '' }}>
                                            <label for="is_service_4" class="gray_deep"><span></span> 관리비 없음</label>
                                        @endif

                                    </div>
                                </div>
                            </div>



                            <div>
                                <label class="input_label">관리비 항목</label>
                                @php
                                    $serviceTypeArray = [];
                                    foreach ($product->productServices as $key => $service) {
                                        array_push($serviceTypeArray, $service->type);
                                    }
                                @endphp
                                <div class="checkbox_btn">

                                    @foreach (Lang::get('commons.service_type') as $index => $service_type)
                                        <input type="checkbox" name="service_type[]"
                                            id="service_type_{{ $index }}" value="{{ $index }}"
                                            {{ in_array($index, $serviceTypeArray) ? 'checked' : '' }}>
                                        <label for="service_type_{{ $index }}">
                                            {{ $service_type }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">융자금 <span class="txt_point">*</span></label>
                                <div class="btn_radioType">
                                    <input type="radio" name="loan_type" id="loan_type_1" value="0"
                                        {{ $product->loan_type == 0 ? 'checked' : '' }}>
                                    <label for="loan_type_1">없음</label>

                                    <input type="radio" name="loan_type" id="loan_type_2" value="1"
                                        {{ $product->loan_type == 1 ? 'checked' : '' }}>
                                    <label for="loan_type_2">30%미만</label>

                                    <input type="radio" name="loan_type" id="loan_type_3" value="2"
                                        {{ $product->loan_type == 2 ? 'checked' : '' }}>
                                    <label for="loan_type_3">30%이상</label>
                                </div>
                                <div class="flex_1 mt10">
                                    <input type="text" id="loan_price" name="loan_price" class="w_input_150"
                                        value="{{ $product->loan_price != '' ? number_format($product->loan_price) : '' }}"
                                        {{ $product->loan_type == 0 ? 'disabled' : '' }} inputmode="numeric"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                    <span>원</span>
                                </div>
                            </div>
                            <div class="reg_item only_pc"></div>
                        </div>

                        @if ($product->type != 6)
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">주차 가능 여부</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="parking_type" id="parking_type_1" value="0"
                                            {{ $product->parking_type == 0 ? 'checked' : '' }} checked="">
                                        <label for="parking_type_1">선택 안함</label>

                                        <input type="radio" name="parking_type" id="parking_type_2" value="1"
                                            {{ $product->parking_type == 1 ? 'checked' : '' }}>
                                        <label for="parking_type_2">가능</label>

                                        <input type="radio" name="parking_type" id="parking_type_3" value="2"
                                            {{ $product->parking_type == 2 ? 'checked' : '' }}>
                                        <label for="parking_type_3">불가능</label>
                                    </div>
                                    <div class="flex_1 mt10">
                                        {{-- <input type="text" id="parking_price" name="parking_price"
                                            class="w_input_150"
                                            value="{{ $product->parking_type == 1 ? ($product->parking_price == '' ? '무료주차' : $product->parking_price) : '' }}"
                                            {{ $product->parking_type == 0 ? 'disabled' : '' }} inputmode="numeric"
                                            oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                        <span>원</span> --}}
                                    </div>
                                </div>
                                <div class="reg_item only_pc"></div>
                            </div>
                        @endif
                    </div>

                    <div class="box_01 box_reg">
                        <h4>추가 정보</h4>
                        @if ($product->type != 6)

                            {{-- 상업용 - 상가일 경우 --}}
                            @if ($product->type == 3)
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <input type="hidden" name="current_business_type"
                                            value="{{ $product->productAddInfo->current_business_type }}">
                                        <label class="input_label">현 업종</label>
                                        <div class="dropdown_box">
                                            <button type="button" class="dropdown_label">
                                                {{ $product->productAddInfo->current_business_type != '' ? Lang::get('commons.product_business_type.' . $product->productAddInfo->current_business_type) : '추천 업종 선택' }}</button>
                                            <ul class="optionList">
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
                                        <input type="hidden" name="recommend_business_type"
                                            value="{{ $product->productAddInfo->recommend_business_type }}">
                                        <label class="input_label">추천 업종</label>
                                        <div class="dropdown_box">
                                            <button type="button"
                                                class="dropdown_label">{{ $product->productAddInfo->recommend_business_type != '' ? Lang::get('commons.product_business_type.' . $product->productAddInfo->recommend_business_type) : '추천 업종 선택' }}</button>
                                            <ul class="optionList">
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

                            @if (in_array($product->type, [4, 8, 9, 10, 11, 12, 13]))
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">방/욕실 수 <span class="txt_point">*</span></label>
                                        <div class="input_pyeong_area">
                                            <div><input type="text" name="room_count" placeholder="방 수"
                                                    value="{{ $product->productAddInfo->room_count }}"
                                                    inputmode="numeric" oninput="onlyNumbers(this);">
                                                <span class="gray_deep">개</span>
                                            </div>
                                            <span class="gray_deep">/</span>
                                            <div><input type="text" name="bathroom_count" placeholder="욕실 수"
                                                    value="{{ $product->productAddInfo->bathroom_count }}"
                                                    inputmode="numeric" oninput="onlyNumbers(this);">
                                                <span class="gray_deep">개</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <input type="hidden" name="direction_type"
                                        value="{{ $product->productAddInfo->direction_type }}">
                                    <label class="input_label">건물 방향 (주 출입구 기준) <span
                                            class="txt_point">*</span></label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">
                                            {{ $product->productAddInfo->direction_type != '' ? Lang::get('commons.direction_type.' . $product->productAddInfo->direction_type) : '건물 방향 선택' }}</button>
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
                                    <input type="hidden" name="cooling_type" id="cooling_type"
                                        value="{{ $product->productAddInfo->cooling_type }}">
                                    <label class="input_label">냉방 종류</label>
                                    <div class="dropdown_box">
                                        <button type="button"
                                            class="dropdown_label">{{ $product->productAddInfo->cooling_type != '' ? Lang::get('commons.cooling_type.' . $product->productAddInfo->cooling_type) : '냉방 종류 선택' }}</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('cooling_type','')">
                                                냉방 종류 선택
                                            </li>
                                            @foreach (Lang::get('commons.cooling_type') as $index => $cooling_type)
                                                <li class="optionItem"
                                                    onclick="selectType('cooling_type','{{ $index }}')">
                                                    {{ $cooling_type }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <input type="hidden" name="heating_type"
                                        value="{{ $product->productAddInfo->heating_type }}">
                                    <label class="input_label">난방 종류</label>
                                    <div class="dropdown_box">
                                        <button type="button"
                                            class="dropdown_label">{{ $product->productAddInfo->heating_type != '' ? Lang::get('commons.heating_type.' . $product->productAddInfo->heating_type) : '난방 종류 선택' }}</button>
                                        <ul class="optionList">
                                            <li class="optionItem" onclick="selectType('heating_type','')">
                                                난방 종류 선택
                                            </li>
                                            @foreach (Lang::get('commons.heating_type') as $index => $heating_type)
                                                <li class="optionItem"
                                                    onclick="selectType('heating_type','{{ $index }}')">
                                                    {{ $heating_type }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="reg_mid_wrap">
                                @if (in_array($product->type, [0, 1, 2]) || $product->type > 13)
                                    <div class="reg_item">
                                        <label class="input_label">하중(평당)</label>
                                        <div class="flex_1 mt10">
                                            <input type="number" id="weight" name="weight"
                                                value="{{ $product->productAddInfo->weight }}"
                                                class="w_input_150"><span></span>
                                        </div>
                                    </div>
                                @endif

                                <div class="reg_item">
                                    <label class="input_label">승강시설 <span class="txt_point">*</span></label>
                                    <div class="btn_radioType mt18">
                                        <input type="radio" name="is_elevator" value="1" id="is_elevator_1"
                                            {{ $product->productAddInfo->is_elevator == 1 ? 'checked' : '' }}>
                                        <label for="is_elevator_1">있음</label>

                                        <input type="radio" name="is_elevator" value="0" id="is_elevator_2"
                                            {{ $product->productAddInfo->is_elevator == 0 ? 'checked' : '' }}>
                                        <label for="is_elevator_2">없음</label>

                                    </div>
                                </div>
                                @if (in_array($product->type, [0, 1, 2, 7]) || $product->type > 13)
                                    <div class="reg_item">
                                        <label class="input_label">화물용 승강시설</label>
                                        <div class="btn_radioType mt18">
                                            <input type="radio" name="is_goods_elevator" id="is_goods_elevator_1"
                                                value="1"
                                                {{ $product->productAddInfo->is_goods_elevator == 1 ? 'checked' : '' }}>
                                            <label for="is_goods_elevator_1">있음</label>

                                            <input type="radio" name="is_goods_elevator" id="is_goods_elevator_2"
                                                value="0"
                                                {{ $product->productAddInfo->is_goods_elevator == 0 ? 'checked' : '' }}>
                                            <label for="is_goods_elevator_2">없음</label>

                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if (in_array($product->type, [0, 1, 2]) || $product->type > 13)
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">인테리어 여부</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="interior_type" id="interior_type_1"
                                                value="0"
                                                {{ $product->productAddInfo->interior_type == 0 ? 'checked' : '' }}
                                                checked="">
                                            <label for="interior_type_1">선택 안함</label>

                                            <input type="radio" name="interior_type" id="interior_type_2"
                                                value="1"
                                                {{ $product->productAddInfo->interior_type == 1 ? 'checked' : '' }}>
                                            <label for="interior_type_2">있음</label>

                                            <input type="radio" name="interior_type" id="interior_type_3"
                                                value="2"
                                                {{ $product->productAddInfo->interior_type == 2 ? 'checked' : '' }}>
                                            <label for="interior_type_3">없음</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($product->type == 7)
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">도크</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="is_dock" id="is_dock_1" value="1"
                                                {{ $product->productAddInfo->is_dock == 1 ? 'checked' : '' }}>
                                            <label for="is_dock_1">있음</label>
                                            <input type="radio" name="is_dock" id="is_dock_0" value="0"
                                                {{ $product->productAddInfo->is_dock == 0 ? 'checked' : '' }}>
                                            <label for="is_dock_0">없음</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">호이스트</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="is_hoist" id="is_hoist_1" value="1"
                                                {{ $product->productAddInfo->is_hoist == 1 ? 'checked' : '' }}>
                                            <label for="is_hoist_1">가능</label>
                                            <input type="radio" name="is_hoist" id="is_hoist_0" value="0"
                                                {{ $product->productAddInfo->is_hoist == 0 ? 'checked' : '' }}>
                                            <label for="is_hoist_0">불가능</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (in_array($product->type, [0, 1, 2, 7]) || $product->type > 13)
                                <div class="reg_item">
                                    <label class="input_label">층고</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="floor_height_type" id="floor_height_"
                                            value="">
                                        <label for="floor_height_">선택 안함</label>

                                        @foreach (Lang::get('commons.floor_height_type') as $index => $floorHeightType)
                                            <input type="radio" name="floor_height_type"
                                                id="floor_height_type_{{ $index }}"
                                                value="{{ $index }}"
                                                {{ $product->productAddInfo->floor_height_type == $index ? 'checked' : '' }}>
                                            <label
                                                for="floor_height_type_{{ $index }}">{{ $floorHeightType }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if (in_array($product->type, [0, 1, 2, 7]) || $product->type > 13)
                                <div>
                                    <div class="reg_item">
                                        <label class="input_label">사용전력</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="wattage_type" id="wattage_type_"
                                                value="">
                                            <label for="wattage_type_">선택 안함</label>
                                            @foreach (Lang::get('commons.wattage_type') as $index => $wattageType)
                                                <input type="radio" name="wattage_type"
                                                    id="wattage_type_{{ $index }}"
                                                    value="{{ $index }}"
                                                    {{ $product->productAddInfo->wattageType == $index ? 'checked' : '' }}>
                                                <label
                                                    for="wattage_type_{{ $index }}">{{ $wattageType }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">국토이용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="land_use_type" id="land_use_type_0"
                                            value="0"
                                            {{ $product->productAddInfo->land_use_type == 0 ? 'checked' : '' }}>
                                        <label for="land_use_type_0">선택 안함</label>

                                        <input type="radio" name="land_use_type" id="land_use_type_1"
                                            value="1"
                                            {{ $product->productAddInfo->land_use_type == 1 ? 'checked' : '' }}>
                                        <label for="land_use_type_1">해당</label>

                                        <input type="radio" name="land_use_type" id="land_use_type_2"
                                            value="2"
                                            {{ $product->productAddInfo->land_use_type == 2 ? 'checked' : '' }}>
                                        <label for="land_use_type_2">미해당</label>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <label class="input_label">도시계획</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="city_plan_type" id="city_plan_type_0"
                                            value="0"
                                            {{ $product->productAddInfo->city_plan_type == 0 ? 'checked' : '' }}>
                                        <label for="city_plan_type_0">선택 안함</label>

                                        <input type="radio" name="city_plan_type" id="city_plan_type_1"
                                            value="1"
                                            {{ $product->productAddInfo->city_plan_type == 1 ? 'checked' : '' }}>
                                        <label for="city_plan_type_1">있음</label>

                                        <input type="radio" name="city_plan_type" id="city_plan_type_2"
                                            value="2"
                                            {{ $product->productAddInfo->city_plan_type == 2 ? 'checked' : '' }}>
                                        <label for="city_plan_type_2">없음</label>
                                    </div>
                                </div>
                            </div>

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">건축허가</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="building_permit_type" id="building_permit_type_0"
                                            value="0"
                                            {{ $product->productAddInfo->building_permit_type == 0 ? 'checked' : '' }}>
                                        <label for="building_permit_type_0">선택 안함</label>

                                        <input type="radio" name="building_permit_type" id="building_permit_type_1"
                                            value="1"
                                            {{ $product->productAddInfo->building_permit_type == 1 ? 'checked' : '' }}>
                                        <label for="building_permit_type_1">발급</label>

                                        <input type="radio" name="building_permit_type" id="building_permit_type_2"
                                            value="2"
                                            {{ $product->productAddInfo->building_permit_type == 2 ? 'checked' : '' }}>
                                        <label for="building_permit_type_2">미발급</label>
                                    </div>
                                </div>

                                <div class="reg_item">
                                    <label class="input_label">토지거래허가구역</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="land_permit_type" id="land_permit_type_0"
                                            value="0"
                                            {{ $product->productAddInfo->land_permit_type == 0 ? 'checked' : '' }}>
                                        <label for="land_permit_type_0">선택 안함</label>

                                        <input type="radio" name="land_permit_type" id="land_permit_type_1"
                                            value="1"
                                            {{ $product->productAddInfo->land_permit_type == 1 ? 'checked' : '' }}>
                                        <label for="land_permit_type_1">해당</label>

                                        <input type="radio" name="land_permit_type" id="land_permit_type_2"
                                            value="2"
                                            {{ $product->productAddInfo->land_permit_type == 2 ? 'checked' : '' }}>
                                        <label for="land_permit_type_2">미해당</label>
                                    </div>
                                </div>
                            </div>

                            <div class="reg_mid_wrap">
                                <div class="reg_item">
                                    <label class="input_label">진입도로</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="access_load_type" id="access_load_type_0"
                                            value="0"
                                            {{ $product->productAddInfo->access_load_type == 0 ? 'checked' : '' }}>
                                        <label for="access_load_type_0">선택 안함</label>

                                        <input type="radio" name="access_load_type" id="access_load_type_1"
                                            value="1"
                                            {{ $product->productAddInfo->access_load_type == 1 ? 'checked' : '' }}>
                                        <label for="access_load_type_1">있음</label>

                                        <input type="radio" name="access_load_type" id="access_load_type_2"
                                            value="2"
                                            {{ $product->productAddInfo->access_load_type == 2 ? 'checked' : '' }}>
                                        <label for="access_load_type_2">없음</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @php

                        $is_option = $product->productAddInfo->is_option;

                        $option_count = 0;

                        $optionArray = [];
                        foreach ($product->productOptions as $key => $option) {
                            array_push($optionArray, $option->type);
                        }
                    @endphp
                    @if ($product->type != 6)
                        <div class="box_01 box_reg">
                            <h4>옵션 정보</h4>

                            <div>
                                <div class="reg_item">
                                    <label class="input_label">옵션 여부</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="is_option" id="is_option_1" value="1"
                                            {{ $is_option == 1 ? 'checked' : '' }}>
                                        <label for="is_option_1" onclick="showDiv('is_option', 0)">있음</label>

                                        <input type="radio" name="is_option" id="is_option_2" value="0"
                                            {{ $is_option == 0 ? 'checked' : '' }}>
                                        <label for="is_option_2" onclick="showDiv('is_option', 1)">없음</label>
                                    </div>

                                    <div class="is_option_wrap">
                                        <div class="is_option_item open_key  {{ $is_option == 1 ? 'active' : '' }}">
                                            <div class="option_row option_facility_row">
                                                <div class="option_tit">시설</div>
                                                <div class="checkbox_btn">
                                                    @for ($i = 0; $i < count(Lang::get('commons.option_facility')); $i++)
                                                        <input class="option_facility" type="checkbox"
                                                            name="option_type[]" id="option_{{ $option_count }}"
                                                            value="{{ $option_count }}"
                                                            {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
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
                                                            value="{{ $option_count }}"
                                                            {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
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
                                                            value="{{ $option_count }}"
                                                            {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
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
                                                            value="{{ $option_count }}"
                                                            {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
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
                                                            value="{{ $option_count }}"
                                                            {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
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
                                                            value="{{ $option_count }}"
                                                            {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                        <label for="option_{{ $option_count }}">
                                                            {{ Lang::get('commons.option_etc.' . $option_count++) }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="is_option_item open_key  {{ $is_option == 0 ? 'active' : '' }}">
                                        </div>

                                    </div>
                                    @if (in_array($product->type, [4, 9]))
                                        <div class="reg_mid_wrap mt10">
                                            <div class="reg_item">
                                                <label class="input_label">구조</label>
                                                <div class="btn_radioType">
                                                    <input type="radio" name="structure_type"
                                                        id="structure_type_0" value="0"
                                                        {{ $product->productAddInfo->structure_type == 0 ? 'checked' : '' }}>
                                                    <label for="structure_type_0">선택 안함</label>

                                                    <input type="radio" name="structure_type"
                                                        id="structure_type_1" value="1"
                                                        {{ $product->productAddInfo->structure_type == 1 ? 'checked' : '' }}>
                                                    <label for="structure_type_1">복층</label>

                                                    <input type="radio" name="structure_type"
                                                        id="structure_type_2" value="2"
                                                        {{ $product->productAddInfo->structure_type == 2 ? 'checked' : '' }}>
                                                    <label for="structure_type_2">1.5룸/주방분리형</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="reg_mid_wrap mt10">
                                            <div class="reg_item">
                                                <label class="input_label">빌트인</label>
                                                <div class="btn_radioType">
                                                    <input type="radio" name="builtin_type" id="builtin_type_0"
                                                        value="0"
                                                        {{ $product->productAddInfo->builtin_type == 0 ? 'checked' : '' }}>
                                                    <label for="builtin_type_0">선택 안함</label>

                                                    <input type="radio" name="builtin_type" id="builtin_type_1"
                                                        value="1"
                                                        {{ $product->productAddInfo->builtin_type == 1 ? 'checked' : '' }}>
                                                    <label for="builtin_type_1">있음</label>

                                                    <input type="radio" name="builtin_type" id="builtin_type_2"
                                                        value="2"
                                                        {{ $product->productAddInfo->builtin_type == 2 ? 'checked' : '' }}>
                                                    <label for="builtin_type_2">없음</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="reg_mid_wrap mt10">
                                            <div class="reg_item">
                                                <label class="input_label">전입신고 가능 여부</label>
                                                <div class="btn_radioType">
                                                    <input type="radio" name="declare_type" id="declare_type_0"
                                                        value="0"
                                                        {{ $product->productAddInfo->declare_type == 0 ? 'checked' : '' }}>
                                                    <label for="declare_type_0">선택 안함</label>
                                                    <input type="radio" name="declare_type" id="declare_type_1"
                                                        value="1"
                                                        {{ $product->productAddInfo->declare_type == 1 ? 'checked' : '' }}>
                                                    <label for="declare_type_1">가능</label>
                                                    <input type="radio" name="declare_type" id="declare_type_2"
                                                        value="2"
                                                        {{ $product->productAddInfo->declare_type == 2 ? 'checked' : '' }}>
                                                    <label for="declare_type_2">불가능</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endif

                    <div class="box_01 box_reg">
                        <div class="flex_between">
                            <h4>사진 및 상세 설명</h4>
                            <p class="gray_basic">최대 8장 업로드 가능 <span class="txt_point"
                                    id="imageCount">{{ count($product->images) }}</span> / 8</p>
                        </div>
                        <span class="gray_basic">* 첫번째 위치한 사진이 대표 이미지 입니다.</span>
                        <div class="img_add_wrap reg_step_type draggable-zone" id="imageList">
                            <div class="cell">
                                <button type="button" id="profile_drop">
                                    <div class="img_box"><img src="{{ asset('assets/media/btn_img_add.png') }}"
                                            onclick="plusClickEvent();">
                                    </div>
                                </button>
                            </div>
                            @if (count($product->images) > 0)
                                @foreach ($product->images as $image)
                                    <div class="cell draggable">
                                        <input type="hidden" id="image_ids[]" name="image_ids[]"
                                            value="{{ $image->id }}">
                                        <img src="{{ asset('assets/media/btn_img_delete.png') }}"
                                            class="btn_img_delete" onclick="removeImage(this);">
                                        <div class="img_box draggable-handle"><img
                                                src="{{ Storage::url('image/' . $image->path) }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div>
                            <div class="offer_textarea_wrap">
                                <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                                <input type="text" id="comments" name="comments"
                                    value="{{ $product->comments }}"
                                    placeholder="매물 한줄요약. 예) 역에서 5분거리, 인프라 좋은 매물">
                                <textarea class="mt10" id="contents" name="contents" placeholder="매물에 대해 추가로 어필하고 싶은 내용을 자세히 작성해 주세요.">{{ $product->contents }}</textarea>
                            </div>
                            <div class="offer_textarea_wrap mt10">
                                <label class="input_label">비공개 메모</label>
                                <textarea id="non_memo" name="non_memo" style="height:70px;" placeholder="외부에 공개되지 않으며, 등록자에게만 보이는 메모입니다.">{{ $product->non_memo }}</textarea>
                            </div>
                            <div class="reg_mid_wrap mt10">
                                <div class="reg_item">
                                    <label class="input_label">중개보수(부가세별도) <span class="txt_point">*</span></label>
                                    <input type="text" id="commission" name="commission"
                                        value="{{ $product->commission > 0 ? number_format($product->commission) : '' }}"
                                        placeholder="중개보수를 입력해 주세요." inputmode="numeric"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                </div>
                                <div class="reg_item">
                                    <label class="input_label">상한요율 <span class="txt_point">*</span></label>
                                    <input type="text" id="commission_rate" name="commission_rate"
                                        value="{{ $product->commission_rate }}" placeholder="상한요율을 % 단위로 입력해 주세요."
                                        inputmode="numeric" oninput="imsi1(this);"
                                        placeholder="상한요율을 % 단위로 입력해 주세요.">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="step_btn_wrap">
                        <span></span>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" type="button" id="nextPageButton"
                            onclick="onFormSubmit();">저장</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->
        </form>
    </div>

    <x-user-temporary-address />

</x-layout>
<style>
    .zoomIcon {
        padding: 0px !important;
    }
</style>

<script>
    $(document).ready(function() {
        optionSetting($('#type').val());
        // 지도 사이즈 별로 나오게
        // 모바일 / PC 각 div 에 mapOnlyMobile / mapOnlyPc 클래스 명 추가해주세요!
        if (document.body.offsetWidth > 767) {
            var mobileDiv = document.querySelector(".mapOnlyMobile").children[0];
            var pcDiv = document.querySelector(".mapOnlyPc");
            pcDiv.appendChild(mobileDiv);
        }

        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
            .remove();

        var address_lng = $('input[name=address_lng]').val();
        var address_lat = $('input[name=address_lat]').val();

        if (address_lng != '' && address_lat != '') {
            var wgs84Coords = get_coordinate_conversion1(address_lng, address_lat)
            setTimeout(function() {
                callJusoroMapApiType1(wgs84Coords[0], wgs84Coords[1]);
            }, 2000);
        } else {
            setTimeout(function() {}, 2000);
        }

        confirm_check();
    });

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

    // 평수 제곱 변환
    function square_change(name) {
        var area_name = name + 'area';
        var square_name = name + 'square';

        var square = $('#' + square_name).val();

        if (square > 0) {
            var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
            $('#' + area_name).val(convertedArea);
        } else {
            $('#' + square_name).val('');
            $('#' + area_name).val('');
        }
    }

    // 평수 제곱 변환
    function area_change(name) {
        var area_name = name + 'area';
        var square_name = name + 'square';
        var area = $('#' + area_name).val();

        if (area > 0) {
            var convertedSquare = (area * 3.3058).toString();
            var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
            $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
        } else {
            $('#' + area_name).val('');
            $('#' + square_name).val('');
        }
    }


    function plusClickEvent() {
        var imageCount = parseInt($('#imageCount').text());

        if (imageCount < 8) {
            $("#profile_drop").trigger('click');
        } else {
            alert('최대 8장 등록 가능합니다.');
        }
    }

    var profileimageDropzone = new Dropzone("#profile_drop", {
        url: "{{ route('api.imageupload') }}", // URL
        method: 'post', // method
        paramName: "image", // 파라미터 이름
        maxFiles: 1, // 파일 갯수
        maxFilesize: 10, // MB
        timeout: 300000, // 타임아웃 30초 기본 설정
        previewTemplate: '<div></div>', // 미리보기 완전히 비활성화
        addRemoveLinks: true, // 업로드 후 파일 삭제버튼 표시 여부
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF', // 이미지 파일 포맷만 허
        accept: function(file, done) {
            done();
        },
        success: function(file, responseText) {
            var imageCount = parseInt($('#imageCount').text());

            if (imageCount < 8) {
                var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

                var imageTag = `
                    <div class="cell draggable">
                        <input type="hidden" id="image_ids[]" name="image_ids[]" value="${responseText.result.id}">
                        <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete" onclick="removeImage(this);">
                        <div class="img_box draggable-handle">
                            <img src="${imagePath}">
                        </div>
                    </div>
                    `;

                $('#imageCount').text(imageCount + 1);
                $('#imageList').append(imageTag);
            }
            profileimageDropzone.removeFile(file);
            refreshFsLightbox();

        }
    });

    var containers = document.querySelectorAll(".draggable-zone");

    var swappable = new Sortable.default(containers, {
        draggable: ".draggable",
        handle: ".draggable .draggable-handle",
        mirror: {
            appendTo: "body",
            constrainDimensions: true
        },

    });

    // 이미지 제거
    function removeImage(elem) {
        var imageCount = parseInt($('#imageCount').text());
        $('#imageCount').text(imageCount - 1);
        $(elem).parent().remove();
    }

    function selectType(name, index) {
        $('input[name="' + name + '"]').val(index);
        confirm_check();
    }

    // 용도 선택
    function buildingTypeSelect(buildingType) {
        $('#building_type').val(buildingType);
    }


    function onFormSubmit() {
        $('#updateForm').submit();
    }

    //입력란 열고 닫기
    function showDiv(className, index) {
        var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
        tabContents.forEach(function(content) {
            content.classList.remove('active');
        });
        tabContents[index].classList.add('active');
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
            "width=450,height=420, scrollbars=yes, resizable=yes");
    }


    function jusoCallBack(rtRoadFullAddr, rtAddrPart1, rtAddrDetail, rtAddrPart2, rtEngAddr, rtJibunAddr, rtZipNo,
        rtAdmCd, rtRnMgtSn, rtBdMgtSn, rtDetBdNmList, rtBdNm, rtBdKdcd, rtSiNm, rtSggNm, rtEmdNm, rtLiNm, rtRn,
        rtUdrtYn, rtBuldMnnm, rtBuldSlno, rtMtYn, rtLnbrMnnm, rtLnbrSlno, rtEmdNo, relJibun, rtentX, rtentY) {

        $('#roadName').html('<span>도로명</span>' + rtAddrPart1);
        $('#jibunName').html('<span>지번</span>' + rtJibunAddr);

        $('#address').val(rtAddrPart1);
        $('#old_address').val(rtJibunAddr);

        if (!$("#address_detail").prop('disabled')) {
            $('#address_detail').val(rtAddrDetail);
        }

        $('#region_code').val(rtAdmCd);
        $('#region_address').val(rtSiNm + ' ' + rtSggNm + ' ' + rtEmdNm + ' ' + rtLiNm);

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

        callJusoroMapApiType1(rtentX, rtentY);

        confirm_check();
    }

    // type1.좌표정보(GRS80, EPSG:5179)
    function callJusoroMapApiType1(rtentX, rtentY) {
        window.postMessage({
            functionName: 'callJusoroMapApi',
            params: [rtentX, rtentY]
        }, '*');
    }


    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    }

    // 매매가 & 보증금
    $('input[name="input_price"]').keyup(function() {
        $('#price').val($(this).val().replace(/[^0-9]/g, ''));
    });

    // 월임대료
    $('input[name="input_month_price"]').keyup(function() {
        $('#month_price').val($(this).val().replace(/[^0-9]/g, ''));
    });

    // 가격 협의가능 여부
    $('input[name="input_is_price_discussion"]').change(function() {
        var isChecked = this.checked;
        $('#is_price_discussion').val($(this).is(':checked') ? 1 : 0);
        $('input[name="input_is_price_discussion"]').each(function() {
            this.checked = isChecked;
        });
    });

    function confirm_check() {
        var checkConfirm = false;

        // 세션 1
        var type = $('#type').val();
        var payment_type = $('input[name="payment_type"]:checked').val();
        var price = $('#price').val();
        var month_price = $('#month_price').val();
        var is_price_discussion = $('#is_price_discussion').val();
        var is_use = $('input[name="is_use"]:checked').val();
        var current_price = $('#current_price').val();
        var current_month_price = $('#current_month_price').val();
        var is_premium = $('input[name="is_premium"]:checked').val();
        var premium_price = $('#premium_price').val();

        if (type != '' && payment_type != '' && price != '') {
            if ($.inArray(payment_type, ['1', '2', '4']) !== -1) {
                if (month_price != '') {
                    checkConfirm = true;
                } else {
                    checkConfirm = false;
                }
            } else {
                checkConfirm = true;
            }

            if (checkConfirm && type < 14) {
                if (type == 3) {
                    if (is_premium == 1) {
                        if (premium_price != '') {
                            checkConfirm = true;
                        } else {
                            checkConfirm = false;
                        }
                    } else {
                        checkConfirm = true;
                    }
                }

                if (checkConfirm && is_use == 1) {
                    if (current_price != '' && current_month_price != '') {
                        checkConfirm = true;
                    } else {
                        checkConfirm = false;
                    }
                } else if (checkConfirm) {
                    checkConfirm = true;
                }
            } else if (checkConfirm) {
                checkConfirm = true;
            }
        } else {
            checkConfirm = false;
        }

        if (checkConfirm == false) {
            return $('#nextPageButton').attr("disabled", true);
        }

        // 세션 2
        var region_code = $('#region_code').val();
        var address = $('#address').val();
        var is_address_detail = $('#is_address_detail').is(':checked');
        var address_detail = $('#address_detail').val();

        if (region_code == '' || address == '' || (!is_address_detail && address_detail ==
                '')) {
            return $('#nextPageButton').attr("disabled", true);
        }

        // 세션 3
        var floor_number = $('input[name="floor_number"]').val();
        var total_floor_number = $('input[name="total_floor_number"]').val();
        var lowest_floor_number = $('input[name="lowest_floor_number"]').val();
        var top_floor_number = $('input[name="top_floor_number"]').val();
        var area = $('#area').val();
        var square = $('#square').val();
        var total_floor_area = $('input[name="total_floor_area"]').val();
        var total_floor_square = $('input[name="total_floor_square"]').val();
        var exclusive_area = $('input[name="exclusive_area"]').val();
        var exclusive_square = $('input[name="exclusive_square"]').val();
        var building_type = $('input[name="building_type"]').val();
        var move_type = $('input[name="move_type"]:checked').val();
        var move_date = $('input[name="move_date"]').val().length;
        var is_service = $('input[name="is_service"]').is(":checked");
        var service_price = $('input[name="service_price"]').val();
        var service_type = $('input[name="service_type[]"]:checked').length;
        var loan_type = $('input[name="loan_type"]:checked').val();
        var loan_price = 1;
        var parking_type = $('input[name="parking_type"]:checked').val();
        var parking_price = $('input[name="parking_price"]').val();
        var approve_date = $('input[name="approve_date"]').val().length;

        if (type == 6 && checkConfirm) {
            if (area != '' && square != '' && building_type != '' && (loan_type == 0 || (loan_type != 0 &&
                    loan_price !=
                    ''))) {
                checkConfirm = true;
            } else {
                checkConfirm = false;
            }
        } else if (checkConfirm) {
            if (area != '' && square != '' && exclusive_area != '' && exclusive_square != '' && approve_date == 8 &&
                building_type != '' &&
                (move_type != 2 || (move_type == 2 && move_date == 8)) &&
                (is_service || is_service == false && service_price != '' && service_type > 0) &&
                (loan_type == 0 || (loan_type != 0 && loan_price != ''))) {

                checkConfirm = true;
                if (type == 7) {
                    if (total_floor_area != '' && total_floor_square != '') {
                        checkConfirm = true;
                    } else {
                        checkConfirm = false
                    }
                } else {
                    if (floor_number != '' && total_floor_number != '') {
                        checkConfirm = true;
                    } else {
                        checkConfirm = false;
                    }
                }

            } else {
                checkConfirm = false;
            }
        }

        if (checkConfirm == false) {
            return $('#nextPageButton').attr("disabled", true);
        }


        // 세션 4
        var room_count = $('input[name="room_count"]');
        var bathroom_count = $('input[name="bathroom_count"]');
        var is_option = $('input[name="is_option"]:checked').val();
        var options_checked = $('input[name="option_type[]"]:checked').length;
        var direction_type = $('input[name="direction_type"]');

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

        if (direction_type.length > 0 && checkConfirm) {
            if (direction_type.val() != '') {
                checkConfirm = true;
            } else {
                checkConfirm = false;
            }
        }

        if (checkConfirm == false) {
            return $('#nextPageButton').attr("disabled", true);
        }

        // 세션 5
        var imageCount = parseInt($('#imageCount').text());
        var comments = $('input[name="comments"]').val();
        var content = $('textarea[name="contents"]').val();
        var commission = $('input[name="commission"]').val();
        var commission_rate = $('input[name="commission_rate"]').val();

        if (imageCount > 0 && comments != '' && content != '' && commission != '' && commission_rate != '' &&
            checkConfirm) {
            $('#nextPageButton').attr("disabled", false);
        } else {
            $('#nextPageButton').attr("disabled", true);
        }
    }

    const processChange = debounce(() => confirm_check());

    addEventListener("input", (event) => {
        processChange();
    });

    addEventListener("checkbox", (event) => {
        processChange();
    });

    //관리비 없음 체크여부
    $('input[name="is_service"]').change(function() {
        isService($(this).is(':checked'));
    });

    isService({{ $product->is_service }})

    function isService(element) {
        $('input[name="service_type[]"]').prop("checked", false)
        if (element) {
            $('input[name="service_type[]"]').attr('disabled', true);
            $('input[name="service_price"]').attr('disabled', true);
        } else {
            $('input[name="service_price"]').attr('disabled', false);
            $('input[name="service_type[]"]').attr('disabled', false);
        }
    }

    // 융자금 타입 선택시
    $('input[name="loan_type"]').change(function() {
        loanType($(this).val());
    });

    function loanType(element) {
        $('#loan_price').val('');
        if (element == 0) {
            $('input[name="loan_price"]').attr('disabled', true);
        } else {
            $('input[name="loan_price"]').attr('disabled', false);
        }
    }

    $('#is_address_detail').click(function() {
        if ($(this).is(':checked')) {
            $('#address_detail').val('');
            $('#address_detail').attr('disabled', true);
        } else {
            $('#address_detail').attr('disabled', false);
        }
    });
</script>
