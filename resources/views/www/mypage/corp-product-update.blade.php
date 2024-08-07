<x-layout>
    @inject('carbon', 'Carbon\Carbon')

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

            <input type="hidden" id="id" name="id" value="{{ $product->id }}">
            <input type="hidden" id="type" name="type" value="{{ $product->type }}">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 수정</h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>매물 유형 <span class="txt_point">*</span></h4>
                        @php
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
                        <div class="estate_type_txt">{{ Lang::get('commons.management_product_type.' . $type) }} >
                            {{ Lang::get('commons.product_type.' . $product->type) }}
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <div class="category_wrap">

                            @if ($type == 0)
                                <!-- 상업용 : s -->
                                <div class="category_item">
                                    <div class="input_item_grid">
                                        <h4>상업용 거래 정보 <span class="txt_point">*</span></h4>
                                        <div class="btn_radioType">
                                            <input type="radio" name="payment_type" id="payment_type_1_1"
                                                {{ $product->priceInfo->payment_type == 0 ? 'checked' : '' }}
                                                value="0">
                                            <label for="payment_type_1_1" onclick="showDiv('type', 0)">매매</label>

                                            <input type="radio" name="payment_type" id="payment_type_1_2"
                                                {{ $product->priceInfo->payment_type == 1 ? 'checked' : '' }}
                                                value="1">
                                            <label for="payment_type_1_2" onclick="showDiv('type', 1)">임대</label>

                                            <input type="radio" name="payment_type" id="payment_type_1_3"
                                                {{ $product->priceInfo->payment_type == 2 ? 'checked' : '' }}
                                                value="2">
                                            <label for="payment_type_1_3" onclick="showDiv('type', 1)">단기임대</label>
                                        </div>

                                        <div class="type_wrap">
                                            <!-- 매매 -->
                                            <div
                                                class="type_item open_key {{ $product->priceInfo->payment_type == 0 ? 'active' : '' }}">
                                                <div class="input_item_grid">
                                                    <div>
                                                        <label class="input_label">매매가</label>
                                                        <div class="input_area_1">
                                                            <input type="text" id="price_0" name="price_0"
                                                                inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                value="{{ number_format($product->priceInfo->price) }}">
                                                            <span class="gray_deep">원</span>
                                                            <input type="checkbox" name="is_price_discussion"
                                                                id="is_price_discussion_0" value="1"
                                                                {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                            <label for="is_price_discussion_0"
                                                                class="gray_deep"><span></span>
                                                                협의가능</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 임대, 단기임대 -->
                                            <div
                                                class="type_item open_key {{ $product->priceInfo->payment_type > 0 ? 'active' : '' }}">
                                                <div class="input_item_grid">
                                                    <div class="input_area_2">
                                                        <div class="flex_between">
                                                            <div class="item">
                                                                <label class="input_label">현 보증금</label>
                                                                <div class="flex_1">
                                                                    <input type="text" id="price_1" name="price_1"
                                                                        class="w_input_150" inputmode="numeric"
                                                                        oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                        value="{{ number_format($product->priceInfo->price) }}">
                                                                    <span>/</span>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <label class="input_label">현 월임대료</label>
                                                                <div class="flex_1">
                                                                    <input type="text" id="month_price"
                                                                        name="month_price" class="w_input_150"
                                                                        inputmode="numeric"
                                                                        oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                        value="{{ number_format($product->priceInfo->month_price) }}">
                                                                    <span>원</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item_check_add">
                                                            <input type="checkbox" name="is_price_discussion"
                                                                id="is_price_discussion_1" value="1"
                                                                {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                            <label for="is_price_discussion_1"
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
                                                    {{ $product->priceInfo->is_use == 1 ? 'checked' : '' }}>
                                                <label for="is_use_1" onclick="showDiv('lease_1', 0)">있음</label>

                                                <input type="radio" name="is_use" id="is_use_2" value="0"
                                                    {{ $product->priceInfo->is_use == 0 ? 'checked' : '' }}>
                                                <label for="is_use_2" onclick="showDiv('lease_1', 1)">없음</label>
                                            </div>
                                        </div>
                                        <div class="lease_1_wrap">
                                            <div
                                                class="lease_1_item open_key {{ $product->priceInfo->is_use == 1 ? 'active' : '' }}">
                                                <div class="flex_between w_30">
                                                    <div class="item">
                                                        <label class="input_label">현 보증금</label>
                                                        <div class="flex_1">
                                                            <input type="text" id="current_price"
                                                                name="current_price" class="w_input_150"
                                                                value="{{ number_format($product->priceInfo->current_price) }}"
                                                                inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                                            <span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">현 월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="text" id="current_month_price"
                                                                name="current_month_price" class="w_input_150"
                                                                value="{{ number_format($product->priceInfo->current_month_price) }}"
                                                                inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                                            <span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="lease_1_item open_key  {{ $product->priceInfo->is_use == 0 ? 'active' : '' }}">
                                            </div>
                                        </div>


                                        @if ($product->type == 3)
                                            <div>
                                                <label class="input_label">권리금</label>
                                                <div class="btn_radioType">
                                                    <input type="radio" name="is_premium" id="is_premium_1"
                                                        value="1"
                                                        {{ $product->priceInfo->is_premium == 1 ? 'checked' : '' }}>
                                                    <label for="is_premium_1"
                                                        onclick="showDiv('keymoney', 0)">있음</label>

                                                    <input type="radio" name="is_premium" id="is_premium_2"
                                                        value="0"
                                                        {{ $product->priceInfo->is_premium == 0 ? 'checked' : '' }}>
                                                    <label for="is_premium_2"
                                                        onclick="showDiv('keymoney', 1)">없음</label>
                                                </div>
                                            </div>
                                            <div class="keymoney_wrap w_30">
                                                <div
                                                    class="keymoney_item open_key {{ $product->priceInfo->is_premium == 1 ? 'active' : '' }}">
                                                    <div class="flex_1 flex_between">
                                                        <input type="text" id="premium_price" name="premium_price"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                            value="{{ number_format($product->priceInfo->premium_price) }}">
                                                        <span>원</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="keymoney_item open_key {{ $product->priceInfo->is_premium == 0 ? 'active' : '' }}">
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <!-- 상업용 : e -->
                            @elseif ($type == 1)
                                <!-- 주거용 : s -->
                                <div class="category_item">
                                    <div class="input_item_grid">
                                        <h4>주거용 거래 정보 <span class="txt_point">*</span></h4>
                                        <div class="btn_radioType">
                                            <input type="radio" name="payment_type" id="payment_type_1"
                                                {{ $product->priceInfo->payment_type == 0 ? 'checked' : '' }}
                                                value="0">
                                            <label for="payment_type_1" onclick="showDiv('type_2', 0)">매매</label>

                                            <input type="radio" name="payment_type" id="payment_type_2"
                                                {{ $product->priceInfo->payment_type == 3 ? 'checked' : '' }}
                                                value="3">
                                            <label for="payment_type_2" onclick="showDiv('type_2', 1)">전세</label>

                                            <input type="radio" name="payment_type" id="payment_type_3"
                                                {{ $product->priceInfo->payment_type == 4 ? 'checked' : '' }}
                                                value="4">
                                            <label for="payment_type_3" onclick="showDiv('type_2', 2)">월세</label>

                                            <input type="radio" name="payment_type" id="payment_type_4"
                                                {{ $product->priceInfo->payment_type == 2 ? 'checked' : '' }}
                                                value="2">
                                            <label for="payment_type_4" onclick="showDiv('type_2', 2)">단기임대</label>
                                        </div>

                                        <div class="type_2_wrap">
                                            <!-- 매매 -->
                                            <div
                                                class="type_2_item open_key {{ $product->priceInfo->payment_type == 0 ? 'active' : '' }}">
                                                <div>
                                                    <label class="input_label">매매가</label>
                                                    <div class="input_area_1">
                                                        <input type="text" id="price_0" name="price_0"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                            value="{{ number_format($product->priceInfo->price) }}">
                                                        <span class="gray_deep">원</span>
                                                        <input type="checkbox" name="is_price_discussion"
                                                            id="is_price_discussion_0" value="1"
                                                            {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_0"
                                                            class="gray_deep"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 전세 -->
                                            <div
                                                class="type_2_item open_key {{ $product->priceInfo->payment_type == 3 ? 'active' : '' }}">
                                                <div>
                                                    <label class="input_label">전세가</label>
                                                    <div class="input_area_1">
                                                        <input type="text" id="price_3" name="price_3"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                            value="{{ number_format($product->priceInfo->price) }}">
                                                        <span class="gray_deep">원</span>
                                                        <input type="checkbox" name="is_price_discussion"
                                                            id="is_price_discussion_3" value="1"
                                                            {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_3"
                                                            class="gray_deep"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 월세, 단기임대 -->
                                            <div
                                                class="type_2_item open_key {{ $product->priceInfo->payment_type == 2 || $product->priceInfo->payment_type == 4 ? 'active' : '' }}">
                                                <div class="input_area_2">
                                                    <div class="flex_between">
                                                        <div class="item">
                                                            <label class="input_label">보증금</label>
                                                            <div class="flex_1">
                                                                <input type="text" id="price_4" name="price_4"
                                                                    inputmode="numeric"
                                                                    oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                    value="{{ number_format($product->priceInfo->price) }}"
                                                                    class="w_input_150"><span>/</span>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <label class="input_label">월임대료</label>
                                                            <div class="flex_1">
                                                                <input type="text" id="month_price"
                                                                    name="month_price" inputmode="numeric"
                                                                    oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                    value="{{ number_format($product->priceInfo->month_price) }}"
                                                                    class="w_input_150"><span>원</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item_check_add">
                                                        <input type="checkbox" name="is_price_discussion"
                                                            id="is_price_discussion_4" value="1"
                                                            {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_4"
                                                            class="gray_deep mt18"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="input_label">기존 임대차 내용</label>
                                            <div class="btn_radioType">
                                                <input type="radio" name="is_use" id="is_use_1" value="1"
                                                    {{ $product->priceInfo->is_use == 1 ? 'checked' : '' }}>
                                                <label for="is_use_1" onclick="showDiv('lease_1', 0)">있음</label>

                                                <input type="radio" name="is_use" id="is_use_2" value="0"
                                                    {{ $product->priceInfo->is_use == 0 ? 'checked' : '' }}>
                                                <label for="is_use_2" onclick="showDiv('lease_1', 1)">없음</label>
                                            </div>
                                        </div>
                                        <div class="lease_1_wrap">
                                            <div
                                                class="lease_1_item open_key {{ $product->priceInfo->is_use == 1 ? 'active' : '' }}">
                                                <div class="flex_between w_30">
                                                    <div class="item">
                                                        <label class="input_label">현 보증금</label>
                                                        <div class="flex_1">
                                                            <input type="text" id="current_price"
                                                                name="current_price" inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                value="{{ number_format($product->priceInfo->current_price) }}"
                                                                class="w_input_150"><span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">현 월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="text" id="current_month_price"
                                                                name="current_month_price" inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                value="{{ number_format($product->priceInfo->current_month_price) }}"
                                                                class="w_input_150"><span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="lease_1_item open_key  {{ $product->priceInfo->is_use == 0 ? 'active' : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- 주거용 : e -->
                            @else
                                <!-- 분양권 : s -->
                                <div class="category_item">
                                    <div class="input_item_grid">
                                        <h4>분양권 거래 정보 <span class="txt_point">*</span></h4>
                                        <div class="btn_radioType">
                                            <input type="radio" name="payment_type" id="payment_type_1"
                                                {{ $product->priceInfo->payment_type == 5 ? 'checked' : '' }}
                                                value="5">
                                            <label for="payment_type_1" onclick="showDiv('type_3', 0)">전매</label>

                                            <input type="radio" name="payment_type" id="payment_type_3"
                                                {{ $product->priceInfo->payment_type == 4 ? 'checked' : '' }}
                                                value="4">
                                            <label for="payment_type_3" onclick="showDiv('type_3', 2)">월세</label>
                                        </div>

                                        <div class="type_3_wrap">
                                            <!-- 전매 -->
                                            <div
                                                class="type_3_item open_key {{ $product->priceInfo->payment_type == 5 ? 'active' : '' }}">
                                                <div>
                                                    <label class="input_label">전매가</label>
                                                    <div class="input_area_1">
                                                        <input type="text" id="price_5" name="price_5"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                            value="{{ number_format($product->priceInfo->price) }}">
                                                        <span class="gray_deep">원</span>
                                                        <input type="checkbox" name="is_price_discussion"
                                                            id="is_price_discussion_5" value="1"
                                                            {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_5"
                                                            class="gray_deep"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>


                                                <div class="mt20">
                                                    <label class="input_label">프리미엄</label>
                                                    <div class="input_area_1">
                                                        <input type="text" id="premium_price" name="premium_price"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                            value="{{ number_format($product->priceInfo->premium_price) }}">
                                                        <span class="gray_deep">원</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 월세 -->
                                            <div
                                                class="type_3_item open_key {{ $product->priceInfo->payment_type == 4 ? 'active' : '' }}">
                                                <div class="input_area_2">
                                                    <div class="flex_between">
                                                        <div class="item">
                                                            <label class="input_label">보증금</label>
                                                            <div class="flex_1">
                                                                <input type="text" id="price_4" name="price_4"
                                                                    class="w_input_150" inputmode="numeric"
                                                                    oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                    value="{{ number_format($product->priceInfo->price) }}">
                                                                <span>/</span>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <label class="input_label">월임대료</label>
                                                            <div class="flex_1">
                                                                <input type="text" id="month_price"
                                                                    name="month_price" class="w_input_150"
                                                                    inputmode="numeric"
                                                                    oninput="onlyNumbers(this); onTextChangeEvent(this)"
                                                                    value="{{ number_format($product->priceInfo->month_price) }}">
                                                                <span>원</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item_check_add">
                                                        <input type="checkbox" name="is_price_discussion"
                                                            id="is_price_discussion_4" value="1"
                                                            {{ $product->priceInfo->is_price_discussion == 1 ? 'checked' : '' }}>
                                                        <label for="is_price_discussion_4"
                                                            class="gray_deep mt18"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div>
                                            <label class="input_label">준공예정일</label>
                                            <div class="w_30">
                                                <input type="text" id="approve_date_0" name="approve_date_0"
                                                    value="{{ $carbon::parse($product->approve_date)->format('Y.m.d') }}"
                                                    placeholder="예) 20230101" inputmode="numeric"
                                                    oninput="onlyNumbers(this); onDateChangeEvent('approve_date', 0);">
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
                                        onclick="modal_open('address_search')">가(임시)주소 검색</button>
                                </div>
                                <div class="mt8 gap_14">
                                    <input type="checkbox" name="temporary_address" id="temporary_address"
                                        value="1" {{ $product->is_map == 1 ? 'checked' : '' }}>
                                    <label for="temporary_address" class="gray_deep"><span></span> 가(임시)주소</label>

                                    <input type="checkbox" name="unregistered" id="unregistered" value="Y">
                                    <label for="unregistered" class="gray_deep"><span></span> 미등기</label>
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

                                <div class="detail_address_1 mt18 {{ $product->is_map == 0 ? 'active' : '' }}">
                                    <div class="flex_2">
                                        <div class="flex_1">
                                            <input type="text" id="address_dong" name="address_dong"
                                                {{ $product->address_dong == '' ? 'disabled' : '' }}
                                                value="{{ $product->address_dong }}">
                                            <span>동</span>
                                        </div>
                                        <div class="flex_1">
                                            <input type="text" id="address_number" name="address_number"
                                                value="{{ $product->address_number ?? $product->detail }}">
                                            <span>호</span>
                                        </div>
                                    </div>
                                    <div class="mt8">
                                        <input type="checkbox" name="address_no" id="address_no_1" value="Y"
                                            {{ $product->address_dong == '' ? 'checked' : '' }}>
                                        <label for="address_no_1" class="gray_deep"><span></span> 동정보 없음</label>
                                    </div>
                                </div>

                                <div class="detail_address_2 mt18 {{ $product->is_map == 1 ? 'active' : '' }}">
                                    <div>
                                        <input type="text" id="address_detail" name="address_detail"
                                            value="{{ $product->address_detail }}"
                                            placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
                                    </div>
                                    <div class="mt8">
                                        <input type="checkbox" name="address_no" id="address_no_2" value="Y"
                                            {{ $product->address_detail == '' ? 'checked' : '' }}>
                                        <label for="address_no_2" class="gray_deep"><span></span> 상세주소 없음</label>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_item inner_map only_pc mapOnlyPc">
                                <div id="is_temporary_1" style="display: none">
                                    가(임시)주소 선택시,<br>지도 노출이 불가능합니다.
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
                                    <label class="input_label">사용승인일 <span class="txt_point">*</span></label>
                                    <input type="text" id="approve_date_1" name="approve_date_1"
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
                                                value="{{ $product->move_date }}" placeholder="예) 20230101"
                                                inputmode="numeric"
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
                                            value="{{ $product->service_price }}" inputmode="numeric"
                                            oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                        <span class="gray_deep">원</span>

                                        @if ($type == 1 || $type == 2 || $product->type == 4)
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
                                        value="{{ $product->loan_price }}"
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
                                        <input type="text" id="parking_price" name="parking_price"
                                            class="w_input_150"
                                            value="{{ $product->parking_type == 1 ? ($product->parking_price == '' ? '무료주차' : $product->parking_price) : '' }}"
                                            {{ $product->parking_type == 0 ? 'disabled' : '' }} inputmode="numeric"
                                            oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                        <span>원</span>
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

                            @if ($product->type == 4 || ($product->type > 7 && $product->type < 14))
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
                                    <label class="input_label">건물
                                        방향{{ $product->type == 5 ? ' (주 출입구 기준)' : '' }}</label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">
                                            {{ $product->productAddInfo->direction_type != '' ? Lang::get('commons.direction_type.' . $product->productAddInfo->direction_type) : '건물 방향 선택' }}</button>
                                        <ul class="optionList">
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
                                    <input type="hidden" name="heating_type"
                                        value="{{ $product->productAddInfo->heating_type }}">
                                    <label class="input_label">난방 종류</label>
                                    <div class="dropdown_box">
                                        <button type="button"
                                            class="dropdown_label">{{ $product->productAddInfo->heating_type != '' ? Lang::get('commons.heating_type.' . $product->productAddInfo->heating_type) : '난방 종류 선택' }}</button>
                                        <ul class="optionList">
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
                                @if (
                                    $product->type != 3 &&
                                        $product->type != 5 &&
                                        $product->type != 7 &&
                                        $product->type != 4 &&
                                        ($product->type < 8 || $product->type > 13))
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

                                        @if (
                                            $product->type != 3 &&
                                                $product->type != 5 &&
                                                $product->type != 7 &&
                                                $product->type != 4 &&
                                                ($product->type < 8 || $product->type > 13))
                                            <input type="checkbox" name="is_goods_elevator" id="is_goods_elevator"
                                                value="1"
                                                {{ $product->productAddInfo->is_goods_elevator == 1 ? 'checked' : '' }}>
                                            <label for="is_goods_elevator" class="gray_deep"><span></span> 화물용</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if ($product->type != 3 && $product->type != 5 && $product->type != 4 && ($product->type < 8 || $product->type > 13))
                                @if ($product->type != 7)
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
                                <div class="reg_mid_wrap">
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
                                </div>

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
                        $option_count = 0;
                    @endphp

                    @if ($product->type != 6)
                        <div class="box_01 box_reg">
                            <h4>옵션 정보</h4>

                            <div>
                                <div class="reg_item">
                                    <label class="input_label">옵션 여부</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="option_info" id="option_info_1"
                                            value="Y" checked="">
                                        <label for="option_info_1" onclick="showDiv('option_info', 0)">있음</label>

                                        <input type="radio" name="option_info" id="option_info_2"
                                            value="Y">
                                        <label for="option_info_2" onclick="showDiv('option_info', 1)">없음</label>
                                    </div>

                                    @if ($product->type != 4 && $product->type != 9)
                                        <div class="option_info_wrap">
                                            <div class="option_info_item open_key active">
                                                <div class="option_row">
                                                    <div class="option_tit">시설</div>
                                                    <div class="checkbox_btn">
                                                        @php
                                                            $optionArray = [];
                                                            foreach ($product->productOptions as $key => $option) {
                                                                array_push($optionArray, $option->type);
                                                            }
                                                        @endphp

                                                        @for ($i = 0; $i < count(Lang::get('commons.option_facility')); $i++)
                                                            <input class="option_facility" type="checkbox"
                                                                name="option_type[]"
                                                                id="option_{{ $option_count }}"
                                                                value="{{ $option_count }}"
                                                                {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                            <label for="option_{{ $option_count }}">
                                                                {{ Lang::get('commons.option_facility.' . $option_count++) }}
                                                            </label>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="option_row">
                                                    <div class="option_tit">보안</div>
                                                    <div class="checkbox_btn">
                                                        @for ($i = 0; $i < count(Lang::get('commons.option_security')); $i++)
                                                            <input class="option_security" type="checkbox"
                                                                name="option_type[]"
                                                                id="option_{{ $option_count }}"
                                                                value="{{ $option_count }}"
                                                                {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                            <label for="option_{{ $option_count }}">
                                                                {{ Lang::get('commons.option_security.' . $option_count++) }}
                                                            </label>
                                                        @endfor
                                                    </div>
                                                </div>

                                                @if ($product->type > 3 && $product->type != 5 && $product->type != 7)
                                                    <div class="option_row">
                                                        <div class="option_tit">주방</div>
                                                        <div class="checkbox_btn">
                                                            @for ($i = 0; $i < count(Lang::get('commons.option_kitchen')); $i++)
                                                                <input class="option_kitchen" type="checkbox"
                                                                    name="option_type[]"
                                                                    id="option_{{ $option_count }}"
                                                                    value="{{ $option_count }}"
                                                                    {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                                <label for="option_{{ $option_count }}">
                                                                    {{ Lang::get('commons.option_kitchen.' . $option_count++) }}
                                                                </label>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="option_row">
                                                        <div class="option_tit">가전</div>
                                                        <div class="checkbox_btn">
                                                            @for ($i = 0; $i < count(Lang::get('commons.option_home_appliances')); $i++)
                                                                <input class="option_home_appliances"
                                                                    type="checkbox" name="option_type[]"
                                                                    id="option_{{ $option_count }}"
                                                                    value="{{ $option_count }}"
                                                                    {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                                <label for="option_{{ $option_count }}">
                                                                    {{ Lang::get('commons.option_home_appliances.' . $option_count++) }}
                                                                </label>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="option_row">
                                                        <div class="option_tit">가구</div>
                                                        <div class="checkbox_btn">
                                                            @for ($i = 0; $i < count(Lang::get('commons.option_furniture')); $i++)
                                                                <input class="option_furniture" type="checkbox"
                                                                    name="option_type[]"
                                                                    id="option_{{ $option_count }}"
                                                                    value="{{ $option_count }}"
                                                                    {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                                <label for="option_{{ $option_count }}">
                                                                    {{ Lang::get('commons.option_furniture.' . $option_count++) }}
                                                                </label>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="option_row">
                                                        <div class="option_tit">기타</div>
                                                        <div class="checkbox_btn">
                                                            @for ($i = 0; $i < count(Lang::get('commons.option_etc')); $i++)
                                                                <input class="option_etc" type="checkbox"
                                                                    name="option_type[]"
                                                                    id="option_{{ $option_count }}"
                                                                    value="{{ $option_count }}"
                                                                    {{ in_array($option_count, $optionArray) ? 'checked' : '' }}>
                                                                <label for="option_{{ $option_count }}">
                                                                    {{ Lang::get('commons.option_etc.' . $option_count++) }}
                                                                </label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="option_info_item open_key"></div>

                                        </div>
                                    @else
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
                        <div class="img_add_wrap reg_step_type" id="imageList">
                            <div class="cell">
                                <button type="button" id="profile_drop">
                                    <div class="img_box"><img src="{{ asset('assets/media/btn_img_add.png') }}"
                                            onclick="plusClickEvent();">
                                    </div>
                                </button>
                            </div>
                            @if (count($product->images) > 0)
                                @foreach ($product->images as $image)
                                    <div class="cell">
                                        <input type="hidden" id="image_ids[]" name="image_ids[]"
                                            value="{{ $image->id }}">
                                        <img src="{{ asset('assets/media/btn_img_delete.png') }}"
                                            class="btn_img_delete" onclick="removeImage(this);">
                                        <div class="img_box"><img
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
                                        value="{{ $product->commission }}" placeholder="중개보수를 입력해 주세요."
                                        inputmode="numeric" oninput="onlyNumbers(this); onTextChangeEvent(this);">
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

    <!-- modal 가(임시)주소 검색 : s-->
    <div class="modal modal_mid modal_address_search">
        <div class="modal_title">
            <h5>가(임시) 주소 검색</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('address_search')">
        </div>
        <div class="modal_container">
            <ul class="adress_select tab_toggle_menu">
                <li class="active"><span id="region_input_1">시/도</span></li>
                <li style="display:none"><span id="region_input_2">시/군/구</span></li>
                <li style="display:none"><span id="region_input_3">읍/면/동</span></li>
                <li style="display:none"><span id="region_input_4">리</span></li>
            </ul>
            <div class="tab_area_wrap adress_select_wrap  mt20">
                <div>
                    <div class="point_sm_filter cell_4" id="region_code_1">

                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4" id="region_code_2">

                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4"id="region_code_3">

                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4" id="region_code_4">

                    </div>
                </div>
            </div>
            <div>
                <button class="btn_full_basic btn_point mt20" id="seach_address" onclick="seach_address()"
                    disabled>검색</button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_address_search" onclick="modal_close('address_search')"></div>
    <!-- modal 가(임시)주소 검색 : e-->

</x-layout>

<input hidden name="approve_date" id="approve_date">
<input hidden name="move_date" id="move_date">



<script>
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

        console.log('name : ', area_name);
        var area = $('#' + area_name).val();

        console.log('area', area);

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
                    <div class="cell">
                        <input type="hidden" id="image_ids[]" name="image_ids[]" value="${responseText.result.id}">
                        <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete" onclick="removeImage(this);">
                        <div class="img_box">
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

    // 이미지 제거
    function removeImage(elem) {
        var imageCount = parseInt($('#imageCount').text());
        $('#imageCount').text(imageCount - 1);
        $(elem).parent().remove();
    }

    function selectType(name, index) {
        $('input[name="' + name + '"]').val(index);
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

    $(document).ready(function() {

        // 지도 사이즈 별로 나오게
        // 모바일 / PC 각 div 에 mapOnlyMobile / mapOnlyPc 클래스 명 추가해주세요!
        if (document.body.offsetWidth > 767) {
            var mobileDiv = document.querySelector(".mapOnlyMobile").children[0];
            var pcDiv = document.querySelector(".mapOnlyPc");
            pcDiv.appendChild(mobileDiv);
        }

        var type = sessionStorage.getItem("typeSession");

        // 매물 타입이 분양권일 경우 활성화
        if (type > 13) {
            $('#is_unregistered').css('display', '');
        };

        // 지역구 가져오기
        get_region('*00000000', '1');

        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
            .remove();
    });

    function formSetting() {

        var is_temporary = $('#temporary_address').is(':checked');
        var is_address_no_1 = $('#address_no_1').is(':checked');
        var is_address_no_2 = $('#address_no_2').is(':checked');

        if (is_temporary) {
            $('#address_detail').val('')
        } else {
            $('#address_dong').val('')
            $('#address_number').val('')
        }

        var address_lng = $('#address_lng').val();
        var address_lat = $('#address_lat').val();
        var region_code = $('#region_code').val();
        var region_address = $('#region_address').val();
        var address = $('#address').val();
        var address_detail = $('#address_detail').val();
        var address_dong = $('#address_dong').val();
        var address_number = $('#address_number').val();

        $('.find_form').submit();
    }


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
                    var div = $("#region_code_" + region);
                    div.empty();

                    // Iterate over the 'regcodes' array
                    if (region == 1) {
                        response.regcodes.forEach(function(regcodeObj, index) {
                            // Assuming 'code' is the property you want to use for the option value
                            var regcode = regcodeObj.code;
                            // Assuming 'name' is the property you want to use for the option text
                            var name = regcodeObj.name;
                            div.append(`<div class="cell">` +
                                `<input type="radio" name="region_` + region +
                                `" id="region_` + region + `_` + (
                                    index + 1) + `" value="` +
                                regcode.substring(0, 2) + `">` +
                                `<label class="label" for="region_` + region + `_` + (
                                    index + 1) +
                                `">` +
                                name +
                                `</label>` +
                                `</div>`);
                        });
                    } else if (region != 1) {
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
                            div.append(`<div class="cell">` +
                                `<input type="radio" name="region_` + region +
                                `" id="region_` + region + `_` + (
                                    i + 1) + `" value="` +
                                options[i].value + `">` +
                                `<label class="label" for="region_` + region + `_` + (
                                    i + 1) +
                                `">` +
                                options[i].name +
                                `</label>` +
                                `</div>`);
                        }
                    }

                    // 하위 선택할 수 있게 보여줌
                    $('#region_input_' + region).parents('li').css('display', '')
                    $('#region_input_' + region).click();

                    $('#seach_address').attr("disabled", true);

                } else {
                    console.error("Invalid response format. 'regcodes' array not found.", region);
                    if (region == 4) {
                        var span = document.getElementById('region_input_4');
                        span.parentElement.style.display = 'none';
                        $('#seach_address').attr("disabled", false);
                    }
                }
            },
            error: function(error) {
                console.error("Error fetching regcodes:", error);
            }
        });
    }

    function seach_address() {
        var sidoName = $('input[name="region_1"]:checked').next('label').text();
        var sigunguName = $('input[name="region_2"]:checked').next('label').text();
        var dongName = $('input[name="region_3"]:checked').next('label').text();
        var riName = $('input[name="region_4"]:checked').next('label').text();

        var address = sidoName + ' ' + sigunguName + ' ' + dongName + ' ' + riName;

        $('#region_code').val();

        modal_close('address_search')

        $('#roadName').html('<span>도로명</span>' + address + ' 999-99');
        $('#address').val(address + ' 999-99');
        $('#region_address').val(address);
        $('#old_address').val(address);

        onFieldInputCheck();
    }

    $('#address_no_1').click(function() {
        if ($(this).is(':checked')) {
            $('#address_dong').val('');
            $('#address_dong').attr('disabled', true);
        } else {
            $('#address_dong').attr('disabled', false);
        }
    });

    $('#address_no_2').click(function() {
        if ($(this).is(':checked')) {
            $('#address_detail').val('');
            $('#address_detail').attr('disabled', true);
        } else {
            $('#address_detail').attr('disabled', false);
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

        $('#address').val('');
        $('#roadName').empty();
        $('#jibunName').empty();
        $('#address_detail').val('');
        $('#address_dong').val('');
        $('#address_number').val('');

        if (this.checked) {
            address_1.style.display = "none";
            address_2.classList.add("active");
            search_1.style.display = "none";
            search_2.classList.add("active");
            is_temporary_0.style.display = "none";
            is_temporary_1.style.display = "block";
        } else {
            address_1.style.display = "block";
            address_2.classList.remove("active");
            search_1.style.display = "block";
            search_2.classList.remove("active");
            is_temporary_0.style.display = "block";
            is_temporary_1.style.display = "none";
        }
    });

    document.addEventListener("DOMContentLoaded", function() {


        // 초기 텍스트 배열
        var initialTexts = ["시/도", "시/군/구", "읍/면/동", "리"];

        // 모든 라벨에 대한 클릭 이벤트 처리
        document.addEventListener("click", function(event) {
            var clickedElement = event.target; // 클릭된 요소를 가져옴

            // 클릭된 요소가 라벨인 경우
            if (clickedElement.classList.contains('label')) {
                var forAttr = clickedElement.getAttribute("for"); // for 속성 값 가져오기
                var index = forAttr.split("_")[1]; // 인덱스 추출
                var regionInputId = "region_input_" + index;
                var span = document.getElementById(regionInputId);

                // 현재 클릭된 라벨의 인덱스
                var currentIndex = parseInt(index) + 1;

                // 현재 클릭된 라벨의 상위 항목을 초기화
                resetUpperRegions(currentIndex);



                // 해당 라벨의 텍스트 설정
                span.textContent = clickedElement.textContent; // 클릭된 라벨의 텍스트를 span에 입력

                var region_code = '';
                // 주소 가져오기
                if (currentIndex < 5) {
                    check_code = $('#' + forAttr).val();
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

            }
        });

        // 상위 지역을 초기화하는 함수
        function resetUpperRegions(currentIndex) {
            for (var i = currentIndex; i <= 4; i++) {
                var regionInputId = "region_input_" + i;
                var span = document.getElementById(regionInputId);
                if (span) {
                    span.textContent = initialTexts[i - 1]; // 초기화 텍스트 설정
                    span.parentElement.style.display = 'none';
                    // 라디오 버튼 해제
                    var radioButtons = document.querySelectorAll('[name="region_' + (i) + '"]');
                    radioButtons.forEach(function(radioButton) {
                        radioButton.checked = false;
                    });
                }
            }
        }
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

        console.log('주소 검색 끝!');

        onFieldInputCheck();
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

    function onFieldInputCheck() {

        var minusVal = 0;

        ($('#floor_number').val() != '') ? true: minusVal++;
        ($('#total_floor_number').val() != '') ? true: minusVal++;
        ($('#comments').val() != '') ? true: minusVal++;
        ($('#address').val() != '') ? true: minusVal++;
        ($('#price_' + $("input[name='payment_type']:checked").val()).val() != '') ? true: minusVal++;

        if (minusVal == 0) {
            document.getElementById('nextPageButton').disabled = false;
        } else {
            document.getElementById('nextPageButton').disabled = true;
        }
    }

    const processChange = debounce(() => onFieldInputCheck());

    addEventListener("input", (event) => {
        processChange();
    });

    addEventListener("checkbox", (event) => {
        processChange();
    });
</script>
